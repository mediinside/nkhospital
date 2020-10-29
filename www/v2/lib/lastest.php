<?
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	
	function main_lastest($code){
		global $GP, $C_JHBoard, $C_Func;
		$args = array();
		$args['jb_code'] = $code;
		$args['stext'] = $_POST["stext"];
		$args['psize'] = "5";
		$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
		$data = $C_JHBoard -> Search_New_BBS($args);
		for($i=0;$i<count($data);$i++) {
            $jb_code = $data[$i]["jb_code"];
			$jb_idx  =$data[$i]["jb_idx"];
            $title = $data[$i]["jb_title"];
            $regDt = date("Y.m.d", strtotime($data[$i]['jb_reg_date']));
			$jb_content					= $C_Func->dec_contents_edit($data[$i]['jb_content']);
			$jb_content					= trim(strip_tags($jb_content));
			$jb_content					= str_replace("&nbsp;","",$jb_content);
			$jb_content 				= $C_Func->strcut_utf8($jb_content, 100, true, "...");	//제목 (길이, HTML TAG제한여부 처리)
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
                $img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='198' height='111'>";	
            }else{
				$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='140' height='101'>";	
			}
			$padding_css = "";
			$jb_content = ($jb_content) ? $jb_content : "뉴고려병원은 대한민국에서 가장 설명 잘하는 병원, 환자에게 다가서는 병원, 사람을 가장 소중하게 생각하는 1등 종합병원으로 항상 소통하고 최선을 다하겠습니다.";
			if($i==0) {
				$subline = '<span class="cont">
								<span class="inner">
									<span>'.$jb_content.'</span>
								</span>
							</span>';
				/*if(!$jb_content) {
					$subline = "";
					$padding_css = "style='padding:0 1rem 1rem 19rem;'";
				}*/
			}else{
				$subline = "";
			}
			$mask = ($jb_code == "140") ? " vod" : "";
            $rtn .= '
                <li data-page='.$p.'>
                    <a href="javascript:void(0);" onclick="javascript:page_load(\'board\',\'idx='.$jb_idx.'\');" '.$padding_css.'>
                        <span class="thumb'.$mask.'">
                            '.$img_src.'
                        </span>
                        <span class="tit">'.$title.'</span>
                        <span class="opt">
                            <span class="source">'.$bname["jba_title"].'</span>
                            <span class="date">'.$regDt.'</span>
                        </span>
						'.$subline.'
                    </a>
                </li>
            ';
        }
		return $rtn;
	}
?>