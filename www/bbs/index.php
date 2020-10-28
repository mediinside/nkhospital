<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . "/_init.php";
	include_once $GP -> INC_WWW . '/head.php';
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	
	$index_page = "index.php";
	$query_page = "query.php";
	
	if(!$_GET['jb_code']) {
		$jb_code = "10";
	}else{
		$jb_code = $_GET['jb_code'];	
	}
			
		
	//$_SESSION['suserlevel'] = "9";			
	//$_SESSION['suserid'] = "jhsmh";	
	//$_SESSION['susername'] = "관리자";	
	
	$args = '';
	$args['jb_code'] = $jb_code;
	$db_config_data = $C_JHBoard -> Board_Config_Data($args);
	
	if(!$db_config_data['jba_idx']) {
		die("게시판 설정 에러입니다. 설정부분을 확인해주세요.");
	}
?>
<body>
	<div id="subCon2" class="wrap">
		<section class="wrapBody">
			<div class="guideWrap">
				<div class="bbsWrap">
					<div class="titCustomer">
						<h4><?=$db_config_data['jba_title'];?></h4>						
					</div>
					<!--게시판시작 -->
					<?php include $GP -> INC_PATH ."/board_inc.php"; ?>
					<!-- 게시판끝 -->		
			</div>
		</section>
	</div>
</body>
</html>