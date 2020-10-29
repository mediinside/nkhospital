<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");



switch ($jb_code)
{		
	case "40" :
		$index_page = "counsel.html";  	//내 진료상담
		break;
	
		
	default :
		$index_page = "counsel.html";	// 
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>