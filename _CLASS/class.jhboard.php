<?
CLASS JHBoard extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	
	function Board_Doctor_Mobile($args) {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		
		if($jb_treat == "L" || $jb_treat == "M" || $jb_treat == "N" || $jb_treat == "O" || $jb_treat == "P" || $jb_treat == "Q") {
			if($jb_treat == "L") { $jb_treat = "I";	}
			if($jb_treat == "M") { $jb_treat = "J"; }
			if($jb_treat == "N") { $jb_treat = "K";	}	
			if($jb_treat == "O") { $jb_treat = "L"; }
			if($jb_treat == "P") { $jb_treat = "M";	}	
			if($jb_treat == "Q") { $jb_treat = "N";	}
			
			$qry = "
				select dr_mobile FROM  tblDoctor WHERE  dr_qa_show = 'Y' and dr_clinic1 = '$jb_treat'
			";	
		}else{
			$qry = "
				select dr_mobile FROM  tblDoctor WHERE  dr_qa_show = 'Y' and dr_clinic2 = '$jb_treat'
			";	
		}
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
		
	// desc	 : 게시판 설정 업데이트
	// auth  : JH 2013-04-26
	// param 
	function BBS_Info_Modify($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update 
				tblJhBoardAdmin
			set
				jba_read_level = '$jba_read_level',
				jba_write_level = '$jba_write_level',
				jba_reply_level = '$jba_reply_level',
				jba_comment_level = '$jba_comment_level',
				jba_comment_use = '$jba_comment_use',
				jba_list_use = '$jba_list_use',
				jba_list_scale = '$jba_list_scale',
				jba_skin_dir = '$jba_skin_dir'
			where
				jb_code = '$jb_code'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 스킨 타입
	// auth  : JH 2013-04-26
	// param 
	function SKIN_LIST() {
		$qry = "
			select jba_skin_dir from tblJhBoardAdmin group by jba_skin_dir
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	
	// desc	 : 글 상세 정보
	// auth  : JH 2013-04-26
	// param :
	function Board_User_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		
		$qry = "
			SELECT 
				M.mb_name, M.mb_mobile
			FROM 
				tblJhBoardList BL LEFT OUTER JOIN tblMember M ON BL.jb_mb_id=M.mb_id and BL.jb_email = M.mb_email
			WHERE 
				BL.jb_code='$jb_code' 
				AND BL.jb_idx='$jb_idx'
		";	
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	
	
	// desc	 : FAQ 가져오기
	// auth  : JH 2013-04-26
	// param 
	function FAQ_LIST($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_code='$jb_code' 
				and A.jb_type = '$jb_type'
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
		
	}
	
	// desc	 : 메인에 글 가져오기
	// auth  : JH 2013-04-26
	// param 
	function Board_Main_Data($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		if($jb_code=="news") {
			$addQry = "A.jb_code in ('10','140','50')";
		}else{
			$addQry = "A.jb_code=${jb_code}";
		}
		
		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				$addQry
				and A.jb_del_flag = 'N'
			order by A.jb_idx desc
			$limit	
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}

	function Board_Main_Data2($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_code='$jb_code' 
				and A.jb_del_flag = 'N'
				and A.jb_order = '$jb_order'
			order by A.jb_idx desc
			$limit	
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 게시글 삭제
	// auth  : JH 2013-04-26
	// param :
	function Board_DEL_ALL($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			SELECT jb_idx, jb_file_code, jb_img_code FROM tblJhBoardList WHERE jb_code='$jb_code' AND jb_group='$jb_group' AND jb_depth <= '$jb_depth'
		";
		$rst = $this -> DB -> execSqlList($qry);
		
		if($rst) {			
			for($i=0; $i<count($rst); $i++){				
				$jb_idx = $rst[$i]['jb_idx'];
				
				$qry1 = "update tblJhBoardList set jb_del_flag = 'Y' where jb_idx = '$jb_idx'";
				$result1 =  $this -> DB -> execSqlUpdate($qry1);	
				
				$qry2 = "update tblJhBoardComment set jbc_del_flag = 'Y' where jb_idx = '$jb_idx'";
				$result2 =  $this -> DB -> execSqlUpdate($qry2);					
			}			
		}		
		return $rst;		
	}
	
	// desc	 : 첨부파일 가져오기
	// auth  : JH 2013-04-26
	// param :
	function BOARD_FILE_CONTENT($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry="SELECT jb_file_name, jb_file_code FROM tblJhBoardList WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' ";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;		
	}
	
	// desc	 : 글 수정
	// auth  : JH 2013-04-26
	// param
	function BOARD_DETAIL_UPDATE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "			
			UPDATE tblJhBoardDetail SET jb_content='$jb_content' WHERE jb_code='$jb_code' AND jb_idx='$jb_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 글 수정
	// auth  : JH 2013-04-26
	// param
	function BOARD_UPDATE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "			
			UPDATE tblJhBoardList SET $keys_values WHERE jb_code='$jb_code' AND jb_idx='$jb_idx'	
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 글 상세 정보
	// auth  : JH 2013-04-26
	// param :
	function Board_Detail($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_qry = "";		
		if($check_level < 9) {
			$add_qry = " AND jb_mb_id='$check_id' ";
		}
		
		$qry = "
			SELECT * FROM tblJhBoardList WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' $add_qry
		";	
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 답글 여부
	// auth  : JH 2013-04-26
	// param
	function Board_Reply_Detail($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			SELECT COUNT(*) as cnt FROM tblJhBoardList WHERE jb_code='$jb_code' AND jb_group='$jb_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 댓글 삭제
	// auth  : JH 2013-04-26
	// param	
	function Board_Comment_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		//$qry = " DELETE FROM tblJhBoardComment WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' AND jbc_idx='$jbc_idx'	";
		$qry = "
			UPDATE tblJhBoardComment SET jbc_del_flag = 'Y' WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' AND jbc_idx='$jbc_idx'
		";		
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 댓글 수정
	// auth  : JH 2013-04-26
	// param
	function BOARD_COMMENT_UPDATE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "			
			UPDATE tblJhBoardComment SET $keys_values WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' AND jbc_idx='$jbc_idx'	
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 댓글 상세 정보
	// auth  : JH 2013-04-26
	// param :
	function Board_Comment_Detail($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_qry = "";		
		if($check_level < 9) {
			$add_qry = " AND jbc_mb_id='$check_id' ";
		}
		
		$qry = "
			SELECT jbc_name, jbc_content, jbc_password FROM tblJhBoardComment WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' AND jbc_idx='$jbc_idx' $add_qry
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 댓글 게시판 리스트
	// auth  : JH 2013-04-26
	// param :
	function Board_Comment_List($args = '') {
		global $C_Func;
		global $C_ListClass;

		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$tail = "com_page=${page} ";
		//$page = ($page) ? $page-1 : 0;
		
		$args['search']			= array();
		$args['show_row']		= $show_row;
		$args['show_page']		= $show_page;
		$args['comm_yn']		= "Y";		
		$args['q_idx']			= "jbc_idx";
		$args['q_col']			= " * ";
		$args['q_table']		= " tblJhBoardComment ";
		$args['q_where']		= " jb_code='$jb_code' AND jb_idx='$jb_idx' and jbc_del_flag='N' ";
		$args['q_order']		= "jbc_depth asc";
		$args['q_group']		= "";
		$args['tail']				= $tail;
		$args['q_see']			= "0";

		return $C_ListClass -> listInfo($args);
	}
	
	// desc	 : 글리스트에 코멘트수량 업데이트
	// auth  : JH 2013-04-26
	// param 
	function BOARD_LIST_COMM_DOWN($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry="
			UPDATE 
				tblJhBoardList 
			SET 
				jb_comment_count = (jb_comment_count - 1)
		  WHERE 
				jb_code='$jb_code' 
				AND jb_idx='$jb_idx'
			  AND jb_comment_count > 0
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	
	
	// desc	 : 글리스트에 코멘트수량 업데이트
	// auth  : JH 2013-04-26
	// param 
	function BOARD_LIST_COMM_UP($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry="
			UPDATE 
				tblJhBoardList 
			SET 
				jb_comment_count = (jb_comment_count + 1)
		  WHERE 
				jb_code='${jb_code}' 
				AND jb_idx='${jb_idx}'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 코멘트 등록
	// auth  : JH 2013-04-26
	// param 
	function BOARD_COMMENT_WRITE($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "INSERT INTO tblJhBoardComment ($keys) VALUES ($values)";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	// desc	 : 글 자동등록 폼 생성을 위해 필드가져오기
	// auth  : JH 2013-04-26
	// param :
	function DESC_BOARD_COMMENT($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = " desc tblJhBoardComment ";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 맥스 코멘트번호
	// auth  : JH 2013-04-26
	// param :
	function Board_Comment_Depth_Max($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = " SELECT MAX(jbc_depth) AS max_depth FROM tblJhBoardComment WHERE jb_code='$jb_code' AND jb_idx='$jb_idx' ";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 글 내용 가져오기
	// auth  : JH 2013-04-26
	// param 
	function Board_Read_Data($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_code='$jb_code' 
				AND A.jb_idx='$jb_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 글 내용 가져오기
	// auth  : JH 2013-04-26
	// param 
	function Board_Read_Data_B_A($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$arr_tmp = array();
		
		$addQry = "";
		
		if($my_mb_id != '') {
			$addQry = " AND jb_mb_id='$my_mb_id' ";
		}
		
		//이전글
		$qry = "
			SELECT 
				A.jb_idx, A.jb_title, B.jb_content
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_code='$jb_code' 
				AND A.jb_idx < '$jb_idx'
				$addQry
			order by jb_idx desc
			limit 0 , 1
		";
		$arr_tmp[0] = $this -> DB -> execSqlOneRow($qry);
		
		//다음글
		$qry1 = "
			SELECT 
				A.jb_idx, A.jb_title, B.jb_content
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_code='$jb_code' 
				AND A.jb_idx > '$jb_idx'
				$addQry
			order by jb_idx asc
			limit 0 , 1
		";
		$arr_tmp[1] = $this -> DB -> execSqlOneRow($qry1);
		return $arr_tmp;
	}
	
	// desc	 : 조회수 증가
	// auth  : JH 2013-04-26
	// param 
	function Board_See_Up($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			UPDATE 
				tblJhBoardList 
			SET 
				jb_see = (jb_see + 1) 
			WHERE 
				jb_code='$jb_code' 
				AND jb_idx='$jb_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc	 : 비밀글 전환
	// auth  : 
	// param 
	function Secret_Check($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			UPDATE 
				tblJhBoardList 
			SET 
				jb_secret_check = 'N'
			WHERE 
				jb_idx='$jb_idx'
		";
		//echo $qry;
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}


	
	// desc	 : 첨부파일 업데이트
	// auth  : JH 2013-04-26
	// param 
	function BOARD_FILE_UPDATE($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_qry = "";
		
		if($jb_file_name != '' && $jb_file_code != '') {
			$add_qry .= " jb_file_name = '$jb_file_name', ";
			$add_qry .= " jb_file_code = '$jb_file_code' ";
		}		
		
		if($jb_img_code != '') {
			if($add_qry != '') {
				$add_qry .= ", jb_img_code = '$jb_img_code' ";
			}else{
				$add_qry .= " jb_img_code = '$jb_img_code' ";
			}
		}	
		
		if($add_qry != '') {		
			$qry = "
				UPDATE 
					tblJhBoardList 
				SET 				
					$add_qry				
				WHERE 
					jb_code='${jb_code}' 
					AND jb_idx=${jb_idx}
			";
			$rst =  $this -> DB -> execSqlUpdate($qry);
			return $rst;
		}
	}
	
	// desc	 : 글 등록
	// auth  : JH 2013-04-26
	// param 
	function BOARD_WRITE_DETAIL($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "INSERT INTO tblJhBoardDetail ($keys) VALUES ($values)";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	// desc	 : 글 등록
	// auth  : JH 2013-04-26
	// param 
	function BOARD_WRITE($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "INSERT INTO tblJhBoardList ($keys) VALUES ($values)";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	// desc	 : 글 자동등록 폼 생성을 위해 필드가져오기
	// auth  : JH 2013-04-26
	// param :
	function DESC_BOARD_DETAIL($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = " desc tblJhBoardDetail ";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 글 자동등록 폼 생성을 위해 필드가져오기
	// auth  : JH 2013-04-26
	// param :
	function DESC_BOARD_LIST($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = " desc tblJhBoardList ";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 게시판 설정 정보 가져오기
	// auth  : JH 2013-04-26
	// param :
	function Board_Config_Data($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "select * from tblJhBoardAdmin where jb_code='$jb_code'";
		$rst = $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 맥스 글번호
	// auth  : JH 2013-04-26
	// param :
	function Board_Depth_Max($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = " SELECT MAX(jb_depth) AS max_depth FROM tblJhBoardList WHERE jb_code='$jb_code' ";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 글 정보
	// auth  : JH 2013-04-26
	// param :
	function MEM_SECRET_CHECK($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry="SELECT jb_mb_id FROM tblJhBoardList WHERE jb_code=$jb_code AND jb_group=$jb_group AND jb_step=0";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;		
	}
	
	// desc	 : 게시판 리스트
	// auth  : JH 2013-04-26
	// param :
	function Board_List($args = '') {
		global $C_Func;
		global $C_ListClass;

		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$tail = "jb_code=$jb_code&search_key[jb_title]=Y&search_keyword=$search_keyword";
		
		//검색 기본 조건 설정 - 게시판 구분 코드
		$addQry = "A.jb_code=${jb_code} and A.jb_del_flag = 'N'";
		
		if($jb_type != '') {
			$addQry .= " and A.jb_type='$jb_type' ";
			$tail .= "&jb_type=$jb_type";
		}
		
		if($jb_treat != '') {
			$addQry .= " and A.jb_treat='$jb_treat' ";
			$tail .= "&jb_treat=$jb_treat";
		}
		
		if($jb_show != '' && $_SESSION['suserlevel'] < 9) {
			$addQry .= " AND A.jb_show !='$jb_show' ";
		}
			
		//검색 키워드 지정시
		if($search_key == 'jb_all'){           
			if($search_key && $search_keyword) {
				$addQry .= " AND (jb_title LIKE '%${search_keyword}%' || jb_content LIKE '%${search_keyword}%')";
			}	
		}else if($search_key || $search_keyword) {
			$addQry.=" AND (";
			$search_query="";
			$search_key_cnt = count($search_key);

			
			foreach($search_key as $key => $value) {
				if($key=="jb_content")
					$search_query.=" B.${key} LIKE '%${search_keyword}%' OR";
				else
					$search_query.=" A.${key} LIKE '%${search_keyword}%' OR";
			}		
			
		
			$search_query=rtrim($search_query, "OR");
			$addQry.= $search_query . ")";	
		}
	
		if($my_mb_id != '') {
			$addQry .= " and A.jb_mb_id='$my_mb_id' ";
		}

		$args['search']			= array();
		$args['show_row']		= $show_row;
		$args['show_page']	= $show_page;
		$args['q_idx']			= "A.jb_idx";
		$args['q_col']			= " * ";
		$args['q_table']		= "tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx";
		$args['q_where']		= $addQry;
		$args['q_order']		= " A.jb_order ASC, A.jb_reg_date DESc, A.jb_depth DESC";
		$args['q_group']		= "";
		$args['tail']				= $tail;
		$args['q_see']			= "0";

		return $C_ListClass -> listInfo($args);
	}
	
	function Search_New_BBS($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$db_config_data = $this -> Board_Config_Data($args);
		$addQry = "";
		if($mode == "search"){
			switch($jb_code) {
				case "center" : $addQry = "CONVERT(A.jb_code, UNSIGNED) between '10' and '30'"; break;	
				case "with"   : $addQry = "CONVERT(A.jb_code, UNSIGNED) between '40' and '60'"; break;
				case "clinic" : $addQry = "CONVERT(A.jb_code, UNSIGNED) between '200' and '270'"; break;	
			}
		}else{
			if($jb_code=="news") {
				$addQry = "A.jb_code in ('10','80','90','140')";
			}else{
				$addQry = "A.jb_code=${jb_code}";
			}
		}

		$slimit = $npage * $psize;
		
		if($psize) $limit = " limit $slimit,$psize";

		$addQry .= " and A.jb_del_flag = 'N'";

		if($jb_show != '' && $_SESSION['suserlevel'] < 9) {
			$addQry .= " AND A.jb_show !='$jb_show' ";
		}
		
		//if($stext) $addQry .= " AND A.jb_title like '%$stext%' ";
		if($stag) $addQry .= " AND FIND_IN_SET('$stag',A.jb_tag)";
		if($jb_mb_id) {
			$addQry .= " AND A.jb_mb_id = '$jb_mb_id'";
		}		
		if($stext) $addQry .=" AND (A.jb_title like '%$stext%' || B.jb_content like '%$stext%') ";
		if($secret) $addQry .= " AND A.jb_secret_check = '$secret'";
		if($jb_treat) $addQry .= " AND A.jb_treat = '$jb_treat'";		
		if($jb_type) $addQry .= " AND A.jb_type = '$jb_type'";				

		$order = ($order) ? $order : "A.jb_order ASC, A.jb_depth DESC"; 		

		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE
				$addQry
			order by $order
			$limit
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}		


	function Board_New_Read_Data($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "
			SELECT 
				A.*, B.jb_content 
			FROM 
				tblJhBoardList A INNER JOIN tblJhBoardDetail B ON A.jb_idx=B.jb_idx
			WHERE 
				A.jb_idx='$jb_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	function Comment_New_List($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "
			SELECT 
				*
			FROM 
				tblJhBoardComment
			WHERE 
				jb_idx='$jb_idx' 
				and jbc_del_flag = 'N'
			order by jbc_group asc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
}
?>