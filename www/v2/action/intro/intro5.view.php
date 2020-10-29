<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	$args = "";
	$args['jb_idx'] = $_REQUEST["idx"];
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
	$args['jb_code'] = $jb_code;	
	$bname = $C_JHBoard -> Board_Config_Data($args);
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
        ?>        
    </div>

    <div class="btnWrap">
        <span><a href="#" class="btnType1" onClick="javascript:intro_load('intro5','tab=intro5');">목록으로</a></span>
    </div>
</div>