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
		case "d"; //의료진
			include_once($GP -> CLS."/class.doctor.php");	
			$C_Doctor 		= new Doctor;				
			$rtn = $C_Doctor->Doctor_Detail_List($args);
			foreach($rtn  as $key=>$val){
				$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic3"]]; 
				//echo '<li><a href="#">'.$val["dr_name"].'('.$GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]].')</a></li>';
				$result[] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"]);
			}
			echo json_encode($result);
		break;						
	}
	
?>