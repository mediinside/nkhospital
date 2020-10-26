<?php /* Template_ 2.2.8 2020/10/24 03:04:24 D:\home\nkhospital\www\v3\view\search.tpl 000005719 */ 
$TPL_list1_1=empty($TPL_VAR["list1"])||!is_array($TPL_VAR["list1"])?0:count($TPL_VAR["list1"]);
$TPL_list2_1=empty($TPL_VAR["list2"])||!is_array($TPL_VAR["list2"])?0:count($TPL_VAR["list2"]);
$TPL_list3_1=empty($TPL_VAR["list3"])||!is_array($TPL_VAR["list3"])?0:count($TPL_VAR["list3"]);?>
<div class="resultTop">
    <button type="button" class="btnBack" onclick="history.back();">뒤로</button>
    <fieldset class="search">
        <legend>검색어 입력</legend>
        <input type="text" class="inputTxt" placeholder="입력해 주세요." value="<?php echo $TPL_VAR["stext"]?>" id="sschtxt">
        <button class="btn" id="sschbtn">검색</button>
    </fieldset>
</div>
<?php if(!$TPL_VAR["list1"]&&!$TPL_VAR["list2"]&&!$TPL_VAR["list3"]){?>
    <div class="section">
        <p class="noResult">
            <span>“<?php echo $TPL_VAR["stext"]?>”</span>
            의 검색결과가 없습니다.
        </p>
        <p class="searchChk">
            단어의 철자가 정확한지 확인해 보세요.<br>
            한글을 영어로 입력했는지 확인해 보세요.<br>
            두 단어 이상의 검색인 경우, 띄어쓰기를 확인해 보세요.
        </p>
    </div>
<?php }else{?>
<div class="searchResult">
<?php if($TPL_VAR["list1"]){?>
    <div class="section">
        <h3 class="subTitle">관련영상 <span class="sub">(<?php echo $TPL_VAR["vcnt"]?>건)</span></h3>
        <ul class="boardThumb" id="video_result" data-total="<?php echo $TPL_VAR["vcnt"]?>">
<?php if($TPL_list1_1){foreach($TPL_VAR["list1"] as $TPL_V1){?>
            <li data-page='<?php echo $TPL_V1["p"]?>' <?php echo $TPL_V1["style"]?>>
                <a href="javascript:void(0);">
                    <span class="thumb">
                    	<div id="play<?php echo $TPL_V1["vd_idx"]?>">
	                        <?php echo $TPL_V1["you_link"]?>

                        </div>
                        <div class="vlayer" id="layer<?php echo $TPL_V1["vd_idx"]?>">
                            <?php echo $TPL_V1["thumb"]?>

                            <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart" data-vid="<?php echo $TPL_V1["vd_uid"]?>" data-lid="layer<?php echo $TPL_V1["vd_idx"]?>" data-pid="play<?php echo $TPL_V1["vd_idx"]?>">
                        </div>
                    </span>
                    <span class="tit"><?php echo $TPL_V1["title"]?></span>
                        <a href="/v3/detail.php?idx=<?php echo $TPL_V1["dr_idx"]?>&gubun=D">
                        <span class="doc">
                            <?php echo $TPL_V1["dr_face_img"]?>

                            <span class="name"><?php echo $TPL_V1["dr_name"]?></span>
                            <span class="cate"><?php echo $TPL_V1["treat"]?></span>
                        </span>
                    </a>
                </a>
            </li>
<?php }}?>
        </ul>
        <div class="btnWrap"<?php echo $TPL_VAR["vmbtn"]?>>
            <span><a href="javascript:void(0);" class="btnType1" id="vmore">더보기</a></span>
        </div>
    </div>
<?php }?>
<?php if($TPL_VAR["list2"]){?>
    <div class="section">
        <h3 class="subTitle">의료진 <span class="sub">(<?php echo $TPL_VAR["dcnt"]?>건)</span></h3>
        <ul class="docList2" id="doctor_result" data-total="<?php echo $TPL_VAR["dcnt"]?>">
<?php if($TPL_list2_1){foreach($TPL_VAR["list2"] as $TPL_V1){?>
            <li data-page='<?php echo $TPL_V1["p"]?>' <?php echo $TPL_V1["style"]?>>
                <a href="/v3/detail.php?idx=<?php echo $TPL_V1["dr_idx"]?>&gubun=D">
                    <span class="pic"><?php echo $TPL_V1["dr_img"]?></span>
                    <span class="name"><span><?php echo $TPL_V1["treat"]?></span> <?php echo $TPL_V1["dr_name"]?> <?php echo $TPL_V1["dr_ps"]?></span>
                    <span class="cate"><?php echo $TPL_V1["dr_treat"]?></span>
                </a>
            </li>
<?php }}?>
        </ul>
        <div class="btnWrap"<?php echo $TPL_VAR["dmbtn"]?>>
            <span><a href="javascript:void(0);" class="btnType1" id="dmore">더보기</a></span>
        </div>
    </div>
<?php }?>
<?php if($TPL_VAR["list3"]){?>
    <div class="section">
        <h3 class="subTitle">커뮤니티 <span class="sub">(<?php echo $TPL_VAR["bcnt"]?>건)</span></h3>
        <ul class="boardThumb" id="board_result" data-total="<?php echo $TPL_VAR["bcnt"]?>">
<?php if($TPL_list3_1){foreach($TPL_VAR["list3"] as $TPL_V1){?>        
            <li data-page='<?php echo $TPL_V1["p"]?>' <?php echo $TPL_V1["style"]?>>
                <a href="/v3/board.php?code=<?php echo $TPL_V1["jb_code"]?>&bidx=<?php echo $TPL_V1["jb_idx"]?>">
                    <span class="thumb">
                        <?php echo $TPL_V1["img_src"]?>

                    </span>
                    <span class="tit"><?php echo $TPL_V1["title"]?></span>
                    <span class="opt">
                        <span class="source"><?php echo $TPL_V1["bname"]?></span>
                        <span class="date"><?php echo $TPL_V1["regDt"]?></span>
                    </span>
                </a>
            </li>
<?php }}?>
        </ul>
        <div class="btnWrap"<?php echo $TPL_VAR["bmbtn"]?>>
            <span><a href="javascript:void(0);" class="btnType1" id="bmore">더보기</a></span>
        </div>
    </div>
<?php }?>
</div>
<?php }?>
<script language="javascript">
var psize = "<?php echo $TPL_VAR["psize"]?>";
</script>