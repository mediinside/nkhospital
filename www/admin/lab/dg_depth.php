<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.doctor.php");
	$C_ListClass 	= new ListClass;
	$C_Doctor 	= new Doctor;
	
	
	$args = '';
	$data_list = $C_Doctor ->DG_Depth_All($args);
	$data_list_cnt = count($data_list);
	
	$sel_loc	= $C_Func -> makeSelect_Normal('drl_loc', $GP -> LOC_TYPE, $drl_loc, '', '::선택::');
	$sel_position	= $C_Func -> makeSelect_Normal('drl_position', $GP -> DOCTOR_GR_TYPE, $drl_position, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>순위변경</strong></span>
		</div>
		
		<div class="boxContentBody">
			<div class="layerTable">
			<p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p>
			<div class="boxMemberBoard">
				<table class="table table-bordered">
					<colgroup>
						<col />
						<col />
						<col />
						<col />
						<col />
						<col />
					</colgroup>
					<thead>
						<tr>
                        	
                            <th>Rank</th>
							<th>이름</th>
							<th>등록일</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['drl_desc']?>" />
						<?
						//$dummy = $data_list_cnt;
						$dummy = "1";
						for ($i = 0 ; $i < $data_list_cnt ; $i++) {
							$drl_idx 		= $data_list[$i]['drl_idx'];
							$drl_name		= $data_list[$i]['drl_name'];
							$drl_desc		= $data_list[$i]['drl_desc'];
							$drl_regdate 	= $data_list[$i]['drl_regdate'];
						?>
						<tr id="<?=$drl_idx?>">										
							<td><?=$dummy?></td>
							<td><?=$drl_name?></td>
							<td><?=$drl_regdate?></td>
						</tr>
						<?
							$dummy++;
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
					url: "./proc/dt_proc.php",
					data: "mode=DTG_AUTO_CHAGE&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
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

