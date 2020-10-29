<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once $GP -> CLS . 'class.member.php';
$C_Member = new Member();


switch($_POST['gubun']){
	case "email" :
		$args = "";
		$args['mb_code'] = $_POST["code"];
		$args['mb_email'] = $email;	
		$rst = $C_Member -> Mem_Mod_Email($args);
		echo "이메일이 수정 되었습니다.";
	break;
	case "phone" :
		$args = "";
		$args['mb_code'] = $_POST["code"];
		$args['mb_mobile'] = $mobile;	
		$rst = $C_Member -> Mem_Mod_Phone($args);
		echo "전화번호가 수정 되었습니다.";
	break;	
	case "pwd" :
		$args = "";
		$args['mb_code'] = $_POST["code"];
		$args['mb_password'] = md5(trim($pwd));
		$rst = $C_Member -> Mem_Pass_Check($args);	
		if($rst["cnt"] > 0) {
			$args['mb_password'] = md5(trim($pwdch));
			$rst = $C_Member -> Mem_Pass_Modify($args);
			echo "비밀번호가 수정 되었습니다.";
		}else{
			echo "현재비밀번호가 잘못 되었습니다.";			
		}
	case "out" :
		$args = "";
		$args['mb_code'] 				= $_POST["code"];
		$args['mb_withdrawal'] 			= "9";
		$args['mb_withdrawal_reason'] 	= $_POST["reason"];
		$rst = $C_Member -> Mem_Withdrawal($args);
		session_destroy();	
		echo "탈퇴되었습니다. 그동안 이용해주셔서 감사합니다.";
	break;		
}
?>