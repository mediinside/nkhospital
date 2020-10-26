<?
CLASS Slide extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	// desc	 : 슬라이드 삭제
	// auth  : JH 2013-09-13
	// param 
	function Slide_Info_Del($args ='') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzineslide
			set
				twzs_del_flag = 'Y'
			where
				twzs_idx = '$twzs_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 슬라이드 수정
	// auth  : JH 2013-09-13
	// param 
	function Slide_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzineslide
			set
				twz_idx = '$twz_idx',
				twzs_name = '$twzs_name',
				twzs_img_980 = '$twzs_img_980',
				twzs_img_768 = '$twzs_img_768',
				twzs_img_640 = '$twzs_img_640',
				twzs_img_320 = '$twzs_img_320',
				twzs_show = '$twzs_show'				
			where
				twzs_idx = '$twzs_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 슬라이드 이미지 삭제
	// auth  : JH 2013-09-13
	// param 
	function SlideImgUpdate($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		switch ($type) {
			case "980":	$add_qry = " twzs_img_980 = '' "; break;	
			case "768":	$add_qry = " twzs_img_768 = '' ";			break;											
			case "640":	$add_qry = " twzs_img_640 = '' ";			break;											
			case "320":	$add_qry = " twzs_img_320 = '' ";			break;											
		}

		$qry = "
			UPDATE
				tblwebzineslide
			SET
				$add_qry
			where
				twzs_idx = '$twzs_idx'
			";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 슬라이드 내용
	// auth  : JH 2013-09-13
	// param 
	function Slide_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select * from tblwebzineslide where twzs_idx= '$twzs_idx' ";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		return $rst;
	}
	
	
	// desc	 : 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function Slide_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		//twzs_idx = 1
		//twz_idx= 5
		//twzs_desc = 2
		//type = asc
		
		//월별 순위 변동
		if($twz_idx != '') {
			if($type == "asc") {	
				//내 상위 desc 번호와 twzs_idx를 가져오기
				$qry = " select twzs_idx, twzs_desc from tblwebzineslide where twz_idx='$twz_idx' and twzs_desc > '$twzs_desc' order by twzs_desc asc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$top_desc = $rst['twzs_desc'];
				$top_idx = $rst['twzs_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzineslide set twzs_desc = '$top_desc' where twzs_idx = '$twzs_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzineslide set twzs_desc = '$twzs_desc' where twzs_idx = '$top_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {	
				//내 상위 desc 번호와 twzs_idx를 가져오기
				$qry = " select twzs_idx, twzs_desc from tblwebzineslide where twz_idx='$twz_idx' and twzs_desc < '$twzs_desc' order by twzs_desc desc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$down_desc = $rst['twzs_desc'];
				$down_idx = $rst['twzs_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzineslide set twzs_desc = '$down_desc' where twzs_idx = '$twzs_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzineslide set twzs_desc = '$twzs_desc' where twzs_idx = '$down_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
		}else{ //전체
			if($type == "asc") {
				
				$up_desc = $twzs_desc + 1;
				
				$qry = "select twzs_idx from tblwebzineslide where twzs_desc = '$up_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzs_idx'];
				
				$qry1 = " update tblwebzineslide set twzs_desc = twzs_desc - 1 where twzs_idx = '$one_twz' ";					
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				
				$qry2 = " update tblwebzineslide set twzs_desc = twzs_desc + 1 where twzs_idx = '$twzs_idx' ";			
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {
				
				$dn_desc = $twzs_desc - 1;
				
				$qry = "select twzs_idx from tblwebzineslide where twzs_desc = '$dn_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzs_idx'];
				
				$qry1 = " update tblwebzineslide set twzs_desc = twzs_desc + 1 where twzs_idx = '$one_twz' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);			
				
				$qry2 = " update tblwebzineslide set twzs_desc = twzs_desc - 1 where twzs_idx = '$twzs_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
		}
		return $rst2;
	}
	
	// desc	 : 슬라이드 등록
	// auth  : JH 2013-09-13
	// param 
	function Slide_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select twzs_desc from tblwebzineslide order by twzs_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		
		if($rst) {
			$twzs_desc = $rst['twzs_desc'] + 1;
		}else{
			$twzs_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblwebzineslide
				(
				 	twzs_idx,
					twz_idx,
					twzs_name,
					twzs_img_980,
					twzs_img_768,
					twzs_img_640,
					twzs_img_320,
					twzs_show,
					twzs_desc,
					twzs_del_flag,
					twzs_regdate
				)
				VALUES
				(
					''
					, '$twz_idx'
					, '$twzs_name'
					, '$twzs_img_980'
					, '$twzs_img_768'
					, '$twzs_img_640'
					, '$twzs_img_320'
					, '$twzs_show'
					, '$twzs_desc'
					, '$twzs_del_flag'
					, NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);
		return $rst;
	}
	
	
	// desc	 : 메인 슬라이드 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Slide_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and TWZS.twzs_del_flag = 'N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " TWZS.twzs_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if ($twz_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZS.twz_idx = '$twz_idx' ";
		}	
		
		if ($twzs_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZS.twzs_show = '$twzs_show' ";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "TWZS.twzs_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblwebzineslide TWZS LEFT OUTER JOIN tblWebzine TWZ ON TWZS.twz_idx = TWZ.twz_idx";
		$args['q_where'] = $addQry;
		$args['q_order'] = "TWZS.twzs_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "twz_idx=". $twz_idx . "&twzs_show=". $twzs_show . "&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>