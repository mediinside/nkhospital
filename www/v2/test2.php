<!DOCTYPE html>
<html>
  <body>
    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>
	<div id="ptest" style="font-size:36px">test</div>
	<div id="start">test</div>    
     <div id="player2"></div>
	<script type="text/javascript" src="/resource/js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="/resource/js/jquery-ui.min.js"></script>
    
    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;	
	 $(document).on('click', '#ptest', function(){
	       player = new YT.Player('player', {
			  height: '360',
			  width: '640',
			  videoId: 'q9sgoYhls5s',
			  events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			  }		
		  });
		
    });	
	 $(document).on('click', '#start', function(){
	
		playVideo();
	 });


      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
       // event.target.playVideo();
	   event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
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
		player.playVideo();
	}	  
    </script>
  </body>
</html>