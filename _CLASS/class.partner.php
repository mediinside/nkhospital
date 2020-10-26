<?
CLASS Partner extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	// desc	 : 파트너 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Partner_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and tp_del_flag = 'N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " tp_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "tp_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblPartner";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tp_regdate desc";
		$args['q_group'] = "";

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	
	// desc	 : 파트너사 등록
	// auth  : JH 2013-09-13
	// param 
	function Partner_Info_Reg($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			INSERT INTO
				tblPartner
				(
					tp_idx,
					tp_name,
					tp_image,
					tp_homepage,
					tp_del_flag,
					tp_regdate
				)
				VALUES
				(
					''
					, '$tp_name'
					, '$tp_image'
					, '$tp_homepage'
					, '$tp_del_flag'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	// desc	 : 파트너사 정보 수정
	// auth  : JH 2013-09-13
	// param
	function Partner_Info_Modify($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblPartner
			set
				tp_name = '$tp_name',
				tp_image = '$tp_image',
				tp_homepage = '$tp_homepage'
			where
				tp_idx = '$tp_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 파트너사 정보 삭제
	// auth  : JH 2013-09-13
	// param
	function Partner_Info_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblPartner
			set
				tp_del_flag = 'Y'
			where
				tp_idx = '$tp_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 파트너사 정보
	// auth  : JH 2013-09-13
	// param
	function Partner_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblPartner where tp_idx = '$tp_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 파트너사 이미지 삭제
	// auth  : JH 2013-09-13
	// param
	function Partner_ImgUpdate($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblPartner
			set
				tp_image = ''
			where
				tp_idx = '$tp_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
		
	}
	
}
?>