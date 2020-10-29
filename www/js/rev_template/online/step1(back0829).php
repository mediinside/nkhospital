<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약 정보 입력 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."include/select_box.php";
include $root_path."class/class.kakao.php";

$kakao = new Kakao_REST_API(CLIENT_ID);
$kakao->set_access_token($_SESSION["kakao_token"]);

$tpl->define("main","online/".$tpl_path);

$select = new select_box("treat");
$select->element_name = 'treat';
$select->box_title = "선택하세요";
$select->selected_value = "";
$select->id = "treat";
$select->display();

$tpl->assign(array(
	'r_date'	=> $_GET['date']
));


include $root_path."include/footer.php";
?>

