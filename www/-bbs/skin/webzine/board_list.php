<div id="webzine-list">
    <div class="header">
        <ul class="category">
            <li <? if($_GET["jb_type"]=="") echo 'class="on"';?>><a href="?"><span>ALL</span></a></li>
            <li <? if($_GET["jb_type"]=="A") echo 'class="on"';?>><a href="?jb_type=A"><span>커버스토리</span></a></li>
            <li <? if($_GET["jb_type"]=="B") echo 'class="on"';?>><a href="?jb_type=B"><span>건강하십니까?</span></a></li>
            <li <? if($_GET["jb_type"]=="C") echo 'class="on"';?>><a href="?jb_type=C"><span>김포리포트</span></a></li>
            <li <? if($_GET["jb_type"]=="D") echo 'class="on"';?>><a href="?jb_type=D"><span>튼튼한아이</span></a></li>
            <li <? if($_GET["jb_type"]=="E") echo 'class="on"';?>><a href="?jb_type=E"><span>굿모닝레시피</span></a></li>
            <li <? if($_GET["jb_type"]=="F") echo 'class="on"';?>><a href="?jb_type=F"><span>뉴고려 人</span></a></li>
        </ul>
    </div>
	<div class="contain">
		<ul class="list">
			<!-- Loop -->
	    <?php include $GP -> INC_PATH . "/action/webzine_list.inc.php"; ?>
			<!-- loop =-->
		</ul>
	</div>

			
	<div class="pagination">
		 <?=$page_link?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_submit').click(function(){
		$('#search_form').submit();
		return false;
	});
});
</script>
