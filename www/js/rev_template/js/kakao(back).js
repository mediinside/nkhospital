//		$(document).ready(function(){
			Kakao.init("150343930bb755c6980b5ae6f42fb0d6");
			function getKakaotalkUserProfile(){
				Kakao.API.request({
					url: '/v1/user/me',
					success: function(res) {
						alert(JSON.stringify(res));
						$("#kakao-profile").append(res.properties.nickname);
						$("#kakao-profile").append($("<img/>",{"src":res.properties.profile_image,"alt":res.properties.nickname+"님의 프로필 사진"}));
						$("#kakao-profile").append($("<img/>",{"src":res.properties.thumbnail_image,"alt":res.properties.nickname+"님의 프로필 사진"}));
						
						$("#r_nick").val(res.properties.nickname);
						$("#r_pro_image").val(res.properties.profile_image);
						$("#r_thum_image").val(res.properties.thumbnail_image);
						$("#r_id").val(res.id);
						
						$("#r_form").attr("action","/online/reserve/");
						if(res.properties.name) $("#r_name").val(res.properties.name);
						if(res.properties.phone) $("#r_phone").val(res.properties.name);
						if(res.properties.rev_info) $("#r_info").val(res.properties.name);												
						if(!res.properties.name || !res.properties.phone || res.properties.rev_info){
							$("#r_form").attr("action","/online/addinfo/");
						}
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
			function addKakaoUserProfile(phone,name){
				//alert(phone);
				//Kakao.Auth.getRefreshToken({
				//	success: function(authObj) {
						Kakao.API.request({
						  url:'/v1/user/update_profile', 
						  data: {
							properties: {
							  'phone': phone,
							  'name': name,
							} 
						  }
						}).then(function(res) {
						  // on success
						  console.log(res);
						  alert("sucess");
						}, function(err) {
						  // on error
						  console.log(err);
						  alert("fail");
						});	
					//}
				//});
			}
	//	});
