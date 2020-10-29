$(document).ready(function(){
	console.log("info");
	console.log("npage==="+page);
});
$(document).on("click",".depth2 > ul > li",function(){
	$(".depth2").removeClass('active').siblings().removeClass('active');
	tab = $(this).data("tab");	
	var me = $(this).children('a');
	$(".depth2").children(".btn").html(me.html());
	$("#info_menu > li").hide();
	$("#info_menu > li[data-tab='"+tab+"']").show();
	//$(".depth3").children(".btn").html("선택해주세요");
	$(".depth3").children(".btn").html($(this).data('stxt'));
	save_history('info','tab='+$(this).data("spg"));
	info_load($(this).data("spg"),"");
});	

$(document).on("click","#info_menu > li",function(){
	var page = $(this).data("page");
	if(page == "info1" || page == "info2") {
		var newWindow = window.open("about:blank");
		if(page == "info1"){
			newWindow.location.href = 'http://www.nkhospital.net/m/main.html';
		}else{
			newWindow.location.href = 'http://smart.nkhospital.net/reserve/reserve01.html';
		}
		return false;
	}
	$(".depth3").children(".btn").html($(this).html());
	$(".depth3").removeClass('active').siblings().removeClass('active');
	save_history('info','tab='+page);
	var url = "/v2/action/info/"+page+".php";
	$("#result_info").hide();
	$("#result_info").load(url, "", function(){
		$('#result_info').fadeIn('slow');
		$('html').removeClass('menuOn');
	});
});

$(document).on("click",".tabMenu > ul > li",function(){
	$(this).addClass("active").siblings().removeClass('active');
//	$(this).addClass("active");
	var page = $(this).data("pg");
	var url = "/v2/action/info/"+page+".php";
	console.log(page);
	$("#info_rst").hide();
	$("#info_rst").load(url, "", function(){
		$('#info_rst').fadeIn('slow');
	});
});
$(document).on("click","#info_11_2",function(){
	$(".tabMenu > ul > li[data-pg='info11_2']").addClass("active").siblings().removeClass('active');
	var url = "/v2/action/info/info11_2.php";
	$("#info_rst").hide();
	$("#info_rst").load(url, "", function(){
		$('#info_rst').fadeIn('slow');
	});
});

function info_load(page,data){
	//save_history('info',data);
	var depth = $("#info_menu > li[data-page='"+page+"']").data("tab");
	$("#info_menu > li").hide();
	$("#info_menu > li[data-tab="+depth+"]").show();
	var url = "/v2/action/info/"+page+".php";
	$("#result_info").hide();
	$("#result_info").load(url, data, function(){
		$('#result_info').fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}
