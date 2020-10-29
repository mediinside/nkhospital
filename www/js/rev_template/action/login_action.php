<?php 
/*
BY-SHIN - 2016-04-27
*/

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);


$root_path = "../";

include $root_path."include/common.php";
include $root_path."class/class.kakao.php";

$EnDecryptText = new EnDecryptText(); 

$mode = ($_POST["mode"]) ? $_POST["mode"] : $_GET["mode"];
//$_SESSION['mode'] 			= $mode;	

switch($mode){
	case "kakao" :
		if(!$_POST['r_phone1']) $_POST['r_phone1'] = "010";
		$r_phone = $_POST['r_phone1']."-".$_POST['r_phone2']."-".$_POST['r_phone3'];
		if($_POST['r_name'] && $r_phone && $_POST['r_nick'] && $_POST['r_id']) {
			
			$gat = $_COOKIE["gat"];
			$grt = $_COOKIE["grt"];
			$kakao = new Kakao_REST_API();
			$params ="";
			$params['grant_type']    = 'refresh_token';
			$params['client_id']     = CLIENT_ID;
			$params['refresh_token'] = $grt;
			$rec = $kakao->create_or_refresh_access_token($params);
			$token = json_decode($rec,true);

			
			$kakao = new Kakao_REST_API($gat);		
			setcookie('gat',$token["access_token"],time() + 86400*30,'/');				
			
			$params['properties'] = '{"phone":"'.$r_phone.'","name":"'.$_POST[r_name].'"}';
		    $kakao->update_profile($params);
			
			$db->sql("
				select count(*) as cnt from ".MEMBER_TABLE." where MemID = '$_POST[r_id]' and MemType = 'kakao'
			");
			$db->exec();
			if(!$db->mr(0,0)) {
				$EnDecryptText = new EnDecryptText(); 
				$MemPW = $EnDecryptText->Encrypt_Text($key_value_se.$_POST[r_id]);
				
				$nDate = date("Y-m-d H:i:s");
						$join_info = array(
								'MemID'		=> $_POST['r_id'],
								'MemPW'		=> $MemPW,
								'MemName'	=> $_POST['r_name'],
								'MemBirthDt'=> "",
								'MemPhoneNo'=> $r_phone,
								'MemSex'	=> "",
								'MemType'	=> "kakao",
								'MemLastLoginDt'=> $nDate,
								'MemRegDt'		=> $nDate,
						);	
						$rst = db_insert_r($join_info,MEMBER_TABLE);	
			}
			$db->sql("SELECT * from ".MEMBER_TABLE." where MemID = '$_POST[r_id]' and MemType = 'kakao' and MemDelFlag = 'N'");		
			$db->exec();				
			$rec = $db->mfa();
			$_SESSION['rev_no']			= $rec["MemNo"];
			$_SESSION['rev_id'] 		= $rec['MemID'];
			$_SESSION['rev_name'] 		= $rec['MemName'];
			$_SESSION['rev_phone'] 		= $rec['MemPhoneNo'];
			$_SESSION['rev_sex'] 		= $rec['MemSex'];
			$_SESSION['rev_birth'] 		= $rec['MemBirthDt'];
			$_SESSION['rev_last_login']	= $rec['MemLastLoginDt'];
			$_SESSION['rev_pro_image']  = "";
			$_SESSION['rev_thum_image'] = "";
			$_SESSION['rev_info'] 		= "";
			$_SESSION['mode']			= "kakao";
			
			$js->gourl("/online/reserve/");			
		}else{
			$js->msgbox("정보가 부족합니다. 다시 시도해 주세요");
			$js->gourl("/online/main/");
		}
	break;
	case "mem" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			$m_pwd = $pwd;
			$pwd = $EnDecryptText->Encrypt_Text($key_value_se.$m_pwd);
			$rpwd = $EnDecryptText->Decrypt_Text($pwd);			
			if($_COOKIE["cookie_c_id"] && $_COOKIE["cookie_c_pw"] && $_COOKIE["cookie_auto_yn"] == "Y") {
				$m_id	= $_COOKIE["cookie_c_id"];
				$pwd	= $_COOKIE["cookie_c_pw"];
				$rpwd  = $EnDecryptText->Decrypt_Text($pwd);
				$auto	= "Y";
			}
			if($_COOKIE["cookie_rem_info_yn"] == "Y") {
					$rem_info = "Y";	
			}
			//아이디검사
			$db->sql("SELECT * FROM ".MEMBER_TABLE." where MemID = '$m_id' and MemDelFlag = 'N'");		
			$db->exec();				
			if($rec = $db->mfa())
			{
			  $r2pwd = $EnDecryptText->Decrypt_Text($rec["MemPW"]);	
			   if ($rpwd == $r2pwd) {
				//비밀번호가 같다면
					$_SESSION['rev_no']			= $rec["MemNo"];
					$_SESSION['rev_id'] 		= $rec['MemID'];
					$_SESSION['rev_name'] 		= $rec['MemName'];
					$_SESSION['rev_phone'] 		= $rec['MemPhoneNo'];
					$_SESSION['rev_sex'] 		= $rec['MemSex'];
					$_SESSION['rev_birth'] 		= $rec['MemBirthDt'];
					$_SESSION['rev_last_login']	= $rec['MemLastLoginDt'];
					$_SESSION['rev_pro_image']  = "";
					$_SESSION['rev_thum_image'] = "";
					$_SESSION['rev_info'] 		= "";
					$_SESSION['mode']			= "mem";
					
					if($rem_info == "Y" || $auto == "Y") {
						if($auto == "Y") {
							setcookie('cookie_auto_yn',$auto,time() + 86400*365,'/');
							setcookie('cookie_c_pw',$pwd,time() + 86400*365,'/');	
						}
						setcookie('cookie_rem_info_yn',$rem_info,time() + 86400*365,'/');
						setcookie('cookie_c_id',$m_id,time() + 86400*365,'/');
						
					}else{
						setcookie('cookie_auto_yn','',time() - 3600,'/');
						setcookie('cookie_c_id','',0,'/');	
						setcookie('cookie_c_pw','',0,'/');	
					}
					$js->gourl("/online/reserve/");
					
				} else {
					setcookie('cookie_auto_yn','',time() - 3600,'/');
					setcookie('cookie_c_id','',0,'/');	
					setcookie('cookie_c_pw','',0,'/');					
					
					$js->msgbox("패스워드가 틀립니다.");
					$js->gourl("/online/main/");
				}
			}else{
				$js->msgbox("아이디 혹은 패스워드가 틀립니다.");
				$js->gourl("/online/main/");				
			}
	break;
	case "kakao_out" :
		$kakao = new Kakao_REST_API($_COOKIE["gat"]);
		$kakao->logout();	
		$_SESSION['kakao_token'] 	= "";
		$_SESSION['rev_id'] 		= "";
		$_SESSION['rev_name'] 		= "";
		$_SESSION['rev_phone'] 		= "";
		$_SESSION['rev_nick'] 		= "";
		$_SESSION['rev_pro_image']  = "";
		$_SESSION['rev_thum_image'] = "";
		$_SESSION['rev_info'] 		= "";
		$_SESSION['mode'] 			= "";
		$js->gourl("/online/main/");		
	break;
	case "logout" :
		setcookie('cookie_auto_yn','',time() - 3600,'/');
//		setcookie('cookie_c_id','',0,'/');	
//		setcookie('cookie_c_pw','',0,'/');	
		$_SESSION['kakao_token'] 	= "";		
		$_SESSION['rev_id'] 		= "";
		$_SESSION['rev_name'] 		= "";
		$_SESSION['rev_phone'] 		= "";
		$_SESSION['rev_nick'] 		= "";
		$_SESSION['rev_pro_image']  = "";
		$_SESSION['rev_thum_image'] = "";
		$_SESSION['rev_info'] 		= "";
		$_SESSION['mode'] 			= "";		
		$js->gourl("/online/main/");
	break;
}
?>