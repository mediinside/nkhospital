<?
CLASS Video extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	function Video_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblVideo where vd_idx = '$vd_idx'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}	
	
	function Video_Doctor_img($dr_idx) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select dr_face_s_img from tblDoctor where dr_idx = '$dr_idx'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst["dr_face_s_img"];
	}	
	
	function Video_Doctor_info($dr_idx) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblDoctor where dr_idx = '$dr_idx'
		";
		
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}		
	
	function Video_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		
		$qry = "
			update 
				tblVideo
			set
				vd_delflag = 'Y'
			where 
				vd_idx = '$vd_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}	
	
	function Video_Modi($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblVideo
			set
				vd_order = '$vd_order',
				vd_title = '$vd_title',
				vd_content = '$vd_content',
				vd_uid = '$vd_uid',
				vd_playtime = '$vd_playtime',								
				vd_dr_idx = '$vd_dr_idx',
				vd_dr_name = '$vd_dr_name',
				vd_dr_position = '$vd_dr_position',
				vd_dr_treat = '$vd_dr_treat',
				vd_gubun = '$vd_gubun',
				vd_intro = '$vd_intro',	
				vd_intro_content = '$vd_intro_content',								
				vd_tag = '$vd_tag',				
				vd_clinic1 = '$vd_clinic1',
				vd_clinic2 = '$vd_clinic2',
				vd_clinic3 = '$vd_clinic3',
				vd_link1 = '$vd_link1',
				vd_link2 = '$vd_link2',
				vd_thumb = '$vd_thumb'				
			where 
				vd_idx = '$vd_idx'
		";

		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
		
	}	
	
	function Video_Reg($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "
			INSERT INTO
				tblVideo
				(
					vd_idx,
					vd_order,
					vd_title,
					vd_content,
					vd_uid,
					vd_playtime,										
					vd_dr_idx,
					vd_dr_name,
					vd_dr_position,
					vd_dr_treat,
					vd_gubun,
					vd_intro,
					vd_intro_content,										
					vd_tag,					
					vd_clinic1,
					vd_clinic2,
					vd_clinic3,
					vd_link1,
					vd_link2,
					vd_thumb,					
					vd_delflag,
					vd_regdate
				)
				VALUES
				(
					''
					, '$vd_order'					
					, '$vd_title'
					, '$vd_content'
					, '$vd_uid'
					, '$vd_playtime'										
					, '$vd_dr_idx'
					, '$vd_dr_name'
					, '$vd_dr_position'
					, '$vd_dr_treat'
					, '$vd_gubun'
					, '$vd_intro'	
					, '$vd_intro_content'										
					, '$vd_tag'					
					, '$vd_clinic1'
					, '$vd_clinic2'
					, '$vd_clinic3'
					, '$vd_link1'
					, '$vd_link2'
					, '$vd_thumb'					
					, 'N'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}


	function Video_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;
		$tail = "";
		$addQry = " 1=1 and vd_delflag='N' ";
		
		/*if($tr_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic1 = '$tr_type' ";
		}
		
		if($ct_type != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic2 = '$ct_type' ";
		}
		
		
		if($vd_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic1 in ( '$vd_clinic1' ) ";
		}
		
		if($vd_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic2 in ( '$vd_clinic2' ) ";
		}
		
		if($vd_clinic3 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic3 in ( '$vd_clinic3' ) ";
		}*/		
		
		if($vd_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic1',vd_clinic1)";
		}
		
		if($vd_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic2',vd_clinic2)";
		}
		
		if($vd_clinic3 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic3',vd_clinic3)";
		}		
		
		if($vd_qa_show != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_qa_show = '$vd_qa_show' ";
		}

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " vd_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
        }
        
        if($vd_dr_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_dr_idx = '$vd_dr_idx'";
		}		
		if($vd_gubun != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_gubun = '$vd_gubun'";
			$limit = ($vd_gubun == 'I') ? " limit 0,1" : "";
		}		
		
		if($vd_cnt != ''){
			if ($addQry)
			$addQry .= " AND ";			
			$addQry .= " vd_gubun != 'I'";
		}
		
		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "vd_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblVideo";
		$args['q_where'] = $addQry;
		if($orderby != '') {
			$args['q_order'] = " $orderby ";
		}else{
			$args['q_order'] = " vd_regdate desc";
		}
		$args['q_group'] = "";
		

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
        $args['q_see'] = "";        
        //echo "aa" . print_r($args);	
		return $C_ListClass -> listInfo($args);
	}
	
	function Video_List_Mobile ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$addQry = " vd_delflag='N' ";

		/*if($vd_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic1 in ( '$vd_clinic1' ) ";
		}
		
		if($vd_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic2 in ( '$vd_clinic2' ) ";
		}
		
		if($vd_clinic3 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_clinic3 in ( '$vd_clinic3' ) ";
		}*/
		
		if($vd_clinic1 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic1',vd_clinic1)";
		}
		
		if($vd_clinic2 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic2',vd_clinic2)";
		}
		
		if($vd_clinic3 != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " find_in_set('$vd_clinic3',vd_clinic3)";
		}

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " vd_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}	
		
		if($vd_dr_idx != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_dr_idx = '$vd_dr_idx'";
		}		
		if($vd_gubun != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " vd_gubun = '$vd_gubun'";
			$limit = ($vd_gubun == 'I') ? " limit 0,1" : "";
		}		
		
		if($vd_cnt != ''){
			if ($addQry)
			$addQry .= " AND ";			
			$addQry .= " vd_gubun != 'I'";
		}
		
		$qry = "
			select * from tblVideo where $addQry order by vd_order desc,vd_regdate desc $limit
		";
		$rst =  $this -> DB -> execSqlList($qry);
		//echo "vb" . $qry;
		return $rst;
	}
}
?>