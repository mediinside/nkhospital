<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>진료과 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?">
		<input type="hidden" name="mode" id="mode" value="TREAT_REG" />
		<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_SESSION['adminhpidx']?>" />
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