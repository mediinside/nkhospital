<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();
	
	$refer = $_SERVER['HTTP_REFERER'];
	$server = $_SERVER['HTTP_HOST'];	

	if(!ereg($server, $refer)){
		exit();
	}
	
	$args = "";
	$args['mb_email'] = $_POST['mb_email'];
	$args['mb_name'] = $_POST['mb_name'];
	//$args['mb_mobile'] = str_replace('-','',$_POST['mb_mobile']);
	$rst = $C_Member->Find_ID_Check($args);
	
	
	if($rst) {
		echo "<li>" . $rst['mb_id'] . "</li>";	
	}else{
		echo "<li>일치하는 정보가 없습니다.</li>";	
	}
?>
