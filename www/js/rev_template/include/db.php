<?
include $root_path."class/database/database.class.php";
include $root_path."class/database/database.mysql.class.php";
include $root_path."class/database/ora.database.class.php";

//DB ����
$host="211.115.222.195";
$user="medirev";
$pass="medirev20!^Db";
$dbname="medirev";

//������ ���̽� Ŭ���� ����
$db = new mysql($host,$user,$pass,$dbname,1);
$ora_db = new Oracle(); 

@mysql_query("set names utf-8");
?>
