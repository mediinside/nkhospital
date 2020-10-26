{#mymenu}
    <h3 class="subTitle">전문의 상담</h3>
    <ul class="boardList">
    	<!--{@list1}-->
		<li>
             <a href="/v3/board.php?code=40&bidx={.idx}">
                <span class="subject">[{.ttype}] {.title}</span>
                <span class="opt">
                    <span class="date">{.regdt}</span>
                    <span class="name">{.name}</span>
                </span>
                {.comtxt}
            </a>
        </li>
		<!--{:}-->
		<li class="nonList">작성하신 글이 없습니다.</li>
		<!--{/}-->
    </ul>

    <h3 class="subTitle">고객의 소리</h3>
    <ul class="boardList">
    	<!--{@list2}-->
		<li>
             <a href="/v3/board.php?code=40&bidx={.idx}">
                <span class="subject">[{.ttype}] {.title}</span>
                <span class="opt">
                    <span class="date">{.regdt}</span>
                    <span class="name">{.name}</span>
                </span>
            </a>
        </li>
		<!--{:}-->
		<li class="nonList">작성하신 글이 없습니다.</li>
		<!--{/}-->
    </ul>
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alert_mypage">
    <div class="cont">
        <p class="chkTxt">회원정보가 변경되었습니다.</p>
        <button type="button" class="btnType2" id="mconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->