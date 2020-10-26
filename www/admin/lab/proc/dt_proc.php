<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.doctor.php");
$C_Doctor 	= new Doctor;

//error_reporting(E_ALL);
//@ini_set("display_errors", 1);
	
switch($_POST['mode']){
	
		case 'DRL_AUTO_CH':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";		
			$args['tmp_id'] = $tmp_id;
			$args['max_desc'] = $max_desc;
			$rst = $C_Doctor->DRL_AUTO_CHAGE($args);
			
			echo "true";
			exit();
		break;
		
	
		case 'DRL_DESC':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";		
			$args['type'] = $type;
			$args['drl_idx'] = $drl_idx;
			$args['drl_desc'] = $desc;
			$rst = $C_Doctor->DRL_DESC_CHAGE($args);
			
			echo "true";
			exit();
		break;
	
	
		
	
	case "DRL_DEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['drl_idx'] = $drl_idx;
		$rst = $C_Doctor -> DRL_Del($args);

		echo "true";
		exit();
	break;
	
	case "DRL_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['drl_idx'] 			= $drl_idx;
		
		
	
		$args['drl_name'] 		= $drl_name;
			
		
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드	
		$file_orName			= "drl_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
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
		
		//사진 업로드
		$file_orName			= "dr_list_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 210;
			$args_f['image_h'] 					= 210;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_list = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_list				= $before_image_list;
		}
		
		
		
		
		$args['drl_face_img'] 	= $image_main;	
		$args['drl_main_view'] 	= $drl_main_view;	
		$args['drl_history'] 	= $C_Func->enc_contents_edit($drl_history);		
		$args['drl_history1'] 	= $C_Func->enc_contents_edit($drl_history1);		
		
		$rst = $C_Doctor -> DRL_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");
		exit();
		
	break;
	
	
	case "DRL_IMGDEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['drl_idx'] = $drl_idx;
		$args['type'] = $type;
		$rst = $C_Doctor -> DRL_ImgUpdate($args);

		@unlink($GP -> UP_DOCTOR . $file);

		echo "true";
		exit();
	break;
	
	
	case "DRL_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;			

		$args = "";
		
		
		
		
		
		$args['drl_name'] 			= $drl_name;
		
		
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드
		$file_orName			= "drl_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 280;
			$args_f['image_h'] 					= 400;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_main = $updata['new_file_name'];	//변경된 파일명
		}
		
		//사진 업로드
		$file_orName			= "drl_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_DOCTOR;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");
			$args_f['image_w'] 					= 210;
			$args_f['image_h'] 					= 210;

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_list = $updata['new_file_name'];	//변경된 파일명
		}
		
	
		
		$args['drl_face_img'] 	= $image_main;	
		$args['drl_main_view'] 	= $drl_main_view;	
		$args['drl_history'] 	= $C_Func->enc_contents_edit($drl_history);		
		$args['drl_history1'] 	= $C_Func->enc_contents_edit($drl_history1);		
	
		
		$rst = $C_Doctor -> DRL_Reg($args);
		
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;

	
}
?>