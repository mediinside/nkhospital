<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.doctor.php");
$C_Doctor 	= new Doctor;


switch($_POST['mode']){
	
		case 'DT_AUTO_CH':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";		
			$args['tmp_id'] = $tmp_id;
			$args['max_desc'] = $max_desc;
			$rst = $C_Doctor->DT_AUTO_CHAGE($args);
			
			echo "true";
			exit();
		break;
	
		case 'DT_DESC':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";		
			$args['type'] = $type;
			$args['dr_idx'] = $dr_idx;
			$args['dr_desc'] = $desc;
			$rst = $C_Doctor->DT_DESC_CHAGE($args);
			
			echo "true";
			exit();
		break;
	
	
		case "BOOK_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			include_once($GP->CLS."class.fileup.php");
			
			//메인페이지 이미지 업로드
			$file_orName			= "tb_file";
			$is_fileName			= $_FILES[$file_orName]['name'];
			$insertFileCheck	= false;
			if ($is_fileName) {
				$args_f = "";
				$args_f['forder'] 					= $GP -> UP_BOOK;
				$args_f['files'] 						= $_FILES[$file_orName];
				$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
				$args_f['able_file'] 				= array();
	
				$C_Fileup = new Fileup($args_f);
				$updata		= $C_Fileup -> fileUpload();
	
				if ($updata['error']) 
					$insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
			}else{
				$image_main = $before_image_main;
			}
			
			if($insertFileCheck) {
				$C_Func->put_msg_and_modalclose($updata['error']);
			}
			
			$file_save_path = $GP -> UP_BOOK;
			//에디터
			if($img_full_name != "") {
				$Arr_img = explode(',', $img_full_name);	
				$img_name = "";
				for	($i=0; $i<count($Arr_img); $i++) {		
					if(ereg($C_Func->escape_ereg($Arr_img[$i]), $C_Func->escape_ereg($tb_content))) {		
						$img_name .= trim($Arr_img[$i]) . ",";		
					}else{
						@unlink($file_save_path . $Arr_img[$i]);
					}
				}
				$img_name = rtrim($img_name , ",");
			}
			
			$args = "";
			$args['tb_idx'] 			= $tb_idx;
			$args['dr_idx'] 			= $dr_idx;
			$args['tb_title'] 			= $tb_title;		
			$args['tb_content'] 		= $C_Func->enc_contents($tb_content);
			$args['tb_file_code'] 	= $image_main;
			$args['tb_editor_code'] = $img_name;
			$rst = $C_Doctor -> Book_Modi($args);	

			$C_Func->put_msg_and_modalclose("수정 되었습니다");
			exit();
		break;
	
	
		case "BOOK_IMGDEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";
			$args['tb_idx'] = $tb_idx;
			$rst = $C_Doctor -> Book_ImgUpdate($args);
	
			@unlink($GP -> UP_BOOK . $tb_file);
	
			echo "true";
			exit();
		break;
	
		case "BOOK_DEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";
			$args['tb_idx'] = $tb_idx;
			$rst = $C_Doctor -> Book_Del($args);
	
			echo "true";
			exit();
		break;
	
		case "BOOK_REG" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			include_once($GP->CLS."class.fileup.php");
			
			//메인페이지 이미지 업로드
			$file_orName			= "tb_file";
			$is_fileName			= $_FILES[$file_orName]['name'];
			$insertFileCheck	= false;
			if ($is_fileName) {
				$args_f = "";
				$args_f['forder'] 					= $GP -> UP_BOOK;
				$args_f['files'] 						= $_FILES[$file_orName];
				$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
				$args_f['able_file'] 				= array();
	
				$C_Fileup = new Fileup($args_f);
				$updata		= $C_Fileup -> fileUpload();
	
				if ($updata['error']) 
					$insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
			}
			
			if($insertFileCheck) {
				$C_Func->put_msg_and_modalclose($updata['error']);
			}
			
			$file_save_path = $GP -> UP_BOOK;
			//에디터
			if($img_full_name != "") {
				$Arr_img = explode(',', $img_full_name);	
				$img_name = "";
				for	($i=0; $i<count($Arr_img); $i++) {		
					if(ereg($C_Func->escape_ereg($Arr_img[$i]), $C_Func->escape_ereg($tb_content))) {		
						$img_name .= trim($Arr_img[$i]) . ",";		
					}else{
						@unlink($file_save_path . $Arr_img[$i]);
					}
				}
				$img_name = rtrim($img_name , ",");
			}
			
			$args = "";
			$args['dr_idx'] 			= $dr_idx;
			$args['tb_title'] 			= $tb_title;		
			$args['tb_content'] 		= $C_Func->enc_contents($tb_content);
			$args['tb_file_code'] 	= $image_main;
			$args['tb_editor_code'] = $img_name;
			$rst = $C_Doctor -> Book_Reg($args);
	
			if($rst) {
				$C_Func->put_msg_and_modalclose("등록 되었습니다");
			}else{
				$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
			}
	break;
	
	case "DOCTOR_DEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['dr_idx'] = $dr_idx;
		$rst = $C_Doctor -> Doctor_Del($args);

		echo "true";
		exit();
	break;
	
	case "DOCTOR_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['dr_idx'] 		= $dr_idx;
		$args['dr_name'] 		= $dr_name;
		$args['dr_mcode'] 		= $dr_mcode;
		$args['dr_mtreat_no'] 	= $dr_mtreat_no;				
		$args['dr_position'] 	= $dr_position;
		$args['dr_vd_link1'] 	= $dr_vd_link1;
		$args['dr_vd_link2'] 	= $dr_vd_link2;
		$args['dr_vd_uid'] 		= $dr_vd_uid;
		$args['dr_vd_playtime'] 	= $dr_vd_playtime;				
		
		//진료과목
		$dr_cn1 = "";
		if (is_array($dr_clinic1)) {
			foreach ($dr_clinic1 as $k => $v) {
				$dr_cn1 .= $v . ",";
			}
		}
		$dr_cn1 = rtrim($dr_cn1, ",");
		
		$args['dr_clinic1'] 	= $dr_cn1;
		
				
		//진료센터
		$dr_cn2 = "";
		if (is_array($dr_clinic2)) {
			foreach ($dr_clinic2 as $k => $v) {
				$dr_cn2 .= $v . ",";
			}
		}
		$dr_cn2 = rtrim($dr_cn2, ",");
		
		$args['dr_clinic2'] 	= $dr_cn2;
		
		//특수클리닉
		$dr_cn3 = "";
		if (is_array($dr_clinic3)) {
			foreach ($dr_clinic3 as $k => $v) {
				$dr_cn3 .= $v . ",";
			}
		}
		$dr_cn3 = rtrim($dr_cn3, ",");
		
		$args['dr_clinic3'] 	= $dr_cn3;
		
		
		//오전일정
		$dr_cn4 = "";
		if (is_array($dr_m_sd)) {
			foreach ($dr_m_sd as $k => $v) {
				$dr_cn4 .= $v . ",";
			}
		}
		$dr_cn4 = rtrim($dr_cn4, ",");
		
		$args['dr_m_sd'] 	= $dr_cn4;
		
		
		//오후일정
		$dr_cn5 = "";
		if (is_array($dr_a_sd)) {
			foreach ($dr_a_sd as $k => $v) {
				$dr_cn5 .= $v . ",";
			}
		}
		$dr_cn5 = rtrim($dr_cn5, ",");
		
		$args['dr_a_sd'] 			= $dr_cn5;
		
		
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드
		$file_orName			= "dr_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 280;
			$args_f['image_h'] 					= 300;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_main				= $before_image_main;
		}
		
		
		//상세 이미지 업로드
		$file_orName			= "dr_detail_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 600;
			$args_f['image_h'] 					= 400;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_detail = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_detail				= $before_image_detail;
		}
		
		//상세 모바일 업로드
		$file_orName			= "dr_mobile_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 320;
			$args_f['image_h'] 					= 440;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_mobile = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_mobile				= $before_image_mobile;
		}	
		
		//상세 모바일 업로드
		$file_orName			= "dr_face_s_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_face_s = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_face_s				= $before_image_face_s;
		}			
		
		//상세 배경 업로드
		$file_orName			= "dr_bg_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 					= $_FILES[$file_orName];
			$args_f['max_file_size'] 			= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			//$args_f['image_h'] 					= 400;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_bg = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_bg				= $before_image_bg;
		}		
		
		//영상 썸네일 업로드
		$file_orName			= "dr_thumb_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 					= $_FILES[$file_orName];
			$args_f['max_file_size'] 			= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			$args_f['image_h'] 					= 405;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_thumb = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_thumb				= $before_image_thumb;
		}			
		
		$args['dr_face_img'] 	= $image_main;
		$args['dr_detail_img'] 	= $image_detail;
		$args['dr_mobile_img'] 	= $image_mobile;		
		$args['dr_face_s_img'] 	= $image_face_s;				
		$args['dr_bg_img'] 		= $image_bg;
		$args['dr_thumb_img']   = $image_thumb;						
		$args['dr_qa_show'] 	= $dr_qa_show;
		$args['dr_mobile'] 		= $dr_mobile;
		$args['dr_time_gap'] 	= $dr_time_gap;
		$args['dr_treat'] 		= $C_Func->enc_contents_edit($dr_treat);
		$args['dr_history'] 	= $C_Func->enc_contents_edit($dr_history);
		$args['dr_academy'] 	= $C_Func->enc_contents_edit($dr_academy);		
		$args['dr_book'] 		= $C_Func->enc_contents_edit($dr_book);		
		$args['dr_greeting_title']	= $C_Func->enc_contents_edit($dr_greeting_title);		
		$args['dr_greeting']	= $C_Func->enc_contents_edit($dr_greeting);		
		$args['dr_gita'] 		= $C_Func->enc_contents_edit($dr_gita);
		
		$rst = $C_Doctor -> Doctor_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");
		exit();
		
	break;
	
	
	case "DOCTOR_IMGDEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['dr_idx'] = $dr_idx;
		$args['type'] = $type;
		$rst = $C_Doctor -> Doctor_ImgUpdate($args);

		@unlink($GP -> UP_DOCTOR . $file);

		echo "true";
		exit();
	break;
	
	
	case "DOCTOR_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;			

		$args = "";
		$args['dr_name'] 			= $dr_name;
		$args['dr_mcode'] 		= $dr_mcode;
		$args['dr_mtreat_no'] 	= $dr_mtreat_no;				
		$args['dr_position'] 	= $dr_position;
		$args['dr_vd_link1'] 	= $dr_vd_link1;
		$args['dr_vd_link2'] 	= $dr_vd_link2;
		$args['dr_vd_uid'] 		= $dr_vd_uid;
		$args['dr_vd_playtime'] 	= $dr_vd_playtime;				
		
		//진료과목
		$dr_cn1 = "";
		if (is_array($dr_clinic1)) {
			foreach ($dr_clinic1 as $k => $v) {
				$dr_cn1 .= $v . ",";
			}
		}
		$dr_cn1 = rtrim($dr_cn1, ",");
		
		$args['dr_clinic1'] 	= $dr_cn1;
		
				
		//진료센터
		$dr_cn2 = "";
		if (is_array($dr_clinic2)) {
			foreach ($dr_clinic2 as $k => $v) {
				$dr_cn2 .= $v . ",";
			}
		}
		$dr_cn2 = rtrim($dr_cn2, ",");
		
		$args['dr_clinic2'] 	= $dr_cn2;
		
		//특수클리닉
		$dr_cn3 = "";
		if (is_array($dr_clinic3)) {
			foreach ($dr_clinic3 as $k => $v) {
				$dr_cn3 .= $v . ",";
			}
		}
		$dr_cn3 = rtrim($dr_cn3, ",");
		
		$args['dr_clinic3'] 	= $dr_cn3;
		
		
		//오전일정
		$dr_cn4 = "";
		if (is_array($dr_m_sd)) {
			foreach ($dr_m_sd as $k => $v) {
				$dr_cn4 .= $v . ",";
			}
		}
		$dr_cn4 = rtrim($dr_cn4, ",");
		
		$args['dr_m_sd'] 	= $dr_cn4;
		
		
		//오후일정
		$dr_cn5 = "";
		if (is_array($dr_a_sd)) {
			foreach ($dr_a_sd as $k => $v) {
				$dr_cn5 .= $v . ",";
			}
		}
		$dr_cn5 = rtrim($dr_cn5, ",");
		
		$args['dr_a_sd'] 			= $dr_cn5;
		
	
		
		
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드
		$file_orName			= "dr_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 280;
			$args_f['image_h'] 					= 300;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
		}
		
		
		//상세 이미지 업로드
		$file_orName			= "dr_detail_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 600;
			$args_f['image_h'] 					= 400;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_detail = $updata['new_file_name'];	//변경된 파일명
		}
		
		//상세 모바일 업로드
		$file_orName			= "dr_mobile_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 320;
			$args_f['image_h'] 					= 440;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_mobile = $updata['new_file_name'];	//변경된 파일명
		}
		
		//상세 모바일 업로드
		$file_orName			= "dr_face_s_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_face_s = $updata['new_file_name'];	//변경된 파일명
		}		

		//상세 배경 업로드
		$file_orName			= "dr_bg_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			//$args_f['image_h'] 					= 400;*/

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_bg = $updata['new_file_name'];	//변경된 파일명
		}	
		
		//상세 배경 업로드
		$file_orName			= "dr_thumb_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 720;
			$args_f['image_h'] 					= 405;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_thumb = $updata['new_file_name'];	//변경된 파일명
		}				
				
		$args['dr_face_img'] 	= $image_main;
		$args['dr_detail_img'] 	= $image_detail;
		$args['dr_mobile_img'] 	= $image_mobile;
		$args['dr_face_s_img'] 	= $image_face_s;						
		$args['dr_bg_img'] 		= $image_bg;
		$args['dr_thumb_img']   = $image_thumb;											
		$args['dr_qa_show'] 	= $dr_qa_show;
		$args['dr_mobile'] 		= $dr_mobile;
		$args['dr_time_gap'] 	= $dr_time_gap;
		$args['dr_treat'] 		= $C_Func->enc_contents_edit($dr_treat);
		$args['dr_history'] 	= $C_Func->enc_contents_edit($dr_history);
		$args['dr_academy'] 	= $C_Func->enc_contents_edit($dr_academy);
		$args['dr_book'] 		= $C_Func->enc_contents_edit($dr_book);	
		$args['dr_greeting_title']	= $C_Func->enc_contents_edit($dr_greeting_title);		
		$args['dr_greeting'] 	= $C_Func->enc_contents_edit($dr_greeting);			
		$args['dr_gita'] 		= $C_Func->enc_contents_edit($dr_gita);
		$rst = $C_Doctor -> Doctor_Reg($args);
		
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;

	
}
?>