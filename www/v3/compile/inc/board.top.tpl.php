<?php /* Template_ 2.2.8 2020/10/26 06:02:56 C:\xampp\htdocs\newkorea\www\v3\view\inc\board.top.tpl 000001489 */ ?>
<script>
var psize = "<?php echo $TPL_VAR["psize"]?>";
</script>
<div class="subTop3">
    <p class="category"><strong>뉴고려커뮤니티</strong> 더 가까이 더 낮은 자세로 더 많이 듣겠습니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">소통/공감</button>
            <ul class="list">
                <li><a href="#">소통/공감</a></li>
                <li><a href="/v3/intro.php">뉴고려소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?php echo $TPL_VAR["ttxt"]?></button>
            <ul class="list">
                <li data-code="news" data-page="thumb"><a href="?code=news">뉴고려소식</a></li>
		<li data-code="50" data-page="thumb"><a href="?code=10">병원소식</a></li>
                <li data-code="50" data-page="thumb"><a href="?code=50">건강정보</a></li>
                <li data-code="40" data-page="list"><a href="?code=40">전문의상담</a></li>
                <li data-code="20" data-page="card"><a href="?code=20">칭찬합시다</a></li>
                <!-- <li data-code="120" data-page="list"><a href="?code=120">고객의 소리함</a></li> -->
            </ul>
        </div>
    </nav>
</div>