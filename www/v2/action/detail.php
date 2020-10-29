<?
	ini_set('allow_url_fopen', 'On');
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."/class.doctor.php");	
	include_once($GP -> CLS."/class.video.php");
	$C_Doctor 		= new Doctor;
	$C_Button 		= new Button;
	$C_Video 	= new Video;
	$gubun = ($_REQUEST["gubun"]) ? $_REQUEST["gubun"] : $_GET["gubun"];
	$dr_idx = ($_REQUEST["idx"]) ? $_REQUEST["idx"] : $_GET["idx"];	
	$depart = strtoupper($depart);
	$args = array();
	$args["vd_dr_idx"] = $idx;
	$args["dr_idx"] = $idx;	
	$data = $C_Doctor->Doctor_Info(array_merge($_GET,$_POST,$args));
//	print_r($data);
	$vdata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
	
	extract($data);
		$dr_ps = $GP -> DOCTOR_POSITION[$dr_position];	
	 	$dr_treat  = nl2br($C_Func->dec_contents_edit($dr_treat));	
		$dr_history  = nl2br($C_Func->dec_contents_edit($dr_history));		
		$dr_academy  = nl2br($C_Func->dec_contents_edit($dr_academy));				
		//$dr_face_img	= $dr_face_img;
		if($dr_mobile_img !=  '') {
			$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_mobile_img . "' alt='' />";
		}else{
			$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_face_img . "' alt='' />";	
		}
		if($dr_bg_img !=  '') {
			$dr_bg_img = $GP -> UP_DOCTOR_URL . $dr_bg_img;
		}else{
			$dr_bg_img = "/resource/images/contents/bg_doc1.jpg";	
		}		
		$moning_arr = explode(',', $dr_m_sd);	
		$after_arr = explode(',', $dr_a_sd);	
		$treat = ($GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2]) ? $GP->NEW_MOBILE_CENTER_ALL[$dr_clinic2] : $GP->NEW_MOBILE_CENTER_ALL[$dr_clinic3]; 
		if($dr_vd_link1) {
			$you_id = explode("watch?v=",$dr_vd_link1);
			$you_id = explode("&",$you_id[1]);
			$you_id = $you_id[0];
			/*$youtube_link = file_get_contents("http://youtube.com/get_video_info?video_id=".$you_id);
			parse_str($youtube_link, $data);
			if($data["status"] == "ok") {
				$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="231" src="//www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
			}else{
				if($dr_vd_link2) $vimeo_id = explode("vimeo.com/",$dr_vd_link2);
			}*/
			$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="231" src="//www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
		}else if($dr_vd_link2) {
			$vimeo_id = explode("vimeo.com/",$data["dr_vd_link2"]);	
		}else{
			$you_link = '<img src="/resource/images/sample2.jpg" alt="" style="width:100%;">';		
		}
		if($vimeo_id){
			$you_link ='<iframe src="https://player.vimeo.com/video/'.$vimeo_id[1].'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';	
		}
		$th_img = ($dr_thumb_img) ? $GP -> UP_DOCTOR_URL.$dr_thumb_img : "/resource/images/sample2.jpg";
		$th_img = '<img src="'.$th_img.'" alt="" style="width:100%; z-index:99; position:absolute; ">';
		
?>
<div class="vodWrap">
		<div style="position:absolute;top:0;left:0;width:100%;height:100%;">
        	<?=$you_link?>
        </div>
        <div class="vlayer" style="position:absolute; width:100%; padding-bottom:56.25%; z-index:9" id="layer<?=$vd_idx?>">
        	<?=$th_img?>
            <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:999; position:absolute;" id="vstart" data-vid="<?=$you_id?>"  data-lid="layer<?=$vd_idx?>" data-pid="play<?=$vd_idx?>" data-vgubun="<?=$vgubun?>">
        </div>
    </div>
    <div class="tableType2">
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
            </tbody>
        </table>
    </div>

    <section class="section docInfo">
        <div class="docTop">
            <div class="pic"><?=$dr_img?></div>
            <h2 class="name"><span><?=$treat?></span> <?=$dr_name?> <?=$dr_ps?></h2>
            <dl class="cate">
                <dt>전문분야</dt>
                <dd><?=$dr_treat?></dd>
            </dl>
        </div>
        <p class="txt1">환자와 소통하는 것이<br> 의사의 첫번째 임무입니다.</p>
        <p class="txt2">단순히 검사 결과 상의 증상으로는 좋은 치료를 하는데 한계가 있습니다. 통증 부위와 환자의 나이, 성별, 생활 및 환경에 따라 증상이 달라질 수 있기에 원인을 찾아 정확한 진단을 내리는 것이 관건이기 때문입니다.<br>
        충분한 의사소통을 통해서 적합한 치료와 안전한 수술 방법을 선택하고, 재발을 방지하기 위해 환자에게 충분한 생활습관 교정과 운동법을 설명하며, 적극적인 치료를 받을 수 있도록 돕는 것,
        그렇게 환자와의 소통을 통해 상황에 맞는 최상의 진료 서비스를 제공해주는 것이 의사의 첫번째 임무라고 생각합니다.</p>
        <section class="history" style="background-image:url('<?=$dr_bg_img?>');">
            <h3 class="title">경력 및 학력</h3>
            <ul class="list">
                <?=$dr_history?>
            </ul>

            <h3 class="title">학회활동</h3>
            <ul class="list">
	            <?=$dr_academy?>
            </ul>
        </section>

        <div class="btnWrap">
            <span><a href="#" onClick="javascript:page_load('board','jbcode=40');" class="btnType3">의료 상담</a></span>
            <span><a href="http://www.nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>
        </div>
    </section>
    <? if($vdata) { 
	?>
    <section class="section relationVod">
        <h4 class="title">관련영상</h4>
        <ul>
        	<? foreach($vdata as $k=>$v) { 
	            $vd_idx 		= $v['vd_idx'];
				$vd_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
				$vd_regdate 	= $v['vd_regdate'];		
				$vd_clinic1 	= $v['vd_clinic1'];
				$vd_clinic2 	= $v['vd_clinic2'];
				$vd_clinic3		= $v['vd_clinic3'];	
				$vd_link1		= $v['vd_link1'];
				$vd_link2		= $v['vd_link2'];
				$vimeo_id = "";
				if($vd_link1) {
					$you_id = explode("watch?v=",$vd_link1);
					$you_id = explode("&",$you_id[1]);
					$you_id = $you_id[0];
					/*
					$youtube_link = file_get_contents("http://youtube.com/get_video_info?video_id=".$you_id);
					parse_str($youtube_link, $data);
					if($data["status"] == "ok") {
						$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="100%" src="//www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
					}else{
						$vimeo_id = explode("vimeo.com/",$vd_link2);
					}*/
					$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="100%" src="//www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
				}else{
					$vimeo_id = explode("vimeo.com/",$vd_link2);	
				}
				if($vimeo_id){
					$you_link ='<iframe src="https://player.vimeo.com/video/'.$vimeo_id[1].'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';	
				}
				
				if($you_link) {
				?>
					<li>
						<div class="vod">
							<?=$you_link?>
							<!--<img src="/resource/images/sample2.jpg" alt="" style="width:100%;">-->
						</div>
						<div class="cont">
							<b class="tit"><?=$v["vd_title"]?></b>
							<span class="txt"><?=$v["vd_content"]?></span>
							<a href="#" class="name">
                            	<img src="<?=$GP->UP_DOCTOR_URL."/".$dr_face_s_img?>" />
								<!--<img src="/resource/images/contents/img_doc2.jpg" alt="">-->
								<span><?=$v['vd_dr_name']?> <?=$vd_ps?></span><br>
								<span>관절센터</span>
							</a>
							<span class="btnSns">
								<a href="#" class="btnKakao">카카오톡</a>
								<a href="#" class="btnFacebook">페이스북</a>
								<a href="#" class="btnUrl">URL</a>
							</span>
						</div>
					</li>
       		<? }
             } ?>
        </ul>
    </section>
    <? } ?>
    <br />
</div>

<style>
.vodWrap{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;} 
.vod{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;} 
.vod iframe,.video-container object,.video-container embed{position:absolute;top:0;left:0;width:100%;height:100%;} 
</style>
<script>
var psize = "<?=$psize?>";
</script>