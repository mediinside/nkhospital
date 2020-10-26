<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");		
	include_once($GP -> CLS."/class.reserve.php");	
	$C_Reserve 	= new Reserve;
	
	
	$args = '';
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$rst = $C_Reserve -> TrestSection_All($args);
	
	if(!$rst) {
		$C_Func->put_msg_and_modalclose("진료과 정보를 먼저 등록하세요.");
	}
	
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $ts_idx, "class='select_type1'", "::: 선택 :::");	
	$sel_interval1 = $C_Func ->makeSelect("so_rsinterval_sun", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_sun, "class='select_type1'", "::: 선택 :::");
	$sel_interval2 = $C_Func ->makeSelect("so_rsinterval_mon", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_mon, "class='select_type1'", "::: 선택 :::");
	$sel_interval3 = $C_Func ->makeSelect("so_rsinterval_tue", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_tue, "class='select_type1'", "::: 선택 :::");
	$sel_interval4 = $C_Func ->makeSelect("so_rsinterval_wed", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_wed, "class='select_type1'", "::: 선택 :::");
	$sel_interval5 = $C_Func ->makeSelect("so_rsinterval_thu", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_thu, "class='select_type1'", "::: 선택 :::");
	$sel_interval6 = $C_Func ->makeSelect("so_rsinterval_fri", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_fri, "class='select_type1'", "::: 선택 :::");
	$sel_interval7 = $C_Func ->makeSelect("so_rsinterval_sat", $GP -> RESERVE_INTERVAL_TYPE, $so_rsinterval_sat, "class='select_type1'", "::: 선택 :::");
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>과 설정 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?">
		<input type="hidden" name="mode" id="mode" value="TREATOPTION_REG" />
		<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_SESSION['adminhpidx']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="13%"><span>*</span>진료과</th>
							<td width="87%"><?=$sel_treat?></td>
						</tr>
						<tr>
							<th><span>*</span>적용기간</th>
							<td>
								<input type="text" class="input_text" size="15" name="so_apply_sdate" id="so_apply_sdate" />
								 ~ 
								<input type="text" class="input_text" size="15" name="so_apply_edate" id="so_apply_edate" />
							</td>
						</tr>
						 <tr>
              <th><span>*</span>휴무일</th>
              <td>
              	<?
                	foreach ($GP -> GL_WEEK_INFO as $k => $v) {
								?>
                	<input type="checkbox" name="so_week_holiday[]" value="<?=$k?>" /> <?=$v?>&nbsp;
                <?		
									}
								?>
              </td>
            </tr>
						<tr>
							<th><span>*</span>설정</th>
							<td>
									<div id="div_sun">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">일</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_sun" id="so_doctornum_sun"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval1?></td>                
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_sun" id="so_work_stime_sun"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_sun" id="so_work_etime_sun"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_sun" id="so_ext_stime_sun"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_sun" id="so_ext_etime_sun"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_mon">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">월</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_mon" id="so_doctornum_mon"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval2?></td>               
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_mon" id="so_work_stime_mon"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_mon" id="so_work_etime_mon"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_mon" id="so_ext_stime_mon"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_mon" id="so_ext_etime_mon"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_tue">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">화</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_tue" id="so_doctornum_tue"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval3?></td>              
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_tue" id="so_work_stime_tue"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_tue" id="so_work_etime_tue"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_tue" id="so_ext_stime_tue"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_tue" id="so_ext_etime_tue"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_wed">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">수</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_wed" id="so_doctornum_wed"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval4?></td>              
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_wed" id="so_work_stime_wed"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_wed" id="so_work_etime_wed"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_wed" id="so_ext_stime_wed"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_wed" id="so_ext_etime_wed"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_thu">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">목</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_thu" id="so_doctornum_thu"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval5?></td>              
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_thu" id="so_work_stime_thu"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_thu" id="so_work_etime_thu"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_thu" id="so_ext_stime_thu"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_thu" id="so_ext_etime_thu"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_fri">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">금</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_fri" id="so_doctornum_fri"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval6?></td>               
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_fri" id="so_work_stime_fri"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_fri" id="so_work_etime_fri"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_fri" id="so_ext_stime_fri"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_fri" id="so_ext_etime_fri"  />
														</td>
													</tr> 
											</table>
									</div>
									<div id="div_sat">
										<table cellpadding="0" cellspacing="0" summary="" class='treat_table'>
												<tr>
														<td rowspan="8">토</td>
													</tr>
													<tr>
														<td>의사수</td>
														<td><input type="text" class="input_text" size="5" name="so_doctornum_sat" id="so_doctornum_sat"  /></td>
														<td>예약간격</td>
														<td><?=$sel_interval7?></td>               
														<td>적용시간</td>
														<td>
															<input type="text" class="input_text time" size="10" name="so_work_stime_sat" id="so_work_stime_sat"  />
															~
															<input type="text" class="input_text time" size="10" name="so_work_etime_sat" id="so_work_etime_sat"  /> 
														</td>
														<td>제외시간</td>
														<td >
															<input type="text" class="input_text time" size="10" name="so_ext_stime_sat" id="so_ext_stime_sat"  />
															~
															<input type="text" class="input_text time" size="10" name="so_ext_etime_sat" id="so_ext_etime_sat"  />
														</td>
													</tr> 
											</table>
									</div>  
							</td>
						</tr> 
					</tbody>
				</table>
				
				
				
				
								
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">등록</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<link rel="stylesheet" type="text/css" href="/css/jquery.timepicker.css" media="all" />
<script type="text/javascript" src="/admin/js/jquery.timepicker.js"></script>
<script type="text/javascript">

	function callDatePick (id) {	
		var dates = $( "#" + id ).datepicker({
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			dateFormat: 'yy-mm-dd',
			showMonthAfterYear: true,
			yearSuffix: '년'	  
		});
	}

	function check_date() {
		var s_date = $('#so_apply_sdate').val();
		var e_date = $('#so_apply_edate').val();
		var ts_idx = $('#ts_idx option:selected').val();
		
		$.ajax({
			type: "POST",
			url: "./proc/reserve_proc.php",
			data: "mode=TREAT_DATA_CK&ts_idx=" + ts_idx + "&s_date=" + s_date + "&e_date=" + e_date,
			dataType: "text",
			success: function(msg) {
				
				if($.trim(msg) == "sdate_fail") {
					alert("적용기간 시작일이 이미 등록된 일자 입니다.");					
					return false;
				}else if($.trim(msg) == "edate_fail") {
					alert("적용기간 종료일이 이미 등록된 일자 입니다.");					
					return false;
				}else{
					return true;	
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});
		
	}
	

	$(document).ready(function(){	
							   
		callDatePick('so_apply_sdate');					   
		callDatePick('so_apply_edate');					   		
		$('.time').timepicker({ 'timeFormat': 'H:i' });
		
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		
		$("input[name='so_week_holiday[]']").click(function() {
			var val = $(this).val();			
			$('#div_' + val).toggle();
		});
		
														 
		$('#img_submit').click(function(){
										
			if($('#ts_idx option:selected').val() == '') {
				alert("진료과를 선택하세요");
				return false;
			}	
			
			if($('#so_apply_sdate').val() == '') {
				alert("적용기간 시작일을 선택하세요");
				$('#so_apply_sdate').focus();
				return false;
			}
			
			if($('#so_apply_edate').val() == '') {
				alert("적용기간 종료일을 선택하세요");
				$('#so_apply_edate').focus();
				return false;
			}
			
			check_date();
											
			var week = ['sun','mon','tue','wed','thu','fri','sat'];
			var remove_arr = new Array();
			var ck = true;
			
			$("input[name='so_week_holiday[]']:checked").each(function(i){					
				var val = $(this).val();						
				week.splice( $.inArray(val, week), 1 );
			});
			
			
			$.each(week, function(i, id) {	
				var rsinterval	= $('#so_rsinterval_' + id + ' option:selected').val();	
				
				if($('#so_doctornum_' + id).val() == '') {
					alert("의사수를 입력하세요");
					$('#so_doctornum_' + id).focus();
					ck = false;
					return false;
				}
				
				if(rsinterval == '') {
					alert("예약간격을 선택하세요");
					ck = false;
					return false;
				}
				
				if($('#so_work_stime_' + id).val() == '') {
					alert("적용시간을 선택하세요");
					$('#so_work_stime_' + id).focus();
					ck = false;
					return false;
				}
				
				if($('#so_work_etime_' + id).val() == '') {
					alert("적용시간을 선택하세요");
					$('#so_work_etime_' + id).focus();
					ck = false;
					return false;
				}
				
				
				if($('#so_ext_stime_' + id).val() == '') {
					alert("제외 시작시간을 선택하세요");
					$('#so_ext_stime_' + id).focus();
					ck = false;
					return false;
				}
				
				if($('#so_ext_etime_' + id).val() == '') {
					alert("제외 종료시간을 선택하세요");
					$('#so_ext_etime_' + id).focus();
					ck = false;
					return false;
				}
				
				if(rsinterval == "H") {
					var s_time = $('#so_work_stime_' + id).val();
					var e_time = $('#so_work_etime_' + id).val();				
					var st = s_time.substr(3,2);
					var et = e_time.substr(3,2);
					
					if(st != et) {
						alert("예약간격을 시간으로 설정하시면 업무시간의 시작과 끝의 분이 같아야 합니다");
						$('#so_work_stime_' + id).focus();
						ck = false;
						return false;
					}
				}
			});	
			
			if(!ck) {
				return false;	
			}
			
			
			$('#base_form').attr('action','./proc/reserve_proc.php');
			$('#base_form').submit();
			return false;
		});		
	});
</script>
