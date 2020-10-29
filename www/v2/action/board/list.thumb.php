<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	include_once($GP -> CLS."class.list.php");
	$C_JHBoard = new JHBoard();
	$C_ListClass 	= new ListClass();
	$viewlist = ($_REQUEST["view"]) ? "Y" : "N";
	$jbcode = ($_REQUEST["code"]) ? $_REQUEST["code"] : "news";
//	$psize = ($jbcode == "20" || $jb_code == "120") ? 2 : 3;
	$psize = "10";	
	$args = "";
	$args['jb_code'] = $jbcode;
	$args['stext'] = $_REQUEST["stext"];
	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);
	switch($jbcode){
		case "news" : $mtxt = "전체";break;
		case "80"  : $mtxt = "포토뉴스";break;
		case "140" : $mtxt = "CH NK";break;
		case "90"  : $mtxt = "언론보도";break;							
	}
	if($viewlist == "N"){
		$rtn = '<div class="section">
					<fieldset class="boardSearch">
						<legend>검색어 입력</legend>
						<div class="inputBox">
							<input type="text" class="inputTxt" id="bschtxt" placeholder="검색어를 입력하세요." value="'.$_REQUEST["stext"].'">
							<button type="button" class="btnSearch">검색</button>
						</div>';
		if($jbcode == "news" || $jbcode == "80" || $jbcode == "140" || $jbcode == "90") $rtn .= '<div class="boardSort">
							<button type="button" class="btn" onclick="sortActive();">'.$mtxt.'</button>
							<ul class="list" id="news_menu">
								<li><button type="button" class="btnBtype" data-code="news">전체</button></li>
								<li><button type="button" class="btnBtype" data-code="80">포토뉴스</button></li>
								<li><button type="button" class="btnBtype" data-code="140">CH NK</button></li>
								<li><button type="button" class="btnBtype" data-code="90">언론보도</button></li>
							</ul>
						</div>';
		$rtn    .= '</fieldset>
					<ul class="boardThumb" id="list_result" data-total="'.count($data).'">';
	}
	$p=0;
	$mbtn = ($psize >= count($data)) ? " style='display:none;'" : "";
	for($i=0;$i<count($data);$i++) {
		$jb_idx  =$data[$i]["jb_idx"];
		$jb_code = $data[$i]["jb_code"];
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
		}else{
			$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='144' height='101'>";	
		}
		if($i%$psize == 0) $p++;
		if($p > 1) $style = 'style=display:none';
		$rtn .= '
			<li data-page='.$p.' '.$style.'>
				<a href="#" onclick="javascript:board_read(\'view\',\'idx='.$jb_idx.'\');" >
					<span class="thumb">
						'.$img_src.'
					</span>
					<span class="tit">'.$title.'</span>
					<span class="opt">';
		if($jbcode != "50")	$rtn .='<span class="source">'.$bname["jba_title"].'</span>';
		$rtn .='<span class="date">'.$regDt.'</span>
					</span>
				</a>
			</li>
		';
	}	
	if($viewlist == "N"){	
	  $rtn .= '</ul><div class="btnWrap"'.$mbtn.'>
			<span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
		</div>
      </div>';
	}
	echo $rtn;
?>	