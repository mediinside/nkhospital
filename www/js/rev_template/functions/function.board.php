<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}
/*****************************************************************************************
//게시판 관리 리스트
*****************************************************************************************/
	function Board_Config_Data($bd_code) {
		global $db;
		//if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "select * from ".BOARD_ADMIN_TABLE." where bd_code='$bd_code'";
		$db->sql($qry);
		$db->exec();
		$rst = $db->mfa();
		return $rst;
	}
/*****************************************************************************************
//맥스 글번호
*****************************************************************************************/
	function Board_Depth_Max($table,$column,$where) {
		global $db;
		$db->sql("select MAX($column) AS max_depth from $table $where");
		$db->exec();
		$rst = $db->mfa();
		return $rst;
	}	

?>



















