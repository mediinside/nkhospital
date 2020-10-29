<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "진료 날짜 선택 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";


if($_GET['date']!= '') {
	$date = $_GET['date'];
}else{
	$date = date('Y-m-d');
}	  
   
$now_day = date('Y-m-d');

$x=explode("-",$date); // 들어온 날짜를 년,월,일로 분할해 변수로 저장합니다.
$s_Y=$x[0]; // 지정된 년도
$s_m=$x[1]; // 지정된 월
$s_d=$x[2]; // 지정된 요일

$s_t=date("t",mktime(0,0,0,$s_m,$s_d,$s_Y)); // 지정된 달은 몇일까지 있을까요?
$s_n=date("N",mktime(0,0,0,$s_m,1,$s_Y)); // 지정된 달의 첫날은 무슨요일일까요?
$l=$s_n%7; // 지정된 달 1일 앞의 공백 숫자.
$ra=($s_t+$l)/7; $ra=ceil($ra); $ra=$ra-1; // 지정된 달은 총 몇주로 라인을 그어야 하나?

$n_d= date("Y-m-d",mktime(0,0,0,$s_m,$s_d+1,$s_Y)); // 다음날
$p_d= date("Y-m-d",mktime(0,0,0,$s_m,$s_d-1,$s_Y)); // 이전날
$n_Y= date("Y-m-d",mktime(0,0,0,$s_m,$s_d,$s_Y+1)); // 내년
$p_Y= date("Y-m-d",mktime(0,0,0,$s_m,$s_d,$s_Y-1)); // 작년
$p_m= date("Y-m-d",mktime(0,0,0,$s_m-1,$s_d,$s_Y)); // 저번달
$n_m= date("Y-m-d",mktime(0,0,0,$s_m+1,$s_d,$s_Y)); // 다음달

/*휴무일 배열 만들기 월별
$th_date = substr($date, 0, 7);
$db->sql("select th_date from tblholiday where LEFT(th_date,7) = '$th_date'");
$db->exec();
$k=0;
while($rec = $db->mfa()){
	$holi_arr[$k] = $Holiday_data[$k]['th_date'];
	$k++;
}
*/
$one_day = request_add_day($now_day , 2);
$ck_week = DayWeekChange($now_day);


for($r=0;$r<=$ra;$r++){
$cal_table .=  "<tr>\n";
  for($z=1;$z<=7;$z++){									
	  $rv=7*$r+$z; $ru=$rv-$l; // 칸에 번호를 매겨줍니다. 1일이 되기전 공백들 부터 마이너스 값으로 채운 뒤 ~
	  
	  if($ru<=0 || $ru>$s_t) { // 딱 그달에 맞는 숫자가 아님 표시하지 말자
		$cal_table .= "<td>&nbsp;</td>";											
	  }else{
		$s = date("Y-m-d",mktime(0,0,0,$s_m,$ru,$s_Y)); // 현재칸의 날짜

		$dayweek = DayWeekChange($s);                    
		$now_mon = date("m");                              
		$ch_mday = $s_m.$s_d;
		
		$ru_d = "";
		$ru_d = (strlen($ru) < 2) ? "0".$ru : $ru_d = $ru;
		
		$ch_mday1 = $now_mon.$ru_d;		                    
		
		$cho_date = $s_Y. "-" . $s_m . "-" . $ru_d; 
						
			if($ch_mday == $ch_mday1) {
			  $cal_table .= "<td class='today' title='예약불가 - 오늘'>$ru</td>";	
			}else{
				if($s < date('Y-m-d')) {	//오늘이전이면  예약불가																															
					$cal_table .= "<td class='pssd non' title='예약불가 - 이전날'>$ru</td>";	
				} else if($s < $one_day) { //2일
					$cal_table .= "<td class='sun non' title='예약불가 - 2일전 '>$ru</td>";											
				} else if($one_day == $s && $ck_week == "일") { //하루 더한날 
					$cal_table .= "<td class='sun non' title='예약불가 - 일요일 또는 다음날 '>$ru</td>";											
				}else if($dayweek == "일") { //일요일은 방문접수만							
					$cal_table .= "<td class=\"sun\"><button type=\"button\" title=\"방문접수만 가능\" onclick=\"javascript:alert('일요일은 방문접수만 가능합니다');\">$ru</button></td>";
				} else {
					//$cal_table .= "<td title=''><button type='button' onClick=\"time_sel('" . $dr_idx. "','" . $cho_date. "', this)\">$ru</button></td>";	
					$cal_table .= "<td title=''><button type='button' onClick=\"next_step('" . $cho_date. "')\">$ru</button></td>";
				}
			}
	  } //end if													
  }
  $cal_table .= "</tr>\n";
  }

//echo $cal_table;

$tpl->assign(array(
	's_Y'			=> $s_Y,
	's_m'			=> $s_m,
	'p_m'			=> $p_m,
	'n_m'			=> $n_m,		
	'cal_table'		=> $cal_table
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>

