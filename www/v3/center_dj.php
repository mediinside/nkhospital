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
$gubun = ($_GET["gubun"]) ? $_GET["gubun"] : "A";
$depart = ($_GET["depart"]) ? $_GET["depart"] : $_GET["depart"];

$js->load_script("/v3/controller/js/center_dj.js");
$skin = "center_dj";
switch($gubun) {
	case "A" : 	$gtxt = "전문센터"; 	$stxt = $GP -> NEW_MOBILE_CENTER[$depart];break;
	case "B" : 	$gtxt = "진료과";   	$stxt = $GP -> NEW_MOBILE_CLINIC[$depart];break;
	case "C" : 	$gtxt = "특수클리닉"; 	$stxt = $GP -> NEW_MOBILE_SPECIAL[$depart];break;
	case "D" : 	$gtxt = "의료진소개";$stxt = "선택해 주세요";break;
}

$rtn = $C_Doctor->Doctor_Detail_List($args);
foreach($rtn  as $key=>$val){
	$drclinic2Arry = explode(',',$val["dr_clinic2"]);
	$val["dr_clinic2"] = $drclinic2Arry["0"];
	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic3"]]; 
	$result[] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"]);
}


$args = array();
if($gubun == "C") {
	$args["sp_type"] = $depart;
	$args["vd_clinic3"] = $depart;
	$josa = ($depart == "F") ? "는" : "은";		
	$ctxt = $GP->NEW_MOBILE_SPECIAL[$depart];
}else {
	$josa = "는";
	$args["ct_type"] = $depart;
	if($gubun == "A") {
		$args["vd_clinic1"] = $depart;
		$ctxt = $GP->NEW_MOBILE_CENTER[$depart];
	}else{
		$args["vd_clinic2"] = $depart;			
		$ctxt = $GP->NEW_MOBILE_CLINIC[$depart];
	}
}
$data = $C_Doctor->Doctor_List_Mobile(array_merge($_GET,$_POST,$args));

	include_once($GP->CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	if($m=="v"){
		$args['jb_idx'] = $bidx;
		$data = "";
		$data = $C_JHBoard -> Board_New_Read_Data($args);	
		$cdata = $C_JHBoard -> Comment_New_List($args);	
		extract($data);
			if($jb_secret_check == "Y" && $_SESSION['suserlevel'] < 9) {
				if($jb_mb_id == "") {
					if(empty($_REQUEST["pd"]) || $_REQUEST["pd"] != $jb_password) {
						$C_Func -> put_msg_and_back('잘못된 접근입니다..');
						exit;
					}
				}else{
					if($_SESSION['suserid'] != $jb_mb_id) {
						$C_Func -> put_msg_and_back('작성회원만 글을 읽을 수 있습니다.');
						exit;
					}else{
						if(!$cdata) {	
							$C_Func ->	go_url("/v3/board.php?jb_code=".$jb_code."&idx=".$jb_idx."&mode=m");
						}
					}
				}
			}	
			
		$reg_date = date("Y.m.d", strtotime($jb_reg_date));
		$content	= $C_Func->dec_contents_edit($jb_content);
		if($jb_file_name!="") {
			$ex_jb_file_name = explode("|", $jb_file_name);
			$ex_jb_file_code = explode("|", $jb_file_code);
			$file_cnt = count($ex_jb_file_name);
		} else {
			$file_cnt = 0;
		}
	
		if($file_cnt > 0)
			{
				for($i=0; $i<$file_cnt; $i++)
				{
					if($ex_jb_file_name[$i])
					{		
						$code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";
						$img_file  = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[$i]}";
						$file_info .= "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">".$ex_jb_file_name[$i]."</a>";		
						$img_content .= "<img src='".$img_file."'>";
					}	 
				}
			}
		if($cdata) {
			foreach($cdata as $k=>$v){
				$jbc_content = nl2br(strip_tags($v['jbc_content'], '<br>'));
					$cmt_info .= '<div class="answer">'.$jbc_content.'</div>';
			   } 
		}
		$tpl->assign(array(		
				'vtitle' 	=> $jb_title,
				'vttxt'  	=> $vttxt,
				'vdate' 	=> $reg_date,
				'vsee' 		=> $jb_see,
				'vcontent' 	=> $content,
				'img_content' 	=> $img_content,				
				'vfile'		=> $file_info,
				'vcmt' 		=> $cmt_info,
				
		));
					
		$skin = "center.view";	
	}else{
		$bargs = "";
		$bargs['jb_code'] = "240";
		$bargs['jb_treat'] = $depart;
		$bargs['jb_type'] = $gubun;		
		$bargs["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
		$bdata = "";
		$bdata = $C_JHBoard -> Search_New_BBS($bargs);
			$psize = 3;
			$p=0;
			$mbtn = ($psize >= count($bdata)) ? " style='display:none;'" : "";
			for($i=0;$i<count($bdata);$i++) {
				$fread 		= "Y";
				$jb_idx 	= $bdata[$i]["jb_idx"];
				$jb_mb_id  	= $bdata[$i]["jb_mb_id"];
				$jb_code 	= $bdata[$i]["jb_code"];
				$title 		= $bdata[$i]["jb_title"];
				$title 		= preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $title);
				$secret		= $bdata[$i]["jb_secret_check"];
				$regDt 		= date("Y.m.d", strtotime($bdata[$i]['jb_reg_date']));
				$content			= $C_Func->dec_contents_edit($bdata[$i]['jb_content']);
				$content			= trim(strip_tags($content));
				$content 			= $C_Func->strcut_utf8($content, 200, true, "...");			
				$jb_comment_count 		= $C_Func->num_f($bdata[$i]['jb_comment_count']);		
				$treat_type = "기타";
				if($bdata[$i]['jb_treat'] != '' ) {				
					$treat_type = $GP -> CLINIC_TYPE_NEW[$bdata[$i]['jb_treat']];
				}		
				$sec = ($secret =="Y") ? '<span class="lock">비밀글</span>' : "";
				if(strlen($bdata[$i]["jb_name"]) > 6) {
					$jb_name 				=  $C_Func->blindInfo($bdata[$i]["jb_name"], 6);
				}else{
					$jb_name 				=  $C_Func->blindInfo($bdata[$i]["jb_name"], 3);	
				}		
				
				//파일명 분리 및 저장된 파일 갯수
				if($bdata[$i]["jb_file_name"]!="") {
					$ex_jb_file_name = explode("|", $bdata[$i]["jb_file_name"]);
					$ex_jb_file_code = explode("|", $bdata[$i]["jb_file_code"]);
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
						$img_src = "<img src='" . $code_file. "' alt='" . $title. "'>";	
					}else{
						$img_src = "<img src='/resource/images/contents/thumb_sample.jpg'>";		
					}
				}else{
					$img_src = "<img src='/resource/images/contents/thumb_sample.jpg'>";	
				}
				if($i%$psize == 0) $p++;
				if($p > 1) $style = 'style=display:none';
				
				if($secret == "Y" && $_SESSION['suserlevel'] < 9) {
					if($jb_mb_id != "") {
						if($_SESSION['suserid'] != $jb_mb_id) {
							$fread = "N";
						}
					}
				}else{
					$secret = "N";	
				}
				$args["jb_code"] = $jb_code;
				$bname = $C_JHBoard -> Board_Config_data($args);		
				
				$answer = ($jb_comment_count > 0) ? '<span class="state com">완료</span>' : '<span class="state">대기</span>';
				
				$boarddata[] = array(
						'jb_idx' 		 => $jb_idx,
						'jb_code'		 => $jb_code,
						'title'			 => $title,						
						'regDt' 		 => $regDt,
						'bname'			 => $bname["jba_title"],
						'img_src'		 => $img_src,						
						'style' 		 => $style,
						'p'				 => $p,
						'secret'		 => $secret,
						'fread'			 => $fread,
						'sec'			 => $sec,
						'treat_type'	 => $treat_type,												
						'jb_name'		 => $jb_name,
						'answer'		 => $answer,
						'content'		 => $content													
				);
			}
		
				
				$args["vd_cnt"] = "Y"; 
				$vdata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
				
				$args["vd_cnt"] = ""; 
				$args["vd_gubun"] = "I"; 
				$vidata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
				//print_r($vidata);
				
				$th_img = ($vidata["0"]["vd_thumb"]) ? $GP -> UP_VIDEO_URL.$vidata["0"]["vd_thumb"] : "/resource/images/sample2.jpg";
				$th_img = '<img src="'.$th_img.'" alt="" style="width:100%; z-index:7; position:absolute; ">';
				$vidata["0"]["vd_uid"] = explode("watch?v=",$vidata["0"]["vd_link1"]);
				$vidata["0"]["vd_uid"] = explode("&",$vidata["0"]["vd_uid"][1]);
				$vidata["0"]["vd_uid"] = $vidata["0"]["vd_uid"][0];
			
				foreach($data as $k=>$v){ 
					$dr_ps = $GP -> DOCTOR_POSITION[$v["dr_position"]];	
					$dr_treat  = nl2br($C_Func->dec_contents_edit($v["dr_treat"]));	
					$dr_mobile_img	= $v['dr_mobile_img'];
					if($dr_mobile_img !=  '') {
						$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_mobile_img . "' alt='' />";
					}	
					$moning_arr = explode(',', $v["dr_m_sd"]);	
					$after_arr = explode(',', $v["dr_a_sd"]);
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
							
					$list[] = array(
							"dr_idx"			=> $v["dr_idx"],
							"dr_ps" 			=> $dr_ps, 
							"dr_img" 			=> $dr_img,			
							"dr_treat" 			=> $dr_treat,
							"dr_mobile_img" 	=> $dr_mobile_img,
							"moning_txt" 		=> $moning_txt,
							"after_txt" 		=> $after_txt,
							"dr_name" 			=> $v["dr_name"]
					);
				}
	}

$tpl->define("main",$skin.".tpl");
			
$tpl->assign(array(
	"depart" => $depart,
	"gubun"  => $gubun,	
	"josa" 	 => $josa,
	"ctxt" 	 => $ctxt,
	"gtxt" 	 => $gtxt,
	"stxt" 	 => $stxt,	
	"vdurl"  => $GP->UP_VIDEO_URL,
	"list1"  => $vidata,
	"list2"  => $list,
	"list3"  => $vdata,
	"list4"  => $boarddata,	
	"dlist"	 => $result,
	"cl1"  	 => $args["vd_clinic1"],
	"cl2" 	 => $args["vd_clinic2"],
	"cl3"	 => $args["vd_clinic3"],
	'mainlink' => $vidata[0]["vd_link1"],
	"mbtn"		=> $mbtn,
	'bcnt'	=> count($boarddata)
));

include $root_path."include/footer.php";
?>

