var npage = 1;
var phoneYN = "";
var golist = "N";
$(document).ready(function(){
	$(document).on("click","#more",function(){
		npage++;
		$(".cardList > li[data-page='"+npage+"']").show();
	});
	
	$(document).on("click","#intro_confirm",function(){
		var hospital	= $("#ag_hospital").val();
		var name		= $("#ag_name").val();
		var mobile 		= $("#ag_mobile").val();	
		var email		= $("#ag_email").val();
		var homepage   	= $("#ag_homepage").val();	
		var content   	= $("#ag_content").val();	
		if(!$('#agree').prop('checked')){
			alert_mypage(" 정보제공에 동의하셔야 합니다.");
			$('#agree').focus()
			return false;			
		}
		if(!hospital) {
			alert_mypage("업체명을 입력해 주세요.");
			$('#ag_hospital').focus()			
			return false;
		}
		if(!name) {
			alert_mypage("담당자명을 입력해 주세요.");
			$('#ag_name').focus()			
			return false;
		}
		if(!mobile) {
			alert_mypage("연락처를 입력해 주세요.");
			$('#ag_mobile').focus()			
			return false;
		}
		if(phoneYN != "Y") {
			alert_mypage("연락처를 입력해 주세요.");
			$('#ag_mobile').focus()			
			return false;		
		}		
		if(!email) {
			alert_mypage("이메일을 입력해 주세요.");
			$('#ag_email').focus()			
			return false;
		}
		if(emailchk(email)){
		}else{
			alert_mypage("잘못된 이메일입니다.");	
			$('#ag_email').focus()			
			return false;	
		}
		if(!content) {
			alert_mypage("내용을 입력해 주세요.");
			$('#ag_content').focus()			
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "/v3/controller/action/intro_action.php",
			data: $("#aForm").serialize(),
			dataType: "text",
			beforeSend: function() {
			},  			
			success: function(data) {
				alert_mypage(data);
				golist = "Y";
			},
			error: function(xhr, status, error) { alert(error); }
		});
	});	
	
	$(document).on('keydown',"#ag_mobile", function(e){
		var trans_num = $(this).val().replace(/-/gi,'');
			var k = e.keyCode;
			if(trans_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
			{
				e.preventDefault();
			}
	   }).on('blur',"#ag_mobile", function(){
			if($(this).val() == '') return;
			var trans_num = $(this).val().replace(/-/gi,'');
			if(trans_num != null && trans_num != '')
			{
				if(trans_num.length==11 || trans_num.length==10) 
				{   
					var regExp_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
					if(regExp_ctn.test(trans_num))
					{
						trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");                  
						$(this).val(trans_num);
					}
					else
					{
						alert("유효하지 않은 전화번호 입니다.");
						$(this).val("");
						$(this).focus();
						return false;					
					}
				}
				else 
				{
					alert("유효하지 않은 전화번호 입니다.");
					$(this).val("");
					$(this).focus();
					return false;
				}
			}
			phoneYN = "Y";
	 }); 	

	$(document).on("click","#iconfirm",function(){
		$('#alert_intro').hide();	
		if(golist=="Y") location.href="/v3/intro.php?tab=intro6";
	});	 
});

function emailchk(sEmail){
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(sEmail)) {
	return true;
	}
	else {
	return false;
	}
}

function alert_mypage(msg){
	$("#alert_intro").find(".chkTxt").html(msg);
	$('#alert_intro').show();
}
