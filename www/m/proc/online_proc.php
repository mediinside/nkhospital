<?php
	include_once("../../_init.php");
	include_once $GP -> CLS . 'class.online.php';
   	include_once($GP -> CLS."/class.mcc.php");	    
	$C_Online = new Online();
	$C_Mcc	 	= new Mcc;    	
	switch($_POST['mode']){	
		case "ONLINE_RESERVE_REG":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
			$rev_phone = str_replace("-","",$tor_rs_phone);
			$args = array();
			$args["rev_name"] = $tor_rs_name;
			$args["rev_phone"] = $rev_phone;
			$pint_no = $C_Mcc->MemberInfo($args);  
			$pint_no = ($pint_no) ? $pint_no["PTNT_NO"] : "0" ;
//			$memo = "메디인사이드에서 테스트 중입니다~~~~";
			if($pint_no == "0") {
				$args = "";
				$args['PHY_YMD'] 		= $day;
				$args['PHY_TIME'] 		= $time;
				$args['PHY_EMPL_NO']	= $dr_mcode;
				$mp_no = $C_Mcc->ResCheck($args);
				if($mp_no) {
					 $pint_no = -$mp_no;
				}
			}
			
			$args = "";
			$args['DUTY_GB'] 		= "01";
			$args['PHY_YMD'] 		= $day;
			$args['PHY_TIME'] 		= $time;
			$args['PHY_EMPL_NO']	= $dr_mcode;
			$args['PTNT_NO'] 		= $pint_no;
			$args['RECEPT_NO'] 		= "-1";
			$args['IO_GB'] 			= "99";
			$args['PTNT_NM_INFO'] 	= $tor_rs_name;
			$args['ENT_EMPL_NO'] 	= "50311";
			$args['ENT_IP'] 		= $_SERVER["REMOTE_ADDR"];
			$args['PHONE_NO'] 		= $rev_phone;
			$args['MEMO'] 			= $memo;
			$args['PROC_GB'] 		= "00";
			$rst = $C_Mcc->MccReserveReg($args);   

			$args = "";
			$args['DUTY_GB'] 		= "01";
			$args['PHY_YMD'] 		= $day;
			$args['PHY_TIME'] 		= $time;
			$args['PHY_EMPL_NO'] 	= $dr_mcode;
			$args['PTNT_NO'] 		= $pint_no;
			$args['PTNT_NM'] 		= $tor_rs_name;
			$args['PHONE_NO'] 		= $rev_phone;
			$args['ORD_CD'] 		= "";
			$args['ORD_NM'] 		= "";						
			$args['SCOPE_GB'] 		= "";
			$args['MEMO'] 			= $memo;
			$rst = $C_Mcc->MccReserveRegDetail($args);   						
						
			$args = "";
			$args['tor_mb_code'] 		= $mb_code;
			$args['tor_rs_clinic'] 		= $c_type;
			$args['tor_rs_ptype'] 		= $ptype;
			//$args['tor_rs_date'] 		= $year."-".$month."-".$day;
			$args['tor_rs_date'] 		= date("Y-m-d", strtotime($day));
			$args['tor_rs_time'] 		= $time;
			$args['tor_rs_name'] 		= $tor_rs_name;
			$args['tor_rs_exam']		= $dr_ps;
			$args['tor_rs_doc']			= $dr_name;
			$args['tor_rs_phone']		= $tor_rs_phone;
			$args['tor_name']			= $tor_name;

			$rst = $C_Online->Online_Reserve_Reg($args);
			
			if($rst) {		
				//$C_Func->put_msg_and_go("예약 신청 완료 되었습니다.", "/m/res.process.04.html?ptype=$ptype");
				$C_Func->put_msg_and_go("예약 신청 완료 되었습니다.", "/m/res.history.html");				
				
				exit();
			}else{
				$C_Func->put_msg_and_go("예약 신청에 실패하였습니다", "/m/main.html");
				exit();
			}
	
		break;
	}
?>