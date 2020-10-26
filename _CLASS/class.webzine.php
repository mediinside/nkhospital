<?
CLASS Webzine extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	
	
	
	
	// desc	 : 웹진 삭제
	// auth  : JH 2013-09-13
	// param 
	function Webzine_Info_Del($args ='') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzineboard
			set
				twzb_del_flag = 'Y'
			where
				twzb_idx = '$twzb_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 웹진 수정
	// auth  : JH 2013-09-13
	// param 
	function WEBZINE_Info_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;				
		
		$qry = "
		 	UPDATE
				tblwebzineboard
			set
				twz_idx = '$twz_idx',
				ct_idx = '$ct_idx',
				twzb_type = '$twzb_type',
				twzb_title = '$twzb_title',
				twzb_name = '$twzb_name',
				twzb_email = '$twzb_email',
				twzb_content = '$twzb_content',
				twzb_s_content = '$twzb_s_content',
				twzb_default_img = '$twzb_default_img',
				twzb_width_img = '$twzb_width_img',
				twzb_height_img = '$twzb_height_img',
				twzb_banner_img = '$twzb_banner_img',
				twzb_banner_show = '$twzb_banner_show',
				twzb_edit_img = '$twzb_edit_img'
			where
				twzb_idx = '$twzb_idx'						
			";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	

	
	// desc	 : 웹진 이미지 삭제
	// auth  : JH 2013-09-13
	// param 
	function WebzineImgUpdate($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		switch ($type) {
			case "default":	$add_qry = " twzb_default_img = '' "; break;	
			case "width":		$add_qry = " twzb_width_img = '' ";			break;											
			case "height":	$add_qry = " twzb_height_img = '' ";			break;											
			case "banner":	$add_qry = " twzb_banner_img = '' ";			break;											
		}

		$qry = "
			UPDATE
				tblwebzineboard
			SET
				$add_qry
			where
				twzb_idx = '$twzb_idx'
			";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 웹진 내용
	// auth  : JH 2013-09-13
	// param 
	function Webzine_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select * from tblwebzineboard where twzb_idx= '$twzb_idx' ";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		return $rst;
	}
	
	// desc	 : 웹진 등록
	// auth  : JH 2013-09-13
	// param 
	function WEBZINE_Info_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select twzb_desc from tblwebzineboard order by twzb_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		
		if($rst) {
			$twzb_desc = $rst['twzb_desc'] + 1;
		}else{
			$twzb_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblwebzineboard
				(
				 	twzb_idx,
					twz_idx,
					ct_idx,
					twzb_title,
					twzb_name,
					twzb_type,
					twzb_email,
					twzb_content,
					twzb_s_content,
					twzb_default_img,
					twzb_width_img,
					twzb_height_img,
					twzb_banner_img,
					twzb_banner_show,
					twzb_edit_img,
					twzb_desc,
					twzb_del_flag,
					twzb_regdate
				)
				VALUES
				(
					''
					, '$twz_idx'
					, '$ct_idx'					
					, '$twzb_title'
					, '$twzb_name'
					, '$twzb_type'
					, '$twzb_email'
					, '$twzb_content'
					, '$twzb_s_content'
					, '$twzb_default_img'
					, '$twzb_width_img'
					, '$twzb_height_img'
					, '$twzb_banner_img'
					, '$twzb_banner_show'
					, '$twzb_edit_img'
					, '$twzb_desc'
					, '$twzb_del_flag'
					, '$twzb_regdate'
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);	
		return $rst;
	}
	
	
	// desc	 : 웹진 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function WEBZINE_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		//twzb_idx = 1
		//twz_idx= 5
		//twzb_desc = 2
		//type = asc
		
		//월별 순위 변동
		if($twz_idx != '') {
			if($type == "asc") {	
				//내 상위 desc 번호와 twzb_idx를 가져오기
				$qry = " select twzb_idx, twzb_desc from tblwebzineboard where twz_idx='$twz_idx' and twzb_desc > '$twzb_desc' order by twzb_desc asc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$top_desc = $rst['twzb_desc'];
				$top_idx = $rst['twzb_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzineboard set twzb_desc = '$top_desc' where twzb_idx = '$twzb_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzineboard set twzb_desc = '$twzb_desc' where twzb_idx = '$top_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {	
				//내 상위 desc 번호와 twzb_idx를 가져오기
				$qry = " select twzb_idx, twzb_desc from tblwebzineboard where twz_idx='$twz_idx' and twzb_desc < '$twzb_desc' order by twzb_desc desc limit 0, 1 ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$down_desc = $rst['twzb_desc'];
				$down_idx = $rst['twzb_idx'];
				
				//현재 자신의 순위를 업데이트
				$qry1 = " update tblwebzineboard set twzb_desc = '$down_desc' where twzb_idx = '$twzb_idx' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				//상위 순위를 자신의 것으로 업데이트
				$qry2 = " update tblwebzineboard set twzb_desc = '$twzb_desc' where twzb_idx = '$down_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
		}else{ //전체
			if($type == "asc") {
				
				$up_desc = $twzb_desc + 1;
				
				$qry = "select twzb_idx from tblwebzineboard where twzb_desc = '$up_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzb_idx'];
				
				$qry1 = " update tblwebzineboard set twzb_desc = twzb_desc - 1 where twzb_idx = '$one_twz' ";					
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);
				
				
				$qry2 = " update tblwebzineboard set twzb_desc = twzb_desc + 1 where twzb_idx = '$twzb_idx' ";			
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
			
			if($type == "desc") {
				
				$dn_desc = $twzb_desc - 1;
				
				$qry = "select twzb_idx from tblwebzineboard where twzb_desc = '$dn_desc' ";
				$rst =  $this -> DB -> execSqlOneRow($qry);
				
				$one_twz = $rst['twzb_idx'];
				
				$qry1 = " update tblwebzineboard set twzb_desc = twzb_desc + 1 where twzb_idx = '$one_twz' ";
				$rst1 =  $this -> DB -> execSqlUpdate($qry1);			
				
				$qry2 = " update tblwebzineboard set twzb_desc = twzb_desc - 1 where twzb_idx = '$twzb_idx' ";
				$rst2 =  $this -> DB -> execSqlUpdate($qry2);
			}
		}
		return $rst2;
	}
	
	// desc	 : 호 리스트
	// auth  : JH 2013-09-16 월요일
	// param	
	function WebzineHoList($args = '') {
		$qry = " select * from tblWebzine order by twz_desc desc";
		$rst = $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 웹진 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Webzine_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and TWZB.twzb_del_flag = 'N' ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " TWZB.twzb_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if ($twz_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZB.twz_idx = '$twz_idx' ";
		}
		
		if ($ct_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " CT.ct_idx = '$ct_idx' ";
		}
		
		if ($twzb_banner_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " TWZB.twzb_banner_show = '$twzb_banner_show' ";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "TWZB.twzb_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "
												tblwebzineboard TWZB LEFT OUTER JOIN tblWebzine TWZ ON TWZB.twz_idx = TWZ.twz_idx
												LEFT OUTER JOIN tblCategory CT ON TWZB.ct_idx = CT.ct_idx
											";
		$args['q_where'] = $addQry;
		$args['q_order'] = "TWZB.twzb_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "twz_idx=". $twz_idx . "&twzb_banner_show=". $twzb_banner_show . "&ct_idx=". $ct_idx . "&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	// desc	 : 호 삭제
	// auth  : JH 2013-09-13
	// param 
	function HO_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "delete from tblWebzine where twz_idx = '$twz_idx'";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 호 등록
	// auth  : JH 2013-09-13
	// param 
	function HO_Info_REG($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select twz_desc  from tblWebzine order by twz_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$twz_desc = $rst['twz_desc'] + 1;
		}else{
			$twz_desc = 1;
		}
		
		$qry1 = "
			INSERT INTO
				tblWebzine
				(
					twz_idx,
					twz_year,
					twz_month,
					twz_desc,
					twz_show,
					twz_regdate
				)
				VALUES
				(
					''
					, '$twz_year'
					, '$twz_month'
					, '$twz_desc'
					, 'N'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry1);
		return $rst;
	}
	
	
	// desc	 : 호 수정
	// auth  : JH 2013-09-16 월요일
	// param
	function HO_Info_Modify($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblWebzine
			set
				twz_year = '$twz_year',
				twz_month = '$twz_month',
				twz_show = '$twz_show'
			where
				twz_idx = '$twz_idx'			
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 호 내용
	// auth  : JH 2013-09-16 월요일
	// param
	function Ho_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblWebzine where twz_idx = '$twz_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
		
	}
	
	// desc	 : 호 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function HO_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $twz_desc + 1;
			
			$qry = "select twz_idx from tblWebzine where twz_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['twz_idx'];
			
			$qry = " update tblWebzine set twz_desc = twz_desc - 1 where twz_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblWebzine set twz_desc = twz_desc + 1 where twz_idx = '$twz_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $twz_desc - 1;
			
			$qry = "select twz_idx from tblWebzine where twz_desc = '$dn_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['twz_idx'];
			
			$qry = " update tblWebzine set twz_desc = twz_desc + 1 where twz_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblWebzine set twz_desc = twz_desc - 1 where twz_idx = '$twz_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		return $rst;
	}
	
	// desc	 : 호 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Webzine_ho_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " twz_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "twz_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblWebzine";
		$args['q_where'] = $addQry;
		$args['q_order'] = "twz_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
}
?>