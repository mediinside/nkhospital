<?php /* Template_ 2.2.8 2020/07/08 10:11:58 /home/hosting_users/nkmed/www/v3/view/detail.tpl 000006104 */ 
$TPL_dlist_1=empty($TPL_VAR["dlist"])||!is_array($TPL_VAR["dlist"])?0:count($TPL_VAR["dlist"]);?>
<div class="subTop2">
    <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">의료진소개</button>
            <ul class="list">
                <li><a href="/v3/center.php?depart=A&gubun=A" data-gubun="a">전문센터</a></li>
                <li><a href="/v3/center.php?depart=AB&gubun=B" data-gubun='b'>진료과</a></li>
                <li><a href="/v3/center.php?depart=A&gubun=C" data-gubun='c'>특수클리닉</a></li>
                <li><a href="/v3/doctor.php?depart=A&gubun=C" data-gubun='d'>의료진소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();"><?php echo $TPL_VAR["stxt"]?></button>
            <ul class="list" style="z-index:9999999;">
<?php if($TPL_dlist_1){foreach($TPL_VAR["dlist"] as $TPL_V1){?>                        
                    <li class="dlist"><a href="/v3/detail.php?idx=<?php echo $TPL_V1["code"]?>&gubun=D"><?php echo $TPL_V1["name"]?></a></li>
<?php }}?>                    
            </ul>
        </div>
    </nav>
</div>
<div class="vodWrap">
	<div class="vod" style="top:0;left:0;width:100%;" id="play_main">
		 <div class="vlayer" style="width:100%; padding-bottom:56.25%; z-index:7;" id="layer_main">
        	<?php echo $TPL_VAR["th_img"]?>

             <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart_main" data-vid="<?php echo $TPL_VAR["vd_uid"]?>">
        </div>
    </div>
    <div class="tableType2">
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
                    <?php echo $TPL_VAR["moning_txt"]?>

                    <td rowspan="2">문의</td>
                </tr>
                <tr>
                    <th scope="col">오후</th>
                    <?php echo $TPL_VAR["after_txt"]?>

                </tr>
            </tbody>
        </table>
	<p>&nbsp;<?php echo $TPL_VAR["dr_gita"]?></p>
    </div>

    <section class="section docInfo">
        <div class="docTop">
            <div class="pic"><?php echo $TPL_VAR["dr_img"]?></div>
            <h2 class="name"><span><?php echo $TPL_VAR["treat"]?></span> <?php echo $TPL_VAR["dr_name"]?> <?php echo $TPL_VAR["dr_ps"]?></h2>
            <dl class="cate">
                <dt>전문분야</dt>
                <dd><?php echo $TPL_VAR["dr_tr"]?></dd>
            </dl>
        </div>
        <p class="txt1"><?php if($TPL_VAR["dr_greeting_title"]){?><?php echo $TPL_VAR["dr_greeting_title"]?><?php }else{?>환자와 소통하는 것이<br> 의사의 첫번째 임무입니다.<?php }?></p>
        <p class="txt2"><?php if($TPL_VAR["dr_greeting"]){?><?php echo $TPL_VAR["dr_greeting"]?><?php }else{?>단순히 검사 결과 상의 증상으로는 좋은 치료를 하는데 한계가 있습니다. 통증 부위와 환자의 나이, 성별, 생활 및 환경에 따라 증상이 달라질 수 있기에 원인을 찾아 정확한 진단을 내리는 것이 관건이기 때문입니다.<br>
        충분한 의사소통을 통해서 적합한 치료와 안전한 수술 방법을 선택하고, 재발을 방지하기 위해 환자에게 충분한 생활습관 교정과 운동법을 설명하며, 적극적인 치료를 받을 수 있도록 돕는 것,
        그렇게 환자와의 소통을 통해 상황에 맞는 최상의 진료 서비스를 제공해주는 것이 의사의 첫번째 임무라고 생각합니다.<?php }?></p>
        <section class="history" style="background-image:url('<?php echo $TPL_VAR["dr_bg_img"]?>');">
            <h3 class="title">경력 및 학력</h3>
            <ul class="list">
                <?php echo $TPL_VAR["dr_hi"]?>

            </ul>
<?php if($TPL_VAR["dr_ac"]){?>
            <h3 class="title">학회활동</h3>
            <ul class="list">
	            <?php echo $TPL_VAR["dr_ac"]?>

            </ul>
<?php }?>
        </section>

        <div class="btnWrap">
            <span><a href="/v3/board.php?code=40&m=w&jb_tgubun=<?php echo $TPL_VAR["gubun"]?>&tr=<?php echo $TPL_VAR["cl"]?>"class="btnType3">의료 상담</a></span>
            <!--<span><a href="http://www.nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>-->
            <span><a href="http://nkhospital.net/m/res.process.03.html?dr_idx=<?php echo $TPL_VAR["dr_idx"]?>&ptype=s&ct_type=<?php echo $TPL_VAR["cl"]?>" target="_blank" class="btnType2">진료예약</a></span>
        </div>
    </section>

<?php if($TPL_VAR["list"]){?>
    <section class="section relationVod" id="vod_result">
    </section>
<?php }?>
</div>
<style>
.vod{position:relative;min-height:231px; height:auto;overflow:hidden;} 
.vod iframe,.video-container object,.video-container embed{position:absolute;top:0;left:0;width:100%;} 
</style>
<script>
   var didx = "<?php echo $TPL_VAR["dr_idx"]?>";
</script>