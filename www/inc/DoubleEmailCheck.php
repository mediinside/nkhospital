<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();

	$args['mb_email'] = $_POST['mb_email'];
	$rst = $C_Member->emailDobuleCheck($args);

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