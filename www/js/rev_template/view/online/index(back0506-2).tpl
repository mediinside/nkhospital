<!docType html>
<html lang="ko">
<head>
	<title>카카오톡 로그인</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
</head>
<form name="l_form" id="l_form" method="post">
	<input type="hidden" name="mode" value="mem" />
	<input type="text" id="m_id" name="m_id" value="{m_id}"/>
	<input type="password" id="pwd" name="pwd" value="{pwd}"/>    
    <br />
    로그인기억<input type="checkbox" name="rem_info" value="Y"/>
    자동로그인<input type="checkbox" name="auto" value="Y"/>    
    <input type="button" id="btn_login" value="로그인" />
</form>       
<script language="javascript">
	$("#btn_login").click(function(){
		$("#l_form").attr("action","/con/action/login_action/");
		$("#l_form").submit();		
	});
</script>


