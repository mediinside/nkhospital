<?php
	include_once  '../_init.php';
	include_once $GP -> INC_WWW . '/count_inc.php';
	include_once $GP -> INC_V2_INC . '/top.php';
	$page = ($_GET["page"])	? $_GET["page"] : "index";
	$param = $_SERVER['QUERY_STRING'];
?>
<div id="container" style="padding:1px 0 0;"></div>
<? include_once $GP -> INC_V2_INC . '/foot.php'; ?>
<script>
var page = "<?=$page?>";
var param = '<?=$param?>';
/*var jbcode = "<?=$_GET["jbcode"];?>";
var param = "jbcode="+jbcode;
*/
var href = "";
page_load(page,param);
</script>
