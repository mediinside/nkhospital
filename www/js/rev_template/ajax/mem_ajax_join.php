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
extract($_POST);
$EnDecryptText = new EnDecryptText(); 
$MemPW = $EnDecryptText->Encrypt_Text($key_value_se.$MemPW);

//index 다시 재검사

$db->sql("
			SELECT count(*) from ".MEMBER_TABLE." where MemID = '$MemID' and MemType = 'mem'
		");
$db->exec();
if($db->mr(0,0) > 0) {
		echo "same";
		exit;
}

$db->sql("
			SELECT count(*) from ".MEMBER_TABLE." where MemPhoneNo = '$MemPhoneNo' and MemName = '$MemName'
		",2);
$db->exec(2);
if($db->mr(0,0,2) > 0) {
		echo "same";
		exit;
}

$nDate = date("Y-m-d H:i:s");
		$join_info = array(
				'MemID'		=> $MemID,
				'MemPW'		=> $MemPW,
				'MemName'	=> $MemName,
				'MemBirthDt'=> $MemBirthDt,
				'MemPhoneNo'=> $MemPhoneNo,
				'MemSex'	=> $MemSex,
				'MemType'	=> "mem",
				'MemLastLoginDt'=> $nDate,
				'MemRegDt'		=> $nDate,
		);	
	    $rst = db_insert_r($join_info,MEMBER_TABLE);
		
		if($rst) {
			echo "true";
		}else{
			echo "false";	
		}
?>
