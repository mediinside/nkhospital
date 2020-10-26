<?
CLASS Category extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}	
	
	// desc	 : 카테고리 리스트
	// auth  : JH 2013-09-16 월요일
	// param	
	function Cate_List($args = '') {
		$qry = " select * from tblCategory order by ct_desc desc";
		$rst = $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 상세
	// auth  : JH 2013-09-13
	// param 
	function Cate_Info($args='') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
			select * from tblCategory where ct_idx='$ct_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 수정
	// auth  : JH 2013-09-13
	// param 
	function Cate_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblCategory
			set
				ct_name = '$ct_name',
				ct_show = '$ct_show'
			where
				ct_idx = '$ct_idx'						
			";			
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	
	// desc	 : 배너 삭제
	// auth  : JH 2013-09-13
	// param 
	function Cate_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "update tblCategory set ct_del_flag = 'Y' where ct_idx = '$ct_idx'";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function Cate_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $ct_desc + 1;
			
			$qry = "select ct_idx from tblCategory where ct_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['ct_idx'];
			
			$qry = " update tblCategory set ct_desc = ct_desc - 1 where ct_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblCategory set ct_desc = ct_desc + 1 where ct_idx = '$ct_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $ct_desc - 1;
			
			$qry = "select ct_idx from tblCategory where ct_desc = '$dn_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['ct_idx'];
			
			$qry = " update tblCategory set ct_desc = ct_desc + 1 where ct_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblCategory set ct_desc = ct_desc - 1 where ct_idx = '$ct_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		return $rst;
	}
	
	// desc	 : 카테고리 등록
	// auth  : JH 2013-09-13
	// param 
	function Cate_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select ct_desc  from tblCategory order by ct_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$ct_desc = $rst['ct_desc'] + 1;
		}else{
			$ct_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblCategory
				(
					ct_idx,
					ct_name,
					ct_desc,
					ct_show,
					ct_regdate
				)
				VALUES
				(
					''
					, '$ct_name'
					, '$ct_desc'
					, '$ct_show'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);
		return $rst;
	}
	
	// desc	 : 카테고리 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Category_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and ct_del_flag ='N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " ct_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "ct_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblCategory";
		$args['q_where'] = $addQry;
		$args['q_order'] = "ct_desc asc";
		$args['q_group'] = "";

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>