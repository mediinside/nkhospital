<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	$gubun = $_POST["gubun"];
	switch($gubun) {
		case "A"; //전문센터		
			echo "<option value=''>::선택::</option>";
			foreach($GP -> NEW_MOBILE_CENTER  as $k=>$v){
				echo '<option value="'.$k.'" >'.$v,'</option>';
			}
		break;
		case "B"; //진료과
			echo "<option value=''>::선택::</option>";				
			foreach($GP -> NEW_MOBILE_CLINIC  as $k=>$v){
				echo '<option value="'.$k.'" >'.$v,'</option>';				
			}
		break;
		case "C"; //특수클리닉		
			echo "<option value=''>::선택::</option>";		
			foreach($GP -> NEW_MOBILE_SPECIAL  as $k=>$v){
				echo '<option value="'.$k.'" >'.$v,'</option>';				
			}
		break;
	}
	
?>