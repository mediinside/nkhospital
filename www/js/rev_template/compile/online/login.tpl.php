<?php /* Template_ 2.2.7 2016/05/04 09:58:27 /home/hosting_users/nkmed/www/rev_template/view/online/login.tpl 000001114 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="l_form" id="l_form" method="post">
	<input type="hidden" name="mode" value="mem" />
	<input type="text" id="m_id" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>"/>
	<input type="password" id="pwd" name="pwd" value="<?php echo $TPL_VAR["pwd"]?>"/>    
    <br />
    로그인기억<input type="checkbox" name="rem_info" value="Y"/>
    자동로그인<input type="checkbox" name="auto" value="Y"/>    
    <input type="button" id="btn_login" value="로그인" />
</form>    
</body>
</html>
<script language="javascript">
	$("#btn_login").click(function(){
		$("#l_form").attr("action","/con/action/login_action/");
		$("#l_form").submit();		
	});
</script>