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
include_once($GP->CLS."class.doctor.php");
include_once($GP->CLS."class.video.php");
$C_Doctor 		= new Doctor;
$C_Video 	= new Video;

$js->load_script("/v3/controller/js/doctor.js");

$gubun = ($_GET["gubun"]) ? $_GET["gubun"] : "A";
$args["order"] = "order by dr_name asc";
$rtn = $C_Doctor->Doctor_Detail_List($args);
foreach($rtn  as $key=>$val){
	//echo $val["dr_clinic2"]."<br>";
	$val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
	$val["dr_clinic2"] = $val["dr_clinic2"][0];
		
	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_SPECIAL[$val["dr_clinic3"]]; 
	$result[] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"]);
}

if($gubun == "A") {
	$arr = $GP -> NEW_MOBILE_CENTER;
}else if($gubun == "B") {
	$arr = $GP -> NEW_MOBILE_CLINIC;
}else{
	$arr = $GP -> NEW_MOBILE_SPECIAL;
}

foreach($arr as $k=>$v){
	$args = "";
	if($gubun == "C") {
		$args["sp_type"] = $k;
	}else{
		$args["ct_type"] = $k;
	}	
	$data = $C_Doctor->Doctor_Detail_List($args);
	$data_list = "";	
	foreach($data as $key=>$val){
	$val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
	$val["dr_clinic2"] = $val["dr_clinic2"][0];		
		if($gubun == "C") {
			$treat = $GP->NEW_MOBILE_SPECIAL[$val["dr_clinic3"]]; 		
		}else{
			$treat = ($GP->NEW_MOBILE_CENTER[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CLINIC[$val["dr_clinic2"]]; 		
		}
		$dname = $val["dr_name"]."(".$treat.")";		
		$dr_img = ($val["dr_mobile_img"]) ? $val["dr_mobile_img"] : $val["dr_face_img"] ;
		$data_list[] = array(
			"dr_idx" => $val["dr_idx"],
			"treat"  => $treat,
			"drname" => $val["dr_name"],
			"dname"  => $dname,			
			"dr_img" => $GP -> UP_DOCTOR_URL . $dr_img,
			"dr_ps"  => $GP -> DOCTOR_POSITION[$val["dr_position"]],									
		);
	}
	
	$list[] = array(
		 "depart" 	=> $k,
		 "name"    	=> $v,
		 "data"		=> $data_list
	
	);
}

$tpl->define("main","doctor.tpl");
	
$tpl->assign(array(
	"list"  => $list,	
	"dlist" => $result,		
	'stxt'  => $stxt,
	"gubun" => $gubun
));


include $root_path."include/footer.php";
?>

