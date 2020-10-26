<?
CLASS Search extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	function Search_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$addQry = " A.vd_delflag='N' ";
		$addQry = " A.vd_link1 != '' ";
		$addQry = " A.vd_gubun != 'I' ";				
		$addQry .= " AND (FIND_IN_SET('$schtxt',A.vd_tag) || A.vd_title like ('%$schtxt%') || A.vd_content like ('%$schtxt%')) || A.vd_dr_name like ('%$schtxt%')";

		$qry = "
			select * from tblVideo A left outer join tblDoctor B On A.vd_dr_idx = B.dr_idx where $addQry order by A.vd_regdate desc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		$rtn[] = $rst;
		//echo $qry;
		
		$addQry = "";
		$addQry = " dr_delflag='N' ";
		$addQry .= " AND (dr_name like ('%$schtxt%') || dr_treat like ('%$schtxt%'))";
		$qry = "
			select * from tblDoctor where $addQry order by  dr_desc desc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		$rtn[] = $rst;

		$addQry = "";
		$addQry = " A.jb_del_flag = 'N'";
		$addQry .=" AND (A.jb_title like '%$schtxt%' || B.jb_content like '%$schtxt%') ";
		$addQry .= "AND A.jb_code in ('10','80','90','140')";
		$order = "A.jb_order ASC, A.jb_depth DESC"; 
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
		$rtn[] = $rst;
		
		return $rtn;
	}
}
?>