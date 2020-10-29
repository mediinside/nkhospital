<?php 
/*
BY-SHIN - 2016-03-18
*/

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("AJAX_PAGE",true);

$root_path = "../";
include $root_path."include/common.php";

$SMS_ID  = SMS_ID;
$SMS_PWD = md5(SMS_PW);
$sm_to   = $_POST['phone'];
$confirm_no = mt_rand(1,999999);
$phone_array = explode("-",SMS_HP_TEST);
$send_date = date('Y-m-d');
$msg = "요청하신 인즌 번호는 [".$confirm_no."] 입니다. - 메디인사이드";
//$mb_id = "adm_medi";
//$mode  = "admin";

	//보낼 데이터
	$data = array(
		'type' => 'send',
		'msg' => $msg,    
		'sm_to' => $sm_to,
		'destination' => '',
		'sm_from1' => $phone_array[0],
		'sm_from2' => $phone_array[1],
		'sm_from3' => $phone_array[2],
		'send_date' => '',
		'send_time' => '',
		'returnurl' => '',
		'testflag' => 'Y',			
		'repeatFlag' => '',
		'repeatNum' => '1',
		'repeatTime' => '15',			
		'send_num' => '1',
		'return_type' => 'json',			
		'login_id' =>  $SMS_ID,			
		'login_pwd' => $SMS_PWD	
	);	
	$result = post_request('http://mediinside.co.kr/api/sms_api.php', $data); 	

	if($result > 0) {
		echo $confirm_no;
	}else{
		echo "false";	
	}
		

?>