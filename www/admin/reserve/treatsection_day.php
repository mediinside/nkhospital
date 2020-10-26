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
	$args['show_row'] =10;
	$args['pagetype'] = "admin";	
	$args['hp_idx'] 	= $_SESSION['adminhpidx'];
	$data = "";
	$data = $C_Reserve->Treat_Cappa_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];	
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	$args = '';
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$rst = $C_Reserve -> TrestSection_All($args);
	
	if(!$rst) {
		$C_Func->put_msg_and_modalclose("진료과 정보를 먼저 등록하세요.");
	}
	
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $ts_idx, "class='select_type1'", "::: 선택 :::");		
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
					<span style="padding-right:42px; line-height:24px;">일자</span>
					<span><input type="text" name="cp_date" id="cp_date" value="<?=$_GET['cp_date']?>" class="input_text" size="20"></span>
				</li>			
				<li>
					<span style="padding-right:31px;">진료과</span>
					<span>
					<?=$sel_treat?>
					</span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>
		
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<td width="1">|</td>
								<th>시작시간</th>
								<td width="1">|</td>
								<th>종료시간</th>
								<td width="1">|</td>
								<th>시술시간</th>
								<td width="1">|</td>
								<th>수정</th>							
							</tr>
						</thead>
						<tbody>
							 <?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$cp_s_time = $data_list[$i]['cp_s_time'];
									$cp_e_time = $data_list[$i]['cp_e_time'];
									$cp_num = $data_list[$i]['cp_num'];
									$cp_idx = $data_list[$i]['cp_idx'];
									$cp_day = $data_list[$i]['cp_day'];
									
									
									
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"capa_modi('" . $cp_idx ."')", 50,'');	
								?>
								<tr>
									<td><?=$data['page_info']['start_num']--?></td>
									<td></td>
									<td><input type="text" name="cp_s_time_<?=$cp_idx?>" id="cp_s_time_<?=$cp_idx?>" value="<?=$cp_s_time?>" class="input_text time" size="10" readonly /></td>
									<td></td>
									<td><input type="text" name="cp_e_time_<?=$cp_idx?>" id="cp_e_time_<?=$cp_idx?>" value="<?=$cp_e_time?>" class="input_text time"  size="10" readonly  /></td>
									<td></td>
									<td><input type="text" name="cp_num_<?=$cp_idx?>" id="cp_num_<?=$cp_idx?>" value="<?=$cp_num?>" class="input_text"  size="5"  />T</td>			
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
<link rel="stylesheet" type="text/css" href="/css/jquery.timepicker.css" media="all" />
<script type="text/javascript" src="/admin/js/jquery.timepicker.js"></script>
<script type="text/javascript">
	
	function capa_modi(cp_idx) {
		
		var cp_s_time = $('#cp_s_time_' + cp_idx).val();
		var cp_e_time = $('#cp_e_time_' + cp_idx).val();
		var cp_num = $('#cp_num_' + cp_idx).val();
		
		$.ajax({
			type: "POST",
			url: "./proc/reserve_proc.php",
			data: "mode=CAPA_DAY_MODI&cp_s_time=" + cp_s_time + "&cp_e_time=" + cp_e_time + "&cp_num=" + cp_num + "&cp_idx=" + cp_idx ,
			dataType: "text",
			success: function(msg) {
				
				if($.trim(msg) == "true") {
					alert("수정 되었습니다");					
					return false;
				}else  {
					alert("수정에 실패하였습니다.");					
					return false;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});
		
	}
	
	$(document).ready(function(){														 
	
		callDatePick('cp_date');					   
		$('.time').timepicker({ 'timeFormat': 'H:i' });
	});
</script>