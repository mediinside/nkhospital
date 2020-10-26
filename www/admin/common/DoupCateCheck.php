<?php
	include_once("../../_init.php");
	include_once $GP -> CLS . 'class.nonpay.php';
	$C_Nonpay 	= new Nonpay;
	
	$args['npc_name'] = $_POST['npc_name'];
	$rst = $C_Nonpay->DobuleCateCheck($args);	

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