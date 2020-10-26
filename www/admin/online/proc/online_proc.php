<?php
	include_once("../../../_init.php");
	include_once $GP -> CLS . 'class.online.php';
	$C_Online = new Online();

	switch($_POST['mode']){	
	
		
		//온라인 예약처리
		case "ONLINE_RESERVE_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			$arg = "";
			$args['tor_idx'] 				= $tor_idx;
			$args['tor_rs_clinic'] 				= $tor_rs_clinic;
			$args['tor_rs_phone'] 				= $tor_rs_phone;
			$args['tor_rs_doc'] 				= $tor_rs_doc;
			$args['tor_rs_exam'] 				= $tor_rs_exam;
			$args['tor_rs_type'] 			= $tor_rs_type;
			$args['tor_rs_result_date'] 		= $tor_rs_result_date;	
			$args['tor_rs_result_content'] = base64_decode($tor_rs_result_content);
			
	//		echo  $tor_rs_phone."-".$tor_rs_phone2."-".$tor_rs_phone3;
			
			$rst = $C_Online -> Online_Reserve_Result($args);	
	/*		
		if($tor_rs_type =="Y") {
				include_once($GP -> CLS."class.sms.php");
				$C_Sms 	= new Sms;
				
				$send_mobile = $tor_rs_phone;
				$send_num = "1";
			// $tor_rs_doc $tor_rs_exam $tor_rs_date $tor_rs_time
				
				$msg = "뉴고려병원 ".$tor_rs_clinic." ".$tor_rs_doc." ".$tor_rs_exam." ".$tor_rs_date." ".$tor_rs_time;
				
				//보낼 데이터
				$data = array(
					'type' => 'send',
					'msg' => $msg,    
					'sm_to' => $send_mobile,
					'destination' => '',
					'sm_from1' => $GP -> SMS_HP1,
					'sm_from2' => $GP -> SMS_HP2,
					'sm_from3' => $GP -> SMS_HP3,
					'send_date' => '',
					'send_time' => '',
					'returnurl' => '',
					'testflag' => 'N',			//Y:실방송 N:테스트발송
					'repeatFlag' => '',
					'repeatNum' => '1',
					'repeatTime' => '15',			
					'send_num' => $send_num,
					'return_type' => 'json',			
					'login_id' => $GP -> SMS_ID,			
					'login_pwd' => $GP -> SMS_PWD	
				);	
				$result = $C_Func->post_request('http://mediinside.co.kr/api/sms_api.php', $data); 
			}		
		*/
			$C_Func->put_msg_and_modalclose("처리 되었습니다");		
			exit();
			
		
		break;
		
		
		
		//온라인 예약처리
		case "ONLINE_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			$arg = "";
			$args['tor_idx'] 				= $tor_idx;
			$args['tor_rs_phone'] 				= $tor_rs_phone1."-".$tor_rs_phone2."-".$tor_rs_phone3;
			
			$rst = $C_Online -> Online_MODI($args);	

			$C_Func->put_msg_and_go("예약 신청 완료 되었습니다.","/m/res.history.html");	
				
			exit();
		break;
		
		
		
		//온라인 예약삭제
		case "ONLINE_RESERVE_DEL" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			$args = "";
			$args['tor_idx'] = $tor_idx;
			$rst = $C_Online -> Online_Reserve_Del($args);
			
			echo "true";
			exit();
		break;
		
		case "ONLINE_RESERVE_REG":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
			
			$args = "";
			$args['tor_mb_code'] 		= $mb_code;
			$args['tor_rs_clinic'] 		= $c_type;
			$args['tor_rs_ptype'] 		= $ptype;
			$args['tor_rs_date'] 		= $year."-".$month."-".$day;
			$args['tor_rs_time'] 		= $time;
			$args['tor_rs_name'] 		= $tor_rs_name;
			$args['tor_rs_exam']		= $dr_ps;
			$args['tor_rs_doc']			= $dr_name;
			$args['tor_rs_phone']		= $tor_rs_phone;
			$args['tor_name']			= $tor_name;

			$rst = $C_Online->Online_Reserve_Reg($args);
			
			if($rst) {		
				$C_Func->put_msg_and_go("예약 신청 완료 되었습니다.", "/m/res.process.04.html?ptype=$ptype");
				exit();
			}else{
				$C_Func->put_msg_and_go("예약 신청에 실패하였습니다", "/m/main.html");
				exit();
			}
	
		break;
		
		//시간설정		
	
		case "TIME_REG":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
			
			
			$args = "";
			$args['trs_idx'] 			= $trs_idx;
			$args['dr_clinic1'] 		= $dr_clinic1;
			$args['trs_time_gap'] 		= $trs_time_gap;
			$args['trs_reg_id'] 		= $trs_reg_id;
			
			$rst1 = $C_Online -> CN_DobuleCheck($args);
      
			if($rst1) {
				if($rst1['cnt'] > 0){
					$C_Func->put_msg_and_back("다른 센터를 선택해주세요.");
					exit();
				}
			  }
			  
			$rst = $C_Online->ReserveSch_Reg($args);
			
			if($rst) {	
				$C_Func->put_msg_and_modalclose("등록 되었습니다.");
				exit();
			}else{
				$C_Func->put_msg_and_modalclose("등록에 실패하였습니다.");
				exit();
			}
	
		break;
		
		
		
		case "ONLINE_TIME_MODI" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
			$args = "";
			$args['trs_idx'] 			= $trs_idx;
			$args['dr_clinic1'] 		= $dr_clinic1;
			$args['trs_time_gap'] 		= $trs_time_gap;
			$args['trs_mod_id'] 		= $trs_mod_id;
		
			$rst = $C_Online -> ReserveSch_Modi($args);
			
			$C_Func->put_msg_and_modalclose("수정 되었습니다");
			exit();
			
		break;
	
	
	//온라인 예약삭제
		case "ONLINE_TIME_DEL" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			$args = "";
			$args['trs_idx'] = $trs_idx;
			$rst = $C_Online -> Online_TIME_Del($args);
			
			echo "true";
			exit();
		break;	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>