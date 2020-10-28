<script type="text/javascript" src="/resource-pc/js/jquery.base64.js"></script>
<form name="frm_comment" id="frm_comment" action="<?=$get_c_par;?>" method="post">
<input type="hidden" name="jbc_name" id="jbc_name" value="<?=$check_name?>">	
<input type="hidden" name="jbc_password" id="jbc_password" value="<?=$jbc_password?>">
<li>
	<p class="name">
		<strong><?=$check_name?></strong>
		<span><?=$_SERVER['REMOTE_ADDR']?></span>
	</p>
	<div class="replyinput">
		<textarea maxlength="6000" name="jbc_content" id="jbc_content" cols="30" rows="10" ><?=$jbc_content;?></textarea>
	</div>
	<div class="btnReply">		
		<a href="javascript:;" id="comment_modi_submit">수정</a>
		<a href="javascript:history.go(-1);" title="취소">취소</a>
	</div>
</li>
</form>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#comment_modi_submit').click(function() {
			var t = $.base64Encode($('#jbc_content').val()); 
			$('#jbc_content').val(t);			
			
			if ( $('#jbc_content').val() == "") {
				alert('내용을 입력하세요.');
				$('#jbc_content').focus();
				return false;
			}
			
			$('#frm_comment').submit();
			return false;
		});		
	});
</script>
