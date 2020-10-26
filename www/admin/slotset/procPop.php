<?
session_start();

include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";
$car_name = addslashes($car_name);
$car_name2 = addslashes($car_name2);

if($jumin1 != "" && $jumin2 != ""){

	$jumin_no = $jumin1."-".$jumin2;
}
else{
	$jumin_no = "";
}

if($secondphone != "" && $thirdphone != ""){
	$phone_no = $home_select."-".$secondphone."-".$thirdphone;
}
else{
	$phone_no = "";
}
if($mobile_phone2 != "" && $mobile_phone3 != ""){

	$mobile_no = $mobile_phone1."-".$mobile_phone2."-".$mobile_phone3;
}
else{
	$mobile_no = "";
}
if($email_id != "" && $email_url != ""){

	$email = $email_id."@".$email_url;
}
else{
	$email = "";
}

$code	= date('Ymdhi').substr(uniqid(rand()),0,8);

if($mode == "new") {
	
	if($reserve_multi != ""){
		for($i=0;$i<$reserve_multi;$i++){
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
		}
		MYSQL_CLOSE();
		?>
		<script language='JavaScript'>
						
			if(confirm("총 <?=$reserve_multi?> 예약 되었습니다. 더 추가 하겠습니까?")){
				location.href="/admin/slotset/popup.html?sel_week_end=<?=$reserve_day?>&k=<?=$reserve_time?>&mode=<?=$mode?>&item=<?=$reserve_type?>";
			}
			else{
				
				parent.location.reload();
				
			}
		</script>
		<?
						exit;
	}
	else{

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
			if($item3 !=""){
				$item3_timezone = sel_time2($item3_timezone);
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
				'".$item3."',
				'".$item3_timezone."',
				'item3',
				'".$reserve_name."',
				'".$reserve_name2."',
				'".$reserve_name3."',
				'".$jumin_no."',
				'".$mobile_no."',
				'".$phone_no."',
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
			
		?>
					<script language='JavaScript'>
						
						if(confirm("예약 되었습니다. 더 추가 하겠습니까?")){
							location.href="/admin/slotset/popup.html?sel_week_end=<?=$reserve_day?>&k=<?=$reserve_time?>&mode=<?=$mode?>&item=<?=$reserve_type?>";
						}
						else{
							
							parent.location.reload();
							
						}
					</script>
		<?
		}
		exit;
	}
}
else if($mode == "update" && $seq) {
	$reserve_time = sel_time2($reserve_time);
	$que = "update reserve_list set reserve_day='".$reserve_day."',reserve_time='".$reserve_time."', jumin_no='".$jumin_no."', phone_no='".$phone_no."', mobile_no='".$mobile_no."', email='".$email."', reserve_place='".$reserve_place."',  reserve_name='".$reserve_name."',  reserve_name2='".$reserve_name2."',  reserve_name3='".$reserve_name3."', comment='".$comment."' where seq='".$seq."'";
	MYSQL_QUERY($que);
	mysql_query("insert into reserve_list_update(group_code,id,name,reg_date,view_state) values('$seq','$sess_AID','$sess_ANM',now(),'Y')");
	MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('수정 되었습니다.');parent.location.reload();</script>";
		exit;
}
else if($mode == "del" && $seq) {
	
	/*$query = "select * from reserve_list where seq='".$seq."'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	if($rows[code] != ""){
		MYSQL_QUERY("UPDATE reserve_list SET view_state='N' WHERE code='".$rows[code]."'");
	}
	else{
	
		MYSQL_QUERY("UPDATE reserve_list SET view_state='N' WHERE seq='".$seq."'");
	}
	*/
	MYSQL_QUERY("UPDATE reserve_list SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();

	echo "<script language='JavaScript'>alert('삭제 되었습니다.');parent.location.reload();</script>";
	exit;
}
?>