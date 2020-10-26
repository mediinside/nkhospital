<?php
function HOSPITAL_NAME($hpCode){
	global $db;
	$db->sql("select HpName from RFHospital where HpCode = '$hpCode'");
	$db->exec();
	$array = $db->mfa();
	// print_r($array);
	return $array["HpName"];
}
?>
