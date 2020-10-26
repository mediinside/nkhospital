<?php /* Template_ 2.2.8 2019/07/30 10:15:39 /nkmed/www/v3/view/find.tpl 000002134 */ ?>
<div class="section">
    <div class="tabMenu">
        <ul>
            <li class="active"><button type="button" onclick="tabActive(this);"><span>아이디 찾기</span></button></li>
            <li><button type="button" onclick="tabActive(this);"><span>비밀번호 찾기</span></button></li>
        </ul>
    </div>
    <div class="tabContents">
        <section class="tabCont active">
            <h2 class="pageTitle find"><span>ID</span></h2>
            <fieldset class="findWrap">
                <legend>가입 된 이름 이메일 입력</legend>
                <input type="text" class="inputTxt" placeholder="회원 이름을 입력해주세요." id="fi_name">
                <input type="text" class="inputTxt" placeholder="등록된 이메일을 입력해주세요." id="fi_email">
                <div class="btnWrap">
                    <span><a href="#" class="btnType2" id="find_id">아이디 찾기</a></span>
                </div>
            </fieldset>
        </section>
        <section class="tabCont">
            <h2 class="pageTitle find"><span>PW</span></h2>
            <fieldset class="findWrap">
                <legend>가입 된 이름 이메일 입력</legend>
                <input type="text" class="inputTxt" placeholder="아이디를 입력해주세요." id="fp_id">
                <input type="text" class="inputTxt" placeholder="등록된 이메일을 입력해주세요." id="fp_email">
                <div class="btnWrap">
                    <span><a href="#" class="btnType2" id="find_pw">비밀번호 찾기</a></span>
                </div>
            </fieldset>
        </section>
    </div>
</div>
<br>
<!-- 메일 알럿 레이어 -->
<div class="layerAlert" id="alert_find">
    <div class="cont">
        <p class="mailTxt"><span>woogawooga@naver.com</span>으로<br>비밀번호를 발송하였습니다.</p>
        <button type="button" class="btnType2" id="fconfirm">확인</button>
    </div>
</div>
<!-- //메일 알럿 레이어 -->