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
	if(state == "Y") txtValue = "����";
	else if(state == "N") txtValue = "���";

	if(confirm(txtValue + '���·� �����Ͻðڽ��ϱ�?')) {
		location.replace(dir+"/js.chgState.php?tbl=" + tbl + "&seq=" + seq + "&state=" + state);
	}
}
//-->
</script>