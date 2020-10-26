<?php
	include_once  '../_init.php';
	include_once $GP -> INC_WWW . '/m.head.php';
//	include_once $GP -> INC_WWW . '/count_inc.php';
    include_once($GP->CLS."class.naver.php");
    echo $_GET["reurl"];
	$url = $GP->NAVER_RETURN_URL."&u=M&re_url=".$_GET["reurl"]."ptye=c";
    echo $url;

	$naver = new Naver(array(
        "CLIENT_ID" => $GP->NAVER_CLIENT_ID,
        "CLIENT_SECRET" => $GP->NAVER_CLIENT_SECRET,
        "RETURN_URL" => $url,
        "AUTO_CLOSE" => true,
        "SHOW_LOGOUT" => false,
        "CLASS_MODE"  => "M"
        )
    );      
?>
<body>
<div id="wrap">
	<div id="header">
		<div class="hgroup">
			<h1 class="page-title">로그인</h1>
			<a href="javascript:history.back(-1);" class="history-back"><i class="ip-icon-arrow-back"></i><span class="text-ir">이전 화면</span></a>
		</div>
		<? include_once $GP -> INC_WWW . '/m.header.php'; ?>
	</div>
	<div id="container" class="signin">
		<div class="guide">
			<dl class="header">
				<dt>이용안내</dt>
				<dd>예약과 예약조회는 개인정보가 필요한 부분입니다.</dd>
			</dl>
			<div class="body">
				<ul class="disc-purple">
					<li>간략한 서비스 이용을 위해서 <span class="text-naver">네이버 로그인 (네아로),</span> <span class="text-kakao">카카오톡 로그인</span>을 사용해 접근하고 있습니다.</li>
					<li>최초 1회 로그인 이후 이름, 전화번호를 입력해 주시면 이후에는 네이버/카카오톡 로그인 만으로 서비스를 이용하실 수 있습니다.</li>
				</ul>
			</div>
		</div>
		<div class="provide-list">
			<ul>
				<li><?=$naver->login()?></li>
				<li><a href="javascript:;"  class="sign-in-provide-kakao" id="kakao_login">카카오 계정으로 로그인</a></li>
			</ul>
		</div>
	</div>
	<div id="footer">
		<p class="copyright">
			<span>Copyright(c) 2017</span>
			<em>NEW Korea Hospital</em>
		</p>
		<hr class="v-line" />
		<a href="https://www.nkhospital.net/" target="_blank">홈페이지 바로가기</a>
	</div>
</div>
</body>
</html>
<form name="r_form" id="r_form" method="post">
	<input type="hidden" name="re_url" id="mode" value="<?=$_GET["reurl"]?>">
	<input type="hidden" name="mode" id="mode" value="kakao">
    <input type="hidden" name="u" value="M">
	<input type="hidden" name="mb_id" id="r_id">
	<input type="hidden" name="mb_name" id="r_name">
</form>

<!-- <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script> -->
<!--script>
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
					$("#r_form").attr("action","/mypage/proc/login_proc.php");
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
			createKakaotalkLogin();
		}

	});
</script-->
<script>
$(document).ready(function(){
		// Kakao.init("97634374c23a55427c514fb41590ad54");
		function getKakaotalkUserProfile(){
			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					if(res.nickname) {
						$("#r_name").val(res.nickname);
					}
					$("#r_id").val(res.id);
					$("#r_form").attr("action","/mypage/proc/login_proc.php");
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