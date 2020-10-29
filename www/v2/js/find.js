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
				url: "/v2/ajax/find_ajax.php",
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
				url: "/v2/ajax/find_ajax.php",
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