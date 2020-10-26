<?php /* Template_ 2.2.8 2019/06/13 14:32:54 /home/hosting_users/nkmed/www/v3/view/inc/intro.top.tpl 000001388 */ ?>
<div class="subTop3">
    <p class="category"><strong>뉴고려커뮤니티</strong> 더 가까이 더 낮은 자세로 더 많이 듣겠습니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">뉴고려소개</button>
            <ul class="list">
                <li><a href="/v3/board.php">소통/공감</a></li>
                <li><a href="javascript:void(0);">뉴고려소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?php echo $TPL_VAR["ttxt"]?></button>
            <ul class="list" id="intro_menu">
                <li><a href="?tab=intro1" data-page="intro1">소개영상</a></li>
                <li><a href="?tab=intro2" data-page="intro2">인사말</a></li>
                <li><a href="?tab=intro3" data-page="intro3">연혁</a></li>
                <li><a href="?tab=intro4" data-page="intro4">미션,비젼,가치</a></li>
                <li><a href="?tab=intro5" data-page="intro5">채용정보</a></li>
                <li><a href="?tab=intro6" data-page="intro6">협력병원 및 기관</a></li>
            </ul>
        </div>
    </nav>
</div>