<?
CLASS Nonpay extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	
	// desc	 : 비급여 항목 삭제
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Info_Del_New($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			delete from tblNonPay_new where np_idx = '$np_idx'				
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;	
	}
	
	// desc	 : 비급여 항목 정보
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_info_New($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblNonPay_new	where	np_idx = '$np_idx'
		";
		$rst = $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
		// desc	 : 비급여 항목 수정
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Info_Modi_New($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblNonPay_new
			set
				cate1 = '$cate1',
				cate2 = '$cate2',
				np_bunru = '$np_bunru',
				np_item = '$np_item',
				np_code = '$np_code',
				np_gubun = '$np_gubun',
				np_price = '$np_price',
				np_row_price = '$np_row_price',
				np_high_price = '$np_high_price',
				np_percent = '$np_percent',
				np_ck1 = '$np_ck1',
				np_ck2 = '$np_ck2',
				np_gita = '$np_gita'				
			where
				np_idx = '$np_idx'				
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;	
	}
	
	
	// desc	 : 비급여 등록
	// auth  : JH 2013-09-16 월요일
	// param	
	function NonPay_Info_Reg_New($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			INSERT INTO
			tblNonPay_new
			(
			np_idx,
			cate1,			
			cate2,
			np_bunru,	
			np_item,	
			np_code,	
			np_gubun,	
			np_price,	
			np_row_price,	
			np_high_price,	
			np_percent,
			np_ck1,
			np_ck2,
			np_gita,
			np_regdate
			)
			VALUES
			(
			''
			, '$cate1'
			, '$cate2'
			, '$np_bunru'
			, '$np_item'
			, '$np_code'
			, '$np_gubun'
			, '$np_price'
			, '$np_row_price'
			, '$np_high_price'
			, '$np_percent'
			, '$np_ck1'
			, '$np_ck2'
			, '$np_gita'
			, NOW()
			)
		";
		$rst = $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	
	
	
	// desc	 : 비급여 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_List_new ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";
		
		if($cate1 != '') {
			$addQry .= "
				AND cate1 = '$cate1' 
			";
		}
		
		if($np_item != '') {
			$addQry .= "
				AND np_item like '%$np_item%' 
			";
		}

		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "np_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblNonPay_new ";
		$args['q_where'] = $addQry;
		
		if($masc == "asc") {
			$args['q_order'] = "np_idx asc";
		}else{
			$args['q_order'] = "np_idx desc";
		}
		$args['q_group'] = "";

		$args['tail'] = "cate1=$cate1&np_item=$np_item ";
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// desc	 : 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function Cate_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $npc_desc + 1;
			
			$qry = "select npc_idx from tblNonPayCate where npc_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['npc_idx'];
			
			$qry = " update tblNonPayCate set npc_desc = npc_desc - 1 where npc_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblNonPayCate set npc_desc = npc_desc + 1 where npc_idx = '$npc_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $npc_desc - 1;
			
			$qry = "select npc_idx from tblNonPayCate where npc_desc = '$dn_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['npc_idx'];
			
			$qry = " update tblNonPayCate set npc_desc = npc_desc + 1 where npc_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblNonPayCate set npc_desc = npc_desc - 1 where npc_idx = '$npc_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		return $rst;
	}
	
	
	// desc	 : 메인 비급여 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Front_list($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblNonPay where npc_idx = '$npc_idx' order by np_idx asc				
		";
		$rst = $this -> DB -> execSqlList($qry);
		return $rst;	
	}
	
	// desc	 : 비급여 항목 삭제
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			delete from tblNonPay where np_idx = '$np_idx'				
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;	
	}
	
	// desc	 : 비급여 항목 수정
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblNonPay
			set
				npc_idx = '$npc_idx',
				np_item = '$np_item',
				np_price = '$np_price'				
			where
				np_idx = '$np_idx'				
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;	
	}
	
	
	// desc	 : 비급여 항목 정보
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblNonPay	where	np_idx = '$np_idx'
		";
		$rst = $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 비급여 등록
	// auth  : JH 2013-09-16 월요일
	// param	
	function NonPay_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			INSERT INTO
			tblNonPay
			(
			np_idx,
			npc_idx,			
			np_item,
			np_price,		
			np_regdate
			)
			VALUES
			(
			''
			, '$npc_idx'
			, '$np_item'
			, '$np_price'
			, NOW()
			)
		";
		$rst = $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	// desc	 : 비급여 카테고리 모두
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_ALL($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblNonPayCate where npc_delflag = 'N' order by npc_desc asc
		";
		$rst = $this -> DB -> execSqlList($qry);
		return $rst;
		
	}
	
	// desc	 : 비급여 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";
		
		if($npc_idx) {
			$addQry .= "
				AND NP.npc_idx = '$npc_idx' 
			";
		}
		
		if($np_item) {
			$addQry .= "
				AND NP.np_item like '%$np_item%' 
			";
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "np_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblNonPay NP LEFT OUTER JOIN tblNonPayCate NPC ON NP.npc_idx=NPC.npc_idx ";
		$args['q_where'] = $addQry;
		$args['q_order'] = "np_idx desc";
		$args['q_group'] = "";

		$args['tail'] = "npc_idx=$npc_idx&np_item=$np_item ";
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	
	// desc	 : 카테고리 삭제
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblNonPayCate
			set
				npc_delflag = 'Y'
			where
				npc_idx = '$npc_idx'
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 카테고리 정보수정
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_Info_Modify($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblNonPayCate
			set
				npc_name = '$npc_name'
			where
				npc_idx = '$npc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 카테고리 정보
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblNonPayCate where npc_idx = '$npc_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	
	// desc	 : 카테고리 등록
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select npc_desc  from tblNonPayCate order by npc_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$npc_desc = $rst['npc_desc'] + 1;
		}else{
			$npc_desc = 1;
		}
		
		$qry = "
			INSERT INTO
			tblNonPayCate
			(
			npc_idx,			
			npc_name,
			npc_regdate,
			npc_delflag,
			npc_desc
			)
			VALUES
			(
			''
			, '$npc_name'
			, NOW()
			, 'N'
			, '$npc_desc'
			)
		";

		$rst = $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	
	// desc	 : 카테고리 중복체크
	// auth  : JH 2013-09-16 월요일
	// param
	function DobuleCateCheck($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select count(*) as cnt from tblNonPayCate where npc_name='$npc_name' and npc_delflag  ='N'			
		";	
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	
	// desc	 : 게시판 관리 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function NonPay_Cate_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and npc_delflag ='N'";

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "npc_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblNonPayCate";
		$args['q_where'] = $addQry;
		$args['q_order'] = "npc_desc asc";
		$args['q_group'] = "";

		$args['tail'] = "";
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>