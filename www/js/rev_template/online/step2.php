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

$phone = explode("-",$_SESSION['rev_phone']);

if(!$_SESSION["rev_info"] == ""){
	$info = explode("|",$_SESSION["rev_info"]);
	$r_name 	= $info[0];
	$r_phone 	= explode("-",$info[1]);	
}


//뉴고려 오라클 접속
$ora_db = new Oracle(); 
$query = "select * from dreamer.BTC_Dept where PrintRanking > 0 order by PrintRanking ASC";
$rs = $ora_db->selectList($query); 
$treat="";
for( $i=0 ; $i < sizeof($rs["DEPTCODE"]) ; $i++ ){ 
	$treat .= "<li><a href='javascript:void(0)' data-value='".$rs["DEPTCODE"][$i]."'>".iconv('EUC-KR','UTF-8',$rs["DEPTNAMEK"][$i])."</a></li>";
}
extract($_POST);

$p_sex = ($_SESSION['rev_no'] == "0") ? $r_sex : $_SESSION['rev_sex'];
$p_birth = ($_SESSION['rev_no'] == "0") ? $r_birth : $_SESSION['rev_birth'];

$tpl->assign(array(
	'p_name'		=> $_SESSION['rev_name'],
	'p_phone1'		=> $phone[0],
	'p_phone2'		=> $phone[1],
	'p_phone3'		=> $phone[2],
	'p_sex'			=> $p_sex,
	'p_birth'		=> $p_birth,
	'mode'			=> $_SESSION['mode'],
	'select_treat'  => $treat,
	'r_phone' 		=> $r_phone,	
	'r_name' 		=> $r_name,	
	'r_birth' 		=> $r_birth,	
	'r_sex' 		=> $r_sex,
	'rev_no'		=> $_SESSION['rev_no'],
	
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>