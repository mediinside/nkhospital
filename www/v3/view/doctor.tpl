<div class="subTop2">
    <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">의료진소개</button>
            <ul class="list">
                <li><a href="/v3/center.php?depart=A&gubun=A" data-gubun="a">전문센터</a></li>
                <li><a href="/v3/center.php?depart=AB&gubun=B" data-gubun='b'>진료과</a></li>
                <li><a href="/v3/center.php?depart=A&gubun=C" data-gubun='c'>특수클리닉</a></li>
                <li><a href="/v3/doctor.php?depart=A&gubun=A" data-gubun='d'>의료진소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();">선택해주세요</button>
            <ul class="list" style="z-index:9999999;">
               		<!--{@dlist}-->    
	                    <li class="dlist"><a href="/v3/detail.php?idx={.code}&gubun=D">{.name}</a></li>
                    <!--{/}-->                    
            </ul>
        </div>
    </nav>
</div>
 <div id="result_doctor">
    <br />
        <div class="section">
            <div class="tabMenu" id="tab_menu1">
                <ul>
                    <li data-gubun="a"{?gubun=="A"} class="active"{/}><a href="/v3/doctor.php?depart=A&gubun=A"><span>전문센터</span></a></li>
                    <li data-gubun="b"{?gubun=="B"} class="active"{/}><a href="/v3/doctor.php?depart=A&gubun=B"><span>진료과</span></a></li>
                    <li data-gubun="c"{?gubun=="C"} class="active"{/}><a href="/v3/doctor.php?depart=A&gubun=C"><span>특수클리닉</span></a></li>
                </ul>
            </div>
            <div class="boardSort">
                <button type="button" class="btn" onclick="sortActive();">선택해주세요</button>
                <ul class="list">
                   {?gubun=="A"}
                        <!--{@gpa}-->
	                        <li data-depart='{.key_}'><button type="button">{.value_}</button></li>
                        <!--{/}-->
                   {: gubun=="B"}
                        <!--{@gpb}-->
	                        <li data-depart='{.key_}'><button type="button">{.value_}</button></li>
                        <!--{/}-->
                   {: gubun=="C"}
                        <!--{@gpc}-->
	                        <li data-depart='{.key_}'><button type="button">{.value_}</button></li>
                        <!--{/}-->
                    {/}
                </ul>
            </div>
			<!--{@list}-->
                   <section class="docList" data-depart="{.depart}">
					<h3 class="subTitle">{.name}</h3>
					<ul class="list">
                    	<!--{@ data}-->
						<li data-idx='{data.dr_idx}' data-name='{data.drname}'>
							<a href="/v3/detail.php?idx={data.dr_idx}&gubun=D">
								<span class="pic">
									<img src="{data.dr_img}" alt="">
									<i></i>
								</span>
								<span class="name">
									<b>{data.drname}</b> {data.dr_ps}
								</span>
							</a>
						</li>
                        <!--{/}-->
					</ul>
					<a href="/v3/center.php?depart={.depart}&gubun={gubun}" class="link"> 바로가기</a>
				</section>
			<!--{/}-->
        </div>
	</div>