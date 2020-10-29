<?php /* Template_ 2.2.7 2016/09/05 17:27:10 /home/hosting_users/nkmed/www/rev_template/view/online/main.tpl 000002766 */ ?>
<header id="visual">
		<h1 class="company-logo"><img src="/path/public/images/company-logo.png" class="block" alt="R5" /></h1>
	</header>
	<article id="container">
		<section id="signIn">
			<form name="l_form" id="l_form" method="post">
				<input type="hidden" name="mode" value="mem" />
                    <ul class="entry-section">
                        <li class="required"><input type="text" id="m_id" name="m_id" required placeholder="아이디" value="<?php echo $TPL_VAR["m_id"]?>"/></li>
                        <li class="required"><input type="password" id="pwd" name="pwd" required placeholder="비밀번호" /></li>
                        <li>
                            <label class="check-label"><input type="checkbox" value="Y" id="" name="rem_info" <?php if($TPL_VAR["rem_yn"]){?>checked<?php }?> /><span>아이디기억</span></label>
                            <label class="check-label"><input type="checkbox" value="Y" id="" name="auto" /><span>자동로그인</span></label>
                        </li>
                    </ul>
                    <footer class="btn-group">
                        <ul>
                            <li><a href="#" class="btn" id="btn_login">로그인</a></li>
                            <li><a href="#" class="btn btn-kakao" id="kakao_login">카카오 로그인</a></li>
                        </ul>
                    </footer>
                    </form>
                    <aside class="another-sign">
                        <ul>
                            <li><a href="/online/sign/">회원가입</a></li>
                            <li><a href="/online/find/">ID/PW찾기</a></li>
                            <li><a href="/online/nonmem/">비회원 이용하기</a></li>
                        </ul>
                    </aside>
            </form>
		</section>
	</article>
<form name="r_form" id="r_form" method="post">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="r_id" id="r_id">
	<input type="hidden" name="r_name" id="r_name">
	<input type="hidden" name="r_nick" id="r_nick">
	<input type="hidden" name="r_pro_image" id="r_pro_image">
	<input type="hidden" name="r_thum_image" id="r_thum_image">
	<input type="hidden" name="r_phone1" id="r_phone1">
	<input type="hidden" name="r_phone2" id="r_phone2">
	<input type="hidden" name="r_phone3" id="r_phone3">        
	<input type="hidden" name="r_info" id="r_info">
</form>
       
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="/path/js/main.min.js"></script>