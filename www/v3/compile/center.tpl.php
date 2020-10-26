<?php /* Template_ 2.2.8 2020/10/23 10:46:10 /home/hosting_users/nkmed/www/v3/view/center.tpl 000009508 */
$TPL_gpa_1=empty($TPL_VAR["gpa"])||!is_array($TPL_VAR["gpa"])?0:count($TPL_VAR["gpa"]);
$TPL_gpb_1=empty($TPL_VAR["gpb"])||!is_array($TPL_VAR["gpb"])?0:count($TPL_VAR["gpb"]);
$TPL_gpc_1=empty($TPL_VAR["gpc"])||!is_array($TPL_VAR["gpc"])?0:count($TPL_VAR["gpc"]);
$TPL_dlist_1=empty($TPL_VAR["dlist"])||!is_array($TPL_VAR["dlist"])?0:count($TPL_VAR["dlist"]);
$TPL_list1_1=empty($TPL_VAR["list1"])||!is_array($TPL_VAR["list1"])?0:count($TPL_VAR["list1"]);
$TPL_list2_1=empty($TPL_VAR["list2"])||!is_array($TPL_VAR["list2"])?0:count($TPL_VAR["list2"]);
$TPL_list4_1=empty($TPL_VAR["list4"])||!is_array($TPL_VAR["list4"])?0:count($TPL_VAR["list4"]);?>
<div class="subTop2">
    <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();"><?php echo $TPL_VAR["gtxt"]?></button>
            <ul class="list">
                <li><a href="/v3/center.php?depart=A&gubun=A" data-gubun="a">전문센터</a></li>
                <li><a href="/v3/center.php?depart=AB&gubun=B" data-gubun='b'>진료과</a></li>
                <li><a href="/v3/center.php?depart=A&gubun=C" data-gubun='c'>특수클리닉</a></li>
                <li><a href="/v3/doctor.php?depart=A&gubun=A" data-gubun='d'>의료진소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?php echo $TPL_VAR["stxt"]?></button>
            <ul class="list" style="z-index:9999999;">
<?php if($TPL_VAR["gubun"]=="A"){?>
<?php if($TPL_gpa_1){foreach($TPL_VAR["gpa"] as $TPL_K1=>$TPL_V1){?>
                    	 <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=A"><?php echo $TPL_V1?></a></li>
<?php }}?>
<?php }elseif($TPL_VAR["gubun"]=="B"){?>
<?php if($TPL_gpb_1){foreach($TPL_VAR["gpb"] as $TPL_K1=>$TPL_V1){?>
                    	 <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=B"><?php echo $TPL_V1?></a></li>
<?php }}?>
<?php }elseif($TPL_VAR["gubun"]=="C"){?>
<?php if($TPL_gpc_1){foreach($TPL_VAR["gpc"] as $TPL_K1=>$TPL_V1){?>
                    	 <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=C"><?php echo $TPL_V1?></a></li>
<?php }}?>
<?php }?>
<?php if($TPL_dlist_1){foreach($TPL_VAR["dlist"] as $TPL_V1){?>
	                    <li class="dlist" style="display:none;"><a href="/v3/detail.php?idx=<?php echo $TPL_V1["code"]?>&gubun=D"><?php echo $TPL_V1["name"]?></a></li>
<?php }}?>
            </ul>
        </div>
    </nav>
</div>
<div class="vodWrap">
    <div class="vod" style="top:0;left:0;width:100%;min-height:203px; height:auto;" id="play_main">
		 <div class="vlayer" style="width:100%; padding-bottom:56.25%; z-index:7;" id="layer_main">
<?php if($TPL_list1_1){foreach($TPL_VAR["list1"] as $TPL_V1){?>
<?php if($TPL_V1["vd_thumb"]){?>
					<img src="<?php echo $TPL_VAR["vdurl"]?><?php echo $TPL_V1["vd_thumb"]?>" alt="" style="width:100%; z-index:7; position:absolute; ">
<?php }else{?>
					<img src="/resource-pc/images/sample2.jpg" alt="" style="width:100%; z-index:7; position:absolute; ">
<?php }?>
             <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart_main" data-vid="<?php echo $TPL_V1["vd_uid"]?>">
<?php }}?>
        </div>
    </div>
    <div class="vodLink">
        <p class="share">공유하기</p>
        <span class="link">
            <a href="#" class="btnKakao" data-url="<?php echo $TPL_VAR["mainlink"]?>">카카오톡</a>
            <a href="#" class="btnFacebook" data-url="<?php echo $TPL_VAR["mainlink"]?>">페이스북</a>
            <a href="#" class="btnUrl" data-url="<?php echo $TPL_VAR["mainlink"]?>">URL</a>
        </span>
        <a href="/v3/board.php?code=40" class="btnAsk">의료상담</a>
    </div>
</div>

<section class="section centerHome">
    <h3 class="title">뉴고려병원 <?php echo $TPL_VAR["ctxt"]?><?php echo $TPL_VAR["josa"]?></h3>
    <p class="txt"><?php if($TPL_list1_1){foreach($TPL_VAR["list1"] as $TPL_V1){?><?php echo $TPL_V1["vd_intro_content"]?><?php }}?>
    </p>
<?php if($TPL_list2_1){foreach($TPL_VAR["list2"] as $TPL_V1){?>
    <div class="doctor">
        <div class="docTop">
            <div class="pic"><?php echo $TPL_V1["dr_img"]?></div>
            <h2 class="name"><span><?php echo $TPL_V1["dr_name"]?></span> <?php echo $TPL_V1["dr_ps"]?>	</h2>
            <p class="cate"><?php echo $TPL_V1["dr_treat"]?></p>
        </div>
        <div class="tableType1">
            <table class="center">
                <caption>진료시간표</caption>
                <colgroup>
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">시간</th>
                        <th scope="col">월</th>
                        <th scope="col">화</th>
                        <th scope="col">수</th>
                        <th scope="col">목</th>
                        <th scope="col">금</th>
                        <th scope="col">토</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col">오전</th>
						<?php echo $TPL_V1["moning_txt"]?>

                        <td rowspan="2">문의</td>
                    </tr>
                    <tr>
                        <th scope="col">오후</th>
                        <?php echo $TPL_V1["after_txt"]?>

                    </tr>
                    <tr>
                        <th scope="col">비고</th>
                        <!-- <td class="left" colspan="6"><?php echo $TPL_VAR["ctxt"]?> 예약문의 031-980-9114</td> -->
                        <td class="left" colspan="6"><?php echo $TPL_V1["dr_gita"]?></td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btnWrap">
            <span><a href="/v3/detail.php?idx=<?php echo $TPL_V1["dr_idx"]?>&gubun=D" class="btnType1">상세보기</a></span>
            <!--<span><a href="http://www.nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>-->
<?php if($TPL_VAR["gubun"]=="C"){?>
            <span><a href="http://nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>
<?php }else{?>
            <span><a href="http://nkhospital.net/m/res.process.03.html?dr_idx=<?php echo $TPL_V1["dr_idx"]?>&ptype=s&ct_type=<?php echo $TPL_VAR["depart"]?>" target="_blank" class="btnType2">진료예약</a></span>
<?php }?>
        </div>
    </div>
<?php }}?>
</section>

<hr>
	<div class="section">
        <div class="tabMenu">
            <ul id="vod_gubun">
                <li <?php if(!$TPL_VAR["list3"]){?>class="active"<?php }?> data-gubun="C"><a href="javascript:void(0)"><span>질환정보</span></a></li>
                <li <?php if($TPL_VAR["list3"]){?>class="active"<?php }?>data-gubun="D"><a href="javascript:void(0)"><span>질환영상</span></a></li>
            </ul>
        </div>
<?php if($TPL_VAR["list4"]){?>
		<section class="relationList" id="board_result">
			<ul>
<?php if($TPL_list4_1){foreach($TPL_VAR["list4"] as $TPL_V1){?>
                <li>
                    <a href="?bidx=<?php echo $TPL_V1["jb_idx"]?>&m=v&gubun=<?php echo $TPL_VAR["gubun"]?>&depart=<?php echo $TPL_VAR["depart"]?>">
                        <div class="thumb" style="border-color:#e4e4e4;">
                            <?php echo $TPL_V1["img_src"]?>

                        </div>
                        <div class="cont">
                            <b class="tit"><?php echo $TPL_V1["title"]?></b>
                            <span class="txt"><?php echo $TPL_V1["content"]?></span>
                            <span class="link">더보기</span>
                        </div>
                    </a>
                </li>
<?php }}?>
            </ul>
            <!--<div class="btnWrap" <?php echo $TPL_VAR["mbtn"]?>>
                <span><a href="javascript:void(0);" class="btnType1" id="bmore" data-total=<?php echo $TPL_VAR["bcnt"]?>>더보기 </a></span>
            </div>-->
        </section>
<?php }?>
            <section class="relationVod" id="vod_result">
            </section>
            <br />

	</div>
<style>
.vod{position:relative;min-height:231px;height:auto;overflow:hidden;}
.vod iframe,.video-container object,.video-container embed{position:absolute;top:0;left:0;width:100%;}
</style>
<script>
   var cl1 = "<?php echo $TPL_VAR["cl1"]?>";
   var cl2 = "<?php echo $TPL_VAR["cl2"]?>";
   var cl3 = "<?php echo $TPL_VAR["cl3"]?>";
   var psize = "3";
</script>
<?php if($TPL_VAR["list3"]){?><script>vod_page_load();</script><?php }?>