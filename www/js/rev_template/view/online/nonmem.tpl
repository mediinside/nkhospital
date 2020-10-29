	<header id="header">
		<h1 class="page-title">비회원 이용하기</h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
	</header>
	<article id="container">
		<header class="explain-text header">예약서비스를 이용하기 위해 필수정보 입력 후 본인인증을 진행해 주십시오.</header>
        <form id="rForm" method="post">
        	<input type="hidden" name="gubun" value="nomem" />
        	<input type="hidden" name="MemPhoneNo" id="MemPhoneNo" value="" />   
            <input type="hidden" id="confirm_no" value="N" />         
		<section>
			<section>
				<h1 class="section-title required">성명</h1>
				<section class="entry-section">
					<input type="text" placeholder="회원명(공백 없이 입력하십시오)" id="name" name="MemName"/>
				</section>
			</section>
			<section>
				<h1 class="section-title required">휴대전화</h1>
				<section class="entry-section">
					<ul>
						<li>
							<div class="select-layout">
								<a href="javascript:void(0)" class="trigger" id="phone1">010</a>
								<ul class="list">
									<li><a href="javascript:void(0)" data-value="010">010</a></li>
									<li><a href="javascript:void(0)" data-value="011">011</a></li>
									<li><a href="javascript:void(0)" data-value="016">016</a></li>
									<li><a href="javascript:void(0)" data-value="017">017</a></li>
									<li><a href="javascript:void(0)" data-value="018">018</a></li>
									<li><a href="javascript:void(0)" data-value="019">019</a></li>
								</ul>
							</div>
							<input type="number" id="phone2"/>
							<input type="number" id="phone3"/>
						</li>
						<li class="has-btn">
								<input type="text" placeholder="3분 이내 입력" id="confirmNo_p">
                                <span class="count-time" id="confirmNo">123</span>
								<p id="confirm_test"><a href="javascript:void(0)" class="btn-entry" id="confirmTo" onclick="sms_confirm();">인증번호 발송</a></p>
					    </li>
					</ul>
				</section>
			</section>
			<footer class="btn-group">
				<a href="#" class="btn btn-half" id="btn_confirm_non">다음</a>
			</footer>
		</section>
        </form>
	</article>
    
<script>
var timer = 3 * 60;
$("#btn_confirm_non").click(function(){
	var name  = $("#name").val();
	if(name == ""){
		warningBox("이름을 입력하세요.");
		return false;
	}
	if($("#confirm_no").val() != "Y"){
		warningBox("핸드폰 인증을 받으세요");
		return false;
	}		
	var phone1 = $.trim($("#phone1").html());
	var phone2 = $.trim($("#phone2").val());
	var phone3 = $.trim($("#phone3").val());	
	var phone = phone1+"-"+phone2+"-"+phone3;	
	$("#MemPhoneNo").val(phone);
	
	$("#rForm").attr("action","/online/reserve/");
	$("#rForm").submit();
	return false;
});

function sms_confirm(m){
	if(m == "re") {
		clearInterval(interval);
		timer = 3 * 60;
	}
	var phone1 = $.trim($("#phone1").html());
	var phone2 = $.trim($("#phone2").val());
	var phone3 = $.trim($("#phone3").val());

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
			$('#ajax_load').empty();
			alert(data);
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
}

function sconfirm(){
	var c_no = $.trim($("#confirm_no").val());
	var r_no = $.trim($("#confirmNo_p").val());
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
		$("#"+confirmno).val("N");
		$("#"+confirmtext).empty().html('<a href="javascript:void(0)" class="btn-entry" onClick="sms_confirm(\'gubun\',\'re\')">재전송</a>');			
	}
}

$("#confirmNo_p").focus(function(){
	$("#confirm_test").empty().html('<a href="javascript:void(0)" class="btn-entry" onClick="sconfirm()">확인</a>');
});
</script>				    