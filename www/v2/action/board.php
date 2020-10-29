<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	include_once($GP -> CLS."class.list.php");
	$C_JHBoard = new JHBoard();
	$C_ListClass 	= new ListClass();
	$psize = 10;
	$jbcode = ($_REQUEST["jbcode"]) ? $_REQUEST["jbcode"] : "news";
	$idx = ($_REQUEST["idx"]) ? $_REQUEST["idx"] : "";
	$args = "";
	$args['jb_code'] = $jbcode;
	$args['stext'] = $_POST["stext"];

	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);	
	switch($jbcode){
		case "news" : $type = "thumb"; $ttxt = "병원소식"; break;	
		case "50" 	: $type = "thumb"; $ttxt = "건강정보"; break;	
		case "40" 	: $type = "list";  $ttxt = "전문의상담";break;	
		case "20" 	: $type = "card";  $ttxt = "칭찬합시다";break;							
		case "120" 	: $type = "list";  $ttxt = "고객의 소리함";break;							
	}
	$pg = ($pg) ? $pg : "list.".$type;
	//print_r($data);
	if($idx) echo "<script>board_read('view','code=news&idx=".$idx."')</script>";
?>	
    <div class="subTop3">
        <p class="category"><strong>뉴고려커뮤니티</strong> 더 가까이 더 낮은 자세로 더 많이 듣겠습니다.</p>
        <nav class="location">
            <div class="depth2">
                <button type="button" class="btn" onclick="locActive();">소통/공감</button>
                <ul class="list">
                    <li><a href="#">소통/공감</a></li>
                    <li><a href="#" onClick="javascript:page_load('intro','');">뉴고려소개</a></li>
                </ul>
            </div>
            <div class="depth3">
                <button type="button" class="btn" onclick="locActive();"><?=$ttxt?></button>
                <ul class="list">
                    <li data-code="news" data-page="thumb"><a href="#">뉴고려소식</a></li>
                    <li data-code="50" data-page="thumb"><a href="#" >건강정보</a></li>
                    <li data-code="40" data-page="list"><a href="#">전문의상담</a></li>
                    <li data-code="20" data-page="card"><a href="#">칭찬합시다</a></li>
                    <li data-code="120" data-page="list"><a href="#">고객의 소리함</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <br />
    <div id="result_board">
    <!--
        <div class="section">
            <fieldset class="boardSearch">
                <legend>검색어 입력</legend>
                <div class="inputBox">
                    <input type="text" class="inputTxt" id="schtxt" placeholder="검색어를 입력하세요.">
                    <button type="button" class="btnSearch">검색</button>
                </div>
                <div class="boardSort active">
                    <button type="button" class="btn" onclick="sortActive();">전체</button>
                    <ul class="list" id="news_menu">
                        <li><button type="button" class='btnBtype' data-code="news">전체</button></li>
                        <li><button type="button" class='btnBtype' data-code="80">포토뉴스</button></li>
                        <li><button type="button" class='btnBtype' data-code="140">CH NK</button></li>
                        <li><button type="button" class='btnBtype' data-code="90">언론보도</button></li>
                    </ul>
                </div>
            </fieldset>
            <div id="bd_result">
            </div>-->
    <? /* 
        $rtn = '<ul class="boardThumb" id="list_result">';
        $p=0;
        for($i=0;$i<count($data);$i++) {
            $jb_code = $data[$i]["jb_code"];
			$jb_idx  =$data[$i]["jb_idx"];
            $title = $data[$i]["jb_title"];
            $regDt = date("Y.m.d", strtotime($data[$i]['jb_reg_date']));
            $args["jb_code"] = $jb_code;
            $bname = $C_JHBoard -> Board_Config_Data($args);		
            //파일명 분리 및 저장된 파일 갯수
            if($data[$i]["jb_file_name"]!="") {
                $ex_jb_file_name = explode("|", $data[$i]["jb_file_name"]);
                $ex_jb_file_code = explode("|", $data[$i]["jb_file_code"]);
                $file_cnt = count($ex_jb_file_name);
            } else {
                $file_cnt = 0;
            }
            $img_src = "";
            if($file_cnt > 0)
            {	
                $code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
                $img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='144' height='101'>";	
            }
            if($i%$psize == 0) $p++;
            if($p > 1) $style = 'style=display:none';
            $rtn .= '
                <li data-page='.$p.' '.$style.'>
                    <a href="javascript:void(0);" onclick="javascript:board_read(\'view\',\'idx='.$jb_idx.'\');" >
                        <span class="thumb">
                            '.$img_src.'
                        </span>
                        <span class="tit">'.$title.'</span>
                        <span class="opt">
                            <span class="source">'.$bname["jba_title"].'</span>
                            <span class="date">'.$regDt.'</span>
                        </span>
                    </a>
                </li>
            ';
        }
       $rtn .= '</ul><div class="btnWrap">
                <span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
            </div>
            ';
        echo $rtn;
		*/
    ?>	
    
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
		<!-- 알럿 레이어 -->
		<div class="layerAlert" id="alertmsg2">
			<div class="cont">
				<p class="chkTxt"></p>
				<button type="button" class="btnType2" id="nconfirm">확인</button>
			</div>
		</div>
		<!-- //알럿 레이어 -->          
    <br />
<script>
	var code = "<?=$jbcode?>";
	var pg = "<?=$pg?>";
	var bidx = "<?=$idx?>";
	var psize = "<?=$psize?>";
	if(!bidx) board_read("<?=$pg?>","code="+code);
</script>