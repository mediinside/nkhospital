<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	$gubun = $_POST["gubun"];
	switch($gubun) {
		case "a"; //전문센터		
			foreach($GP -> NEW_MOBILE_CENTER  as $key=>$val){
				$result[] = array('name'=> $val,'code'=>strtolower($key));
			}
			echo json_encode($result);
		break;
		case "b"; //진료과		
			foreach($GP -> NEW_MOBILE_CLINIC  as $key=>$val){
				$result[] = array('name'=> $val,'code'=>strtolower($key));
			}
			echo json_encode($result);			
		break;
		case "c"; //특수클리닉		
			foreach($GP -> NEW_MOBILE_SPECIAL  as $key=>$val){
				$result[] = array('name'=> $val,'code'=>strtolower($key));
			}
			echo json_encode($result);			
		break;
	}
?>