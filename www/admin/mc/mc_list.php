<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.machine.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Machine 	= new Machine;
	$C_Button 		= new Button;
	
	//error_reporting(E_ALL);
	//@ini_set("display_errors", 1);

	$args = array();
	$args['show_row'] = 5;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Machine->Machine_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);

	
	$cn_select = $C_Func -> makeSelect_Normal('tmc_type', $GP -> HOSPITAL_TYPE1, $tmc_type, '', '::선택::');	
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<!--? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?-->										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				
					<strong class="tit">등록일</strong>
					<span><input type="text" name="s_date" id="s_date" value="<?=$_GET['s_date']?>" class="input_text" size="13"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="13" /></span>
				
				<li>
					<strong class="tit">검색조건</strong>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="tmc_title" <? if($_GET['search_key'] == "tmc_title"){ echo "selected";}?> >장비명</option>
						<!-- option value="tmc_model" <? if($_GET['search_key'] == "tmc_model"){ echo "selected";}?> >모델명</option -->
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="16" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
					<span><button id="depth_submit" class="btnSearch ">순위변경</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>		
		<div class="btnWrap">
			<!-- p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p -->
			<button onClick="layerPop('ifm_reg','./mc_reg.php', '100%', 600)"; class="btnSearch btnRight">장비 등록</button>
		</div>
    
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<colgroup>
							<col />
							<col />
							<col />							
							<col style="width:300px;" />
							<col />
							<col style="width:101px;" />
						</colgroup>
						<thead>
							<tr>
								<th>No</th>
								<th>모델명</th>
								<!-- th>모델명</th -->
								<th>이미지</th>
								<th>내용</th>
								<th>등록일</th>																
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['tmc_desc']?>" />
							<?
								$dummy = $data_list_cnt;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$tmc_idx 			= $data_list[$i]['tmc_idx'];
									$tmc_title			= $data_list[$i]['tmc_title'];
									$tmc_model		= $data_list[$i]['tmc_model'];
									$tmc_content		= $C_Func->strcut_utf8($data_list[$i]['tmc_content'], 300, true, "...");
									$tmc_img			= $data_list[$i]['tmc_img'];
									$tmc_desc		= $data_list[$i]['tmc_desc'];
									$tmc_regdate 	= $data_list[$i]['tmc_regdate'];
									
									$mc_img = '';
									if($tmc_img !=  '') {
										$mc_img = "<img src='" . $GP -> UP_MACHINE_URL . $tmc_img . "' width='100px' />";
									}									
									
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./mc_edit.php?tmc_idx=" . $tmc_idx. "', '100%', 600)", 50,'');	
									$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"mc_delete('" . $tmc_idx. "')", 50,'');									
								?>
										<tr id="<?=$tmc_idx?>">											
											<td><?=$data['page_info']['start_num']--?></td>
											<td><?=$tmc_title?></td>
											<!-- td><?=$tmc_model?></td -->
											<td><?=$mc_img?></td>
											<td><?=$tmc_content?></td>
											<td><?=$tmc_regdate?></td>
											<td><?=$edit_btn?></td>
										</tr>
										<?
									$dummy--;
								}
								?>						
						</tbody>
					</table>
          
         
				</div>			
			</div>
			<? if($_GET['row'] != "all") { ?>
			<ul class="boxBoardPaging">
				<?=$page_link?>
			</ul>
			<? } ?>
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->


</body>
</html>

 
<script type="text/javascript">

	
		
	$(document).ready(function(){
		/*
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
		
		var cl_id = "";
		var ch_id = "";
		$(".boxMemberBoard tbody").sortable({
			helper: fixHelper,
			start: function( event, ui ) {
				cl_id = ui.item.attr('id');
			},	
			stop: function( event, ui ) {
				var tot_num = ui.item.parent().find('tr').length;
				var tmp_id = "";
				for(i=0;  i< tot_num; i++){
					var val = ui.item.parent().find("tr:eq(" + i + ")").attr('id');
					tmp_id += val + ",";
				 }
				 tmp_id = tmp_id.slice(0,-1);

				 var max_desc = $('#max_desc').val();
				 console.log(tmp_id);
				 console.log(max_desc);
				
				
				$.ajax({
					type: "POST",
					url: "./proc/mc_proc.php",
					data: "mode=MC_AUTO_CH&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
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
				
			},
		}).disableSelection();
		*/
		
		
		

														 
	
		callDatePick('s_date');
		callDatePick('e_date');

		$('#depth_submit').click(function(){
			layerPop('ifm_reg','./mc_depth.php', '100%', 900);
			return false;
			/*
			var tmc_type = $('#tmc_type option:selected').val();
			var s_date = $('#s_date').val();
			var e_date = $('#e_date').val();
			var search_key = $('#search_key option:selected').val();
			var search_content = $('#search_content').val();
			location.href = "?row=all&s_date=" + s_date + "&e_date=" + e_date + "&tmc_type=" + tmc_type + "&search_key=" + search_key + "&search_content=" + search_content;
			return false;
			*/
		});

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
	
	function desc_idx(type, idx, num) {
		
		$.ajax({
			type: "POST",
			url: "./proc/dt_proc.php",
			data: "mode=DT_DESC&type=" + type + "&dr_idx=" + idx+ "&desc=" + num,
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

	function mc_delete(tmc_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/mc_proc.php",
			data: "mode=MC_DEL&tmc_idx=" + tmc_idx,
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