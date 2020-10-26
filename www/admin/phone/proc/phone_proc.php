<?php
	include_once("../../../_init.php");
	include_once $GP -> CLS . 'class.online.php';
	$C_Online = new Online();

	switch($_POST['mode']){		
		
		//전화 상담 삭제
		case "Phone_DEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			$args = "";
			$args['tfc_idx'] = $tfc_idx;
			$rst = $C_Online -> Phone_Consel_Del($args);
			
			echo "true";
			exit();
		break;
		
		//전화 상담 처리
		case "Phone_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			$arg = "";
			$args['tfc_idx'] 				= $tfc_idx;
			$args['tfc_result'] 			= $tfc_result;
			$args['tfc_rt_date'] 		= $tfc_rt_date;		
			
			$safe = new HTML_Safe; // xss filter 객체 생성
			$input = base64_decode($tfc_result_con); 
			$output = $safe->parse($input); // html 태그를 필터링 하여 $output에 대입			
			$tfc_result_con = $C_Func->enc_contents($output);			
			$args['tfc_result_con'] = $tfc_result_con;
			$rst = $C_Online -> Phone_Consel_Result($args);		

			$C_Func->put_msg_and_modalclose("처리 되었습니다");		
			exit();
		break;
		
			case "PS_REG":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
      

			$now_date = date('Y-m-d H:i:s');
            $tfc_mobile =  $mb_mobile1 . "-" . $mb_mobile2 . "-" . $mb_mobile3;

			$args = '';
			$args['tfc_type']		= $tfc_type;
			$args['mb_code']		= $_SESSION['susercode'];
			$args['tfc_name']		= $mb_name;
			$args['tfc_mobile']		= $tfc_mobile;
//			$rst1 = $C_Online -> Phone_Chk_List($args);

	/*		if($rst1) {
				$check_date = $rst1['tfc_regdate'];
				$time_go =  $C_Func->datetimediff($check_date, null, "min");

				if($time_go < 30) {
				  $C_Func->put_msg_and_back("상담 요청을 하신지 30분이 지나지 않았습니다. 기다려주시거나 30분후에 재문의 해주세요");
				  exit();
				}
			}
*/
			$rst = $C_Online -> Phone_Counsel_Reg($args); 

			if($rst) {
				$C_Func->put_msg_and_go("상담 신청 되었습니다.", "/m/res.easy.html");				
				exit();
			}else{
				$C_Func->put_msg_and_go("상담 신청에 실패하였습니다", "/m/res.easy.html");
				exit();
			} 
    	break;
    
		
		
		
	}
?>