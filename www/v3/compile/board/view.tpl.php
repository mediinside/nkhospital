<?php /* Template_ 2.2.8 2020/10/26 06:02:56 C:\xampp\htdocs\newkorea\www\v3\view\board\view.tpl 000000986 */ ?>
<?php $this->print_("btop",$TPL_SCP,1);?>

<br>
<div class="section boardView">
    <div class="viewHead">
        <h2 class="title"><?php echo $TPL_VAR["vtitle"]?><?php echo $TPL_VAR["jbcdde"]?></h2>
        <p class="info" style="color:#666666">
            <span><?php echo $TPL_VAR["vttxt"]?></span>
            <span><?php echo $TPL_VAR["vdate"]?></span>
            <span>조회 <?php echo $TPL_VAR["vsee"]?></span>
        </p>
    </div>
    <div class="contents">
        <?php echo $TPL_VAR["vcontent"]?>

        <?php echo $TPL_VAR["vfile"]?><?php echo $TPL_VAR["vcmt"]?>

    </div>
    <div class="btnWrap">
        <span><a href="?code=<?php echo $TPL_VAR["jbcode"]?>&stext=<?php echo $TPL_VAR["stext"]?>" class="btnType1">목록으로</a></span>
    </div>
</div>
<script>
	$(".contents").children("iframe").width('100%');
</script>