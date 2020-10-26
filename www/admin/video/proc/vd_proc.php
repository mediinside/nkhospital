<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.video.php");
include_once($GP->CLS."class.fileup.php");
$C_Video 	= new Video;


switch($_POST['mode']){
	case "VIDEO_DEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['vd_idx'] = $vd_idx;
		$rst = $C_Video -> Video_Del($args);
		echo "true";
		exit();
	break;
	
	case "VIDEO_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		$dr_array = explode('/',$dr_info);
		if($vd_intro!="Y") $vd_intro = "N";
		$args = "";
		$args['vd_idx'] 		= $vd_idx;
		$args['vd_title'] 		= $vd_title;
		$args['vd_uid'] 		= $vd_uid;
		$args['vd_playtime'] 	= $vd_playtime;				
		$args['vd_content'] 		= $C_Func->enc_contents_edit($vd_content);
		$args['vd_intro_content'] 	= $C_Func->enc_contents_edit($vd_intro_content);;		
		$args['vd_dr_idx'] 		= $dr_array[0];
		$args['vd_dr_name'] 	= $dr_array[1];
		$args['vd_dr_position']	= $dr_array[2];
		$args['vd_dr_treat']	= $dr_array[3];
		$args['vd_gubun'] 		= $vd_gubun;
		$args['vd_intro'] 		= $vd_intro;
		$args['vd_tag'] 		= $vd_tag;	
		$args['vd_order'] 		= $vd_order;			
		//진료센터
		$vd_cn1 = "";
		if (is_array($vd_clinic1)) {
			foreach ($vd_clinic1 as $k => $v) {
				$vd_cn1 .= $v . ",";
			}
		}
		$vd_cn1 = rtrim($vd_cn1, ",");
		$args['vd_clinic1'] 	= $vd_cn1;
		//진료과목
		$vd_cn2 = "";
		if (is_array($vd_clinic2)) {
			foreach ($vd_clinic2 as $k => $v) {
				$vd_cn2 .= $v . ",";
			}
		}
		$vd_cn2 = rtrim($vd_cn2, ",");
		
		$args['vd_clinic2'] 	= $vd_cn2;
		
		//특수클리닉
		$vd_cn3 = "";
		if (is_array($vd_clinic3)) {
			foreach ($vd_clinic3 as $k => $v) {
				$vd_cn3 .= $v . ",";
			}
		}
		$vd_cn3 = rtrim($vd_cn3, ",");
		$args['vd_clinic3'] 	= $vd_cn3;
		
		$args['vd_link1'] 		= $vd_link1;
		$args['vd_link2'] 		= $vd_link2;
		
		//썸네일 이미지 업로드
		$file_orName			= "vd_thumb";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_VIDEO;
			$args_f['files'] 					= $_FILES[$file_orName];
			$args_f['max_file_size'] 			= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			$args_f['image_h'] 					= 405;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_vd = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_vd				= $before_image_vd;
		}		
		$args['vd_thumb'] 		= $image_vd;		
		
		$rst = $C_Video -> Video_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");
		exit();
		
	break;
	case "VIDEO_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;			
		$dr_array = explode('/',$dr_info);
		if($vd_intro!="Y") $vd_intro = "N";
		$args = "";
		$args['vd_title'] 		= $vd_title;
		$args['vd_uid'] 		= $vd_uid;
		$args['vd_playtime'] 	= $vd_playtime;				
		$args['vd_content'] 	= $C_Func->enc_contents_edit($vd_content);
		$args['vd_intro_content'] 	= $C_Func->enc_contents_edit($vd_intro_content);
		$args['vd_dr_idx'] 		= $dr_array[0];
		$args['vd_dr_name'] 	= $dr_array[1];
		$args['vd_dr_position']	= $dr_array[2];
		$args['vd_dr_treat']	= $dr_array[3];
		$args['vd_gubun'] 		= $vd_gubun;
		$args['vd_intro'] 		= $vd_intro;
		$args['vd_tag'] 		= $vd_tag;
		$args['vd_order'] 		= $vd_order;
		//진료센터
		$vd_cn1 = "";
		if (is_array($vd_clinic1)) {
			foreach ($vd_clinic1 as $k => $v) {
				$vd_cn1 .= $v . ",";
			}
		}
		$vd_cn1 = rtrim($vd_cn1, ",");
		$args['vd_clinic1'] 	= $vd_cn1;
		//진료과목
		$vd_cn2 = "";
		if (is_array($vd_clinic2)) {
			foreach ($vd_clinic2 as $k => $v) {
				$vd_cn2 .= $v . ",";
			}
		}
		$vd_cn2 = rtrim($vd_cn2, ",");
		
		$args['vd_clinic2'] 	= $vd_cn2;
		
		//특수클리닉
		$vd_cn3 = "";
		if (is_array($vd_clinic3)) {
			foreach ($vd_clinic3 as $k => $v) {
				$vd_cn3 .= $v . ",";
			}
		}
		$vd_cn3 = rtrim($vd_cn3, ",");
		$args['vd_clinic3'] 	= $vd_cn3;
		
		$args['vd_link1'] 		= $vd_link1;
		$args['vd_link2'] 		= $vd_link2;
		
		//썸네일 이미지 업로드
		$file_orName			= "vd_thumb";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_VIDEO;
			$args_f['files'] 					= $_FILES[$file_orName];
			$args_f['max_file_size'] 			= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			$args_f['image_h'] 					= 405;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_vd = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_vd				= $before_image_vd;
		}		
		$args['vd_thumb'] 		= $image_vd;				
		$rst = $C_Video -> Video_Reg($args);
		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;

	
}
?>