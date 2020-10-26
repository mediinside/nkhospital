<?php /* Template_ 2.2.8 2020/08/24 11:27:24 /home/hosting_users/nkmed/www/v3/view/join.tpl 000001866 */ ?>
<h2 class="pageTitle join">회원가입<span>1/2</span></h2>
<div class="section">
    <form id="jForm" method="post" action="?">
        <section class="agreeSection">
            <h2 class="title">이용약관</h2>
            <div class="agreeTxtWrap">
            <?php include_once '../mypage/agree1.txt' ?>
            </div>
            <label>
                <input type="checkbox" class="inputChk" name="use" data-msg="이용약관" value="Y">
                이용약관에 동의
            </label>
        </section>
        <section class="agreeSection">
            <h2 class="title">개인정보 처리방침 동의</h2>
            <div class="agreeTxtWrap">
             <? include_once '../mypage/agree2.txt' ?>
            </div>
            <label>
                <input type="checkbox" class="inputChk" name="info" data-msg="개인정보 처리방침" value="Y">
                개인정보 취급방침에 동의
            </label>
        </section>
        <section class="agreeSection">
            <h2 class="title">고유식별정보 처리 동의</h2>
            <div class="agreeTxtWrap">
            <? include_once '../mypage/agree3.txt' ?>
            </div>
            <label>
                <input type="checkbox" class="inputChk" name="uni" data-msg="고유식별정보 처리" value="Y">
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