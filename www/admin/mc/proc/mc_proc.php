<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.machine.php");
$C_Machine 	= new Machine;


switch($_POST['mode']){	
	
	case 'MC_AUTO_CH':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";		
			$args['tmp_id'] = $tmp_id;
			$args['max_desc'] = $max_desc;
			$rst = $C_Machine->MC_AUTO_CHAGE($args);
			
			echo "true";
			exit();
	break;
	
	
	case 'MC_MODI':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tmc_type'] 				= $tmc_type;
		$args['tmc_title'] 				= addslashes($tmc_title);
		$args['tmc_model'] 				= addslashes($tmc_model);
		$args['tmc_content'] 			= $C_Func->enc_contents_edit($tmc_content);

		include_once($GP->CLS."class.fileup.php");

		//메인페이지 이미지 업로드
		$file_orName			= "tmc_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_MACHINE;
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

		$args['tmc_img'] 				= $image_main;
		$args['tmc_idx'] 				= $tmc_idx;

		$rst = $C_Machine -> MC_Modi($args);

		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;

	
	case 'MC_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tmc_idx'] 	= $tmc_idx;		
		$rst = $C_Machine ->MC_Info($args);

		if($rst) {
			$file = $rst['tmc_img'];
			@unlink($GP -> UP_MACHINE . $file);
		}
		$rst1 = $C_Machine -> MC_Del($args);	
		
		echo "true";
		exit();
	
	break;

	case "MC_IMGDEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";
			$args['tmc_idx'] = $tmc_idx;
			$rst = $C_Machine -> MC_ImgUpdate($args);
	
			@unlink($GP -> UP_MACHINE . $file);
	
			echo "true";
			exit();
		break;
	
	
	case 'MC_REG':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tmc_type'] 				= $tmc_type;
		$args['tmc_title'] 				= addslashes($tmc_title);
		$args['tmc_model'] 				= addslashes($tmc_model);
		$args['tmc_content'] 			= $C_Func->enc_contents_edit($tmc_content);

		include_once($GP->CLS."class.fileup.php");

		//메인페이지 이미지 업로드
		$file_orName			= "tmc_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_MACHINE;
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

		$args['tmc_img'] 				= $image_main;

		$rst = $C_Machine -> MC_Reg($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
		exit();
	break;
	
}
?>