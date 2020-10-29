<?php /* Template_ 2.2.7 2016/09/01 08:05:19 /home/hosting_users/nkmed/www/rev_template/view/online/result.tpl 000002468 */ ?>
<header id="header">
		<h1 class="page-title">예약정보확인</h1>
		<a href="/online/reserve/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
<?php $this->print_("menu",$TPL_SCP,1);?>

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
								<dd><?php echo $TPL_VAR["r_name"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>휴대전화</dt>
								<dd><?php echo $TPL_VAR["r_phone"]?></dd>
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
								<dd><?php echo $TPL_VAR["p_name"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>생년월일</dt>
								<dd><?php echo $TPL_VAR["p_birth"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>성별</dt>
								<dd><?php echo $TPL_VAR["p_sex"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>진료과</dt>
								<dd><?php echo $TPL_VAR["r_tcode"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>의료진</dt>
								<dd><?php echo $TPL_VAR["r_dr_name"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>예약일시</dt>
								<dd><?php echo $TPL_VAR["p_revDt"]?></dd>
							</dl>
						</li>
						<li>
							<dl class="data-attr">
								<dt>연락처</dt>
								<dd><?php echo $TPL_VAR["p_phone"]?></dd>
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