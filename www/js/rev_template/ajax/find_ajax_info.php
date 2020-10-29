<?php 
/*
BY-SHIN - 2016-03-18
*/

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("AJAX_PAGE",true);

$root_path = "../";
include $root_path."include/common.php";
$name 	= $_POST['name'];
$id 	= $_POST['id'];
$phone  = $_POST['phone'];
$mode   = $_POST['mode'];

switch($mode) {
	case "id" :
		$db->sql("
					select MemID from ".MEMBER_TABLE." where MemName = '$name' and MemPhoneNo = '$phone' and MemType = 'mem'
				");
		$db->exec();
		if($db->mnr() > 0)
		{
			echo $db->mr(0,0);
			exit();
		}
		else
		{
			echo "false";
			exit();
		}

	break;
	case "pw" :
			$db->sql("
					select MemID from ".MEMBER_TABLE." where MemName = '$name' and MemPhoneNo = '$phone' and MemID = '$id' and MemType = 'mem'
				");
		    $db->exec();
		if($db->mnr() > 0)
		{
			$imsipw = strtolower(GenerateString(8));
			$EnDecryptText = new EnDecryptText(); 
			$MemPW = $EnDecryptText->Encrypt_Text($key_value_se.$imsipw);			
			
			//SMS 발송
			$SMS_ID  = SMS_ID;
			$SMS_PWD = md5(SMS_PW);
			$sm_to   = $phone;
			$phone_array = explode("-",SMS_HP_TEST);
			$send_date = date('Y-m-d');
			$msg = "요청하신 임시 비밀 번호는 [".$imsipw."] 입니다. - 메디인사이드";
			//$mb_id = "adm_medi";
			//$mode  = "admin";
				//보낼 데이터
				$data = array(
					'type' => 'send',
					'msg' => $msg,    
					'sm_to' => $sm_to,
					'destination' => '',
					'sm_from1' => $phone_array[0],
					'sm_from2' => $phone_array[1],
					'sm_from3' => $phone_array[2],
					'send_date' => '',
					'send_time' => '',
					'returnurl' => '',
					'testflag' => 'N',			
					'repeatFlag' => '',
					'repeatNum' => '1',
					'repeatTime' => '15',			
					'send_num' => '1',
					'return_type' => 'json',			
					'login_id' =>  $SMS_ID,			
					'login_pwd' => $SMS_PWD	
				);	
				$result = post_request('http://mediinside.co.kr/api/sms_api.php', $data); 	
			
				if($result > 0) {
					$db->sql("
						update ".MEMBER_TABLE." set MemPW = '$MemPW' where MemID = '$id' and MemType = 'mem'
						");
					$db->exec();					
					echo "true";
					
				}else{
					echo "false";	
				}			
			exit();
		}
		else
		{
			echo "false";
			exit();
		}
	break;
}
?>