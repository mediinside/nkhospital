<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "진료 날짜 선택 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "../";

include $root_path."include/common.php";
//비회원일경우 
if($_POST["gubun"] == "nomem") {
	$_SESSION['rev_no']			= "0";
	$_SESSION['rev_id'] 		= "guest";
	$_SESSION['rev_name'] 		= $_POST['MemName'];
	$_SESSION['rev_phone'] 		= $_POST['MemPhoneNo'];
	$_SESSION['rev_sex'] 		= "";
	$_SESSION['rev_birth'] 		= "";
	$_SESSION['rev_last_login']	= "";
	$_SESSION['rev_pro_image']  = "";
	$_SESSION['rev_thum_image'] = "";
	$_SESSION['rev_info'] 		= "";
	$_SESSION['mode']			= "nomem";
}


//print_r($_SESSION);
$tpl->assign(array(
	'rev_no'	=> $_SESSION['rev_no']
));


$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>

