$(document).ready(function(){
	$(document).on("click",".depth2 > ul > li",function(){
		$(".depth2").removeClass('active').siblings().removeClass('active');
		tab = $(this).data("tab");	
		var me = $(this).children('a');
		$(".depth2").children(".btn").html(me.html());
		$("#info_menu > li").hide();
		$("#info_menu > li[data-tab='"+tab+"']").show();
		$(".depth3").children(".btn").html($(this).data('stxt'));
		tab1 = $(this).data("spg");	
		location.href='/v3/info.php?tab='+tab1;
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
		location.href='/v3/info.php?tab='+page;
	});
	
	$(document).on("click","#info_11_2",function(){
		$(".tabMenu > ul > li[data-pg='info11_2']").addClass("active").siblings().removeClass('active');
		var url = "/v2/action/info/info11_2.php";
		$("#info_rst").hide();
		$("#info_rst").load(url, "", function(){
			$('#info_rst').fadeIn('slow');
		});
	});
});	
