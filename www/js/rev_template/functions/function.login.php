<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}

/*****************************************************************************************
//로그인채크
*****************************************************************************************/
	function AdminLoginCheck($args){
		global $db;
		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$rst = false;
		$nowData = date("Y-m-d");
		$db->sql("
			select 
				* 
			from 
				".ADMIN_TABLE." A LEFT OUTER JOIN ".ADMIN_AUTH_TABLE." B ON A.mb_level=B.tl_level
			where 
				mb_id ='$adm_mem_id' 

		");
		$db->exec();
		$rtn = $db->mfa();
		$db->print_sql();
		return $rtn;
	}
	
/*****************************************************************************************
//로그인기록
*****************************************************************************************/	
	function Mem_Login_history($args) {
		global $db;
		print_r($args);
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
	}	
?>



















