<div class="modal-box">
	<div class="modal small">
		<div class="login">
			<h2 class="pageTitle login">로그인</h2>
			<fieldset class="loginWrap section">
				<legend>로그인 입력</legend>
				<input type="text" class="inputTxt" name="m_id" id="m_id" placeholder="아이디를 입력해주세요.">
				<input type="password" class="inputTxt" name="m_pwd" id="m_pwd" placeholder="비밀번호를 입력해주세요.">
				<button class="btn bg-orange block" id="img_login">로그인</button>
				<div class="loginOption">
					<label>
						<input type="checkbox" class="inputChk" name="saveid" id="saveid" onclick="confirmSave()"> 아이디 저장
					</label>
					<a href="/v3/find.php" class="link">아이디/비밀번호 찾기</a>
				</div>
				<div class="btnSns">
					<a href="javascript:loginNaver();" class="btnNaver">네이버 로그인</a>
					<!-- <a href="javascript:;" class="class="btnKakao" id="kakao_login">카카오톡 로그인</a> -->
					<a href="javascript:;" class="btnKakao" id="kakao_login">카카오톡 로그인</a>
				</div>
				<a href="/v3/join.php" class="btn bg-deepblue block">회원가입</a>
				<p class="helpTxt">
					저희 뉴고려병원 웹사이트에서는 의료법령에 의거 일부 컨텐츠를 열람하실 때 꼭 로그인이 필요합니다.<br>
					또한 온라인 예약이나 상담 등은 개개인의 예약/상담 정보를 보관하여 상담 및 진료품질 향상에 사용합니다.<br>
				</p>
			</fieldset>
		</div>
		<a href="#none" class="close" onclick="$(this).parents('.modal-box').fadeOut(100)">&times;</a>
	</div>
</div>