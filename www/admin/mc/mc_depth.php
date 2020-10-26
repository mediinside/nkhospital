<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS."/class.machine.php");
	$C_Machine 	= new Machine;
	
	
	$args = '';
	$args['tmc_type'] = $tmc_type;
	$data_list = $C_Machine ->MC_Depth_All($args);
	$data_list_cnt = count($data_list);

	$cn_select3 = $C_Func -> makeSelect_Normal('tmc_type', $GP -> HOSPITAL_TYPE1, $tmc_type, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>순위변경</strong></span>
		</div>
		
		<div class="boxContentBody">
			<div class="boxBoardHead" style="margin:0 0 -1px 20px;">
				<ul>
					<?
						foreach($GP -> HOSPITAL_TYPE1 as $key => $val) {
							$cls='';
							if($dr_location == $key) {
								$cls = ' class="active" ';
							}
					?>
					<li><a href="?tmc_type=<?=$key?>" <?=$cls ?>><?=$val?></a></li>
					<?
						}
					?>
				</ul>
			</div>
			<div class="layerTable">
			<p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p>
			<div class="boxMemberBoard">
				<table class="table table-bordered">
					<colgroup>
						<col />
						<col />
						<col />
						<col />						
					</colgroup>
					<thead>
						<tr>
							<th>No</th>							
							<th>장비명</th>							
							<th>내용</th>
							<th>등록일</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['dr_desc']?>" />
						<?
						$dummy = $data_list_cnt;
						for ($i = 0 ; $i < $data_list_cnt ; $i++) {
							$tmc_idx 			= $data_list[$i]['tmc_idx'];
							$tmc_type			= $data_list[$i]['tmc_type'];
							$tmc_title			= $data_list[$i]['tmc_title'];
							$tmc_model		= $data_list[$i]['tmc_model'];
							$tmc_content		= $C_Func->strcut_utf8($data_list[$i]['tmc_content'], 80, true, "...");
							$tmc_img			= $data_list[$i]['tmc_img'];
							$tmc_desc		= $data_list[$i]['tmc_desc'];
							$tmc_regdate 	= $data_list[$i]['tmc_regdate'];
						?>
						<tr id="<?=$tmc_idx?>">											
							<td><?=$dummy?></td>							
							<td><?=$tmc_title?></td>
							<!-- td><?=$tmc_model?></td -->
							<td><?=$tmc_content?></td>
							<td><?=$tmc_regdate?></td>
						</tr>
						<?
							$dummy--;
						}
						?>
					</tbody>
				</table>
			</div>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_cancel" class="btnSearch " onClick="javascript:parent.modalclose();">닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
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
	});
</script>
</body>
</html>

