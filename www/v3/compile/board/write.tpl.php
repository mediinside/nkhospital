<?php /* Template_ 2.2.8 2019/07/02 15:13:16 /nkmed/www/v3/view/board/write.tpl 000005576 */ 
$TPL_menu_1=empty($TPL_VAR["menu"])||!is_array($TPL_VAR["menu"])?0:count($TPL_VAR["menu"]);?>
<?php $this->print_("btop",$TPL_SCP,1);?>

<h2 class="pageTitle write">{ttxt|</h2>
<div class="section">
<form id="bform" name="bform" method="post" enctype="multipart/form-data">
    <input type="hidden" name="jb_code" value="<?php echo $TPL_VAR["jbcode"]?>" />
    <input type="hidden" name="jb_secret_check" value="<?php echo $TPL_VAR["secret"]?>" />    
    <input type="hidden" name="mode" value="<?php echo $TPL_VAR["mode"]?>" />    
        <table class="boardWrite">
            <caption>전문의 상담 작성</caption>
                <tbody>
<?php if($TPL_VAR["jbcode"]=="40"){?>
                    <tr>
                        <th scope="row">진료과목<span class="essential">*</span></th>
                        <td>
                            <span class="formRow">
                                <span class="cell">
                                    <select name="jb_tgubun" id="jb_tgubun">
                                        <option value="a" <?php if($TPL_VAR["jb_tgubun"]=="a"){?>selected<?php }?>>전문센터</option>
                                        <option value="b" <?php if($TPL_VAR["jb_tgubun"]=="b"){?>selected<?php }?>>진료과</option>
                                        <option value="c" <?php if($TPL_VAR["jb_tgubun"]=="c"){?>selected<?php }?>>특수클리닉</option>
                                    </select>
                                </span>
                                <span class="cell">
                                    <select name="jb_treat" id="jb_treat">
<?php if($TPL_menu_1){foreach($TPL_VAR["menu"] as $TPL_K1=>$TPL_V1){?>
                                            <option value="<?php echo $TPL_K1?>" <?php if($TPL_VAR["jb_treat"]==$TPL_K1){?>selected<?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
                                    </select>
                                </span>
                            </span>
                        </td>
                    </tr>
<?php }?>
                    <tr>
                        <th scope="row">제목<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_title" id="jb_title" value="<?php echo $TPL_VAR["jb_title"]?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">작성자<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_name" id="jb_name" value="<?php echo $TPL_VAR["mb_name"]?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">내용<span class="essential">*</span></th>
                        <td>
                            <textarea name="jb_content" id="jb_content" cols="30" rows="10" placeholder="- 노출 우려가 있는 개인정보는 기재하지 마세요.
 게시판 의도와 상관없는 글은 사전 동의없이 삭제됩니다."><?php echo $TPL_VAR["content"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="inputFile">
                                <label class="btnFileUpload">
                                    <input type="file" title="파일첨부" name="jb_file[]" onchange="fileUpload(this);">
                                    <span class="btn">파일첨부</span>
                                </label>
                                <input type="text" class="inputTxt" readonly>
                                <button type="button" class="btnDel" onclick="fileValDel(this);">삭제</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">비밀번호<span class="essential">*</span></th>
                        <td>
                            <input type="password" class="inputTxt" placeholder="4자리 이상" name="jb_password" id="jb_password" value="<?php echo $TPL_VAR["jb_password"]?>">
                        </td>
                    </tr>
                </tbody>
        </table>
</form>
    <p class="boardAlert">
        답변이 달린 이후엔 공개글로 전환되어<br>
        게시글의 수정 및 삭제를 하실 수 없습니다.
    </p>
    
    <div class="btnWrap">
        <span><a href="#" class="btnType1" onclick="javascript:history.back();">취소/목록</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="board_write">작성완료</a></span>
    </div>
</div>
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alertmsg">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="aconfirm" data-url="?code=<?php echo $TPL_VAR["jbcode"]?>&stext=<?php echo $TPL_VAR["stext"]?>&sec=<?php echo $TPL_VAR["sec"]?>">확인</button>
    </div>
</div>
<div class="layerAlert" id="alertmsg2">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="nconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->