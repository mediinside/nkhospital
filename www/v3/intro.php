<?php 
/*
BY-SHIN - 2019-06-11
*/
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors", 1);

include "include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "";

include $root_path."include/common.php";

$js->load_script("/v3/controller/js/intro.js");

$tab = ($_GET["tab"]) ? $_GET["tab"] : "intro1";

switch($tab){
	case "intro1" : $ttxt = "소개영상"; break;
	case "intro2" : $ttxt = "인사말"; break;
	case "intro3" : $ttxt = "연혁"; break;
	case "intro4" : $ttxt = "미션,비젼,가치"; break;
	case "intro5" : $ttxt = "채용정보"; break;
	case "intro6" : $ttxt = "협력병원 및 기관"; break;
	default : $ttxt = "소개영상"; break;
};
if($tab=="intro6" && $_GET["m"] == "w"){
	$tab = $tab.".write";
}
if($tab == "intro5") {
	include_once($GP->CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	if($idx){
		$args = "";
		$args['jb_idx'] = $_GET["idx"];
		$data = "";
		$data = $C_JHBoard -> Board_New_Read_Data($args);	
		extract($data);
			$reg_date = date("Y.m.d", strtotime($jb_reg_date));
			$content	= $C_Func->dec_contents_edit($jb_content);
			if($jb_file_name!="") {
				$ex_jb_file_name = explode("|", $jb_file_name);
				$ex_jb_file_code = explode("|", $jb_file_code);
				$file_cnt = count($ex_jb_file_name);
			} else {
				$file_cnt = 0;
			}
			if($jb_file_name!="") {
				$ex_jb_file_name = explode("|", $jb_file_name);
				$ex_jb_file_code = explode("|", $jb_file_code);
				$file_cnt = count($ex_jb_file_name);
			} else {
				$file_cnt = 0;
			}
		
			if($file_cnt > 0)
				{
					for($i=0; $i<$file_cnt; $i++)
					{
						if($ex_jb_file_name[$i])
						{		
							$code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";							
							$file_info .= "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">".$ex_jb_file_name[$i]."</a>";																
						}	 
					}
				}		
			$tpl->assign(array(		
					'vtitle' 	=> $jb_title,
					'vdate' 	=> $reg_date,
					'vsee' 		=> $jb_see,
					'vcontent' 	=> $content,
					'vfile'		=> $file_info,
					'vcmt' 		=> $cmt_info,
					"jbcode"	=> "100"
			));
			$tab = $tab.".view";
			
	}else{
		$psize = 8;
		$args = "";
		$args['jb_code'] = "100";
		$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
		$data = "";
		$data = $C_JHBoard -> Search_New_BBS($args);		
			$psize = 10;
			$p=0;
			$mbtn = ($psize >= count($data)) ? " style='display:none;'" : "";
			for($i=0;$i<count($data);$i++) {
				$jb_idx 	= $data[$i]["jb_idx"];
				$jb_code 	= $data[$i]["jb_code"];			
				$title 		= $data[$i]["jb_title"];
				$title 		= preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $title);
				$regDt 		= date("Y.m.d", strtotime($data[$i]['jb_reg_date']));
				$content			= $C_Func->dec_contents_edit($data[$i]['jb_content']);
				$content			= trim(strip_tags($content));
				$content 			= $C_Func->strcut_utf8($content, 100, true, "...");			
				if($i%$psize == 0) $p++;
				if($p > 1) $style = 'style=display:none';			
				$list[] = array(
						'jb_idx' 		 => $jb_idx,
						'jb_code'		 => $jb_code,
						'title'			 => $title,						
						'regDt' 		 => $regDt,
						'style' 		 => $style,
						'p'				 => $p,
						'content'		 => $content													
				);
			}
	}
}
$tpl->define("main","intro/".$tab.".tpl");
$tpl->define("introtop","inc/intro.top.tpl");

$tpl->assign(array(
	"ctxt"	=> $ctxt,
	"ttxt"	=> $ttxt,
	"tab" 	=> $tab,
	"list" 	=> $list	
));

include $root_path."include/footer.php";
?>

