<?php 
/*
BY-SHIN - 2016-04-27
*/

include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("ADMIN_MODE",true);

$root_path = "../";

include $root_path."include/common.php";

if($_COOKIE["cookie_auto_yn"] == "Y") {
	$js->gourl('/con/action/login_action/?mode=mem');
}


$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>

