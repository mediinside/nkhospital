<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약 정보 입력 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."include/select_box.php";
include $root_path."class/class.kakao.php";

//$kakao = new Kakao_REST_API(CLIENT_ID);
//$kakao->set_access_token($_SESSION["kakao_token"]);

$tpl->define("main","online/".$tpl_path);

$rev_phone_arr = explode("-",$_SESSION["rev_phone"]);
//print_r($_SESSION);

$tpl->assign(array(
	'r_name'	=> $_SESSION['rev_name'],
	'r_phone1'	=> $rev_phone_arr[0],
	'r_phone2'	=> $rev_phone_arr[1],
	'r_phone3'	=> $rev_phone_arr[2],
	'r_sex'		=> $_SESSION['rev_sex'],
	'r_birth'	=> $_SESSION['rev_birth']
));


include $root_path."include/footer.php";
?>

