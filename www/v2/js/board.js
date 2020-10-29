var npage = 1;
var stext = "";
var idx = "";
$(document).ready(function(){
	console.log("board");
	console.log("npage==="+page);
});
$(document).on("click","#news_menu > li > button",function(){
	console.log($(this).data("code"));
	code = $(this).data("code");
	$(".boardSort").children(".btn").html($(this).html());	
	$("#news_menu").slideUp(300).parent().removeClass('active');
	console.log("test");
	board_load('menulist',"code="+code+"&stext="+stext);
});
$(document).on("click",".depth3 > ul > li",function(){
	stext = "";
	$(".depth3").removeClass('active').siblings().removeClass('active');
	pg = $(this).data("page");	
	var me = $(this).children('a');
	code = $(this).data("code");
	$(".depth3").children(".btn").html(me.html());
	pg = "list."+pg
	board_read(pg,"code="+code);
});	

$(document).on("click","#go_list",function(){
	if(!pg) pg="list.thumb";
	board_read(pg,"stext="+stext+"&code="+code);
});	

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
	console.log(code);
	stext = $("#bschtxt").val();
	//stext   = $(this).closest('div').find('.inputTxt').val();
	board_read(pg,"stext="+stext+"&code="+code);
	
});
$(document).on("click",".inputChk",function(){
	stext = $("#bschtxt").val();	
	var param = "stext="+stext+"&code="+code+"&view=list";
	if($(this).prop('checked') == true) {
		param += param +"&secret=N";
	}
	board_load("list.list",param);
});

$(document).on("click","#pcancel",function(){
	if(!pg) pg="list.thumb";
	board_read(pg,"stext="+stext+"&code="+code);	
	$('#pwdlayer').hide();	
});
$(document).on("click","#pconfirm",function(){
	var pd = $("#inpwd").val();
	$('#pwdlayer').hide();	
	board_read("view","stext="+stext+"&idx="+idx+"&pd="+pd);
});
$(document).on("click","#aconfirm",function(){
	$('#alertmsg').hide();	
	board_read(pg,"stext="+stext+"&code="+code);
});
$(document).on("click","#nconfirm",function(){
	$('#alertmsg2').hide();	
});

$(document).on("change","#jb_tgubun",function(){
	$("#jb_treat").empty();
	var gubun = $(this).val();
	var html = "";
	$.ajax({
		type: "POST",
		url: "/v2/ajax/center_ajax.php",
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
	if($("#mode").val() == "mod"){
		url = "/v2/lib/mod_action.php"
	}else{
		url = "/v2/lib/write_action.php"
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
			pg="list.list";
			secret_false(data);
		},
		error: function(xhr, status, error) { alert(error); }
	});	
});


function board_load(page,data){
	npage = 1;
	var url = "/v2/action/board/"+page+".php";
	$("#list_result").hide();
	$("#list_result").load(url, data, function(){
		console.log(page);
		$("#list_result").fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}
function board_read(page,data){
	npage = 1;
	var url = "/v2/action/board/"+page+".php";
	console.log(data);
	$("#result_board").hide();
	$("#result_board").load(url, data, function(){
		$("#result_board").fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}
function secret_check(uidx){
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
function go_list(pg,code){
	console.log(pg+"//"+code);
	board_read(pg,"stext="+stext+"&code="+code);
}


