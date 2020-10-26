{#btop}
<div class="section">
	<!--{?schmenu=="Y"}-->
    <fieldset class="boardSearch">
        <legend>검색어 입력</legend>
        <div class="inputBox">
            <input type="text" class="inputTxt" id="bschtxt" placeholder="검색어를 입력하세요." value="{stext}">
            <button type="button" class="btnSearch" data-url="?code={jbcode}&sec={sec}">검색</button>
        </div>
    </fieldset>
<!--{/}-->
	<!--{?jbcode=="40"}-->
    <div class="btnWrap">
        {?board_yn=="Y"}<span><a href="?code={jbcode}&stext={stext}&sec={sec}&m=w" class="btnType2">전문의 상담하기</a></span>{/}
    </div>
    <h3 class="subTitle">상담목록
        <label class="chk">
            <span>공개글만</span>
            <input type="checkbox" class="inputChk" value="Y" {?sec=="N"}checked="checked"{/} data-code='{jbcode}'>
        </label>
    </h3>
    <!--{: jbcode == "120"}-->
    <div class="btnWrap">
        <span><a href="?code={jbcode}&stext={stext}&sec={sec}&m=w" class="btnType2">작성하기</a></span>
    </div>
    <h3 class="subTitle">고객의 소리함</h3>
    <!--{/}-->
	<ul class="boardList" id="list_result" data-total="{btotal}">
    	 <!--{@list}-->
        <li data-page='{.p}'{.style}>
            {?.fread=="Y"}
                {?.secret=="N"}<a href="?code={jbcode}&bidx={.jb_idx}">{:}<a href="#" onclick="javascript:secret_check('{.jb_idx}')">{/}
            {:}
            <a href="javascript:void(0);" onclick="javascript:secret_false('작성회원만 글을 읽을 수 있습니다.')">
            {/}
            <span class="subject">[{.treat_type}] {.title}</span>
                <span class="opt">
                    <span class="date">{.regDt}</span>
                    <span class="name">{.jb_name}</span>
                    {.sec}
                </span>
            	{.answer}
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