<?php /* Template_ 2.2.8 2020/05/06 12:09:27 /home/hosting_users/nkmed/www/v3/view/board/list.thumb.tpl 000003663 */ 
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
<?php $this->print_("btop",$TPL_SCP,1);?>

<div class="section">
<?php if($TPL_VAR["schmenu"]=="Y"){?>
    <fieldset class="boardSearch">
        <legend>검색어 입력</legend>
        <div class="inputBox">
            <input type="text" class="inputTxt" id="bschtxt" placeholder="검색어를 입력하세요." value="<?php echo $TPL_VAR["stext"]?>">
			<button type="button" class="btnSearch" data-url="?code=<?php echo $TPL_VAR["jbcode"]?>&sec=<?php echo $TPL_VAR["sec"]?>">검색</button>
        </div>
<?php if($TPL_VAR["submenu"]=="Y"){?>
        <div class="boardSort">
            <button type="button" class="btn" onclick="sortActive();"><?php echo $TPL_VAR["mtxt"]?></button>
            <ul class="list" id="news_menu">
                <li><a href="?code=news"><button type="button" class="btnBtype" data-code="news">전체</button></a></li>
		<li><a href="?code=10"><button type="button" class="btnBtype" data-code="10">병원소식</button></a></li>
                <li><a href="?code=80"><button type="button" class="btnBtype" data-code="80">포토뉴스</button></a></li>
                <li><a href="?code=140"><button type="button" class="btnBtype" data-code="140">CH NK</button></a></li>
                <li><a href="?code=90"><button type="button" class="btnBtype" data-code="90">언론보도</button></a></li>
            </ul>
        </div>
<?php }?>
	</fieldset>
<?php }?>
		<ul class="boardThumb" id="list_result" data-total="<?php echo $TPL_VAR["btotal"]?>">
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
			<li data-page='<?php echo $TPL_V1["p"]?>'<?php echo $TPL_V1["style"]?>>
<?php if($TPL_V1["fread"]=="Y"){?>
<?php if($TPL_V1["secret"]=="N"){?><a href="?code=<?php echo $TPL_VAR["jbcode"]?>&bidx=<?php echo $TPL_V1["jb_idx"]?>"><?php }else{?><a href="#" onclick="javascript:secret_check('<?php echo $TPL_V1["jb_idx"]?>')"><?php }?>
<?php }else{?>
                <a href="javascript:void(0);" onclick="javascript:secret_false('작성회원만 글을 읽을 수 있습니다.')">
<?php }?>
					<span class="thumb">
						<?php echo $TPL_V1["img_src"]?>

					</span>
					<span class="tit"><?php echo $TPL_V1["title"]?></span>
					<span class="opt">
<?php if($TPL_VAR["jbcode"]!="50"){?>
                        <span class="source"><?php echo $TPL_V1["bname"]?></span>
<?php }?>
                        <span class="date"><?php echo $TPL_V1["regDt"]?></span>
					</span>
				</a>
			</li>
<?php }}?>
	  </ul>
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