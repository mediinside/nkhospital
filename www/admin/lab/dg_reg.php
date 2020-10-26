<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	

?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>치료진 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="DRL_REG" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th width="15%"><span>*</span>성명</th>
								<td width="85%">
									<input type="text" class="input_text" size="25" name="drl_name" id="drl_name"  />
								</td>
							</tr>									
							<tr>
								<th><span>*</span>대표이미지</th>
								<td>
									<input type="file" name="drl_face_img" id="drl_face_img" size="30">(420 X 500)
								</td>
							</tr>	
							<tr>
								<th><span>*</span>대표약력</th>
								<td>
									<textarea name="drl_history" id="drl_history" style="width:98%; height:100px;  overflow:auto;" ></textarea>
								</td>
							</tr>		
							<tr>
								<th><span>*</span>자격 및 연수</th>
								<td>
									<textarea name="drl_history1" id="drl_history1" style="width:98%; height:100px; overflow:auto;" ></textarea>
								</td>
                             </tr>   
							<tr>
								<th><span>*</span>공개여부</th>
								<td>
									<input type="radio" name="drl_main_view" value="Y"  checked/>공개
									<input type="radio" name="drl_main_view" value="N"  />비공개
								</td>
							</tr>	
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
				<button id="img_submit" class="btnSearch ">등록</button>
				<button id="img_cancel" class="btnSearch " onClick="javascript:parent.modalclose();">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<script type="text/javascript">

	$(document).ready(function(){	
		
		$('#img_submit').click(function(){
				
				if($('#dr_name').val() == '') {
					alert('성명을 입력하세요');
					$('#dr_name').focus();
					return false;
				}
				

				if($('#dr_history').val() == '') {
					alert('대표약력을 입력하세요');
					$('#dr_history').focus();
					return false;
				}
				
				$('#base_form').attr('action','./proc/dt_proc.php');
				$('#base_form').submit();
				return false;							
		});
	});
</script>
