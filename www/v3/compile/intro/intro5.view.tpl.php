<?php /* Template_ 2.2.8 2019/06/13 15:05:50 /home/hosting_users/nkmed/www/v3/view/intro/intro5.view.tpl 000000762 */ ?>
<?php $this->print_("introtop",$TPL_SCP,1);?>

<div class="section boardView">
    <div class="viewHead">
        <h2 class="title"><?php echo $TPL_VAR["vtitle"]?></h2>
        <p class="info">
            <span>채용정보</span>
            <span><?php echo $TPL_VAR["vdate"]?></span>
            <span>조회 <?php echo $TPL_VAR["vsee"]?></span>
        </p>
    </div>
    <div class="contents">
        <?php echo $TPL_VAR["vcontent"]?>

		<?php echo $TPL_VAR["vfile"]?>

    </div>

    <div class="btnWrap">
        <span><a href="?code=100&tab=intro5" class="btnType1">목록으로</a></span>
    </div>
</div>