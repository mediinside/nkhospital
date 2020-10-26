<?php /* Template_ 2.2.8 2020/02/07 14:07:37 /home/hosting_users/nkmed/www/v3/view/board/list.card.tpl 000002717 */ 
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
<?php $this->print_("btop",$TPL_SCP,1);?>

<div class="section"><h2 class="pageTitle letter">칭찬합시다</h2>
    <div class="btnWrap">
<?php if($TPL_VAR["board_yn"]=="Y"){?><span><a href="?code=<?php echo $TPL_VAR["jbcode"]?>&stext=<?php echo $TPL_VAR["stext"]?>&sec=<?php echo $TPL_VAR["sec"]?>&m=w"><button type="button" class="btnType4">칭찬합시다 (글작성)</button></a></span><?php }?>
    </div>
    <ul class="cardList" id="list_result" data-total="<?php echo $TPL_VAR["btotal"]?>">
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
        <li data-page='<?php echo $TPL_V1["p"]?>'<?php echo $TPL_V1["style"]?>>
<?php if($TPL_V1["fread"]=="Y"){?>
<?php if($TPL_V1["secret"]=="N"){?><a href="?code=<?php echo $TPL_VAR["jbcode"]?>&bidx=<?php echo $TPL_V1["jb_idx"]?>"><?php }else{?><a href="#" onclick="javascript:secret_check('<?php echo $TPL_V1["jb_idx"]?>')"><?php }?>
<?php }else{?>
            <a href="javascript:void(0);" onclick="javascript:secret_false('작성회원만 글을 읽을 수 있습니다.')">
<?php }?>
	            <span class="subject">[<?php echo $TPL_V1["treat_type"]?>] <?php echo $TPL_V1["title"]?></span>
                <span class="txt"><?php echo $TPL_V1["content"]?></span>					
                    <span class="opt">
                        <span class="date"><?php echo $TPL_V1["regDt"]?></span>
                        <span class="name"><?php echo $TPL_V1["jb_name"]?></span>
                    </span>
                </span>
            </a>
        </li>
<?php }}?>
	<div class="btnWrap"<?php echo $TPL_VAR["mbtn"]?>>
		<span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
	</div>
</div>    
<!-- 비밀번호 입력 레이어 -->
<div class="layerAlert" id="pwdlayer">
    <div class="cont">
        <p class="passTxt">비밀번호를 입력해주세요.</p>
        <input type="password" class="inputTxt" id="inpwd">
        <div class="btnWrap">
            <span><button type="button" class="btnType1" id="pcancel">취소</button></span>
            <span><button type="button" class="btnType2" id="pconfirm">확인</button></span>
        </div>
    </div>
</div>
<!-- //비밀번호 입력 레이어 -->    
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alertmsg">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="aconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->