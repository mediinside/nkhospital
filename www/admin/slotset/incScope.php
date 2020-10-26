<?
session_start();
include "../inc/dbConn.php";
include "../inc/chkLogin.php";

$i_query = "update reserve_holiday set item1='".$item1."', item2='".$item2."', item3='".$item3."', item4='".$item4."', item5='".$item5."', item6='".$item6."', item7='".$item7."' where seq='".$seq."'";
$result = mysql_query($i_query);
MYSQL_CLOSE();
echo "<script language='JavaScript'>parent.location.href='../index_reserve.html?dir=".$dir."&menu=".$menu."'</script>";

exit;
?>