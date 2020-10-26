<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once "../inc/head.php";

$title = "진료과/의료진";
$page_title = "의료진소개";
$page_sub_title = "의료진소개";

include_once($GP->CLS."/class.list.php");
include_once($GP->CLS."class.doctor.php");
include_once($GP->CLS."class.video.php");
$C_ListClass 	= new ListClass;
$C_Doctor 		= new Doctor;
$C_Video 	= new Video;

$gubun = ($_GET["gubun"]) ? $_GET["gubun"] : "A";
$dr_idx = ($_GET["idx"]) ? $_GET["idx"] : $_GET["idx"];
$args = array();
$args["vd_dr_idx"] = $dr_idx;
$args["dr_idx"] = $dr_idx;

$data = $C_Doctor->Doctor_Info(array_merge($_GET,$_POST,$args));
$vdata = $C_Video->Video_List(array_merge($_GET,$_POST,$args));
$vdata_list 		= $vdata['data'];
$vdata_list_cnt 	= count($vdata_list);

$data["dr_clinic2"] = explode(',',$data["dr_clinic2"]);
$data["dr_clinic2"] = $data["dr_clinic2"][0];

if($data["dr_clinic2"]){
	$args["ct_type"] = $data["dr_clinic2"];
}else if($data["dr_clinic3"]){
	$args["sp_type"] = $data["dr_clinic3"];
}
$rtn = $C_Doctor->Doctor_Detail_List($args);
foreach($rtn  as $key=>$val){
	$val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
    $val["dr_clinic2"] = $val["dr_clinic2"][0];


	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic3"]];
	$result[$val["dr_idx"]] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"],'sname'=>$val["dr_name"]);
}

$stxt = $result[$idx]["sname"];


if($data) {
	extract($data);
	$dr_ps = $GP -> DOCTOR_POSITION[$dr_position];
	$dr_treat  = nl2br($C_Func->dec_contents_edit($dr_treat));
	$dr_history  = nl2br($C_Func->dec_contents_edit($dr_history));
	$dr_academy  = nl2br($C_Func->dec_contents_edit($dr_academy));

//echo "=========".$dr_academy;
	if($dr_mobile_img !=  '') {
		$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_mobile_img . "' alt='' />";
	}
	if($dr_bg_img !=  '') {
		$dr_bg_img = $GP -> UP_DOCTOR_URL . $dr_bg_img;
	}else{
		$dr_bg_img = "/resource/images/contents/bg_doc1.jpg";
	}
	$th_img = ($dr_thumb_img) ? $GP -> UP_DOCTOR_URL.$dr_thumb_img : "/resource/images/sample2.jpg";
	$th_img = '<img src="'.$th_img.'" alt="" style="width:100%; position:absolute; ">';
	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2]) ? $GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2] : $GP->NEW_MOBILE_SPECIAL[$dr_clinic3];

	$moning_arr = explode(',', $dr_m_sd);
	$after_arr = explode(',', $dr_a_sd);
	$moning_txt = "";
	$after_txt = "";

	if($dr_vd_link1) {
		$you_id = explode("watch?v=",$dr_vd_link1);
		$you_id = explode("&",$you_id[1]);
		$you_id = $you_id[0];
    }
    $dr_treat  = str_replace(",", "</li><li>", $dr_treat); 
    
}

if($gubun == "A") {
    $arr = $GP -> NEW_MOBILE_CENTER;
    $activeA = "active";

}else if($gubun == "B") {
    $arr = $GP -> NEW_MOBILE_CLINIC;
    $activeB = "active";
}else if($gubun == "C") {
    $arr = $GP -> NEW_MOBILE_SPECIAL;
    $activeC = "active";
}
$dep1 = "1";
$dep2 = "1-3";
$dep3 = "1-3-0";

?>

<body>
	<div id="wrap">
		<?php include_once "../inc/header.php" ?>
		<div id="container">
			<?php include_once "../inc/location.php" ?>
			<div id="sub-bnnr">
				<img src="/resource/images/subBnnr04.png" alt="">
				<h2>
					<span><img src="/resource/images/sub-bnnr-text.png" alt="믿으니까 뉴고려"></span>
					<small><?=$page_sub_title?></small>
				</h2>
			</div>
			<!-- //end #sub-bnnr -->
			<div id="innerCont">				

				<div class="l-pad-box gray">
					<iframe width="800" src="https://www.youtube.com/embed/<?=$you_id?>" frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen></iframe>
				</div>
				<h3 class="cont-tit"><?=$dr_greeting_title?></h3>
				<p>
                     <?=$dr_greeting?>
				</p>
				<div class="doctor">
					<div class="doctor-img">
                    <?=$dr_img?>
					</div>
					<div class="doctor-info">
						<p class="name">
							<small><?=$treat?></small>
							<span>
								<b><?=$dr_name?></b> <?=$dr_ps?>
							</span>
						</p>
						<div class="clinic">
							<span>전문분야</span>
							<ul>
								<li><?=$dr_treat?></li>
							</ul>
						</div>
						<div class="tableType-01 green">
							<table>
								<thead>
									<tr>
										<th class="bgc-gray">시간</th>
										<th class="bgc-gray">월</th>
										<th class="bgc-gray">화</th>
										<th class="bgc-gray">수</th>
										<th class="bgc-gray">목</th>
										<th class="bgc-gray">금</th>
										<th class="bgc-gray">토</th>
									</tr>
								</thead>
								<tbody class="text-center">
									<tr>
										<th class="bgc-gray">오전</th>
										<td><?if($moning_arr[0]=="월"){echo "진료";}?></td>
                                    <td><?if($moning_arr[1]=="화"){echo "진료";}?></td>
                                    <td><?if($moning_arr[2]=="수"){echo "진료";}?></td>
                                    <td><?if($moning_arr[3]=="목"){echo "진료";}?></td>
                                    <td><?if($moning_arr[4]=="금"){echo "진료";}?></td>
                                    <td><?if($moning_arr[5]=="토"){echo "진료";}?></td>
                                </tr>
									</tr>
									<tr>
										<th class="bgc-gray">오후</th>
                                        <td><?if($after_arr[0]=="월"){echo "진료";}?></td>
                                        <td><?if($after_arr[1]=="화"){echo "진료";}?></td>
                                        <td><?if($after_arr[2]=="수"){echo "진료";}?></td>
                                        <td><?if($after_arr[3]=="목"){echo "진료";}?></td>
                                        <td><?if($after_arr[4]=="금"){echo "진료";}?></td>
                                        <td><?if($after_arr[5]=="토"){echo "진료";}?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<p><?=$weekend_txt?></p>
						<div id="btn-box">
							<a href="#none" class="btn bg-green">상세보기</a>
							<a href="/m/main.html" target="_blank"  class="btn border-green">진료예약</a>
						</div>
					</div>
				</div>
				<!-- //end .doctor -->
				<div class="tabMenu-2">
					<ul>
						<li class="active"><a href="#none">경력 및 학력</a></li>
						<li><a href="#none">학회활동</a></li>
					</ul>
				</div>
				<div class="no1">
					<div class="doc-history">
                        <?=$dr_history?>    
					</div>
				</div>
				<div class="no2">
					<div class="doc-history">
                    <?=$dr_academy?>
					</div>
				</div>
			</div>
			<!-- //end #innerCont -->
		</div>
		<!-- //end #container -->

		<?php include_once "../inc/fnb.php" ?>
		<?php include_once "../inc/footer.php" ?>
	</div>
	<!-- //end #wrap -->
</body>

</html>