<?php
	include_once("../../_init.php");
	include_once($GP -> CLS."/class.calendar.php");
	$C_Calendar 	= new Calendar;	

	if($_GET["id"]){
		$event = $C_Calendar->getCalendarByRange($_GET["id"]);
	}
	
	$rst = $C_Calendar -> TrestSection_All($args);
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $event->ts_idx, "", "::: 선택 :::");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>예약 상세보기</title>    
    <link href="/admin/reserve/calendar/css/main.css" rel="stylesheet" type="text/css" />       
    <link href="/admin/reserve/calendar/css/dp.css" rel="stylesheet" />    
    <link href="/admin/reserve/calendar/css/dropdown.css" rel="stylesheet" />    
    <link href="/admin/reserve/calendar/css/colorselect.css" rel="stylesheet" />      
		<link rel="stylesheet" type="text/css" href="/css/_adm/basic.css" media="all" />  
		<script type="text/javascript" charset="UTF-8" src="/admin/js/jquery-1.9.1.js"></script>
		<script type="text/javascript" charset="UTF-8" src="/admin/js/common.js"></script>
		<script type="text/javascript" charset="UTF-8" src="/admin/js/jquery.simplemodal.js"></script>
    <script src="/admin/reserve/calendar/src/jquery.js" type="text/javascript"></script>    
    <script src="/admin/reserve/calendar/src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="/admin/reserve/calendar/src/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="/admin/reserve/calendar/src/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="/admin/reserve/calendar/src/Plugins/datepicker_lang_KO.js" type="text/javascript"></script>        
    <script src="/admin/reserve/calendar/src/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="/admin/reserve/calendar/src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="/admin/reserve/calendar/src/Plugins/jquery.colorselect.js" type="text/javascript"></script>         
    <script type="text/javascript">
        if (!DateAdd || typeof (DateDiff) != "function") {
            var DateAdd = function(interval, number, idate) {
                number = parseInt(number);
                var date;
                if (typeof (idate) == "string") {
                    date = idate.split(/\D/);
                    eval("var date = new Date(" + date.join(",") + ")");
                }
                if (typeof (idate) == "object") {
                    date = new Date(idate.toString());
                }
                switch (interval) {
                    case "y": date.setFullYear(date.getFullYear() + number); break;
                    case "m": date.setMonth(date.getMonth() + number); break;
                    case "d": date.setDate(date.getDate() + number); break;
                    case "w": date.setDate(date.getDate() + 7 * number); break;
                    case "h": date.setHours(date.getHours() + number); break;
                    case "n": date.setMinutes(date.getMinutes() + number); break;
                    case "s": date.setSeconds(date.getSeconds() + number); break;
                    case "l": date.setMilliseconds(date.getMilliseconds() + number); break;
                }
                return date;
            }
        }
				
        function getHM(date)
        {
             var hour =date.getHours();
             var minute= date.getMinutes();
             var ret= (hour>9?hour:"0"+hour)+":"+(minute>9?minute:"0"+minute) ;
             return ret;
        }
				
        $(document).ready(function() {
            //debugger;
            var DATA_FEED_URL = "./proc/datafeed.db.php";
            var arrT = [];
            var tt = "{0}:{1}";
            for (var i = 0; i < 24; i++) {
                arrT.push({ text: StrFormat(tt, [i >= 10 ? i : "0" + i, "00"]) }, { text: StrFormat(tt, [i >= 10 ? i : "0" + i, "30"]) });
            }
						
						$.ajax({
							url: './proc/reserve_proc.php',
							type: 'POST',
							data: "mode=TREATPRODUCT_SEL&ts_idx=<?=$event->ts_idx?>&pd_idx=<?=$event->mp_idx?>",
							timeout: 1000 * 10 , //10초동안 응답이 없으면 error처리
							contentTypeString : "text/xml; charset=utf-8",
							error: function(){ return;  },
							success: function(data){
								$('#mp_idx').empty();
								$('#mp_idx').append(data);
								return;
							}
						});							
						
						$('#ts_idx').change(function(){
							var val = $(this).val();
							
							var logingImg = "<div style='width:100%; text-align:center; padding-top:50px;'><img src='/admin/img/common/loading.gif'><div>";	
							$.ajax({
								url: './proc/reserve_proc.php',
								type: 'POST',
								data: "mode=TREATPRODUCT_SEL&ts_idx=" + val,
								timeout: 1000 * 10 , //10초동안 응답이 없으면 error처리
								contentTypeString : "text/xml; charset=utf-8",
								error: function(){ return;  },
								success: function(data){
									$('#mp_idx').empty();
									$('#mp_idx').append(data);
									return;
								}
							});								
						});
						
						
            $("#timezone").val(new Date().getTimezoneOffset()/60 * -1);
						
            $("#stparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
						
            $("#etparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
						
            var check = $("#IsAllDayEvent").click(function(e) {
                if (this.checked) {
                    $("#stparttime").val("00:00").hide();
                    $("#etparttime").val("00:00").hide();
                }
                else {
                    var d = new Date();
                    var p = 60 - d.getMinutes();
                    if (p > 30) p = p - 30;
                    d = DateAdd("n", p, d);
                    $("#stparttime").val(getHM(d)).show();
                    $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
                }
            });
						
            if (check[0].checked) {
                $("#stparttime").val("00:00").hide();
                $("#etparttime").val("00:00").hide();
            }
						
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
						
            $("#Closebtn").click(function() { CloseModelWindow(); });
						
            $("#Deletebtn").click(function() {
                 if (confirm("예약을 취소하시겠습니까?")) { 
								 		var mr_idx = $('#mr_idx').val();
                    var param = [{ "name": "calendarId", value: mr_idx}];                
                    $.post(DATA_FEED_URL + "?method=remove",
                        param,
                        function(data){
                              if (data.IsSuccess) {
                                    alert(data.Msg); 
                                    CloseModelWindow(null,true);                            
                                }
                                else {
                                    alert("Error occurs.\r\n" + data.Msg);
                                }
                        }
                    ,"json");
                }
            });
            
           $("#stpartdate,#etpartdate").datepicker({ picker: "<button class='calpick'></button>"}); 
					 
            var cv =$("#colorvalue").val();
            if(cv=="")
            {
                cv="-1";
            }
						
            $("#calendarcolor").colorselect({ title: "상태", index: cv, hiddenid: "colorvalue" });
						
            //to define parameters of ajaxform
            var options = {
                beforeSubmit: function() {
                    return true;
                },
                dataType: "json",
                success: function(data) {
                    alert(data.Msg);
                    if (data.IsSuccess) {
												parent.reserve_data();
                        CloseModelWindow(null,true);  
                    }
                }
            };
						
            $.validator.addMethod("date", function(value, element) {                             
                var arrs = value.split(i18n.datepicker.dateformat.separator);
                var year = arrs[i18n.datepicker.dateformat.year_index];
                var month = arrs[i18n.datepicker.dateformat.month_index];
                var day = arrs[i18n.datepicker.dateformat.day_index];
                var standvalue = [year,month,day].join("-");
                return this.optional(element) || /^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3-9]|1[0-2])[\/\-\.](?:29|30))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3,5,7,8]|1[02])[\/\-\.]31)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:16|[2468][048]|[3579][26])00[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1-9]|1[0-2])[\/\-\.](?:0?[1-9]|1\d|2[0-8]))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?:\d{1,3})?)?$/.test(standvalue);
            }, "Invalid date format");
						
            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
            }, "Invalid time format");
						
            $.validator.addMethod("safe", function(value, element) {
                return this.optional(element) || /^[^$\<\>]+$/.test(value);
            }, "$<> not allowed");
						
            $("#fmEdit").validate({																	                
								rules:{
									"bbit-cal-what" : { required:true },
									"ts_idx" : { required:true },
									"mp_idx" : { required:true },
									"mr_mobile" : { required:true },
									"stpartdate" : { required:true },
									"stparttime" : { required:true },
									"etparttime" : { required:true }
								},
								messages:{
									"bbit-cal-what" : { required:"이름을 입력하세요" },
									"ts_idx" : { required:"과를 선택하세요" },
									"mp_idx" : { required:"시술을 선택하세요" },
									"mr_mobile" : { required:"연락처를 입력하세요" },
									"stpartdate" : { required:"날짜를 선택하세요" },									
									"stparttime" : { required:"시간을 입력하세요" },
									"etparttime" : { required:"시간을 입력하세요" }
								},
                submitHandler: function(form) { $("#fmEdit").ajaxSubmit(options); },
								errorElement: "div",
                errorClass: "cusErrorPanel",
                errorPlacement: function(error, element) {
                    showerror(error, element);
                }
            });
						
            function showerror(error, target) {
                var pos = target.position();
                var height = target.height();
                var newpos = { left: pos.left, top: pos.top + height + 2 }
                var form = $("#fmEdit");             
                error.appendTo(form).css(newpos);
            }
        });
    </script>      
    <style type="text/css">     
    .calpick     {        
        width:16px;   
        height:16px;     
        border:none;        
        cursor:pointer;        
        background:url("./calendar/sample-css/cal.gif") no-repeat center 2px;        
        margin-left:-22px;    
    }      
    </style>
  </head>
  <body>    
    <div class="calendar_div">      
      <div class="toolBotton">           
        <a id="Savebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Save"  title="저장">저장(<u>S</u>)</span>          
        </a>                           
        <?php if(isset($event)){ ?>
        <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">                    
          <span class="Delete" title="삭제">삭제(<u>D</u>)</span>                
        </a>             
        <?php } ?>            
        <a id="Closebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Close" title="닫기" >닫기</span></a>            
        </a>        
      </div>                  
      <div style="clear: both">         
      </div>        
      <div class="infocontainer">            
        <form action="./proc/datafeed.db.php?method=adddetails<?php echo isset($event)?"&id=".$event->mr_idx:""; ?>" class="fform" id="fmEdit" method="post">  
					<input type="hidden" name="mr_idx" id="mr_idx" value="<?=$event->mr_idx?>" />
        	<input type="hidden" name="mb_code" id="mb_code" value="<?=$event->mb_code?>" />
        	<input type="hidden" name="mb_name" id="mb_name" value="<?=$event->mb_name?>" />
					<input id="colorvalue" name="colorvalue" type="hidden" value="<?php echo isset($event)?$event->mr_Color:"" ?>" /> 
					<label>                    
            <span>* 예약상태:</span>                    
            <div id="calendarcolor"></div>
					</label>  
					<label>             
						<span>*고객명:</span>                    
						<input MaxLength="200" class="required safe" id="bbit-cal-what" name="bbit-cal-what" style="width:20%;" type="text" value="<?=$event->mb_name?>" />
						<input id="bbit-cal-quickAddBTN" type="button" value="회원찾기" onclick="layerPop_new('iframset','./mem_search.php', 550, 400)" />
					</label>
					<label>
						<span>연락처</span>
						<input MaxLength="200" class="required safe" id="mr_mobile" name="mr_mobile" style="width:20%;" type="text" value="<?php if($event->mr_mobile !==''){ echo $event->mr_mobile;}else{ echo $event->mb_mobile; } ?>" />
					</label>
					<label>
						<span>이메일</span>
					  <input MaxLength="200" class="safe" id="mr_email" name="mr_email" style="width:25%;" type="text" value="<?php if($event->mr_email !==''){ echo $event->mr_email;}else{ echo $event->mb_email; } ?>" />
					</label>  
					<label>             
          <div style="display:inline-block;">                    
            <span>*진료과:</span>                    
            <?=$sel_treat?>
					</div>
					<div style="display:inline-block;">
						<span>*시술:</span>
						<select id="mp_idx" name="mp_idx">
							<option value="">::: 선택하세요 :::</option>
					  </select>						
          </div> 
					</label>                 
          <label>                    
            <span>*예약시간:
            </span>                    
            <div>  
              <?php if(isset($event)){
                  $sarr = explode(" ", $C_Func->php2JsTime($C_Func->mySql2PhpTime($event->mr_s_time)));
                  $earr = explode(" ", $C_Func->php2JsTime($C_Func->mySql2PhpTime($event->mr_e_time)));
              }?>                    
              <input MaxLength="10" class="required date" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$sarr[0]:""; ?>" />                       
              <input MaxLength="5" class="required time" id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$sarr[1]:""; ?>" /> ~                       
              <input MaxLength="50" class="required time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$earr[1]:""; ?>" />                                            
              <label class="checkp"> 
                <input id="IsAllDayEvent" name="IsAllDayEvent" type="checkbox" value="1" <?php if(isset($event)&&$event->mr_alldayevent!=0) {echo "checked";} ?>/>하루종일
              </label>                    
            </div>                
          </label>                           
          <label>                    
            <span>메모:</span>                    
						<textarea cols="20" id="Description" name="Description" rows="2" style="width:95%; height:70px">
						<?php echo isset($event)?$event->mr_memo:""; ?>
						</textarea>                
          </label>                
          <input id="timezone" name="timezone" type="hidden" value="" />           
        </form>         
      </div>         
    </div>
  </body>
</html>