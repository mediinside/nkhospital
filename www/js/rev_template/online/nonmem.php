<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "진료 날짜 선택 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "../";

include $root_path."include/common.php";


$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>

