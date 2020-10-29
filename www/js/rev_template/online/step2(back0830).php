<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약자 정보 / 환자 정보 입력 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."include/select_box.php";

//print_r($_POST);
$phone = explode("-",$_SESSION['rev_phone']);

if(!$_SESSION["rev_info"] == ""){
	$info = explode("|",$_SESSION["rev_info"]);
	$r_name 	= $info[0];
	$r_phone 	= explode("-",$info[1]);	
}

$tpl->assign(array(
	'name'			=> $_SESSION['rev_name'],
	'phone1'		=> $phone[0],
	'phone2'		=> $phone[1],
	'phone3'		=> $phone[2],
	'mode'			=> $_SESSION['mode'],
	'r_date'		=> $_POST["r_date"],
	'treat'			=> $_POST["treat"],
	'doctor'		=> $_POST["doctor"],
	'time'			=> $_POST["time"],
	'r_name'		=> $r_name,
	'r_phone1'		=> $r_phone[0],
	'r_phone2'		=> $r_phone[1],
	'r_phone3'		=> $r_phone[2],
	
));



$select = new select_box("phone");
$select->element_name = 'phone1';
$select->selected_value = $phone[0];
$select->id = "phone1";
$select->display();
$select->init();
$select->element_name = 'r_phone1';
$select->selected_value = $r_phone[0];
$select->id = "r_phone1";
$select->display();


$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>