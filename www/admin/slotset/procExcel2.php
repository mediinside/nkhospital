<?
session_start();

include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";

$car_name = addslashes($car_name);
$car_name2 = addslashes($car_name2);

$jumin_no = $jumin1."-".$jumin2;
$mobile_no = $mobile_phone1."-".$mobile_phone2."-".$mobile_phone3;

$email = $email_id."@".$email_url;

//$code	= date('Ymdhi').substr(uniqid(rand()),0,8);


if($mode == "update" && $seq) {
	$que = "update reserve_list set reserve_type='".$reserve_type."', jumin_no='".$jumin_no."', mobile_no='".$mobile_no."', email='".$email."', reserve_place='".$reserve_place."',  reserve_name='".$reserve_name."',  reserve_name2='".$reserve_name2."',  reserve_name3='".$reserve_name3."', comment='".$comment."' where seq='".$seq."'";

	MYSQL_QUERY($que);
	MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('수정 되었습니다.');history.back();</script>";
		exit;
}
else if($mode == "del" && $seq) {
	
	MYSQL_QUERY("UPDATE reserve_list SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();

	echo "<script language='JavaScript'>alert('삭제 되었습니다.');history.back();</script>";
	exit;
}
?>