$(document).ready(function(){
	$(document).on("click",".depth2 > ul > li",function(){
		var me = $(this).children('a');
		var gubun = me.data("gubun");
		$(".depth2").removeClass('active').siblings().removeClass('active');
		$(".depth2").children(".btn").html(me.html());
		$(".depth3 > ul").empty();
		select_menu(gubun);
	});
	$(document).on("click",".tabMenu > ul > li",function(){
		select_menu($(this).data("gubun"));
	});
	$(document).on("click",".boardSort > ul > li",function(){
		var me = $(this).children('button');
		var depart = $(this).data("depart");
		var dlist;
		dlist = $(".docList[data-depart='"+depart+"']").detach();
		$(".boardSort").after(dlist);
		$(".boardSort > ul").slideToggle(300).parent().removeClass('active');
		$(".boardSort").children(".btn").html(me.html());
		$(".depth3").children(".btn").html(me.html());
	});
	$(document).on("click",".depth3 > ul > li",function(){
		$(".depth3").removeClass('active').siblings().removeClass('active');
		var me = $(this).children('a');
		
		/*
		var depart = $(this).data("depart");
		var dlist;
		dlist = $(".docList[data-depart='"+depart+"']").detach();
		$(".boardSort").after(dlist);
		$(".boardSort").children(".btn").html(me.html());
		*/
		$(".depth3").children(".btn").html(me.html());
	});	
});
function select_menu(gubun){
	console.log(gubun);
	$(".depth3").children(".btn").html("선택해주세요");
	$(".boardSort").children(".btn").html("선택해주세요");	
	var html = "";
	var html2 = "";
	$(".tabMenu > ul >li").removeClass("active");
	$(".tabMenu > ul >li[data-gubun="+gubun+"]").addClass("active");	
	$(".depth2").children(".btn").html($(".depth2 > ul >li > a[data-gubun="+gubun+"]").html());
	$.ajax({
		type: "POST",
		url: "/v2/ajax/center_ajax.php",
		data: "gubun="+gubun,
		dataType: "json",
		beforeSend: function() {
		},  			
		success: function(data) {
			$.each(data, function(entryIndex, entry) {
				if(gubun == "d"){
					html += '<li data-depart="'+entry["code"]+'"><a href="#" onClick="javascript:doctor_load(\'doctor\',\'idx='+entry["code"]+'\')";>'+entry["name"]+'</a></li>';
				}else{
					html += '<li data-depart="'+entry["code"]+'"><a href="#">'+entry["name"]+'</a></li>';
					html2 += '<li data-depart="'+entry["code"]+'"><button type="button">'+entry["name"]+'</button></li>';
				}
			});					
			$(".depth3 > ul").empty().append(html);
			$(".boardSort > ul").empty().append(html2);
		},
		error: function(xhr, status, error) { alert(error); }
	});	
	if(gubun != "d"){
		$.ajax({
			type: "POST",
			url: "/v2/ajax/doctor_ajax.php",
			data: "gubun="+gubun,
			dataType: "text",
			beforeSend: function() {
			},  			
			success: function(data) {
				console.log(data);
				$('.docList').remove();
				$(".boardSort").after(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});	
	};
};
