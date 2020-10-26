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
include_once($GP->CLS."class.jhboard.php");

$C_JHBoard = new JHBoard();

$js->load_script("/v3/controller/js/board.js");

$jbcode = ($_GET["code"]) ? $_GET["code"] : "news";
$bidx = ($_GET["bidx"]) ? $_GET["bidx"] : $_POST["bidx"];
$stext = ($_GET["stext"]) ? $_GET["stext"] : $_POST["stext"];
$m = ($_GET["m"]) ? $_GET["m"] : "";
$args = "";
$args["jb_code"] = $jbcode;
$bname = $C_JHBoard -> Board_Config_Data($args);		
$mtxt = ($jbcode=="news") ? "전체": $bname["jba_title"];
if ($jbcode == "120") {
	$C_Func -> go_url("/");
}
if($jbcode == "news" || $jbcode == "80" || $jbcode == "140" || $jbcode == "90" ) {
	$ttxt = "뉴고려소식";
}else{
	$ttxt = $bname["jba_title"];
}
echo $_SESSION['suserid'];
if($m=="w"){
	$mode = "w";
	if(!$_SESSION['suserid']) {
		$C_Func -> put_msg_and_back('회원만 글이 등록 가능합니다.');
		exit;
	}
	$jb_treat = ($_GET["tr"]) ? $_GET["tr"] : "";
	if($bidx) {
		$args['jb_idx'] = $_bidx;
		$data = $C_JHBoard -> Board_New_Read_Data($args);	
		$mode = "m";
		extract($data);
		$tpl->assign(array(		
				'jb_title' 		=> $jb_title,
				'mb_name' 		=> $_SESSION['susername'],
				'jb_password'	=> $jb_password
		));	
	}
	$secret = ($jb_code == "40" || $jb_code == "20" || $jb_code == "120") ?"Y":"N";
	switch($jb_tgubun) {
			case "a" : $menuarr = $GP -> NEW_MOBILE_CENTER;break;
			case "b" : $menuarr = $GP -> NEW_MOBILE_CLINIC;break;
			case "c" : $menuarr = $GP -> NEW_MOBILE_SPECIAL;break;
			default  : $menuarr = $GP -> NEW_MOBILE_CENTER;break;
	}
	$tpl->assign(array(		
			'jbcode'  	=> $jbcode,
			'menuarr' 	=> $menuarr,
			'secret' 	=> $secret,
			'mode'		=> $mode,
			'menu'		=> $menuarr,
			'jb_tgubun' => $jb_tgubun,
			'stext'     => $stext,
			'jb_treat' 	=> $jb_treat
	));	
	
	$skin = "write";
}else{
	//보드설정
	if($bidx) {
		$args['jb_idx'] = $bidx;
	//	$args['jb_idx'] = "1412";	
		$data = "";
		$data = $C_JHBoard -> Board_New_Read_Data($args);	
		$cdata = $C_JHBoard -> Comment_New_List($args);	
		extract($data);
		$args = "";
		$args["jb_code"] = $jb_code;
		$vttxt = $C_JHBoard -> Board_Config_Data($args);
			if($jb_secret_check == "Y" && $_SESSION['suserlevel'] < 9) {
				if($jb_mb_id == "") {
					if(empty($_REQUEST["pd"]) || $_REQUEST["pd"] != $jb_password) {
						$C_Func -> put_msg_and_back('잘못된 접근입니다..');
						exit;
					}
				}else{
					if($_SESSION['suserid'] != $jb_mb_id) {
						$C_Func -> put_msg_and_back('작성회원만 글을 읽을 수 있습니다.');
						exit;
					}else{
						if(!$cdata) {	
							$C_Func ->	go_url("/v3/board.php?jb_code=".$jb_code."&idx=".$jb_idx."&mode=m");
						}
					}
				}
			}	
			
		$reg_date = date("Y.m.d", strtotime($jb_reg_date));
		$content	= $C_Func->dec_contents_edit($jb_content);
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
		if($cdata) {
			foreach($cdata as $k=>$v){
				$jbc_content = nl2br(strip_tags($v['jbc_content'], '<br>'));
					$cmt_info .= '<div class="answer">'.$jbc_content.'</div>';
			   } 
		}
		$tpl->assign(array(		
				'vtitle' 	=> $jb_title,
				'vttxt'  	=> $vttxt["jba_title"],
				'vdate' 	=> $reg_date,
				'vsee' 		=> $jb_see,
				'vcontent' 	=> $content,
				'vfile'		=> $file_info,
				'vcmt' 		=> $cmt_info
		));
					
		$skin = "view";
	//뷰	
	}else{
	//리스트	
		$args = "";
		if($_GET["sec"] && $jbcode=="40") $args['secret'] = $_GET["sec"];
		$args['jb_code'] = $jbcode;
		$args['stext'] = $stext;
		$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
		$data = "";
		$data = $C_JHBoard -> Search_New_BBS($args);	
		
		$psize = 10;
		$p=0;
		$mbtn = ($psize >= count($data)) ? " style='display:none;'" : "";
		for($i=0;$i<count($data);$i++) {
	
			$fread 		= "Y";
			$jb_idx 	= $data[$i]["jb_idx"];
			$jb_mb_id  	= $data[$i]["jb_mb_id"];
			$jb_code 	= $data[$i]["jb_code"];
			$title 		= $data[$i]["jb_title"];
			$title 		= preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $title);
			$secret		= $data[$i]["jb_secret_check"];
			$regDt 		= date("Y.m.d", strtotime($data[$i]['jb_reg_date']));
			$content			= $C_Func->dec_contents_edit($data[$i]['jb_content']);
			$content			= trim(strip_tags($content));
			$content 			= $C_Func->strcut_utf8($content, 100, true, "...");			
			$jb_comment_count 		= $C_Func->num_f($data[$i]['jb_comment_count']);		
			$treat_type = "기타";
			if($data[$i]['jb_treat'] != '' ) {				
				$treat_type = $GP -> CLINIC_TYPE_NEW[$data[$i]['jb_treat']];
			}		
			$sec = ($secret =="Y") ? '<span class="lock">비밀글</span>' : "";
			if(strlen($data[$i]["jb_name"]) > 6) {
				$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 6);
			}else{
				$jb_name 				=  $C_Func->blindInfo($data[$i]["jb_name"], 3);	
			}		
			
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
				$file_ext = substr( strrchr($ex_jb_file_code[0], "."),1); 
				$file_ext = strtolower($file_ext);	//확장자를 소문자로...
				
				if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png"){
					$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";
					$img_src = "<img src='" . $code_file. "' alt='" . $title. "' width='144' height='101'>";	
				}else{
					$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='144' height='101'>";		
				}
			}else{
				$img_src = "<img src='/images/common/nk_thumbnail.jpg' width='144' height='101'>";	
			}
			if($i%$psize == 0) $p++;
			if($p > 1) $style = 'style=display:none';
			
			if($secret == "Y" && $_SESSION['suserlevel'] < 9) {
				if($jb_mb_id != "") {
					if($_SESSION['suserid'] != $jb_mb_id) {
						$fread = "N";
					}
				}
			}else{
				$secret = "N";	
			}
			$args["jb_code"] = $jb_code;
			$bname = $C_JHBoard -> Board_Config_Data($args);		
			
			$answer = ($jb_comment_count > 0) ? '<span class="state com">완료</span>' : '<span class="state">대기</span>';
			
			$list[] = array(
					'jb_idx' 		 => $jb_idx,
					'jb_code'		 => $jb_code,
					'title'			 => $title,						
					'regDt' 		 => $regDt,
					'bname'			 => $bname["jba_title"],
					'img_src'		 => $img_src,						
					'style' 		 => $style,
					'p'				 => $p,
					'secret'		 => $secret,
					'fread'			 => $fread,
					'sec'			 => $sec,
					'treat_type'	 => $treat_type,												
					'jb_name'		 => $jb_name,
					'answer'		 => $answer,
					'content'		 => $content													
			);
		}
	
		$submenu = "N";
		$schmenu = "Y";
		if($jbcode == "news" || $jbcode == "80" || $jbcode == "140" || $jbcode == "90" || $jbcode == "10") {
			$skin = "list.thumb";
			$submenu = "Y";
		}else if($jbcode == "40" || $jbcode == "120" ) {	
			$skin = "list.list";
		}else if($jbcode == "20") {	
			$skin = "list.card";
			$schmenu = "N";		
			$psiz = 8;
		}else if($jbcode == "50") {
			$skin = "list.thumb";
		}
	}
}
if ($_SERVER['REMOTE_ADDR'] == '210.90.202.198') {
		$board_yn = 'Y';
	}	
$tpl->define("btop","inc/board.top.tpl");	
$tpl->define("main","board/".$skin.".tpl");

$tpl->assign(array(
	"list" 		=> $list,
	"jbcode"	=> $jbcode,
	"stext"		=> $stext,
	"ttxt"		=> $ttxt,	
	"mtxt"		=> $mtxt,	
	"btotal"	=> count($list),
	"mbtn"		=> $mbtn,
	"submenu"	=> $submenu,
	"schmenu"	=> $schmenu	,
	"board_yn"	=> $board_yn,
	'sec'		=> $_GET["sec"],
	'psize'		=> $psize
));

include $root_path."include/footer.php";
?>

