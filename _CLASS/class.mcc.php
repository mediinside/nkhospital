<?
CLASS Mcc extends MssqlDbconn
{
	private $DB2;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB2, $GP;
		$this -> DB2 = (!empty($DB2))? $DB2 : $C_DB2;
		$this -> GP = $GP;
	}
	
	function SchDoctorList($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "select * from MIS_RSVRINFO where DOCT_EMPL_NO = '$dr_mcode' and CLINIC_YMD = '$rev_date'";
//		echo $qry;
		$rst = $this -> DB2 -> execSqlList($qry);
		return $rst;	
	}

	function MemberInfo($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$rev_name = iconv("UTF-8", "EUC-KR", $rev_name);
		$qry = "select * from MIS_PTNTINFO where PTNT_NM = '$rev_name' and PHONE_NO = '$rev_phone'";
//		echo $qry;
		$rst = $this -> DB2 -> execSqlOneRow($qry);
		return $rst;	
	}
	
	function ResCheck($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$rev_name = iconv("UTF-8", "EUC-KR", $rev_name);
		$qry = "select count(*) as cnt from H5PHY_DUTY_RSRV where PHY_YMD = '$PHY_YMD' and PHY_TIME = '$PHY_TIME' and PHY_EMPL_NO = '$PHY_EMPL_NO' and  PTNT_NO <= 0 ";
//		echo $qry;
		$rst = $this -> DB2 -> execSqlOneRow($qry);
		return $rst["cnt"];	
	}	
	
	function ResCheck2($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$rev_name = iconv("UTF-8", "EUC-KR", $rev_name);
		$qry = "select * from 				H5PHY_DUTY_RSRV where PHY_YMD = '$PHY_YMD' and PHY_TIME = '$PHY_TIME' and PHY_EMPL_NO = '$PHY_EMPL_NO' and  PTNT_NO <= 0 ";
//		echo $qry;
		$rst = $this -> DB2 -> execSqlOneRow($qry);
		return $rst;	
	}		
		
	function SchDoctorMonth($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "select CLINIC_YMD,count(*) as cnt from MIS_RSVRINFO where (RECEPT_NO = '' or RECEPT_NO IS NULL)  and DEL_YN = 'N' and DOCT_EMPL_NO = '$dr_mcode' and left(CLINIC_YMD,'6') = '$rev_mon' and  CLINIC_YMD > '$min_day'
				group by CLINIC_YMD order by CLINIC_YMD";
		echo $qry;
		$rst = $this -> DB2 -> execSqlList($qry);
		return $rst;	
	}
	function SchDoctorDay($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "select DISTINCT * from MIS_RSVRINFO where (RECEPT_NO = '' or RECEPT_NO IS NULL)  and DEL_YN = 'N' and DOCT_EMPL_NO = '$dr_mcode' and CLINIC_YMD = '$rev_date' order by CLINIC_TIME";
		//echo $qry;
		$rst = $this -> DB2 -> execSqlList($qry);
		return $rst;	
	}	
	
	function RevInfo($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$name = iconv("UTF-8", "EUC-KR", $name);

		$addQry = " 1=1 ";
		
		if($name != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PTNT_NM_INFO = '$name' ";
		}
		
		if($phone != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHONE_NO = '$phone' ";
		}		
		if($empno != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " ENT_EMPL_NO = '$empno' ";
		}	
		if($rday != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHY_YMD = '$rday' ";
		}	
		if($rtime != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHY_TIME = '$rtime' ";
		}		
		if($PROC_GB != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PROC_GB = '$PROC_GB' ";
		}					
		
						
		
		$qry = "select * from H5PHY_DUTY_RSRV where $addQry order by ENT_DATE desc";
		//echo $qry;
		$rst = $this -> DB2 -> execSqlList($qry);
		return $rst;	
	}			
	
	function MccReserveReg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		//���ڵ� ��ȯ
		$PTNT_NM_INFO = iconv("UTF-8", "EUC-KR", $PTNT_NM_INFO);
		$MEMO = iconv("UTF-8", "EUC-KR", $MEMO);		
		$qry = "
			INSERT INTO
				H5PHY_DUTY_RSRV
				(
						DUTY_GB
					,   PHY_YMD
					,   PHY_TIME
					,   PHY_EMPL_NO
					,   PTNT_NO
					,   RECEPT_NO
					,   IO_GB
					,   PTNT_NM_INFO
					,   ENT_EMPL_NO
					,   ENT_DATE
					,   ENT_IP
					,	PHONE_NO
					,	MEMO
					,	PROC_GB					
					
				)
				VALUES
				(
						'$DUTY_GB'
					,   '$PHY_YMD'
					,   '$PHY_TIME'
					,   '$PHY_EMPL_NO'
					,   '$PTNT_NO'
					,   '$RECEPT_NO'
					,   '$IO_GB'
					,   '$PTNT_NM_INFO'
					,   '$ENT_EMPL_NO'
					,    GETDATE()
					,   '$ENT_IP'
					,	'$PHONE_NO'
					,	'$MEMO'
					,	'$PROC_GB'					
				)
			";
		//echo $qry;
		$rst = $this -> DB2 -> execSqlInsert($qry);
		return $rst;
	}	
	
	function MccReserveCancel($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		//���ڵ� ��ȯ
		$name = iconv("UTF-8", "EUC-KR", $name);

		$addQry = " 1=1 ";
		
		if($name != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PTNT_NM_INFO = '$name' ";
		}
		
		if($phone != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHONE_NO = '$phone' ";
		}		
		if($empno != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " ENT_EMPL_NO = '$empno' ";
		}	
		if($rday != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHY_YMD = '$rday' ";
		}	
		if($rtime != '') {
			if ($addQry)
			$addQry .= " AND ";
			$addQry .= " PHY_TIME = '$rtime' ";
		}		
		$qry = "
			update
				H5PHY_DUTY_RSRV
			set
				PROC_GB = '51'
			where
				$addQry
			";
		//echo $qry;
		$rst = $this -> DB2 -> execSqlUpdate($qry);
		return $rst;
	}	
	
	function MccReserveRegDetail($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		//���ڵ� ��ȯ
		$PTNT_NM = iconv("UTF-8", "EUC-KR", $PTNT_NM);
		$MEMO = iconv("UTF-8", "EUC-KR", $MEMO);		
				
		$qry = "
			INSERT INTO
				H5PHY_DUTY_RSRV_DETAIL
				(
					   DUTY_GB
				   ,   PHY_YMD
				   ,   PHY_TIME
				   ,   PHY_EMPL_NO
				   ,   PTNT_NO
				   ,   PTNT_NM
				   ,   PHONE_NO
				   ,   ORD_CD
				   ,   ORD_NM
				   ,   SCOPE_GB
				   ,   MEMO
				)
				VALUES
				(
					   '$DUTY_GB'
				   ,   '$PHY_YMD'
				   ,   '$PHY_TIME'
				   ,   '$PHY_EMPL_NO'
				   ,   '$PTNT_NO'
				   ,   '$PTNT_NM'
				   ,   '$PHONE_NO'
				   ,   '$ORD_CD'
				   ,   '$ORD_NM'
				   ,   '$SCOPE_GB'
				   ,   '$MEMO'
				)
			";
		//echo $qry;
		$rst = $this -> DB2 -> execSqlInsert($qry);
		return $rst;
	}		
}
?>