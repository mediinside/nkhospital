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
include_once($GP->CLS."class.naver.php");
if($_SESSION['suserid']) $C_Func->go_url("/v3/");

$url = $GP->NAVER_RETURN_URL."&re_url=/v3/";
$naver = new Naver(array(
	"CLIENT_ID" => $GP->NAVER_CLIENT_ID,
	"CLIENT_SECRET" => $GP->NAVER_CLIENT_SECRET,
	"RETURN_URL" => $url,
	"AUTO_CLOSE" => true,
	"SHOW_LOGOUT" => false,
	"CLASS_MODE" => "v2"
	)
);     


$tpl->define("main","login.tpl");

$naverBtn = $naver->login();
$tpl->assign(array(
));
//print_r($tpl);
include $root_path."include/footer.php";
?>

