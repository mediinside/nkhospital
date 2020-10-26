{#introtop}
<div class="section">
    <h2 class="pageTitle recruit">채용정보</h2>
    <div class="btnWrap">
        <!-- <span><a href="/bbs/download.php?downview=0&file=<?=$_SERVER['DOCUMENT_ROOT']?>/file/job_application.hwp&name=뉴고려입사지원서.hwp"><button type="button" class="btnType2">입사지원서 내려받기</button></a></span> -->
    </div>
    <ul class="cardList typeRecruit">
	    <!--{@list}-->
		 <li data-page='{.p}'{.style}>
           <a href="?code=100&tab=intro5&idx={.jb_idx}">
                <span class="subject">{.title}</span>
                <span class="txt">{.content}</span>
                <span class="opt">
                    <span class="date">{.regDt}</span>
                </span>
            </a>
        </li>
        <!--{/}-->
    </ul>
    <div class="btnWrap">
        <span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
    </div>
    <br />
</div>
<!-- 비밀번호 입력 레이어 -->
<div class="layerAlert">
    <div class="cont">
        <p class="passTxt">비밀번호를 입력해주세요.</p>
        <input type="password" class="inputTxt">
        <div class="btnWrap">
            <span><button type="button" class="btnType1">삭제</button></span>
            <span><button type="button" class="btnType2">수정</button></span>
        </div>
    </div>
</div>
<!-- //비밀번호 입력 레이어 -->

<!-- 알럿 레이어 -->
<div class="layerAlert">
    <div class="cont">
        <p class="chkTxt">게시글이 삭제되었습니다.</p>
        <button type="button" class="btnType2">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->

<script>
var jbcode = "100";
var psize   = "2";
</script>