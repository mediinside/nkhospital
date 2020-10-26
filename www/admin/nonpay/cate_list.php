<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP->CLS."class.nonpay.php");
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Nonpay 	= new Nonpay;
	$C_Button 		= new Button;
	
	$args = array();
	$args['show_row'] = 20;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Nonpay->NonPay_Cate_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?>										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				<li>
					<span style="padding-right:42px; line-height:24px;">등록일</span>
					<span><input type="text" name="s_date" id="s_date" value="<?=$_GET['s_date']?>" class="input_text" size="20"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="20" /></span>
				</li>				
				<li>
					<span style="padding-right:31px;">검색조건</span>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="npc_name" <? if($_GET['search_key'] == "npc_name"){ echo "selected";}?> >카테고리명</option>
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="30" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>		
		<div style="margin-top:5px; text-align:right;">
		<button onClick="layerPop('ifm_reg','./cate_reg.php', 500, 250)"; class="btnSearch ">카테고리 등록</button>
		</div>
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<td width="1">|</td>
								<th>카테고리명</th>
								<td width="1">|</td>
								<th>등록일</th>
								<td width="1">|</td>
								<th>순서</th>
								<td width="1">|</td>	
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$npc_idx 			= $data_list[$i]['npc_idx'];
									$npc_name 			= $data_list[$i]['npc_name'];
									$npc_regdate 		= $data_list[$i]['npc_regdate'];
									$npc_desc 				= $data_list[$i]['npc_desc'];
									
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./cate_edit.php?npc_idx=" . $npc_idx. "', 800, 250)", 50,'');	
									$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"cate_delete('" . $npc_idx. "')", 50,'');							
								?>
										<tr>
											<td><?=$data['page_info']['start_num']--?></td>
											<td></td>
											<td><?=$npc_name?></td>
											<td></td>
											<td><?=$npc_regdate?></td>
											<td></td>								
											<?
												if($i == 0) {
											?>
											<td><a href="javascript:;" onClick="desc_idx('asc','<?=$npc_idx?>','<?=$npc_desc?>')">▼</a></td>
											<?
												}else if ($i == $data_list_cnt-1) {
											?>
											<td><a href="javascript:;" onClick="desc_idx('desc','<?=$npc_idx?>','<?=$npc_desc?>')">▲</a></td>
											<?
												}else{
											?>
											<td>
												<a href="javascript:;" onClick="desc_idx('desc','<?=$npc_idx?>','<?=$npc_desc?>')">▲</a> | <a href="javascript:;" onClick="desc_idx('asc','<?=$npc_idx?>','<?=$npc_desc?>')">▼</a>
											</td>
											<?
												}
											?>
											<td></td>																																
											<td><?=$edit_btn?></td>
										</tr>
										<?
									$dummy++;
								}
								?>						
						</tbody>
					</table>
				</div>			
			</div>
			<ul class="boxBoardPaging">
				<?=$page_link?>
			</ul>
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->
</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){														 
	
		callDatePick('s_date');
		callDatePick('e_date');

		$('#search_submit').click(function(){																			 

			if($.trim($('#search_content').val()) != '')
			{
				if($('#search_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#search_key option:selected').val() != '')
			{
				if($.trim($('#search_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#search_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
		});

	});

	function cate_delete(npc_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/nonpay_proc.php",
			data: "mode=CATE_DEL&npc_idx=" + npc_idx,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
					alert('삭제에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});

	}
	
	function desc_idx(type, idx, num) {
		
		$.ajax({
			type: "POST",
			url: "./proc/nonpay_proc.php",
			data: "mode=CATE_DESC&type=" + type + "&npc_idx=" + idx+ "&desc=" + num,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("변경되었습니다.");
					window.location.reload();
					return false;
				}else{
					alert('변경에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});
	}
</script>