<?php
	include_once  '../../_init.php';	
	
	$cate = $_POST['cate'];	
	
	foreach($GP -> CATE_TYPE2 as $key => $val) {
		if(ereg($cate, $key)){
			echo "<option value='$key'>$val</option>";
		}
	}

	exit();
?>