<?
session_start();

include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/func.php";


	$list_seq = explode("|",$total_seq);
	$k=0;
	for($i=0;$i<sizeof($list_seq)-1;$i++){
		$query = "delete from reserve_list_new where seq='".$list_seq[$i]."'";
		//echo $query."<br>";
		$result = mysql_query($query);
	}
	echo "<script language='JavaScript'>alert('엑셀로 추가된 모두 리스트가 삭제되었습니다.');parent.location.href='../index.html?dir=slotset&menu=Reserve3'</script>";

?>
