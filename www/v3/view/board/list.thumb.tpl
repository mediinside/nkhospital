{#btop}
<div class="section">
	<!--{?schmenu=="Y"}-->
    <fieldset class="boardSearch">
        <legend>검색어 입력</legend>
        <div class="inputBox">
            <input type="text" class="inputTxt" id="bschtxt" placeholder="검색어를 입력하세요." value="{stext}">
			<button type="button" class="btnSearch" data-url="?code={jbcode}&sec={sec}">검색</button>
        </div>
		<!--{?submenu=="Y"}-->
        <div class="boardSort">
            <button type="button" class="btn" onclick="sortActive();">{mtxt}</button>
            <ul class="list" id="news_menu">
                <li><a href="?code=news"><button type="button" class="btnBtype" data-code="news">전체</button></a></li>
		<li><a href="?code=10"><button type="button" class="btnBtype" data-code="10">병원소식</button></a></li>
                <li><a href="?code=80"><button type="button" class="btnBtype" data-code="80">포토뉴스</button></a></li>
                <li><a href="?code=140"><button type="button" class="btnBtype" data-code="140">CH NK</button></a></li>
                <li><a href="?code=90"><button type="button" class="btnBtype" data-code="90">언론보도</button></a></li>
            </ul>
        </div>
        <!--{/}-->
	</fieldset>
	<!--{/}-->
		<ul class="boardThumb" id="list_result" data-total="{btotal}">
        <!--{@list}-->
			<li data-page='{.p}'{.style}>
            	{?.fread=="Y"}
	            	{?.secret=="N"}<a href="?code={jbcode}&bidx={.jb_idx}">{:}<a href="#" onclick="javascript:secret_check('{.jb_idx}')">{/}
                {:}
                <a href="javascript:void(0);" onclick="javascript:secret_false('작성회원만 글을 읽을 수 있습니다.')">
               	{/}
					<span class="thumb">
						{.img_src}
					</span>
					<span class="tit">{.title}</span>
					<span class="opt">
                        <!--{?jbcode!="50"}-->
                        <span class="source">{.bname}</span>
                        <!--{/}-->
                        <span class="date">{.regDt}</span>
					</span>
				</a>
			</li>
		<!--{/}-->
	  </ul>
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