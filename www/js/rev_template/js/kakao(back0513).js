//		$(document).ready(function(){
			Kakao.init("150343930bb755c6980b5ae6f42fb0d6");
			function getKakaotalkUserProfile(){
				Kakao.API.request({
					url: '/v1/user/me',
					success: function(res) {
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
					location.href = "/online/main/";
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
					location.href = '/online/reserve/';
				}, function(err) {
				  // on error
				  console.log(err);
				  alert("fail");
				});	
			}
			function addKakaorevProfile(revinfo){
				Kakao.API.request({
				  url:'/v1/user/update_profile', 
				  data: {
					properties: {
					  'rev_info': revinfo
					} 
				  }
				}).then(function(res) {
				  console.log(res);
				 // alert("sucess");
				  $("#r_form").attr("action","/online/result/");
				  $("#r_form").submit();

				}, function(err) {
				  // on error
				  alert("fail");
				  console.log(err);

				});	
			}

	//	});
