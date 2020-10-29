<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	if(!$_SESSION['suserid']) $C_Func->go_url("/v2/");
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();	
	$args["mb_code"] = $_SESSION['susercode'];
	$data = $C_Member->Mem_Info($args);
	extract($data);	
?>
    <fieldset>
        <legend>정보수정</legend>
        <h3 class="subTitle">
            회원정보 수정
            <span class="txt">
                <span class="essential">*</span> 수정불가
            </span>
        </h3>
        <table class="joinInputTable">
            <caption>회원가입 정보 수정</caption>
            <tbody>
                <tr>
                    <th scope="row">아이디<span class="essential">*</span></th>
                    <td>
                        <input type="text" class="inputTxt" readonly value="<?=$mb_id?>" id="mb_id">
                    </td>
                </tr>
                <tr>
                    <th scope="row">이름<span class="essential">*</span></th>
                    <td>
                        <input type="text" class="inputTxt" readonly value="<?=$mb_name?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">이메일</th>
                    <td class="btnOn">
                        <input type="text" class="inputTxt" value="<?=$mb_email?>" id="mb_email">
                        <button type="button" class="btnCom" id="mb_email_ch">수정</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">전화번호</th>
                    <td class="btnOn">
                        <input type="phone" class="inputTxt" value="<?=$mb_mobile?>" id="mb_mobile">
                        <button type="button" class="btnCom" id="mb_mobile_ch">수정</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 class="subTitle">비밀번호 변경</h3>
        <table class="joinInputTable">
            <caption>비밀번호 변경</caption>
            <tbody>
            	<input type="hidden" id="mb_code" value="<?=$mb_code?>"/>
                <tr>
                    <th scope="row">현재 비밀번호</th>
                    <td>
                        <input type="password" class="inputTxt" placeholder="현재 비밀번호 입력" id="mb_pwd">
                    </td>
                </tr>
                <tr>
                    <th scope="row">새 비밀번호</th>
                    <td>
                        <input type="password" class="inputTxt" placeholder="영문+숫자조합 6자이상" id="mb_pwd_ch">
                    </td>
                </tr>
                <tr>
                    <th scope="row">새 비밀번호 확인</th>
                    <td>
                        <input type="password" class="inputTxt" placeholder="새 비밀번호를 한번 더 입력해주세요" id="mb_pwd_ok">
                    </td>
                </tr>
            </tbody>
        </table>

    </fieldset>
    <div class="btnWrap">
        <span><a href="#" class="btnType1" id="pcancel">취소</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="pconfirm">변경</a></span>
    </div>
    <br />

