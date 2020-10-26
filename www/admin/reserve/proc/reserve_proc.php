<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.reserve.php");
$C_Reserve 	= new Reserve;


switch($_POST['mode']){
	
	
	case "CAPA_DAY_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
		$args = '';
		$args['cp_s_time'] = $cp_s_time;
		$args['cp_e_time']  = $cp_e_time;		
		$args['cp_num']  = $cp_num;		
		$args['cp_idx']  = $cp_idx;	
		$rst = $C_Reserve -> Cappa_Info_Modi($args);
		
		echo "true";	
		exit();
		
	break;
	
	//예약 결과
	case "RSDATA": 
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = '';
		$args['s_date'] = $s_date;
		$args['e_date'] = $e_date;
		$rst = $C_Reserve ->Reserve_Average($args);	
		
		$arr = array('msg'=>'true', 'rs1'=>$rst['rs1'], 'rs2'=>$rst['rs2'], 'rs3'=>$rst['rs3'], 'rs4'=>$rst['rs4'], 'rs5'=>$rst['rs5'], 'rs6'=>$rst['rs6'], 'rs7'=>$rst['rs7'], 'rs8'=>$rst['rs8']);
		$str = json_encode($arr);
		echo $str;
	break;
	
	case "MEM_RESERVE_RESULT" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['mr_idx'] 	= $mr_idx;
		$args['status'] 	= $status;
		$args['mb_code'] 	= $mb_code;
		$args['pd_idx'] 	= $pd_idx;
		$result = $C_Reserve ->Mem_Reserve_Result_Adm($args);		
		
		echo "true";
		exit();
	break;
	
	
	case "MEM_RESERVE_DEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['mr_idx'] 	= $mr_idx;
		$result = $C_Reserve ->Mem_Reserve_Del_Adm($args);		
		
		echo "true";
		exit();
	
	break;
	
	case "MEM_PD_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v; 		
		
		$args = '';
		$args['mp_idx'] 		= $mp_idx;
		$args['ts_idx'] 		= $ts_idx;
		$args['hp_idx'] 		= $hp_idx;
		$args['mb_code'] 		= $mb_code;
		$args['pd_idx'] 		= $pd_idx;
		$args['mp_buy_num'] 	= $mp_buy_num;
		$args['mp_buy_price'] 	= $mp_buy_price;
		$args['mp_buy_date']	= $mp_buy_date;
		$args['mp_use_num']		= $mp_use_num;
		$rst = $C_Reserve->Mem_PD_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;
	
	
	case "MEM_PD_REG" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v; 		
		
		$args = '';
		$args['ts_idx'] 		= $ts_idx;
		$args['hp_idx'] 		= $hp_idx;
		$args['mb_code'] 		= $mb_code;
		$args['pd_idx'] 		= $pd_idx;
		$args['mp_buy_num'] 	= $mp_buy_num;
		$args['mp_buy_price'] 	= $mp_buy_price;
		$args['mp_buy_date']	= $mp_buy_date;
		$rst = $C_Reserve->Mem_PD_Reg($args);
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("적용 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;
	
	
	//상품군 가져오기
	case "TREATPRODUCT_SEL" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v; 
		
		$args = "";
		$args['ts_idx'] = $ts_idx;	
		$args['hp_idx'] = $_SESSION['adminhpidx'];
		$rst = $C_Reserve -> Treat_PD_List($args);	
		
		$html = "<option value=''>::: 선택 :::</option>";			
		for($i=0; $i<count($rst); $i++) {
			if($pd_idx == $rst[$i]['pd_idx']) {
				$html .= "<option value='" . $rst[$i]['pd_idx'].":".$rst[$i]['pd_name'] . "' selected>" . $rst[$i]['pd_name'] . "</option>";
			}else{
				$html .= "<option value='" . $rst[$i]['pd_idx'].":".$rst[$i]['pd_name'] . "'>" . $rst[$i]['pd_name'] . "</option>";
			}
			
		}
		
		echo $html;
		exit();
	break;
	
	case 'TREATPRODUCT_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['pd_idx'] 	= $pd_idx;
		$result = $C_Reserve ->Treat_PD_Del($args);		
		
		echo "true";
		exit();
	
	break;
	
	case 'TREATPRODUCT_MODI':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
		$args = '';
		$args['ts_idx'] = $ts_idx;
		$args['hp_idx'] = $hp_idx;
		$args['pd_idx'] = $pd_idx;
		$args['pd_name'] = $pd_name;
		$args['pd_capanum'] = $pd_capanum;
		$rst = $C_Reserve->Treat_PD_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;
	
	case 'TREATPRODUCT_REG' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
		$args = '';
		$args['ts_idx'] = $ts_idx;
		$args['hp_idx'] = $hp_idx;
		$args['pd_name'] = $pd_name;
		$args['pd_capanum'] = $pd_capanum;
		$rst = $C_Reserve->Treat_PD_Reg($args);
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("적용 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;
	
	
	case 'TREAT_DATA_CK':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
		
		$args = '';
		$args['ts_idx'] = $ts_idx;
		$args['cp_date'] = $s_date;
		$rst = $C_Reserve->Treat_Capa_Data_Chk($args);		
		if($rst['cnt'] > 0) {
			echo "sdate_fail";
			exit();
		}		
		$args['e_date'] = $e_date;
		$rst = $C_Reserve->Treat_Capa_Data_Chk($args);
		if($rst['cnt'] > 0) {
			echo "edate_fail";
			exit();
		}
		
		echo "true";
		exit();
	break;
	
	
	case 'TREATOPTION_SET' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
		
		//print_r($_POST);		
		
		$day_cnt = $C_Func->request_day($s_date, $e_date);		
			
		
		
		for($i=0; $i<=$day_cnt; $i++) {
			$date = $C_Func->request_term_day($s_date , $i);			
			$day = $C_Func->DayWeekChange($date);			
			
			//요일에 따라 값 등록
			if($day == "일") {
				for($j=0; $j<$sun_cnt; $j++) {	
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'sun_sdate_'.$j};
					$args['cp_e_time'] =  ${'sun_edate_'.$j};
					$args['cp_num'] = ${'sun_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "월") {
				for($j=0; $j<$mon_cnt; $j++) {	
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'mon_sdate_'.$j};
					$args['cp_e_time'] =  ${'mon_edate_'.$j};
					$args['cp_num'] = ${'mon_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "화") {
				for($j=0; $j<$tue_cnt; $j++) {	
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;					
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'tue_sdate_'.$j};
					$args['cp_e_time'] =  ${'tue_edate_'.$j};
					$args['cp_num'] = ${'tue_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "수") {
				for($j=0; $j<$wed_cnt; $j++) {
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'wed_sdate_'.$j};
					$args['cp_e_time'] =  ${'wed_edate_'.$j};
					$args['cp_num'] = ${'wed_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "목") {
				for($j=0; $j<$thu_cnt; $j++) {	
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'thu_sdate_'.$j};
					$args['cp_e_time'] =  ${'thu_edate_'.$j};
					$args['cp_num'] = ${'thu_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "금") {
				for($j=0; $j<$fri_cnt; $j++) {		
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'fri_sdate_'.$j};
					$args['cp_e_time'] =  ${'fri_edate_'.$j};
					$args['cp_num'] = ${'fri_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
			
			//요일에 따라 값 등록
			if($day == "토") {
				for($j=0; $j<$sat_cnt; $j++) {	
					$args = '';
					$args['hp_idx'] = $hp_idx;
					$args['ts_idx'] = $ts_idx;
					$args['so_idx'] = $so_idx;
					$args['cp_date'] = $date;
					$args['cp_day'] = $day;
					$args['cp_s_time'] =  ${'sat_sdate_'.$j};
					$args['cp_e_time'] =  ${'sat_edate_'.$j};
					$args['cp_num'] = ${'sat_capa_'.$j};
					$rst = $C_Reserve->Treat_Capa_Reg($args);
				}
			}
		}
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("적용 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;
	
	
	case 'TREATOPTION_REG' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
		
		//print_r($_POST);
		
		//exit();
		
		
		$args = '';
		$args['ts_idx'] = $ts_idx;
		$args['hp_idx'] = $hp_idx;
		$args['so_apply_sdate'] = $so_apply_sdate;
		$args['so_apply_edate'] = $so_apply_edate;
		
		$tmp_str = "";
		foreach($so_week_holiday as $key => $val) {			
			$tmp_str .= $val .",";
		}
		$tmp_str = rtrim($tmp_str, ",");		
		$args['so_week_holiday'] = $tmp_str;
		
		$args['so_doctornum_sun'] = $so_doctornum_sun;
		$args['so_rsinterval_sun'] = $so_rsinterval_sun;
		$args['so_work_stime_sun'] = $so_work_stime_sun;
		$args['so_work_etime_sun'] = $so_work_etime_sun;
		$args['so_ext_stime_sun'] = $so_ext_stime_sun;
		$args['so_ext_etime_sun'] = $so_ext_etime_sun;
		
		$args['so_doctornum_mon'] = $so_doctornum_mon;
		$args['so_rsinterval_mon'] = $so_rsinterval_mon;
		$args['so_work_stime_mon'] = $so_work_stime_mon;
		$args['so_work_etime_mon'] = $so_work_etime_mon;
		$args['so_ext_stime_mon'] = $so_ext_stime_mon;
		$args['so_ext_etime_mon'] = $so_ext_etime_mon;
		
		$args['so_doctornum_tue'] = $so_doctornum_tue;
		$args['so_rsinterval_tue'] = $so_rsinterval_tue;
		$args['so_work_stime_tue'] = $so_work_stime_tue;
		$args['so_work_etime_tue'] = $so_work_etime_tue;
		$args['so_ext_stime_tue'] = $so_ext_stime_tue;
		$args['so_ext_etime_tue'] = $so_ext_etime_tue;
		
		$args['so_doctornum_wed'] = $so_doctornum_wed;
		$args['so_rsinterval_wed'] = $so_rsinterval_wed;
		$args['so_work_stime_wed'] = $so_work_stime_wed;
		$args['so_work_etime_wed'] = $so_work_etime_wed;
		$args['so_ext_stime_wed'] = $so_ext_stime_wed;
		$args['so_ext_etime_wed'] = $so_ext_etime_wed;
		
		$args['so_doctornum_thu'] = $so_doctornum_thu;
		$args['so_rsinterval_thu'] = $so_rsinterval_thu;
		$args['so_work_stime_thu'] = $so_work_stime_thu;
		$args['so_work_etime_thu'] = $so_work_etime_thu;
		$args['so_ext_stime_thu'] = $so_ext_stime_thu;
		$args['so_ext_etime_thu'] = $so_ext_etime_thu;
		
		$args['so_doctornum_fri'] = $so_doctornum_fri;
		$args['so_rsinterval_fri'] = $so_rsinterval_fri;
		$args['so_work_stime_fri'] = $so_work_stime_fri;
		$args['so_work_etime_fri'] = $so_work_etime_fri;
		$args['so_ext_stime_fri'] = $so_ext_stime_fri;
		$args['so_ext_etime_fri'] = $so_ext_etime_fri;
		
		$args['so_doctornum_sat'] = $so_doctornum_sat;
		$args['so_rsinterval_sat'] = $so_rsinterval_sat;
		$args['so_work_stime_sat'] = $so_work_stime_sat;
		$args['so_work_etime_sat'] = $so_work_etime_sat;
		$args['so_ext_stime_sat'] = $so_ext_stime_sat;
		$args['so_ext_etime_sat'] = $so_ext_etime_sat;		
		
		$rst = $C_Reserve -> Treat_Option_Reg($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
		exit();
	break;
	
	
	case 'TREAT_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['ts_idx'] 	= $ts_idx;
		$result = $C_Reserve ->Treat_Info_Del($args);		
		
		echo "true";
		exit();
	
	break;
	
	
	case 'TREAT_MODI' :	
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
		$args = '';
		$args['ts_name'] = $ts_name;
		$args['hp_idx']  = $hp_idx;		
		$args['ts_idx']  = $ts_idx;		
		$rst = $C_Reserve -> Treat_Info_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
		
	break;
	
	
	case 'TREAT_REG':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
		
		$args = "";
		$args['ts_name'] 				= $ts_name;
		$args['hp_idx'] 				= $hp_idx;		
		$rst = $C_Reserve -> Treat_Info_Reg($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
		exit();
	break;	
}
?>