<div class="boardList wd-1200">
    <div class="board-view">
	<div class="header">
		<h4 class="subject"><?=$jb_title?></h4>
		<dl class="info">
            <dt>구분:</dt>
            <dd><?=$db_config_data["jba_title"]?></dd>
            <dt>조회수:</dt>
            <dd><?=$jb_see?></dd>
            <dt>작성자:</dt>
            <dd><?=$jb_name?></dd>
            <dt>날짜:</dt>
            <dd><?=$jb_reg_date?></dd>
		</dl>
	</div>
	<div class="contents fontsize-convert" style="text-align:center;">
	<?php								
			if($file_cnt > 0) {
				for($i=0; $i<$file_cnt; $i++)	{
					if($ex_jb_file_name[$i]) {
						//파일의 확장자
						$file_ext = substr( strrchr($ex_jb_file_name[$i], "."),1); 
						$file_ext = strtolower($file_ext);	//확장자를 소문자로...
						
						if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png" || $file_ext=="bmp") {										
							/*echo "<a href='" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_${jb_code}/${ex_jb_file_code[$i]}' target='_blank'>";
							echo "<img src=\"" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_" . $jb_code . "/" . $ex_jb_file_code[$i] ."\" class='imgResponsive'>";
							echo "</a><br>";*/
						}
					}	 
				}
			}
		?>
        <?=$content?>
    </div>
	<div class="btn-group mg-t20">
		<div class="btn-rt">
            <a href="<?=$index_page?>?jb_code=<?=$jb_code?>&<?=$search_key?>&search_keyword=<?=$search_keyword?>&page=<?=$page?>" class="btn btn-normal" title="목록으로">목록으로</a>
        </div>
		<?if($check_level >= 9) {?>
        <div class="btn-lt">
            <a href="#none" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tdelete'"  class="btn btn-cancel" title="삭제">삭제</a>
        </div>
		
        <div class="btn-lt">
            <a href="#\" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tmodify'"  class="btn btn-point" title="수정">수정</a>
        </div>

        <div class="btn-lt">
            <a href="#\" onclick="javascript:location.href='<?=$get_par?>&jb_mode=treply'"  class="btn btn-point" title="답글">답글</a>
        </div>
		 <? } ?>
    </div>
    <?php
        if($be_idx == '') {
            $get_par1 = "javascript:void(0)";
            $be_content = "이전 게시물이 없습니다";
        }
        if($af_idx == '') {
            $get_par2 = "javascript:void(0)";
            $af_content = "다음 게시물이 없습니다";
        }
    ?>   
	<ul class="board-view-list">
		<li>
			<a href="<?=$get_par1?>"><strong>이전</strong><span><?=$be_content?></span></a>
		</li>
		<li>
			<a href="<?=$get_par2?>"><strong>다음</strong><span><?=$af_content?></span></a>
		</li>
	</ul>
</div>
</div>