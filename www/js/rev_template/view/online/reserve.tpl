	<header id="header">
		<h1 class="page-title">{?rev_no == "0"}비회원 이용하기{:}예약하기{/}</h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt none"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
			{#menu}
		</nav>
	</header>
	<article id="container">
		<section class="well">
			<h1 class="none">예약 메뉴</h1>
			<ul class="reservation-menu-list">
				<li>
					<a href="/online/step1/" class="panel panel-contents icon-after-calendar">
						<small>{?rev_no == "0"}비회원{:}초진 / 재진{/}</small>
						<span>예약하기</span>
					</a>
				</li>
				<li>
					<a href="/online/rev_list/" class="panel panel-contents icon-after-document">
						<small>{?rev_no == "0"}비회원{:}예약확인 및{/}</small>
						<span>{?rev_no == "0"}예약확인{:}예약내역보기{/}</span>
					</a>
				</li>
			</ul>
		</section>
	</article>