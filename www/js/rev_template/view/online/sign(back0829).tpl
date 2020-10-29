	<header id="header">
		<h1 class="page-title">회원가입</h1>
		<a href="index.html" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
	</header>
	<article id="container">
		<header class="swipe-header">
			<ul>
				<li class="active"><span>약관동의</span></li>
				<li><span>정보입력</span></li>
				<li><span>가입완료</span></li>
			</ul>
		</header>
		<section class="swipe-contain">
			<section id="agree">
				<section>
					<h1 class="section-title">서비스 이용약관</h1>
					<section class="well">
						<section class="agree-contents">
							<h1>서비스 이용약관 내용</h1>
							<p>aaa</p>
						</section>
						<footer class="text-right">
							<label class="check-label" id="test">
								<input type="checkbox" name="agree" id="agreeYN"/>
								<span>이용약관에 동의합니다.</span>
							</label>
						</footer>
					</section>
				</section>
				<section>
					<h1 class="section-title">개인정보 수집 및 이용목적에 대한 동의</h1>
					<section class="well">
						<section class="agree-contents">
							<h1>개인정보 수집 및 이용목적에 대한 동의 내용</h1>
							<p>aaa</p>
						</section>
						<footer class="text-right">
							<label class="check-label">
								<input type="checkbox" name="agree2" id="agreeYN2"/>
								<span>개인정보 수집 및 이용에 동의합니다.</span>
							</label>
						</footer>
					</section>
				</section>
				<section class="all-agree">
					<label class="check-label">
						<input type="checkbox" id="agree_all" />
						<span>전체동의</span>
					</label>
				</section>                
                
				<footer class="btn-group">
					<a href="javascript:void(0)" id="btnAgreeNext" class="btn btn-empty btn-half">다음</a>
				</footer>
			</section>
			<section id="inform">
			<form id="rForm">
            			<input type="hidden" id="idcheckYN" value="N" />
            			<input type="hidden" id="phonecheckYN" value="N" /> 
                        <input type="hidden" id="confirm_no" value="N" />
				<section>
					<h1 class="section-title required">아이디</h1>
					<section class="entry-section has-btn">
						<input type="text" placeholder="아이디 입력" name="MemID" id="MemID"/>
						<a href="javascript:void(0)" class="btn-entry" id="checkid">중복확인</a>
					</section>
				</section>
				<section>
					<h1 class="section-title required">비밀번호</h1>
					<section class="entry-section">
						<ul>
							<li><input type="password" placeholder="비밀번호 입력" name="MemPW" id="MemPW"/></li>
							<li><input type="password" placeholder="비밀번호 재입력" name="ReMemPW" id="ReMemPW"/></li>
						</ul>
						<ul class="explain-list">
							<li>비밀번호는 8 ~ 16자의 영문 대소문자, 숫자와 특수 문자를 조합하여 설정하십시오.</li>
							<li>안전을 위해 자주 사용했거나 쉬운 비밀번호가 아닌 새 비밀번호를 등록하고 주기적으로 변경하십시오.</li>
						</ul>
					</section>
				</section>
				<section>
					<h1 class="section-title required">성명</h1>
					<section class="entry-section">
						<input type="text" placeholder="회원명(공백 없이 입력하십시오)" name="MemName" id="MemName"/>
					</section>
				</section>
				<section>
					<h1 class="section-title required">생년월일</h1>
					<section class="entry-section">
						<input type="number" placeholder="예 : 840214" name="MemBirthDt" id="MemBirthDt"/>
					</section>
				</section>
				<section>
					<h1 class="section-title required">휴대전화</h1>
					<section class="entry-section">
						<ul>
							<li>
								<div class="select-layout">
									<a href="javascript:void(0)" class="trigger" id="MemPhone1">010</a>
									<ul class="list">
										<li><a href="javascript:void(0)" data-value="010">010</a></li>
										<li><a href="javascript:void(0)" data-value="011">011</a></li>
										<li><a href="javascript:void(0)" data-value="016">016</a></li>
										<li><a href="javascript:void(0)" data-value="017">017</a></li>
										<li><a href="javascript:void(0)" data-value="018">018</a></li>
										<li><a href="javascript:void(0)" data-value="019">019</a></li>
									</ul>
								</div>
								<input type="number" maxlength="4" name="MemPhone2" id="MemPhone2"/>
								<input type="number" maxlength="4" name="MemPhone3" id="MemPhone3"/>
							</li>
							<li class="has-btn">
								<input type="text" placeholder="3분 이내 입력" id="confirmNo_p">
                                <span class="count-time" id="confirmNo"></span>
								<a href="javascript:void(0)" class="btn-entry" id="confirmTo">인증번호 발송</a>
							</li>
						</ul>
					</section>
				</section>
				<section>
					<h1 class="section-title required">성별</h1>
					<section class="entry-section">
						<div class="assent">
							<label class="radio-label"><input type="radio" name="MemSex" /><span>남성</span></label>
							<label class="radio-label"><input type="radio" name="MemSex" /><span>여성</span></label>
						</div>
					</section>
				</section>
				<footer class="btn-group">
					<button type="reset" class="none">초기화</button>
					<a href="javascript:void(0)" id="btnInformNext" class="btn btn-empty btn-half">다음</a>
				</footer>
				</form>
			</section>
			<section id="done">
				<section class="well">
					<section class="panel panel-contents icon-after-keyhole">
						<span>회원가입을 환영합니다.</span>
						<small>이제 본 서비스의 모든 기능을 편리하게 이용하실 수 있습니다.</small>
					</section>
					<footer class="btn-group">
						<a href="index.html" id="btnDoneNext" class="btn">로그인으로 이동</a>
					</footer>
				</section>
			</section>
		</section>
	</article>
    
	<script type="text/javascript">
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
				fn.signUp.goToNextSlide();
				$('.btn-previous-page').remove();
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
					}else{
							warningBox("중복된 아이디 입니다. 다른 아이디를 입력하세요");
						return false;
					}
				},
				error: function(xhr, status, error) { alert(error); }
			});					
		});
		
		$("#confirmTo").click(function(){
			var phone1 = $.trim($("#MemPhone1").html());
			var phone2 = $.trim($("#MemPhone2").val());
			var phone3 = $.trim($("#MemPhone3").val());
			if(phone2.length < 3 || phone3.length < 3) {
					warningBox("핸드폰 번호를 정확하게 입력해 주세요");
					return false;
			}
			var phone = phone1+"-"+phone2+"-"+phone3;
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
					if($.trim(data) == "false") {
						warningBox("발송에 실패 했습니다. 잠시후에 다시 시도해 주세요");
						return false;
					}else{
						successBox(phone + "번호로 인증번호를 발송하였습니다. 3분이내에 입력해주세요");
						$(".count-time").show();
						$("#confirm_no").val(data);
						$("#confirmTo").html("인증번호 입력");
						$("#confirmTo").attr("id","sameconfirm");						
						countdown("confirmNo",0,5);
					}
				},
				error: function(xhr, status, error) { 
					$('#ajax_load').empty();
					alert(error); 
				}
			});				
			
			var phone = phone1+"-"+phone2+"-"+phone3;
		});
		$("#sameconfirm").click(function(){
			alert("비교");
		});
	</script>    
