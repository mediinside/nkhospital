<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	$args = "";
//	$_REQUEST["idx"] = "1412";
	$args['jb_idx'] = $_REQUEST["idx"];
	$data = "";
	$data = $C_JHBoard -> Board_New_Read_Data($args);	
	$cdata = $C_JHBoard -> Comment_New_List($args);	
	extract($data);
	if($jb_secret_check == "Y" && $_SESSION['suserlevel'] < 9) {
		if($jb_mb_id == "") {
			if(!$_REQUEST["pd"]) {
				echo "<script>secret_check('".$_REQUEST["idx"]."')</script>"; 
				exit;	
			}	
			if(empty($_REQUEST["pd"]) || $_REQUEST["pd"] != $jb_password) {
				echo "<script>secret_false('비밀번호를 정확하게 입력해주세요')</script>"; 
				exit;
			}
		}else{
			if($_SESSION['suserid'] != $jb_mb_id) {
				echo "<script>secret_false('작성회원만 글을 읽을 수 있습니다. ')</script>"; 
				exit;
			}else{
				if(!$cdata) {	
				echo "<script>board_read('write','code=".$jb_code."&idx=".$jb_idx."&mode=mod')</script>"; 
				exit;
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
	$args['jb_code'] = $jb_code;	
	$bname = $C_JHBoard -> Board_Config_Data($args);
	
	switch($jb_code) {
		case "40" 	: $pg = "list.list"; break;
		case "120" 	: $pg = "list.list"; break;
		case "20" 	: $pg = "list.card"; break;		
		default     : $pg = "list.thumb"; break;			
	}
?> 
<br>
<div class="section boardView">
    <div class="viewHead">
        <h2 class="title"><?=$jb_title?></h2>
        <p class="info">
            <span><?=$bname["jba_title"]?></span>
            <span><?=$reg_date?></span>
            <span>조회 <?=$jb_see?></span>
        </p>
    </div>
    <div class="contents">
        <?=$content?>
		<?php							
        if($file_cnt > 0)
        {
            for($i=0; $i<$file_cnt; $i++)
            {
                if($ex_jb_file_name[$i])
                {		
                    $code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";							
                    echo "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">".$ex_jb_file_name[$i]."</a>";																
                }	 
            }
        }
        
		if($cdata) {
			foreach($cdata as $k=>$v){
				$jbc_content = nl2br(strip_tags($v['jbc_content'], '<br>'));
					echo '<div class="answer">'.$jbc_content.'</div>';
			   } 
		}
		?>
    </div>

    <div class="btnWrap">
        <span><a href="#" class="btnType1" onclick="javascript:go_list('<?=$pg?>','<?=$jb_code?>');">목록으로</a></span>
    </div>
</div>
<script>
	$(".contents").children("iframe").width('100%');
</script>