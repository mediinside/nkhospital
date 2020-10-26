<?
session_start();

include "../inc/dbConn.php";
include "../inc/chkLogin.php";

$car_name = addslashes($car_name);
$car_name2 = addslashes($car_name2);

if($mode == "new") {
	
	
	MYSQL_QUERY("INSERT INTO reserve_car(car_name,car_name2,car_number,car_sort,car_limit,comment,reg_date,reg_id,view_state) VALUES('$car_name','$car_name2','$car_number','$car_sort','$car_limit','$comment',now(),'$sess_AID','Y')");
	$newSeq = mysql_insert_id();

	if(!$newSeq) {
		MYSQL_CLOSE();
		echo "<script language='JavaScript'>alert('알 수 없는 오류로 정상적으로 처리되지 못했습니다.'); history.go(-1);</script>";
		exit;
	}
	else {
		

		MYSQL_CLOSE();
		
		echo "<script language='JavaScript'>parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."'</script>";
		exit;
	}
}
else if($mode == "modify" && $seq) {

	$que = "update reserve_car set car_name='".$car_name."', car_name2='".$car_name2."', car_number='".$car_number."', car_sort='".$car_sort."', car_limit='".$car_limit."', comment='".$comment."' where seq='".$seq."'";
	
	MYSQL_QUERY($que);
	MYSQL_CLOSE();
		echo "<script language='JavaScript'>parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."'</script>";
		exit;
}
else if($mode == "del" && $seq) {
	MYSQL_QUERY("UPDATE reserve_car SET view_state='N' WHERE seq='".$seq."'");

	MYSQL_CLOSE();

	echo "<script language='JavaScript'>parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."'</script>";
	exit;
}
?>