<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	$tab = ($_REQUEST["tab"]) ? $_REQUEST["tab"] : "intro1";
	switch($tab){
		case "intro1" : $ttxt = "소개영상"; break;
		case "intro2" : $ttxt = "인사말"; break;
		case "intro3" : $ttxt = "연혁"; break;
		case "intro4" : $ttxt = "미션,비젼,가치"; break;
		case "intro5" : $ttxt = "채용정보"; break;
		case "intro6" : $ttxt = "협력병원 및 기관"; break;
	};
?>
<div class="subTop3">
    <p class="category"><strong>뉴고려커뮤니티</strong> 더 가까이 더 낮은 자세로 더 많이 듣겠습니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">뉴고려소개</button>
            <ul class="list">
                <li><a href="#" onClick="javascript:page_load('board','');">소통/공감</a></li>
                <li><a href="#">뉴고려소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?=$ttxt?></button>
            <ul class="list" id="intro_menu">
                <li><a href="#" data-page="intro1">소개영상</a></li>
                <li><a href="#" data-page="intro2">인사말</a></li>
                <li><a href="#" data-page="intro3">연혁</a></li>
                <li><a href="#" data-page="intro4">미션,비젼,가치</a></li>
                <li><a href="#" data-page="intro5">채용정보</a></li>
                <li><a href="#" data-page="intro6">협력병원 및 기관</a></li>
            </ul>
        </div>
    </nav>
</div>
<div id="result_intro">
<script>
intro_load("<?=$tab?>","tab=<?=$tab?>");
</script>
</div>
<br />
