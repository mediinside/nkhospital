<?
session_start();
include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";

if($mode == "insert"){
	if($reserve_time == ""){
	?>
	<script>
		alert("예약시간은 필수입니다.");
		history.back();
	</script>
	<?
		exit;
	}


	if($time_cnt < $time_limit){
	?>
	<script>
		alert("예약 가능한 수를 넘었습니다.");
		history.back();
	</script>
	<?
		exit;
		
	}


	$subject = addslashes($subject);
	$content = str_replace("\\", "", $content);
	$cntFile = count($upFile);

	if($PRO_NAME == ""){
	?>
	<script>
		alert("기본 예약 검진 항목이 없는 사업장은 예약이 불가능합니다.");
		history.back();
	</script>
	<?
		exit;
	}
	/*
	echo $reserve_name."<br>";
	echo $jumin_no1."<br>";
	echo $jumin_no2."<br>";

	echo $mobile_no1."<br>";
	echo $mobile_no2."<br>";
	echo $mobile_no3."<br>";

	echo $email1."<br>";
	echo $email2."<br>";


	echo $firstzip."<br>";
	echo $secondzip."<br>";
	echo $address."<br>";
	echo $detailaddress."<br>";



	echo $reserve_time."<br>";
	echo $textfield1."<br>";


	echo $item1."<br>";
	echo $item2."<br>";
	echo $item3."<br>";
	echo $item4."<br>";
	echo $item5."<br>";
	echo $item6."<br>";
	echo $item7."<br>";
	echo $item8."<br>";
	echo $item9."<br>";
	echo $item10."<br>";

	echo $item11."<br>";
	echo $item12."<br>";
	echo $item13."<br>";
	echo $item14."<br>";
	echo $item15."<br>";
	echo $item16."<br>";
	echo $item17."<br>";
	echo $item18."<br>";
	echo $item19."<br>";
	echo $item20."<br>";



	echo $item21."<br>";
	echo $item22."<br>";
	echo $item23."<br>";
	echo $item24."<br>";
	echo $item25."<br>";
	echo $item26."<br>";
	echo $item27."<br>";
	echo $item28."<br>";
	echo $item29."<br>";
	echo $item30."<br>";
	*/
	if($PRO_NAME != ""){
		$item0 = "Y";
	}
	if($item5 != ""){
		$reserve_time5 = sel_time2($item5);
		$item5 = "Y";
	}

	if($item13 != ""){
		$reserve_time13 = sel_time2($item13);
		$item13 = "Y";
	}


	if($item15 != ""){
		$reserve_time15 = sel_time2($item15);
		$item15 = "Y";
	}
	if($item16 != ""){
		$reserve_time16 = sel_time2($item16);
		$item16 = "Y";
	}

	if($item17 != ""){
		$reserve_time17 = sel_time2($item17);
		$item17 = "Y";
	}

	if($item18 != ""){
		$reserve_time18 = sel_time2($item18);
		$item18 = "Y";
	}

	if($item19 != ""){
		$reserve_time19 = sel_time2($item19);
		$item19 = "Y";
	}

	if($item20 != ""){
		$reserve_time20 = sel_time2($item20);
		$item20 = "Y";
	}

	if($item21 != ""){
		$reserve_time21 = sel_time2($item21);
		$item21 = "Y";
	}
	
	if($item23 != ""){
		$reserve_time23 = sel_time2($item23);
		$item23 = "Y";
	}

	if($item24 != ""){
		$reserve_time24 = sel_time2($item24);
		$item24 = "Y";
	}

	if($item25 != ""){
		$reserve_time25 = sel_time2($item25);
		$item25 = "Y";
	}
	if($item26 != ""){
		$reserve_time26 = sel_time2($item26);
		$item26 = "Y";
	}
	
	$jumin_no = $jumin_no1."-".$jumin_no2;
	//if($date1 != "" && $date2 != "" && $date3 != ""){
	//	$jumin_no = $date1.$date2.$date3;
	//}
	if($mobile_no1 != ""){
		$mobile_no = $mobile_no1."-".$mobile_no2."-".$mobile_no3;
	}
	if($email1 != ""){
		$email = $email1."@".$email2;
	}



	for($k=0;$k<$time_limit;$k++){

		$query = "insert reserve_list_new set 
		reserve_day='".$sel_day."', 
		reserve_time='".$reserve_time."',

		reserve_name = '".$reserve_name."',
		jumin_no     = '".$jumin_no."',
		mobile_no     = '".$mobile_no."',
		email     = '".$email."',

		post1     = '".$firstzip."',
		post2     = '".$secondzip."',
		addr1     = '".$address."',
		addr2     = '".$detailaddress."',

		reserve_place = '".$textfield1."',

		
		reserve_type_name='".$PRO_NAME."',

		reserve_time1='".$reserve_time."',
		reserve_type1='".$item1."',
		reserve_time2='".$reserve_time."',
		reserve_type2='".$item2."',
		reserve_time3='".$reserve_time."',
		reserve_type3='".$item3."',
		reserve_time4='".$reserve_time."',
		reserve_type4='".$item4."',
		reserve_time5='".$reserve_time5."',
		reserve_type5='".$item5."',
		reserve_time6='".$reserve_time."',
		reserve_type6='".$item6."',
		reserve_time7='".$reserve_time."',
		reserve_type7='".$item7."',
		reserve_time8='".$reserve_time."',
		reserve_type8='".$item8."',
		reserve_time9='".$reserve_time."',
		reserve_type9='".$item9."',
		reserve_time10='".$reserve_time."',
		reserve_type10='".$item10."',
		reserve_time11='".$reserve_time."',
		reserve_type11='".$item11."',
		reserve_time12='".$reserve_time."',
		reserve_type12='".$item12."',
		reserve_time13='".$reserve_time13."',
		reserve_type13='".$item13."',
		reserve_time14='".$reserve_time."',
		reserve_type14='".$item14."',
		reserve_time15='".$reserve_time15."',
		reserve_type15='".$item15."',
		reserve_time16='".$reserve_time16."',
		reserve_type16='".$item16."',
		reserve_time17='".$reserve_time17."',
		reserve_type17='".$item17."',
		reserve_time18='".$reserve_time18."',
		reserve_type18='".$item18."',
		reserve_time19='".$reserve_time19."',
		reserve_type19='".$item19."',

		reserve_time20='".$reserve_time20."',
		reserve_type20='".$item20."',

		reserve_time21='".$reserve_time21."',
		reserve_type21='".$item21."',


		reserve_time22='".$reserve_time22."',
		reserve_type22='".$item22."',
		reserve_time23='".$reserve_time23."',
		reserve_type23='".$item23."',
		reserve_time24='".$reserve_time24."',
		reserve_type24='".$item24."',
		reserve_time25='".$reserve_time25."',
		reserve_type25='".$item25."',
		reserve_time26='".$reserve_time26."',
		reserve_type26='".$item26."',
		reserve_time27='".$reserve_time."',
		reserve_type27='Y',
		reserve_time28='".$reserve_time."',
		reserve_type28='".$item28."',
		reserve_time29='".$reserve_time."',
		reserve_type29='".$item29."',
		reserve_time30='".$reserve_time."',
		reserve_type30='".$item30."',
		
		comment = '".$comment."',
		reg_date = now(),
		reg_id='".$sess_AID."',
		reg_name='".$sess_ANM."',
		view_state='Y',



		place = '".$place."',
		member_no = '".$member_no."',
		postion = '".$postion."',
		person = '".$person."',
		office = '".$office."',
		delivery = '".$delivery."',
		black_list = '".$blacklist."',


		state='Y'


		";

		

		mysql_query($query);
	}

	MYSQL_CLOSE();

	?>
	<script>
	alert("예약 되었습니다.");
	opener.location.reload();
	self.close();
	//window.parent.location.reload();
	//window.parent.CloseManageFrame();
	//window.parent.location.reload();
	//location.href="/admin/?dir=log&menu=Manager&open=52";
	//location.href="/admin/log/pop_log_write.html?input_date=<?=$date?>";
	</script>
<?
}
else if($mode == "update"){

	if($reserve_time == ""){
	?>
	<script>
		alert("예약시간은 필수입니다.");
		history.back();
	</script>
	<?
		exit;
	}



	



	$subject = addslashes($subject);
	$content = str_replace("\\", "", $content);
	$cntFile = count($upFile);

	
	if($item5 != ""){
		$reserve_time5 = sel_time2($item5);
		$item5 = "Y";
	}

	if($item13 != ""){
		$reserve_time13 = sel_time2($item13);
		$item13 = "Y";
	}

	if($item15 != ""){
		$reserve_time15 = sel_time2($item15);
		$item15 = "Y";
	}

	if($item16 != ""){
		$reserve_time16 = sel_time2($item16);
		$item16 = "Y";
	}

	if($item17 != ""){
		$reserve_time17 = sel_time2($item17);
		$item17 = "Y";
	}

	if($item18 != ""){
		$reserve_time18 = sel_time2($item18);
		$item18 = "Y";
	}

	if($item19 != ""){
		$reserve_time19 = sel_time2($item19);
		$item19 = "Y";
	}

	if($item20 != ""){
		$reserve_time20 = sel_time2($item20);
		$item20 = "Y";
	}

	if($item21 != ""){
		$reserve_time21 = sel_time2($item21);
		$item21 = "Y";
	}
	

	if($item23 != ""){
		$reserve_time23 = sel_time2($item23);
		$item23 = "Y";
	}

	if($item24 != ""){
		$reserve_time24 = sel_time2($item24);
		$item24 = "Y";
	}

	if($item25 != ""){
		$reserve_time25 = sel_time2($item25);
		$item25 = "Y";
	}
	if($item26 != ""){
		$reserve_time26 = sel_time2($item26);
		$item26 = "Y";
	}
	

	if($jumin_no1 != ""){
		$jumin_no = $jumin_no1."-".$jumin_no2;
	}
	if($mobile_no1 != ""){
		$mobile_no = $mobile_no1."-".$mobile_no2."-".$mobile_no3;
	}
	if($email1 != ""){
		$email = $email1."@".$email2;
	}

	$query = "update reserve_list_new set 
		reserve_day='".$sel_day."', 
		reserve_time='".$reserve_time."',
		reserve_name = '".$reserve_name."',
		jumin_no     = '".$jumin_no."',
		mobile_no     = '".$mobile_no."',
		email     = '".$email."',
		post1     = '".$firstzip."',
		post2     = '".$secondzip."',
		addr1     = '".$address."',
		addr2     = '".$detailaddress."',
		reserve_time1='".$reserve_time."',
		reserve_type1='".$item1."',
		reserve_time2='".$reserve_time."',
		reserve_type2='".$item2."',
		reserve_time3='".$reserve_time."',
		reserve_type3='".$item3."',
		reserve_time4='".$reserve_time."',
		reserve_type4='".$item4."',
		reserve_time5='".$reserve_time5."',
		reserve_type5='".$item5."',
		reserve_time6='".$reserve_time."',
		reserve_type6='".$item6."',
		reserve_time7='".$reserve_time."',
		reserve_type7='".$item7."',
		reserve_time8='".$reserve_time."',
		reserve_type8='".$item8."',
		reserve_time9='".$reserve_time."',
		reserve_type9='".$item9."',
		reserve_time10='".$reserve_time."',
		reserve_type10='".$item10."',
		reserve_time11='".$reserve_time."',
		reserve_type11='".$item11."',
		reserve_time12='".$reserve_time."',
		reserve_type12='".$item12."',
		reserve_time13='".$reserve_time13."',
		reserve_type13='".$item13."',
		reserve_time14='".$reserve_time."',
		reserve_type14='".$item14."',
		reserve_time15='".$reserve_time15."',
		reserve_type15='".$item15."',
		reserve_time16='".$reserve_time16."',
		reserve_type16='".$item16."',
		reserve_time17='".$reserve_time17."',
		reserve_type17='".$item17."',
		reserve_time18='".$reserve_time18."',
		reserve_type18='".$item18."',
		reserve_time19='".$reserve_time19."',
		reserve_type19='".$item19."',
		reserve_time20='".$reserve_time20."',
		reserve_type20='".$item20."',
		reserve_time21='".$reserve_time21."',
		reserve_type21='".$item21."',
		reserve_time22='".$reserve_time22."',
		reserve_type22='".$item22."',
		reserve_time23='".$reserve_time23."',
		reserve_type23='".$item23."',
		reserve_time24='".$reserve_time24."',
		reserve_type24='".$item24."',
		reserve_time25='".$reserve_time25."',
		reserve_type25='".$item25."',
		reserve_time26='".$reserve_time26."',
		reserve_type26='".$item26."',
		
		reserve_time28='".$reserve_time."',
		reserve_type28='".$item28."',
		reserve_time29='".$reserve_time."',
		reserve_type29='".$item29."',
		reserve_time30='".$reserve_time."',
		reserve_type30='".$item30."',
		comment = '".$comment."',

		place = '".$place."',
		member_no = '".$member_no."',
		postion = '".$postion."',
		person = '".$person."',
		office = '".$office."',
		delivery = '".$delivery."',
		black_list = '".$blacklist."'


		where seq='".$seq."'
		";
		mysql_query($query);

		MYSQL_CLOSE();

	?>
	<script>
	alert("수정 되었습니다.");
	opener.location.reload();
	self.close();
	//window.parent.location.reload();
	//window.parent.CloseManageFrame();
	
	</script>
<?
}
else{
}
?>