<?php /* Template_ 2.2.8 2020/05/14 16:26:29 /home/hosting_users/nkmed/www/v3/view/center.view.tpl 000003407 */ 
$TPL_gpa_1=empty($TPL_VAR["gpa"])||!is_array($TPL_VAR["gpa"])?0:count($TPL_VAR["gpa"]);
$TPL_gpb_1=empty($TPL_VAR["gpb"])||!is_array($TPL_VAR["gpb"])?0:count($TPL_VAR["gpb"]);
$TPL_gpc_1=empty($TPL_VAR["gpc"])||!is_array($TPL_VAR["gpc"])?0:count($TPL_VAR["gpc"]);
$TPL_dlist_1=empty($TPL_VAR["dlist"])||!is_array($TPL_VAR["dlist"])?0:count($TPL_VAR["dlist"]);?>
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
<div class="section boardView">
    <div class="viewHead">
        <h2 class="title"><?php echo $TPL_VAR["vtitle"]?><?php echo $TPL_VAR["jbcdde"]?></h2>
        <p class="info">
            <span><?php echo $TPL_VAR["vttxt"]?></span>
            <span><?php echo $TPL_VAR["vdate"]?></span>
            <span>조회 <?php echo $TPL_VAR["vsee"]?></span>
        </p>
    </div>
    <div class="contents">
    	<?php echo $TPL_VAR["img_content"]?>

        <?php echo $TPL_VAR["vcontent"]?>

        <?php echo $TPL_VAR["vfile"]?><?php echo $TPL_VAR["vcmt"]?>

    </div>
    <div class="btnWrap">
        <span><a href="?gubun=<?php echo $TPL_VAR["gubun"]?>&depart=<?php echo $TPL_VAR["depart"]?>" class="btnType1">목록으로</a></span>
    </div>
</div>
<script>
	$(".contents").children("iframe").width('100%');
</script>