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

$stext = ($_GET["stext"]) ? $_GET["stext"] : $_POST["stext"];

if($stext){
	include_once($GP->CLS."class.jhboard.php");
	include_once($GP->CLS."class.search.php");	
	$C_JHBoard = new JHBoard();
	$C_Sch 		= new Search;
	$js->load_script("/v3/controller/js/search.js");
	$args = array();
	$args["schtxt"] = $stext;
	$psize = "3";
	list($vdsch,$docsch,$brdsch) = $C_Sch->Search_List($args);
	
	$p=0;$i=0;
	$vmbtn = ($psize >= count($vdsch)) ? " style='display:none;'" : "";
	foreach($vdsch as $k=>$v) { 
		$vd_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
		$vd_link1		= $v['vd_link1'];
		$you_id 		= explode("watch?v=",$vd_link1);
		$you_id 		= explode("&",$you_id[1]);		
		$dr_face_img	=  '<img src="'.$GP -> UP_DOCTOR_URL . $v["dr_face_img"].'" alt="">';
		$drclinic2Arry = explode(',',$v["dr_clinic2"]);
		$v["dr_clinic2"] = $drclinic2Arry["0"];
		$treat = ($GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic3"]]; 
		$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="103" src="//www.youtube.com/embed/'.$you_id[1].'?fs=1" frameborder="0" allowfullscreen></iframe>';
		$dr_name = $v["dr_name"]." ".$vd_ps;
		if($i%$psize == 0) $p++;
		$style = ($p > 1) ? 'style=display:none' : "";	
		$vd_thumb = ($v["vd_thumb"]) ? $v["vd_thumb"] : "nk_thumbnail.jpg";
		$thumb_src = '<img src="'.$GP -> UP_VIDEO_URL . $vd_thumb.'" alt="" style="width:100%; max-height:101px; z-index:7; position:absolute; ">';
		$list1[] = array(
			'style' 		 => $style,
			'p'				 => $p,
			'title'			 => $v["vd_title"],
			'dr_face_img'	 => $dr_face_img,
			'dr_name'		 => $dr_name,
			'treat'	 		 => $treat,
			'thumb'			 => $thumb_src,
			'vd_idx'		 => $v["vd_idx"],
			'dr_idx'		 => $v["dr_idx"],
			'vd_uid'		 => $you_id[0]
		);
	$i++;}
	
	$p=0;$i=0;
	$dmbtn = ($psize >= count($docsch)) ? " style='display:none;'" : "";
	foreach($docsch as $k=>$v) { 
	$dr_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
	$dr_treat  = nl2br($C_Func->dec_contents_edit($v["dr_treat"]));	
	if($v["dr_mobile_img"] !=  '') {
		$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $v["dr_mobile_img"] . "' alt='' />";
	}else{
		$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $v["dr_face_img"] . "' alt='' />";	
	}
	$v_array = explode(',',$v["dr_clinic2"]);
	$v["dr_clinic2"] = $v_array[0];
	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]] : $GP->NEW_MOBILE_SPECIAL[$v["dr_clinic3"]]; 			
	if($i%$psize == 0) $p++;
	$style = ($p > 1) ? 'style=display:none' : "";	
		$list2[] = array(
			'style' 		 => $style,
			'p'				 => $p,
			'dr_idx'		 => $v["dr_idx"],
			'dr_img'	 	 => $dr_img,
			'treat'			 => $treat,
			'dr_name'	 	 => $v["dr_name"],
			'dr_ps'	 		 => $dr_ps,
			'dr_treat'		 => $v["dr_treat"]		
		);
	$i++;}
	
	$p=0;$i=0;
	$bmbtn = ($psize >= count($brdsch)) ? " style='display:none;'" : "";
	foreach($brdsch as $k=>$v) { 
		$regDt = date("Y.m.d", strtotime($v['jb_reg_date']));
		$jb_code = $v["jb_code"];
		$title 		= preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $v["jb_title"]);		
		$args = "";
		$args["jb_code"] = $jb_code;
		$bname = $C_JHBoard -> Board_Config_Data($args);		
		//파일명 분리 및 저장된 파일 갯수
		if($v["jb_file_name"]!="") {
			$ex_jb_file_name = explode("|", $v["jb_file_name"]);
			$ex_jb_file_code = explode("|", $v["jb_file_code"]);
			$file_cnt = count($ex_jb_file_name);
		} else {
			$file_cnt = 0;
		}
		$img_src = "";
		if($file_cnt > 0)
		{	
			$file_ext = substr( strrchr($ex_jb_file_code[0], "."),1); 
			$file_ext = strtolower($file_ext);	//확장자를 소문자로...
			
			if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png"){
				$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
				$img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='144' height='101'>";	
			}else{
				$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='144' height='101'>";		
			}
		}else{
			$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='140' height='101'>";	
		}
		if($i%$psize == 0) $p++;
		$style = ($p > 1) ? 'style=display:none' : "";
		
		$list3[] = array(
			'style' 		 => $style,
			'p'				 => $p,
			'jb_idx'		 => $v["jb_idx"],
			'img_src'	 	 => $img_src,
			'title'			 => $title,
			'jb_code'	 	 => $jb_code,
			'bname'	 		 => $bname["jba_title"],
			'regDt'			 => $regDt
		);
	$i++;}
}

$tpl->define("main","search.tpl");
$tpl->assign(array(
	"list1" => $list1,
	"list2" => $list2,
	"list3" => $list3,
	"stext" => $stext,
	'vcnt'	=> count($vdsch),
	'dcnt'	=> count($docsch),
	'bcnt'	=> count($brdsch),
	"vmbtn" => $vmbtn,
	"dmbtn" => $dmbtn,
	"bmbtn" => $bmbtn,
	"psize"	=> $psize		
));

include $root_path."include/footer.php";
?>

