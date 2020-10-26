<?
CLASS Agree extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	function Agree_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblAgreement where ag_idx = '$ag_idx'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}	
	function Agree_Reg($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "
			INSERT INTO
				tblAgreement
				(
					ag_idx,
					ag_hospital,
					ag_name,
					ag_mobile,
					ag_email,										
					ag_homepage,
					ag_content,
					ag_delflag,
					ag_regdate
				)
				VALUES
				(
					''
					, '$ag_hospital'
					, '$ag_name'
					, '$ag_mobile'
					, '$ag_email'										
					, '$ag_homepage'
					, '$ag_content'					
					, 'N'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}


	function Agree_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;
		$tail = "";
		$addQry = " 1=1 and ag_delflag='N' ";
		

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " ag_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 20;
		$args['q_idx'] = "ag_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblAgreement";
		$args['q_where'] = $addQry;
		if($orderby != '') {
			$args['q_order'] = " $orderby ";
		}else{
			$args['q_order'] = " ag_regdate desc";
		}
		$args['q_group'] = "";
		

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
}
?>