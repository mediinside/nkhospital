<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS."/class.reserve.php");	
	$C_Reserve 	= new Reserve;	
	
	$args = "";
	$args['hp_idx'] 	= $_GET['hp_idx'];
	$args['ts_idx'] 	= $_GET['ts_idx'];
	$rst = $C_Reserve ->Treat_Info($args);
	
	if($rst) {
		extract($rst);
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>진료과 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?">
		<input type="hidden" name="mode" id="mode" value="TREAT_MODI" />
		<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_GET['hp_idx']?>" />
		<input type="hidden" name="ts_idx" id="ts_idx" value="<?=$_GET['ts_idx']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"><span>*</span>진료과</th>
							<td width="80%">
								<input type="text" class="input_text" size="25" name="ts_name" id="ts_name" value="<?=$ts_name?>" />
							</td>
						</tr>
					</tbody>
				</table>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">수정</button>
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
														 
		$('#img_submit').click(function(){
			
			if($('#ts_name').val() == '') {
				alert("진료과명을 입력하세요");
				$('#ts_name').focus();
				return false;
			}
			
			$('#base_form').attr('action','./proc/reserve_proc.php');
			$('#base_form').submit();
			return false;
		});		
	});
</script>