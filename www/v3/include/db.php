<?
include $root_path."class/database/database.class.php";
include $root_path."class/database/database.mysql.class.php";

//DB 설정
$host="localhost";
$user="nkmed";
$pass="nk9809114";
$dbname="nkmed";

//데이터 베이스 클래스 선언
$db = new mysql($host,$user,$pass,$dbname,1);
@mysql_query("set names utf-8");
?>
