<?
	$treat_type = "기타";
	if($jb_treat != '' ) {
		$treat_type = $GP -> CLINIC_TYPE5[$jb_treat];
	}
?>
<fieldset>
	<legend>공지사항 상세</legend>
	<table width="100%" class="viewType">
		<caption>공지사항 상세</caption>
		<colgroup>
			<col width="55%" />
			<col width="25%" />
			<col width="20%" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="row" colspan="2">[<?=$treat_type?>] <?=$jb_title?></th>
				<td><?=$jb_reg_date?></td>
			</tr>
			<tr>
				<td>작성자 : <strong class="mg-l10"><?=$jb_name?>(<?=$jb_mobile?>)</strong></td>
				<td colspan="2">조회수 : <strong class="mg-l10"><?=$jb_see?></strong></td>
			</tr>
			<tr>
				<td colspan="3">
					<p class="viewIp"><?=$jb_reg_ip?></p>
					<div class="viewCont">
						<?=$content?>  
					</div>
					<div class="viewShare">
						
					</div>
				</td>
			</tr>
			<? if($jb_homepage != '') {?>
			<tr>
				<td colspan="3">
					<div class="viewLink">
						<span class="icon"></span>
						<a href="<?=$jb_homepage?>"><?=$jb_homepage?></a>
					</div>
				</td>
			</tr>
			<? } ?>
			<tr>
				<td colspan="3">
					<div class="viewFile">
						<?php							
						if($file_cnt > 0)
						{
							for($i=0; $i<$file_cnt; $i++)
							{
								if($ex_jb_file_name[$i])
								{		
									$code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";							
									echo "<p><span class='icon'></span>$ex_jb_file_name[$i]<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">저장</a></p>";																
								}	 
							}
						} else {
							echo "<p><span class='icon'></span> 첨부파일 없음</p>";
						}
						?>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="btnWrap mg-t20 mg-b20">
		<div class="btnL">
			<?php
        //글목록버튼
        echo "<a href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&${search_key}&search_keyword=${search_keyword}&page=${page}'\" title='목록보기'><span>목록</span></a>&nbsp;";						
			?>
		</div>
		<div class="btnR">			
		
			<?				
        //수정(쓰기권한이 있어야 수정 가능)
        if($check_level >= 9 || $check_id == $jb_mb_id)
            echo "<a href=\"#\" onclick=\"javascript:location.href='${get_par}&jb_mode=tmodify'\" title=\"수정\"><span>수정</span></a>&nbsp;";
        //삭제권한(쓰기권한이 있어야 삭제 가능)
        if($check_level >= 9 || $check_id == $jb_mb_id)
            echo "<a href=\"#\" onclick=\"javascript:location.href='${get_par}&jb_mode=tdelete'\" title=\"삭제\"><span>삭제</span></a>&nbsp;";					
			
        //쓰기권한
        if($check_level >= $db_config_data['jba_write_level'])
            echo "<a href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&jb_mode=twrite'\" title=\"쓰기\"><span>글쓰기</span></a>";						        
			?>			
		</div>
	</div>	
	
	<!-- 댓글 영역 -->
	<?php
  //공지글은 댓글 달수 없게... 2007-07-28
  if($jb_order >= 100 && $db_config_data['jba_comment_use'] == 'Y') {	
		echo "
			<div class=\"viewComment\">
				<ul>
		";
    #댓글 관련 스킨
    include $GP -> INC_PATH . "/action/comment.inc.php";		
		
		echo "</ul></div>";
  } //end_of_if($jb_order >= 100)
  ?>
		
	
	
</fieldset>