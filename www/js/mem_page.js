				
		$(document).ready(function(){
							   
			$('#mb_pwd').alphanumeric();
			$('#mb_pwd_ok').alphanumeric();
			$('#mb_birth').numeric();
			$('#mb_mobile2').numeric();
			$('#mb_mobile3').numeric();
			  
										   
			$('#email_sel').change(function(){
				var val = $(this).val();
	
				if(val == "") {
					$('#mb_email2').val('');
				}else{
					$('#mb_email2').val(val);
				}
			});							   
								   
			$('#search_post').click(function() {	
				window.open('/inc/address_pop.html?obj=mb_post1&obj1=mb_post2&obj2=mb_addr1&obj3=mb_addr2&obj4=mb_load_addr1&obj5=mb_load_addr2', 'ifm_addr', 'width=500,height=600,resizable=yes,scrollbars=no,status=no,toolbar=no' );
			});	
			
			$('#btn_submit').click(function(){
				$('#frmJoin').submit();
				return false;
			});
			
			$('#btn_cancel').click(function(){
				location.href = '/mypage/mypage.html';
				return false;
			});
			
			$('#btn_pass_submit').click(function(){
				$('#frmPass').submit();
				return false;
			});
			
			$('#btn_pass_cancel').click(function(){
				location.href = '/mypage/passch.html';
				return false;
			});
			
			$('#btn_with_submit').click(function(){
				$('#frmWith').submit();
				return false;
			});
			
			$('#btn_with_cancel').click(function(){
				location.href = '/mypage/memout.html';
				return false;
			});
			
			$.validator.addMethod("emailcheck", function(value, element) {
				var val = $('#mb_email1').val() + '@' + value;
				return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(val);
			
			}, jQuery.validator.messages.emailcheck);
			
			$.validator.addMethod("alphanumeric", function(value, element) {
				return this.optional(element) || /^\w[\w\s]*$/.test(value);
			}, "영문(소)과 숫자를 조합하세요.");
			
			$.validator.addMethod("DoubleCheck", function(m_email2) {
				var postURL = "/inc/DoubleEmailCheck.php";
				var result;
				var m_email = $('#mb_email1').val() + "@" + m_email2;
				var old_email = $('#old_email').val();
				
				if(m_email == old_email) {
					return true;
				}
	
				$.ajax({
					cache: false,
					async: false,
					type: "POST",
					data: "mb_email=" + m_email,
					url: postURL,
					success: function(msg) {
						result = (msg == 'true') ? true : false;
					}
				});
	
				return result;
			}, '사용할 수 없는 이메일 입니다.');
			
								
			$.validator.addMethod("DoubleNickCheck", function(mb_nick) {
				var postURL = "/inc/DoubleNickCheck.php";
				var result;			
				
				var old_nick = $('#old_nick').val();
				
				if(mb_nick == old_nick) {
					return true;
				}
	
				$.ajax({
					cache: false,
					async: false,
					type: "POST",
					data: "mb_nick=" + mb_nick,
					url: postURL,
					success: function(msg) {
						result = (msg == 'true') ? true : false;
					}
				});
	
				return result;
			}, '사용할 수 없는 닉네임입니다.');
			
			$.validator.addMethod("passch", function(mb_pwd) {
				var postURL = "/inc/PassCheck.php";
				var result;
				var mb_code = $('#mb_code').val();
				
				$.ajax({
					cache: false,
					async: false,
					type: "POST",
					data: "mb_pwd=" + mb_pwd + "&mb_code=" + mb_code,
					url: postURL,
					success: function(msg) {
						result = (msg == 'true') ? true : false;
					}
				});
	
				return result;
			}, '비밀번호가 일치하지 않습니다.');
	
			
			$('#frmJoin').validate({
				rules: {
					mb_nick : { required:true, DoubleNickCheck:true},
					mb_email1: { required:true } ,
					mb_email2: { required:true, emailcheck:true, DoubleCheck:true },
					mb_pwd: { required: true, minlength: 4, maxlength:15, alphanumeric:true, passch:true },
					mb_name : { required:true },
					mb_birth : { required:true, minlength: 6 , maxlength: 6 },
					mb_sex : { required:true },
					mb_mobile1 : { required:true },
					mb_mobile2 : { required:true ,minlength: 4 , maxlength: 4},
					mb_mobile3 : { required:true ,minlength: 4 , maxlength: 4},
					mb_addr2 : { required :true },
				},
				messages: {				
					mb_nick: { required: "닉네임을 입력하세요"},
					mb_email1: { required: "이메일을 입력하세요"},
					mb_email2: { required: "이메일을 입력하세요", emailcheck: "올바른 이메일을 입력하세요" },
					mb_pwd: { required: "패스워드를 입력하세요", minlength: $.format("패스워드는 {0}자 이상입니다"), maxlength: $.format("패스워드는 {0}자 이하입니다.") },
					mb_name: { required: "성명을 입력하세요"},
					mb_birth: { required: "생년월일을 입력하세요", minlength: $.format("생년월일은 {0}자 이상 입력하시오") ,maxlength: $.format("생년월일은 {0}자 이상 입력하시오")},
					mb_sex: { required: "성별을 선택하세요"},
					mb_mobile1: { required: "휴대전화 번호를 선택하세요"},
					mb_mobile2: { required: "휴대전화 번호를 입력하세요", minlength: $.format("휴대전화 번호는 {0}자 이상 입력하시오") ,maxlength: $.format("휴대전화 번호는 {0}자 이상 입력하시오")},
					mb_mobile3: { required: "휴대전화 번호를 입력하세요", minlength: $.format("휴대전화 번호는 {0}자 이상 입력하시오") ,maxlength: $.format("휴대전화 번호는 {0}자 이상 입력하시오")},
					mb_addr2: { required: "주소를 선택하세요"}				
				},
				errorElement: "span",
				errorPlacement: function(error, element) {
					var er = element.attr("name");	
					
					if(er == "mb_email1" || er =="mb_email2" || er =="mb_mobile1" || er =="mb_mobile2" || er =="mb_mobile3") {
						element.parent().find("span.my_error_display").html('');
						error.appendTo(element.parent().find("span.my_error_display"));
					}else{
						error.insertAfter(element);	
					}
				},
				submitHandler: function(frm) {
					if (!confirm("수정 하시겠습니까?")) return false;
						frm.action = 'http://nkhospital.net:44809/mypage/proc/join_proc.php';
						frm.submit(); //통과시 전송
						return true;
				},
				success: function(element) {
				//
				}
			});
			
			$('#frmPass').validate({
				rules: {				
					mb_pwd: { required: true, minlength: 4, maxlength:15, alphanumeric:true, passch:true },
					mb_pwd_ch: { required: true, minlength: 4, maxlength:15, alphanumeric:true },
					mb_pwd_ok: { required: true, minlength: 5, equalTo: "#mb_pwd_ch" }
				},
				messages: {				
					mb_pwd: { required: "패스워드를 입력하세요", minlength: $.format("패스워드는 {0}자 이상입니다"), maxlength: $.format("패스워드는 {0}자 이하입니다.") },
					mb_pwd_ch: { required: "패스워드를 입력하세요", minlength: $.format("패스워드는 {0}자 이상입니다"), maxlength: $.format("패스워드는 {0}자 이하입니다.") },
					mb_pwd_ok: { required: "패스워드를 재입력하세요", minlength: $.format("패스워드는 {0}자 이상 입력하시오"), equalTo: "패스워드는 일치하지 않습니다" }
				},
				errorElement: "span",
				errorPlacement: function(error, element) {
					var er = element.attr("name");	
					error.insertAfter(element);					
				},
				submitHandler: function(frm) {
					if (!confirm("비밀번호를 변경 하시겠습니까?")) return false;
						frm.action = 'http://nkhospital.net:44809/mypage/proc/join_proc.php';
						frm.submit(); //통과시 전송
						return true;
				},
				success: function(element) {
				//
				}
			});
			
			
			$.validator.addMethod("reason_check", function(value, element) {                    
														   
				if($(":input:radio[name=reason]:checked").val() != '9'){
					return true;
				}else{	
					switch( element.nodeName.toLowerCase() ) {
					case 'select':
						// could be an array for select-multiple or a string, both are fine this way
						var val = $(element).val();
						return val && val.length > 0;
					case 'input':
						if ( this.checkable(element) )
							return this.getLength(value, element) > 0;
					default:
						return $.trim(value).length > 0;
					}
				}
			}, jQuery.validator.messages.reason_check);	
			
			
			$('#frmWith').validate({
				rules: {				
					dropoutAgree: { required: true },
					reason : { required: true },
					proposal : { reason_check:true}
				},
				messages: {				
					dropoutAgree: { required: "탈퇴약관에 동의하셔야 합니다." },
					reason: { required: "탈퇴사유를 선택하세요" },
					proposal :{ reason_check: "탈퇴사유를 입력하세요" }
				},
				errorElement: "span",
				errorPlacement: function(error, element) {
					var er = element.attr("name");					
					if(er == "reason") {
						$("#my_with_error").html('');
						error.appendTo($("#my_with_error"));
					}else{
						error.insertAfter(element);	
					}			
				},
				submitHandler: function(frm) {
					if (!confirm("탈퇴하시겠습니까?")) return false;
						frm.action = 'https://nkhospital.net:44809/mypage/proc/join_proc.php';
						frm.submit(); //통과시 전송
						return true;
				},
				success: function(element) {
				//
				}
			});
			
		});