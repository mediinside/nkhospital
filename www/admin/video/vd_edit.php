<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS."/class.doctor.php");
	include_once($GP -> CLS."/class.video.php");	
	$C_Doctor 	= new Doctor;
	$C_Video 	= new Video;	
	
	$args = "";
	$args['vd_idx'] 	= $_GET['vd_idx'];
	$rst = $C_Video ->Video_Info($args);
	if($rst) {
		extract($rst);
		$cnk_arr1 = explode(',', $vd_clinic1);
		$cnk_arr2 = explode(',', $vd_clinic2);
		$cnk_arr3 = explode(',', $vd_clinic3);
	
		$cn_chk1 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_CENTER, 'vd_clinic1[]', $cnk_arr1, '', '130');
		$cn_chk2 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_CLINIC, 'vd_clinic2[]', $cnk_arr2, '', '130');
		$cn_chk3 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_SPECIAL, 'vd_clinic3[]', $cnk_arr3, '', '130');		
	}
	
	$dr_select = "";
	$args = array();
	$args['vd_dr_idx'] 	= $vd_dr_idx;
	$dr_select = $C_Doctor->Doctor_List_Select_New($args);
	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>의료진 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="VIDEO_MODI" />
		<input type="hidden" name="vd_idx" id="vd_idx" value="<?=$_GET['vd_idx']?>" />
        <input type="hidden" name="vd_uid" id="vd_uid" value="<?=$vd_uid?>"/>
        <input type="hidden" name="vd_playtime" id="vd_playtime" value="<?=$vd_playtime?>"/>
		<input type="hidden" name="before_image_vd" id="before_image_vd" value="<?=$vd_thumb?>" />                
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="15%"><span>*</span>제목</th>
							<td width="85%">
								<input type="text" class="input_text" size="100%" name="vd_title" id="vd_title" value="<?=$vd_title?>"/>
							</td>
						</tr>
						<tr>
							<th width="15%"><span>*</span>상위노출</th>
							<td width="85%">
								<input type="radio" name="vd_order" value="100" <? if($vd_order == '100'){ echo "checked"; } ?>/> 노출
								<input type="radio" name="vd_order" value="1" <? if($vd_order == '1'){ echo "checked"; } ?>/> 비노출
							</td>
						</tr>                        
						<tr>
							<th width="15%"><span>*</span>Youtube Link</th>
							<td width="85%">
								<input type="text" class="input_text" size="100%" name="vd_link1" id="vd_link1" value="<?=$vd_link1?>"/>
							</td>
						</tr>                        

						<tr>
							<th width="15%"><span>*</span>Video info</th>
							<td width="85%">
								<div id="video_info">정보가 없습니다.</div>
							</td> 
						</tr>                        

						<tr>
							<th width="15%"><span>*</span>Vimeo Link</th>
							<td width="85%">
								<input type="text" class="input_text" size="100%" name="vd_link2" id="vd_link2" value="<?=$vd_link2?>"/>
							</td>
						</tr>   
						<tr>
							<th><span>*</span>영상썸네일(모바일)</th>
							<td>
								<input type="file" name="vd_thumb" id="vd_thumb" size="30"> * 720X405
								<?
									if($vd_thumb != "") {
										echo  "<br>" . $vd_thumb;
								} ?>
							</td>
						</tr>                         
						<tr>
							<th width="15%"><span>*</span>TAG</th>
							<td width="85%">
								<input type="text" class="input_text" size="100%" name="vd_tag" id="vd_tag" value="<?=$vd_tag?>"/>
							</td>
						</tr>                                               
						<tr>
							<th><span>*</span>의사</th>
							<td>
								<?=$dr_select?>
							</td>
						</tr>
						<!--<tr>
							<th><span>*</span>소개영상 여부</th>
							<td>
								소개영상 여부 <input type="checkbox" name="vd_intro" value="Y" <? if($vd_intro == "Y") echo "checked";?>/>
							</td>
						</tr>-->
						<tr>
							<th><span>*</span>동영상 구분</th>
							<td>
								<input type="radio" name="vd_gubun" value="C" <? if($vd_gubun == 'C'){ echo "checked"; } ?>/> 치료법
								<input type="radio" name="vd_gubun" value="D" <? if($vd_gubun == 'D'){ echo "checked"; } ?>/> 질환정보
                                <input type="radio" name="vd_gubun" value="I" <? if($vd_gubun == 'I'){ echo "checked"; } ?>/> 소개영상
							</td>
						</tr>     
						<tr>
							<th><span>*</span>소개영상 인사말</th>
							<td>                            
                          		<textarea name="vd_intro_content" id="vd_intro_content" style="width:98%; height:50px;" ><?=$vd_intro_content?></textarea>
							</td>
						</tr>                                            
						<tr>
							<th><span>*</span>진료센터</th>
							<td>
								<?=$cn_chk1?>
							</td>
						</tr>
						<tr>
							<th><span>*</span>진료과</th>
							<td>
								<?=$cn_chk2?>
							</td>
						</tr>
						<tr>
							<th><span>*</span>특수클리닉</th>
							<td>
								<?=$cn_chk3?>
							</td>
						</tr>
						<tr>
							<th><span>*</span>동영상설명</th>
							<td>
								<textarea name="vd_content" id="vd_content" style="width:98%; height:50px;" ><?=$vd_content?></textarea>
							</td>
						</tr>                        
					</tbody>
				</table>				
				<div style="margin-top:5px; text-align:center;">
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
				if($('#vd_title').val() == '') {
					alert('제목을 입력하세요');
					$('#vd_title').focus();
					return false;
				}
				if($('#vd_content').val() == '') {
					alert('제목을 입력하세요');
					$('#vd_content').focus();
					return false;
				}	
				$('#base_form').attr('action','./proc/vd_proc.php');
				$('#base_form').submit();
				return false;							
		});
		$("#vd_link1").on("blur",function(){
			var vd = $("#vd_link1").val();
			$("#video_info").html("정보를 가져오는 중입니다");
			$.ajax({
				type: "POST",
				url: "vd_info_ajax.php",
				data: "vd="+vd,
				dataType: "json",
				beforeSend: function() {
				},  			
				success: function(data) {
					$("#vd_uid").val(data["uid"]);
					$("#vd_playtime").val(data["playtime"]);					
					$("#video_info").html("<span style='color:#f63'>플레이시간 </span>: "+data["playtime"]+"<span style='color:#f63'>    영상제목</span> : "+data["title"])
				},
				error: function(xhr, status, error) { alert(error); }
			});					
		});
	});
</script>
