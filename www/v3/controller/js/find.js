$(document).ready(function(){
	$(document).on("click","#fconfirm",function(){
		$('#alert_find').hide();	
	});	
	$(document).on("click","#find_id",function(){
		var name = $("#fi_name").val();
		var email = $("#fi_email").val();
		if(emailchk(email)){
			$.ajax({
				type: "POST",
				url: "/v3/controller/ajax/find_ajax.php",
				data: "gubun=id&name="+name+"&email="+email,
				dataType: "text",
				beforeSend: function() {
				},  			
				success: function(data) {
					alert_find(data);
				},
				error: function(xhr, status, error) { alert(error); }
			});	
		}else{
			alert_find("잘못된 이메일 입니다.");
			return false;
		}		
	});
	$(document).on("click","#find_pw",function(){
		var id = $("#fp_id").val();
		var email = $("#fp_email").val();
		if(emailchk(email)){
			$.ajax({
				type: "POST",
				url: "/v3/controller/ajax/find_ajax.php",
				data: "gubun=pw&id="+id+"&email="+email,
				dataType: "text",
				beforeSend: function() {
				},  			
				success: function(data) {
					alert_find(data);
				},
				error: function(xhr, status, error) { alert(error); }
			});	
		}else{
			alert_find("잘못된 이메일 입니다.");
			return false;
		}	
	});		
});

function alert_find(msg){
	$("#alert_find").find(".mailTxt").html(msg);
	$('#alert_find').show();
}

function emailchk(sEmail){
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(sEmail)) {
	return true;
	}
	else {
	return false;
	}
}