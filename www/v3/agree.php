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

$js->load_script("/v3/controller/js/info.js");

$tab = ($_GET["tab"]) ? $_GET["tab"] : "terms";

$tpl->define("main","agree/".$tab.".tpl");

$tpl->define("infomenu","info/info.menu.tpl");

$tpl->assign(array(
	"ctxt"	=> $ctxt,
	"ttxt"	=> $ttxt,
	"tab" 	=> $tab,
	'depth' => $depth
));

include $root_path."include/footer.php";
?>

