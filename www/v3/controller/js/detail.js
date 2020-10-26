var vpage = 1;
var videoId = "";
var player;
var lid = "";
$(document).ready(function(){
   vod_load("vod",'idx='+didx);
	
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	$(document).on('click', '#vstart_main', function(){
		videoId = $(this).data("vid");
		if(videoId) {
			$(this).closest(".vlayer").hide();			
			var player;
			player = new YT.Player("play_main", {
			  height: "405px",
			  width: "100%",
			  videoId: videoId,
			  events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			  }
			});	
		}
	});	
	 $(document).on('click', '#vstart', function(){
		if(player) player.destroy();
		$(".vlayer").show();
		vgubun = $(this).data("vgubun");
		videoId = $(this).data("vid");
		pid = $(this).data("pid");
		lid = $(this).data("lid");		
		$(this).closest(".vlayer").hide();
		console.log("vgubun"+vgubun+"pid"+pid+"lid"+lid+"vid=="+videoId);
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
	$(document).on('click', '#dlist', function(){
		$(".depth2").children(".btn").html("의료진소개");
		$(".depth3").removeClass('active').siblings().removeClass('active');		
		$(".depth3 > ul >li").siblings().hide();
		$(".depth3").children(".btn").html("선택해주세요");
		$(".dlist").show();
	});	
	function onPlayerReady(event) {
		event.target.playVideo();
	}
	var done = false;
	function onPlayerStateChange(event) {
		if (event.data == YT.PlayerState.PLAYING && !done) {
		  done = true;
		}
		if (event.data == YT.PlayerState.PAUSED) {
			console.log("p");
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
	$(document).on("click","#vmore",function(){
		vpage++;
		var tpage = vpage * psize;
		var total = $(this).data("total");
		if(total <= tpage) $(this).remove();
		$("#vod_result > ul > li[data-page='"+vpage+"']").show();
	});			
});


function vod_load(page,data){
	npage = 1;
	var url = "/v3/controller/action/"+page+".php";
	$("#vod_result").hide();
	$("#vod_result").load(url, data, function(){
		$('#vod_result').fadeIn('slow');
	});
}