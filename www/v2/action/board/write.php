<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	$jb_code = $_REQUEST["code"];
	$mode = $_REQUEST["mode"];	
	if($_REQUEST["idx"] && $mode == "mod") {
		include_once($GP -> CLS."class.jhboard.php");
		$C_JHBoard = new JHBoard();		
		$args['jb_idx'] = $_REQUEST["idx"];
		$data = $C_JHBoard -> Board_New_Read_Data($args);	
		extract($data);
	}
	$secret = ($jb_code == "40" || $jb_code == "20" || $jb_code == "120") ?"Y":"N";
	if(!$_SESSION['suserid'] && $jb_code == "120") {
		echo "<script>secret_false('회원만 글이 등록 가능합니다.')</script>"; 
		exit;
	}
	switch($jb_tgubun) {
			case "a" : $menuarr = $GP -> NEW_MOBILE_CENTER;break;
			case "b" : $menuarr = $GP -> NEW_MOBILE_CLINIC;break;
			case "c" : $menuarr = $GP -> NEW_MOBILE_SPECIAL;break;
			default  : $menuarr = $GP -> NEW_MOBILE_CENTER;break;
	}		
?>	
<h2 class="pageTitle write">전문의 상담</h2>
<div class="section">
<form id="bform" name="bform" method="post" enctype="multipart/form-data">
    <input type="hidden" name="jb_code" value="<?=$jb_code?>" />
    <input type="hidden" name="jb_secret_check" value="<?=$secret?>" />    
    <input type="hidden" name="mode" value="<?=$mode?>" />    
        <table class="boardWrite">
            <caption>전문의 상담 작성</caption>
                <tbody>
                    <? if($jb_code == "40") { ?>
                    <tr>
                        <th scope="row">진료과목<span class="essential">*</span></th>
                        <td>
                            <span class="formRow">
                                <span class="cell">
                                    <select name="jb_tgubun" id="jb_tgubun">
                                        <option value="a" <? if($jb_tgubun == "a") echo "selected";?>>전문센터</option>
                                        <option value="b" <? if($jb_tgubun == "b") echo "selected";?>>진료과</option>
                                        <option value="c" <? if($jb_tgubun == "a") echo "selected";?>>특수클리닉</option>
                                    </select>
                                </span>
                                <span class="cell">
                                    <select name="jb_treat" id="jb_treat">
                                        <? foreach($menuarr as $k=>$v) {
											$sel = ($jb_treat==$k) ? " selected" : "";
                                            echo '<option value="'.$k.'"'.$sel.'>'.$v.'</option>';
                                        }?>
                                    </select>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <? } ?>
                    <tr>
                        <th scope="row">제목<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_title" id="jb_title" value="<?=$jb_title?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">작성자<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_name" id="jb_name" value="<?=$_SESSION['susername']?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">내용<span class="essential">*</span></th>
                        <td>
                            <textarea name="jb_content" id="jb_content" cols="30" rows="10" placeholder="- 노출 우려가 있는 개인정보는 기재하지 마세요.
 게시판 의도와 상관없는 글은 사전 동의없이 삭제됩니다."><?=$jb_content?></textarea>
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
                            <input type="password" class="inputTxt" placeholder="4자리 이상" name="jb_password" id="jb_password" value="<?=$jb_password?>">
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
        <span><a href="#" class="btnType1" onclick="javascript:go_list('list.list','<?=$jb_code?>');">취소/목록</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="board_write">작성완료</a></span>
    </div>
</div>