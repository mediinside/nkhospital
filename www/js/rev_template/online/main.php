<?php 
/*
BY-SHIN - 2016-04-27
*/

$page_title = "로그인 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);
define("ADMIN_MODE",true);

$root_path = "../";

include $root_path."include/common.php";

if($_COOKIE["cookie_auto_yn"] == "Y") {
	$js->gourl('/con/action/login_action/mode=mem');
}

$tpl->define("main","online/".$tpl_path);

$tpl->assign(array(
	'm_id'		=> $_COOKIE['cookie_c_id'],
	'rem_yn'	=> $_COOKIE['cookie_rem_info_yn']
));
include $root_path."include/footer.php";
?>

