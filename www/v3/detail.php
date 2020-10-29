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

$js->load_script("/v3/controller/js/detail.js");

$gubun = ($_GET["gubun"]) ? $_GET["gubun"] : "A";
$dr_idx = ($_GET["idx"]) ? $_GET["idx"] : $_GET["idx"];
$args = array();
$args["vd_dr_idx"] = $dr_idx;
$args["dr_idx"] = $dr_idx;
$data = $C_Doctor->Doctor_Info(array_merge($_GET,$_POST,$args));
$vdata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));

$data["dr_clinic2"] = explode(',',$data["dr_clinic2"]);
$data["dr_clinic2"] = $data["dr_clinic2"][0];

if($data["dr_clinic2"]){
	$args["ct_type"] = $data["dr_clinic2"];
}else if($data["dr_clinic3"]){
	$args["sp_type"] = $data["dr_clinic3"];
}
$rtn = $C_Doctor->Doctor_Detail_List($args);
foreach($rtn  as $key=>$val){
	$val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
	$val["dr_clinic2"] = $val["dr_clinic2"][0];

	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic3"]];
	$result[$val["dr_idx"]] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"],'sname'=>$val["dr_name"]);
}

$stxt = $result[$idx]["sname"];

if($data) {
	extract($data);
	$dr_ps = $GP -> DOCTOR_POSITION[$dr_position];
	$dr_treat  = nl2br($C_Func->dec_contents_edit($dr_treat));
	$dr_history  = nl2br($C_Func->dec_contents_edit($dr_history));
	$dr_academy  = nl2br($C_Func->dec_contents_edit($dr_academy));

//echo "=========".$dr_academy;
	if($dr_mobile_img !=  '') {
		$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_mobile_img . "' alt='' />";
	}
	if($dr_bg_img !=  '') {
		$dr_bg_img = $GP -> UP_DOCTOR_URL . $dr_bg_img;
	}else{
		$dr_bg_img = "/resource/images/contents/bg_doc1.jpg";
	}
	$th_img = ($dr_thumb_img) ? $GP -> UP_DOCTOR_URL.$dr_thumb_img : "/resource/images/sample2.jpg";
	$th_img = '<img src="'.$th_img.'" alt="" style="width:100%; position:absolute; ">';
	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2]) ? $GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2] : $GP->NEW_MOBILE_SPECIAL[$dr_clinic3];

	if($GP->NEW_MOBILE_CENTER[$dr_clinic2]){
		$gubun = "a";
		$cl    = $dr_clinic2;
	}else if($GP->NEW_MOBILE_CLINIC[$dr_clinic2]){
		$gubun = "b";
		$cl    = $dr_clinic2;
	}else if($GP->NEW_MOBILE_SPECIAL[$dr_clinic3]){
		$gubun = "c";
		$cl    = $dr_clinic3;
	}


	$moning_arr = explode(',', $dr_m_sd);
	$after_arr = explode(',', $dr_a_sd);
	$moning_txt = "";
	$after_txt = "";
	$moning_txt .= (in_array("월", $moning_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$moning_txt .= (in_array("화", $moning_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$moning_txt .= (in_array("수", $moning_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$moning_txt .= (in_array("목", $moning_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$moning_txt .= (in_array("금", $moning_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$after_txt  .= (in_array("월", $after_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$after_txt  .= (in_array("화", $after_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$after_txt  .= (in_array("수", $after_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$after_txt  .= (in_array("목", $after_arr)) ? "<td>진료</td>" : "<td>-</td>";
	$after_txt  .= (in_array("금", $after_arr)) ? "<td>진료</td>" : "<td>-</td>";
	if($dr_vd_link1) {
		$you_id = explode("watch?v=",$dr_vd_link1);
		$you_id = explode("&",$you_id[1]);
		$you_id = $you_id[0];
	}

	$tpl->assign(array(
			"dr_idx"			=> $dr_idx,
			"dr_ps" 			=> $dr_ps,
			"dr_tr" 			=> $dr_treat,
			"dr_hi" 			=> $dr_history,
			"dr_ac" 			=> $dr_academy,
			"dr_img" 			=> $dr_img,
			"dr_bg_img" 		=> $dr_bg_img,
			"dr_mobile_img" 	=> $dr_mobile_img,
			"moning_txt" 		=> $moning_txt,
			"after_txt" 		=> $after_txt,
			"dr_gita"			=> $dr_gita,
			"dr_greeting" 		=> $dr_greeting,
			"dr_greeting_title"	=> $dr_greeting_title,
			"dr_name" 			=> $dr_name,
			"th_img" 			=> $th_img,
			"treat" 			=> $treat,
			"cl" 				=> $cl,
			'gubun'				=> $gubun,
			"vd_uid"			=> $you_id
	));
}
$tpl->define("main","detail.tpl");

$tpl->assign(array(
	"list"  => $vdata,
	'dlist'  => $result,
	'stxt'  => $stxt
));

include $root_path."include/footer.php";
?>

