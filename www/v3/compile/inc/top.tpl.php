<?php /* Template_ 2.2.8 2020/10/26 07:56:40 C:\xampp\htdocs\newkorea\www\v3\view\inc\top.tpl 000008985 */ 
$TPL_gpa_1=empty($TPL_VAR["gpa"])||!is_array($TPL_VAR["gpa"])?0:count($TPL_VAR["gpa"]);
$TPL_gpb_1=empty($TPL_VAR["gpb"])||!is_array($TPL_VAR["gpb"])?0:count($TPL_VAR["gpb"]);
$TPL_gpc_1=empty($TPL_VAR["gpc"])||!is_array($TPL_VAR["gpc"])?0:count($TPL_VAR["gpc"]);?>
<!--[if lt IE 9]>
<div id="ie-version"><p>고객님께서는 현재 Explorer 구형버전으로 접속 중이십니다. 이 사이트는 Explorer 최신버전에 최적화 되어 있습니다. <a href="http://windows.microsoft.com/ko-kr/internet-explorer/download-ie" target="_blank">Explorer 업그레이드 하기</a></p> <button type="button" class="version-close">X</button></div>
<![endif]-->
<div id="wrap">
		<header id="header">
			<h1><a href="/v3/"><img src="/resource-pc/images/img_logo.png" alt="인봉의료재단 뉴고려 병원"></a></h1>
			<button type="button" class="btnMenu" onclick="$('html').toggleClass('menuOn');"><span>메뉴</span></button>
			<button type="button" class="btnSearch" onclick="$('html').addClass('searchOn');">검색</button>

			<div id="gnb">
				<div class="gnbTop">
                    <?php if(!$_SESSION["suserid"]) { ?>
					<p class="state">로그인이 필요합니다.</p>
					<a href="https://nkhospital.net:44809/v3/login.php" class="btn">로그인</a>
					<a href="https://nkhospital.net:44809/v3/join.php" class="btn">회원가입</a>
                    <?php }else{ ?>
					<p class="state login"><span class="name"><?=$_SESSION["susername"]?></span> 회원님 안녕하세요.</p>
					<a href="/v3/include/logout.php" class="btn">로그아웃</a>
					<a href="/v3/mypage.php?tab=mypage" class="btn1">마이페이지</a>
                    <?php } ?>
					<a href="javascript:alert('시스템 점검중입니다.콜센터로 전화 부탁 드립니다.')" class="btnReserv"><!--a href="http://www.nkhospital.net/m/res.easy.html" target="_blank" class="btnReserv"-->간편예약</a>
				</div>
				<nav class="menuNav">
					<div class="linkWrap">
						<a href="/v3/info.php?tab=info13" class="link1">전화문의</a>
						<a href="/v3/board.php?code=40" class="link2">전문의상담</a>
						<a href="/v3/doctor.php?depart=A&gubun=A" class="link3">의료진소개</a>
						<a href="/v3/info.php?tab=info11_1" class="link4">오시는 길</a>
					</div>
					<ul class="menuList">
						<li><a href="#">서비스이용안내 <span>(13)</span></a>
							<ul class="subMenu">
								<li class="open"><a href="#" onclick="subMenu(this); return false;">예약/발급 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="http://www.nkhospital.net/m/main.html" target="_blank">진료예약</a></li>
										<!--li><a href="http://smart.nkhospital.net/reserve/reserve01.html" target="_blank">검진예약</a></li-->
										<li><a href="http://smart.nkhospital.net/gate.html" target="_blank">검진예약</a></li>
										<li><a href="/v3/info.php?tab=info3">증명서발급 안내</a></li>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">진료안내 <span>(2)</span></a>
									<ul class="subMenu2">
										<li><a href="/v3/info.php?tab=info4">외래진료안내</a></li>
										<li><a href="/v3/info.php?tab=info5">응급진료안내</a></li>
										<!--<li><a href="#" onClick="javascript:page_load('info','tab=info6');">비급여진료 안내</a></li>-->
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">입/퇴원 안내 <span>(3)</span></a>
									<ul class="subMenu2">
										<li><a href="/v3/info.php?tab=info7">입/퇴원 안내</a></li>
										<li><a href="/v3/info.php?tab=info8">입원생활안내</a></li>
										<li><a href="/v3/info.php?tab=info9">면회안내</a></li>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">병원안내 <span>(4)</span></a>
									<ul class="subMenu2">
										<li><a href="/v3/info.php?tab=info10_1">병원둘러보기</a></li>
										<li><a href="/v3/info.php?tab=info11_1">오시는길/주차안내</a></li>
										<li><a href="/v3/info.php?tab=info12">장례식장</a></li>
										<li><a href="/v3/info.php?tab=info13">전화번호 안내</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="#">진료과/의료진<span>(<?php echo $TPL_VAR["ctotal"]?>)</span></a>
							<ul class="subMenu">
								<li><a href="#" onclick="subMenu(this); return false;">전문센터 <span>(<?=count( $TPL_VAR["gpa"])?>)</span></a>
									<ul class="subMenu2 typeDiv">
<?php if($TPL_gpa_1){foreach($TPL_VAR["gpa"] as $TPL_K1=>$TPL_V1){?>
										<li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=A"><?php echo $TPL_V1?></a></li>
<?php }}?>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">진료과 <span>(<?=count( $TPL_VAR["gpb"])?>)</span></a>
									<ul class="subMenu2 typeDiv">
<?php if($TPL_gpb_1){foreach($TPL_VAR["gpb"] as $TPL_K1=>$TPL_V1){?>
										<li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=B"><?php echo $TPL_V1?></a></li>
<?php }}?>
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">특수클리닉 <span>(<?=count( $TPL_VAR["gpc"])?>)</span></a>
									<ul class="subMenu2">
<?php if($TPL_gpc_1){foreach($TPL_VAR["gpc"] as $TPL_K1=>$TPL_V1){?>
										<li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=C"><?php echo $TPL_V1?></a></li>
<?php }}?>
									</ul>
								</li>
                                <li><a href="/v3/doctor.php?depart=A&gubun=A">의료진소개 <span>(3)</span></a>
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
										<li><a href="/v3/board.php?code=news">뉴고려소식</a></li>
										<li><a href="/v3/board.php?code=10">병원소식</a></li>
										<li><a href="/v3/board.php?code=50">건강정보</a></li>
										<li><a href="/v3/board.php?code=40">전문의상담</a></li>
										<li><a href="/v3/board.php?code=20">칭찬합시다</a></li>
										<!-- <li><a href="/v3/board.php?code=120">고객의 소리함</a></li> -->
									</ul>
								</li>
								<li><a href="#" onclick="subMenu(this); return false;">뉴고려소개 <span>(6)</span></a>
									<ul class="subMenu2">
										<li><a href="/v3/intro.php?tab=intro1">소개영상</a></li>
										<li><a href="/v3/intro.php?tab=intro2">인사말</a></li>
										<li><a href="/v3/intro.php?tab=intro3">연혁</a></li>
										<li><a href="/v3/intro.php?tab=intro4">미션,비젼,가치</a></li>
										<li><a href="/v3/intro.php?tab=intro5">채용정보</a></li>
										<li><a href="/v3/intro.php?tab=intro6">협력병원 및 기관</a></li>
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