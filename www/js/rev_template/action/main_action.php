<?php 
/*
BY-SHIN - 2016-04-05
*/
error_reporting(E_ALL & ~E_NOTICE);
@ini_set("display_errors", 1);

//include "../adm/inc/head.php";

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";

//변수처리
if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;

switch($_POST['mode']){
	//관리자수정
	case 'A_W':
		
		if($mb_password) {
			$EnDecryptText = new EnDecryptText(); 
			$pwd = $EnDecryptText->Encrypt_Text($key_value_se.$mb_password);
		}
		$list = array(
						"mb_id" 		=> $mb_id,
						"mb_name" 		=> $mb_name,
						"mb_password" 	=> $pwd,
						"mb_email" 		=> $mb_email,
						"mb_phone" 		=> $mb_phone,
						"mb_level" 		=> $mb_level,
						"mb_modify_date"=> date("Y-m-d H:i:s")
		
					);
		if($mb_code) {
			$where_update = "mb_code = '$mb_code'";
			db_modify($list, ADMIN_TABLE, $where_update);
			$js->msgbox("정상적으로 수정되었습니다");
		}else{
			$list["mb_register_date"] = date("Y-m-d H:i:s");
			$list["mb_del_flag"] = "N";
			db_insert($list, ADMIN_TABLE);
			$js->msgbox("정상적으로 등록되었습니다");			
		}		
		
		$js->parentreload();
	break;
	//관리자 삭제
	case 'A_D' :
		db_delete(ADMIN_TABLE,"mb_code = $mb_code");
	exit;	
	
	//관리자권한수정
	case 'A_AM' :
		if(is_array($tl_folder)){
			for($i=0; $i<count($tl_folder); $i++) {
				$arr_tmp = explode("|", $tl_folder[$i]);
				$tl_fld .= $arr_tmp[0] .",";
				$tl_fld_sub .= $arr_tmp[1] .",";
			}
		}
		
		$tl_fld = rtrim($tl_fld,",");
		$tl_fld_sub = rtrim($tl_fld_sub,",");

		$tl_bs = "";
		
		if(is_array($tl_bbs)){
			$tl_bbs = implode(",",$tl_bbs);
		}
		$list = array(
						"tl_bbs" 		=> $tl_bbs,
						"tl_folder" 	=> $tl_fld,
						"tl_folder_sub" => $tl_fld_sub,
						"tl_level" 		=> $tl_level
					);
		if($tl_idx) {
			$where_update = "tl_idx = '$tl_idx'";
			db_modify($list, ADMIN_AUTH_TABLE, $where_update);
			$js->msgbox("정상적으로 수정되었습니다");
		}else{
			$list["tl_regdate"] = date("Y-m-d H:i:s");
			db_insert($list, ADMIN_AUTH_TABLE);
			$js->msgbox("정상적으로 등록되었습니다");			
		}
		$js->parentreload();		
	break;
	
	case 'A_AD' :
		db_delete(ADMIN_AUTH_TABLE,"tl_idx = $tl_idx");
		echo "true";
	exit;
	break;
}
?>