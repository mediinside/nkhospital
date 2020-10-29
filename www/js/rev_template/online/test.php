<?//=$_SERVER['SERVER_ADDR'];?>
<?
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors", 1);

/*
$conn = oci_connect('mediinside', 'medi1234', "(DESCRIPTION = 
                                                                  (ADDRESS = (PROTOCOL = tcp) (HOST = 119.197.19.46) (PORT = 1521))
                                                                  (CONNECT_DATA = (SID = cit))
                                                              )");
															  
echo $conn;		
*/
/*
//DB 설정 ORACLE
 $ORA_IP= "119.197.19.46"; 
 $ORA_SID= "cit"; 
 $ORA_DB = "mediinside"; 
 $ORA_DB_PASSWD= "medi1234"; 
 $ORA_CHAR_SET= "KO16KSC5601"; 

 $strDB ="(DESCRIPTION = ( ADDRESS =(PROTOCOL = TCP)(HOST = ".$ORA_IP.")(PORT = 1521)) (CONNECT_DATA = (SID = ".$ORA_SID.")) )"; 
// oracle Connect
 $db_ora=oci_connect($ORA_DB,$ORA_DB_PASSWD,$strDB,$ORA_CHAR_SET) or die(ocierror());
 	
//echo $db_ora;

$qry = "select object_name from user_objects where object_type = 'TABLE'";
$parse = oci_parse($db_ora, $qry);
oci_execute($parse);

while($rec = oci_fetch_array($parse,OCI_ASSOC+OCI_RETURN_NULLS)){
	
	echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		echo "test";
    }
    echo "</tr>\n";
}


$qry = "select * from dreamer.BTC_Doctor A inner join dreamer.BTC_Dept B On (A.DrDept1 = B.DeptCode OR A.DrDept2 = B.DeptCode) where A.ExpireFlag = 0 and DEPTNAMEK = '소아청소년과'";
$parse = oci_parse($db_ora, $qry);
oci_execute($parse);

while($rec = oci_fetch_array($parse,OCI_ASSOC+OCI_RETURN_NULLS)){
	echo print_r($rec);	
	echo "<br><br>";
}



$qry = "select * from dreamer.BTC_DrSchedule where DRCODE = 1042 and SCHDATE > '2016-06-08'";
$parse = oci_parse($db_ora, $qry);
oci_execute($parse);
echo "=================================================<br><br>";
while($rec = oci_fetch_array($parse,OCI_ASSOC+OCI_RETURN_NULLS)){
	echo print_r($rec);	
	echo "<br><br>";
}


$qry = "select * from dreamer.ORD_OrderReserved where DrCode = 1042 and ReservedDate > '2016-06-08' order by ReservedDate asc";
$parse = oci_parse($db_ora, $qry);
oci_execute($parse);
echo "=================================================<br><br>";
while($rec = oci_fetch_array($parse,OCI_ASSOC+OCI_RETURN_NULLS)){
	echo print_r($rec);	
	echo "<br><br>";
}
*/
	include "../class/database/ora.database.class.php";
	$db = new Oracle(); 
	
	$query = "select * from dreamer.ORD_OrderReserved where DrCode = 1042 and ReservedDate = '2016-06-20' order by RESERVEDTIME asc"; 
	$rs = $db->selectList($query); 
	for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
		echo $rs["PTNO"][$i]."//".$rs["DRCODE"][$i]."//".$rs["DEPTCODE"][$i]."//".$rs["RESERVEDDATE"][$i]."//".$rs["RESERVEDTIME"][$i]."//".$rs["IPDOPD"][$i]."//".$rs["USERNAME"][$i]."//".$rs["USERID"][$i]."<br>"; 
	} 

	$query = "select * from dreamer.BTC_Doctor A inner join dreamer.BTC_Dept B On (A.DrDept1 = B.DeptCode OR A.DrDept2 = B.DeptCode) where A.ExpireFlag = 0 and DEPTCODE = 'PE'";
	$rs = $db->selectList($query); 
	//print_r($rs);
	for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
		echo $rs["DRNAME"][$i]; 
		echo "<br><br>";
	} 	

	
	$query = "select * from dreamer.BTC_DrSchedule where DRCODE = 1042 and SCHDATE > '2016-06-15'";
	$rs = $db->selectList($query); 
	//print_r($rs);
	for( $i=0 ; $i < sizeof($rs["DRCODE"]) ; $i++ ){ 
		echo $rs["DEPTCODE"][$i]."//".$rs["DRCODE"][$i]."//".$rs["SCHDATE"][$i]."//".$rs["SCHCLASS"][$i]."//".$rs["STARTAM"][$i]."//".$rs["STARTPM"][$i]."<br>";
	}	
	
?>															  