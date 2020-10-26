<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once "../inc/head.php";

$title = "진료과/의료진";
$page_title = "의료진소개";
$page_sub_title = "전문센터";

include_once($GP->CLS."class.doctor.php");
include_once($GP->CLS."class.video.php");
$C_Doctor 		= new Doctor;
$C_Video 	= new Video;

$gubun = ($_GET["gubun"]) ? $_GET["gubun"] : "A";
$depart = ($_GET["depart"]) ? $_GET["depart"] : $_GET["depart"];
$args["order"] = "order by dr_name asc";
$rtn = $C_Doctor->Doctor_Detail_List($args);

foreach($rtn  as $key=>$val){
	//echo $val["dr_clinic2"]."<br>";
	$val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
	$val["dr_clinic2"] = $val["dr_clinic2"][0];

	$treat = ($GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$val["dr_clinic2"]] : $GP->NEW_MOBILE_SPECIAL[$val["dr_clinic3"]];
	$result[] = array('name'=> $val["dr_name"].'('.$treat.')','code'=>$val["dr_idx"]);
}

if($gubun == "A") {
    $arr = $GP -> NEW_MOBILE_CENTER;
    $activeA = "active";

}else if($gubun == "B") {
    $arr = $GP -> NEW_MOBILE_CLINIC;
    $activeB = "active";
}
else if($gubun == "C") {
    $arr = $GP -> NEW_MOBILE_SPECIAL;
    $activeC = "active";
}

$dep1 = "1";
$dep2 = "1-3";
	if($gubun=="A"){ $dep3 = "1-3-0";}
    elseif($gubun=="B"){ $dep3 = "1-3-1";}   
    elseif($gubun=="C"){ $dep3 = "1-3-2";}
  

?>
<script>
   function fnMove(seq){
        var offset = $("#h" + seq).offset();
        $('html, body').animate({scrollTop : offset.top}, 400);
    }
</script>

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
				<div class="tabMenu">
					<ul>
						<li class="<?=$activeA?>"><a href="page.php?depart=A&gubun=A">전문센터</a></li>
                        <li class="<?=$activeB?>"><a href="page.php?depart=A&gubun=B">진료과</a></li>
                        <li class="<?=$activeC?>"><a href="page.php?depart=A&gubun=C">특수클리닉</a></li>
					</ul>
				</div>
				<div class="page-dropdown">
					<button class="dropdown-toggle" type="button">선택해주세요</button>
					<ul class="dp-section dropdown-menu" style="height: 0px;">
						 <!-- 리스트 -->
                         <?
                            $j = "0" ;
                        foreach($arr as $k=>$v){
                            $j++;
                            ?>
                        <li class="dropdown-item"><a href="#none" onclick="fnMove('<?=$j?>')"><?=$arr[$k]?></a></li>
                        <?}?>
					</ul>
				</div>                
                    <?
                        $i = "0" ;
                        foreach($arr as $k=>$v){
                            $args = "";
                            $i++;
                            $args["ct_type"] = $k;

                    ?>                
                    <div class="docList">
					<h3 class="cont-tit bar" id="h<?=$i?>"><?=$arr[$k]?></h3>
					<ul class="list">
                    <?
                        //print_r($args);
                        $data = $C_Doctor->Doctor_Detail_List($args);
                        $data_list 		= $data['data'];
                        $data_list_cnt 	= count($data_list);

                        foreach($data as $key=>$val){
                        $dr_idx = $val["dr_idx"];
                        $dr_name = $val["dr_name"];
                        $dr_position = $val["dr_position"][0];
                        $val["dr_clinic2"] = explode(',',$val["dr_clinic2"]);
                        $val["dr_clinic2"] = $val["dr_clinic2"][0];

                        $treat = ($GP->NEW_MOBILE_CENTER[$val["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER[$val["dr_clinic2"]] : $GP->NEW_MOBILE_CLINIC[$val["dr_clinic2"]];

                        $dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $val["dr_face_img"] . "' class='block' alt='" .  $dr_name ."' />";

                    ?>
						<li data-idx="" data-name="<?=$dr_name?>">
							<a href="/doctor/doc-view.php?idx=<?=$dr_idx?>&gubun=<?=$gubun?>">
								<span class="pic">
                                    <?=$dr_img?>
									<i></i>
								</span>
								<span class="name">
									<b><?=$dr_name?></b> <?=$GP -> DOCTOR_POSITION[$dr_position]?>
								</span>
							</a>
						</li>
						<? } ?>
					</ul>
                    </div>
                    <? } ?>
				
               
				<!-- //end .docList -->
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