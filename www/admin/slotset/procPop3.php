<?
session_start();

include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";




$start_time = $start_time1.":".$start_time2;
$end_time = $start_time3.":".$start_time4;


if($mode == "new") {
	
	if(strtotime($start_time) >= strtotime($end_time)){

	?>
	<script>
		alert("끝나는 시간이 시작 시간보다 크게 설정되어있습니다.");
		history.back();
	</script>
	<?
		exit;
	}

	MYSQL_QUERY("INSERT INTO reserve_transport(
	code,
	start_day,
	start_time,
	end_time,
	driver_name,
	number_limit,
	car_sort,
	business_name,
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
	'".$comment."',
	now(),
	'".$sess_AID."',
	'".$sess_ANM."',
	'Y'
	)");
	$newSeq = mysql_insert_id();


	if(!$newSeq) {
		MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('알 수 없는 오류로 정상적으로 처리되지 못했습니다.'); history.go(-1);</script>";
		exit;
	}
	else {
		
		
		MYSQL_CLOSE();
		
		echo "<script language='JavaScript'>alert('예약 되었습니다.');parent.location.reload();</script>";
		exit;
	}
}
else if($mode == "update" && $seq) {
	if(strtotime($start_time) >= strtotime($end_time)){
	?>
	<script>
		alert("시간 설정이 잘못되었습니다.");
		history.back();
	</script>
	<?
		exit;
	}


	$que = "update reserve_transport set start_day='".$start_day."', start_time='".$start_time."', end_time='".$end_time."', driver_name='".$driver_name."',  number_limit='".$number_limit."',  car_sort='".$car_sort."',  business_name='".$name."', comment='".$comment."' where seq='".$seq."'";


	MYSQL_QUERY($que);
	MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('수정 되었습니다.');parent.location.reload();</script>";
		exit;
}
else if($mode == "del" && $seq) {
	
	MYSQL_QUERY("UPDATE reserve_transport SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();

	echo "<script language='JavaScript'>alert('삭제 되었습니다.');parent.location.reload();</script>";
	exit;
}
?>