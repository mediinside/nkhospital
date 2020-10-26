    <div class="mainSlide">
        <div class="slide">
            <ul class="swiper-wrapper">
            	<!--{@tsdata}-->
                <li class="swiper-slide">
                    <a href="{.ts_link}" target="_blank"><img src="{imgurl}{.ts_m_img}" alt=""></a>
                </li>
                <!--{/}-->
                <!--<li class="swiper-slide">
                    <a href="#"><img src="/resource/images/main/img_top_banner01.jpg" alt=""></a>
                </li>-->
            </ul>
        </div>
        <div class="slidePage"></div>
    </div>
    <div class="mainLink">
        <ul>
            <li class="link1"><a href="/v3/info.php?tab=info13">전화문의</a></li>
            <li class="link2"><a href="/v3/info.php?tab=info4">진료시간</a></li>
            <li class="link3"><a href="/v3/info.php?tab=info11_1">오시는 길</a></li>
            <li class="link4"><a href="http://smart.nkhospital.net/gate.html" target="_blank">검진예약</a></li>
            <li class="link5"><a href="/v3/center.info.php">진료과안내</a></li>
            <li class="link6"><a href="/v3/doctor.php?depart=A&gubun=A">의료진소개</a></li>
            <li class="link7"><a href="/v3/board.php?code=40">전문의상담</a></li>
            <li class="link8"><a href="http://www.nkhospital.net/m/main.html" target="_blank">진료예약</a></li>
        </ul>
    </div>
    <div class="mainSlide2">
        <div class="slide">
            <ul class="swiper-wrapper" id="main_slide">
                <li class="swiper-slide" data-vid="CuaKAJZLxZ8">
                    <a href="javascript:void(0);" data-vid="CuaKAJZLxZ8">
                        <img src="/resource/images/main/img_mid_banner01.jpg" alt="" data-vid="CuaKAJZLxZ8">
                    </a>
                </li>
                <li class="swiper-slide" data-vid="mCawo_WsjvM">
                    <a href="http://naver.com" data-vid="mCawo_WsjvM">
                        <img src="/resource/images/main/img_mid_banner02.jpg" alt="">
                    </a>
                </li>
                <li class="swiper-slide">
                    <a href="http://www.nkhospital.net/v3/board.php?code=news&bidx=2363">
                        <img src="/resource/images/main/img_mid_banner03.png" alt="">
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
						{data}
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">포토뉴스</h3>
					<ul class="list">
						{data1}
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">CH NK</h3>
					<ul class="list">
						{data2}
					</ul>
				</section>
				<section class="swiper-slide">
					<h3 class="hidden">건강정보</h3>
					<ul class="list">
						{data3}
					</ul>
				</section>
			</div>
		</div>
    </section>

<!-- 레이어 -->
<div id="video_result"></div>
<div id="video_result1"></div>
<div id="video_result2"></div>

<!--끝 -->