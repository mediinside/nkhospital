	$(document).ready(function(){
		Kakao.init("150343930bb755c6980b5ae6f42fb0d6");
		function getKakaotalkUserProfile(){
			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					var gat = Kakao.Auth.getAccessToken();
					var grt = Kakao.Auth.getRefreshToken();			
					setCookie("grt",grt,30);
					setCookie("gat",gat,30);					
					$("#r_nick").val(res.properties.nickname);
					$("#r_pro_image").val(res.properties.profile_image);
					$("#r_thum_image").val(res.properties.thumbnail_image);
					$("#r_id").val(res.id);
					if(res.properties.name) $("#r_name").val(res.properties.name);
					if(res.properties.phone) {
						var r_phone = res.properties.phone;
						var phoneArray = r_phone.split('-');
						$("#r_phone1").val(phoneArray[0]);
						$("#r_phone2").val(phoneArray[1]);
						$("#r_phone3").val(phoneArray[2]);
					}
					if(res.properties.phone) $("#r_phone").val(res.properties.phone);
					if(res.properties.rev_info) $("#r_info").val(res.properties.rev_info);												
					if(!res.properties.name || !res.properties.phone){
						$("#r_form").attr("action","/online/addinfo/");
					}else{
						$("#r_form").attr("action","/con/action/login_action/");	
					}
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
						alert(err);
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
	$("#btn_login").click(function(){
		if($("#m_id").val() == ""){
			alert("아이디를 입력해주세요");
			$("#m_id").focus();
			return false;
		}
		if($("#pwd").val() == ""){
			alert("패스워드를 입력해주세요");
			$("#pwd").focus();
			return false;
		}	
			
		$("#l_form").attr("action","/con/action/login_action/");
		$("#l_form").submit();		
	});
	
	fn.init = function(){
			$('input[required]').on('keydown keypress keyup',function(){
				var me	= $(this),
					val	= me.val(),
					parent = me.parent();
				if (val.length > 0){
					parent.removeClass('required');
				} else {
					parent.addClass('required');
				}
			})
	};	