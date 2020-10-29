<?php 
/*
BY-SHIN - 2016-04-27
*/

include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."class/class.kakao.php";

$kakao = new Kakao_REST_API(CLIENT_ID);
$code = $_GET["code"];
$ret = $kakao->get_access_token(CLIENT_ID,REDIRECT_URI,$code);
$ret = json_decode($ret,true);
$_SESSION['kakao_token'] 	= $ret["access_token"];

$rec = $kakao->me();
$rec = json_decode($rec,true);
$action = (!$rec["properties"]["name"] || !$rec["properties"]["phone"]) ? "/online/addinfo/" : "/online/reserve/";

$tpl->define("main","online/".$tpl_path);
//echo JS_PATH;
$tpl->assign(array(
	'r_id'			=> $rec["id"],
	'name'			=> $rec["properties"]["name"],
	'nick'			=> $rec["properties"]["nickname"],
	'pro_image'		=> $rec["properties"]["profile_image"],
	'thum_image'	=> $rec["properties"]["thumbnail_image"],
	'phone'			=> $rec["properties"]["phone"],
	'r_info'		=> $rec["properties"]["rev_info"],
	'action'		=> $action
));
include $root_path."include/footer.php";
?>
