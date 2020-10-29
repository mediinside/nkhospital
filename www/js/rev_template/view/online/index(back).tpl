<!docType html>
<html lang="ko">
<head>
	<title>카카오톡 로그인</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
	<script src="/rev_template/js/jquery-1.10.2.min.js"></script>
	<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
	<script>
		$(document).ready(function(){
			Kakao.init("4385eacbe51b89306bc235e0f5b45978");
			function getKakaotalkUserProfile(){
				Kakao.API.request({
					url: '/v1/user/me',
					success: function(res) {
						alert(JSON.stringify(res));
						alert(res.nickname);
						$("#kakao-profile").append(res.properties.nickname);
						$("#kakao-profile").append($("<img/>",{"src":res.properties.profile_image,"alt":res.properties.nickname+"님의 프로필 사진"}));
					},
					fail: function(error) {
						console.log(error);
					}
				});
			}
			function createKakaotalkLogin(){
				$("#kakao-logged-group .kakao-logout-btn,#kakao-logged-group .kakao-login-btn").remove();
				var loginBtn = $("<a/>",{"class":"kakao-login-btn","text":"로그인"});
				loginBtn.click(function(){
					Kakao.Auth.login({
						persistAccessToken: true,
						persistRefreshToken: true,
						success: function(authObj) {
							getKakaotalkUserProfile();
							createKakaotalkLogout();
						},
						fail: function(err) {
							console.log(err);
						}
					});
				});
				$("#kakao-logged-group").prepend(loginBtn)
			}
			function createKakaotalkLogout(){
				$("#kakao-logged-group .kakao-logout-btn,#kakao-logged-group .kakao-login-btn").remove();
				var logoutBtn = $("<a/>",{"class":"kakao-logout-btn","text":"로그아웃"});
				logoutBtn.click(function(){
					Kakao.Auth.logout();
					createKakaotalkLogin();
					$("#kakao-profile").text("");
				});
				$("#kakao-logged-group").prepend(logoutBtn);
			}
			if(Kakao.Auth.getRefreshToken()!=undefined&&Kakao.Auth.getRefreshToken().replace(/ /gi,"")!=""){
				createKakaotalkLogout();
				getKakaotalkUserProfile();
			}else{
				createKakaotalkLogin();
			}
		});
	</script>
</head>
<body>
	<div id="kakao-logged-group"></div>
	<div id="kakao-profile"></div>
</body>
</html>