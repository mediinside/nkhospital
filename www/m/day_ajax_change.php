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
			$s_time   = '08:30';
			$e_time   = '17:30';			
			$r_result =  $nDate. '('.$week.')<span class="enable">   예약가능</span>';	
		}else if($m_rev == "Y" && $a_rev == "") {
			$s_time   = '08:30';
			$e_time   = '13:00';				
			$r_result =  $nDate. '('.$week.')<span class="disable">   오후휴진</span>';		
		}else if($m_rev == "" && $a_rev == "Y") {
			$s_time   = '14:00';
			$e_time   = '17:30';				
			$r_result =  $nDate. '('.$week.')<span class="disable">   오전휴진</span>';		
		}else{
			$time_not = "Y";
			$r_result =  $nDate. '('.$week.')<span class="closed">   휴진</span>';		
		}
	if($_POST["mode"] == "T") {	
		$time_gap = $C_Doctor->Doctor_Sch_R($data["dr_clinic2"]);    
		if($time_gap == "" || $time_gap == "0") $time_gap = 10;
		$time_gap = $time_gap * 60;
//		$time_gap = "1800";
		$s_t    = $s_time.":00";
		$e_t    = $e_time.":00";
		if($time_not != "Y") {
			$s_time = 	strtotime($nDate. $s_t);
			$e_time = 	strtotime($nDate. $e_t);
			for($i=$s_time;$i<$e_time;$i=$i+$time_gap){
				$r_time = date("H:i",$i);
				if($r_time == "13:00" || $r_time == "13:30") continue; 
				echo "<option value='".$r_time."'>".$r_time."분"; 
			}
		}
	}else{
		echo '<dl>';
		if($time_not != "Y") echo '<dt class="text-ir">진료시간</dt><dd>'.$s_time.'~'.$e_time.'</dd>';
		echo	'
					<dt class="text-ir">예약가능 여부</dt><dd>
						'.$r_result.'
					</dd>
				</dl>
			';
	}
}else{

	$nYear 		= $_POST["year"];
	$nMonth		= $_POST["month"];
	
    $plusd = "2";
    for($d=0;$d<3;$d++){
   		$s_plus = date("w",strtotime("+".$d." days"));
        //echo $s
    	if($s_plus == "0") {
        	$plusd++;
        }
    }	
	
	$r_date 		= date("Y-n-j",strtotime("+".$plusd." days"));
	//echo $r_date;
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
		 echo "<option value='".$i."'>".$i."일"; 
	}
}
?>