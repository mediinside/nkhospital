<?
	ini_set('allow_url_fopen', 'On');
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP -> CLS."/class.video.php");
	$C_Video 	= new Video;
	$psize = "3";
	$cl1 = ($_REQUEST["cl1"]) ? $_REQUEST["cl1"] : $_GET["cl1"];
	$cl2 = ($_REQUEST["cl2"]) ? $_REQUEST["cl2"] : $_GET["cl2"];
	$cl3 = ($_REQUEST["cl3"]) ? $_REQUEST["cl3"] : $_GET["cl3"];
	$gubun = ($_REQUEST["gubun"]) ? $_REQUEST["gubun"] : $_GET["gubun"];
	$idx = ($_REQUEST["idx"]) ? $_REQUEST["idx"] : $_GET["idx"];	
	$args = array();
	$args["vd_clinic1"] = $cl1;
	$args["vd_clinic2"] = $cl2;
	$args["vd_clinic3"] = $cl3;		
	$args["vd_gubun"]	= $gubun;		
	$args["vd_dr_idx"] 	= $idx;		
	$vdata = $C_Video->Video_List_Mobile(array_merge($_GET,$_POST,$args));
	$gubuntxt = ($gubun=="C") ? "치료영상" : "질환정보영상";
?>
    <h4 class="title"><?=$gubuntxt?></h4>
    <ul>
    <?  $p=0;$i=0;
		$mbtn = ($psize >= count($vdata)) ? " style='display:none;'" : "";
		foreach($vdata as $k=>$v){ 
            $vd_idx 		= $v['vd_idx'];
            $vd_ps 			= $GP -> DOCTOR_POSITION[$v["dr_position"]];	
            $vd_regdate 	= $v['vd_regdate'];		
            $vd_clinic1 	= $v['vd_clinic1'];
            $vd_clinic2 	= $v['vd_clinic2'];
            $vd_clinic3		= $v['vd_clinic3'];	
            $vd_link1		= $v['vd_link1'];
            $vd_link2		= $v['vd_link2'];
			$dr_data    = $C_Video->Video_Doctor_info($v["vd_dr_idx"]);
			$dr_face_img = $dr_data["dr_face_s_img"];
			$treat = ($GP->NEW_MOBILE_CENTER_ALL[$dr_data["dr_clinic2"]]) ? $GP->NEW_MOBILE_CENTER_ALL[$dr_data["dr_clinic2"]] : $GP->NEW_MOBILE_CENTER_ALL[$dr_data["dr_clinic3"]]; 
            $vimeo_id = "";
            if($vd_link1) {
                $you_id = explode("watch?v=",$vd_link1);
				$you_id = explode("&",$you_id[1]);
                $you_id = $you_id[0];
               /* $youtube_link = file_get_contents("http://youtube.com/get_video_info?video_id=".$you_id);
                parse_str($youtube_link, $data);
                if($data["status"] == "ok") {
				$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="231" src="//www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
				}else{
					if($vd_link2) $vimeo_id = explode("vimeo.com/",$vd_link2);
				}*/
				$you_link = '<iframe  title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="231" src="//https://www.youtube.com/embed/'.$you_id.'?fs=1" frameborder="0" allowfullscreen></iframe>';
				$vgubun = "u";
			}else if($vd_link2) {
				$vimeo_id = explode("vimeo.com/",$vd_link2);	
			}else{
				$you_link = '<img src="/resource/images/sample2.jpg" alt="" style="width:100%;">';		
			}
			if($vimeo_id){
				$you_link ='<iframe src="https://player.vimeo.com/video/'.$vimeo_id[1].'" style="z-index:1;" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';	
				$vgubun = "v";
			}
			if($i%$psize == 0) $p++;
			$style = ($p > 1) ? 'style=display:none' : "";            
            if($you_link) {
			$vd_thumb = ($v["vd_thumb"]) ? $v["vd_thumb"] : "nk_thumbnail.jpg";
				$thumb_src = '<img src="'.$GP -> UP_VIDEO_URL . $vd_thumb.'" alt="" style="width:100%; z-index:98; position:absolute; ">';
            ?>
                <li data-page='<?=$p?>' <?=$style?>>
                    <div class="vod">
                        <!--<img src="/resource/images/sample2.jpg" alt="" style="width:100%;">-->
                        <div id="play<?=$vd_idx?>">
                        	<?=$you_link?>
                        </div>
                        <div class="vlayer" style="position:absolute; width:100%; padding-bottom:56.25%;" id="layer<?=$vd_idx?>">
						   <?=$thumb_src?>
                           <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:99; position:absolute;" id="vstart" data-vid="<?=$you_id?>"  data-lid="layer<?=$vd_idx?>" data-pid="play<?=$vd_idx?>" data-vgubun="<?=$vgubun?>">
                           <span class="time"><?=$v["vd_playtime"]?></span>
                       </div>
                    </div>
                    <div class="cont">
                        <b class="tit"><?=$v["vd_title"]?></b>
                        <span class="txt"><?=$v["vd_content"]?></span>
                        <a href="#" class="name">
	                        <img src="<?=$GP->UP_DOCTOR_URL."/".$dr_face_img?>" />
                            <!--<img src="/resource/images/contents/img_doc2.jpg" alt="">-->
                            <span><?=$v['vd_dr_name']?> <?=$vd_ps?></span><br>
                            <span><?=$treat?></span>
                        </a>
                        <span class="btnSns">
                            <a href="#" class="btnKakao">카카오톡</a>
                            <a href="#" class="btnFacebook">페이스북</a>
                            <a href="#" class="btnUrl">URL</a>
                        </span>
                    </div>
                </li>
        <? }
        $i++;} 
   ?>
    </ul>
    <div class="btnWrap"<?=$mbtn?>>
        <span><a href="javascript:void(0);" class="btnType1" id="vmore" data-total=<?=count($vdata)?>>더보기 </a></span>
    </div>
<script language="javascript">
var psize = "<?=$psize?>";
</script> 