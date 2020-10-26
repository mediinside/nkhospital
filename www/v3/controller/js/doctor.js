$(document).ready(function(){
	$(document).on("click",".boardSort > ul > li",function(){
		var me = $(this).children('button');
		var depart = $(this).data("depart");
		var dlist;
		dlist = $(".docList[data-depart='"+depart+"']").detach();
		$(".boardSort").after(dlist);
		$(".boardSort > ul").slideUp(300).parent().removeClass('active');
		$(".boardSort").children(".btn").html(me.html());
		//$(".depth3").children(".btn").html(me.html());
	});	
});