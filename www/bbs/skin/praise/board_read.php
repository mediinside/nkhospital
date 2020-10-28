<div class="tableType-01 red">
					<table width="100%" class="viewType">
						<caption style="display:none;">공지사항 상세</caption>
						<colgroup>
							<col width="33.33%" />
							<col width="33.33%" />
							<col width="33.33%" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row" colspan="3">뉴고려병원에 오신것을 환영합니다.</th>
							</tr>
							<tr>
								<td style="text-align:left;">작성자 : <strong class="mg-l10"><?=$jb_title?></strong></td>
								<td style="text-align:left;">조회수 : <strong class="mg-l10"><?=$jb_see?></strong></td>
								<td style="text-align:left;">작성일 : <strong class="mg-l10"><?=$jb_reg_date?></strong></td>
							</tr>
							<tr>
								<td style="text-align:left;" colspan="3">
									<div class="viewCont">
                                       <?=$content?>
									</div>
								</td>
							</tr>
							<?php if($jb_homepage) {?>
							<tr>
								<td style="text-align:left;" colspan="3">
									<div class="viewLink">
										<img src="/resource-pc/images/icon_link.png" height="17" alt="">&nbsp;
										<a href="<?=$jb_homepage?>"><?=$jb_homepage?></a>
									</div>
								</td>
							</tr>
							<?}?>		
							<!--						
							<?php if($file_cnt > 0) {?>
							<tr>
                                <td style="text-align:left;" colspan="3">
									<div class="viewFile">
							<?
							for($i=0; $i<$file_cnt; $i++)	{
										if($ex_jb_file_name[$i]) {
											//파일의 확장자
											
											$file_ext = substr( strrchr($ex_jb_file_name[$i], "."),1); 
											$file_ext = strtolower($file_ext);	//확장자를 소문자로...                                               	
											
											if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png" || $file_ext=="bmp") {	
																			
												echo "<a  class='file'  href='" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_${jb_code}/${ex_jb_file_code[$i]}' target='_blank'>";
												echo "<img src=\"" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_" . $jb_code . "/" . $ex_jb_file_code[$i] ."\" class='imgResponsive'>";
												echo "</a>";
											}
											else{
												$code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";
												echo "<p><img src='/resource-pc/images/down-02.png' alt=''>&nbsp;<a class='file' href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">$ex_jb_file_name[$i]</a></p>";

											}
										}	 
									}
							?>
									</div>
								</td>
							</tr>
							<?}?>
							-->									
								
						</tbody>
					</table>
					<div id="btn-box" class="right">
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
						<a href="<?=$get_par1?>" class="btn bg-green">이전글</a>
						<a href="<?=$get_par2?>" class="btn bg-green">다음글</a>
						<a href="#none" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tdelete'"  class="btn bg-red" title="삭제">삭제</a>
						<a href="#\" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tmodify'"  class="btn bg-deepblue" title="수정">수정</a>
						<a href="<?=$index_page?>?jb_code=<?=$jb_code?>&<?=$search_key?>&search_keyword=<?=$search_keyword?>&page=<?=$page?>" class="btn bg-orange">목록</a>
					</div>
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
							