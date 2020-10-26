<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once $GP -> CLS . 'class.agree.php';
$C_Ag = new Agree();
	$args = "";
	$args['ag_hospital'] 		= $_POST["ag_hospital"];
	$args['ag_name'] 			= $_POST["ag_name"];
	$args['ag_mobile'] 			= $_POST["ag_mobile"];
	$args['ag_email'] 			= $_POST["ag_email"];
	$args['ag_homepage'] 		= $_POST["ag_homepage"];
	$args['ag_content'] 		= $_POST["ag_content"];
	$rst = $C_Ag -> Agree_Reg($args);
	if($rst) {
		echo "문의내용이 접수되었습니다."; 
	}else{
		echo "오류가 발생하였습니다. 다시 접수해주세요";
	}
	exit;
?>