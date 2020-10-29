<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약 정보 확인 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";

$phone = $_POST["phone1"]."-".$_POST["phone2"]."-".$_POST["phone3"];
$r_phone = $_POST["r_phone1"]."-".$_POST["r_phone2"]."-".$_POST["r_phone3"];


if($_SESSION["mode"] == "kakao") {
	$gat = $_COOKIE["gat"];
	$grt = $_COOKIE["grt"];
	include $root_path."class/class.kakao.php";	
	$kakao = new Kakao_REST_API($gat);			
	$params['properties'] = '{"rev_info":"'.$_POST[r_name].'|'.$r_phone.'|"}';
	$kakao->update_profile($params);
}
$r_time = date("H:i",strtotime($_POST["time"]));
if(date("A",$r_time) == "AM") $a = "오전";
if(date("A",$r_time) == "PM") $a = "오후";
$r_time = $a." ".$r_time;

$r_date = date("y-m-d",strtotime($_POST["r_date"]));
//echo $r_date;


//print_r($_POST);
$tpl->assign(array(
	'name'			=> $_POST['name'],
	'phone'			=> $phone,
	'r_name'		=> $_POST['r_name'],
	'r_phone'		=> $r_phone,
	'doctor'		=> $_POST["doctor"],
	'time'			=> $r_time,
	'treat'			=> $_POST["treat"],
	'r_date'		=> $r_date,
	'mode'			=> $_SESSION['mode']
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>