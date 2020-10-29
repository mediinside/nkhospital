<?php /* Template_ 2.2.7 2016/05/06 13:53:09 /home/hosting_users/nkmed/www/rev_template/view/online/kakao.tpl 000001042 */ ?>
<form name="r_form" id="r_form" method="post" action="<?php echo $TPL_VAR["action"]?>">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="r_id" id="r_id" value="<?php echo $TPL_VAR["r_id"]?>">
	<input type="hidden" name="r_name" id="r_name" value="<?php echo $TPL_VAR["name"]?>">
	<input type="hidden" name="r_nick" id="r_nick" value="<?php echo $TPL_VAR["nick"]?>">
	<input type="hidden" name="r_pro_image" id="r_pro_image" value="<?php echo $TPL_VAR["pro_image"]?>">
	<input type="hidden" name="r_thum_image" id="r_thum_image" value="<?php echo $TPL_VAR["thum_image"]?>">
	<input type="hidden" name="r_phone" id="r_phone" value="<?php echo $TPL_VAR["phone"]?>">
	<input type="hidden" name="r_info" id="r_info" value="<?php echo $TPL_VAR["r_info"]?>">
</form>

<script language="javascript">
	$(document).ready(function(){
		$("#r_form").submit();
	});
</script>