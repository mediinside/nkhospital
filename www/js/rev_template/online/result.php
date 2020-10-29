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

$db->sql("select * from ".RESERVE_TABLE." where RvNo='$_GET[rtn]'");
$db->exec();
$rec = $db->mfa();
$rec['RvPSex'] = ($rec['RvPSex'] == "M") ? "남자" : "여자";

$tpl->assign(array(
	'r_name'		=> $rec['RvName'],
	'r_phone'		=> $rec['RvPhone'],
	'p_name'		=> $rec['RvPName'],
	'p_birth'		=> $rec['RvPBrith'],
	'p_sex'			=> $rec['RvPSex'],
	'r_tcode'		=> $rec['RvDptCodeName'],
	'r_dr_name'		=> $rec['RvDrName'],
	'p_name'		=> $rec['RvName'],
	'p_revDt'		=> $rec['RvRevDt']." ".$rec['RvRevTime'],	
	'p_phone'		=> $rec['RvPPhone'],
	'mode'			=> $_SESSION['mode']
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>