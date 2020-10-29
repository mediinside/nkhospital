<form name="r_form" id="r_form" method="post" action="{action}">
	<input type="hidden" name="mode" id="mode" value="kakao">
	<input type="hidden" name="r_id" id="r_id" value="{r_id}">
	<input type="hidden" name="r_name" id="r_name" value="{name}">
	<input type="hidden" name="r_nick" id="r_nick" value="{nick}">
	<input type="hidden" name="r_pro_image" id="r_pro_image" value="{pro_image}">
	<input type="hidden" name="r_thum_image" id="r_thum_image" value="{thum_image}">
	<input type="hidden" name="r_phone" id="r_phone" value="{phone}">
	<input type="hidden" name="r_info" id="r_info" value="{r_info}">
</form>

<script language="javascript">
	$(document).ready(function(){
		$("#r_form").submit();
	});
</script>	