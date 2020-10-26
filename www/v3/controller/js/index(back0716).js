window.onload=function(){
	mainSlide();
	mainSlide2();
	mainSlide3();
}

$(document).ready(function(){
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	$(document).on('click', '#main_slide  > li', function(){
			var vid = "";
			var player;
			console.log("href==="+sno);
			if(sno == "2") {
				vid = "CuaKAJZLxZ8";
			}else if(sno == "3") {
				vid = "mCawo_WsjvM";
			}else{
				vid = "rAi4wNFMEdU";
			}			
			player = new YT.Player("video_result", {
				width: "100%",
				height: "300px",
				videoId: vid,
				playerVars: { 'autoplay': 1, 'controls': 0 },
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
	$(document).on('click', '#video_play', function(){
		console.log("click");
		$("#video_result").hide();
		player = "";
		$("#video_play").hide();
	});
});
