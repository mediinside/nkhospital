<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "회원가입 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);
define("ADMIN_MODE",true);

$root_path = "../";

include $root_path."include/common.php";

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>
