<fieldset>
	<legend>건강정보</legend>
	<div class="thumbType">
		<ul>
			<!-- Loop -->
	    <?php include $GP -> INC_PATH . "/action/photo_list.inc.php"; ?>
			<!-- loop =-->
		</ul>
	</div>


	<div class="searchCont btnWrap">
		<form name="search_form" id="search_form" method="get" action="?" class="chkBox">
         <input type="hidden" id="jb_code" name="jb_code" value="<?=$jb_code?>" />
			<input type="checkbox" id="searchName" name="search_key[jb_name]" value="Y" <?php if($_GET['search_key']['jb_name']=="Y") echo " checked";?>>
			<label for="searchName">이름</label>
			<input type="checkbox" id="searchTitle" checked="" name="search_key[jb_title]" value="Y" <?php if(!$_GET['search_key'] || $_GET['search_key']['jb_title']=="Y") echo " checked";?>>
			<label for="searchTitle">제목</label>
			<input type="checkbox" id="searchCon" name="search_key[jb_content]" value="Y" <?php if($_GET['search_key']['jb_content']=="Y") echo " checked";?>>
			<label for="searchCon">내용</label>
			<label for="notiSearch" class="srOnly">검색어 입력</label>
			<input type="text" value="<?=$_GET['search_keyword']?>" id="search_keyword" name="search_keyword" class="txtInput" />
			<input type="button" value="검색" class="btnInput" id="search_submit" />
		</form>
		<div class="btnWrite">
		<?
			if($_GET['search_key'] && $_GET['search_keyword']) {
				echo "<a href=\"javascript:;\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}'\" title='목록보기' ><span>목록보기</span></a>&nbsp;&nbsp;";
			}

			//쓰기권한
			if($check_level >= $db_config_data['jba_write_level']) {
				echo "<a href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&jb_mode=twrite'\" title='글쓰기' ><span>글쓰기</span></a>";
			} else {
				echo "<a href=\"javascript:alert('로그인후 글쓰기가 가능합니다.');\" title='글쓰기' ><span>글쓰기</span></a>";
			}
		 ?>
		 </div>
	</div>

	<div class="paging">
		 <?=$page_link?>
	</div>
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_submit').click(function(){
		$('#search_form').submit();
		return false;
	});
});
</script>
