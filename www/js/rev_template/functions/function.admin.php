<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}

include_once(CLS."class.list.php");
$C_ListClass 	= new ListClass;


/*****************************************************************************************
//게시판 관리 리스트
*****************************************************************************************/
	function getBoardList ($args = '') {
		global $db;
		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";

		if($jb_code_in != '') {
			$addQry .= " and  jb_code in (" . $jb_code_in . ") ";
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "idx";
		$args['q_col'] = "*";
		$args['q_table'] = BOARD_ADMIN_TABLE;
		$args['q_where'] = $addQry;
		$args['q_order'] = "bd_code asc";
		$args['q_group'] = "";
		$args['tail'] = "";
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
?>



















