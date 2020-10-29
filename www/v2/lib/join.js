$(document).ready(function(){
		$('#mb_pwd').alphanumeric();
		$('#mb_pwd_ok').alphanumeric();
		$('#mb_birth').numeric();
		$('#mb_mobile').numeric();

		$('#btn_submit').click(function(){																		
			$('#frmJoin').submit();
			return false;
		});

		$('#btn_cancel').click(function(){
			location.href = '/v2/?page=join';
			return false;
		});
		$('#closed').click(function(){
			$(".layerAlert").hide()
			return false;
		});		
		$(".btnCom").click(function(){
			var postURL = "/inc/DoubleIDCheck.php";
			var mb_id = $("#mb_id").val();	
			if(mb_id.length < "6" || mb_id.length > "20") {
				$(".alertTxt").html("잘못된 아이디 입니다.");
				$(".layerAlert").show();
				return false;
			}
			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				data: "mb_id=" + mb_id,
				url: postURL,
				success: function(msg) {
					if(msg == 'true') {
						$(".alertTxt").html("사용 가능한 아이디 입니다");
					}else{
						$(".alertTxt").html("사용할 수 없는 아이디 입니다.");						
					}
					$(".layerAlert").show();
				}
			});			
		});

		$.validator.addMethod("emailcheck", function(value, element) {
			var val = $('#mb_email').val();
			return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(val);

		}, jQuery.validator.messages.emailcheck);

		$.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^\w[\w\s]*$/.test(value);
		}, "영문(소)과 숫자를 조합하세요.");

		$.validator.addMethod("DoubleCheck", function(m_email2) {
			var postURL = "/inc/DoubleEmailCheck.php";
			var result;
			var m_email = $('#mb_email').val();
			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				data: "mb_email=" + m_email,
				url: postURL,
				success: function(msg) {
					console.log(msg);
					result = (msg == 'true') ? true : false;
				}
			});
			return result;
		}, '사용할 수 없는 이메일 입니다.');
		
		$.validator.addMethod("DoubleIdCheck", function(mb_id) {
			var postURL = "/inc/DoubleIDCheck.php";
			var result;			
			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				data: "mb_id=" + mb_id,
				url: postURL,
				success: function(msg) {
					result = (msg == 'true') ? true : false;
				}
			});
			return result;
		}, "사용할 수 없는 아이디 입니다");
		
		$('#frmJoin').validate({
			rules: {
				mb_id : { required:true, minlength: 6, maxlength:20} ,
				mb_email: { required:true, emailcheck:true, DoubleCheck:true },
				mb_pwd: { required: true, minlength: 4, maxlength:15, alphanumeric:true },
				mb_pwd_ok: { required: true, minlength: 5, equalTo: "#mb_pwd" },
				mb_name : { required:true },
				mb_mobile : { required:true ,minlength: 11 , maxlength: 11}
			},
			messages: {
				mb_id: { required: "아이디를 입력하세요",minlength: $.format("아이디는 {0}자 이상입니다"), maxlength: $.format("아이디는 {0}자 이하입니다.") },
				mb_email: { required: "이메일을 입력하세요", emailcheck: "올바른 이메일을 입력하세요" },
				mb_pwd: { required: "패스워드를 입력하세요", minlength: $.format("패스워드는 {0}자 이상입니다"), maxlength: $.format("패스워드는 {0}자 이하입니다.") },
				mb_pwd_ok: { required: "패스워드를 재입력하세요", minlength: $.format("패스워드는 {0}자 이상 입력하세요"), equalTo: "패스워드는 일치하지 않습니다" },
				mb_name: { required: "성명을 입력하세요"},
				mb_mobile: { required: "휴대전화 번호를 입력하세요", minlength: $.format("휴대전화 번호는 {0}자 이상 입력하세요") ,maxlength: $.format("휴대전화 번호는 {0}자 이하로 입력하세요")},
			},
			errorElement: "span",
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				if(er == "mb_email" || er =="mb_mobile") {
					element.parent().find("span.my_error_display").html('');
					error.appendTo(element.parent().find("span.my_error_display"));
				}else{
					error.insertAfter(element);
				}
			},
			submitHandler: function(frm) {
				if (!confirm("가입 하시겠습니까?")) return false;
					frm.action = '/v2/lib/join_action.php';
					frm.submit(); //통과시 전송
					return true;
			},
			success: function(element) {
			//
			}
		});

	});