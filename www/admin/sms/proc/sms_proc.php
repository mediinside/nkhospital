<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.sms.php");
$C_Sms 	= new Sms;


switch($_POST['mode']){
	
	case "SMS_STEUP_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$args['tss_name'] = $tss_name;
			$args['tss_moible'] = $tss_mobile;
			$rst = $C_Sms -> Sms_Setup_Reg($args);
			
			$C_Func->put_msg_and_go("설정 되었습니다","../sms_setup.php?tab=1");		
			exit();
	break;
	
	case "SMS_STEUP_MODI":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;			

			$args = "";
			$args['tss_idx'] = $tss_idx;
			$args['tss_name'] = $tss_name;
			$args['tss_moible'] = $tss_mobile;
			$rst = $C_Sms -> Sms_Setup_Modi($args);
			
			$C_Func->put_msg_and_go("설정 되었습니다","../sms_setup.php?tab=1");		
			exit();
	break;
	
	case "MEM_MOVE":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$arr_val = explode(',', $chkval);
			
			for($i=0; $i < count($arr_val)-1; $i++)
			{
				$args['mb_code'] = $arr_val[$i];
				$args['gr_code'] = $group_code;
				$rst = $C_Sms -> Sms_Mem_Move($args);
			}
			
			echo "true";
			exit();
	break;
	
	case "MEM_DEL":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$args['mb_code'] = $mb_code;
			$rst = $C_Sms -> Sms_Mem_Del($args);
			
			echo "true";
			exit();
	break;
	
	case "MEM_MODI":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$args['mb_code'] = $mb_code;
			$args['mb_name'] = $mb_name;
			$args['mb_mobile'] = $mb_mobile;
			$rst = $C_Sms -> Sms_Mem_Modi($args);
			
			echo "true";
			exit();
	break;
	
	case "GROUP_DEL":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$args['gr_code'] = $group_code;
			$rst = $C_Sms -> Sms_Group_Del($args);

			
			echo "true";
			exit();
		
	break;
	
	case "GROUP_MOVE":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
			$args = "";
			$arr_val = explode(',', $chkval);
			
			for($i=0; $i < count($arr_val)-1; $i++)
			{
				$args['bf_gr_code'] =  $arr_val[$i];
				$args['gr_code'] = $group_code;
				$rst = $C_Sms -> Sms_Group_Move($args);
			}
			
			echo "true";
			exit();
		
	break;
	
	case "GROUP_MODI":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
		
		$args = '';		
		$args['gr_code'] = $group_code;
		$be_rst = $C_Sms->Sms_Group_info($args);
		
		if($be_rst['gr_name'] == rawurldecode($group_name)){
			echo "true";
			exit();
		}else{
			$args['gr_name'] = rawurldecode($group_name);
			$rst1 = $C_Sms->Sms_Chk_Group($args);
			
			if($rst1['cnt'] > 0) {
				echo "false1";
				exit();
			}
			
			$rst = $C_Sms -> Sms_Group_Modi($args);
		
			
			echo "true";
			exit();
			
		}
		
	
		
	break;
	
	case "GROUP_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
		$args = '';
		$args['gr_name'] = rawurldecode($group_name);
		$rst1 = $C_Sms->Sms_Chk_Group($args);
		
		if($rst1['cnt'] > 0) {
			echo "false1";
			exit();
		}
				
		$rst = $C_Sms -> Sms_Group_Reg($args);
		
		if($rst) {
			echo "true";
			exit();
		}else{
			echo "false";
			exit();
		}		
			
	break;
	
	case "SMS_SEND" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		if($txtReceiver != "")
		{
			$receiver_phone = $txtReceiver;
			$send_num = 1;
		}else{
			$receiver_phone = $phone;
			$Arr_receiver = explode(";", $phone);
			$send_num = count($Arr_receiver);
		}
		
		$arr_s_user = explode('-', $txtSender);
		
		//보낼 데이터
		$data = array(
			'type' => 'send',
			'msg' => $txtContent,    
			'sm_to' => $receiver_phone,
			'destination' => '',
			'sm_from1' => $arr_s_user[0],
			'sm_from2' => $arr_s_user[1],
			'sm_from3' => $arr_s_user[2],
			'send_date' => $txtdate,
			'send_time' => $txttime,
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
		
		// Send a request to example.com 
		$result = $C_Func->post_request('http://mediinside.co.kr/api/sms_api.php', $data); 
		
		if ($result['status'] == 'ok'){ 
			$re_msg = $result['content'];			
			$obj_result = json_decode($re_msg); 	
			
			$arr = array('msg'=> $obj_result->msg, 'error' => $obj_result->error);
			echo json_encode($arr);
			exit();			
		} else { 
			$arr = array('msg'=>'false', 'error' => $result['error']);
			echo json_encode($arr);
			exit();			
		} 
			
	break;
	
}
?>