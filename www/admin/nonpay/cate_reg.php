<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>카테고리 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="CATE_REG" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"><span>*</span>카테고리명</th>
							<td width="80%">
								<input type="text" class="input_text" size="25" name="npc_name" id="npc_name" value="<?=$npc_name?>" />
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
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<script type="text/javascript">

	$(document).ready(function(){	
		
		
		$('#img_submit').click(function(){					
			$('#base_form').submit();
			return false;
		});
		
		$.validator.addMethod("DoubleCheck", function(npc_name) {
			var postURL = "/admin/common/DoupCateCheck.php";
			var result;	

			$.ajax({
				cache: false,
				async: false,
				type: "POST",
				data: "npc_name=" + npc_name,
				url: postURL,
				success: function(msg) {
					result = (msg == 'true') ? true : false;
				}
			});

			return result;
		}, jQuery.validator.messages.DoubleCheck);		
	
		
		$('#base_form').validate({
			rules: {	
				npc_name: { required: true, DoubleCheck:true }
			},
			messages: {	
				npc_name: { required: "카테고리명을 입력하세요", DoubleCheck:"사용할 수 없는 카테고리명 입니다"},				
			},
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				error.insertAfter(element);
			},
			submitHandler: function(frm) {
			if (!confirm("등록하시겠습니까?")) return false;                
				frm.action = './proc/nonpay_proc.php';
				frm.submit(); //통과시 전송
				return true;
			},

			success: function(element) {
			//
			}
		
		});
		
	});
</script>
