<header id="header">
		<h1 class="page-title">예약정보확인</h1>
		<a href="/online/reserve/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
						{#menu}
		</nav>
	</header>
	<article id="container">
		<header class="explain-text header">예약이 완료되었습니다.</header>
		<section>
			<h1 class="section-title">예약자 정보</h1>
			<section class="well">
				<section class="panel">
					<ul class="dotted-list">
						<li>
							<dl class="data-attr">
								<dt>성명</dt>
								<dd>{r_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>휴대전화</dt>
								<dd>{r_phone}</dd>
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
								<dd>{p_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>생년월일</dt>
								<dd>{p_birth}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>성별</dt>
								<dd>{p_sex}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>진료과</dt>
								<dd>{r_tcode}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>의료진</dt>
								<dd>{r_dr_name}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>예약일시</dt>
								<dd>{p_revDt}</dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>연락처</dt>
								<dd>{p_phone}</dd>
							</dl>
						</li>
					</ul>
				</section>
			</section>
		</section>
		<footer class="btn-group">
			<a href="/online/reserve/" class="btn btn-half">확인</a>
		</footer>
	</article>