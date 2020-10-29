var npage = 1;
var code = "news";
var stext = "";
$(document).ready(function(){
	console.log("board");
	console.log("npage==="+page);
});
$(document).on("click","#news_menu > li > button",function(){
	console.log($(this).data("code"));
	code = $(this).data("code");
	$(".boardSort").children(".btn").html($(this).html());	
	$("#news_menu").slideToggle(300).parent().removeClass('active');
	board_load('menulist',"code="+code+"&stext="+stext);
});
$(document).on("click",".depth3 > ul > li",function(){
	$(".depth3").toggleClass('active').siblings().removeClass('active');
	var me = $(this).children('a');
	var code = $(this).data("code");
	$(".depth3").children(".btn").html(me.html());
	if(code == "news") {
		$(".boardSort").show();
	}else{
		$(".boardSort").hide();			
	}	
	board_read("list","code="+code);
});	


$(document).on("click","#more",function(){
	npage++;
	$(".boardThumb > li[data-page='"+npage+"']").show();
});
$(document).on("click",".btnSearch",function(){
	stext = $("#schtxt").val();
	var page = $("#schtxt").data("page");
	board_load(page,"stext="+stext+"&code="+code);
	
});
function board_load(page,data){
	npage = 1;
	var url = "/v2/action/board/"+page+".php";
	$(".boardThumb").hide();
	$(".boardThumb").load(url, data, function(){
		$(".boardThumb").fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}

function board_read(page,data){
	npage = 1;
	var url = "/v2/action/board/"+page+".php";
	$("#result_board").hide();
	$("#result_board").load(url, data, function(){
		$("#result_board").fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}
