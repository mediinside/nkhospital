<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP->CLS."class.analytics.php");
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Analytics 	= new Analytics;
	$C_Button 		= new Button;	
	
	
	//년월이 관련 변수 설정
	if (!$_GET['s_date']) {
		$s_date = date("Y-m-d");		
	}else{
		$s_date = $_GET['s_date'];		
	}
	if (!$_GET['e_date']) {
		$e_date = date("Y-m-d");		
	}else{
		$e_date = $_GET['e_date'];		
	}
		
	
	$args = array();
	$args['s_date'] = $s_date;
	$args['e_date'] = $e_date;
	$args['show_row'] = 15;
	$args['pagetype'] = "admin";
	$data = "";	
	$data = $C_Analytics->Analytics_Video_List(array_merge($_GET,$_POST,$args));
	
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<!--? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?-->										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				
					<strong class="tit">기간검색</strong>
					<span><input type="text" name="s_date" id="s_date" value="<?=$s_date?>" class="input_text" size="13"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$e_date?>" class="input_text" size="13" /></span>
          <span><button id="search_submit" class="btnSearch ">검색</button></span>
           <span><input type="button" id="excel_btn" value="EXCEL" /></span>	
				   		
			</ul>
			</form>
			</div>
		</div>
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard" style="display:inline-block; vertical-align:top;">					 
						<table style="width:200px;">            	
							<thead>
								<tr>
									<th scope="col">센터별</th>
									<th scope="col">수량</th>
								</tr>
							</thead>
							<tbody>
								<?
								foreach($GP -> NEW_MOBILE_CENTER as $k=>$v){
									$cnt = "0";
									$args = "";
									$args['s_date'] = $s_date;
									$args['e_date'] = $e_date;
									$args["clinic1"] = $k;
									$cnt = $C_Analytics->Analytics_Clinic_List($args);
									echo '<tr><td>'.$v.'</td><td>'.$cnt["cnt"].'</td></tr>';
								}
								?>
							</tbody>
						</table>
				</div>			
        
        <div class="boxMemberBoard" style="display:inline-block; vertical-align:top;">					 
						<table style="width:200px;">            	
							<thead>
								<tr>
									<th scope="col">진료과별</th>
									<th scope="col">수량</th>
								</tr>
							</thead>
							<tbody>
								<?
								foreach($GP -> NEW_MOBILE_CLINIC as $k=>$v){
									$cnt = "0";
									$args = "";
									$args['s_date'] = $s_date;
									$args['e_date'] = $e_date;
									$args["clinic2"] = $k;
									$cnt = $C_Analytics->Analytics_Clinic_List($args);
									echo '<tr><td>'.$v.'</td><td>'.$cnt["cnt"].'</td></tr>';
								}
								?>
							</tbody>
						</table>
				</div>			
        
        <div class="boxMemberBoard" style="display:inline-block; vertical-align:top;">					 
						<table style="width:200px;">            	
							<thead>
								<tr>
									<th scope="col">특수클리닉</th>
									<th scope="col">수량</th>
								</tr>
							</thead>
							<tbody>
								<?
								foreach($GP -> NEW_MOBILE_SPECIAL as $k=>$v){
									$cnt = "0";
									$args = "";
									$args['s_date'] = $s_date;
									$args['e_date'] = $e_date;
									$args["clinic3"] = $k;
									$cnt = $C_Analytics->Analytics_Clinic_List($args);
									echo '<tr><td>'.$v.'</td><td>'.$cnt["cnt"].'</td></tr>';
								}
								?>
							</tbody>
						</table>
				</div>			
        
        <div class="boxMemberBoard" style="display:inline-block; vertical-align:top;">					 
						<table style="width:200px;">            	
							<thead>
								<tr>
									<th scope="col">의사별</th>
									<th scope="col">수량</th>
								</tr>
							</thead>
							<tbody>
								<?
								$dummy = 1;
								for ($i = 0 ; $i < count($data); $i++) {
									$dr_name 		= $data[$i]['vd_dr_name'];
									$cnt					= $data[$i]['cnt'];											
								?>
								<tr>
									<td><?=$dr_name?></td>
									<td><?=$cnt?></td>
								</tr>
								<?							
										}
								?>
							</tbody>
						</table>
				</div>			
        
			</div>
		
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->
<script type="text/javascript">

	$(document).ready(function(){	
		
		//엑셀 출력
		$('#excel_btn').click(function(){
				var string = $("#base_form").serialize();
				location.href = "os_excel.php?excel_file=일별통계" + "&" + string;
				return false;
		});

	});
</script>
</body>
</html>