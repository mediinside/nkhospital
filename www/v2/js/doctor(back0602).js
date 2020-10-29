var vpage = 1;
var videoId = "";
var player;



$(document).ready(function(){
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
function onPlayerReady(event) {
   event.target.playVideo();
	playVideo();	
}
var done = false;
function onPlayerStateChange(event) {
	if (event.data == YT.PlayerState.PLAYING && !done) {
	  setTimeout(stopVideo, 6000);
	  done = true;
	}
}	
function stopVideo() {
	player.stopVideo();
}
function playVideo() {
	console.log("play");
	player.playVideo();
}
function pauseVideo() {
	player.pauseVideo();
}
	
	$(document).on("click",".depth2 > ul > li",function(){
		var me = $(this).children('a');
		var gubun = me.data("gubun");
		$(".depth2").removeClass('active').siblings().removeClass('active');
		$(".depth2").children(".btn").html(me.html());
		$(".depth3 > ul").empty();
		select_menu(gubun);
		if(gubun == "a" || gubun == "c"){
			doctor_load('center','depart=A&gubun='+gubun);
		}else if(gubun == "b"){
			doctor_load('center','depart=K&gubun='+gubun);
		}else if(gubun == "d"){
			page_load('doctor','depart=K&gubun='+gubun);
//			$(".depth3").children(".btn").html("안형숙");	
		}
		
	});
	$(document).on("click","#tab_menu1 > ul > li",function(){
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
		var depart = $(this).data("depart");
		/*
		var depart = $(this).data("depart");
		var dlist;
		dlist = $(".docList[data-depart='"+depart+"']").detach();
		$(".boardSort").after(dlist);
		$(".boardSort").children(".btn").html(me.html());
		*/
		var html = me.html();
		html = html.split('(');
		$(".depth3").children(".btn").html(html[0]);
		if(gubun != "d") {
			doctor_load("center","depart="+depart+"&gubun="+gubun);
		}
	});	
	$(document).on("click",".link",function(){
		var depart = $(this).data("depart");
		var stxt = $(this).data("stxt");
		gubun = $(this).data("gubun");
		$(".depth3").children(".btn").html(stxt);
		doctor_load("center","depart="+depart+"&gubun="+gubun);
	});
	$(document).on("click","#doclist > li",function(){
		var idx = $(this).data("idx");
		var stxt = $(this).data("name");	
		$(".depth3").children(".btn").html(stxt);
		$(".depth2").children(".btn").html("의료진소개");		
		select_menu('d');
		doctor_load("detail","gubun=d&idx="+idx);
	});	
	$(document).on("click","#vod_gubun > li",function(){
		$(this).addClass("active").siblings().removeClass('active');
		var gubun = $(this).data("gubun");	 
		vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3+'&gubun='+gubun);
	});	
	$(document).on("click","#vmore",function(){
		vpage++;
		var tpage = vpage * psize;
		var total = $(this).data("total");
		if(total <= tpage) $(this).remove();
		$("#vod_result > ul > li[data-page='"+vpage+"']").show();
	});	
	
	 $(document).on('click', '#vstart', function(){
		videoId = $(this).data("vid");
		pid = $(this).data("pid");
		$(".vlayer").hide();
		console.log(videoId);
        player = new YT.Player(pid, {
          videoId: videoId,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });	
		playVideo();	
    });
	
	 $(document).on('click', '#test', function(){
		playVideo();	
    });	
});
function select_menu(gb){
	gubun = gb;
	if(gubun=="d") $(".depth3").children(".btn").html("선택해주세요");
	$(".boardSort").children(".btn").html("선택해주세요");	
	var html = "";
	var html2 = "";
	$(".tabMenu > ul >li").removeClass("active");
	if(gubun=="d") {
		var ggb = "a";
	}else{
		var ggb = gubun;
	}
	$(".tabMenu > ul >li[data-gubun="+ggb+"]").addClass("active");	
	
	//$(".depth2").children(".btn").html($(".depth2 > ul >li > a[data-gubun="+gubun+"]").html());
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
					html += '<li data-depart="'+entry["code"]+'"><a href="#" onClick="javascript:doctor_load(\'detail\',\'gubun=d&idx='+entry["code"]+'\')";>'+entry["name"]+'</a></li>';
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
				$('.docList').remove();
				$(".boardSort").after(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});	
	};
};

function doctor_load(page,data){
	console.log(data);
	npage = 1;
	var url = "/v2/action/"+page+".php";
	$("#result_doctor").hide();
	$("#result_doctor").load(url, data, function(){
		$('#result_doctor').fadeIn('slow');
	});
}

function vod_load(page,data){
	console.log("data==="+data+"pg==="+page);
	npage = 1;
	var url = "/v2/action/"+page+".php";
	$("#vod_result").hide();
	$("#vod_result").load(url, data, function(){
		$('#vod_result').fadeIn('slow');
	});
}
