<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}
//include $root_path."functions/function.query.php";


/*****************************************************************************************
//로그인채크
*****************************************************************************************/
	function AdminLoginCheck($args){
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
				and mb_password='$adm_mem_pwd'
		");
		$db->exec();
		$rtn = $db->mfa();
		return $rtn;
	}
?>



















