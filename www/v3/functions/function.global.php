<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}
include $root_path."functions/function.query.php";

/*****************************************************************************************
//글로벌  등록 함수
*****************************************************************************************/
function db_insert($info,$table){

    global $db;
    $db->sql(make_query_by_array($table,$info,""));
	//$db->print_sql();
	$db->exec();
}

/*****************************************************************************************
//글로벌  수정 함수
*****************************************************************************************/
function db_modify($info,$table,$where){

    global $db;
    $db->sql(make_query_by_array($table,$info,$where));
	//$db->print_sql();
	$db->exec();
}

/*****************************************************************************************
//글로벌  삭제 함수
*****************************************************************************************/

function db_delete($table,$where)
{
    global $db;
    $db->sql("delete from $table where $where");
//	$db->print_sql();
    $db->exec();
}

/*****************************************************************************************
//글로벌 리턴 select 함수
*****************************************************************************************/

function db_select($query,$where, $order, $limit)
{
    global $db;
	if($where) $where = "where ".implode(" AND ",$where);
	
    $db->sql("$query $where $order $limit");
    $db->exec();
//	$db->print_sql();
	$count	= 0;
	$data	= array();
	while($rec = $db->mfa()){
		$data[$count] = $rec;
		$count++;
	}
	$db->mfr();
	return $data;
}

/*****************************************************************************************
//글로벌 page count 함수
*****************************************************************************************/

function db_cnt_page($query,$where)
{
	global $db;
	$db->sql("
				SELECT count(*) FROM $query $where
			");
	$db->exec();
	$total = $db->mr(0,0);
	return $total;	
}

//==============================================================================================
# TABLE FIELD
//==============================================================================================
function db_table_list($table,$where) {
	global $db;
	$db->sql(" desc $table");
	$db->exec();
	$count	= 0;
	$data	= array();
	while($row = $db->mfa()){
		$data[$count] = $row;
		$count++;
	}	
	return $data;
}

/*****************************************************************************************
//글로벌  등록 함수
*****************************************************************************************/
function db_insert_r($info,$table){

    global $db;
    $db->sql(make_query_by_array($table,$info,""));
	$rst = $db->exec2();
	return $rst;
}
?>