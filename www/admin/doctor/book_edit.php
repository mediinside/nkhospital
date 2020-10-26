<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS."/class.doctor.php");
	$C_Doctor 	= new Doctor;
	
	$args = "";
	$args['tb_idx'] 	= $_GET['tb_idx'];
	$rst = $C_Doctor ->Book_Info($args);	
	
	if($rst) {
		extract($rst);
		$tb_content  = $C_Func->dec_contents_edit($tb_content);				
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>저서 및 논문 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="BOOK_MODI" />
		<input type="hidden" name="tb_idx" id="tb_idx" value="<?=$_GET['tb_idx']?>" />
		<input type="hidden" name="before_image_main" id="before_image_main" value="<?=$tb_file_code?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="15%"><span>*</span>제목</th>
							<td width="85%">
								<input type="text" class="input_text" size="40" name="tb_title" id="tb_title" value="<?=$tb_title?>" />
							</td>
						</tr>						
						<tr>
							<th><span>*</span>내용</th>
							<td>
								<textarea name="tb_content" id="tb_content" style="display:none"></textarea>
								<textarea name="ir1" id="ir1" style="width:100%; height:300px; min-width:280px; display:none;"><?=$tb_content?></textarea> 
							</td>
						</tr>					
						<tr>
							<th><span>*</span>첨부파일</th>
							<td>
								<input type="file" name="tb_file" id="tb_file" size="30">
								<?
										if($tb_file_code != "") {
											echo  "<br>" . $tb_file_code;
								?>
									<a href="#" onClick="img_del('<?=$tb_file_code;?>','<?=$_GET['tb_idx']?>')">(X)</a>
								<? } ?>
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
		<input type="hidden" name="img_full_name" id="img_full_name" />
 	  <input type="hidden" name="upfolder" id="upfolder" value="../../common/book" />
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_SMART_PATH?>/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<script type="text/javascript">

	$(document).ready(function(){	
														 
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});															 
														 
		var oEditors = [];
			nhn.husky.EZCreator.createInIFrame({
				oAppRef: oEditors,
				elPlaceHolder: "ir1",
				sSkinURI: "/bbs/smarteditor/SmartEditor2Skin.html",
				htParams : {
					bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
					bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
					bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
					//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
					fOnBeforeUnload : function(){
						//alert("완료!");
					}
				}, //boolean
				fOnAppLoad : function(){
					//예제 코드
					//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
				},
				fCreator: "createSEditor2"
			});
			
			function insertIMG(filename){
				var tname = document.getElementById('img_full_name').value;
		
				if(tname != "")
				{
					document.getElementById('img_full_name').value = tname + "," + filename;
				}
				else
				{
					document.getElementById('img_full_name').value = filename;
				}
			}
														 
		
		$('#img_submit').click(function(){
				
				if($('#tb_title').val() == '') {
					alert("제목을 입력하세요");
					$('#tb_title').focus();
					return false;
				}				
		
				oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
				
				var con	= $('#ir1').val();
				$('#tb_content').val(con);		
		
				if($('#tb_content').val() == '') {
					alert('내용을 입력하세요');
					return false;
				}		
				
				$('#base_form').attr('action','./proc/dt_proc.php');
				$('#base_form').submit();
				return false;							
		});
	});
	
	function img_del(image, idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/dt_proc.php",
			data: "mode=BOOK_IMGDEL&tb_idx=" + idx + "&tb_file=" + image,
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

</script>
