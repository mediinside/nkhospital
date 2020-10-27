<?php
if($jb_comment_count > 0) {						
	$args = array();
	$args['show_row'] = 5;
	$args['show_page'] = 5;
	$args['jb_code']  = $jb_code;	
	$args['jb_idx'] = $jb_idx;	
	
	$Comm_data = "";
	$Comm_data = $C_JHBoard -> Board_Comment_List(array_merge($_GET,$_POST,$args));
	
	$comm_data_list 		= $Comm_data['data'];
	$comm_page_link 		= $Comm_data['page_info']['link'];
	$comm_page_search 	= $Comm_data['page_info']['search'];
	$comm_totalcount 		= $Comm_data['page_info']['total'];
	$comm_totalpages 		= $Comm_data['page_info']['totalpages'];
	$comm_nowPage 			= $Comm_data['page_info']['page'];	
	$comm_num_idx				= $Comm_data['page_info']['start_num'];
		
	$comm_totalcount_l 	= number_format($comm_totalcount,0);
	$comm_data_list_cnt 	= count($comm_data_list);
	
	
	for($i=0; $i<$comm_data_list_cnt; $i++) {
		$jbc_idx = $comm_data_list[$i]['jbc_idx'];
		$jbc_mb_id	= $comm_data_list[$i]['jbc_mb_id'];
		$jbc_reg_ip	= $comm_data_list[$i]['jbc_reg_ip'];
		$jbc_reg_ip =  $C_Func->blindInfo($jbc_reg_ip, 11);
		//등록일
		$jbc_reg_date = date("Y/m/d H:i", strtotime($comm_data_list[$i]['jbc_reg_date']));
		//수정일
		$jbc_mod_date = substr($comm_data_list[$i]['jbc_mod_date'], 0, 16);
		
		//등록자아이피
		# => 끝자리 숨겨야 할 경우 이부분에 처리		
		
		//작성회원아이디
		# => 아이디에 따른 닉네임 처리시 관련 함수 호출
		
		//비밀번호
		# => 비빌번호 암호화 필요시 관련 함수 호출
		
		//작성자 (길이, HTML TAG제한여부 처리)
		//이름 ** 처리
		$jbc_name =  $C_Func->blindInfo($comm_data_list[$i]['jbc_name'], 6);
		//$jbc_name = $C_Func->replace_string($comm_data_list[$i]['jbc_name'], 10, "");
		
		
		//내용 (HTML TAG제한)
		$jbc_content = nl2br(strip_tags($comm_data_list[$i]['jbc_content'], '<br>'));
		
		//답글처리
		if($jbc_step > 0)
				$depth_icon = $C_Func->reply_depth($comm_data_list[$i]['[jbc_step'], "");
		else
				$depth_icon = ""; //매 글마다 초기화를 해 주어야 한다.			
								
		$get_c_par = "${index_page}?jb_code=${jb_code}&jb_idx=${jb_idx}";
		$get_c_par .= "&jb_group=${jb_group}&jb_step=${jb_step}&jb_depth=${jb_depth}&jbc_idx=${jbc_idx}";
		$get_c_par .= "&${search_key}&search_keyword=${search_keyword}&page=${page}";
	?>
	<li>
			<p class="name">
				<strong><?=${jbc_name};?></strong>
				<span><?=${jbc_reg_ip};?></span>
			</p>
			<p class="replyTxt">
				<?=strip_tags($C_Func->dec_contents_edit($jbc_content), '<br>');?>
				<span class="date"><?=${jbc_reg_date};?></span>
			</p>
			<div class="btns">
				<?					
					if($check_level == 9 || $check_id == $jbc_mb_id) {
				?>
				<a href="<?php echo "${get_c_par}&jbc_idx=${jbc_idx}&jb_mode=comment_modify";?>" title="덧글 수정">수정</a>
				<a href="<?php echo "${get_c_par}&jb_mode=comment_delete";?>" title="덧글 삭제">삭제</a>
				<? } ?>
			</div>
	</li>
<?php
	} // end for
} //end_of_if($jb_comment_count > 0)	
?>