<?php /* Template_ 2.2.8 2020/10/28 11:07:49 D:\home\nkhospital\www\v3\view\join.step2.tpl 000003188 */ ?>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script type="text/javascript" src="/js/jquery.alphanumeric.js"></script>

    <h2 class="pageTitle join">회원가입<span>2/2</span></h2>
    <div class="section">
    <form action="?" id="frmJoin" name="frmJoin" method="post" novalidate>
        <input type="hidden" value="MEM_REG" id="mode" name="mode">
        <table class="joinInputTable">
            <caption>회원가입 정보 입력</caption>
            <tbody>
                <tr>
                    <th scope="row">아이디<span class="essential">*</span></th>
                    <td class="btnOn">
                        <input type="text" class="inputTxt" placheolder="영문 4자이상" id="mb_id" name="mb_id">
                        <button type="button" class="btnCom">중복확인</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">이름<span class="essential">*</span></th>
                    <td>
                        <input type="text" class="inputTxt" placheolder="입력해주세요." id="mb_name" name="mb_name">
                    </td>
                </tr>
                <tr>
                    <th scope="row">이메일<span class="essential">*</span></th>
                    <td>
                        <input type="text" class="inputTxt" placheolder="입력해주세요." id="mb_email" name="mb_email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">비밀번호<span class="essential">*</span></th>
                    <td>
                        <input type="password" class="inputTxt" placheolder="영문+숫자조합 6자 이상" id="mb_pwd" name="mb_pwd">
                    </td>
                </tr>
                <tr>
                    <th scope="row">비밀번호 확인<span class="essential">*</span></th>
                    <td>
                        <input type="password" class="inputTxt" placheolder="입력해주세요." id="mb_pwd_ok" name="mb_pwd_ok">
                    </td>
                </tr>
                <tr>
                    <th scope="row">휴대전화<span class="essential">*</span></th>
                    <td>
                        <input type="tel" class="inputTxt" placheolder="숫자만 입력해주세요." id="mb_mobile" name="mb_mobile">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btnWrap">
            <span><a href="http://nkhospital.net/v3/join.php" class="btnType1">취소</a></span>
            <span><a href="#" class="btnType2" id="btn_submit">회원가입</a></span>
        </div>
    </form>                
    </div>
<br />
<!-- 알럿 레이어 -->
<div class="layerAlert">
    <div class="cont">
        <p class="alertTxt">이미 사용중인 아이디입니다.</p>
        <button type="button" class="btnType2" id="closed">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->