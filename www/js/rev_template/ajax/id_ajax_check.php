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
$mb_id = $_POST['mb_id'];
$mode  = $_POST['mode'];

//$mb_id = "adm_medi";
//$mode  = "admin";

switch($mode) {
	case "admin" :
		$db->sql("
					select count(*) as cnt from ".ADMIN_TABLE." where mb_id = '$mb_id'
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

	break;
}
?>