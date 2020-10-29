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
$MemID = $_POST['MemID'];


$db->sql("
			select count(*) as cnt from ".MEMBER_TABLE." where MemID = '$MemID'
		");
$db->exec();
	if($db->mr(0,0) > 0)
	{
		echo "false";
		exit();
	}
	else
	{
		echo "true";
		exit();
	}
s?>