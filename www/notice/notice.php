<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once $GP -> INC_WWW . '/count_inc.php';

$title = "뉴고려커뮤니티";
$page_title = "소통/공감";

include_once "../inc/head.php";

$index_page = "notice.php";
$query_page = "query.php";

$jb_code = $_GET["jb_code"];

if($jb_code == "10"){ //병원소식
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-0";$page_sub_title = "병원소식";
}
elseif($jb_code == "80"){ //포토뉴스
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-1";$page_sub_title = "포토뉴스";
}
elseif($jb_code == "140"){ //CH NK
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-2";$page_sub_title = "CH NK";
}
elseif($jb_code == "90"){ //언론보도
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-3"; $page_sub_title = "언론보도";
}
elseif($jb_code == "50"){ //건강정보
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-4";$page_sub_title = "건강정보"; // 1,2,3,4,5 같은 스킨 01.html
}
elseif($jb_code == "40"){ //전문의 상담
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-5";$page_sub_title = "전문의 상담"; //다른스킨 03.html
}
elseif($jb_code == "20"){ //칭찬합니다
	$dep1 = "2";$dep2 = "2-0";$dep3 = "2-0-6";$page_sub_title = "칭찬합니다"; //다른스킨 04.html
}


?>

<body>
	<div id="wrap">
		<?php include_once "../inc/header.php" ?>
		<div id="container">
			<?php include_once "../inc/location.php" ?>
			<div id="sub-bnnr">
				<img src="/resource-pc/images/subBnnr06.png" alt="">
				<h2>
					<span><img src="/resource-pc/images/sub-bnnr-text.png" alt="믿으니까 뉴고려"></span>
					<small><?=$page_sub_title?></small>
				</h2>
			</div>
			<!-- //end #sub-bnnr -->

			<div id="innerCont">
                <?php include $GP -> INC_PATH ."/board_inc.php"; ?>				
			</div>
		</div>
		<!-- //end #container -->

		<?php include_once "../inc/fnb.php" ?>
		<?php include_once "../inc/footer.php" ?>
	</div>
	<!-- //end #wrap -->

</body>

</html>