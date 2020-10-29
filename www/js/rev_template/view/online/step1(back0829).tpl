	<div class="pageTitle">
			<p>예약 정보 입력</p>
			<button class="backBtn">back</button>
		</div>
	<form name="r_form" id="r_form" method="post" action="/online/step2/">   
    	<input type="hidden" name="r_date" id="r_date" value="{r_date}" />     
		<div class="container">
			<div class="reserveSelec">
				<h4 class="subTitle">진료과 선택</h4>
				<p class="selectBox">
					<label for="dr_clinic" id="clinic_l">진료과목을 선택하세요</label>
					{# treat_select_box}
				</p>

				<h4 class="subTitle">의료진 선택</h4>
				<p class="selectBox">
					<label for="dr_clinic" class="" id="doctor_l">의료진을 선택하세요</label>
					<select name="doctor" id="doctor" title="의료진을 선택하세요">
						<option value="">:: 선택 ::</option>
					</select>
				</p>

				<h4 class="subTitle">시간 선택</h4>
				<p class="selectBox">
					<label for="dr_clinic" class="" id="time_l">진료시간을 선택하세요</label>
					<select name="time" id="time" title="진료시간을 선택하세요">
						<option value="">:: 선택 ::</option>
					</select>
				</p>

			<div class="btnWrap btn2">
				<span><button type="button" id="img_next" class="btnM btnConfirm">확인</button></span>
				<span><a href="/online/main/" class="btnM btnCancel">취소</a></span>

			</div>
			</div>
		</div>
	</form>
<script language="javascript">
	$("#treat").change(function(){
		$('#treat').prev('label').text($('#treat option:selected').text());
		$.ajax({
			type: "POST",
			url: "/con/ajax/doctor_ajax/",
			data: "mode=doc&dr_code=" + $(this).val(),
			dataType: "text",
			beforeSend: function() {
				wrapWindowByMask();
				$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
			},  			
			success: function(data) {
				$('#ajax_load').empty();
		        $('#mask').hide();    
				$('#doctor').empty();
				$('#doctor_l').empty().append("의료진을 선택하세요");
				$('#doctor_l').removeClass('on');
				$('#clinic_l').addClass('on');
				$('#doctor').append(data);					
			},
			error: function(xhr, status, error) { alert(error); }
		});			
	});
	
	$("#doctor").change(function(){
		$('#doctor').prev('label').text($('#doctor option:selected').text());
		var r_date = $("#r_date").val();
		var dr_code = $("#doctor").val();		
		$.ajax({
			type: "POST",
			url: "/con/ajax/doctor_ajax/",
			data: "mode=time&dr_code="+dr_code+"&r_date="+r_date,
			dataType: "text",
			beforeSend: function() {
				wrapWindowByMask();
				$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
			},  			
			success: function(data) {
				$('#ajax_load').empty();
				$('#mask').hide();  
				$('#time').empty();
				$('#time_l').empty().append("진료시간을 선택하세요");
				$('#doctor_l').addClass('on');
				$('#time').append(data);					
			},
			error: function(xhr, status, error) { alert(error); }
		});			
	});	
	
	$("#time").change(function(){
		$('#time').prev('label').text($('#time option:selected').text());
		$('#time_l').addClass('on');
	});
	
	
	$("#img_next").click(function(){
		if($('#treat').val() == '') {
				alert('진료과를 선택하세요');
				$('#treat').focus();
				return false;
		}
		if($('#doctor').val() == '') {
				alert('의료진을 선택하세요');
				$('#doctor').focus();
				return false;
		}
		if($('#time').val() == '') {
				alert('시간을 선택하세요');
				$('#time').focus();
				return false;
		}				
		$("#r_form").submit();
	});
	

</script>