<?php
/*
BY-SHIN - 2019-06-11
*/
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors", 1);

include "include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "";

include $root_path."include/common.php";
include $root_path."include/lastest.php";
include_once($GP->CLS."class.slidem.php");
$C_Slide 	= new Slide;

$data = main_lastest("news");
$data1 = main_lastest("80");
$data2 = main_lastest("140");
$data3 = main_lastest("50");
$args = "";
$args["ts_gubun"] == "T";
$tsdata = $C_Slide->Main_Slide_Show($args);
$args["ts_gubun"] == "M";
$msdata = $C_Slide->Main_Slide_Show($args);


$tpl->define("main","index.tpl");
$js->load_script("/v3/controller/js/index.js");

/*include $_SERVER[DOCUMENT_ROOT]."/popup/popup_layer_mobile.php";*/

$tpl->assign(array(
	'tsdata' => $tsdata,
	'msdata' => $msdata,
	'imgurl' => $GP->UP_SLIDE_URL,
	'data' => $data,
	'data1' => $data1,
	'data2' => $data2,
	'data3' => $data3
));
//print_r($tpl);
include $root_path."include/footer.php";
?>

