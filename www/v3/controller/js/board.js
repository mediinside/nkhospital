var npage = 1;
var stext = "";
var idx = "";
$(document).ready(function(){
	$(document).on("click","#more",function(){
		npage++;
		var tpage = npage * psize;	
		var total = $("#list_result").data("total");	
		console.log(tpage+"//"+total);
		$("#list_result > li[data-page='"+npage+"']").show();
		if(total <= tpage) $(this).remove();
		//$(this).css('background','#fff');
		//$(this).css('color','#22314e');
	});
	$(document).on("click",".btnSearch",function(){
		stext = $("#bschtxt").val();
		var golist =  $(this).data("url");
		if(golist) window.location.href = golist+"&stext="+stext;
	});
	$(document).on("click",".inputChk",function(){
		stext  = $("#bschtxt").val();	
		var code = $(this).data("code");
		var param = "?code="+code+"&stext="+stext;		
		if($(this).prop('checked') == true) {
			param += "&sec=N";
		}
		window.location.href = "board.php"+param;		
	});
	$(document).on("click","#pcancel",function(){
		if(!pg) pg="list.thumb";
		$('#pwdlayer').hide();	
	});
	$(document).on("click","#pconfirm",function(){
		var pd  = $("#inpwd").val();
			$.ajax({
				type: "POST",
				url: "/v3/controller/ajax/board_ajax_pwd.php",
				data: "idx="+idx+"&pd="+pd,
				dataType: "text",
				beforeSend: function() {
				},  			
				success: function(data) {
					$('#pwdlayer').hide();						
					if($.trim(data) == "true"){
						var url = $(location).attr('href');
						url = url.replace("#","");						
						window.location.href = url+"&bidx="+idx;
						return false;
					}else{
						secret_false(data);
					}
				},
				error: function(xhr, status, error) { alert(error); }
			});			
	});
	$(document).on("change","#jb_tgubun",function(){
		$("#jb_treat").empty();
		var gubun = $(this).val();
		var html = "";
		$.ajax({
			type: "POST",
			url: "/v3/controller/ajax/center_ajax.php",
			data: "gubun="+gubun,
			dataType: "json",
			beforeSend: function() {
			},  			
			success: function(data) {
				$.each(data, function(entryIndex, entry) {
					html += '<option value="'+entry["code"].toUpperCase()+'">'+entry["name"]+'</option>';
				});
				$("#jb_treat").append(html);
			},
			error: function(xhr, status, error) { alert(error); }
		});		
	});	
	$(document).on("click","#aconfirm",function(){
		$('#alertmsg').hide();	
		var golist =  $(this).data("url");
		if(golist) window.location.href = golist;
	});
	$(document).on("click","#nconfirm",function(){
		$('#alertmsg2').hide();	
	});
	$(document).on("click","#nconfirm",function(){
		$('#alertmsg2').hide();	
	});	
	
	$(document).on("click","#board_write",function(){
		var jb_title 	= $("#jb_title").val();
		var jb_name 	= $("#jb_name").val();
		var jb_content  = $("#jb_content").val();
		var jb_file 	= $("#jb_file").val();
		var url = "";
		if(!jb_title) {
			alert_msg("제목을 입력하세요");
			$("#jb_title").focus();
			return false;
		}
		if(!jb_name) {
			alert_msg("이름을 입력하세요");
			$("#jb_name").focus();
			return false;
		}
		if(!jb_content) {
			alert_msg("내용을 입력하세요");
			$("#jb_content").focus();		
			return false;
		}
		var form = $("#bform")[0];
		var formData = new FormData(form); 
		if($("#mode").val() == "m"){
			url = "/v3/controller/action/mod_action.php"
		}else{
			url = "/v3/controller/action/write_action.php"
		}
		$.ajax({
			type: "POST",
			timeout: 6000,
			url: url,
			data: formData,
			dataType: "text",
			processData: false,
			contentType: false,		
			beforeSend: function() {
			},  			
			success: function(data) {
				console.log(data);
				secret_false(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});	
	});
});
function secret_check(uidx){
	console.log(uidx);
	idx = uidx;
	$('#pwdlayer').show();
}
function secret_false(msg){
	$('#alertmsg').show();
	$("#alertmsg").find(".chkTxt").html(msg);
}
function alert_msg(msg){
	$('#alertmsg2').show();
	$("#alertmsg2").find(".chkTxt").html(msg);
}
