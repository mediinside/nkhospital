<div class="subTop2">
    <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">{gtxt}</button>
            <ul class="list">
                <li><a href="/v3/center.php?depart=A&gubun=A" data-gubun="a">전문센터</a></li>
                <li><a href="/v3/center.php?depart=AB&gubun=B" data-gubun='b'>진료과</a></li>
                <li><a href="/v3/center.php?depart=A&gubun=C" data-gubun='c'>특수클리닉</a></li>
                <li><a href="/v3/doctor.php?depart=A&gubun=A" data-gubun='d'>의료진소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();">{stxt}</button>
            <ul class="list" style="z-index:9999999;">
               {?gubun=="A"}
               		<!--{@gpa}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=A">{.value_}</a></li>
                    <!--{/}-->
               {: gubun=="B"}
               		<!--{@gpb}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=B">{.value_}</a></li>
                    <!--{/}-->
               {: gubun=="C"}
               		<!--{@gpc}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=C">{.value_}</a></li>
                    <!--{/}-->
                {/}
               		<!--{@dlist}-->                        
	                    <li class="dlist" style="display:none;"><a href="/v3/detail.php?idx={.code}&gubun=D">{.name}</a></li>
                    <!--{/}-->                    
            </ul>
        </div>
    </nav>
</div>
<div class="section boardView">
    <div class="viewHead">
        <h2 class="title">{vtitle}{jbcdde}</h2>
        <p class="info">
            <span>{vttxt}</span>
            <span>{vdate}</span>
            <span>조회 {vsee}</span>
        </p>
    </div>
    <div class="contents">
    	{img_content}
        {vcontent}
        {vfile}{vcmt}
    </div>
    <div class="btnWrap">
        <span><a href="?gubun={gubun}&depart={depart}" class="btnType1">목록으로</a></span>
    </div>
</div>
<script>
	$(".contents").children("iframe").width('100%');
</script>