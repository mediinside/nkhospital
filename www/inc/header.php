<?php
include_once $GP -> HOME."main_lib/main_proc.php";
$Main_Slide = Main_Slide("PC");//슬라이드
?>
<header>
			<div id="login-bar">
				<ul class="left">
					<li>
						대표번호
						<span>1661-7779</span>
					</li>
					<li>
						ARS
						<span>031-980-9114</span>
					</li>
				</ul>
				<ul class="right">
					<li>
						<input type="text" id="schtxt">
						<button><img src="/resource-pc/images/search-gray.png" alt="검색" id="schbtn"></button>
					</li>
					<li><a href="#" >LOGIN</a></li>
				</ul>
			</div>
			<nav>
				<h1 id="logo">
					<a href="/">
						<img src="/resource-pc/images/logo.png" alt="인봉의료재단 뉴고려병원">
					</a>
				</h1>
				<a id="menu" href="#">
					<img src="/resource-pc/images/menu.png" alt="">
					<span>MENU</span>
				</a>
				<div id="gnb">
					<ul>
						<li class="left">
							<a href="#none" class="gnb-tit bc1" data-idx="1">서비스 이용안내</a>
							<div class="row">
								<dl>
									<dt><a data-idx="1-1" href="#none">예약/발급</a></dt>
									<dd><a data-idx="1-1" href="/service/page01.html">진료예약</a></dd>
									<dd><a data-idx="1-1" href="/service/page02.html">검진예약</a></dd>
									<dd><a data-idx="1-1" href="/service/page03.html">증명서발급안내</a></dd>
								</dl>
								<dl>
									<dt><a data-idx="1-2" href="#none">입/퇴원 안내</a></dt>
									<dd><a data-idx="1-2" href="/service/page06.html">입/퇴원 안내</a></dd>
									<dd><a data-idx="1-2" href="/service/page07.html">입원생활안내</a></dd>
									<dd><a data-idx="1-2" href="/service/page08.html">면회안내</a></dd>
								</dl>
							</div>
							<div class="row">
								<dl>
									<dt><a data-idx="1-3" href="#none">진료안내</a></dt>
									<dd><a data-idx="1-3" href="/service/page04.html">외래진료안내</a></dd>
									<dd><a data-idx="1-3" href="/service/page05.html">응급진료안내</a></dd>
								</dl>
								<dl>
									<dt><a data-idx="1-4" href="#none">병원안내</a></dt>
									<dd><a data-idx="1-4" href="/service/page09.html">병원둘러보기</a></dd>
									<dd><a data-idx="1-4" href="/service/page10.html">오시는길/주차안내</a></dd>
									<dd><a data-idx="1-4" href="/service/page11.html">장례식장</a></dd>
									<dd><a data-idx="1-4" href="/service/page12.html">전화번호 안내</a></dd>
								</dl>
							</div>
							<img src="/resource-pc/images/gnb-logo.png" alt="믿으니까, 뉴고려병원">
						</li>
						<li class="center">
							<a href="/center01/page.php?depart=A&gubun=A" data-idx="2" class="gnb-tit bc2">진료과/의료진</a>
							<div class="row">
								<dl>
									<dt><a href="/center01/page.php?depart=A&gubun=A">전문센터</a></dt>
									<dd><a href="/center01/page.php?depart=A&gubun=A">관절센터</a></dd>
									<dd><a href="/center01/page.php?depart=C&gubun=A">외상센터</a></dd>
									<dd><a href="/center01/page.php?depart=F&gubun=A">심혈관센터</a></dd>
									<dd><a href="/center01/page.php?depart=S&gubun=A">신장센터</a></dd>
									<dd><a href="/center01/page.php?depart=H&gubun=A">통증센터</a></dd>
									<dd><a href="/center01/page.php?depart=J&gubun=A">평생건강증진센터</a></dd>
									<dd><a href="/center01/page.php?depart=B&gubun=A">척추센터</a></dd>
									<dd><a href="/center01/page.php?depart=D&gubun=A">뇌신경센터</a></dd>
									<dd><a href="/center01/page.php?depart=E&gubun=A">소화기센터</a></dd>
									<dd><a href="/center01/page.php?depart=G&gubun=A">소아청소년센터</a></dd>
									<dd><a href="/center01/page.php?depart=I&gubun=A">응급의료센터</a></dd>
								</dl>
								<dl>
									<dt><a href="/center01/page.php?depart=AB&gubun=B">진료과</a></dt>
									<dd><a href="/center01/page.php?depart=AB&gubun=B">정형외과</a></dd>
									<dd><a href="/center01/page.php?depart=K&gubun=B">일반외과</a></dd>
									<dd><a href="/center01/page.php?depart=AE&gubun=B">순환기내과</a></dd>
									<dd><a href="/center01/page.php?depart=T&gubun=B">호흡기내과</a></dd>
									<dd><a href="/center01/page.php?depart=M&gubun=B">신경과</a></dd>
									<dd><a href="/center01/page.php?depart=N&gubun=B">산부인과</a></dd>
									<dd><a href="/center01/page.php?depart=W&gubun=B">재활의학과</a></dd>
									<dd><a href="/center01/page.php?depart=AH&gubun=B">마취통증의학과</a></dd>
									<dd><a href="/center01/page.php?depart=AA&gubun=B">직업환경의학과</a></dd>
									<dd><a href="/center01/page.php?depart=AC&gubun=B">신경외과</a></dd>
									<dd><a href="/center01/page.php?depart=AD&gubun=B">소화기내과</a></dd>
									<dd><a href="/center01/page.php?depart=AF&gubun=B">신장내과</a></dd>
									<dd><a href="/center01/page.php?depart=R&gubun=B">내분비내과</a></dd>
									<dd><a href="/center01/page.php?depart=AG&gubun=B">소아청소년과</a></dd>
									<dd><a href="/center01/page.php?depart=V&gubun=B">피부비뇨의학과</a></dd>
									<dd><a href="/center01/page.php?depart=O&gubun=B">치과</a></dd>
									<dd><a href="/center01/page.php?depart=P&gubun=B">영상의학과</a></dd>
									<dd><a href="/center01/page.php?depart=Q&gubun=B">진단검사의학과</a></dd>
									<dd><a href="/center01/page.php?depart=AI&gubun=B">응급의학과</a></dd>
								</dl>
								<dl>
									<dt><a href="/center01/page.php?depart=A&gubun=C">특수클리닉</a></dt>
									<dd><a href="/center01/page.php?depart=A&gubun=C">하지정맥류클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=C&gubun=C">요실금클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=G&gubun=C">비만클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=I&gubun=C">갑상선클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=J&gubun=C">복강경클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=H&gubun=C">당뇨클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=E&gubun=C">맘모톰클리닉</a></dd>
									<dd><a href="/center01/page.php?depart=F&gubun=C">재활치료센터</a></dd>
								</dl>
								<dl>
									<dt><a href="#none">의료진소개</a></dt>
									<dd><a href="/doctor/page.php?depart=A&gubun=A">전문센터</a></dd>
									<dd><a href="/doctor/page.php?depart=AB&gubun=B">진료과</a></dd>
									<dd><a href="/doctor/page.php?depart=A&gubun=C">특수클리닉</a></dd>
								</dl>
							</div>
						</li>
						<li class="right">
							<a href="#none" class="gnb-tit bc3">뉴고려 커뮤니티</a>
							<div class="row">
								<dl>
									<dt><a href="#">소통/공감</a></dt>
									<dd><a href="/notice/page01.html">병원소식</a></dd>
									<dd><a href="#">건강정보</a></dd>
									<dd><a href="/notice/page03.html">전문의 상담</a></dd>
									<dd><a href="/notice/page04.html">칭찬합니다</a></dd>
								</dl>
								<dl>
									<dt><a href="#">병원소개</a></dt>
									<dd><a href="/notice/page06.html">소개영상</a></dd>
									<dd><a href="/notice/page07.html">인사말</a></dd>
									<dd><a href="/notice/page08.html">연혁</a></dd>
									<dd><a href="/notice/page09.html">미션,비전,가치</a></dd>
									<dd><a href="/notice/page10.html">채용정보</a></dd>
									<dd><a href="#">협력병원 및 기관</a></dd>
								</dl>
							</div>
							<img src="/resource-pc/images/gnb-call.png" alt="응급환자 365일 24시간 진료. 응급실:031-980-9114. 콜센터:1661-7779.">
						</li>
					</ul>
				</div>
				<!-- //end #gnb -->
				<div id="reserve-btn-group">
					<a href="#">
						<img src="/resource-pc/images/tel.png" alt="">
						<span>전화예약<br>하러가기</span>
					</a>
					<a href="#">
						<img src="/resource-pc/images/reserve.png" alt="">
						<span>간편예약<br>하러가기</span>
					</a>
				</div>

				<!--
					Top-banner
				 -->
				 <div id="top-bnnr" class="swiper-container">
					<ul class="swiper-wrapper">
						<?=$Main_Slide?>
					</ul>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
					<!-- Add Arrows -->
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				 </div>
			</nav>
		</header>