<?php
	ini_set('allow_url_fopen', 'On');
	include_once("../../_init.php");

	$you_id = explode("watch?v=",$_POST["vd"]);
	$you_id = $you_id[1];
	$youtube_link = file_get_contents("http://youtube.com/get_video_info?video_id=".$you_id);
	parse_str($youtube_link, $data);
	$min = floor($data["length_seconds"]/60); 
	$sec = $data["length_seconds"] - ($min*60); 	
	
	$rtn = array(
					"uid"	   => $data["video_id"],
					"playtime" => sprintf('%02d',$min).":".sprintf('%02d',$sec),
					"title"	   => $data["title"]
			 );
	echo json_encode($rtn);
?>