<?php 
/*
BY-SHIN - 2019-06-12
*/
define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("AJAX_PAGE",true);

$root_path = "../../";
include $root_path."include/common.php";
include_once($GP->CLS."class.jhboard.php");
$C_JHBoard = new JHBoard();

$pd  = $_POST["pd"];
$args['jb_idx'] = $_POST["idx"];
//$args['jb_idx'] = "1827";
$data = "";
$data = $C_JHBoard -> Board_New_Read_Data($args);
$jb_password = $data["jb_password"];	
	if(empty($pd) || $pd != $jb_password){
		echo "비밀번호를 정확하게 입력해주세요.";
	}else{
		echo "true";			
	}
?>