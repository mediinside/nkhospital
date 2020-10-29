<header id="header">
		<h1 class="page-title">예약정보확인</h1>
		<a href="/online/reserve/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
			{#menu}
		</nav>
	</header>
	<article id="container">
      {@list_n}
		<header class="explain-text header"><strong>{.regDt}</strong>에 예약하신 예약정보입니다.</header>
		<section>
			<h1 class="section-title">최근 예약</h1>
			<section class="well">
	          
				<a href="/online/rev_list/rv_no={.rv_no}" class="reserv-info">
					<!-- <div class="company-logo"><img src="" alt="" class="block" /></div> -->
                    <ul>
                        <li class="date">{.regDt}</li>
                        <li class="people">
                            <small>환자</small>
                            <strong>{.p_name}</strong>
                        </li>
                        <li class="people">
                            <small>예약자</small>
                            <strong>{.r_name}</strong>
                        </li>
                        <li class="doctor">
                            <strong>{.dr_name}</strong>
                            <small>전문의</small>
                            <span class="category">{.t_code_name}</span>
                        </li>
                    </ul>
				</a>
                
			</section>
		</section>
        {:}
        <section>
        <h1 class="section-title">최근 예약</h1>
			<section class="well">
            	예약하신 내역이 없습니다.
            </section>
        </section>
        {/}
		<section>
			<h1 class="section-title">예약 내역</h1>
			<section class="well">
				<ul class="reserv-list">
                	{@list}
					<li class="reserv-info">
						<!-- <div class="company-logo"><img src="" alt="" class="block" /></div> -->
						<ul>
							<li class="date">{.regDt}</li>
							<li class="people">
								<small>환자</small>
								<strong>{.p_name}</strong>
							</li>
							<li class="people">
								<small>예약자</small>
								<strong>{.r_name}</strong>
							</li>
							<li class="doctor">
								<strong>{.dr_name}</strong>
								<small>전문의</small>
								<span class="category">{.t_code_name}</span>
							</li>
						</ul>
					</li>
                    {:}
                    	예약하신 내역이 없습니다.
                    {/}
				</ul>
			</section>
			<footer class="pagination">
            {?prevblock}<a href="javascript:void(0)" class="btn-prev">&lt;</a>{/}
                {link} {?nextblock}<a href="javascript:void(0)" class="btn-next">&gt;</a>{/}
			</footer>
		</section>
		<footer class="btn-group">
			<a href="/online/reserve/" class="btn btn-half">확인</a>
		</footer>
	</article>