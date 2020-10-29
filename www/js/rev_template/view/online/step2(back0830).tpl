		<div class="pageTitle">
			<p>예약자 정보 / 환자 정보 입력</p>
			<button class="backBtn">back</button>
		</div>
        
<form name="r_from" id="r_form" method="post">
	<input type="hidden" name="mode" id="mode" value="{mode}" />
	<input type="hidden" name="r_date" value="{r_date}" />
	<input type="hidden" name="treat" value="{treat}" />
	<input type="hidden" name="doctor" value="{doctor}" />
	<input type="hidden" name="time" value="{time}" />        
        
		<div class="container">
			<h4 class="inputTit">예약자 정보</h4>
			<div class="inputWrap">
				<p class="cel">
					<label for="" class="hide">예약자 이름</label>
					<input type="text" id="name" name="name" class="txt" title="예약자 이름" placeholder="예약자 이름" value="{name}" readonly/>
				</p>
				<p class="phoneCel">
					<span><input type="text" class="txt" title="휴대폰 가운데자리 입력" id="phone1" name="phone1" value="{phone1}" readonly></span>
					<span><input type="text" class="txt" title="휴대폰 가운데자리 입력" id="phone2" name="phone2" value="{phone2}" readonly></span>
					<span><input type="text" class="txt" title="휴대폰 마지막자리 입력" id="phone3" name="phone3" value="{phone3}" readonly></span>
				</p>
				<p class="infoChk">
					<label><input type="checkbox" class="chk" id="same"/> 환자정보 동일</label>
				</p>
			</div>

			<h4 class="inputTit">환자 정보 입력</h4>
			<div class="inputWrap">
				<p class="cel">
					<label for="" class="hide">환자 이름(실명)</label>
					<input type="text" id="r_name" name="r_name" class="txt" title="환자 이름(실명)" placeholder="환자 이름(실명)"  value="{r_name}"/>
				</p>
				<p class="phoneCel">
					<span>
						{# phone_select_box2}
					</span>
					<span><input type="text" class="txt" title="휴대폰 가운데자리 입력" id="r_phone2" name="r_phone2" value="{r_phone2}"></span>
					<span><input type="text" class="txt" title="휴대폰 마지막자리 입력" id="r_phone3" name="r_phone3" value="{r_phone3}"></span>
				</p>
			</div>

			<div class="btnWrap btn2">
				<span><button type="button" id="img_next" class="btnM btnConfirm">예약하기</button></span>
				<span><a href="/" class="btnM btnCancel">취소</a></span>
			</div>

		</div>
</form>    
</body>
</html>
<script language="javascript">
	$("#same").click(function(){
		if($("#same").is(":checked") == true){
			$("#r_name").val($("#name").val());
			$("#r_phone1").val($("#phone1").val());
			$("#r_phone2").val($("#phone2").val());
			$("#r_phone3").val($("#phone3").val());
		}else{
			$("#r_name").val("");
			$("#r_phone1").val("");
			$("#r_phone2").val("");			
			$("#r_phone3").val("");
		}
	});
	$("#img_next").click(function(){
		if($('#r_name').val() == '') {
			alert('환자정보를 입력하세요');
			$('#r_name').focus();
			return false;
		}
		if($('#r_phone2').val() == '') {
			alert('전화번호 입력하세요');
			$('#r_phone2').focus();
			return false;
		}
		if($('#r_phone3').val() == '') {
			alert('전화번호 입력하세요');
			$('#r_phone3').focus();
			return false;
		}		
		
		$("#r_form").attr("action","/online/result/");
		$("#r_form").submit();	
	});
</script>