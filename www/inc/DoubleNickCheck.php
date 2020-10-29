<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();

	$args['mb_nick'] = $_POST['mb_nick'];
	$rst = $C_Member->NICK_DobuleCheck($args);

	if($rst['cnt'] > 0)
	{
		echo "false";
		exit();
	}
	else
	{
		echo "true";
		exit();
	}

?>