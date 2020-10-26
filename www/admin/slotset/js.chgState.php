<script language="JavaScript">
<!--
<?
if ($seq && $state) {
	include "../inc/dbConn.php";

	if($state == "Y") {
		$chgState = "N";
	}
	else if($state == "N") {
		$chgState = "Y";
	}
	
	$query = "select * from $tbl where seq='$seq'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);

	MYSQL_QUERY("UPDATE ".$tbl." SET state='".$chgState."' WHERE seq='".$seq."'");

	echo "parent.location.reload();";

	MYSQL_CLOSE();
}
?>

function chgState(dir, tbl, seq, state) {
	if(state == "Y") txtValue = "중지";
	else if(state == "N") txtValue = "사용";

	if(confirm(txtValue + '상태로 변경하시겠습니까?')) {
		location.replace(dir+"/js.chgState.php?tbl=" + tbl + "&seq=" + seq + "&state=" + state);
	}
}
//-->
</script>