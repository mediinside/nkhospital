<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	include_once($GP -> CLS."/class.calendar.php");
	$C_Calendar 	= new Calendar;	
	
	
	$rst = $C_Calendar -> TrestSection_All($args);
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $_GET['ts_idx'], "", "::: 선택 :::");	
?>
<body>
<div class=""><!--// 전체를 감싸는 Wrap -->		

			<div class="boxCaseValue">
				<span><span class="imgColor Val1"></span>인터넷 예약 : <span id="rs1" class="valNum"></span></span>
				<span><span class="imgColor Val2"></span>전화 예약 : <span id="rs2" class="valNum"></span></span>
				<span><span class="imgColor Val3"></span>당일접수 : <span id="rs3" class="valNum"></span></span>
				<span><span class="imgColor Val4"></span>진료대기 : <span id="rs4" class="valNum"></span></span>
				<span><span class="imgColor Val5"></span>진료중 : <span id="rs5" class="valNum"></span></span>
				<span><span class="imgColor Val6"></span>진료완료 : <span id="rs6" class="valNum"></span></span>
				<span><span class="imgColor Val7"></span>예약부도 : <span id="rs7" class="valNum"></span></span>
				<span><span class="imgColor Val8"></span>총원 : <span id="rs8" class="valNum"></span></span>
			</div>
			<!-- 요기다 붙이세요! -->
			<div class="calendar_div">
				<div style="padding-top:10px;"> 
					<div id="calhead" style="padding-left:1px;padding-right:1px;">
					<div class="cHead">
						<div class="ftitle">예약 현황</div>
						<div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
						<div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
					</div>
					<div id="caltoolbar" class="ctoolbar">
						<div id="faddbtn" class="fbutton">
							<div><span title='섀 예약' class="addcal"> 새 예약 </span></div>
						</div>
						<div class="btnseparator"></div>
						<div id="showtodaybtn" class="fbutton">
							<div><span title='오늘' class="showtoday"> 오늘</span></div>
						</div>
						<div class="btnseparator"></div>
						<div id="showdaybtn" class="fbutton">
							<div><span title='일간' class="showdayview">일간</span></div>
						</div>
						<div  id="showweekbtn" class="fbutton fcurrent">
							<div><span title='주간' class="showweekview">주간</span></div>
						</div>
						<div  id="showmonthbtn" class="fbutton">
							<div><span title='월간' class="showmonthview">월간</span></div>
						</div>
						<div class="btnseparator"></div>
						<div  id="showreflashbtn" class="fbutton">
							<div><span title='새로고침' class="showdayflash">새로고침</span></div>
						</div>
						<div class="btnseparator"></div>
						<div id="sfprevbtn" title="Prev"  class="fbutton"> <span class="fprev"></span> </div>
						<div id="sfnextbtn" title="Next" class="fbutton"> <span class="fnext"></span> </div>
						<div class="fshowdatep fbutton">
							<div>
								<input type="hidden" name="txtshow" id="hdtxtshow" />
								<input type="hidden" name="j_sdate" id="j_sdate" />
								<input type="hidden" name="j_edate" id="j_edate" />
								<span id="txtdatetimeshow">Loading</span></div>
						</div>
						<div style="float:right; padding-right:20px;">
							<span>진료과</span>&nbsp;<?=$sel_treat?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div style="padding:1px;">
					<div class="t1 chromeColor"> &nbsp;</div>
					<div class="t2 chromeColor"> &nbsp;</div>
					<div id="dvCalMain" class="calmain printborder">
						<div id="gridcontainer" style="overflow-y: visible;"> </div>
					</div>
					<div class="t2 chromeColor"> &nbsp;</div>
					<div class="t1 chromeColor"> &nbsp; </div>
				</div>			
				<!-- 요기다 붙이세요! -->
			</div>
		</div>		
</div><!-- 전체를 감싸는 Wrap //-->
<link href="/admin/reserve/calendar/css/dailog.css" rel="stylesheet" type="text/css" />
<link href="/admin/reserve/calendar/css/calendar.css" rel="stylesheet" type="text/css" />
<link href="/admin/reserve/calendar/css/dp.css" rel="stylesheet" type="text/css" />
<link href="/admin/reserve/calendar/css/alert.css" rel="stylesheet" type="text/css" />
<link href="/admin/reserve/calendar/css/main.css" rel="stylesheet" type="text/css" />
<script src="/admin/reserve/calendar/src/jquery.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/Common.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/datepicker_lang_KO.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/jquery.datepicker.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/jquery.alert.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/wdCalendar_lang_KO.js" type="text/javascript"></script>
<script src="/admin/reserve/calendar/src/Plugins/jquery.calendar.js" type="text/javascript"></script>
<script type="text/javascript">
		
		function reserve_data() {
				var s_date = $('#j_sdate').val();
				var e_date = $('#j_edate').val();
				
				$.ajax({
					type: "POST",
					url: "./proc/reserve_proc.php",
					data: "mode=RSDATA&s_date=" + s_date + "&e_date=" + e_date,
					dataType: "json",
					success: function(msg) {
						
						if($.trim(msg['msg']) == "true") {
							$('#rs1').text(msg['rs1']);
							$('#rs2').text(msg['rs2']);
							$('#rs3').text(msg['rs3']);
							$('#rs4').text(msg['rs4']);
							$('#rs5').text(msg['rs5']);
							$('#rs6').text(msg['rs6']);
							$('#rs7').text(msg['rs7']);
							$('#rs8').text(msg['rs8']);							
						}
						
					},
					error: function(xhr, status, error) { alert(error); }
				});
		}

		$(document).ready(function() {     
			 	var view="week";          			 
				var DATA_FEED_URL = "./proc/datafeed.db.php";				
				var treat_num = "";
				var op = {
						view: view,
						theme:3,
						<?
							if($_GET['y'] && $_GET['m'] && $_GET['d']) {
								$y = $_GET['y'];
								$m = $_GET['m'] - 1;
								$d = $_GET['d'];								
						?>
						showday: new Date(<?=$y?>,<?=$m?>,<?=$d?>),
						<? }else{?>
						showday: new Date(),
						<? } ?>
						treat: treat_num,
						EditCmdhandler:Edit,
						DeleteCmdhandler:Delete,
						ViewCmdhandler:View,    
						onWeekOrMonthToDay:wtd,
						onBeforeRequestData: cal_beforerequest,
						onAfterRequestData: cal_afterrequest,
						onRequestDataError: cal_onerror, 
						autoload:true,
						url: DATA_FEED_URL + "?method=list",  
						quickAddUrl: DATA_FEED_URL + "?method=add", 
						quickUpdateUrl: DATA_FEED_URL + "?method=update",
						quickDeleteUrl: DATA_FEED_URL + "?method=remove",
						quickProductUrl: DATA_FEED_URL + "?method=product"        
				};
				var $dv = $("#calhead");
				var _MH = document.documentElement.clientHeight;				
				var dvH = $dv.height() + 2;
				op.height = _MH - dvH;
				op.eventItems =[];

				$("#gridcontainer").bcalendar(op).BcalGetOp();	
				
				<?
					if($_GET['y'] && $_GET['m'] && $_GET['d']) {
						$y = $_GET['y'];
						$m = $_GET['m'] - 1;
						$d = $_GET['d'];
				?>
				var d = new Date(<?=$y?>,<?=$m?>,<?=$d?>);				
				var p = $("#gridcontainer").gotoDate(d).BcalGetOp();	
				<?
					}else{
				?>
				var p = $("#gridcontainer").gotoDate().BcalGetOp();	
				<?
					}
				?>				
				//for (myKey in p){
				//		alert ("p["+myKey +"] = "+p[myKey]);
				//} 
				
				if (p && p.datestrshow) {
						$("#txtdatetimeshow").text(p.datestrshow);
						$('#j_sdate').val(p.jstart);
						$('#j_edate').val(p.jend);
						reserve_data();
				}
				
				
				
				$("#caltoolbar").noSelect();
				
				$("#hdtxtshow").datepicker({ 
					picker: "#txtdatetimeshow", 
					showtarget: $("#txtdatetimeshow"),
					onReturn:function(r){                          
						var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
						if (p && p.datestrshow) {
							$("#txtdatetimeshow").text(p.datestrshow);
						}
					} 
				});
				
				function cal_beforerequest(type)
				{							
						var t="Loading data...";
						switch(type)
						{
								case 1:
										t="Loading data...";
										break;
								case 2:                      
								case 3:  
								case 4:    
										t="The request is being processed ...";                                   
										break;
						}
						$("#errorpannel").hide();								
						$("#loadingpannel").html(t).show(); 							
				}
				
				function cal_afterrequest(type)
				{
						switch(type)
						{
								case 1:
										$("#loadingpannel").hide();
										break;
								case 2:
								case 3:
								case 4:
										$("#loadingpannel").html("^______^!");
										window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
										reserve_data();
								break;
						}              
					 
				}
				
				function cal_onerror(type,data)
				{
						$("#errorpannel").show();
				}
				
				function Edit(data)
				{
					 var eurl="./reserve_edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
						if(data)
						{
								var url = StrFormat(eurl,data);
								OpenModelWindow(url,{ width: 500, height: 450, caption:"예약 상세보기",onclose:function(){
									 $("#gridcontainer").reload();
									 //window.location.reload();
								}});
						}
				}   				
				
				
				function View(data)
				{
						var str = "";
						$.each(data, function(i, item){
								str += "[" + i + "]: " + item + "\n";
						});
						//alert(str);               
				}   
				
				function Delete(data,callback)
				{           
						
						$.alerts.okButton="Ok";  
						$.alerts.cancelButton="Cancel";  
						hiConfirm("예약을 취소하시겠습니까?", 'Confirm',function(r){ r && callback(0);});           
				}
				
				function wtd(p)
				{
					 if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								reserve_data();
						}
						$("#caltoolbar div.fcurrent").each(function() {
								$(this).removeClass("fcurrent");
						})
						$("#showdaybtn").addClass("fcurrent");
				}
				
				//to show day view
				$("#showdaybtn").click(function(e) {
						//document.location.href="#day";
						$("#caltoolbar div.fcurrent").each(function() {
								$(this).removeClass("fcurrent");
						})
						$(this).addClass("fcurrent");
						var p = $("#gridcontainer").swtichView("day").BcalGetOp();			
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								op.view='day';
								reserve_data();
						}
				});
				
				//to show week view
				$("#showweekbtn").click(function(e) {
						//document.location.href="#week";
						$("#caltoolbar div.fcurrent").each(function() {
								$(this).removeClass("fcurrent");
						})
						$(this).addClass("fcurrent");
						var p = $("#gridcontainer").swtichView("week").BcalGetOp();
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								op.view='week';
								reserve_data();
						}

				});
				
				//to show month view
				$("#showmonthbtn").click(function(e) {
						//document.location.href="#month";
						$("#caltoolbar div.fcurrent").each(function() {
								$(this).removeClass("fcurrent");
						})
						$(this).addClass("fcurrent");
						var p = $("#gridcontainer").swtichView("month").BcalGetOp();
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								op.view='month';
								reserve_data();
						}
				});
				
				$("#showreflashbtn").click(function(e){
						$("#gridcontainer").reload();
				});
				
				//Add a new event
				$("#faddbtn").click(function(e) {
						var url ="./reserve_edit.php";
						OpenModelWindow(url,{ width: 500, height: 450, caption: "새 예약하기"});
				});
				
				//go to today
				$("#showtodaybtn").click(function(e) {
						var p = $("#gridcontainer").gotoDate().BcalGetOp();
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								op.view='day';
								reserve_data();
						}
				});
				
				//previous date range
				$("#sfprevbtn").click(function(e) {
						var p = $("#gridcontainer").previousRange().BcalGetOp();
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								reserve_data();
						}

				});
				
				//next date range
				$("#sfnextbtn").click(function(e) {
						var p = $("#gridcontainer").nextRange().BcalGetOp();
						if (p && p.datestrshow) {
								$("#txtdatetimeshow").text(p.datestrshow);
								$('#j_sdate').val(p.jstart);
								$('#j_edate').val(p.jend);
								reserve_data();
						}
				});
				
				
				$('#ts_idx').change(function(){
						var ts_idx = $(this).val();
						op.treat = ts_idx;		
						
						$("#gridcontainer").BcalSetOp(op);						
						$("#gridcontainer").reload();
				});
				
				$(window).bind('resizeEnd', function() {
						window.location.reload();
				});
				
				$(window).resize(function() {
						if(this.resizeTO) 
							clearTimeout(this.resizeTO);
							this.resizeTO = setTimeout(function() {
								$(this).trigger('resizeEnd');
							}, 300);
				});
		});
</script>
</body>
</html>