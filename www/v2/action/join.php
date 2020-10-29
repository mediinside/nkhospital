<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	if($_SESSION['suserid']) $C_Func->go_url("/v2/");
?>

    <h2 class="pageTitle join">회원가입<span>1/2</span></h2>
    <div class="section">
    	<form id="jForm" method="post" action="?">
            <section class="agreeSection">
                <h2 class="title">이용약관</h2>
                <div class="agreeTxtWrap">
                <? include_once '../../mypage/agree1.txt' ?>
                </div>
                <label>
                    <input type="checkbox" class="inputChk" name="use" data-msg="이용약관">
                    이용약관에 동의
                </label>
            </section>
            <section class="agreeSection">
                <h2 class="title">개인정보 처리방침 동의</h2>
                <div class="agreeTxtWrap">
                 <? include_once '../../mypage/agree2.txt' ?>
                </div>
                <label>
                    <input type="checkbox" class="inputChk" name="info" data-msg="개인정보 처리방침">
                    개인정보 취급방침에 동의
                </label>
            </section>
            <section class="agreeSection">
                <h2 class="title">고유식별정보 처리 동의</h2>
                <div class="agreeTxtWrap">
                <? include_once '../../mypage/agree3.txt' ?>
                </div>
                <label>
                    <input type="checkbox" class="inputChk" name="uni" data-msg="고유식별정보 처리">
                    고유식별정보 처리에 동의
                </label>
            </section>
        </form>
        <p class="agreeChk">
            <label><input type="checkbox" class="inputChk" id="chkall"> 모든 약관 및 취급 방침에 동의</label>
        </p>
        <div class="btnWrap">
            <span><a href="#" class="btnType1" id="join_next">다음 단계</a></span>
        </div>
    </div>
    <br />
