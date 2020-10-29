<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."/class.search.php");	
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	$C_Sch 		= new Search;
	$schtxt = ($_REQUEST["schtxt"]) ? ($_REQUEST["schtxt"]) : $_GET["schtxt"];
	//echo iconv("UTF-8", "EUC-KR", $schtxt);
	$args = array();
	$args["schtxt"] = $schtxt;
	$psize = "3";
	list($vdsch,$docsch,$brdsch) = $C_Sch->Search_List($args);
?>
<br>
<div class="resultTop">
    <button type="button" class="btnBack" onclick="history.back();">뒤로</button>
    <fieldset class="search">
        <legend>검색어 입력</legend>
        <input type="text" class="inputTxt" placeholder="입력해 주세요." value="<?=$schtxt?>" id="sschtxt">
        <button class="btn" id="sschbtn">검색</button>
    </fieldset>
</div>
<? if(!$vdsch && !$docsch && !$brdsch) { ?>
    <div class="section">
        <p class="noResult">
            <span>“<?=$schtxt?>”</span>
            의 검색결과가 없습니다.
        </p>
        <p class="searchChk">
            단어의 철자가 정확한지 확인해 보세요.<br>
            한글을 영어로 입력했는지 확인해 보세요.<br>
            두 단어 이상의 검색인 경우, 띄어쓰기를 확인해 보세요.
        </p>
    </div>
<? } ?>

<div class="searchResult">
	<? if($vdsch) { ?>
    <div class="section">
        <h3 class="subTitle">관련영상 <span class="sub">(<?=count($vdsch)?>건)</span></h3>
        <ul class="boardThumb" id="video_result" data-total=<?=count($vdsch)?>>
        	<? 	$p=0;$i=0;
				$mbtn = ($psize >= count($vdsch)) ? " style='display:none;'" : "";
				foreach($vdsch as $k=>$v) { 
					$vd_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
					$vd_link1		= $v['vd_link1'];
					$you_id 		= explode("watch?v=",$vd_link1);
					$dr_face_img	=  '<img src="'.$GP -> UP_DOCTOR_URL . $v["dr_face_img"].'" alt="">';
					$treat = ($GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic3"]]; 
					$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="103" src="//www.youtube.com/embed/'.$you_id[1].'?fs=1" frameborder="0" allowfullscreen></iframe>';
					$dr_name = $v["dr_name"]." ".$vd_ps;
					if($i%$psize == 0) $p++;
					$style = ($p > 1) ? 'style=display:none' : "";
			?>
           <li data-page='<?=$p?>' <?=$style?>>
                <a href="#">
                    <span class="thumb vod">
                    	<?=$you_link?>
                    </span>
                    <span class="tit"><?=$v["vd_title"]?></span>
                    <span class="doc">
                        <?=$dr_face_img?>
                        <span class="name"><?=$dr_name?></span>
                        <span class="cate"><?=$treat?></span>
                    </span>
                </a>
            </li>
            <? $i++;} ?>
        </ul>
        <div class="btnWrap"<?=$mbtn?>>
            <span><a href="javascript:void(0);" class="btnType1" id="vmore">더보기</a></span>
        </div>
    </div>
    <? } ?>
    <? if($docsch) { ?>
    <div class="section">
        <h3 class="subTitle">의료진 <span class="sub">(<?=count($docsch)?>건)</span></h3>
        <ul class="docList2" id="doctor_result" data-total=<?=count($docsch)?>>
        <? $p=0;$i=0;
			$mbtn = ($psize >= count($docsch)) ? " style='display:none;'" : "";
			foreach($docsch as $k=>$v) { 
			$dr_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
			$dr_treat  = nl2br($C_Func->dec_contents_edit($v["dr_treat"]));	
			if($v["dr_mobile_img"] !=  '') {
				$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $v["dr_mobile_img"] . "' alt='' />";
			}else{
				$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $v["dr_face_img"] . "' alt='' />";	
			}
			$treat = ($GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$v["dr_clinic3"]]; 			
			if($i%$psize == 0) $p++;
			$style = ($p > 1) ? 'style=display:none' : "";
		?>
             <li data-page='<?=$p?>' <?=$style?>>
                <a href="#" onClick="javascript:page_load('doctor','pg=detail&gubun=d&idx=<?=$v["dr_idx"]?>');">
                    <span class="pic"><?=$dr_img?></span>
                    <span class="name"><span><?=$treat?></span> <?=$v["dr_name"]?> <?=$dr_ps?></span>
                    <span class="cate"><?=$v["dr_treat"]?></span>
                </a>
            </li>
        <? $i++;} ?>    
        </ul>
        <div class="btnWrap"<?=$mbtn?>>
            <span><a href="javascript:void(0);" class="btnType1" id="dmore">더보기</a></span>
        </div>
    </div>
    <? } ?>
	<? if($brdsch) { ?>
    <div class="section">
        <h3 class="subTitle">커뮤니티 <span class="sub">(<?=count($brdsch)?>건)</span></h3>
        <!--<div class="boardSort">
            <button type="button" class="btn" onclick="sortActive();">전체</button>
            <ul class="list">
                <li><button type="button">전체</button></li>
                <li><button type="button">포토뉴스</button></li>
                <li><button type="button">건강정보</button></li>
                <li><button type="button">CH NK</button></li>
            </ul>
        </div>
		-->
        <ul class="boardThumb" id="board_result" data-total=<?=count($brdsch)?>>
	        <?  $p=0;$i=0;
				$mbtn = ($psize >= count($brdsch)) ? " style='display:none;'" : "";
				foreach($brdsch as $k=>$v) { 
					$regDt = date("Y.m.d", strtotime($v['jb_reg_date']));
					$jb_code = $v["jb_code"];
					$args = "";
		            $args["jb_code"] = $jb_code;
		            $bname = $C_JHBoard -> Board_Config_Data($args);		
					//파일명 분리 및 저장된 파일 갯수
					if($v["jb_file_name"]!="") {
						$ex_jb_file_name = explode("|", $v["jb_file_name"]);
						$ex_jb_file_code = explode("|", $v["jb_file_code"]);
						$file_cnt = count($ex_jb_file_name);
					} else {
						$file_cnt = 0;
					}
					$img_src = "";
					if($file_cnt > 0)
					{	
						$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
						$img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='140' height='101'>";	
					}else{
						$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='140' height='101'>";	
					}
					if($i%$psize == 0) $p++;
					$style = ($p > 1) ? 'style=display:none' : "";

			?>
            <li data-page='<?=$p?>' <?=$style?>>
                <a href="#" onclick="javascript:page_load('board','idx=<?=$v["jb_idx"]?>');">
                    <span class="thumb">
                        <?=$img_src?>
                    </span>
                    <span class="tit"><?=$v["jb_title"]?></span>
                    <span class="opt">
                        <span class="source"><?=$bname["jba_title"]?></span>
                        <span class="date"><?=$regDt?></span>
                    </span>
                </a>
            </li>
            <? $i++;} ?>
        </ul>
        <div class="btnWrap"<?=$mbtn?>>
            <span><a href="javascript:void(0);" class="btnType1" id="bmore">더보기</a></span>
        </div>
    </div>
	<? } ?>
</div>
<script language="javascript">
var psize = "<?=$psize?>";
</script>