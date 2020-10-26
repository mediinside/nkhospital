<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP -> CLS."/class.reserve.php");	
	$C_Reserve 	= new Reserve;
	
	
	$args = '';
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$rst = $C_Reserve -> TrestSection_All($args);
	
	if(!$rst) {
		$C_Func->put_msg_and_modalclose("진료과 정보를 먼저 등록하세요.");
	}
	
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $ts_idx, "class='select_type1'", "::: 선택 :::");	
	$sel_cappa = $C_Func ->makeSelect_Normal("pd_capanum", $GP -> RESERVE_CAPPA_TYPE, $pd_capanum, "class='select_type1'", "::: 선택 :::");
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>진료 상품 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?">
		<input type="hidden" name="mode" id="mode" value="TREATPRODUCT_REG" />
		<input type="hidden" name="ts_idx" id="ts_idx" value="<?=$_GET['ts_idx']?>" />
		<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_SESSION['adminhpidx']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"><span>*</span>진료과</th>
							<td width="80%">
								<?=$sel_treat?>
							</td>
						</tr>
						<tr>
							<th ><span>*</span>상품명</th>
							<td>
								<input type="text" class="input_text" size="30" name="pd_name" id="pd_name"  />
							</td>
						</tr>
						<tr>
							<th ><span>*</span>상품캡파</th>
							<td>
								<?=$sel_cappa?>
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
			
			if($('#ts_idx option:selected').val() == '') {
				alert("진료과를 선택하세요");
				return false;
			}
			
			if($('#pd_name').val() == '') {
				alert("상품명을 입력하세요");
				$('#pd_name').focus();
				return false;
			}
			
			if($('#pd_capanum option:selected').val() == '') {
				alert("캡파를 선택하세요");
				return false;
			}
			
			$('#base_form').attr('action','./proc/reserve_proc.php');
			$('#base_form').submit();
			return false;
		});	
	});
</script>