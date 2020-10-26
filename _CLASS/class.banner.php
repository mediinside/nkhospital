<?
CLASS Banner extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	// desc	 : 배너 이미지 삭제
	// auth  : JH 2013-09-13
	// param 
	function BannerImgUpdate($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			UPDATE
				tblBanner
			SET
				bn_img = ''
			where
				bn_idx = '$bn_idx'
			";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 배너 상세
	// auth  : JH 2013-09-13
	// param 
	function Banner_Info($args='') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
			select * from tblBanner where bn_idx='$bn_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 배너 수정
	// auth  : JH 2013-09-13
	// param 
	function BANNER_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblBanner
			set
				bn_title = '$bn_title',
				bn_link = '$bn_link',
				bn_type = '$bn_type',
				bn_img = '$bn_img',
				bn_show = '$bn_show'
			where
				bn_idx = '$bn_idx'						
			";			
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	
	// desc	 : 배너 삭제
	// auth  : JH 2013-09-13
	// param 
	function BANNER_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "update tblBanner set bn_del_flag = 'Y' where bn_idx = '$bn_idx'";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 배너 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function BANNER_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $bn_desc + 1;
			
			$qry = "select bn_idx from tblBanner where bn_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['bn_idx'];
			
			$qry = " update tblBanner set bn_desc = bn_desc - 1 where bn_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblBanner set bn_desc = bn_desc + 1 where bn_idx = '$bn_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $bn_desc - 1;
			
			$qry = "select bn_idx from tblBanner where bn_desc = '$dn_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['bn_idx'];
			
			$qry = " update tblBanner set bn_desc = bn_desc + 1 where bn_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblBanner set bn_desc = bn_desc - 1 where bn_idx = '$bn_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		return $rst;
	}
	
	// desc	 : 배너 등록
	// auth  : JH 2013-09-13
	// param 
	function Banner_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select bn_desc  from tblBanner order by bn_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$bn_desc = $rst['bn_desc'] + 1;
		}else{
			$bn_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblBanner
				(
					bn_idx,
					bn_title,
					bn_link,
					bn_type,
					bn_img,
					bn_desc,
					bn_show,
					bn_regdate
				)
				VALUES
				(
					''
					, '$bn_title'
					, '$bn_link'
					, '$bn_type'
					, '$bn_img'
					, '$bn_desc'
					, '$bn_show'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);
		return $rst;
	}
	
	// desc	 : 배너리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Banner_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and bn_del_flag ='N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " bn_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if ($bn_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " bn_show = '$bn_show' ";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "bn_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblBanner";
		$args['q_where'] = $addQry;
		$args['q_order'] = "bn_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>