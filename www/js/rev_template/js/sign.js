	var timer = 3 * 60;
	var interval;
		fn.init = function(){
			fn.signUp = $('.swipe-contain').bxSlider({
				speed: 500,
				responsive: true,
				infiniteLoop: false,
				touchEnabled: false,
				pager : false,
				controls : false,
				autoControls :false,
				auto: false,
				adaptiveHeight: true,
				onSlideBefore : function($slideElement, oldIndex, newIndex){
					var paginate = $('.swipe-header');
					paginate.find('.active').removeClass('active');
					paginate.find('li').eq(newIndex).addClass('active');
					$('#wrap').scrollTop(0);
				},
				onSlideAfter : function($slideElement, oldIndex, newIndex){
					$('.bx-viewport').height($slideElement.outerHeight());
				}
			});
			$('.btn-previous-page').on('click',function(){
				var current = fn.signUp.getCurrentSlide();
				if (current > 0){
					if (current == 1) $('button[type="reset"]').trigger('click');
					fn.signUp.goToPrevSlide();
					return false;
				}
			});
			$('#btnAgreeNext').on('click',function(){
				if($("#agreeYN").is(":checked") == false) {
					warningBox("서비스 이용약관에 동의하셔야 합니다.");
					$("#agreeYN").focus();
					return false;
				}
				if($("#agreeYN2").is(":checked") == false) {
					warningBox("개인정보 수집 및 이용에 동의하셔야 합니다.");
					$("#agreeYN2").focus();
					return false;
				}
				fn.signUp.goToNextSlide();
			});
			$('#btnInformNext').on('click',function(){
				var MemID = $("#MemID").val();
				if($.trim(MemID).length < 5){
					warningBox("아이디는 5자 이상이어야 합니다.");
					$("#MemID").focus();
					return false;	
				}
				if($("#idcheckYN").val() == "N"){
					warningBox("아이디 채크를 하셔야 합니다.");
					$("#idcheckYN").focus();
					return false;	
				}
				if($("#confirm_no").val() != "Y"){
					warningBox("핸드폰인증을 완료해 주세요.");
					$("#confirmNo_p").focus();
					return false;	
				}
				
				if($("#MemPW").val().length < 5){
					warningBox("비밀번호를 입력해 주세요.");
					$("#MemPW").focus();
					return false;	
				}	
				
				if($("#MemPW").val() != $("#ReMemPW").val()){
					warningBox("비밀번호가 서로 같지 않습니다.");
					$("#MemPW").focus();
					return false;	
				}				

				if($("#MemName").val() == ""){
					warningBox("이름을 입력해 주세요.");
					$("#MemName").focus();
					return false;	
				}			
				
				var MemBirthDt = $("#MemBirthDt").val();
				
				if($.trim(MemBirthDt).length != 6){
					warningBox("생년월일을 정확히 입력해주세요.");
					$("#MemName").focus();
					return false;	
				}								

				var phone1 = $.trim($("#MemPhone1").html());
				var phone2 = $.trim($("#MemPhone2").val());
				var phone3 = $.trim($("#MemPhone3").val());
				if(phone2.length < 3 || phone3.length < 3) {
						warningBox("핸드폰 번호를 정확하게 입력해 주세요");
						return false;
				}
				if($("input:radio[name='MemSex']").is(":checked") == false){
					warningBox("성별을 선택해주세요.");
					return false;	
				}				
				var phone = phone1+"-"+phone2+"-"+phone3;
				$("#MemPhoneNo").val(phone);							
				var queryString = $("#rForm").serialize() ;

			$.ajax({
				type: "POST",
				url: "/con/ajax/mem_ajax_join/",
				data: queryString,
				dataType: "text",
				beforeSend: function() {

					$('#ajax_load').html('<img src="/path/images/ajax-loader.gif">');
				},  			
				success: function(data) {
					$('#ajax_load').empty();
					if($.trim(data) == "true") {
							fn.signUp.goToNextSlide();
							$('.btn-previous-page').remove();
					}else if($.trim(data) == "same") {
							warningBox("동일한 회원정보가 있습니다. 다시 시도해주세요.");
							return false;
					}else{
							warningBox("오류가 발생하였습니다. 다시 시도해주세요.");
						return false;
					}
				},
				error: function(xhr, status, error) { alert(error); }
			});								
				
			
			});
			
			$('#agree_all').click(function(){
				if($(this).is(":checked")) {
					$("#agreeYN").prop("checked",true);
					$("#agreeYN2").prop("checked",true);										
				}else{
					$("#agreeYN").prop("checked",false);
					$("#agreeYN2").prop("checked",false);										
				}
			});
		};
		
		$("#checkid").click(function(){
			var MemID = $("#MemID").val();
			if($.trim(MemID).length < 5){
				warningBox("아이디는 5자 이상이어야 합니다.");
				return false;	
			}
			$.ajax({
				type: "POST",
				url: "/con/ajax/mem_ajax_check/",
				data: "MemID="+MemID,
				dataType: "text",
				beforeSend: function() {
					//wrapWindowByMask();
					$('#ajax_load').html('<img src="/path/images/ajax-loader.gif">');
				},  			
				success: function(data) {
					$('#ajax_load').empty();
					if($.trim(data) == "true") {
							successBox("사용하실수 있는 아이디입니다.");
							$('#idcheckYN').val('Y');
					}else{
							warningBox("중복된 아이디 입니다. 다른 아이디를 입력하세요");
							$('#idcheckYN').val('N');
						return false;
					}
				},
				error: function(xhr, status, error) { alert(error); }
			});					
		});
		
		function sms_confirm(m){
			if(m == "re") {
				clearInterval(interval);
				timer = 3 * 60;
			}
			var phone1 = $.trim($("#MemPhone1").html());
			var phone2 = $.trim($("#MemPhone2").val());
			var phone3 = $.trim($("#MemPhone3").val());
			if(phone2.length < 3 || phone3.length < 3) {
					warningBox("핸드폰 번호를 정확하게 입력해 주세요");
					return false;
			}
			var phone = phone1+"-"+phone2+"-"+phone3;
			
			$("#confirmNo_p").prop('disabled',false);
			$('#confirmNo').empty();
			
			$.ajax({
				type: "POST",
				url: "/con/ajax/sms_ajax_send/",
				data: "phone="+phone,
				dataType: "text",
				beforeSend: function() {
					//wrapWindowByMask();
					$('#ajax_load').html('<img src="/path/images/ajax-loader.gif">');
				},  			
				success: function(data) {
					alert(data);
					$('#ajax_load').empty();
					if($.trim(data) == "false") {
						warningBox("발송에 실패 했습니다. 잠시후에 다시 시도해 주세요");
						return false;
					}else{
						successBox(phone + "번호로 인증번호를 발송하였습니다. 3분이내에 입력해주세요");
						$(".count-time").show();
						$("#confirm_no").val(data);
						$("#confirm_test").empty().html('<a href="javascript:void(0)" class="btn-entry" onClick="sms_confirm(\'re\')">재전송</a>');
						interval = setInterval(timer_update, 1000);
					}
				},
				error: function(xhr, status, error) { 
					$('#ajax_load').empty();
					alert(error); 
				}
			});				
			
			var phone = phone1+"-"+phone2+"-"+phone3;
		}
		
		function sconfirm(){
			var c_no = $.trim($("#confirm_no").val());
			var r_no = $.trim($("#confirmNo_p").val());
			alert(c_no)
			if(c_no != r_no) {
				warningBox("인증번호가 다릅니다.");
				return false;
			}
			successBox("정상적으로 인증 되셨습니다.");
			$("#confirmNo_p").attr("placeholder","인증 완료");
			$('#confirmNo_p').val('');
			$('#confirmNo').empty();
			$('#confirm_no').val('Y');
			clearInterval(interval);
		}
		

		function timer_update(interval){
			
			var minutes, seconds;
			timer = parseInt(timer);
			minutes = parseInt(timer / 60 % 60, 10);
			seconds = parseInt(timer % 60, 10);
			
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;
			
			$('#confirmNo').html(minutes+":"+seconds);

			if (--timer < 0) {
				timer = 0;
 				$("#confirmNo_p").attr("placeholder","요청하신 시간이 만료되었습니다.");
				//$("#confirmNo_p").prop('disabled',true);
				$("#confirm_no").val("N");
				$("#confirm_test").empty().html('<a href="javascript:void(0)" class="btn-entry" onClick="sms_confirm(\'re\')">재전송</a>');
				//window.clearInterval(interval);
			}
		}
		$("#confirmNo_p").focus(function(){
			$("#confirm_test").empty().html('<a href="javascript:void(0)" class="btn-entry" onClick="sconfirm()">확인</a>');
		});		