<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset=UTF-8>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:url" content="http://nkhospital.net/v2/?page=info&tab=info3" />
	<title>뉴고려병원</title>
	<link rel="stylesheet" href="/resource/font/notosanskr/style.css">
	<link rel="stylesheet" href="/resource/css/style.css">
	<script type="text/javascript" src="/resource/js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="/resource/js/jquery-ui.min.js"></script>
	<!--script type="text/javascript" src="/resource/js/swiper.min.js"></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="/resource/js/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="/resource/js/html5shiv.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/resource/js/ui.js"></script>
   	<script type="text/javascript" src="/resource/js/swiper.min.js"></script>
    <script type="text/javascript" src="/v2/js/common.js"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
    <!--script type="text/javascript" src="/v2/js/jquery.touchSwipe.min.js"></script> -->   
</head>
<body>

	<div id="wrap">
		<header id="header">
			<h1><a href="/v2/"><img src="/resource/images/img_logo.png" alt="인봉의료재단 뉴고려 병원"></a></h1>
			<button type="button" class="btnMenu" onclick="$('html').toggleClass('menuOn');"><span>메뉴</span></button>
			<button type="button" class="btnSearch" onclick="$('html').addClass('searchOn');">검색</button>

			<div id="gnb">
				<div class="gnbTop">
                    <?php if(!$_SESSION["suserid"]) { ?>
					<p class="state">로그인이 필요합니다.</p>
					<a href="#" class="btn" onClick="javascript:page_load('login','');">로그인</a>
					<a href="#" class="btn" onClick="javascript:page_load('join','');">회원가입</a>
                    <?php }else{ ?>
					<p class="state login"><span class="name"><?=$_SESSION["susername"]?></span> 회원님 안녕하세요.</p>
					<a href="#" class="btn" onClick="javascript:page_load('logout','');">로그아웃</a>
					<a href="#" class="btn1" onClick="javascript:page_load('mypage','');">마이페이지</a>
                    <?php } ?>
					<a href="http://www.nkhospital.net/m/res.easy.html" target="_blank" class="btnReserv">간편예약</a>
				</div>
				<nav class="menuNav">
					<div class="linkWrap">
						<a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info13');" class="link1">전화문의</a>
						<a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=40');" class="link2">전문의상담</a>
						<a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','depart=A&gubun=d');" class="link3">의료진소개</a>
						<a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info11');" class="link4">오시는 길</a>
					</div>
					<ul class="menuList">
						<li><a href="#">서비스이용안내 <span>(13)</span></a>
							<ul class="subMenu">
								<li class="open"><a href="#" onclick="subMenu(this); return false;">예약/발급 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="http://www.nkhospital.net/m/main.html" target="_blank">진료예약</a></li>
										<li><a href="http://smart.nkhospital.net/reserve/reserve01.html" target="_blank">검진예약</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info3');">증명서발급 안내</a></li>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">진료안내 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info4');">외래진료안내</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info5');">응급진료안내</a></li>
										<!--<li><a href="#" onClick="javascript:page_load('info','tab=info6');">비급여진료 안내</a></li>-->
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">입/퇴원 안내 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info7');">입/퇴원 안내</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info8');">입원생활안내</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info9');">면회안내</a></li>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">병원안내 <span>(4)</span></a>
									<ul class="subMenu2">
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info10');">병원둘러보기</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info11');">오시는길/주차안내</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info12');">장례식장</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('info','tab=info13');">전화번호 안내</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="#">진료과/의료진<span>(44)</span></a>
							<ul class="subMenu">
								<li><a href="#" onclick="subMenu(this); return false;">전문센터 <span>(<?=count($GP->NEW_MOBILE_CENTER)?>)</span></a>
									<ul class="subMenu2 typeDiv">
                                        <?php foreach($GP->NEW_MOBILE_CENTER as $k=>$v) { ?>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=a');"><?=$v?></a></li>
                                        <? } ?>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">진료과 <span>(<?=count($GP->NEW_MOBILE_CLINIC)?>)</span></a>
									<ul class="subMenu2 typeDiv">
	                                    <?php foreach($GP->NEW_MOBILE_CLINIC as $k=>$v) { ?>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=b');"><?=$v?></a></li>
                                        <? } ?>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">특수클리닉 <span>(<?=count($GP->NEW_MOBILE_SPECIAL)?>)</span></a>
									<ul class="subMenu2">
										<?php foreach($GP->NEW_MOBILE_SPECIAL as $k=>$v) { ?>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=c');"><?=$v?></a></li>
                                        <? } ?>
									</ul>
								</li>
                                <li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('doctor','depart=A&gubun=d');">의료진소개 <span>(3)</span></a>
								<!--<li><a href="#" onclick="subMenu(this); return false;">의료진소개 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="#" onClick="javascript:page_load('doctor','depart=A&gubun=a');">전문센터</a></li>
										<li><a href="#" onClick="javascript:page_load('doctor','depart=K&gubun=b');">진료과</a></li>
										<li><a href="#" onClick="javascript:page_load('doctor','depart=A&gubun=c');">특수클리닉</a></li>
									</ul>-->
								</li>
							</ul>
						</li>
						<li><a href="#">뉴고려커뮤니티 <span>(11)</span></a>
							<ul class="subMenu">
								<li><a href="#" onclick="subMenu(this); return false;">소통/공감 <span>(5)</span></a>
									<ul class="subMenu2">
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=news');">뉴고려소식</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=50');">건강정보</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=40');">전문의상담</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=20');">칭찬합시다</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('board','jbcode=120');">고객의 소리함</a></li>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">뉴고려소개 <span>(6)</span></a>
									<ul class="subMenu2">
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro1');">소개영상</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro2');">인사말</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro3');">연혁</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro4');">미션,비젼,가치</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro5');">채용정보</a></li>
										<li><a href="javascript:window.scrollTo(0,0);" onClick="javascript:page_load('intro','tab=intro6');">협력병원 및 기관</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
					<div class="btnSns">
						<a href="https://blog.naver.com/nkblog2014" target="_blank" class="blog">Blog</a>
						<a href="https://www.facebook.com/nkhospital7" target="_blank" class="facebook">facebook</a>
						<a href="https://www.youtube.com/channel/UC_8u752emktPchD8eSpYVNg" target="_blank" class="youtube">Youtube</a>
						<a href="https://tv.kakao.com/channel/3268713/cliplink/398694793?metaObjectType=Channel" target="_blank" class="kakao">kakao TV</a>
					</div>
					<small class="copy">&copy; 2019 NEW Korea Hospital  All right reserved.</small>
				</nav>
			</div>
		</header>

		<div class="layerSearch">
			<fieldset>
				<legend>검색어 입력</legend>
				<div class="search">
					<input type="text" class="inputTxt" placeholder="입력해 주세요." id="schtxt">
					<button class="btn" id="schbtn">검색</button>
				</div>
				<p class="txt">
					뉴고려병원 모바일은 질환 및 치료법을 영상으로 제작하여 더 좋은 의료 정보를 제공하는 영상기반 플랫폼 입니다.<br>
					검색을 통해 필요한 정보를 영상으로 만나보세요.
				</p>
			</fieldset>
			<button type="button" class="btnClose" onclick="$('html').removeClass('searchOn');">검색창 닫기</button>
		</div>