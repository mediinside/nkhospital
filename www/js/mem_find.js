$(document).ready(function(){
			$('#mb_mobile').numeric({allow:'-'});										   		
		
			$('#id_find').click(function(){
				
				$('#findIdResult').html('');
				$('#resultWrap').css('display','none');	
				
				$('#find-id-form').submit();
				return false;										 
			});	
			
			$('#pwd_find').click(function(){
				$('#pwresult').html('');
				$('#pwWrap').css('display','none');
				
				$('#find-pw-form').submit();
				return false;										 
			});	
		});
		
		$('#find-id-form').validate({
			rules: {
				mb_email: { required:true } ,
				mb_name: { required:true }
			},
			messages: {				
				mb_email: { required: "이메일을 입력하세요"},
				mb_name: { required: "이름을 입력하세요" }
			},
			errorElement: "span",
			errorPlacement: function(error, element) {				
				var er = element.attr("name");						
				//error.insertAfter(element);					
				element.parent().find("span.my_error_display").html('');
				error.appendTo(element.parent().find("span.my_error_display"));
			},
			submitHandler: function(frm) {
				ajax_id_data();
				return true;
			},
			success: function(element) {
			//
			}
		});
		
		$('#find-pw-form').validate({
			rules: {
				mb_id: { required:true },
				mb_name: { required:true }
			},
			messages: {				
				mb_id: { required: "아이디를 입력하세요"},
				mb_name: { required: "이름을 입력하세요" }
			},
			errorElement: "span",
			errorPlacement: function(error, element) {				
				var er = element.attr("name");						
				//error.insertAfter(element);	
				element.parent().find("span.my_error_display").html('');
				error.appendTo(element.parent().find("span.my_error_display"));
			},
			submitHandler: function(frm) {
				ajax_pw_data();
				return true;
			},
			success: function(element) {
			//
			}
		});
		
		var ajax_pw_data = function() {
			if (!confirm("비밀번호 확인 요청을 하시면, \n\n 임시비밀번호가 발급됩니다. \n\n 임시비밀번호를 회원님의 이메일로 \n\n 전달 받으시겠습니까?")) return false;
			
			var data = $('#find-pw-form').serialize();
				
			$.ajax({
				url: "/inc/search_pw.php",
				type: 'POST',
				data: data,
				contentTypeString : "text/xml; charset=utf-8",				
				error: function(){
					alert('데이터 전송중 에러가 발생하였습니다.');
				},
				success: function(msg){
					$('#pwresult').html(msg);
					$('#pwWrap').show();
				}			  			
			});
		}
		
		
		var ajax_id_data = function() {
			var data = $('#find-id-form').serialize();
				
			$.ajax({
				url: "/inc/search_id.php",
				type: 'POST',
				data: data,
				contentTypeString : "text/xml; charset=utf-8",				
				error: function(){
					alert('데이터 전송중 에러가 발생하였습니다.');
				},
				success: function(msg){
					$('#findIdResult').html(msg);
					$('#resultWrap').show();
				}			  			
			});	
		}