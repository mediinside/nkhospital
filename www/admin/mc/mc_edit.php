<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	

	include_once($GP -> CLS."/class.machine.php");
	$C_Machine 	= new Machine;
	
	$args = "";
	$args['tmc_idx'] 	= $_GET['tmc_idx'];
	$rst = $C_Machine ->MC_Info($args);
	
	if($rst) {
		extract($rst);
		$tmc_content  = $C_Func->dec_contents_edit($tmc_content);			
		$tmc_title  = stripslashes($tmc_title);			
		$tmc_model  = stripslashes($tmc_model);				

	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>장비 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="MC_MODI" />
		<input type="hidden" name="tmc_idx" id="tmc_idx" value="<?=$_GET['tmc_idx']?>" />
        <input type="hidden" name="before_image_main" id="before_image_main" value="<?=$tmc_img?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>	
							<tr>
								<th width="15%"><span>*</span>장비명</th>
								<td width="85%">
									<input type="text" class="input_text" size="70" name="tmc_title" id="tmc_title" value="<?=$tmc_title?>" />(ex : MRI)
								</td>
							</tr> 							          							
							<!-- tr>
								<th><span>*</span>모델명</th>
								<td>
									<input type="text" class="input_text" size="70" name="tmc_model" id="tmc_model" value="<?=$tmc_model?>"  />(ex : GE-Discovery MR750w 3.0T)
								</td>
							</tr -->
							<tr>
								<th><span>*</span>내용</th>
								<td>
									<textarea name="tmc_content" id="tmc_content" style="width:98%; height:100px;  overflow:auto;" ><?=$tmc_content?></textarea>
								</td>
							</tr>
							<tr>
								<th><span>*</span>이미지</th>
								<td>
									<input type="file" name="tmc_img" id="tmc_img" size="30" class="input_text">(358 X 268)
									<?
									if($tmc_img != "") {
										echo  "<br>" . $tmc_img;
									?>
									<a href="#" onClick="img_del('<?=$tmc_img;?>','<?=$_GET['tmc_idx']?>')">(X)</a>
									<? } ?>
								</td>
							</tr>							
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
					<span class="btnRight">
						<button id="img_submit" class="btnSearch ">수정</button>
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
	
	function img_del(image, idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/mc_proc.php",
			data: "mode=MC_IMGDEL&tmc_idx=" + idx + "&file=" + image,
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
			
	
			
			$('#base_form').attr('action','./proc/mc_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>