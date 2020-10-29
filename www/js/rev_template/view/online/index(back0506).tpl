<!docType html>
<html lang="ko">
<head>
	<title>카카오톡 로그인</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
	<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
	<script>
		$(document).ready(function(){
			Kakao.init("150343930bb755c6980b5ae6f42fb0d6");
			function getKakaotalkUserProfile(){
				Kakao.API.request({
					url: '/v1/user/me',
					success: function(res) {
						$("#kakao-profile").append(res.properties.nickname);
						$("#kakao-profile").append($("<img/>",{"src":res.properties.thumbnail_image,"alt":res.properties.nickname+"님의 프로필 사진"}));
						
						$("#r_nick").val(res.properties.nickname);
						$("#r_pro_image").val(res.properties.profile_image);
						$("#r_thum_image").val(res.properties.thumbnail_image);
						$("#r_id").val(res.id);
						if(res.properties.name) $("#r_name").val(res.properties.name);
						if(res.properties.phone) $("#r_phone").val(res.properties.phone);
						if(res.properties.rev_info) $("#r_info").val(res.properties.rev_info);												
						if(!res.properties.name || !res.properties.phone){
							$("#r_form").attr("action","/online/addinfo/");
						}else{
							$("#r_form").attr("action","/con/action/login_action/");	
						}
						//$("#r_form").submit();
					},
					fail: function(error) {
						console.log(error);
					}
				});
			}
			function createKakaotalkLogin(){
				$("#kakao-logged-group .kakao-logout-btn,#kakao-logged-group .kakao-login-btn").remove();
				var loginBtn = $("<a/>",{"class":"kakao-login-btn","text":"카카오로그인"});
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
				alert(Kakao.Auth.getRefreshToken());
				createKakaotalkLogout();
				getKakaotalkUserProfile();
			}else{
				createKakaotalkLogin();
			}
		});
	</script>
</head>
<form name="r_form" id="r_form" method="post">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="r_id" id="r_id">
	<input type="hidden" name="r_name" id="r_name">
	<input type="hidden" name="r_nick" id="r_nick">
	<input type="hidden" name="r_pro_image" id="r_pro_image">
	<input type="hidden" name="r_thum_image" id="r_thum_image">
	<input type="hidden" name="r_phone" id="r_phone">
	<input type="hidden" name="r_info" id="r_info">
</form>

<form name="l_form" id="l_form" method="post">
	<input type="hidden" name="mode" value="mem" />
	<input type="text" id="m_id" name="m_id" value="{m_id}"/>
	<input type="password" id="pwd" name="pwd" value="{pwd}"/>    
    <br />
    로그인기억<input type="checkbox" name="rem_info" value="Y"/>
    자동로그인<input type="checkbox" name="auto" value="Y"/>    
    <input type="button" id="btn_login" value="로그인" />
</form>       
<br><br>              

<body>
	<div id="kakao-logged-group"></div>
	<div id="kakao-profile"></div>
</body>
</html>

<script language="javascript">
	$("#btn_login").click(function(){
		$("#l_form").attr("action","/con/action/login_action/");
		$("#l_form").submit();		
	});
</script>