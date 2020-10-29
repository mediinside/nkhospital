<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	$tab = ($_REQUEST["tab"]) ? $_REQUEST["tab"] : "info1";
	switch($tab){
		case "info3"  : $ctxt="예약/발급";$ttxt = "증명서 발급안내"; break;
		case "info4"  : $ctxt="진료안내";$ttxt = "외래진료안내"; break;
		case "info5"  : $ctxt="진료안내";$ttxt = "응급진료안내"; break;
		case "info7"  : $ctxt="입/퇴원안내";$ttxt = "입/퇴원안내"; break;
		case "info8"  : $ctxt="입/퇴원안내";$ttxt = "입원생활안내"; break;
		case "info9"  : $ctxt="입/퇴원안내";$ttxt = "면회안내"; break;
		case "info10" : $ctxt="병원안내";$ttxt = "병원둘러보기"; break;		
		case "info11" : $ctxt="병원안내";$ttxt = "오시는길"; break;
		case "info12" : $ctxt="병원안내";$ttxt = "장례식장"; break;
		case "info13" : $ctxt="병원안내";$ttxt = "전화번호 안내"; break;	
		default : $ctxt="예약/발급";$ttxt = "진료예약"; break;	 			
	};
?>
<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<div class="subTop1">
    <p class="category"><strong>서비스이용안내</strong> 편리하고 빠른 병원이용을 안내합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();"><?=$ctxt?></button>
            <ul class="list">
                <li data-tab="depth1" data-spg="info3" data-stxt="증명서 발급안내"><a href="javascript:window.scrollTo(0,0);">예약/발급</a></li>
                <li data-tab="depth2" data-spg="info4" data-stxt="외래진료안내"><a href="javascript:window.scrollTo(0,0);">진료안내</a></li>
                <li data-tab="depth3" data-spg="info7" data-stxt="입/퇴원안내"><a href="javascript:window.scrollTo(0,0);">입/퇴원 안내</a></li>
                <li data-tab="depth4" data-spg="info10" data-stxt="병원둘러보기"><a href="javascript:window.scrollTo(0,0);">병원안내</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?=$ttxt?></button>
            <ul class="list" id="info_menu">
                <li data-tab="depth1" data-page="info1"><a href="javascript:window.scrollTo(0,0);">진료예약</a></li>
                <li data-tab="depth1" data-page="info2"><a href="javascript:window.scrollTo(0,0);">검진예약</a></li>
                <li data-tab="depth1" data-page="info3"><a href="javascript:window.scrollTo(0,0);">증명서발급 안내</a></li>
                <li data-tab="depth2" data-page="info4"><a href="javascript:window.scrollTo(0,0);">외래진료안내</a></li>
                <li data-tab="depth2" data-page="info5"><a href="javascript:window.scrollTo(0,0);">응급진료안내</a></li>
                <!--<li data-tab="depth2" data-page="info6"><a href="javascript:window.scrollTo(0,0);">비급여진료안내</a></li>-->
                <li data-tab="depth3" data-page="info7"><a href="javascript:window.scrollTo(0,0);">입/퇴원안내</a></li>
                <li data-tab="depth3" data-page="info8"><a href="javascript:window.scrollTo(0,0);">입원생활안내</a></li>
                <li data-tab="depth3" data-page="info9"><a href="javascript:window.scrollTo(0,0);">면회안내</a></li>
                <li data-tab="depth4" data-page="info10"><a href="javascript:window.scrollTo(0,0);">병원둘러보기</a></li>
                <li data-tab="depth4" data-page="info11"><a href="javascript:window.scrollTo(0,0);">오시는길/주차안내</a></li>
                <li data-tab="depth4" data-page="info12"><a href="javascript:window.scrollTo(0,0);">장례식장</a></li>
                <li data-tab="depth4" data-page="info13"><a href="javascript:window.scrollTo(0,0);">전화번호안내</a></li>
            </ul>
        </div>
    </nav>
</div>
<br />
<div id="result_info">
</div>
<br />
<script>
//$(window).load(function(){
	info_load("<?=$tab?>","tab=<?=$tab?>");
//});
</script>

