<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	$clinic_select = $C_Func -> makeSelect_Normal('dr_clinic1', $GP -> CLINIC_TYPE_NEW, $dr_clinic1, '', '::선택::');
	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>태그 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="TIME_REG" />
        <input type="hidden" name="trs_reg_id" id="trs_reg_id" value="<?=$_SESSION['adminid']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th width="15%"><span>*</span>센터구분</th>
								<td width="85%">
									<?=$clinic_select?>
								</td>
							</tr> 							          							
							<tr>
								<th><span>*</span>분</th>
								<td>
									<input type="text" class="input_text" onKeyPress="return numkeyCheck(event)" size="5" name="trs_time_gap" id="trs_time_gap" /> 분 간격
								</td>
							</tr>								
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
					<button id="img_submit" class="btnSearch ">등록</button>
					<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){	
														 
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		$('#trs_time_gap').keypress(function (event) { if (event.which && (event.which <= 47 || event.which >= 58) && event.which != 8) { event.preventDefault(); } });
		
		
		$('#img_submit').click(function(){
			
			if($('#dr_clinic1 option:selected').val() == '') {
				alert("센터구분을 선택하세요");
				return false;
			}			
			
	
			if($('#trs_time_gap').val() == '') {
				alert('시간을 입력하세요');
				$('#trs_time_gap').focus();
				return false;
			}		

			
			$('#base_form').attr('action','./proc/online_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>