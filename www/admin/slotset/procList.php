<?
session_start();

include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";

$car_name = addslashes($car_name);
$car_name2 = addslashes($car_name2);

$jumin_no = $jumin1."-".$jumin2;
$phone_no = $home_select."-".$secondphone."-".$thirdphone;

$mobile_no = $mobile_phone1."-".$mobile_phone2."-".$mobile_phone3;

$email = $email_id."@".$email_url;

$code	= date('Ymdhi').substr(uniqid(rand()),0,8);


if($dir == ""){
	$dir = "slotset";
}
if($menu == ""){
	$menu = "Reserve2";
}


if($mode == "new") {
	
	

	MYSQL_QUERY("INSERT INTO reserve_list(
	code,
	reserve_day,
	reserve_time,
	reserve_type,
	reserve_name,
	reserve_name2,
	reserve_name3,
	jumin_no,
	phone_no,
	mobile_no,
	email,
	reserve_place,
	comment,
	reg_date,
	reg_id,
	reg_name,
	view_state,
	state
	) 
	VALUES(
	'".$code."',
	'".$reserve_day."',
	'".$reserve_time."',
	'".$reserve_type."',
	'".$reserve_name."',
	'".$reserve_name2."',
	'".$reserve_name3."',
	'".$jumin_no."',
	'".$phone_no."',
	'".$mobile_no."',
	'".$email."',
	'".$reserve_place."',
	'".$comment."',
	now(),
	'".$sess_AID."',
	'".$sess_ANM."',
	'Y',
	'Y'
	)");
	$newSeq = mysql_insert_id();

	mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$newSeq','$sess_AID','$sess_ANM',now(),'Y')");
	if(!$newSeq) {
		MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('알 수 없는 오류로 정상적으로 처리되지 못했습니다.'); history.go(-1);</script>";
		exit;
	}
	else {
		
		if($item4 !=""){
			$item4_timezone = sel_time2($item4_timezone);
			MYSQL_QUERY("INSERT INTO reserve_list(
			code,
			reserve_day,
			reserve_time,
			reserve_type,
			reserve_name,
			reserve_name2,
			reserve_name3,
			jumin_no,
			phone_no,
			mobile_no,
			email,
			reserve_place,
			comment,
			reg_date,
			reg_id,
			reg_name,
			view_state,
			state
			) 
			VALUES(
			'".$code."',
			'".$item4."',
			'".$item4_timezone."',
			'item4',
			'".$reserve_name."',
			'".$reserve_name2."',
			'".$reserve_name3."',
			'".$jumin_no."',
			'".$phone_no."',
			'".$mobile_no."',
			'".$email."',
			'".$reserve_place."',
			'".$comment."',
			now(),
			'".$sess_AID."',
			'".$sess_ANM."',
			'Y',
			'Y'
			)");
			$newSeq = mysql_insert_id();
			mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$newSeq','$sess_AID','$sess_ANM',now(),'Y')");
		}
		if($item5 !=""){
			$item5_timezone = sel_time2($item5_timezone);
			MYSQL_QUERY("INSERT INTO reserve_list(
			code,
			reserve_day,
			reserve_time,
			reserve_type,
			reserve_name,
			reserve_name2,
			reserve_name3,
			jumin_no,
			phone_no,
			mobile_no,
			email,
			reserve_place,
			comment,
			reg_date,
			reg_id,
			reg_name,
			view_state,
			state
			) 
			VALUES(
			'".$code."',
			'".$item5."',
			'".$item5_timezone."',
			'item5',
			'".$reserve_name."',
			'".$reserve_name2."',
			'".$reserve_name3."',
			'".$jumin_no."',
			'".$phone_no."',
			'".$mobile_no."',
			'".$email."',
			'".$reserve_place."',
			'".$comment."',
			now(),
			'".$sess_AID."',
			'".$sess_ANM."',
			'Y',
			'Y'
			)");
			$newSeq = mysql_insert_id();
			mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$newSeq','$sess_AID','$sess_ANM',now(),'Y')");

		}
		if($item6 !=""){
			$item6_timezone = sel_time2($item6_timezone);
			MYSQL_QUERY("INSERT INTO reserve_list(
			code,
			reserve_day,
			reserve_time,
			reserve_type,
			reserve_name,
			reserve_name2,
			reserve_name3,
			jumin_no,
			phone_no,
			mobile_no,
			email,
			reserve_place,
			comment,
			reg_date,
			reg_id,
			reg_name,
			view_state,
			state
			) 
			VALUES(
			'".$code."',
			'".$item6."',
			'".$item6_timezone."',
			'item6',
			'".$reserve_name."',
			'".$reserve_name2."',
			'".$reserve_name3."',
			'".$jumin_no."',
			'".$phone_no."',
			'".$mobile_no."',
			'".$email."',
			'".$reserve_place."',
			'".$comment."',
			now(),
			'".$sess_AID."',
			'".$sess_ANM."',
			'Y',
			'Y'
			)");
			$newSeq = mysql_insert_id();
			mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$newSeq','$sess_AID','$sess_ANM',now(),'Y')");
		}
		MYSQL_CLOSE();
		
			echo "<script language='JavaScript'>parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."&search_name=".$search_name."&search_field=".$search_field."'</script>";
		exit;
	}
}
else if($mode == "update" && $seq) {
	$que = "update reserve_list set jumin_no='".$jumin_no."', phone_no='".$phone_no."', mobile_no='".$mobile_no."', email='".$email."', reserve_place='".$reserve_place."',  reserve_name='".$reserve_name."',  reserve_name2='".$reserve_name2."',  reserve_name3='".$reserve_name3."', comment='".$comment."' where seq='".$seq."'";

	MYSQL_QUERY($que);
	mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$seq','$sess_AID','$sess_ANM',now(),'Y')");
	MYSQL_CLOSE();
			echo "<script language='JavaScript'>alert('수정 되었습니다.');parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."&search_name=".$search_name."&search_field=".$search_field."'</script>";
		exit;
}
else if($mode == "del" && $seq) {
	
	$query = "select * from reserve_list_new where seq='".$seq."'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	if($rows[code] != ""){
		MYSQL_QUERY("UPDATE reserve_list_new SET view_state='N' WHERE code='".$rows[code]."'");
	}
	else{
	
		MYSQL_QUERY("UPDATE reserve_list_new SET view_state='N' WHERE seq='".$seq."'");
	}

	MYSQL_CLOSE();

		echo "<script language='JavaScript'>alert('삭제 되었습니다.');parent.location.href='../index.html?dir=slotset&menu=Reserve2'</script>";
	exit;
}
?>