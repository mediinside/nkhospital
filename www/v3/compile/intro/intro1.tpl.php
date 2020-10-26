<?php /* Template_ 2.2.8 2019/06/20 12:45:33 /home/hosting_users/nkmed/www/v3/view/intro/intro1.tpl 000002995 */ ?>
<?php $this->print_("introtop",$TPL_SCP,1);?>

<div class="hospGreeting">
    <div class="vodWrap">
        <div class="vod" style="top:0;left:0;width:100%;min-height:203px; height:auto; position:relative;height:auto;overflow:hidden;" id="play_main">    
           <video src="/file/nk10th.mp4" controls loop style="position:absolute;top:0;left:0;width:100%;" id="v_intro">지원하지 않는 브라우져 입니다.</video>
           <!-- <video id="v_intro" controls loop poster="/images/intro_thumb.jpg" style="width:100%; z-index:7;">
                <source src="http://nkhospital.net/file/nk10th.mp4" type='video/ogg; codecs="theora, vorbis"'>
                지원하지 않는 브라우져 입니다.
            </video>-->
            <div class="vlayer" style="width:100%; padding-bottom:56.25%; z-index:7;" id="layer_main">
                <img src="/images/intro_thumb.jpg" alt="" alt="" style="width:100%; z-index:7; position:absolute;">
                <img src="/images/mask_720405.png" alt=""  style="width:100%; z-index:8; position:absolute;" id="v_intro2">
            </div>
        </div>
    </div>
    <div class="section">
        <p class="decoTxt">풍부한 임상경험을 바탕으로 <br> 전문화된 뉴고려병원</p>
        <p>
            뉴고려병원은 의료법인 인봉의료재단 ‘영등포병원’에 이은 제 2의 병원으로 2000년 김포시 장기동에 ‘고려병원’ 으로 개원하여 2009년 김포 한강신도시 장기지구에 
            ‘뉴고려병원’ 으로 제 2의 도약을 하였습니다.
        </p>
        <p>
            300병상 규모로 신축한 뉴고려병원은 각 전문진료과의 우수한 의료진과 최신의료장비를 바탕으로 전문 의료 서비스를 제공하고 있습니다. 가현산 주변 숲으로 둘러싸인 아름다운 외관과 환자중심으로 설계된 넓고 편안한 병실은 환자분들의 쾌유에 최적의 환경을 제공하고 있습니다. 급격히 변화하는 의료환경의 변화 속에서 특화된 전문 진료센터의 운영을 통해 2011년에는 보건복지부 지정 (지정기간 : 2011.11. 01. ~ 2014.10.31) 대한민국 제 1기 “관절전문병원”으로 선정되었습니다. 또한 2013년에 심혈관/뇌혈관센터를 개설하여 환자들의 소중한 생명을 지켜내고 있습니다.
        </p>
        <p>
            뉴고려병원은 풍부한 임상경험을 바탕으로 전문화된 진료체계를 구축하여 변화하는 의료환경을 선도해가는 대한민국 대표병원으로 도약하겠습니다.
        </p>
    </div>
</div>

<script>
	$(document).on("click","#v_intro2",function(){
		console.log("click");
		var introVideo = document.getElementById("v_intro");
		$("#layer_main").hide();
		introVideo.play();
	});
</script>