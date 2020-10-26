<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.calendar.php");
$C_Calendar 	= new Calendar;

header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
switch ($method) {
		case "product":
        $ret = $C_Calendar->ProductList();
        break;
    case "add":
        $ret = $C_Calendar->addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"], $_POST["CalendarProduct"], $_POST["mb_code"], $_POST["mb_name"], $_POST["mr_mobile"]);
        break;		 
    case "list":
        $ret = $C_Calendar->listCalendar($_POST["showdate"], $_POST["viewtype"], $_POST["treat"]);
        break;
    case "update":
        $ret = $C_Calendar->updateCalendar($_POST["calendarId"], $_POST["CalendarStartTime"], $_POST["CalendarEndTime"]);
        break; 
    case "remove":
        $ret = $C_Calendar->removeCalendar( $_POST["calendarId"]);
        break;
    case "adddetails":		
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["stpartdate"] . " " . $_POST["etparttime"];				
				$user_name = '';
				if($_POST['mb_name']) {
					$user_name = $_POST['mb_name'];
				}else{
					$user_name = $_POST['bbit-cal-what'];
				}
				
				$arr_pd = explode(":",$_POST["mp_idx"]);			
				$mp_idx = $arr_pd[0];
				$mr_product = $arr_pd[1];
				
        if(isset($_GET["id"])){						
            $ret = $C_Calendar->updateDetailedCalendar(
							  $_GET["id"], 
								$st, 
								$et, 
                $user_name,
								isset($_POST["IsAllDayEvent"])?1:0, 
								$_POST["Description"], 
                $mr_product, 
								$_POST["colorvalue"], 
								$_POST["timezone"],
								$_POST["mb_code"],
								$mp_idx,
								$_POST["ts_idx"],
								$_POST["mr_mobile"],
								$_POST["mr_email"]
							);
        }else{
            $ret = $C_Calendar->addDetailedCalendar(
								$st, 
								$et,                    
                $user_name, 
								isset($_POST["IsAllDayEvent"])?1:0, 
								$_POST["Description"], 
                $mr_product, 
								$_POST["colorvalue"], 
								$_POST["timezone"],
								$_POST["mb_code"],
								$mp_idx,
								$_POST["ts_idx"],
								$_POST["mr_mobile"],
								$_POST["mr_email"]
							);
        }        
        break; 
}
echo json_encode($ret); 
?>