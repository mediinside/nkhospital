<?php 
/*
BY-SHIN - 2016-03-18
*/
error_reporting(0);
define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("AJAX_PAGE",true);

$root_path = "../";

include $root_path."include/common.php";
$mode	  = $_POST["mode"];

switch($mode) {
	case "doc" :
		/*
		$db->sql("select * from tblDoctor where dr_clinic2='$treat' and dr_delflag = 'N' order by dr_desc desc");
		$db->exec();
		echo "<option value=''>의료진을 선택하세요</option>";
		while($rec = $db->mfa()){
			echo "<option value='" . $rec["dr_idx"] . "'>" . $rec["dr_name"] . "</option>";			
		}
		*/
		$dr_code  = $_POST["dr_code"];
		$query = "select * from dreamer.BTC_Doctor A inner join dreamer.BTC_Dept B On (A.DrDept1 = B.DeptCode OR A.DrDept2 = B.DeptCode) where A.ExpireFlag = 0 and DEPTCODE = '$dr_code'";
		$rs = $ora_db->selectList($query); 
		echo "<option value=''>의료진을 선택하세요</option>";
		//echo "<option value='none'>선택안함</option>";
		for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
			echo "<option value='".trim($rs["DRCODE"][$i])."'>" . iconv('EUC-KR','UTF-8',$rs["DRNAME"][$i]) . "</option>";
		} 	
		
	break;
	case "day" :
		$nDate = date("Y-m-d",strtotime("+2day",time()));
		$dr_code  = $_POST["dr_code"];

		$query = "select * from dreamer.BTC_DrSchedule where DRCODE = ".$dr_code." and SCHDATE > '$nDate' and SchClass not in('4','5')";
		$rs = $ora_db->selectList($query); 
		//print_r($rs);
		if($rs){
			for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
				$day_arr[] = $rs["SCHDATE"][$i];
			}	
		}else{
			$day_arr = "";
		}
		//$day_arr = implode(',',$day_arr);
		//echo $day_arr;
		$result = json_encode($day_arr);
		echo $result;		
		
	break;
	case "time" :
		$r_date		= $_POST["r_date"];
		$dr_code  	= $_POST["dr_code"];
		$hour  		= $_POST["hour"];	
		$dept_code  = $_POST["dept_code"];	
		
		$time_gap = "600";
		$rtn = "";		
			$query = "select * from dreamer.BTC_DrSchedule where DRCODE = '".$dr_code."' and SCHDATE = '".$r_date."' and rownum=1";
			$rs = $ora_db->selectList($query); 
			
			if($rs) {
					$schclass = $rs["SCHCLASS"][0];
					switch($schclass){
						case "1" : 
							$s_time = 	strtotime($r_date." 08:30:00");
							$e_time = 	strtotime($r_date." 17:30:00");
						break;
						case "2" : 
							$s_time = 	strtotime($r_date." 08:30:00");
							$e_time = 	strtotime($r_date." 12:00:00");
						break;
						case "3" : 
							$s_time = 	strtotime($r_date." 13:00:00");
							$e_time = 	strtotime($r_date." 17:30:00");
						break;
						default :
							$s_time = 	"";
							$e_time = 	"";
						break;
					}
					//$time_gap = "300";
					//echo "<option value=''>진료시간을 선택하세요</option>";
					//$rtn = "<a href=\"javascript:void(0)\" class=\"trigger\">Hour</a>";
					//$rtn .= "<ul class='list'>";
					for($i=$s_time;$i<=$e_time;$i=$i+$time_gap){
						$r_time = date("H:i",$i);
						$query = "select * from dreamer.ORD_OrderReserved where DrCode = '".$dr_code."' and ReservedDate = '".$r_date."' and RESERVEDTIME = '".$r_time."' and rownum=1";
						$rs = $ora_db->selectList($query); 
						if($rs) continue;
						//echo "<option value='" . $r_time . "'>" . $r_time . "</option>";
						$r_time = explode(":",$r_time);
						if($r_time[0]== $hour) {
			//				$rtn .= $r_time[1];
							$rtn .= "<li><label class=\"radio-label\"><input type=\"radio\" name=\"minute\" value=".$r_time[1]."><span class=\"minute\">".$r_time[1]."</span></label></li>";
						}
					}
				}
		//$rtn .="</ul>";
		echo $rtn;
	break;		
}
?>	
