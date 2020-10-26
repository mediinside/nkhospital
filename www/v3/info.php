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

$tab = ($_GET["tab"]) ? $_GET["tab"] : "info3";


switch($tab){
	case "info3"  : $ctxt="예약/발급";$ttxt = "증명서 발급안내"; $depth = "depth1"; break;
	case "info4"  : $ctxt="진료안내";$ttxt = "외래진료안내"; $depth = "depth2"; break;
	case "info5"  : $ctxt="진료안내";$ttxt = "응급진료안내"; $depth = "depth2"; break;
	case "info7"  : $ctxt="입/퇴원안내";$ttxt = "입/퇴원안내"; $depth = "depth3"; break;
	case "info8"  : $ctxt="입/퇴원안내";$ttxt = "입원생활안내"; $depth = "depth3"; break;
	case "info9"  : $ctxt="입/퇴원안내";$ttxt = "면회안내"; $depth = "depth3"; break;
	case "info10_1" : $ctxt="병원안내";$ttxt = "병원둘러보기"; $depth = "depth4"; break;		
	case "info10_2" : $ctxt="병원안내";$ttxt = "병원둘러보기"; $depth = "depth4"; break;			
	case "info11_1" : $ctxt="병원안내";$ttxt = "오시는길/주차안내"; $depth = "depth4"; break;
	case "info11_2" : $ctxt="병원안내";$ttxt = "오시는길/주차안내"; $depth = "depth4"; break;	
	case "info12" : $ctxt="병원안내";$ttxt = "장례식장"; $depth = "depth4"; break;
	case "info13" : $ctxt="병원안내";$ttxt = "전화번호 안내"; $depth = "depth4"; break;	
	default : $ctxt="예약/발급";$ttxt = "진료예약"; $depth = "depth1"; break;	 			
};

$tpl->define("main","info/".$tab.".tpl");

$tpl->define("infomenu","info/info.menu.tpl");

$tpl->assign(array(
	"ctxt"	=> $ctxt,
	"ttxt"	=> $ttxt,
	"tab" 	=> $tab,
	'depth' => $depth
));

include $root_path."include/footer.php";
?>

