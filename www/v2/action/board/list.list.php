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
	$args['secret'] = $_REQUEST["secret"];	
	$args['stext'] = $_REQUEST["stext"];

	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);
	if($viewlist == "N"){
		$rtn = '<div class="section">
					<fieldset class="boardSearch">
						<legend>검색어 입력</legend>
						<div class="inputBox">
							<input type="text" class="inputTxt" id="bschtxt" placeholder="검색어를 입력하세요." value="'.$_REQUEST["stext"].'">
							<button type="button" class="btnSearch">검색</button>
						</div>
					</fieldset>';
		if($jbcode == "40") {
			$rtn .='<div class="btnWrap">
						<span><a href="#" class="btnType2" onclick="javascript:board_read(\'write\',\'code='.$jbcode.'\');">전문의 상담하기</a></span>
					</div>
					<h3 class="subTitle">상담목록
						<label class="chk">
							<span>공개글만</span>
							<input type="checkbox" class="inputChk" >
						</label>
					</h3>';
			
		}else if($jbcode == "120") {
			$rtn .='<div class="btnWrap">
						<span><a href="#" class="btnType2" onclick="javascript:board_read(\'write\',\'code='.$jbcode.'\');">작성하기</a></span>
					</div>
					<h3 class="subTitle">고객의 소리함</h3>';
		}
		$rtn .='<ul class="boardList" id="list_result" data-total="'.count($data).'">';
	}
	$p=0;
	$mbtn = ($psize >= count($data)) ? " style='display:none;'" : "";	
	for($i=0;$i<count($data);$i++) {
		$jb_idx  =$data[$i]["jb_idx"];
		$jb_code = $data[$i]["jb_code"];
		$title = $data[$i]["jb_title"];
		$secret = $data[$i]["jb_secret_check"];
		$sec = ($secret =="Y") ? '<span class="lock">비밀글</span>' : "";
		if(strlen($data[$i]["jb_name"]) > 6) {
			$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 6);
		}else{
			$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 3);	
		}
		$treat_type = "기타";
		if($data[$i]['jb_treat'] != '' ) {				
			$treat_type = $GP -> CLINIC_TYPE_NEW[$data[$i]['jb_treat']];
		}		
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
		
		/*if($file_cnt > 0)
		{	
			$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
			$img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='144' height='101'>";	
		}
		*/
		if($i%$psize == 0) $p++;
		if($p > 1) $style = 'style=display:none';
		$rtn .= '
			<li data-page='.$p.' '.$style.'>
				<a href="#" onclick="javascript:board_read(\'view\',\'idx='.$jb_idx.'\');" >
					<span class="subject">['.$treat_type.'] '.$title.'</span>
						<span class="opt">
							<span class="date">'.$regDt.'</span>
							<span class="name">'.$jb_name.'</span>
							'.$sec.'
						</span>
					<span class="state">대기</span>				
					
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