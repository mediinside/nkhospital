<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>장비 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="MC_REG" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th width="15%"><span>*</span>장비명</th>
								<td width="85%">
									<input type="text" class="input_text" size="70" name="tmc_title" id="tmc_title" />(ex : MRI)
								</td>
							</tr> 							          							
							<!-- tr>
								<th><span>*</span>모델명</th>
								<td>
									<input type="text" class="input_text" size="70" name="tmc_model" id="tmc_model" />(ex : GE-Discovery MR750w 3.0T)
								</td>
							</tr -->
							<tr>
								<th><span>*</span>내용</th>
								<td>
									<textarea name="tmc_content" id="tmc_content" style="width:98%; height:100px;  overflow:auto;" ></textarea>
								</td>
							</tr>
							<tr>
								<th><span>*</span>이미지</th>
								<td>
									<input type="file" name="tmc_img" id="tmc_img" size="30" class="input_text">(358 X 268)
								</td>
							</tr>							
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
					<span class="btnRight">
						<button id="img_submit" class="btnSearch ">등록</button>
						<button id="img_cancel" class="btnSearch ">취소</button>
					</span>
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

			if($('#tmc_type option:selected').val() == '') {
				alert('병원구분을 선택하세요');
				return false;
			}	
	
			if($('#tmc_title').val() == '') {
				alert('장비명을 입력하세요');
				$('#tmc_title').focus();
				return false;
			}		
			
			/*
			if($('#tmc_model').val() == '') {
				alert('모델명을 입력하세요');
				$('#tmc_model').focus();
				return false;
			}
			*/
			
			if($('tmc_content').val() == '') {
				alert('내용을 입력하세요');
				$('tmc_content').focus();
				return false;
			}
			
			
			if($('#tmc_img').val() == '') {
				alert('이미지를 선택하세요');
				$('#tmc_img').focus();
				return false;
			}
			
			
			$('#base_form').attr('action','./proc/mc_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>