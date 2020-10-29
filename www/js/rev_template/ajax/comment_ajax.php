<?php 
/*
BY-SHIN - 2016-03-18
*/

define("IN_AUTH",true);
define("LAYOUT",false);
define("NEED_LOGIN",false);
define("AJAX_PAGE",true);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."bbs/xssFilter/HTML/Safe.php"; // xss filter을 include


$idx  	  = $_POST["idx"];
$content  = $_POST["content"];

$modDt = date('Y-m-d H:i:s');

$status = "N";
if($idx) {
	switch($_POST["mode"]){
		case "C_M" :
		$where_update = "WHERE idx = '$idx'";
		$db->sql("
					UPDATE ".BOARD_COMMENT_TABLE."	SET bc_content = '$content', bc_mod_date = '$modDt' $where_update
				");
		$db->exec();
			$entry[] = array (
					"status"  => "Y",
					"content" => $content
			);
		break;
		case "C_D" :
		$where_update = "WHERE idx = '$idx'";
		$db->sql("
					UPDATE ".BOARD_COMMENT_TABLE."	SET bc_del_flag = 'Y' $where_update
				");
		$db->exec();
		$db->sql("
					UPDATE  ".BOARD_LIST_TABLE." SET bl_comment_count = (bl_comment_count - 1) WHERE idx='$bc_idx' AND bl_comment_count > 0
				");
		$db->exec();
		
		
			$entry[] = array (
					"status"  => "Y"
			);
		break;		
	}
}
$result = json_encode($entry);
echo $result;
?>	