<header id="header">
		<h1 class="page-title">예약확인</h1>
		<a href="/online/rev_list/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
			{#menu}
		</nav>
	</header>
	<article id="container">
    {@list}
		<header class="explain-text header"><strong>{.regDt}</strong>에 예약하신 예약정보입니다.</header>
		<section>
        	
			<h1 class="section-title">예약자 정보</h1>
			<section class="well">
				<section class="panel">
					<ul class="dotted-list">
						<li>
							<dl class="data-attr">
								<dt>성명</dt>
								<dd>{.r_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>휴대전화</dt>
								<dd>{.r_phone}</dd>
							</dl>
						</li>
					</ul>
				</section>
			</section>
		</section><section>
			<h1 class="section-title">환자 정보</h1>
			<section class="well">
				<section class="panel">
					<ul class="dotted-list">
						<li>
							<dl class="data-attr">
								<dt>성명</dt>
								<dd>{.p_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>생년월일</dt>
								<dd>{.p_birth}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>성별</dt>
								<dd>{.p_sex}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>진료과</dt>
								<dd>{.r_tcode}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>의료진</dt>
								<dd>{.r_dr_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>예약일시</dt>
								<dd>{.r_date} {.r_time_txt} {.r_time}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>연락처</dt>
								<dd>{.p_phone}</dd>
							</dl>
						</li>
					</ul>
				</section>
			</section>
		</section>
		<footer class="btn-group">
			<a href="/online/rev_list/" class="btn">확인</a>
			<a href="#" class="btn btn-empty" onClick="rev_cancel('{.rv_no}')">예약취소</a>
		</footer>
    {/}
	</article>
    
<script language="javascript">
function rev_cancel(rv_no){
	modal({
		type: 'confirm',
		title: 'Confirm',
		text: '예약을 취소하시겠습니까?',
		callback: function(result) {
			if(result == true) {
				$.ajax({
					type: "POST",
					url: "/con/action/reserve_action/",
					data: "mode=del&rv_no="+rv_no,
					dataType: "text",
					beforeSend: function() {
						//wrapWindowByMask();
						$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
					},  			
					success: function(data) {
						$('#ajax_load').empty();
						successBox("삭제 되었습니다.");
					},
					error: function(xhr, status, error) { alert(error); }
				});	    
			}
		}
	});
}
</script>	