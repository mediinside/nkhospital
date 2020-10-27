<div class="btn-group wd-1200">
        <div class="btn-rt">
           <?php
				if($_GET['search_key'] && $_GET['search_keyword']) {
					echo "<a href=\"javascript:;\" class=\"btn0\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}'\" title='목록'><span>목록</span></a>";
				}
				?>

				<?php
				//쓰기권한
				if($check_level >= $db_config_data['jba_write_level']) {
					echo "<a class='btn btn-red' href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&jb_mode=twrite'\" title='글쓰기'><span>글쓰기</span></a>";
				} else {
				//	echo "<a class='btn btn_middle' id='twrite_btn' title='글쓰기'><strong>글쓰기</strong></a>";
				}
				?>
        </div>
    </div>
    <div class="boardList wd-1200">
        <table>
            <colgroup>
                <col width="15%">
                <col width="65%">
                <col width="20%">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col" class="num">번호</th>
                    <th scope="col" class="subject">제목</th>
                    <th scope="col" class="date">작성일</th>
                </tr>
            </thead>
            <tbody>
	            <?php include $GP -> INC_PATH . "/action/list.inc.php"; ?>
            </tbody>
        </table>
    </div>
    <div class="paging">
		 <?=$page_link?>
	</div>

		