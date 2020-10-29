<?php /* Template_ 2.2.7 2016/09/05 18:03:00 /home/hosting_users/nkmed/www/rev_template/view/online/addinfo.tpl 000004174 */ ?>
<header id="header">
		<h1 class="page-title">예약자 정보 입력</h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
	</header>
	<article id="container">
	<form name="r_form" id="r_form" method="post">
		<input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>"/>
		<input type="hidden" name="kakao_token" value="<?php echo $TPL_VAR["kakao_token"]?>"/> 
		<input type="hidden" name="kakao_re_token" value="<?php echo $TPL_VAR["kakao_re_token"]?>"/>       
		<input type="hidden" name="r_id" value="<?php echo $TPL_VAR["r_id"]?>"/>
		<input type="hidden" name="r_nick" value="<?php echo $TPL_VAR["nick"]?>"/>
		<input type="hidden" name="r_pro_image" value="<?php echo $TPL_VAR["pro_image"]?>"/>
		<input type="hidden" name="r_thum_image" value="<?php echo $TPL_VAR["thum_image"]?>"/>
		<input type="hidden" name="r_info" value="<?php echo $TPL_VAR["r_info"]?>"/>
		<section>
			<h1 class="none">예약 메뉴</h1>
			<section class="well">
				<ul class="panel dotted-list">
					<li>진료받으실 환자분의 이름과 성별을 입력합니다. </li>
					<li>이 정보는 병원으로 바로 전달되며, 병원(전산)이외에는 제공/저장 되지 않습니다.</li>
				</ul>
				<div class="assent">
					<label class="radio-label"><input type="radio" name="agree" id="agree" value="Y"/><span>동의합니다.</span></label>
					<label class="radio-label"><input type="radio" name="agree" id="agree" value="N"/><span>동의하지 않습니다.</span></label>
				</div>
			</section>
		</section>
		<section>
			<p class="entry-field">
				<span class="text-point">*</span> 예약자 정보를 입력해 주세요.
			</p>
			<section class="entry-section">
				<ul>
					<li><input type="text" placeholder="예약자명" name="r_name" id="r_name" <?php if($TPL_VAR["rev_no"]=="0"){?> value="<?php echo $TPL_VAR["r_name"]?>" readonly="readonly"<?php }?>/></li>
					<li>
						<div class="select-layout top">
							<a href="javascript:void(0)" class="trigger" id="r_phone1">010</a>
							<ul class="list">
								<li><a href="javascript:void(0)" data-value="010">010</a></li>
								<li><a href="javascript:void(0)" data-value="011">011</a></li>
								<li><a href="javascript:void(0)" data-value="016">016</a></li>
								<li><a href="javascript:void(0)" data-value="017">017</a></li>
								<li><a href="javascript:void(0)" data-value="018">018</a></li>
								<li><a href="javascript:void(0)" data-value="019">019</a></li>
							</ul>
						</div>
						<input type="number" id="r_phone2" name="r_phone2" title="휴대폰 가운데자리 입력" onkeydown="return showKeyCode(event)" maxlength="4"/>
						<input type="number" id="r_phone3" name="r_phone3" title="휴대폰 마지막자리 입력" onkeydown="return showKeyCode(event)" maxlength="4"/>
					</li>
				</ul>
			</section>
		</section>
		<footer class="btn-group">
			<a href="javascript:void(0)" class="btn" id="btn_confirm">확인</a>
			<a href="/online/main/" class="btn btn-empty">취소</a>
		</footer>
	</form>
	</article>     
<script language="javascript">        
	$("#btn_confirm").click(function(){
		if($('#agree:checked').val() != 'Y') {
			alert('개인정보 수집/이용 약관에 동의하셔야 합니다');
			return false;
		}
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
		$("#r_form").attr("action","/con/action/login_action/");
		$("#r_form").submit();
	});
	
	function showKeyCode(event) {
		event = event || window.event;
		var keyID = (event.which) ? event.which : event.keyCode;
		if( ( keyID >=48 && keyID <= 57 ) || ( keyID >=96 && keyID <= 105 ) )
		{
			return;
		}
		else
		{
			return false;
		}
	}
</script>