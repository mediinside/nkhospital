	<header id="header">
		<h1 class="page-title">회원가입</h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
	</header>
	<article id="container">
		<header class="swipe-header">
			<ul>
				<li class="active"><span>약관동의</span></li>
				<li><span>정보입력</span></li>
				<li><span>가입완료</span></li>
			</ul>
		</header>
		<section class="swipe-contain">
			<section id="agree">
				<section>
					<h1 class="section-title">서비스 이용약관</h1>
					<section class="well">
						<section class="agree-contents">
							<h1>서비스 이용약관 내용</h1>
							<p>aaa</p>
						</section>
						<footer class="text-right">
							<label class="check-label" id="test">
								<input type="checkbox" name="agree" id="agreeYN"/>
								<span>이용약관에 동의합니다.</span>
							</label>
						</footer>
					</section>
				</section>
				<section>
					<h1 class="section-title">개인정보 수집 및 이용목적에 대한 동의</h1>
					<section class="well">
						<section class="agree-contents">
							<h1>개인정보 수집 및 이용목적에 대한 동의 내용</h1>
							<p>aaa</p>
						</section>
						<footer class="text-right">
							<label class="check-label">
								<input type="checkbox" name="agree2" id="agreeYN2"/>
								<span>개인정보 수집 및 이용에 동의합니다.</span>
							</label>
						</footer>
					</section>
				</section>
				<section class="all-agree">
					<label class="check-label">
						<input type="checkbox" id="agree_all" />
						<span>전체동의</span>
					</label>
				</section>                
                
				<footer class="btn-group">
					<a href="javascript:void(0)" id="btnAgreeNext" class="btn btn-empty btn-half">다음</a>
                    <a href="/online/main/" class="btn btn-empty">취소</a>
				</footer>
			</section>
			<section id="inform">
			<form id="rForm">
            			<input type="hidden" id="idcheckYN" value="N" />
                        <input type="hidden" id="confirm_no" value="N" />
                        <input type="hidden" id="MemPhoneNo" name="MemPhoneNo" value="" />
				<section>
					<h1 class="section-title required">아이디</h1>
					<section class="entry-section has-btn">
						<input type="text" placeholder="아이디 입력" name="MemID" id="MemID"/>
						<a href="javascript:void(0)" class="btn-entry" id="checkid">중복확인</a>
					</section>
				</section>
				<section>
					<h1 class="section-title required">비밀번호</h1>
					<section class="entry-section">
						<ul>
							<li><input type="password" placeholder="비밀번호 입력" name="MemPW" id="MemPW"/></li>
							<li><input type="password" placeholder="비밀번호 재입력" name="ReMemPW" id="ReMemPW"/></li>
						</ul>
						<ul class="explain-list">
							<li><p>비밀번호는 8 ~ 16자의 영문 대소문자, 숫자와 특수 문자를 조합하여 설정하십시오.</p></li>
							<li>안전을 위해 자주 사용했거나 쉬운 비밀번호가 아닌 새 비밀번호를 등록하고 주기적으로 변경하십시오.</li>
						</ul>
					</section>
				</section>
				<section>
					<h1 class="section-title required">성명</h1>
					<section class="entry-section">
						<input type="text" placeholder="회원명(공백 없이 입력하십시오)" name="MemName" id="MemName"/>
					</section>
				</section>
				<section>
					<h1 class="section-title required">생년월일</h1>
					<section class="entry-section">
						<input type="number" placeholder="예 : 840214" name="MemBirthDt" id="MemBirthDt"/>
					</section>
				</section>
				<section>
					<h1 class="section-title required">휴대전화</h1>
					<section class="entry-section">
						<ul>
							<li>
								<div class="select-layout">
									<a href="javascript:void(0)" class="trigger" id="MemPhone1">010</a>
									<ul class="list">
										<li><a href="javascript:void(0)" data-value="010">010</a></li>
										<li><a href="javascript:void(0)" data-value="011">011</a></li>
										<li><a href="javascript:void(0)" data-value="016">016</a></li>
										<li><a href="javascript:void(0)" data-value="017">017</a></li>
										<li><a href="javascript:void(0)" data-value="018">018</a></li>
										<li><a href="javascript:void(0)" data-value="019">019</a></li>
									</ul>
								</div>
								<input type="number" maxlength="4" name="MemPhone2" id="MemPhone2"/>
								<input type="number" maxlength="4" name="MemPhone3" id="MemPhone3"/>
							</li>
							<li class="has-btn">
								<input type="text" placeholder="3분 이내 입력" id="confirmNo_p">
                                <span class="count-time" id="confirmNo"></span>
								<p id="confirm_test"><a href="javascript:void(0)" class="btn-entry" id="confirmTo" onclick="sms_confirm();">인증번호 발송</a></p>
							</li>
						</ul>
					</section>
				</section>
				<section>
					<h1 class="section-title required">성별</h1>
					<section class="entry-section">
						<div class="assent">
							<label class="radio-label"><input type="radio" name="MemSex" value="M"/><span>남성</span></label>
							<label class="radio-label"><input type="radio" name="MemSex" value="F"/><span>여성</span></label>
						</div>
					</section>
				</section>
				<footer class="btn-group">
					<button type="reset" class="none">초기화</button>
					<a href="javascript:void(0)" id="btnInformNext" class="btn btn-empty btn-half">다음</a>
                    <a href="/online/main/" class="btn btn-empty">취소</a>
				</footer>
				</form>
			</section>
			<section id="done">
				<section class="well">
					<section class="panel panel-contents icon-after-keyhole">
						<span>회원가입을 환영합니다.</span>
						<small>이제 본 서비스의 모든 기능을 편리하게 이용하실 수 있습니다.</small>
					</section>
					<footer class="btn-group">
						<a href="/online/main/" id="btnDoneNext" class="btn">로그인으로 이동</a>
					</footer>
				</section>
			</section>
		</section>
	</article>
<script type="text/javascript" src="/path/js/sign.min.js"></script>       
