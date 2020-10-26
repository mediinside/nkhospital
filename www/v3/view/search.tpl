<div class="resultTop">
    <button type="button" class="btnBack" onclick="history.back();">뒤로</button>
    <fieldset class="search">
        <legend>검색어 입력</legend>
        <input type="text" class="inputTxt" placeholder="입력해 주세요." value="{stext}" id="sschtxt">
        <button class="btn" id="sschbtn">검색</button>
    </fieldset>
</div>
<!--{?!list1 && !list2 && !list3}-->
    <div class="section">
        <p class="noResult">
            <span>“{stext}”</span>
            의 검색결과가 없습니다.
        </p>
        <p class="searchChk">
            단어의 철자가 정확한지 확인해 보세요.<br>
            한글을 영어로 입력했는지 확인해 보세요.<br>
            두 단어 이상의 검색인 경우, 띄어쓰기를 확인해 보세요.
        </p>
    </div>
<!--{:}-->
<div class="searchResult">
	<!--{?list1}-->
    <div class="section">
        <h3 class="subTitle">관련영상 <span class="sub">({vcnt}건)</span></h3>
        <ul class="boardThumb" id="video_result" data-total="{vcnt}">
			<!--{@list1}-->
            <li data-page='{.p}' {.style}>
                <a href="javascript:void(0);">
                    <span class="thumb">
                    	<div id="play{.vd_idx}">
	                        {.you_link}
                        </div>
                        <div class="vlayer" id="layer{.vd_idx}">
                            {.thumb}
                            <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart" data-vid="{.vd_uid}" data-lid="layer{.vd_idx}" data-pid="play{.vd_idx}">
                        </div>
                    </span>
                    <span class="tit">{.title}</span>
                        <a href="/v3/detail.php?idx={.dr_idx}&gubun=D">
                        <span class="doc">
                            {.dr_face_img}
                            <span class="name">{.dr_name}</span>
                            <span class="cate">{.treat}</span>
                        </span>
                    </a>
                </a>
            </li>
            <!--{/}-->
        </ul>
        <div class="btnWrap"{vmbtn}>
            <span><a href="javascript:void(0);" class="btnType1" id="vmore">더보기</a></span>
        </div>
    </div>
	<!--{/}-->
	<!--{?list2}-->
    <div class="section">
        <h3 class="subTitle">의료진 <span class="sub">({dcnt}건)</span></h3>
        <ul class="docList2" id="doctor_result" data-total="{dcnt}">
			<!--{@list2}-->
            <li data-page='{.p}' {.style}>
                <a href="/v3/detail.php?idx={.dr_idx}&gubun=D">
                    <span class="pic">{.dr_img}</span>
                    <span class="name"><span>{.treat}</span> {.dr_name} {.dr_ps}</span>
                    <span class="cate">{.dr_treat}</span>
                </a>
            </li>
            <!--{/}-->
        </ul>
        <div class="btnWrap"{dmbtn}>
            <span><a href="javascript:void(0);" class="btnType1" id="dmore">더보기</a></span>
        </div>
    </div>
	<!--{/}-->
	<!--{?list3}-->
    <div class="section">
        <h3 class="subTitle">커뮤니티 <span class="sub">({bcnt}건)</span></h3>
        <ul class="boardThumb" id="board_result" data-total="{bcnt}">
			<!--{@list3}-->        
            <li data-page='{.p}' {.style}>
                <a href="/v3/board.php?code={.jb_code}&bidx={.jb_idx}">
                    <span class="thumb">
                        {.img_src}
                    </span>
                    <span class="tit">{.title}</span>
                    <span class="opt">
                        <span class="source">{.bname}</span>
                        <span class="date">{.regDt}</span>
                    </span>
                </a>
            </li>
            <!--{/}-->
        </ul>
        <div class="btnWrap"{bmbtn}>
            <span><a href="javascript:void(0);" class="btnType1" id="bmore">더보기</a></span>
        </div>
    </div>
	<!--{/}-->
</div>
<!--{/}-->
<script language="javascript">
var psize = "{psize}";
</script>