<?php
	include_once("../../_init.php");	
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.online.php");	
	include_once($GP->CLS."class.button.php");	
	$C_ListClass 	= new ListClass;
	$C_Online 	= new Online;
	$C_Button 		= new Button;
	
	
//error_reporting(E_ALL);

//ini_set("display_errors", 1);
	
	$args = array();
	$args['show_row'] = 10;
	$args['excel_file']		= $_GET['excel_file'];
	$args['excel']				= $excelHanArr;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Online->ReserveSch_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);

	$get_par = "page=" . $nowPage . "&s_date=" . $_GET['s_date'] . "&e_date=" . $_GET['e_date'] . "&search_key=" . $_GET['search_key']. "&search_content=" . $_GET['search_content'];
	
	$excelDown_btn			= $C_Button -> getButtonDesign('type2','EXCEL',0, '', 100,'');	//엑셀출력버튼
	
	include_once($GP -> INC_ADM_PATH."/head.php");
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<!--div class="boxSearch">									
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				
					<span style="padding-right:42px; line-height:24px;">등록일</span>
					<span><input type="text" name="s_date" id="s_date" value="<?=$_GET['s_date']?>" class="input_text" size="20"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="20" /></span>
											
				<li>
					<span style="padding-right:31px;">검색조건</span>
					<span>
					<select name="search_key" id="search_key">
						<option value="M.mb_name" <? if($_GET['search_key'] == "M.mb_name"){ echo "selected";}?>>성명</option>
						<option value="M.mb_mobile" <? if($_GET['search_key'] == "M.mb_mobile"){ echo "selected";}?>>핸드폰</option>
						<option value="M.mb_email" <? if($_GET['search_key'] == "M.mb_email"){ echo "selected";}?>>이메일</option>
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="30" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div-->
		</div> 
		<div class="btnWrap">
        	<p class="txtLeft">※ 미등록시 기본값은 10분입니다.</p>
			<button onClick="layerPop('ifm_reg','./online_time_reg.php', '100%', 300)"; class="btnSearch btnRight">시간 등록</button>
		</div>
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th scope="col">No</th>
                                <th scope="col">진료센터</th>
								<th scope="col">시간</th>
								<th scope="col">등록일</th>
								<th scope="col">수정/삭제</th>			
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$trs_idx 		= $data_list[$i]['trs_idx'];
									$dr_clinic1		= $data_list[$i]['dr_clinic1'];
									$dr_clinic2 	= $data_list[$i]['dr_clinic2'];	
									$trs_time_gap 	= $data_list[$i]['trs_time_gap'];	
									$trs_reg_date 	= date("Y.m.d", strtotime($data_list[$i]['trs_reg_date']));	
									
									$dr_clinic1 =  $GP -> CLINIC_TYPE_NEW[$dr_clinic1];
									
									$edit_btn = "";
								
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./online_time_edit.php?trs_idx=" . $trs_idx. "', '100%', 300)", 50,'');	
									$edit_btn .= " ". $C_Button -> getButtonDesign('type2','삭제',0,"time_del('" . $trs_idx. "')", 50,'');									
								?>
									<tr>
										<td><?=$data['page_info']['start_num']--?></td>									
										<td><?=$dr_clinic1?></td>
										<td><?=$trs_time_gap?>분 간격</td>
										<td><?=$trs_reg_date?></td>	
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
			$('#base_form').submit();
			return false;
		});		
	});
	
	
	

	function time_del(trs_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/online_proc.php",
			data: "mode=ONLINE_TIME_DEL&trs_idx=" + trs_idx,
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