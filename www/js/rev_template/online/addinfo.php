<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약자 정보 입력 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);
define("ADMIN_MODE",true);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."include/select_box.php";

$tpl->define("main","online/".$tpl_path);


$tpl->assign(array(
	'r_id'			=> $_POST["r_id"],
	'kakao_token'   => $_POST["kakao_token"],
	'kakao_re_token'=> $_POST["kakao_re_token"],
	'name'			=> $_POST["r_name"],
	'nick'			=> $_POST["r_nick"],
	'pro_image'		=> $_POST["r_pro_image"],
	'thum_image'	=> $_POST["r_thum_image"],
	'phone'			=> $_POST["r_phone"],
	'r_info'		=> $_POST["r_info"],
	'mode'			=> $_POST["mode"]
));

$select = new select_box("phone");
$select->element_name = 'r_phone1';
$select->selected_value = $phone[0];
$select->id = "r_phone1";
$select->display();

include $root_path."include/footer.php";
?>
