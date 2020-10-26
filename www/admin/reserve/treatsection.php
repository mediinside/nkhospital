<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.reserve.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Reserve 	= new Reserve;
	$C_Button 		= new Button;	
	
	
	$args = array();
	$args['show_row'] = 5;
	$args['pagetype'] = "admin";
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$data = "";
	$data = $C_Reserve->TreatSection_List(array_merge($_GET,$_POST,$args));
	
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
						<option value="ts_name" <? if($_GET['search_key'] == "ts_name"){ echo "selected";}?> >과명</option>
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
		<button onClick="layerPop('ifm_reg','./treatsection_reg.php', 400, 150)"; class="btnSearch ">진료과 등록</button>
		</div>
		
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<td width="1">|</td>
								<th>과명</th>
								<td width="1">|</td>
								<th>등록일</th>
								<td width="1">|</td>
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
							$dummy = 1;
							for ($i = 0 ; $i < $data_list_cnt ; $i++) {
								$ts_idx 	= $data_list[$i]['ts_idx'];
								$hp_idx 	= $data_list[$i]['hp_idx'];
								$ts_name	= $data_list[$i]['ts_name'];	
								$ts_regdate	= date("Y.m.d", strtotime($data_list[$i]['ts_regdate']));
								
								$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./treatsection_edit.php?hp_idx=" . $hp_idx. "&ts_idx=" . $ts_idx. "', 400, 150)", 50,'');	
								$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"treat_delete('" . $ts_idx. "')", 50,'');							
							?>
							<tr>
								<td><?=$data['page_info']['start_num']--?></td>
								<td></td>
								<td><?=$ts_name?></td>
								<td></td>
								<td><?=$ts_regdate?></td> 
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

	function treat_delete(ts_idx)
	{
		if(!confirm("상품정보와 옵션 설정 및 연관 정보가 모두 삭제 됩니다. 삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/reserve_proc.php",
			data: "mode=TREAT_DEL&ts_idx=" + ts_idx,
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
</script>


<