<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	
	$ps_select = $C_Func -> makeSelect_Normal('dr_position', $GP -> DOCTOR_POSITION, $dr_position, '', '::선택::');	
	
	//$cn_chk1 = $C_Func -> makeCheckbox_Normal($GP -> CLINIC_TYPE1, 'dr_clinic1[]', $dr_clinic1, '', '130');
	$cn_chk1 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_CENTER, 'dr_clinic2[]', $dr_clinic2, '','130');
	$cn_chk2 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_CLINIC, 'dr_clinic2[]', $dr_clinic2, '','130');
	$cn_chk3 = $C_Func -> makeCheckbox_Normal($GP -> NEW_MOBILE_SPECIAL, 'dr_clinic3[]', $dr_clinic3, '','140');
	$cn_chk4 = $C_Func -> makeCheckbox_Normal_1($GP -> GL_WEEK_INFO1, 'dr_m_sd[]', $dr_m_sd, '', '30');
	$cn_chk5 = $C_Func -> makeCheckbox_Normal_1($GP -> GL_WEEK_INFO1, 'dr_a_sd[]', $dr_a_sd, '', '30');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>의료진 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="DOCTOR_REG" />
        <input type="hidden" name="dr_vd_uid" id="dr_vd_uid" value=""/>
        <input type="hidden" name="dr_vd_playtime" id="dr_vd_playtime" value=""/>

		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="15%"><span>*</span>성명</th>
							<td width="85%">
								<input type="text" class="input_text" size="25" name="dr_name" id="dr_name" value="<?=$dr_name?>" />
							</td>
						</tr>
						<tr>
							<th><span>*</span>연락처</th>
							<td>
								<input type="text" class="input_text" size="25" name="dr_mobile" id="dr_mobile" value="<?=$dr_mobile?>" />(ex. 010-0000-0000)
							</td>
						</tr>
						<tr>
							<th>의사번호</th>
							<td>
								<input type="text" class="input_text" size="25" name="dr_mcode" id="dr_mcode" value="<?=$dr_mcode?>" />
							</td>
						</tr>
						<tr>
							<th>진료과코드</th>
							<td>
								<input type="text" class="input_text" size="25" name="dr_mtreat_no" id="dr_mtreat_no" value="<?=$dr_mtreat_no?>" />
							</td>
						</tr>                                                
                        
						<tr>
							<th><span>*</span>직책</th>
							<td>
								<?=$ps_select?>
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
								<th><span>*</span>진료일정</th>
								
								<td>
									<div style="margin-left:32px;">월 &nbsp;&nbsp;&nbsp;&nbsp;화 &nbsp;&nbsp;&nbsp;&nbsp;수 &nbsp;&nbsp;&nbsp;&nbsp;목 &nbsp;&nbsp;&nbsp;&nbsp;금 &nbsp;&nbsp;&nbsp;&nbsp;토</div>
				
									<div style="margin-top:10px;">
										<span style="padding-right:5px;">오전</span>
										<?=$cn_chk4?>
								  </div>									
									<div style="margin-top:15px; margin-bottom:10px;">
										<span style="padding-right:5px;">오후</span>
										<?=$cn_chk5?>
								  </div>	
								</td>
						</tr>	
						<tr>
								<th><span>*</span>상담노출</th>
								<td>
									<input type="radio" value="Y" name="dr_qa_show" >노출
									<input type="radio" value="N" name="dr_qa_show" checked >미노출
                                    <input type="text" class="input_text" onKeyPress="return numkeyCheck(event)" size="5" name="dr_time_gap" id="dr_time_gap" /> 분 간격
								</td>
						</tr>	
						<tr>
							<th><span>*</span>진료분야</th>
							<td>
								<textarea name="dr_treat" id="dr_treat" style="width:98%; height:100px;" ><?=$dr_treat?></textarea>
							</td>
						</tr>
						<tr>
							<th><span>*</span>주요경력</th>
							<td>
								<textarea name="dr_history" id="dr_history" style="width:98%; height:100px;" ></textarea>
							</td>
						</tr>
						<tr>
							<th><span>*</span>학회활동</th>
							<td>
								<textarea name="dr_academy" id="dr_academy" style="width:98%; height:100px;" ></textarea>
							</td>
						</tr>
						<tr>
							<th><span>*</span>인사말제목(모바일용)</th>
							<td>
								<textarea name="dr_greeting_title" id="dr_greeting_title" style="width:98%; height:100px;" ></textarea>
							</td>
						</tr>                        
						<tr>
							<th><span>*</span>인사말(모바일용)</th>
							<td>
								<textarea name="dr_greeting" id="dr_greeting" style="width:98%; height:100px;" ></textarea>
							</td>
						</tr>                        					
						<tr>
							<th><span>*</span>리스트이미지 <br/>280X300</th>
							<td>
								<input type="file" name="dr_face_img" id="dr_face_img" size="30">
							</td>
						</tr>
						<tr>
							<th><span>*</span>상세이미지 <br/>600X400</th>
							<td>
								<input type="file" name="dr_detail_img" id="dr_detail_img" size="30">
							</td>
						</tr>
						<tr>
							<th><span>*</span>상세이미지(모바일용) 320X440</th>
							<td>
								<input type="file" name="dr_mobile_img" id="dr_mobile_img" size="30">
							</td>
						</tr>
						<tr>
							<th><span>*</span>리스트용이미지(모바일용) 80X80</th>
							<td>
								<input type="file" name="dr_face_s_img" id="dr_face_s_img" size="30">
							</td>
						</tr>                        
						<tr>
							<th><span>*</span>상세배경이미지(모바일용) <br/>720X930</th>
							<td>
								<input type="file" name="dr_bg_img" id="dr_bg_img" size="30">
							</td>
						</tr>                        
						<tr>
							<th><span>*</span>영상쎔네일(모바일용) <br/>720X405</th>
							<td>
								<input type="file" name="dr_thumb_img" id="dr_thumb_img" size="30">
							</td>
						</tr>                        
						<tr>
							<th><span>*</span>소개영상(Youtube)</th>
							<td>
	                            <input type="text" class="input_text" size="80%" name="dr_vd_link1" id="dr_vd_link1" value="<?=$dr_vd_link1?>" />
							</td>
						</tr>
						<tr>
							<th width="15%"><span>*</span>Video info</th>
							<td width="85%">
								<div id="video_info">정보가 없습니다.</div>
							</td> 
						</tr>                         
						<tr>
							<th><span>*</span>소개영상(Vimeo)</th>
							<td>
	                            <input type="text" class="input_text" size="80%" name="dr_vd_link2" id="dr_vd_link2" value="<?=$dr_vd_link2?>" />
							</td>
						</tr>
						<tr>
							<th><span>*</span>기타사항</th>
							<td>
								<textarea name="dr_gita" id="dr_gita" style="width:98%; height:50px;" ></textarea>
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
		
		$('#dr_time_gap').keypress(function (event) { if (event.which && (event.which <= 47 || event.which >= 58) && event.which != 8) { event.preventDefault(); } });
		
		$('#img_submit').click(function(){
				
				if($('#dr_name').val() == '') {
					alert('성명을 입력하세요');
					$('#dr_name').focus();
					return false;
				}
				
				if($('#dr_position option:selected').val() == '') {
					alert('직책을 선택하세요');
					return false;
				}
				
				/*
				var chk1 = $("input[name='dr_clinic1[]']:checkbox:checked").length;
				
				if(chk1 == 0) {
					alert("진료과목을 선택하세요");
					return false;
				}
				*/
				
				
				
				var chk2 = $("input[name='dr_clinic2[]']:checkbox:checked").length;
				
				if(chk2 == 0) {
					alert("진료센터를  선택하세요");
					return false;
				}
				
				/*
				var chk3 = $("input[name='dr_m_sd[]']:checkbox:checked").length;
				
				if(chk3 == 0) {
					alert("오전 일정을  선택하세요");
					return false;
				}
				*/
				
				if($('#dr_treat').val() == '') {
					alert('진료분야를 입력하세요');
					$('#dr_treat').focus();
					return false;
				}
				
				if($('#dr_history').val() == '') {
					alert('주요경력을 입력하세요');
					$('#dr_history').focus();
					return false;
				}
				/*
				if($('#dr_academy').val() == '') {
					alert('학회활동을 입력하세요');
					$('#dr_academy').focus();
					return false;
				}*/				
				
				$('#base_form').attr('action','./proc/dt_proc.php');
				$('#base_form').submit();
				return false;							
		});
		$("#dr_vd_link1").on("blur",function(){
			var vd = $("#dr_vd_link1").val();
			$("#video_info").html("정보를 가져오는 중입니다");
			$.ajax({
				type: "POST",
				url: "../video/vd_info_ajax.php",
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
