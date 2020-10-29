<?
	ini_set('allow_url_fopen', 'On');
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."/class.doctor.php");	
	include_once($GP -> CLS."/class.video.php");
	$C_Doctor 		= new Doctor;
	$C_Button 		= new Button;
	$C_Video 	= new Video;
	$psize = "3";
	$gubun = ($_REQUEST["gubun"]) ? $_REQUEST["gubun"] : $_GET["gubun"];
	$depart = ($_REQUEST["depart"]) ? $_REQUEST["depart"] : $_GET["depart"];
	$depart = strtoupper($depart);
	$args = array();
	if($gubun == "c") {
		$args["sp_type"] = $depart;
		$args["vd_clinic3"] = $depart;
		$citxt = $GP->NEW_MOBILE_SPECIAL[$depart]."은";		
		$ctxt = $GP->NEW_MOBILE_SPECIAL[$depart];
	}else {
		$args["ct_type"] = strtoupper($depart);
		if($gubun == "a") {
			$args["vd_clinic1"] = $depart;
			$citxt = $GP->NEW_MOBILE_CENTER[$depart]."는";			
			$ctxt = $GP->NEW_MOBILE_CENTER[$depart];
		}else{
			$args["vd_clinic2"] = $depart;			
			$citxt = $GP->NEW_MOBILE_CLINIC[$depart]."는";			
			$ctxt = $GP->NEW_MOBILE_CLINIC[$depart];
		}
	}
	$data = $C_Doctor->Doctor_List_Mobile(array_merge($_GET,$_POST,$args));
	//print_r($data)
	$vdata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
	$args["vd_gubun"] = "I"; 
	$vidata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
	
	$th_img = ($vidata["0"]["vd_thumb"]) ? $GP -> UP_VIDEO_URL.$vidata["0"]["vd_thumb"] : "/resource/images/sample2.jpg";
	$th_img = '<img src="'.$th_img.'" alt="" style="width:100%; z-index:7; position:absolute; ">';

?>
<div class="vodWrap">
    <div class="vod" style="top:0;left:0;width:100%;height:100%;">
		<?=$you_link?>
		 <div class="vlayer" style="width:100%; padding-bottom:56.25%; z-index:7;" id="layer<?=$vd_idx?>">
        	<?=$th_img?>
             <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart" data-vid="<?=$you_id?>"  data-lid="layer<?=$vd_idx?>" data-pid="play<?=$vd_idx?>" data-vgubun="<?=$vgubun?>">
        </div>        
    </div>
    <div class="vodLink">
        <p class="share">공유하기</p>
        <span class="link">
            <a href="#" class="btnKakao">카카오톡</a>
            <a href="#" class="btnFacebook">페이스북</a>
            <a href="#" class="btnUrl">URL</a>
        </span>
        <a href="#" class="btnAsk">의료상담</a>
    </div>
</div>

<section class="section centerHome">
    <h3 class="title">뉴고려병원 <?=$citxt?></h3>
    <p class="txt"><?=$vidata[0]["vd_intro_content"]?>
        <!--환자 특성에 따른 최적의 관절치료를 진행합니다.<br>
        관절로 고민하시는 환자들의 연령, 부위, 질환을 종합 분석하여 맞춤치료를 하고, <span class="ftColor1">관절내시경 및 인공관절 수술을 전문적으로 시행</span>하고 있습니다.<br>
        임상경험이 풍부한 전문의료진의 진료와 검사, 수술, 재활치료 과정이 체계적이고 종합적으로 이뤄집니다. 또한 최소절개를 통해 통증을 감소시키고 빠른 회복이 가능하여 만족도 높은 결과를 기대할 수 있습니다.-->
    </p>
 <? foreach($data as $k=>$v){ 
		$dr_ps = $GP -> DOCTOR_POSITION[$v["dr_position"]];	
	 	$dr_treat  = nl2br($C_Func->dec_contents_edit($v["dr_treat"]));	
		$dr_mobile_img	= $v['dr_mobile_img'];
		if($dr_mobile_img !=  '') {
			$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_mobile_img . "' alt='' />";
		}	
		$moning_arr = explode(',', $v["dr_m_sd"]);	
		$after_arr = explode(',', $v["dr_a_sd"]);				
 ?>
    <div class="doctor">
        <div class="docTop">
            <div class="pic"><?=$dr_img?></div>
            <h2 class="name"><span><?=$v["dr_name"]?></span> <?=$dr_ps?>	</h2>
            <p class="cate"><?=$dr_treat?></p>
        </div>
        <div class="tableType1">
            <table class="center">
                <caption>진료시간표</caption>
                <colgroup>
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">시간</th>
                        <th scope="col">월</th>
                        <th scope="col">화</th>
                        <th scope="col">수</th>
                        <th scope="col">목</th>
                        <th scope="col">금</th>
                        <th scope="col">토</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col">오전</th>
                        <td><? if (in_array("월", $moning_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("화", $moning_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("수", $moning_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("목", $moning_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("금", $moning_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td rowspan="2">문의</td>
                    </tr>
                    <tr>
                        <th scope="col">오후</th>
                        <td><? if (in_array("월", $after_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("화", $after_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("수", $after_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("목", $after_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                        <td><? if (in_array("금", $after_arr)) { echo "진료"; }else{ echo "-"; }?></td>
                    </tr>
                    <tr>
                        <th scope="col">비고</th>
                        <td class="left" colspan="6"><?=$ctxt?> 예약문의 031-980-9114</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btnWrap">
            <span><a href="#" onclick="doctor_load('detail','gubun=d&idx=<?=$v["dr_idx"]?>');" class="btnType1">상세보기</a></span>
            <span><a href="http://www.nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>
        </div>
    </div>
    <? } ?>
</section>

<hr>
<? if($vdata) {?>
    <div class="section">
        <div class="tabMenu">
            <ul id="vod_gubun">
            <!--<li class="active"><a href="#"><span>수술치료</span></a></li>
                <li><a href="#"><span>비수술치료</span></a></li>-->
                <li class="active" data-gubun="C"><a href="javascript:void(0)"><span>치료법</span></a></li>
                <li data-gubun="D"><a href="javascript:void(0)"><span>질환정보</span></a></li>
            </ul>
        </div>
        <section class="relationVod" id="vod_result">
            
        </section>
        <br />
    </div>
<? } ?>
<style>
.vod{position:relative;height:100%;overflow:hidden;} 
.vod iframe,.video-container object,.video-container embed{position:absolute;top:0;left:0;width:100%;} 
</style>
<script>
   $(".depth3").children(".btn").html("<?=$ctxt?>");	
   var cl1 = "<?=$args["vd_clinic1"]?>";
   var cl2 = "<?=$args["vd_clinic2"]?>";
   var cl3 = "<?=$args["vd_clinic3"]?>";      
   vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3+'&gubun=C');
</script>