<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	$args = "";
	$args['jb_code'] = $_POST["jbcode"];
	$args['npage'] = $_POST["npage"];
	$args['psize'] = $_POST["psize"];
	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = "";
	$data = $C_JHBoard -> Search_New_BBS($args);	


	switch($_POST["jbcode"]) {
		case "100"; //채용공고
			foreach($data as $k=>$v){ 
				$title 				= $C_Func->strcut_utf8($v['jb_title'], 44,true, "...");
				$content			= $C_Func->dec_contents_edit($v['jb_content']);
				$content			= trim(strip_tags($content));
				$content 			= $C_Func->strcut_utf8($content, 100, true, "...");
				$reg_date 			= date("Y.m.d", strtotime($v['jb_reg_date']));	
				
				echo '<li>
						<a href="#">
							<span class="subject">'.$title.'</span>
							<span class="txt">'.$content.'</span>
							<span class="opt">
								<span class="date">'.$reg_date.'</span>
							</span>
						</a>
					</li>';
			}
		break;
	}
	
?>