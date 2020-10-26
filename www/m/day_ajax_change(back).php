<?
if($_POST["dr_idx"]) {
	include_once  '../_init.php';
	include_once($GP -> CLS."/class.doctor.php");	
	$C_Doctor 	= new Doctor;
	$args['dr_idx'] = $_POST['dr_idx'];
	$data = "";
	$data = $C_Doctor->Doctor_Info($args);    
	extract($data);
	$nDate 			= $_POST["nday"];
	$moning_arr 	= explode(',', $dr_m_sd);	
	$after_arr 		= explode(',', $dr_a_sd);
	$nDate_arr		= explode('-',$nDate);
	$week			= $C_Func->DayWeekChange($nDate);
	if(in_array($week, $moning_arr)) $m_rev = "Y";
	if(in_array($week, $after_arr)) $a_rev = "Y";	

	if($m_rev == "Y" && $a_rev == "Y") {
		$r_time   = '09:30 ~ 05:30';
		$r_result =  '<span class="enable">예약가능</span>';	
	}else if($m_rev == "Y" && $a_rev == "") {
		$r_time   = '09:30 ~ 12:30';		
		$r_result =  '<span class="disable">오후휴진</span>';		
	}else if($m_rev == "" && $a_rev == "Y") {
		$r_time   = '13:30 ~ 05:30';		
		$r_result =  '<span class="disable">오전휴진</span>';		
	}else{
		$r_result =  '<span class="closed">휴진</span>';		
	}
	echo '
			<dl>
				<dt class="text-ir">진료시간</dt><dd>'.$r_time.'</dd>
				<dt class="text-ir">예약가능 여부</dt><dd>
					'.$r_result.'
				</dd>
			</dl>
		';
}else{

	$nYear 		= $_POST["year"];
	$nMonth		= $_POST["month"];
	
	$r_date 		= date("Y-n-d",strtotime("+2 days"));
	$date_arr		= explode("-",$r_date);
	$n_year			= $date_arr[0];
	$n_month		= $date_arr[1];
	$n_day			= $date_arr[2];
	$s_day 			= ($nYear == $n_year && $nMonth == $n_month) ? $n_day : 1;
	$e_day 			= date('t',mktime(0,0,0,$nMonth,1,$nYear));
	
	for($i=$s_day;$i<=$e_day;$i++){
		$w_day = mktime('0','0','0',$nMonth,$i,$n_year);
		$week = date('w',$w_day);
		if($week == 0) continue;
		 echo "<option value='".$i."'>".$i."일".$week; 
	}
}
?>