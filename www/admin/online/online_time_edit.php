<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> INC_ADM_PATH."inc.adm_auth.php");
	include_once($GP -> CLS."/class.online.php");
	$C_Online 		= new Online;
	
	$args = '';
	$args['trs_idx'] = $_GET['trs_idx'];
	$data = $C_Online->ReserveSch_Info($args);   
	
	if($data) {
		extract($data);		
	}	
//	$clinic_select = $C_Func -> makeSelect_Normal('dr_clinic1', $GP -> CLINIC_TYPE_NEW, $dr_clinic1, '', '선택');	
	
?>

<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>온라인  예약 처리</strong></span>
		</div>
		 <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="ONLINE_TIME_MODI" />
            <input type="hidden" name="trs_idx" id="trs_idx" value="<?=$_GET['trs_idx']?>" />
            <input type="hidden" name="trs_mod_id" id="trs_mod_id" value="<?=$_SESSION['adminid']?>" />
            <input type="hidden" name="dr_clinic1" id="dr_clinic1" value="<?=$dr_clinic1?>" />
		<div class="boxContentBody">
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
						<tbody>
							<tr>
								<th width="15%"><span>*</span>센터구분</th>
								<td width="85%">
									<?= $GP -> CLINIC_TYPE_NEW[$dr_clinic1];?>
								</td>
							</tr> 						          							
							<tr>
								<th><span>*</span>분</th>
								<td>
									<input type="text" class="input_text" size="5" onKeyPress="return numkeyCheck(event)" name="trs_time_gap" id="trs_time_gap" value="<?=$trs_time_gap?>" /> 분 간격
								</td>
							</tr>								
						</tbody>
					</table>
                <div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">답변</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script src="/admin/js/jquery.alphanumeric.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		
		$('#trs_time_gap').keypress(function (event) { if (event.which && (event.which <= 47 || event.which >= 58) && event.which != 8) { event.preventDefault(); } });

		
		$('#img_submit').click(function(){
				
				if($('#dr_clinic1 option:selected').val() == '') {
					alert('센터를 선택하세요');
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
