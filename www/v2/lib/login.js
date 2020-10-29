$(document).ready(function(){
		getLogin();		
		
		//엔터키 막기
		$("*").keypress(function(e){
			if(e.keyCode==13) 
			{
				$('#img_login').click();
				return false;
			}
			else
			{
				return true;	
			}
		});	
		
		
		$('#mem_register').click(function() {
			location.href = "./join.html";								  
			return false;
		});
		
		$('#id_find').click(function() {
			location.href = "./idpw.html";								  
			return false;
		});
		
		$('#img_login').click(function(){									   
			$('#login-form').submit();
			return false;
		});		
		
		$.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^\w[\w\s]*$/.test(value);
		}, "영문(소)과 숫자를 조합하세요.");

		$('#login-form').validate({
			rules: {
				m_id: { required:true },
				m_pwd: { required: true, minlength: 5, maxlength:15, alphanumeric:true }
			},
			messages: {				
				m_id: { required: "아이디를 입력하세요" },
				m_pwd: { required: "패스워드를 입력하세요", minlength: $.format("패스워드는 {0}자 이상입니다"), maxlength: $.format("비밀번호는 {0}자 이하입니다.") }
			},
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				error.insertAfter(element);
				
				//element.parent().find("span.my_error_display").html('');
				//error.appendTo(element.parent().find("span.my_error_display"));
			},
			submitHandler: function(frm) {
				// 로그인 정보 저장 체크 확인하여 진행
				if(document.getElementById('saveid').checked) {
					saveLogin($('#m_id').val());
				} else {
					saveLogin("");
				}
	
			if (!confirm("로그인 하시겠습니까?")) return false;
				frm.action = '/v2/lib/login_action.php';
				frm.submit(); //통과시 전송
				return true;
			},
			success: function(element) {
			//
			}
		});
	});

	// 로그인 정보 저장(이메일)
	var confirmSave = function() {
		var isRemember;
		var cb = document.getElementById('saveid');	
		// 로그인 정보 저장한다고 선택할 경우
		if(cb.checked) {
			isRemember = confirm("로그인 정보를 저장하시겠습니까? 개인정보가 유출될 수 있으니 주의해주십시오.");	
			if(!isRemember)
			cb.checked = false;
		}
	}
	
	// 쿠키값 가져오기
	function getnull(key) {
		console.log(document.cookie);
		var cook = document.cookie + ";";
		var idx = cook.indexOf(key, 0);
		var val = "";
	
		if(idx != -1) {
			cook = cook.substring(idx, cook.length);
			begin = cook.indexOf("=", 0) + 1;
			end = cook.indexOf(";", begin);
			val = unescape( cook.substring(begin, end) );
		}	
		return val;
	}
	
	// 쿠키값 설정
	function setnull(name, value, expiredays) {
		var today = new Date();
		today.setDate( today.getDate() + expiredays );
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";"
	}
	
	// 쿠키에서 로그인 정보 가져오기
	function getLogin() {
		// userid 쿠키에서 id 값을 가져온다.
		var id = getnull("userid");
	console.log(id);
		// 가져온 쿠키값이 있으면
		if(id != "")
		{
			$('#m_id').val(id);
			$('#saveid').attr('checked','true');
		}
	}
	
	// 쿠키에 로그인 정보 저장
	function saveLogin(id){
		if(id != "") {
			setnull("userid", id, 7);
		} else {
			// userid 쿠키 삭제
			setnull("userid", id, -1);
		}
	}
	