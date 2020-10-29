<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."/class.doctor.php");	
	$C_Doctor 		= new Doctor;	
	
	$gubun = $_POST["gubun"];
	switch($gubun) {
		case "a"; //전문센터
		case "b"; //진료과	
		case "c"; //특수클리닉		
		if($gubun == "a") {
			$arr = $GP -> NEW_MOBILE_CENTER;
			$menutxt = "전문센터";
		}else if($gubun == "b") {
			$arr = $GP -> NEW_MOBILE_CLINIC;
			$menutxt = "진료과";			
		}else{
			$arr = $GP -> NEW_MOBILE_SPECIAL;
			$menutxt = "특수클리닉";			
		}
		foreach($arr as $key=>$val){
			echo '<section class="docList" data-depart="'.strtolower($key).'">
					<h3 class="subTitle">'.$val.'</h3>
						<ul class="list" id="doclist">';
			$args = "";
			if($gubun == "c") {
				$args["sp_type"] = strtoupper($key);;
			}else{
				$args["ct_type"] = strtoupper($key);;
			}
			$data = $C_Doctor->Doctor_Detail_List($args);
				foreach($data as $k=>$v){
					$treat = ($GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic3"]]; 
					$dname = $v["dr_name"]."(".$treat.")";						
					$dr_img = ($v["dr_mobile_img"]) ? $v["dr_mobile_img"] : $v["dr_face_img"] ;
					 echo  '<li data-idx='.$v["dr_idx"].' data-name='.$dname.'>
								<a href="#">
									<span class="pic">
										<img src="'.$GP -> UP_DOCTOR_URL . $dr_img.'" alt="">
										<i></i>
									</span>
									<span class="name">
										<b>'.$v["dr_name"].'</b> '. $GP -> DOCTOR_POSITION[$v["dr_position"]].'
									</span>
								</a>
							</li>';
				};
	
			echo '</ul>
					 <a href="#" class="link" data-depart='.$key.' data-gubun="'.$gubun.'" data-stxt='.$val.' data-mtxt="'.$menutxt.'">바로가기</a>
				</section>';
		};
		break;
		case "d"; //의료진
			$rtn = $C_Doctor->Doctor_Detail_List($args);
			foreach($rtn  as $key=>$val){
//				if(!$val["dr_clinic2"]) $val["dr_clinic2"] = $val["dr_clinic3"];
				$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic3"]]; 
				echo '<li><a href="#">'.$val["dr_name"].'('.$treat.')</a></li>';
			}
		break;						
	}
	
?>