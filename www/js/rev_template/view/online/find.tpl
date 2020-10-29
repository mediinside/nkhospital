<header id="header">
		<h1 class="page-title">ID/PW 찾기</h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
	</header>
	<article id="container">
		<header class="swipe-header tab">
			<ul>
				<li><a href="#id_search">아이디 찾기</a></li>
				<li><a href="#pw_search">비밀번호 찾기</a></li>
			</ul>
		</header>
		<form id="rForm">
			<input type="hidden" id="confirm_no" value="N" />
            <input type="hidden" id="p_confirm_no" value="N" />
		<section class="swipe-contain tab">
			<section id="id_search" class="section" data-init="id_search_init">
				<section class="entry">
					<p class="explain-text">회원가입 시 입력한 성명을 입력하고 휴대전화 인증을 진행해 주십시오.</p>
					<section>
						<h1 class="section-title required">성명</h1>
						<section class="entry-section">
							<input type="text" placeholder="회원명(공백 없이 입력하십시오)" id="i_name"/>
						</section>
					</section>
					<section>
						<h1 class="section-title required">휴대전화</h1>
						<section class="entry-section">
							<ul>
								<li>
									<div class="select-layout">
										<a href="javascript:void(0)" class="trigger" id="i_phone1">010</a>
										<ul class="list">
											<li><a href="javascript:void(0)" data-value="010">010</a></li>
											<li><a href="javascript:void(0)" data-value="011">011</a></li>
											<li><a href="javascript:void(0)" data-value="016">016</a></li>
											<li><a href="javascript:void(0)" data-value="017">017</a></li>
											<li><a href="javascript:void(0)" data-value="018">018</a></li>
											<li><a href="javascript:void(0)" data-value="019">019</a></li>
										</ul>
									</div>
									<input type="number" id="i_phone2"/>
									<input type="number" id="i_phone3"/>
								</li>
								<li class="has-btn">
                                    <input type="text" placeholder="3분 이내 입력" id="confirmNo_p">
                                    <span class="count-time" id="confirmNo">test</span>
                                    <p id="confirm_test"><a href="javascript:void(0)" class="btn-entry" id="confirmTo" onclick="sms_confirm('i');">인증번호 발송</a></p>
								</li>
							</ul>
						</section>
					</section>
					<footer class="btn-group">
						<a href="javascript:void(0)" class="btn btn-empty btn-half btn-next" id="search_id">다음</a>
					</footer>
				</section>
				<section class="result">
					<section class="well">
						<p class="explain-text">회원님의 아이디는 다음과 같습니다.</p>
						<p class="result-user-id" id="result_id"></p>
					</section>
					<footer class="btn-group">
						<a href="/online/find/" class="btn btn-half">확인</a>
                        <a href="/online/main/" class="btn btn-empty">취소</a>
					</footer>
				</section>
			</section>
			<section id="pw_search" class="section" data-init="pw_search_init">
				<section class="entry">
					<p class="explain-text">회원가입 시 입력한 성명, 아이디를 입력하고 휴대전화 인증을 진행해 주십시오.</p>
					<section>
						<h1 class="section-title required">성명</h1>
						<section class="entry-section">
							<input type="text" placeholder="회원명(공백 없이 입력하십시오)" id="p_name"/>
						</section>
					</section>
					<section>
						<h1 class="section-title">아이디</h1>
						<section class="entry-section">
							<input type="text" placeholder="아이디 입력" id="p_id"/>
						</section>
					</section>
					<section>
						<h1 class="section-title required">휴대전화</h1>
						<section class="entry-section">
							<ul>
								<li>
									<div class="select-layout">
										<a href="javascript:void(0)" class="trigger" id="p_phone1">010</a>
										<ul class="list">
											<li><a href="javascript:void(0)" data-value="010">010</a></li>
											<li><a href="javascript:void(0)" data-value="011">011</a></li>
											<li><a href="javascript:void(0)" data-value="016">016</a></li>
											<li><a href="javascript:void(0)" data-value="017">017</a></li>
											<li><a href="javascript:void(0)" data-value="018">018</a></li>
											<li><a href="javascript:void(0)" data-value="019">019</a></li>
										</ul>
									</div>
									<input type="number" id="p_phone2"/>
									<input type="number" id="p_phone3"/>
								</li>
								<li class="has-btn">
                                    <input type="text" placeholder="3분 이내 입력" id="p_confirmNo_p">
                                    <span class="count-time" id="p_confirmNo"></span>
                                    <p id="p_confirm_test"><a href="javascript:void(0)" class="btn-entry" id="p_confirmTo" onclick="sms_confirm('p');">인증번호 발송</a></p>
								</li>
							</ul>
						</section>
					</section>
					<footer class="btn-group">
						<a href="javascript:void(0)" class="btn btn-empty btn-half btn-next">다음</a>
					</footer>
				</section>
				<section class="result">
					<section class="well">
						<p class="explain-text" id="result_pw">회원가입의 연락처로 <br />임시 비밀번호를 발송하였습니다.</p>
					</section>
					<footer class="btn-group">
						<a href="/online/main/" class="btn btn-half">확인</a>
                        <a href="/online/main/" class="btn btn-empty">취소</a>
					</footer>
				</section>
			</section>
		</section>
	 </form>        
	</article>
<script type="text/javascript" src="/path/js/find.min.js"></script>   