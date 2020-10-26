<?
CLASS Doctor extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	
	// desc	 : 의료진 정보 전부
	// auth  : JH 2013-09-13
	// param 
	function Doctor_List_All($args) {
		global $GP;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_delflag = 'N' order by dr_desc desc
			";
		$rst =  $this -> DB -> execSqlList($qry);
		
		$arr_tmp = array();
		if($rst) {
			for	($i=0; $i<count($rst); $i++) {
				$dr_clinic = $rst[$i]['dr_clinic'];
				$dr_center = $rst[$i]['dr_center'];
				
				$arr_tmp[$rst[$i]['dr_idx']] = "[" . $GP -> CENTER_TYPE[$dr_center] . "] " . $GP -> CLINIC_TYPE[$dr_clinic] . " -  " . $rst[$i]['dr_name'];
			}
		}
		
		return $arr_tmp;
	}

	// desc	 : 의료진 정보 셀렉박스
	// param 
	function Doctor_List_Select_New($args) {
		global $GP;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_delflag = 'N' order by dr_name asc
			";
		$rst =  $this -> DB -> execSqlList($qry);
		
		$arr_tmp = array();
		if($rst) {
			$rtn = '<select name="dr_info" id="dr_info"><option value="">선택하세요</option>';
			for	($i=0; $i<count($rst); $i++) {
				$drselect = ($rst[$i]['dr_idx'] == $vd_dr_idx) ? "selected" : "";
				$dr_info = trim($rst[$i]['dr_idx']).'/'.trim($rst[$i]['dr_name']).'/'.$rst[$i]['dr_position'].'/'.$rst[$i]['dr_clinic2'];
				if($rst[$i]['dr_clinic3']) $dr_info .= ','.$rst[$i]['dr_clinic3'];
				$rtn .= '<option value="'.trim($dr_info).'" '.$drselect.'>'.$rst[$i]['dr_name'].'</option>';
			}
			$rtn .= '</select>';
		}
		return $rtn;
	}	
	
	
	// desc	 : 순위변경
	// auth  : 
	// param
	function DT_AUTO_CHAGE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		

		$arr_tmp = explode(',',$tmp_id);
		
		//$max_desc = 22;
		for($i=0; $i<count($arr_tmp); $i++) {
			$idx = $arr_tmp[$i];			
			$qry = " update tblDoctor set dr_desc = '$max_desc' where dr_idx = '$idx'	";			
			$rst =  $this -> DB -> execSqlUpdate($qry);
			$max_desc--; 
		}
		
	}
	
	// desc	 : 닥터 리스트
	// auth  : 
	// param
	function Doctor_List_Expert($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$qry = "
			select * from tblDoctor where dr_qa_show = 'Y' and dr_delflag = 'N'
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	
	
	// desc	 : 의사 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function DT_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $dr_desc + 1;
			
			$qry = "select dr_idx from tblDoctor where dr_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['dr_idx'];
			
			$qry = " update tblDoctor set dr_desc = dr_desc - 1 where dr_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblDoctor set dr_desc = dr_desc + 1 where dr_idx = '$dr_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $dr_desc - 1;
			
			$qry = "select dr_idx from tblDoctor where dr_desc = '$dn_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['dr_idx'];
			
			$qry = " update tblDoctor set dr_desc = dr_desc + 1 where dr_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblDoctor set dr_desc = dr_desc - 1 where dr_idx = '$dr_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		return $rst;
	}
	
	// desc	 : 저서 및 논문 수정
	// auth  : 
	// param	
	function BOOK_MODI($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblBook 
			set
				tb_title = '$tb_title',
				tb_content = '$tb_content',
				tb_file_code = '$tb_file_code',
				tb_editor_code = '$tb_editor_code'
			where 
				tb_idx='$tb_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	} 
	
	
	// desc	 : 저서 및 논문 이미지 삭제
	// auth  : 
	// param	
	function Book_ImgUpdate($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblBook 
			set
				tb_file_code = ''				
			where 
				tb_idx='$tb_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	} 
	
	
	
	// desc	 : 저서 및 논문 상세
	// auth  : 
	// param	
	function Book_Info($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select * from tblBook where tb_idx='$tb_idx' ";	
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 저서 및 논문 삭제
	// auth  : 
	// param	
	function Book_Del($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblBook 
			set
				tb_delflag = 'Y'
			where 
				tb_idx='$tb_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 저서 및 논문 등록
	// auth  : 
	// param
	function Book_Reg($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			INSERT INTO
				tblBook
				(
					tb_idx,
					dr_idx,
					tb_title,
					tb_content,
					tb_file_code,
					tb_editor_code,	
					tb_delflag,
					tb_regdate
				)
				VALUES
				(
					''
					, '$dr_idx'
					, '$tb_title'
					, '$tb_content'
					, '$tb_file_code'
					, '$tb_editor_code'
					, 'N'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}

	
	// desc	 : 저서 및 논문
	// auth  : 
	// param
	function BookList ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and dr_idx='$dr_idx' and tb_delflag = 'N' ";
		

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "tb_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblBook";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tb_idx desc";
		$args['q_group'] = "";

		$args['tail'] = "dr_idx=$dr_idx&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	
	// desc	 : 닥터 과목
	// auth  : 
	// param
	function Treat_List($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$qry = "
			select dr_clinic1 from tblDoctor where dr_clinic2 = '$dr_clinic2' group by dr_clinic1
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 닥터 센터
	// auth  : 
	// param
	function Center_List($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$qry = "
			select dr_clinic2 from tblDoctor where dr_clinic1 = '$dr_clinic1' and dr_clinic2 != '' group by dr_clinic2
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 닥터 리스트
	// auth  : 
	// param
	function Doctor_List_Main($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$qry = "
			select * from tblDoctor where dr_clinic1 = '$dr_clinic1' and dr_delflag ='N'
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	
	// desc	 : 닥터 삭제
	// auth  : 
	// param
	function Doctor_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		
		$qry = "
			update 
				tblDoctor 
			set
				dr_delflag = 'Y'
			where 
				dr_idx = '$dr_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 닥터 수정
	// auth  : 
	// param
	function Doctor_Modi($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblDoctor 
			set
				dr_name = '$dr_name',
				dr_mcode = '$dr_mcode',
				dr_mtreat_no = '$dr_mtreat_no',								
				dr_position = '$dr_position',
				dr_treat = '$dr_treat',
				dr_history = '$dr_history',
				dr_academy = '$dr_academy',
				dr_greeting_title = '$dr_greeting_title',				
				dr_greeting = '$dr_greeting',				
				dr_book = '$dr_book',
				dr_m_sd = '$dr_m_sd',
				dr_a_sd = '$dr_a_sd',
				dr_gita = '$dr_gita',
				dr_clinic1 = '$dr_clinic1',
				dr_clinic2 = '$dr_clinic2',
				dr_clinic3 = '$dr_clinic3',
				dr_face_img = '$dr_face_img',
				dr_qa_show = '$dr_qa_show',
				dr_mobile = '$dr_mobile',
				dr_detail_img = '$dr_detail_img',
				dr_mobile_img = '$dr_mobile_img',
				dr_face_s_img = '$dr_face_s_img',				
				dr_bg_img = '$dr_bg_img',
				dr_thumb_img = '$dr_thumb_img',								
				dr_vd_link1 = '$dr_vd_link1',
				dr_vd_link2 = '$dr_vd_link2',
				dr_vd_uid = '$dr_vd_uid',
				dr_vd_playtime = '$dr_vd_playtime',																				
				dr_time_gap = '$dr_time_gap'
				
			where 
				dr_idx = '$dr_idx'
		";
	
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
		
	}
	
	
	// desc	 : 닥터 이미지 삭제
	// auth  : 
	// param
	function Doctor_ImgUpdate($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		
		if($type == "M") {
			$addQry = " dr_face_img = '' ";
		}else if($type=="E"){
			$addQry = " dr_detail_img = '' ";
		}else if($type=="N"){
			$addQry = " dr_mobile_img = '' ";
		}else if($type=="B"){
			$addQry = " dr_bg_img = '' ";
		}else if($type=="T"){
			$addQry = " dr_thumb_img = '' ";
		}else if($type=="S"){
			$addQry = " dr_face_s_img = '' ";
		}
		
		$qry = "
			update 
				tblDoctor 
			set
				$addQry
			where 
				dr_idx = '$dr_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 닥터 상세
	// auth  : 
	// param
	function Doctor_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_idx = '$dr_idx'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	function Doctor_Info_Code($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_mcode = '$dr_mcode'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}	
	
	function Doctor_Sch_R($dr_clinic) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select trs_time_gap from tblReserveSch where dr_clinic1 = '$dr_clinic'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst["trs_time_gap"];
	}	
	
	
	
	// desc	 : 닥터 상세
	// auth  : 
	// param
	function Doctor_Info2($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_clinic2 = '$ct_type' AND dr_delflag ='N' 
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	
	
	// desc	 : 닥터 상세 리스트
	// auth  : 
	// param
	function Doctor_Detail_List($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$addQry =  " 1=1 and dr_delflag ='N' ";
		
		if($tr_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic1 = '$tr_type' ";
			$addQry .= " find_in_set('$tr_type',dr_clinic1)";			
		}
		
		if($ct_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic2 = '$ct_type' ";
			$addQry .= " find_in_set('$ct_type',dr_clinic2)";			
		}

		if($sp_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic3 = '$sp_type' ";
			$addQry .= " find_in_set('$sp_type',dr_clinic3)";			
		}

		if($dr_name != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " dr_name like '%$dr_name%' ";
		}
		
		$order = ($order) ? $order : " order by dr_desc desc";
		
		$qry = "
			select * from tblDoctor where $addQry $order
		";
		$rst =  $this -> DB -> execSqlList($qry);
		//echo $qry;
		return $rst;
	}
	
	
	
	// desc	 : 닥터 등록
	// auth  : 
	// param
	function Doctor_Reg($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select dr_desc  from tblDoctor order by dr_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$dr_desc = $rst['dr_desc'] + 1;
		}else{
			$dr_desc = 1;
		}
		
		$qry = "
			INSERT INTO
				tblDoctor
				(
					dr_idx,
					dr_name,
					dr_mcode,
					dr_mtreat_no,										
					dr_position,
					dr_treat,
					dr_history,
					dr_academy,
					dr_book,
					dr_greeting_title,										
					dr_greeting,					
					dr_m_sd,
					dr_a_sd,
					dr_clinic1,
					dr_clinic2,
					dr_clinic3,
					dr_face_img,
					dr_detail_img,
					dr_mobile_img,
					dr_face_s_img,						
					dr_bg_img,	
					dr_thumb_img,															
					dr_vd_link1,					
					dr_vd_link2,
					dr_vd_uid,
					dr_vd_playtime,																									
					dr_gita,
					dr_qa_show,
					dr_mobile,
					dr_delflag,
					dr_desc,
					dr_time_gap,
					dr_regdate
				)
				VALUES
				(
					''
					, '$dr_name'
					, '$dr_mcode'
					, '$dr_mtreat_no'										
					, '$dr_position'
					, '$dr_treat'
					, '$dr_history'
					, '$dr_academy'
					, '$dr_book'
					, '$dr_greeting_title'					
					, '$dr_greeting'					
					, '$dr_m_sd'
					, '$dr_a_sd'
					, '$dr_clinic1'
					, '$dr_clinic2'
					, '$dr_clinic3'
					, '$dr_face_img'
					, '$dr_detail_img'
					, '$dr_mobile_img'
					, '$dr_face_s_img'					
					, '$dr_bg_img'	
					, '$dr_thumb_img'												
					, '$dr_vd_link1'		
					, '$dr_vd_link2'															
					, '$dr_vd_uid'															
					, '$dr_vd_playtime'																									
					, '$dr_gita'
					, '$dr_qa_show'
					, '$dr_mobile'
					, 'N'
					, '$dr_desc'
					, '$dr_time_gap'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	
	// desc	 : 닥터 리스트
	// auth  : 
	// param
	function Doctor_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and dr_delflag='N' ";
		
		if($tr_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic1 = '$tr_type' ";
			$addQry .= " find_in_set('$tr_type',dr_clinic1)";
		}
		
		if($ct_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic2 = '$ct_type' ";
			$addQry .= " find_in_set('$ct_type',dr_clinic2)";
		}
		
		
		if($dr_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic1 in ( '$dr_clinic1' ) ";
			$addQry .= " find_in_set('$dr_clinic1',dr_clinic1)";
		}
		
		if($dr_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic2 in ( '$dr_clinic2' ) ";
			$addQry .= " find_in_set('$dr_clinic2',dr_clinic2)";
		}
		
		
		if($dr_qa_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " dr_qa_show = '$dr_qa_show' ";
		}

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " dr_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "dr_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblDoctor";
		$args['q_where'] = $addQry;
		if($orderby != '') {
			$args['q_order'] = " $orderby ";
		}else{
			$args['q_order'] = " dr_desc desc";
		}
		$args['q_group'] = "";
		

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	function Doctor_List_Mobile ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$tail = "";
		$addQry = " 1=1 and dr_delflag='N' ";
		
		if($tr_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$tr_type',dr_clinic1)";
		}
		
		if($ct_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic2 = '$ct_type' ";
			$addQry .= " find_in_set('$ct_type',dr_clinic2)";			
		}
		
		if($sp_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			//$addQry .= " dr_clinic3 = '$sp_type' ";
			$addQry .= " find_in_set('$sp_type',dr_clinic3)";			
		}		
		
		if($dr_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " dr_clinic1 in ( '$dr_clinic1' ) ";
		}
		
		if($dr_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " dr_clinic2 in ( '$dr_clinic2' ) ";
		}
		
		
		if($dr_qa_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " dr_qa_show = '$dr_qa_show' ";
		}

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " dr_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		/*$qry = "
			select * from tblDoctor where $addQry order by dr_clinic2,dr_desc desc
		";*/
		$qry = "
			select * from tblDoctor where $addQry order by dr_desc desc
		";		
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
}
?>