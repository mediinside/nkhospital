var stext = "";
var pg = "";
var vpage = 1;
var bpage = 1;
var dpage = 1;
$(document).ready(function(){
	console.log("search");
	console.log("npage==="+page);
});
$(document).on("click","#vmore",function(){
	$(this).off();
	vpage++;
	var tpage = vpage * psize;
	var total = $("#video_result").data("total");
	if(total <= tpage) $(this).remove();
	$("#video_result > li[data-page='"+vpage+"']").show();
	//$(this).css('background','#fff');
	//$(this).css('color','#22314e');
	$(this).unbind('hover');
});
$(document).on("click","#bmore",function(){
	bpage++;
	var tpage = bpage * psize;
	var total = $("#board_result").data("total");
	if(total <= tpage) $(this).remove();
	
	$("#board_result > li[data-page='"+bpage+"']").show();
	//$(this).css('background','#fff');
	//$(this).css('color','#22314e');
	$(this).unbind();
});
$(document).on("click","#dmore",function(){
	dpage++;
	var tpage = dpage * psize;
	var total = $("#doctor_result").data("total");
	if(total <= tpage) $(this).remove();
	$("#doctor_result > li[data-page='"+dpage+"']").show();
	//$(this).css('background','#fff');
	//$(this).css('color','#22314e');
});
$(document).on("click","#sschbtn",function(){
	schtxt = $("#sschtxt").val();
	page_load("search","schtxt="+schtxt);
});

