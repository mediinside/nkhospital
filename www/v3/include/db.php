<?
include $root_path."class/database/database.class.php";
include $root_path."class/database/database.mysql.class.php";

//DB ����
$host="localhost";
$user="nkmed";
$pass="nk9809114";
$dbname="nkmed";

//������ ���̽� Ŭ���� ����
$db = new mysql($host,$user,$pass,$dbname,1);
@mysql_query("set names utf-8");
?>
