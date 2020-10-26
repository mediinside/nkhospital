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
	$data = $C_Reserve->TreatOption_List(array_merge($_GET,$_POST,$args));
	
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
						<option value="ts_name" <? if($_GET['search_key'] == "ts_name"){ echo "selected";}?> >과명</option>
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
		<button onClick="layerPop('ifm_reg','./treatsection_option_reg.php', 1000, 450)"; class="btnSearch ">과 설정 등록</button>
		</div>
		
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<td width="1">|</td>
								<th>과명</th>
								<td width="1">|</td>
								<th>일별설정</th>
								<td width="1">|</td>
								<th>휴무일</th>
								<td width="1">|</td>
								<th>적용기간</th>
								<td width="1">|</td>
								<th>등록일</th>
								<td width="1">|</td>
								<th>설정</th>
								<td width="1">|</td>
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$so_idx 	= $data_list[$i]['so_idx'];
									$ts_idx 	= $data_list[$i]['ts_idx'];
									$hp_idx 	= $data_list[$i]['hp_idx'];
									$ts_name 	= $data_list[$i]['ts_name'];
									
									$so_doctornum_sun	= $data_list[$i]['so_doctornum_sun'];
									$so_rsinterval_sun	= $data_list[$i]['so_rsinterval_sun'];
									$so_work_stime_sun	= $data_list[$i]['so_work_stime_sun'];
									$so_work_etime_sun	= $data_list[$i]['so_work_etime_sun'];
									$so_ext_stime_sun	= $data_list[$i]['so_ext_stime_sun'];
									$so_ext_etime_sun	= $data_list[$i]['so_ext_etime_sun'];
									
									$so_doctornum_mon	= $data_list[$i]['so_doctornum_mon'];
									$so_rsinterval_mon	= $data_list[$i]['so_rsinterval_mon'];
									$so_work_stime_mon	= $data_list[$i]['so_work_stime_mon'];
									$so_work_etime_mon	= $data_list[$i]['so_work_etime_mon'];
									$so_ext_stime_mon	= $data_list[$i]['so_ext_stime_mon'];
									$so_ext_etime_mon	= $data_list[$i]['so_ext_etime_mon'];
									
									$so_doctornum_tue	= $data_list[$i]['so_doctornum_tue'];
									$so_rsinterval_tue	= $data_list[$i]['so_rsinterval_tue'];
									$so_work_stime_tue	= $data_list[$i]['so_work_stime_tue'];
									$so_work_etime_tue	= $data_list[$i]['so_work_etime_tue'];
									$so_ext_stime_tue	= $data_list[$i]['so_ext_stime_tue'];
									$so_ext_etime_tue	= $data_list[$i]['so_ext_etime_tue'];
									
									$so_doctornum_wed	= $data_list[$i]['so_doctornum_wed'];
									$so_rsinterval_wed	= $data_list[$i]['so_rsinterval_wed'];
									$so_work_stime_wed	= $data_list[$i]['so_work_stime_wed'];
									$so_work_etime_wed	= $data_list[$i]['so_work_etime_wed'];
									$so_ext_stime_wed	= $data_list[$i]['so_ext_stime_wed'];
									$so_ext_etime_wed	= $data_list[$i]['so_ext_etime_wed'];
									
									$so_doctornum_thu	= $data_list[$i]['so_doctornum_thu'];
									$so_rsinterval_thu	= $data_list[$i]['so_rsinterval_thu'];
									$so_work_stime_thu	= $data_list[$i]['so_work_stime_thu'];
									$so_work_etime_thu	= $data_list[$i]['so_work_etime_thu'];
									$so_ext_stime_thu	= $data_list[$i]['so_ext_stime_thu'];
									$so_ext_etime_thu	= $data_list[$i]['so_ext_etime_thu'];
									
									$so_doctornum_fri	= $data_list[$i]['so_doctornum_fri'];
									$so_rsinterval_fri	= $data_list[$i]['so_rsinterval_fri'];
									$so_work_stime_fri	= $data_list[$i]['so_work_stime_fri'];
									$so_work_etime_fri	= $data_list[$i]['so_work_etime_fri'];
									$so_ext_stime_fri	= $data_list[$i]['so_ext_stime_fri'];
									$so_ext_etime_fri	= $data_list[$i]['so_ext_etime_fri'];
									
									$so_doctornum_sat	= $data_list[$i]['so_doctornum_sat'];
									$so_rsinterval_sat	= $data_list[$i]['so_rsinterval_sat'];
									$so_work_stime_sat	= $data_list[$i]['so_work_stime_sat'];
									$so_work_etime_sat	= $data_list[$i]['so_work_etime_sat'];
									$so_ext_stime_sat	= $data_list[$i]['so_ext_stime_sat'];
									$so_ext_etime_sat	= $data_list[$i]['so_ext_etime_sat'];
									
									$so_week_holiday = $data_list[$i]['so_week_holiday'];
									$so_apply_sdate	= $data_list[$i]['so_apply_sdate'];
									$so_apply_edate	= $data_list[$i]['so_apply_edate'];
									$so_regdate	= date("Y.m.d", strtotime($data_list[$i]['so_regdate']));
									
									$args = '';
									$args['s_date'] = $so_apply_sdate;
									$args['e_date'] = $so_apply_edate;
									$args['ts_idx'] = $ts_idx;
									$args['hp_idx'] = $hp_idx;
									$rst = $C_Reserve->CHECK_CAPPA($args);									
									
									if($rst['cnt'] > 0) {
										$opt_btn = $C_Button -> getButtonDesign('type2','해제',0, '',50,'');				
									}else{
										$opt_btn = $C_Button -> getButtonDesign('type2','적용',0,"layerPop('ifm_reg','./treatsection_set.php?hp_idx=" . $hp_idx. "&ts_idx=" . $ts_idx. "&so_idx=" . $so_idx. "', 500, 500)", 50,'');				
									}
									
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"", 50,'');		
									
									if($rst['cnt'] == 0) {
										$edit_btn .= "<br />" . $C_Button -> getButtonDesign('type2','삭제',0,"treat_delete('" . $ts_idx. "')", 50,'');							
									}
								?>
								<tr>
									<td><?=$data['page_info']['start_num']--?></td>
									<td></td>
									<td><?=$ts_name?></td>
									<td></td>
									<td style="text-align:left;">
									<?
									if($so_doctornum_sun != 0) {									
										echo "
											일->  
											의사수: " . $so_doctornum_sun . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_sun] . " ,
											적용시간: " . $so_work_stime_sun ."~".$so_work_etime_sun .",
											제외시간: " . $so_ext_stime_sun ."~". $so_ext_etime_sun . "
										<br />";
									}
									?>
									
									<?
									if($so_doctornum_mon != 0) {									
										echo "
											월->  
											의사수: " . $so_doctornum_mon . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_mon] ."  ,
											적용시간: " . $so_work_stime_mon ."~".$so_work_etime_mon .",
											제외시간: " . $so_ext_stime_mon ."~". $so_ext_etime_mon ."						
										<br />";	
									}
									?>
									
									<?
									if($so_doctornum_tue != 0) {									
										echo "
											화-> 
											의사수: " . $so_doctornum_tue . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_tue] ."  ,
											적용시간: " . $so_work_stime_tue ."~".$so_work_etime_tue .",
											제외시간: " . $so_ext_stime_tue ."~". $so_ext_etime_tue ."						
									<br />";	
									}
									?>
									
									<?
									if($so_doctornum_wed != 0) {									
										echo "
											수->  
											의사수: " . $so_doctornum_wed . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_wed] ."  ,
											적용시간: " . $so_work_stime_wed ."~".$so_work_etime_wed .",
											제외시간: " . $so_ext_stime_wed ."~". $so_ext_etime_wed ."						
										<br />";	
									}
									?>
									
									<?
									if($so_doctornum_thu != 0) {									
										echo "
											목->  
											의사수: " . $so_doctornum_thu . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_thu] ."  ,
											적용시간: " . $so_work_stime_thu ."~".$so_work_etime_thu .",
											제외시간: " . $so_ext_stime_thu ."~". $so_ext_etime_thu ."						
										<br />";	
									}
									?>
									
									<?
									if($so_doctornum_fri != 0) {									
										echo "
											금->  
											의사수: " . $so_doctornum_fri . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_fri] ."  ,
											적용시간: " . $so_work_stime_fri ."~".$so_work_etime_fri .",
											제외시간: " . $so_ext_stime_fri ."~". $so_ext_etime_fri ."						
										<br />";	
									}
									?>
									
									<?
									if($so_doctornum_sat != 0) {									
										echo "
											토->  
											의사수: " . $so_doctornum_sat . ",
											예약간격: " . $GP -> RESERVE_INTERVAL_TYPE[$so_rsinterval_sat] ."  ,
											적용시간: " . $so_work_stime_sat ."~".$so_work_etime_sat .",
											제외시간: " . $so_ext_stime_sat ."~". $so_ext_etime_sat ."						
										<br />";	
									}
									?>
									
									</td>		
									<td></td> 
									<td><?=$so_week_holiday?></td>
									<td></td>
									<td><?=$so_apply_sdate?><br />~<br /><?=$so_apply_edate?></td>
									<td></td>
									<td><?=$so_regdate?></td> 
									<td></td>
									<td><?=$opt_btn?></td>
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

	function treat_delete(ts_idx)
	{
		if(!confirm("상품정보와 옵션 설정 및 연관 정보가 모두 삭제 됩니다. 삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/reserve_proc.php",
			data: "mode=TREAT_DEL&ts_idx=" + ts_idx,
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