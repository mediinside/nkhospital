<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	include_once($GP -> CLS."class.list.php");
	$C_JHBoard = new JHBoard();
	$C_ListClass 	= new ListClass();
	$viewlist = ($_REQUEST["view"]) ? "Y" : "N";	
	$jbcode = ($_REQUEST["code"]) ? $_REQUEST["code"] : "news";
	//$psize = ($jbcode == "20" || $jb_code == "120") ? 2 : 3;
	$psize = "10";
	$args = "";
	$args['jb_code'] = $jbcode;
	$args['secret'] = $_REQUEST["secret"];	
	$args['stext'] = $_REQUEST["stext"];

	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);
	$rtn = '<div class="section"><h2 class="pageTitle letter">칭찬합시다</h2>
				<div class="btnWrap">
					<span><button type="button" class="btnType4" onclick="javascript:board_read(\'write\',\'code='.$jbcode.'\');">칭찬합시다</button></span>
				</div>
				<ul class="cardList" id="list_result" data-total="'.count($data).'">';
	$p=0;
	$mbtn = ($psize >= count($data)) ? " style='display:none;'" : "";		
	for($i=0;$i<count($data);$i++) {
		$jb_idx  =$data[$i]["jb_idx"];
		$jb_code = $data[$i]["jb_code"];
		$title = $data[$i]["jb_title"];
		if(strlen($data[$i]["jb_name"]) > 6) {
			$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 6);
		}else{
			$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 3);	
		}
		$content			= $C_Func->dec_contents_edit($data[$i]['jb_content']);
		$content			= trim(strip_tags($content));
		$content 			= $C_Func->strcut_utf8($content, 100, true, "...");
		
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
		if($file_cnt > 0)
		{	
			$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
			$img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='144' height='101'>";	
		}
		if($i%$psize == 0) $p++;
		if($p > 1) $style = 'style=display:none';
		$rtn .= '
			<li data-page='.$p.' '.$style.'>
				<a href="#" onclick="javascript:board_read(\'view\',\'idx='.$jb_idx.'\');" >
					<span class="subject">['.$treat_type.'] '.$title.'</span>
					<span class="txt">'.$content.'</span>					
						<span class="opt">
							<span class="date">'.$regDt.'</span>
							<span class="name">'.$jb_name.'</span>
						</span>
					</span>
				</a>
			</li>
		';
	}
	  $rtn .= '</ul><div class="btnWrap"'.$mbtn.'>
			<span><a href="javascript:void(0);" class="btnType1" id="more">더보기</a></span>
		</div>
      </div></section>';
	echo $rtn;
?>	