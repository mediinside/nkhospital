<script type="text/javascript" src="/resource-pc/js/jquery.base64.js"></script>
<?
	$password_key=md5($check_id);	
	$tm=explode(" ",microtime());
	$jbc_password=$password_key . $tm[1];
?>
<form name="frm_comment" id="frm_comment" action="<?=$get_c_par;?>" method="post">
<input type="hidden" name="jbc_name" id="jbc_name" value="<?=$check_name?>">	
<input type="hidden" name="jbc_password" id="jbc_password" value="<?=$jbc_password?>">
<li>
	<p class="name">
		<strong><?=$check_name?></strong>
		<span><?=$_SERVER['REMOTE_ADDR']?></span>
	</p>
	<div class="replyinput">
		<textarea maxlength="6000" name="jbc_content" id="jbc_content" cols="30" rows="10" ></textarea>
	</div>
	<div class="btnReply">
		<button id="comment_submit">남기기</button>
	</div>
</li>
</form>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#comment_submit').click(function() {
			
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
