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
		alert("������ �ð��� ���� �ð����� ũ�� �����Ǿ��ֽ��ϴ�.");
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
		echo "<script language='JavaScript'>alert('�� �� ���� ������ ���������� ó������ ���߽��ϴ�.'); history.go(-1);</script>";
		exit;
	}
	else {
		
		
		MYSQL_CLOSE();
		
		echo "<script language='JavaScript'>alert('���� �Ǿ����ϴ�.');parent.location.reload();</script>";
		exit;
	}
}
else if($mode == "update" && $seq) {
	if(strtotime($start_time) >= strtotime($end_time)){
	?>
	<script>
		alert("�ð� ������ �߸��Ǿ����ϴ�.");
		history.back();
	</script>
	<?
		exit;
	}


	$que = "update reserve_transport set start_day='".$start_day."', start_time='".$start_time."', end_time='".$end_time."', driver_name='".$driver_name."',  number_limit='".$number_limit."',  car_sort='".$car_sort."',  business_name='".$name."', comment='".$comment."' where seq='".$seq."'";


	MYSQL_QUERY($que);
	MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('���� �Ǿ����ϴ�.');parent.location.reload();</script>";
		exit;
}
else if($mode == "del" && $seq) {
	
	MYSQL_QUERY("UPDATE reserve_transport SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();

	echo "<script language='JavaScript'>alert('���� �Ǿ����ϴ�.');parent.location.reload();</script>";
	exit;
}
?>