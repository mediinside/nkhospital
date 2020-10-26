<?php /* Template_ 2.2.8 2019/08/12 16:23:37 /home/hosting_users/nkmed/www/v3/view/login.tpl 000003785 */ ?>
<h2 class="pageTitle login">로그인</h2>
    <form action="?" method="post" id="login-form" name="login-form">
        <input type="hidden" id="mode" name="mode" value="LOGIN" />
        <input type="hidden" id="re_rul" name="re_url" value="<?=$_GET['re_url']?>" />    
        <fieldset class="loginWrap section">
            <legend>로그인 입력</legend>
            <input type="text" class="inputTxt" name="m_id" id="m_id" placeholder="아이디를 입력해주세요.">
            <input type="password" class="inputTxt" name="m_pwd" id="m_pwd" placeholder="비밀번호를 입력해주세요.">
            <button class="btnConfirm" id="img_login">로그인</button>
            <div class="loginOption">
                <label>
                    <input type="checkbox" class="inputChk" name="saveid" id="saveid" onClick="confirmSave()" /> 아이디 저장
                </label>
                <a href="/v3/find.php" class="link">아이디/비밀번호 찾기</a>
            </div>
            <div class="btnSns">
                <a href="javascript:loginNaver();" class="btnNaver">네이버 로그인</a>
                <!-- <a href="javascript:;" class="class="btnKakao" id="kakao_login">카카오톡 로그인</a> -->
                <a href="javascript:;" id="kakao_login">카카오톡 로그인</a>
            </div>
            <a href="/v3/join.php" class="btnJoin">회원가입</a>
            <p class="helpTxt">
                저희 뉴고려병원 웹사이트에서는 의료법령에 의거 일부 컨텐츠를 열람하실 때 꼭 로그인이 필요합니다.<br>
                또한 온라인 예약이나 상담 등은 개개인의 예약/상담 정보를 보관하여 상담 및 진료품질 향상에 사용합니다.<br>
            </p>
        </fieldset>
     </form>
<form name="r_form" id="r_form" method="post">
	<input type="hidden" name="re_url" id="re_url" value="<?=$_GET["re_url"]?>">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="mb_id" id="r_id">
	<input type="hidden" name="mb_name" id="r_name">
</form>
<style type="text/css">
	#kakao_login:before{
		color: #412e34;
		background-image: url('/resource/images/kakao.png');
		content: "";
	    display: inline-block;
	    width: 3rem;
	    height: 3rem;
	    margin-right: 0.8rem;
	    background-size: cover;
	    background-repeat: no-repeat;
	    vertical-align: -10px;
	}
</style>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/v3/controller/js/login.js"></script>
<script>
	$(document).ready(function(){
		function getKakaotalkUserProfile(){
			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					if(res.nickname) {
						$("#r_name").val(res.nickname);
					}
					$("#r_id").val(res.id);
					$("#r_form").attr("action","/v3/controller/action/login_action.php");
					$("#r_form").submit();
				},
				fail: function(error) {
					console.log(error);
				}
			});
		}
		//function createKakaotalkLogin(){
			$("#kakao_login").click(function(){
				Kakao.Auth.login({
					persistAccessToken: true,
					persistRefreshToken: true,
					success: function(authObj) {
						getKakaotalkUserProfile();
					},
					fail: function(err) {
						//alert(err);
						console.log(err);
					}
				});
			});
			//$("#kakao-logged-group").prepend(loginBtn)
		//}
		if(Kakao.Auth.getRefreshToken()!=undefined&&Kakao.Auth.getRefreshToken().replace(/ /gi,"")!=""){
			//getKakaotalkUserProfile();
		}else{
			// createKakaotalkLogin();
		}
	});
</script>