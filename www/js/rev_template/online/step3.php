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


//print_r($_POST);

//뉴고려 오라클 접속
$t_code  = $_POST["t_code"];
$query = "select * from dreamer.BTC_Doctor A inner join dreamer.BTC_Dept B On (A.DrDept1 = B.DeptCode OR A.DrDept2 = B.DeptCode) where A.ExpireFlag = 0 and A.ClinicFlag = 1 and DEPTCODE = '$t_code'";
$rs = $ora_db->selectList($query); 
//print_r($rs);
//$select_doctor = "<li><a href='javascript:void(0)' data-value='none'>선택안함</a></li>";
for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
	$select_doctor .= "<li><a href='javascript:void(0)' data-value=".trim($rs["DRCODE"][$i]).">".iconv('EUC-KR','UTF-8',$rs["DRNAME"][$i])."</a></li>";
} 	

/*
		$nDate = date("Y-m-d",strtotime("+2day",time()));
		echo $nDate;
		$query = "select * from dreamer.BTC_DrSchedule where DRCODE = 1042 and SCHDATE > '$nDate'";
		$rs = $ora_db->selectList($query); 
		for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
			$day_arr[] = "'".$rs["SCHDATE"][$i]."'";
		}	
		$day_arr = implode(',',$day_arr);
		//echo $day_arr;
*/
extract($_POST);

$tpl->assign(array(
	'p_name'		=> $p_name,
	'p_phone'		=> $p_phone,
	'p_sex'			=> $p_sex,
	'p_birth'		=> $p_birth,
	't_code'		=> $t_code,
	't_code_name'	=> $t_code_name,	
	'mode'			=> $_SESSION['mode'],
	'select_doctor' => $select_doctor,
	'r_phone' 		=> $r_phone,	
	'r_name' 		=> $r_name,	
	'r_birth' 		=> $r_birth,	
	'r_sex' 		=> $r_sex	
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>