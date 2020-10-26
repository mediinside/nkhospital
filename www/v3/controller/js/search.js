var stext = "";
var pg = "";
var vpage = 1;
var bpage = 1;
var dpage = 1;
var videoId = "";
var player;
var lid = "";

$(document).ready(function(){
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	 $(document).on('click', '#vstart', function(){
		if(player) player.destroy();
		$(".vlayer").show();
		videoId = $(this).data("vid");
		pid = $(this).data("pid");
		lid = $(this).data("lid");		
		$(this).closest(".vlayer").hide();
		console.log("pid"+pid+"lid"+lid+"vid=="+videoId);
        player = new YT.Player(pid, {
          height: "101",
          width: "100%",
		  
          videoId: videoId,
		  playerVars: { 'autoplay': 1, 'controls': 0 , 'allowfullscreen':''},		  
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });	
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
		console.log(psize);
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
		location.href = "/v3/search.php?stext="+schtxt;
	});
});