	<header id="header">
		<h1 class="page-title">환자정보/진료과</h1>
		<a href="/online/step1/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
						{#menu}
		</nav>
	</header>
	<article id="container">
	<form id="pForm" method="post" name="pForm">
	    <input type="hidden" id="r_phone" name="r_phone" value="{r_phone}" />
	    <input type="hidden" id="r_name" name="r_name" value="{r_name}" />
	    <input type="hidden" id="r_birth" name="r_birth" value="{r_birth}" />
	    <input type="hidden" id="r_sex" name="r_sex" value="{r_sex}" />
        <input type="hidden" id="p_phone" name="p_phone" value="" />
        <input type="hidden" id="t_code" name="t_code" value="" />  
        <input type="hidden" id="t_code_name" name="t_code_name" value="" />                    
		<section>
			<h1 class="section-title">patient</h1>
			<label class="entry-assent check-label">
                <input type="checkbox" id="same_member"/><span>예약정보와 동일</span>
			</label>
			<section class="entry-section">
				<ul>
					<li><input type="text" placeholder="환자명" name="p_name" id="p_name"/></li>
					<li><input type="number" placeholder="생년월일 (YYMMDD)" name="p_birth" id="p_birth"/></li>
					<li>
						<div class="assent">
							<label class="radio-label"><input type="radio" name="p_sex" id="M" value="M"/><span>남성</span></label>
							<label class="radio-label"><input type="radio" name="p_sex" id="F" value="F"/><span>여성</span></label>
						</div>
					</li>
					<li>
						<div class="select-layout">
							<a href="javascript:void(0)" class="trigger" id="p_phone1" data-value="010">010</a>
							<ul class="list">
								<li><a href="javascript:void(0)" data-value="010">010</a></li>
								<li><a href="javascript:void(0)" data-value="011">011</a></li>
								<li><a href="javascript:void(0)" data-value="016">016</a></li>
								<li><a href="javascript:void(0)" data-value="017">017</a></li>
								<li><a href="javascript:void(0)" data-value="018">018</a></li>
								<li><a href="javascript:void(0)" data-value="019">019</a></li>
							</ul>
						</div>
						<input type="number" id="p_phone2" name="p_phone2"/>
						<input type="number" id="p_phone3" name="p_phone3"/>
					</li>
				</ul>
			</section>
		</section>
		<section>
			<h1 class="section-title">category</h1>
			<section class="entry-field">
				<div class="select-layout inner">
					<a href="javascript:void(0)" class="trigger" id="p_treat"  data-value="">진료과목을 선택하세요</a>
					<ul class="list">
						{select_treat}
					</ul>
				</div>
			</section>
		</section>
		<footer class="btn-group">
			<a href="#" class="btn" id="btn_confirm2">확인</a>
			<a href="/online/main/" class="btn btn-empty">취소</a>
		</footer>
		</form>    
	</article>
<script type="text/javascript" src="/path/js/step.min.js"></script>       
<script language="javascript">
	$("#same_member").click(function(){
		if($("#same_member").is(":checked") == true) {
			$("#p_name").val("{p_name}");
			$("#p_birth").val("{r_birth}");
			$("#p_phone1").html("{p_phone1}");
			$("#p_phone2").val("{p_phone2}");
			$("#p_phone3").val("{p_phone3}");
			$("#{r_sex}").prop("checked",true);			
		}else{
			$("#p_name").val("");
			$("#p_birth").val("");
			$("#p_phone1").html("010");
			$("#p_phone2").val("");
			$("#p_phone3").val("");
			$("#{r_sex}").prop("checked",false);				
		}
	});
</script>