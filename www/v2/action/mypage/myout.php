<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	if(!$_SESSION['suserid']) $C_Func->go_url("/v2/");
?>
    <h3 class="subTitle">회원탈퇴</h3>
        <input type="hidden" id="mb_code" value="<?=$_SESSION['susercode']?>"/>
    <div class="outReason">
        <label for="reason">탈퇴사유</label>
        <textarea id="reason" cols="30" rows="10" placeholder="탈퇴 사유를 간단하게 작성해주시면 감사하겠습니다." id="reason"></textarea>
    </div>
    <p class="outAlert">탈퇴 후에는 동일 아이디로 다시 가입할 수 없으며,<br>작성하신 게시글을 삭제 하실 수 없습니다. </p>
    <p class="outAgree">
        <label><input type="checkbox" class="inputChk" id="agreeok"> 안내 사항을 확인하였으며, 이에 동의합니다.</label>
    </p>
    <div class="btnWrap">
        <span><a href="#" class="btnType1">취소</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="oconfirm">탈퇴</a></span>
    </div>

