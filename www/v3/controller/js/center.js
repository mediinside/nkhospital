var vpage = 1;
var bpage = 1;
var videoId = "";
var player;
var lid = "";
$(document).ready(function(){
   //vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3);
	
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	//$(document).on('click', '#vstart_main', function(){
	$("#vstart_main").click(function(){		
		videoId = $(this).data("vid");
		if(videoId) {
			$(this).closest(".vlayer").hide();			
			var player;
			player = new YT.Player("play_main", {
			  width: "100%",
			  videoId: videoId,
			  events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			  }
			});	
		}
	});	
	 $(document).on('click', '#vstart2', function(){
		if(player) player.destroy();
		$(".vlayer").show();
		vgubun = $(this).data("vgubun");
		videoId = $(this).data("vid");
		pid = $(this).data("pid");
		lid = $(this).data("lid");		
		$(this).closest(".vlayer").hide();
        player = new YT.Player(pid, {
          height: "100%",
          width: "100%",
          videoId: videoId,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });	
    });	
	/*$(document).on('click', '#dlist', function(){
		$(".depth2").children(".btn").html("의료진소개");
		$(".depth3").removeClass('active').siblings().removeClass('active');		
		$(".depth3 > ul >li").siblings().hide();
		$(".depth3").children(".btn").html("선택해주세요");
		$(".dlist").show();
	});	
	*/
	function onPlayerReady(event) {
		event.target.playVideo();
	}
	var done = false;
	function onPlayerStateChange(event) {
		if (event.data == YT.PlayerState.PLAYING && !done) {
		  done = true;
		}
		if (event.data == YT.PlayerState.PAUSED) {
			console.log("p2");
			$(".vlayer").show();
			//$("#"+lid).show();
		}
		if (event.data == YT.PlayerState.PLAYING) {
			//$("#"+lid).hide();
		}	
		playerState = event.data;	
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
	$(document).on("click","#vod_gubun > li",function(){
		console.log("clc");
		$(this).addClass("active").siblings().removeClass('active');
		var gubun = $(this).data("gubun");	 
		if(gubun == "C"){
		//vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3+'&gubun='+gubun);
			$("#board_result").show();
			$("#vod_result").hide();			
		}else{
			/*vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3);
			$("#board_result").hide();
			$("#vod_result").show();*/
			vod_page_load();
		}
	});	
	$(document).on("click","#vmore",function(){
		vpage++;
		var tpage = vpage * psize;
		var total = $(this).data("total");
		if(total <= tpage) $(this).remove();
		$("#vod_result > ul > li[data-page='"+vpage+"']").show();
	});	
	
	$(document).on("click","#bmore",function(){
		vpage++;
		var tpage = bpage * psize;
		var total = $(this).data("total");
		if(total <= tpage) $(this).remove();
		$("#board_result > ul > li[data-page='"+vpage+"']").show();
	});			
});
function vod_page_load(){
	vod_load("vod",'cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3);
	$("#board_result").hide();
	$("#vod_result").show();	
}

function vod_load(page,data){
	npage = 1;
	var url = "/v3/controller/action/"+page+".php";
	$("#vod_result").hide();
	$("#vod_result").load(url, data, function(){
		$('#vod_result').fadeIn('slow');
	});
}