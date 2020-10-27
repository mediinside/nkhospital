<form name="frm_pass" id="frm_pass" action="<?=$get_par;?>" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" height="240">
			<table width="500" border="0" cellpadding="0" cellspacing="0" cellspcaing="0" >				
				<tr>
					<td height="3" bgcolor="#B0CB80"></td>
				</tr>
				<tr>
				    <td height="30"  align="center" bgcolor="#F0F0F0" class="cu_text">비밀번호를 입력하세요.</td>
				</tr>
				<tr>
					<td align="center" height="60"><input type="password" name="input_passd" id="input_passd" size=25 maxlength=30 class="input"></td>
				</tr>
				<tr>
					<td height="1" bgcolor="#B0CB80"></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;">
            <a href="javascript:;" id="pass_submit"><img src="<?=$GP -> IMG_PATH . "/". $skin_dir;?>/image/btn_submit.gif" width="49" height="22" /></a>
						<a href="javascript:history.go(-1);"><img src="<?=$GP -> IMG_PATH . "/". $skin_dir;?>/image/btn_cancel.gif" width="49" height="22" border=0 hspace=5></a></td>
				</tr>			
			</table>
    </td>
	</tr>
</table>
</form>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#pass_submit').click(function(){
			
			if($('#input_passd').val() == '') {
				alert("비밀번호를 입력하세요");
				$('#input_passd').focus();
				return false;
			}
			
			$('#frm_pass').submit();
			return false;
		});		
	});
	
</script>