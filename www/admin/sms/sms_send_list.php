<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	function objectToArray($d) {
		
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
		
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
	 
	
	if($_GET['page'] == ''){
		$page = 1;
	}else{
		$page = $_GET['page'];
	}
	
	
	//보낼 데이터
	$data = array(
		'type' => 'list',
		'return_type' => 'json',			
		'login_id' => $GP -> SMS_ID,			
		'login_pwd' => $GP -> SMS_PWD,
		'page_size' => '15',
		'page' => $page,		
		'year' => date('Y'),
		's_date' => $_GET['s_date'],		
		'e_date' => $_GET['e_date']	
	);	
	
	// Send a request to example.com 
	$result = $C_Func->post_request('http://mediinside.co.kr/api/sms_list.php', $data); 	
	
	if ($result['status'] == 'ok'){ 
		$re_msg = $result['content'];	
		$obj_result = json_decode($re_msg); 		
		
		if($obj_result->msg == "true") {	
			$total_cnt =  $obj_result->result->totalcnt; //총 게시글 수			
			$arr_tmp = objectToArray($obj_result->result);			
			
			$total_pages=0;	
			if(!offset) $offset=0;	
			if(!$page) $page=1;
			
			$limit=15;
			$offset=($page-1)*$limit;			

			$numidx = $total_cnt - $offset;
		}else{
			echo "패스워드 또는 아이디가 일치하지 않습니다";
			exit();
		}
	} else { 
		echo '통신 실패 : ' . $result['error']; 
	}
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?>										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				<li>
					<span style="padding-right:42px; line-height:24px;">등록일</span>
					<span><input type="text" name="s_date" id="s_date" value="<?=$_GET['s_date']?>" class="input_text" size="20"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="20" /></span>
				</li>			
				<li>
					<span style="padding-right:31px;">검색조건</span>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="toq_qa" <? if($_GET['search_key'] == "toq_qa"){ echo "selected"; } ?>>질의</option>
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="30" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>		
		<div style="margin-top:5px; text-align:right;">
		<button onClick="layerPop('ifm_reg','./se_reg.php', 600, 400)"; class="btnSearch ">이벤트 등록</button>
		</div>
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
                        <colgroup>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
						</colgroup>
						<thead>
							<tr>
								<th>No</th>
								<th>발송내용</th>
								<th>보낸수</th>
								<th>전송결과</th>
								<th>등록일</th>						
							</tr>
						</thead>
						<tbody>
							<?				
								if(count($arr_tmp) > 0) {
									for ($i = 0 ; $i < count($arr_tmp) -1; $i++) {
										$ssl_idx 		= $arr_tmp[$i]['ssl_idx'];
										$ssl_content 	= $arr_tmp[$i]['ssl_content'];
										$ssl_sendnum	= $arr_tmp[$i]['ssl_sendnum'];
										$ssl_result 	= $arr_tmp[$i]['ssl_result'];
										$ssl_senddate 	= $arr_tmp[$i]['ssl_senddate'];		
										
										$edit_btn = $C_Button -> getButtonDesign('type2','삭제',0,"sms_send_delete('" . $ssl_idx. "', '" . $year. "')", 50,'');						
								?>
								<tr>
									<td><?=$numidx--?></td>
                                    <td><?=$ssl_content?></td>
									<td><?=$ssl_sendnum?></td>
									<td><?=$ssl_result?></td>
									<td><?=$ssl_senddate?></td>
								</tr>
								<?
									}
								}else{
								?>
								<tr>
									<td colspan="4">등록된 데이터가 없습니다.</td>         
								</tr>
								<?
								}
								?>				
						</tbody>
					</table>
				</div>						
			</div>
			<ul class="boxBoardPaging">
				<? include_once './paging.php';?>
			</ul>
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->
</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){														 
	
		callDatePick('s_date');
		callDatePick('e_date');

		$('#search_submit').click(function(){
			$('#base_form').submit();
			return false;
		});

	});
	
	function sms_send_delete(ssl_idx, year)
	{		
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/sms_proc.php",
			data: "mode=SMS_SEND_DEL&ssl_idx=" + ssl_idx + "&year=" + year,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
					alert('삭제에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});

	}
</script>