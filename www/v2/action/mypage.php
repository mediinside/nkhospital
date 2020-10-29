<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	if(!$_SESSION['suserid']) $C_Func->go_url("/v2/");
	$pg = ($_REUQEST["pg"]) ? ($_REUQEST["pg"]) : "mypage";
?>
<h2 class="pageTitle mypage">마이페이지</h2>

<div class="section">
    <div class="tabMenu">
        <ul>
            <li class="active" data-pg="mypage"><a href="#"><span>정보수정</span></a></li>
            <li data-pg="mylist"><a href="#"><span>내글목록</span></a></li>
            <li data-pg="myout"><a href="#"><span>회원탈퇴</span></a></li>
        </ul>
    </div>
    <div id="mypage_result">
    </div>
</div>

<!-- 알럿 레이어 -->
<div class="layerAlert" id="alert_mypage">
    <div class="cont">
        <p class="chkTxt">회원정보가 변경되었습니다.</p>
        <button type="button" class="btnType2" id="mconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->
<script>
	mypage_load('<?=$pg?>','');
</script>