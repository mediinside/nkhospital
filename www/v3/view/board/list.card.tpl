{#btop}
<div class="section"><h2 class="pageTitle letter">칭찬합시다</h2>
    <div class="btnWrap">
        {?board_yn=="Y"}<span><a href="?code={jbcode}&stext={stext}&sec={sec}&m=w"><button type="button" class="btnType4">칭찬합시다 (글작성)</button></a></span>{/}
    </div>
    <ul class="cardList" id="list_result" data-total="{btotal}">
	    <!--{@list}-->
        <li data-page='{.p}'{.style}>
            {?.fread=="Y"}
                {?.secret=="N"}<a href="?code={jbcode}&bidx={.jb_idx}">{:}<a href="#" onclick="javascript:secret_check('{.jb_idx}')">{/}
            {:}
            <a href="javascript:void(0);" onclick="javascript:secret_false('작성회원만 글을 읽을 수 있습니다.')">
            {/}
	            <span class="subject">[{.treat_type}] {.title}</span>
                <span class="txt">{.content}</span>					
                    <span class="opt">
                        <span class="date">{.regDt}</span>
                        <span class="name">{.jb_name}</span>
                    </span>
                </span>
            </a>
        </li>
        <!--{/}-->
	<div class="btnWrap"{mbtn}>
		<span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
	</div>
</div>    
<!-- 비밀번호 입력 레이어 -->
<div class="layerAlert" id="pwdlayer">
    <div class="cont">
        <p class="passTxt">비밀번호를 입력해주세요.</p>
        <input type="password" class="inputTxt" id="inpwd">
        <div class="btnWrap">
            <span><button type="button" class="btnType1" id="pcancel">취소</button></span>
            <span><button type="button" class="btnType2" id="pconfirm">확인</button></span>
        </div>
    </div>
</div>
<!-- //비밀번호 입력 레이어 -->    
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alertmsg">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="aconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 --> 