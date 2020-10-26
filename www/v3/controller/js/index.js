window.onload=function(){
	mainSlide();
	mainSlide2();
	mainSlide3();
$("#video_result").hide();
$("#video_result1").hide();
$("#video_result2").hide();	
}

$("#video_result").hide();
$("#video_result1").hide();
$("#video_result2").hide();
//$(document).ready(function(){
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;
	var player1;
	var player2;		
	function onYouTubeIframeAPIReady() {
		player = new YT.Player("video_result", {
		  height: "100%",
		  width: "100%",
		  videoId: "rAi4wNFMEdU",
		  events: {
			"onReady": onPlayerReady,
			"onStateChange": onPlayerStateChange
		  }
		});
		player1 = new YT.Player("video_result1", {
		  height: "100%",
		  width: "100%",
		  videoId: "CuaKAJZLxZ8",
		  events: {
			"onReady": onPlayerReady,
			"onStateChange": onPlayerStateChange
		  }
		});
		player2 = new YT.Player("video_result2", {
		  height: "100%",
		  width: "100%",
		  videoId: "mCawo_WsjvM",
		  events: {
			"onReady": onPlayerReady,
			"onStateChange": onPlayerStateChange
		  }
		});				
	}
	
	function onPlayerReady(event) {
		//event.target.playVideo();
	}
	var done = false;
	var playerState;
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
	/*function stopVideo() {
		player.stopVideo();
		alert("stop");
		$("#video_result").remove();
	}*/
	function playVideo() {
		player.playVideo();
	}
	function playVideo1() {
		player1.playVideo();
	}
	function playVideo2() {
		player2.playVideo();
	}		
	function pauseVideo() {
		player.pauseVideo();
	}		
    // $(document).on('click', '#main_slide', function(){
	// 	console.log(sno);
	// 	if(sno == "2") {
	// 		playVideo1();
	// 	}else if(sno == "3") {
	// 		playVideo2();
	// 	}else{
	// 		playVideo();
	// 	}		
	// });
	$(document).on('click', '#main_slide', function () {
		console.log(sno);
		if (sno == "2") {
			playVideo1();
		} else if (sno == "3") {
			window.open('http://www.nkhospital.net/v3/board.php?code=news&bidx=2363', '_blank');
		} else {
			playVideo();
		}
	});
//});
