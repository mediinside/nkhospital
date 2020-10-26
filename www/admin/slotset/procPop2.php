<?
session_start();

session_start();
include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/chkLogin.php";


if($mode == "new") {
	$start_time = $start_time1.":".$start_time2;
	$end_time = $start_time3.":".$start_time4;

	if(strtotime($start_time) >= strtotime($end_time)){

	?>
	<script>
		alert("끝나는 시간이 시작 시간보다 크게 설정되어있습니다.");
		history.back();
	</script>
	<?
		exit;
	}
	$query = "SELECT driver_name FROM reserve_outchecklist WHERE seq='1'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);

	

	MYSQL_QUERY("INSERT INTO reserve_outchecklist(
	code,
	start_day,
	start_time,
	end_time,
	driver_name,
	number_limit,
	car_sort,
	business_name,
	reserve_sort,
	comment,
	reg_date,
	reg_id,
	reg_name,
	view_state
	) 
	VALUES(
	'".$code."',
	'".$start_day."',
	'".$start_time."',
	'".$end_time."',
	'".$driver_name."',
	'".$number_limit."',
	'".$car_sort."',
	'".$name."',
	'".$reserve_sort."',
	'".$comment."',
	now(),
	'".$sess_AID."',
	'".$sess_ANM."',
	'Y'
	)");
	$newSeq = mysql_insert_id();


	if(!$newSeq) {
		MYSQL_CLOSE();
		?>
		<script>
		alert("알 수 없는 오류로 정상적으로 처리되지 못했습니다.");
		window.parent.location.reload();
		</script>
<?
			exit;
	}
	else {
		
		
		MYSQL_CLOSE();
?>		
		<script>
		alert("예약 되었습니다.");
		window.parent.location.reload();
		//window.parent.CloseManageFrame();
		//window.parent.location.reload();
		//location.href="/admin/?dir=log&menu=Business_log&open=52";
		//location.href="/admin/log/pop_log_write.html?input_date=<?=$date?>";
		</script>
<?
			exit;


		
	}
}
else if($mode == "update" && $seq) {
	$start_time = $start_time1.":".$start_time2;
	$end_time = $start_time3.":".$start_time4;

	if(strtotime($start_time) >= strtotime($end_time)){
	?>
		<script>
		alert("알 수 없는 오류로 정상적으로 처리되지 못했습니다.");
		window.parent.location.reload();
		</script>
<?
			exit;
	}



	$que = "update reserve_outchecklist set start_day='".$start_day."', start_time='".$start_time."', end_time='".$end_time."', driver_name='".$driver_name."',  number_limit='".$number_limit."',  car_sort='".$car_sort."',  business_name='".$name."',reserve_sort='".$reserve_sort."', comment='".$comment."' where seq='".$seq."'";


	MYSQL_QUERY($que);
	MYSQL_CLOSE();
	?>
		<script>
		alert("수정 되었습니다.");
		window.parent.location.reload();
		</script>
<?
			exit;
}
else if($mode == "del" && $seq) {
	
	MYSQL_QUERY("UPDATE reserve_outchecklist SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();
		?>
		<script>
		alert("삭제 되었습니다.");
		window.parent.location.reload();
		</script>
<?
			exit;
}
?>