<?php
	error_reporting(E_ALL^E_NOTICE);
	ini_set("display_errors", 1);
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once $GP -> INC_WWW . '/count_inc.php';
	if($_SESSION['suserid']) $C_Func->go_url("/v2/");
    include_once($GP->CLS."class.naver.php");
	$url = $GP->NAVER_RETURN_URL."&re_url=".$_GET["re_url"];
	$naver = new Naver(array(
        "CLIENT_ID" => $GP->NAVER_CLIENT_ID,
        "CLIENT_SECRET" => $GP->NAVER_CLIENT_SECRET,
        "RETURN_URL" => $url,
        "AUTO_CLOSE" => true,
        "SHOW_LOGOUT" => false,
		"CLASS_MODE" => "v2"
        )
    );      
?>
<div id="container">
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
                <a href="#" class="link" onClick="javascript:page_load('find','');">아이디/비밀번호 찾기</a>
            </div>
            <div class="btnSns">
               <?=$naver->login()?>
                <a href="#" class="btnKakao" id="kakao_login">카카오톡 로그인</a>
            </div>
            <a href="#" class="btnJoin">회원가입</a>
            <p class="helpTxt">
                저희 뉴고려병원 웹사이트에서는 의료법령에 의거 일부 컨텐츠를 열람하실 때 꼭 로그인이 필요합니다.<br>
                또한 온라인 예약이나 상담 등은 개개인의 예약/상담 정보를 보관하여 상담 및 진료품질 향상에 사용합니다.<br>
            </p>
        </fieldset>
     </form>
</div>
<form name="r_form" id="r_form" method="post">
	<input type="hidden" name="re_url" id="re_url" value="<?=$_GET["re_url"]?>">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="mb_id" id="r_id">
	<input type="hidden" name="mb_name" id="r_name">
</form>

<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/v2/lib/login.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
	$(document).ready(function(){
		Kakao.init("97634374c23a55427c514fb41590ad54");
		function getKakaotalkUserProfile(){
			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					if(res.nickname) {
						$("#r_name").val(res.nickname);
					}
					$("#r_id").val(res.id);
					$("#r_form").attr("action","/v2/lib/login_action.php");
					$("#r_form").submit();
				},
				fail: function(error) {
					console.log(error);
				}
			});
		}
		function createKakaotalkLogin(){
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
		}
		if(Kakao.Auth.getRefreshToken()!=undefined&&Kakao.Auth.getRefreshToken().replace(/ /gi,"")!=""){
			//getKakaotalkUserProfile();
		}else{
			createKakaotalkLogin();
		}

	});
</script>




