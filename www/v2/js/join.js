$(document).ready(function(){
	console.log("join");
	$(document).on("click","#chkall",function(){	
		 console.log("chk");
        var chk = $(this).is(":checked");
        if(chk) $(".inputChk").prop('checked', true);
        else  $(".inputChk").prop('checked', false);
    });
	$(document).on("click","#join_next",function(){		
		var msg;
		var gourl = "Y";
		$("#jForm .inputChk").each(function(index, item) {
			msg = $(this).data("msg");
			if($(this).is(":checked") == false){
				alert( msg + "에 동의하셔야 합니다.");	
				gourl = "N";
				$(this).focus();
				return false;
			}
        });
		if(gourl=="Y"){
			//$("#jForm").attr("action","?page=join.step2");
			//$("#jForm").submit();
			page_load("join.step2","agree=Y");
		}
	});	
	/*
	$(document).on("click",".btnCom",function(){	
		console.log("idchk");
		var chkid = $("#mb_id").val();
		$.ajax({
			type: "POST",
			url: "/v2/lib/idcheck.php",
			data: "",
			dataType: "json",
			beforeSend: function() {
			},  			
			success: function(data) {
			},
			error: function(xhr, status, error) { alert(error); }
		});				
	});
	*/
	
});
