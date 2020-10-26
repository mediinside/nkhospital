var phoneYN = "";
$(document).ready(function(){
	$(document).on("click","#mb_email_ch",function(){
		var email = $("#mb_email").val();
		if(emailchk(email)){
			var code = $("#mb_code").val();
			$.ajax({
				type: "POST",
				url: "/v3/controller/action/mypage_action.php",
				data: "gubun=email&code="+code+"&email="+email,
				dataType: "text",
				beforeSend: function() {
				},  			
				success: function(data) {
					alert_mypage(data);
				},
				error: function(xhr, status, error) { alert(error); }
			});	
		}else{
			alert_mypage("잘못된 이메일 입니다.");
			return false;
		}
	});
	$(document).on("click","#mb_mobile_ch",function(){
		console.log(phoneYN);
		if(phoneYN != "Y") return false;
		var mobile = $("#mb_mobile").val();
		var code = $("#mb_code").val();
		$.ajax({
			type: "POST",
			url: "/v3/controller/action/mypage_action.php",
			data: "gubun=phone&code="+code+"&mobile="+mobile,
			dataType: "text",
			beforeSend: function() {
			},  			
			success: function(data) {
				alert_mypage(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});		
	});
	$(document).on("click","#pconfirm",function(){
		var pwd	   = $("#mb_pwd").val();
		var pwdch   = $("#mb_pwd_ch").val();
		var pwdok = $("#mb_pwd_ok").val();	
		var code	= $("#mb_code").val();
		var mb_id   = $("#mb_id").val();	
		if(checkPwd(pwdch,mb_id)==true){	
			if(pwdch != pwdok) {
				alert_mypage("비밀번호가 일치하지 않습니다");
				return false;
			}
		}else{
			$('#mb_pwd_ch').val('').focus();
			$('#mb_pwd_ok').val('');
			return false;		
		}
		$.ajax({
			type: "POST",
			url: "/v3/controller/action/mypage_action.php",
			data: "gubun=pwd&pwd="+pwd+"&pwdch="+pwdch+"&code="+code,
			dataType: "text",
			beforeSend: function() {
			},  			
			success: function(data) {
				alert_mypage(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});
	});
	$(document).on("click","#oconfirm",function(){
		var reason = $("#reason").val();
		var code = $("#mb_code").val();
		if($("input:checkbox[id='agreeok']").is(":checked") == false){
			alert_mypage(" 안내 사항을 확인하였으며, 이에 동의하셔야 합니다.");
			return false;
		}
		$.ajax({
			type: "POST",
			url: "/v3/controller/action/mypage_action.php",
			data: "gubun=out&code="+code+"&reason="+reason,
			dataType: "text",
			beforeSend: function() {
			},  			
			success: function(data) {
				//location.href = "/v2";
				alert_mypage(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});	
	});
	
	
	$(document).on('keydown',"#mb_mobile", function(e){
		var trans_num = $(this).val().replace(/-/gi,'');
			var k = e.keyCode;
			if(trans_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
			{
				e.preventDefault();
			}
	   }).on('blur',"#mb_mobile", function(){
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
});
function mypage_load(page,data){
	var url = "/v2/action/mypage/"+page+".php";
	$("#mypage_result").hide();
	$("#mypage_result").load(url, data, function(){
		$('#mypage_result').fadeIn('slow');
	});
}
function alert_mypage(msg){
	$("#alert_mypage").find(".chkTxt").html(msg);
	$('#alert_mypage').show();
}
$(document).on("click","#mconfirm",function(){
	$('#alert_mypage').hide();	
});

function checkPwd(password,id){
    if(!/^.*(?=.{6,20})(?=.*[0-9])(?=.*[a-zA-Z]).*$/.test(password)){            
        alert_mypage("숫자+영문자 조합으로 6자리 이상 사용해야 합니다.");
        return false;
    }    
    var checkNumber = password.search(/[0-9]/g);
    var checkEnglish = password.search(/[a-z]/ig);
    if(checkNumber <0 || checkEnglish <0){
		alert_mypage("숫자와 영문자를 혼용하여야 합니다.");
        return false;
    }
    if(/(\w)\1\1\1/.test(password)){
		alert_mypage("같은 문자를 4번 이상 사용하실 수 없습니다.");
        return false;
    }
    if(password.search(id) > -1){
		alert_mypage("비밀번호에 아이디가 포함되었습니다.");		
        return false;
    }
    return true;
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