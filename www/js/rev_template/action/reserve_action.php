<?php 
/*
BY-SHIN - 2016-04-27
*/

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",true);


$root_path = "../";

include $root_path."include/common.php";

//변수처리
if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;


switch($_POST['mode']){
	//관리자수정
	case 'add':
		$time = $r_hour.":".$minute;
		$list = array(
						"RvMemNo" 		=> $_SESSION['rev_no'],
						"RvRevDt" 		=> $r_day,
						"RvRevTime" 	=> $time,						
						"RvName" 		=> $r_name,
						"RvPhone" 		=> $r_phone,
						"RvBirth" 		=> $r_birth,
						"RvSex" 		=> $r_sex,
						"RvPPhone" 		=> $r_phone,
						"RvPName" 		=> $p_name,
						"RvPBrith" 		=> $p_birth,
						"RvPSex" 		=> $p_sex,						
						"RvHpCode" 		=> "NK",
						"RvDptCode" 	=> $t_code,
						"RvDptCodeName" => $t_code_name,
						"RvDrCode" 		=> $r_dr_code,
						"RvDrName" 		=> $r_dr_name,
						"RvType" 		=> "M",
						"RvCancelFlag" 	=> "N",
						"RvRegDt"		=> date("Y-m-d H:i:s")
					);
		if($rv_no) {
			$list["RvModDt"] = date("Y-m-d H:i:s");			
			$where_update = "RvNo = '$rv_no'";
			db_modify($list, RESERVE_TABLE, $where_update);
			$js->gourl("/online/reserve/");
		}else{
			db_insert($list, RESERVE_TABLE);
			$rtn = $db->mid();
			$js->gourl("/online/result/rtn=".$rtn);			
		}		
	break;
	//관리자 삭제
	case 'del' :
		$rv_no = $_POST["rv_no"];
		$db->sql(" update ".RESERVE_TABLE." set RvCancelFlag = 'Y' where RvNo = '$rv_no'");
		$db->exec();
		echo "true";
	exit;	
}
?>