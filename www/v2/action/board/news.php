<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	include_once($GP -> CLS."class.list.php");
	$C_JHBoard = new JHBoard();
	$C_ListClass 	= new ListClass();
	$psize = 3;
	$jbcode = ($_REQUEST["code"]) ? $_REQUEST["code"] : "news";
	$args = "";
	$args['jb_code'] = $jbcode;
	$args['stext'] = $_REQUEST["stext"];

	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);	
	$p=0;
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
	echo $rtn;
?>	