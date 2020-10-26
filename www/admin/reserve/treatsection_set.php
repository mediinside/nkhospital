<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");		
	include_once($GP -> CLS."/class.reserve.php");	
	$C_Reserve 	= new Reserve;
	
	$args = '';
	$args['hp_idx'] = $_GET['hp_idx'];
	$args['ts_idx'] = $_GET['ts_idx'];
	$args['so_idx'] = $_GET['so_idx'];	
	$rst = $C_Reserve->TreatOption_Info($args);
	
	if($rst) {
		extract($rst);
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>설정 적용</strong></span>
		</div>
		 <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
			<input type="hidden" name="mode" id="mode" value="TREATOPTION_SET" />
			<input type="hidden" name="so_idx" id="so_idx" value="<?=$_GET['so_idx']?>" />
			<input type="hidden" name="ts_idx" id="ts_idx" value="<?=$_GET['ts_idx']?>" />
			<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_GET['hp_idx']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"><span>*</span>진료과</th>
							<td width="80%"><input type="text" class="input_text" size="20" name="s_date" id="s_date" value="<?=$ts_name?>"  />  </td>
						</tr>
						<tr>
							<th><span>*</span>적용시간</th>
							<td>
								<input type="text" class="input_text" size="10" name="s_date" id="s_date" value="<?=$so_apply_sdate?>"  />
                ~
                <input type="text" class="input_text" size="10" name="e_date" id="e_date" value="<?=$so_apply_edate?>" />
							</td>
						</tr>						
					</tbody>
				</table>	
					
				<ul class="treat_set">
				<?
					$first_show = "";
								if($so_doctornum_sun != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('1');\" id='week_1' class='week'>일</a></li>";
						$first_show = "1";
					}
								if($so_doctornum_mon != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('2');\" id='week_2' class='week'>월</a></li>";
						if($first_show == "") {
							$first_show = "2";
						}
					}
								if($so_doctornum_tue != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('3');\" id='week_3' class='week'>화</a></li>";
						if($first_show == "") {
							$first_show = "3";
						}
					}
								if($so_doctornum_wed != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('4');\" id='week_4' class='week'>수</a></li>";
						if($first_show == "") {
							$first_show = "4";
						}
					}
								if($so_doctornum_thu != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('5');\" id='week_5' class='week'>목</a></li>";
						if($first_show == "") {
							$first_show = "5";
						}
					}
								if($so_doctornum_fri != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('6');\" id='week_6' class='week'>금</a></li>";
						if($first_show == "") {
							$first_show = "6";
						}
					}
								if($so_doctornum_sat != 0) { 
						echo "<li><a href='javascript:;' onclick=\"show_div('7');\" id='week_7' class='week'>토</a></li>";
						if($first_show == "") {
							$first_show = "7";
						}
					}
        ?>
        </ul>
        <div style="clear:both;"></div>				
        <?
					if($so_doctornum_sun != 0) {
						$s_time = $so_work_stime_sun;
						$e_time = $so_work_etime_sun;
						$lun_s_time = str_replace(":","",$so_ext_stime_sun);
						$lun_e_time = str_replace(":","",$so_ext_etime_sun);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_sun);
						$capa_cnt = $so_doctornum_sun * 5;				
				?>
        <!-- 일요일 -->
        <div style="display:none;" id="div_1" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_sun == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='sun_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='sun_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='sun_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='sun_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 일요일 -->
        <? } ?>
        
        
        
        <?
					if($so_doctornum_mon != 0) {
						$s_time = $so_work_stime_mon;
						$e_time = $so_work_etime_mon;
						$lun_s_time = str_replace(":","",$so_ext_stime_mon);
						$lun_e_time = str_replace(":","",$so_ext_etime_mon);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_mon);
						$capa_cnt = $so_doctornum_mon * 5;						
				?>
        <!-- 월요일 -->
        <div style="display:none;" id="div_2" class="capa_show">
            <table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_mon == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='mon_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='mon_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='mon_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='mon_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 월요일 -->
        <? } ?>
        
        
        <?
					if($so_doctornum_tue != 0) {
						$s_time = $so_work_stime_tue;
						$e_time = $so_work_etime_tue;
						$lun_s_time = str_replace(":","",$so_ext_stime_tue);
						$lun_e_time = str_replace(":","",$so_ext_etime_tue);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_tue);
						$capa_cnt = $so_doctornum_tue * 5;				
				?>
        <!-- 화요일 -->
        <div style="display:none;" id="div_3" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_tue == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='tue_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='tue_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='tue_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='tue_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 화요일 -->
        <? } ?>
        
        
        <?
					if($so_doctornum_wed != 0) {
						$s_time = $so_work_stime_wed;
						$e_time = $so_work_etime_wed;
						$lun_s_time = str_replace(":","",$so_ext_stime_wed);
						$lun_e_time = str_replace(":","",$so_ext_etime_wed);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_wed);
						$capa_cnt = $so_doctornum_wed * 5;						
				?>
        <!-- 수요일 -->
        <div style="display:none;" id="div_4" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_wed == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='wed_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='wed_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='wed_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='wed_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 수요일 -->
        <? } ?>
        
        
        <?
					if($so_doctornum_thu != 0) {
						$s_time = $so_work_stime_thu;
						$e_time = $so_work_etime_thu;
						$lun_s_time = str_replace(":","",$so_ext_stime_thu);
						$lun_e_time = str_replace(":","",$so_ext_etime_thu);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_thu);
						$capa_cnt = $so_doctornum_thu * 5;						
				?>
        <!-- 목요일 -->
        <div style="display:none;" id="div_5" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_thu == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='thu_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='thu_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='thu_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='thu_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 목요일 -->
        <? } ?>
        
        <?
					if($so_doctornum_fri != 0) {
						$s_time = $so_work_stime_fri;
						$e_time = $so_work_etime_fri;
						$lun_s_time = str_replace(":","",$so_ext_stime_fri);
						$lun_e_time = str_replace(":","",$so_ext_etime_fri);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_fri);
						$capa_cnt = $so_doctornum_fri * 5;				
				?>
        <!-- 금요일 -->
        <div style="display:none;" id="div_6" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_fri == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='fri_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='fri_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='fri_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='fri_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 금요일 -->
        <? } ?>
        
        <?
					if($so_doctornum_sat != 0) {
						$s_time = $so_work_stime_sat;
						$e_time = $so_work_etime_sat;
						$lun_s_time = str_replace(":","",$so_ext_stime_sat);
						$lun_e_time = str_replace(":","",$so_ext_etime_sat);
						$time_cnt = $C_Func->loop_cnt($s_time, $e_time, $so_rsinterval_sat);
						$capa_cnt = $so_doctornum_sat * 5;						
				?>
        <!-- 토요일 -->
        <div style="display:none;" id="div_7" class="capa_show">
        	<table cellspacing="0" border="0">                      
              <colgroup>
              <col width="300" />
              <col width="*" />
              </colgroup>
              <thead>
                <tr class="first">
                	<th>시간</th>
                  <th>캡파</th>
                </tr>
              </thead>
              <tbody>
								<?
									$k=0;
									for($i=0; $i<$time_cnt; $i++) {
										$ori_time = $s_time;
										if($so_rsinterval_sat == "H") {
											$s_time = $C_Func->plus_minute($s_time, 60);
										}else{
											$s_time = $C_Func->plus_minute($s_time, 30);
										}
										
										$chk_time = str_replace(":","",$s_time);
										
										if($chk_time > $lun_s_time && $chk_time <= $lun_e_time) {
											
										}else{
											echo "
												<tr>
													<td>
														<input type='text' name='sat_sdate_" . $k . "' size='10' value='" . $ori_time ."' />
														~
														<input type='text' name='sat_edate_" . $k . "' size='10' value='" . $s_time ."' />
													</td>
													<td>
														<input type='text' name='sat_capa_" . $k . "' size='10' value='" . $capa_cnt ."' />T
													</td>
													</tr>							
											";
											$k++;
										}		
									}
									echo "<input type='hidden' name='sat_cnt' value='" . $k . "' />";
								?>
            	</tbody>
            </table>
        </div>
        <!-- 토요일 -->
        <? } ?>		
				
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
<script type="text/javascript">

	$(document).ready(function(){								   
		<?
			if($first_show != '') {
		?>							   	
			show_div('<?=$first_show?>');
		<?
			}
		?>
		
		
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		$('#img_submit').click(function() {
			$('#base_form').attr('action','./proc/reserve_proc.php');
			$('#base_form').submit();
			
		});
	});
	
	
	function show_div(str) {
		$('.week').removeClass('active');
		$('.capa_show').hide();
		$('#div_' + str).show();
		$('#week_' + str).addClass('active');
	}
</script>
