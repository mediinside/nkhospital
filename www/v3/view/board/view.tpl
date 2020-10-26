{#btop}
<br>
<div class="section boardView">
    <div class="viewHead">
        <h2 class="title">{vtitle}{jbcdde}</h2>
        <p class="info" style="color:#666666">
            <span>{vttxt}</span>
            <span>{vdate}</span>
            <span>조회 {vsee}</span>
        </p>
    </div>
    <div class="contents">
        {vcontent}
        {vfile}{vcmt}
    </div>
    <div class="btnWrap">
        <span><a href="?code={jbcode}&stext={stext}" class="btnType1">목록으로</a></span>
    </div>
</div>
<script>
	$(".contents").children("iframe").width('100%');
</script>