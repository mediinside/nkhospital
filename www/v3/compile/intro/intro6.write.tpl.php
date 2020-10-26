<?php /* Template_ 2.2.8 2019/06/18 10:06:02 /home/hosting_users/nkmed/www/v3/view/intro/intro6.write.tpl 000003071 */ ?>
<?php $this->print_("introtop",$TPL_SCP,1);?>

<h2 class="pageTitle collabo">의료협약문의</h2>
<div class="section">
    <h3 class="subTitle">의료협약 문의</h3>
    <form id="aForm" method="post" action="?">
    <table class="boardWrite">
        <caption>의료협약 문의 작성</caption>
        <tbody>
            <tr>
                <th scope="row">업체명<span class="essential">*</span></th>
                <td>
                    <input type="text" class="inputTxt" placeholder="필수입력" id="ag_hospital" name="ag_hospital">
                </td>
            </tr>
            <tr>
                <th scope="row">담당자명<span class="essential">*</span></th>
                <td>
                    <input type="text" class="inputTxt" placeholder="필수입력" id="ag_name" name="ag_name">
                </td>
            </tr>
            <tr>
                <th scope="row">연락처<span class="essential">*</span></th>
                <td>
                    <input type="tel" class="inputTxt" placeholder="필수입력" id="ag_mobile" name="ag_mobile">
                </td>
            </tr>
            <tr>
                <th scope="row">메일주소<span class="essential">*</span></th>
                <td>
                    <input type="text" class="inputTxt" placeholder="필수입력" id="ag_email" name="ag_email">
                </td>
            </tr>
            <tr>
                <th scope="row">홈페이지</th>
                <td>
                    <input type="text" class="inputTxt" placeholder="입력해주세요." id="ag_homepage" name="ag_homepage">
                </td>
            </tr>
            <tr>
                <th scope="row">협약문의<span class="essential">*</span></th>
                <td>
                    <textarea id="ag_content" cols="30" rows="10" placeholder="내용을 입력해주세요." name="ag_content"></textarea>
                </td>
            </tr>
        </tbody>
    </table>

    <p class="boardAlert">
        이메일, 전화 등 제출하신 수단을 통해 <br>
        뉴고려병원의 정보를 받는데 동의합니다.
    </p>
    
    <p class="boardAgree">
        <label><input type="checkbox" class="inputChk" id="agree"> 안내 사항을 확인하였으며, 정보제공에 동의합니다.</label>
    </p>
    
    <div class="btnWrap">
        <span><a href="/v3/intro.php?tab=intro6" class="btnType1">취소</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="intro_confirm">제출</a></span>
    </div>
    </form>
</div>
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alert_intro">
    <div class="cont">
        <p class="chkTxt">문의내용이 접수되었습니다.</p>
        <button type="button" class="btnType2" id="iconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->