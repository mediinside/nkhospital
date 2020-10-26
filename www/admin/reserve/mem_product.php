<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.reserve.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Reserve 	= new Reserve;
	$C_Button 		= new Button;	
	
	
	$args = array();
	$args['show_row'] = 5;
	$args['pagetype'] = "admin";
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$data = "";
	$data = $C_Reserve->MemProduct_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];	
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
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
						<option value="M.mb_name" <? if($_GET['search_key'] == "M.mb_name"){ echo "selected";}?> >성명</option>
						<option value="M.mb_mobile" <? if($_GET['search_key'] == "M.mb_mobile"){ echo "selected";}?>>핸드폰</option>
						<option value="PD.pd_name" <? if($_GET['search_key'] == "PD.pd_name"){ echo "selected";}?>>상품명</option>
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="30" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>
		<? if($_SESSION['suserlevel'] == "9") { ?>	
		<div style="margin-top:5px; text-align:right;">
		<button onClick="layerPop('ifm_reg','./mem_product_reg.php', 500, 300)"; class="btnSearch ">회원 상품 등록</button>
		</div>
    <? } ?>
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<td width="1">|</td>
								<th>과명</th>
								<td width="1">|</td>
								<th>회원명</th>
								<td width="1">|</td>
								<th>상품명</th>
								<td width="1">|</td>
								<th>가격</th>
								<td width="1">|</td>
								<th>상품횟수</th>
								<td width="1">|</td>
								<th>사용횟수</th>
								<td width="1">|</td>
								<th>등록일</th>
								<td width="1">|</td>
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$mp_idx 	  = $data_list[$i]['mp_idx'];
									$ts_idx 	  = $data_list[$i]['ts_idx'];
									$mb_code 	  = $data_list[$i]['mb_code'];
									$mb_name 	  = $data_list[$i]['mb_name'];
									$ts_name 	  = $data_list[$i]['ts_name'];
									$pd_name 	  = $data_list[$i]['pd_name'];
									$mp_buy_num   = $data_list[$i]['mp_buy_num'];
									$mp_buy_price = number_format($data_list[$i]['mp_buy_price']);
									$mp_use_num	  = $data_list[$i]['mp_use_num'];	
									$mp_buy_date	= date("Y.m.d", strtotime($data_list[$i]['mp_buy_date']));
									
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./mem_product_edit.php?mb_code=" . $mb_code. "&mp_idx=" . $mp_idx. "', 500, 350)", 50,'');	
									$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"mem_pd_delete('" . $mp_idx. "')", 50,'');							
								?>
								<tr>
									<td><?=$data['page_info']['start_num']--?></td>
									<td></td>
									<td><?=$ts_name?></td>
									<td></td>
									<td><?=$mb_name?></td>
									<td></td>
									<td><?=$pd_name?></td>
									<td></td>
									<td><?=$mp_buy_price?></td>
									<td></td>
									<td><?=$mp_buy_num?></td> 
									<td></td>
									<td><?=$mp_use_num?></td> 
									<td></td>
									<td><?=$mp_buy_date?></td> 
									<td></td>
									<td><?=$edit_btn?></td>
								</tr>
								<?
									$dummy++;
								}
								?>  				
						</tbody>
					</table>
				</div>			
			</div>
			<ul class="boxBoardPaging">
				<?=$page_link?>
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

			if($.trim($('#search_content').val()) != '')
			{
				if($('#search_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#search_key option:selected').val() != '')
			{
				if($.trim($('#search_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#search_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
		});

	});

	function mem_pd_delete(mp_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/reserve_proc.php",
			data: "mode=MEMPRODUCT_DEL&mp_idx=" + mp_idx,
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