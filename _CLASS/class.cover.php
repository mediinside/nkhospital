<?
CLASS Cover extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	// desc	 : 커버스토리 삭제
	// auth  : JH 2013-09-13
	// param 
	function Cover_Info_Del($args ='') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzinecover
			set
				twzc_del_flag = 'Y'
			where
				twzc_idx = '$twzc_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 커버스토리 수정
	// auth  : JH 2013-09-13
	// param 
	function Cover_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzinecover
			set
				twz_idx = '$twz_idx',
				ct_idx = '$ct_idx',
				twzc_name = '$twzc_name',
				twzc_img_980 = '$twzc_img_980',
				twzc_img_768 = '$twzc_img_768',
				twzc_img_640 = '$twzc_img_640',
				twzc_img_320 = '$twzc_img_320',
				twzc_show = '$twzc_show'				
			where
				twzc_idx = '$twzc_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 커버스토리 이미지 삭제
	// auth  : JH 2013-09-13
	// param 
	function SlideImgUpdate($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		switch ($type) {
			case "980":	$add_qry = " twzc_img_980 = '' "; break;	
			case "768":	$add_qry = " twzc_img_768 = '' ";			break;											
			case "640":	$add_qry = " twzc_img_640 = '' ";			break;											
			case "320":	$add_qry = " twzc_img_320 = '' ";			break;											
		}

		$qry = "
			UPDATE
				tblwebzinecover
			SET
				$add_qry
			where
				twzc_idx = '$twzc_idx'
			";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 커버스토리 내용
	// auth  : JH 2013-09-13
	// param 
	function Cover_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select * from tblwebzinecover where twzc_idx= '$twzc_idx' ";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		return $rst;
	}
	
	
	// desc	 : 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function Cover_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		//twzc_idx = 1
		//twz_idx= 5
		//twzc_desc = 2
		//type = asc
		
		//월별 순위 변동
		if($twz_idx != '') {
			if($type == "asc") {	
				//내 상위 desc 번호와 twzc_idx를 가져오기
				$qry = " select twzc_idx, twzc_desc from tblwebzinecover where twz_idx='$twz_idx' and twzc_desc > '$twzc_desc' order by twzc_desc asc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$top_desc = $rst['twzc_desc'];
				$top_idx = $rst['twzc_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzinecover set twzc_desc = '$top_desc' where twzc_idx = '$twzc_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzinecover set twzc_desc = '$twzc_desc' where twzc_idx = '$top_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {	
				//내 상위 desc 번호와 twzc_idx를 가져오기
				$qry = " select twzc_idx, twzc_desc from tblwebzinecover where twz_idx='$twz_idx' and twzc_desc < '$twzc_desc' order by twzc_desc desc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$down_desc = $rst['twzc_desc'];
				$down_idx = $rst['twzc_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzinecover set twzc_desc = '$down_desc' where twzc_idx = '$twzc_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzinecover set twzc_desc = '$twzc_desc' where twzc_idx = '$down_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
		}else{ //전체
			if($type == "asc") {
				
				$up_desc = $twzc_desc + 1;
				
				$qry = "select twzc_idx from tblwebzinecover where twzc_desc = '$up_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzc_idx'];
				
				$qry1 = " update tblwebzinecover set twzc_desc = twzc_desc - 1 where twzc_idx = '$one_twz' ";					
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				
				$qry2 = " update tblwebzinecover set twzc_desc = twzc_desc + 1 where twzc_idx = '$twzc_idx' ";			
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {
				
				$dn_desc = $twzc_desc - 1;
				
				$qry = "select twzc_idx from tblwebzinecover where twzc_desc = '$dn_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzc_idx'];
				
				$qry1 = " update tblwebzinecover set twzc_desc = twzc_desc + 1 where twzc_idx = '$one_twz' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);			
				
				$qry2 = " update tblwebzinecover set twzc_desc = twzc_desc - 1 where twzc_idx = '$twzc_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
		}
		return $rst2;
	}
	
	// desc	 : 커버스토리 등록
	// auth  : JH 2013-09-13
	// param 
	function Cover_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select twzc_desc from tblwebzinecover order by twzc_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		
		if($rst) {
			$twzc_desc = $rst['twzc_desc'] + 1;
		}else{
			$twzc_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblwebzinecover
				(
				 	twzc_idx,
					twz_idx,
					ct_idx,
					twzc_name,
					twzc_img_980,
					twzc_img_768,
					twzc_img_640,
					twzc_img_320,
					twzc_show,
					twzc_desc,
					twzc_del_flag,
					twzc_regdate
				)
				VALUES
				(
					''
					, '$twz_idx'
					, '$ct_idx'
					, '$twzc_name'
					, '$twzc_img_980'
					, '$twzc_img_768'
					, '$twzc_img_640'
					, '$twzc_img_320'
					, '$twzc_show'
					, '$twzc_desc'
					, '$twzc_del_flag'
					, NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);
		return $rst;
	}
	
	
	// desc	 : 메인 커버스토리 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Cover_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and TWZS.twzc_del_flag = 'N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " TWZS.twzc_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if ($twz_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZS.twz_idx = '$twz_idx' ";
		}	
		
		if ($twzc_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZS.twzc_show = '$twzc_show' ";
		}
		
		if ($ct_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZS.ct_idx = '$ct_idx' ";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "TWZS.twzc_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "
													tblwebzinecover TWZS LEFT OUTER JOIN tblWebzine TWZ ON TWZS.twz_idx = TWZ.twz_idx
													LEFT OUTER JOIN tblCategory CT ON TWZS.ct_idx = CT.ct_idx
												";
		$args['q_where'] = $addQry;
		$args['q_order'] = "TWZS.twzc_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "twz_idx=". $twz_idx . "&twzc_show=". $twzc_show . "&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>