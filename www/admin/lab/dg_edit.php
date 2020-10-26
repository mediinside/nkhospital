<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS."/class.doctor.php");
	$C_Doctor 	= new Doctor;
	
	$args = "";
	$args['drl_idx'] 	= $_GET['drl_idx'];
	$rst = $C_Doctor ->DRL_Info($args);
	
	if($rst) {
		extract($rst);	
		$dr_history  = $C_Func->dec_contents_edit($dr_history);		
		$dr_history1  = $C_Func->dec_contents_edit($dr_history1);		
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>치료진 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="DRL_MODI" />
		<input type="hidden" name="drl_idx" id="drl_idx" value="<?=$_GET['drl_idx']?>" />
		<input type="hidden" name="before_image_main" id="before_image_main" value="<?=$drl_face_img?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
			<div class="layerTable">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="15%"><span>*</span>성명</th>
							<td width="85%">
								<input type="text" class="input_text" size="25" name="drl_name" id="drl_name" value="<?=$drl_name?>" />
							</td>
						</tr>
						<tr>
							<th><span>*</span>대표이미지</th>
							<td>
								<input type="file" name="drl_face_img" id="drl_face_img" size="30">(420 X 500)
								<?
									if($drl_face_img != "") {
										echo  "<br>" . $drl_face_img;
								?>
									<a href="#" onClick="img_del('<?=$drl_face_img;?>','<?=$_GET['drl_idx']?>','M')">(X)</a>
								<? } ?>
							</td>
						</tr>	
						<tr>
							<th><span>*</span>대표약력</th>
							<td>
								<textarea name="drl_history" id="drl_history" style="width:98%; height:100px; overflow:auto;" ><?=$drl_history?></textarea>
							</td>
						</tr>	
            <tr>
							<th><span>*</span>자격 및 연수</th>
							<td>
								<textarea name="drl_history1" id="drl_history1" style="width:98%; height:100px; overflow:auto;" ><?=$drl_history1?></textarea>
							</td>
						</tr>		
						<tr>
							<th><span>*</span>공개여부</th>
							<td>
								<input type="radio" name="drl_main_view" value="Y" <? if($drl_main_view == "Y") { echo "checked"; }?> />공개
								<input type="radio" name="drl_main_view" value="N" <? if($drl_main_view == "N") { echo "checked"; }?> />비공개
							</td>
						</tr>	
					</tbody>
				</table>
			</div>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">수정</button>
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
	
	function img_del(image, idx, type)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/dt_proc.php",
			data: "mode=DRL_IMGDEL&drl_idx=" + idx + "&file=" + image + "&type=" + type,
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
		
		$('#img_submit').click(function(){
				
				if($('#drl_name').val() == '') {
					alert('성명을 입력하세요');
					$('#drl_name').focus();
					return false;
				}

							
				if($('#drl_history').val() == '') {
					alert('주요경력을 입력하세요');
					$('#drl_history').focus();
					return false;
				}	
				
				$('#base_form').attr('action','./proc/dt_proc.php');
				$('#base_form').submit();
				return false;							
		});
	});
</script>
