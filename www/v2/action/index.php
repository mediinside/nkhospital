<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/v2/lib/lastest.php';
	include_once($GP->CLS."class.slidem.php");
	$C_Slide 	= new Slide;

	$data = main_lastest("news");
	$data1 = main_lastest("80");
	$data2 = main_lastest("140");
	$data3 = main_lastest("50");
	$args = "";
	$args["ts_gubun"] == "T";
	$tsdata = $C_Slide->Main_Slide_Show($args);
	$args["ts_gubun"] == "M";	
	$msdata = $C_Slide->Main_Slide_Show($args);	
	//print_r($tsdata);
?>

    <div class="mainSlide">
        <div class="slide">
            <ul class="swiper-wrapper">
            	<? foreach($tsdata as $k=>$v){ ?>
                <li class="swiper-slide">
                    <a href="<?=$$v["ts_link"]?>" target="_blank"><img src="<?=$GP->UP_SLIDE_URL.$v["ts_m_img"]?>" alt=""></a>
                </li>
                <? } ?>
                <!--<li class="swiper-slide">
                    <a href="#"><img src="/resource/images/main/img_top_banner01.jpg" alt=""></a>
                </li>-->
            </ul>
        </div>
        <div class="slidePage"></div>
    </div>
    <div class="mainLink">
        <ul>
            <li class="link1"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info13');">전화문의</a></li>
            <li class="link2"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info4');">진료시간</a></li>
            <li class="link3"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info11');">오시는 길</a></li>
            <li class="link4"><a href="http://smart.nkhospital.net/reserve/reserve01.html" target="_blank">검진예약</a></li>
            <li class="link5"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('center.info','');">진료과안내</a></li>
            <li class="link6"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','depart=A&gubun=d');">의료진소개</a></li>
            <li class="link7"><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=40');">전문의상담</a></li>
            <li class="link8"><a href="http://www.nkhospital.net/m/main.html" target="_blank">진료예약</a></li>
        </ul>
    </div>
    <div class="mainSlide2">
        <div class="slide">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <a href="#">
                        <img src="/resource/images/main/img_mid_banner01.jpg" alt="">
                        
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="#">
                        <img src="/resource/images/main/img_mid_banner02.jpg" alt="">
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="#">
                        <img src="/resource/images/main/img_mid_banner03.jpg" alt="">
                    </a>
                </li>
            </ul>
        </div>
		<button class="slideNext">다음슬라이드</button>
        <div class="slideNav">
            <p class="slideNum"><span class="activeNum">1</span>/<span class="totalNum">total</span></p>
            <div class="slidePage"></div>
        </div>
    </div>
    <section class="mainNotice">
        <h2 class="title">뉴고려 소식 <span class="slideInfo">화면을 좌우로 스크롤 하세요.</span></h2> 
        <div class="tabMenu">
            <ul>
                <li class="active"><a href="#" onclick="slideObj.mainSlide3.slideTo(1); return false;">모아보기</a></li>
                <li><a href="#" onclick="slideObj.mainSlide3.slideTo(2); return false;">병원소식</a></li>
                <li><a href="#" onclick="slideObj.mainSlide3.slideTo(3); return false;">CH NK</a></li>
                <li><a href="#" onclick="slideObj.mainSlide3.slideTo(4); return false;">건강정보</a></li>
            </ul>
        </div>
		<div class="slide">
			<div class="swiper-wrapper">
				<section class="swiper-slide">
					<h3 class="hidden">전체</h3>
					<ul class="list">
						<?=$data?>
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">포토뉴스</h3>
					<ul class="list">
						<?=$data1?>
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">CH NK</h3>
					<ul class="list">
						<?=$data2?>
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">건강정보</h3>
					<ul class="list">
						<?=$data3?>
					</ul>
				</section>
			</div>
		</div>
    </section>

