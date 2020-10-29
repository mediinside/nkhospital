$(document).ready(function(){
	$("#btn_confirm").click(function (){
		var agreeYN = $("input:radio[name='agreeYN']:checked").val();
		if(agreeYN != "Y") {
			warningBox("예약자 정보이용에 동의하셔야 합니다.");
			return false;	
		}
		
		if($("#r_name").val().length == ""){
			warningBox("이름을 정확히 입력해 주세요.");
			$("#r_name").focus();
			return false;	
		}			
		

		if($("#r_birth").val().length != 6){
			warningBox("생년월일을 정확히 입력해 주세요.");
			$("#r_name").focus();
			return false;	
		}			

		if($("input:radio[name='r_sex']").is(":checked") == false){
			warningBox("성별을 선택해주세요.");
			return false;	
		}	
		
		var phone1 = $.trim($("#r_phone1").html());
		var phone2 = $.trim($("#r_phone2").val());
		var phone3 = $.trim($("#r_phone3").val());
		if(phone2.length < 3 || phone3.length < 3) {
				warningBox("핸드폰 번호를 정확하게 입력해 주세요");
				return false;
		}
		var phone = phone1+"-"+phone2+"-"+phone3;
		$("#r_phone").val(phone);	
		
		$("#bForm").attr("action","/online/step2/");
		$("#bForm").submit();
	});
	$("#btn_confirm2").click(function (){
		if($("#p_name").val().length == ""){
			warningBox("이름을 정확히 입력해 주세요.");
			$("#p_name").focus();
			return false;	
		}			
		if($("#p_birth").val().length != 6){
			warningBox("생년월일을 정확히 입력해 주세요.");
			$("#p_name").focus();
			return false;	
		}			

		if($("input:radio[name='p_sex']").is(":checked") == false){
			warningBox("성별을 선택해주세요.");
			return false;	
		}	
		
		var phone1 = $.trim($("#p_phone1").html());
		var phone2 = $.trim($("#p_phone2").val());
		var phone3 = $.trim($("#p_phone3").val());
		if(phone2.length < 3 || phone3.length < 3) {
			warningBox("핸드폰 번호를 정확하게 입력해 주세요");
			return false;
		}
		var phone = phone1+"-"+phone2+"-"+phone3;
		$("#p_phone").val(phone);	
		
		if($("#p_treat").data("value") == "") {
			warningBox("진료과목을 선택해주세요.");
			return false;
		}
		$("#t_code").val($("#p_treat").data("value"));
		$("#t_code_name").val($("#p_treat").html());
		
		$("#pForm").attr("action","/online/step3/");
		$("#pForm").submit();
	});	
	
		fn.init = function(){
			fn.datepickerDrow = false;
			fn.datepicker = $(".entry-datepicker").datepicker({
				monthNames: ['1','2','3','4','5','6','7','8','9','10','11','12'],
				monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
				dayNamesMin: [ "su", "mo", "tu", "we", "th", "fr", "sa" ],
				minDate: new Date(),
				closeText: '닫기',
				prevText: '이전달',
				nextText: '다음달',
				currentText: '오늘',
				dateFormat: 'yy-mm-dd',
				showMonthAfterYear: true,
				onDraw:  function(calendar, inst){
					if (!fn.datepickerDrow){
						fn.datepickerDrow = true;
					}
					if (fn.doctorSchedule && !$.isEmptyObject(fn.doctorSchedule)){
						setTimeout(function(){
							$(".entry-datepicker").find('.ui-state-active').addClass('ui-state-select');
							fn.datepickerIsEnable(fn.doctorSchedule);
						});
					}
				},
				onSelect : function(date,el){
					var day  = el.selectedDay,
                    mon  = el.selectedMonth,
                    year = el.selectedYear;

					var el = $(el.dpDiv).find('[data-year="'+year+'"][data-month="'+mon+'"]').filter(function() {
						return $(this).find('a').text().trim() == day;
					});
					$("#time_result2").empty();
					$("#time_result").empty();					
					
					if (el.hasClass('enable')){
						$("#r_day").val(date);
						/*
						var dr_code = $("#r_doctor").data("value");	
							$.ajax({
								type: "POST",
								url: "/con/ajax/doctor_ajax/",
								data: "mode=time&dr_code="+dr_code+"&r_date="+date,
								dataType: "text",
								beforeSend: function() {
									//wrapWindowByMask();
									$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
								},  			
								success: function(data) {
									alert(data);
									$('#ajax_load').empty();
									$("#r_hour").empty().append(data);
								},
								error: function(xhr, status, error) { alert(error); }
							});	
						*/
					} else {
						if($("#r_doctor").data("value") == "") {
							warningBox("의료진을 먼저 선택해 주세요.");
						}else{
							warningBox("해당날짜는 선택하실 수 없습니다.");
						}
						return false;
					}
					 
				}
			});
			fn.datepickerIsEnable = function(dataObject){
				if(dataObject.enable == "none") {
					$(".entry-datepicker").find('tbody').find('td').each(function(){
						$(this).removeClass('disable');
						$(this).addClass('enable');
						var col = $(this),
						year = parseInt(col.data('year')),
						month = parseInt(col.data('month') + 1);
						day = parseInt(col.text());
						var d = new Date();
						var nyear= d.getFullYear();
						var nmon = (d.getMonth()+1)>9 ? ''+(d.getMonth()+1) : '0'+(d.getMonth()+1);
						var nday = d.getDate()>9 ? ''+d.getDate() : '0'+d.getDate();
						if (nyear == year && nmon == month && nday == day){
							col.removeClass('disable');
							col.removeClass('enable');
						}							
					});
				}else{
					$(".entry-datepicker").find('tbody').find('td').each(function(){
							$(this).addClass('disable');
								var col = $(this),
								year = parseInt(col.data('year')),
								month = parseInt(col.data('month') + 1);
								day = parseInt(col.text());
								var d = new Date();
								var nyear= d.getFullYear();
								var nmon = (d.getMonth()+1)>9 ? ''+(d.getMonth()+1) : '0'+(d.getMonth()+1);
								var nday = d.getDate()>9 ? ''+d.getDate() : '0'+d.getDate();
								if (nyear == year && nmon == month && nday == day){
									col.removeClass('disable');
									col.removeClass('enable');
								}						
					});
					for (eq in dataObject.enable){
						var date = dataObject.enable[eq].split('-');
						$(".entry-datepicker").find('tbody').find('td').each(function(){
							var col = $(this),
								year = parseInt(col.data('year')),
								month = parseInt(col.data('month') + 1);
								day = parseInt(col.text());
							if (parseInt(date[0]) == year && parseInt(date[1]) == month && parseInt(date[2]) == day){
								col.removeClass('disable');
								col.addClass('enable');
							}
						});
					}	
				}
			};
				
				/*
				fn.doctorSchedule = {
					'enable' : ['2016-09-03','2016-09-04','2016-09-05','2016-09-06','2016-09-07','2016-09-08','2016-09-09','2016-09-10','2016-09-11','2016-09-12','2016-09-13','2016-09-14','2016-09-15','2016-09-16','2016-09-17','2016-09-18','2016-09-19','2016-09-20','2016-09-21','2016-09-22','2016-09-23','2016-09-24','2016-09-25','2016-09-26','2016-09-27','2016-09-28','2016-09-29','2016-09-30']
					'disable' : ['2016-08-29','2016-08-30','2016-08-31']
				};
				fn.datepickerIsEnable(fn.doctorSchedule);
				*/
			fn.getDoctorSchedule = function(key,value){
				fn.datepickerDrow = false;
				$("#r_day").val("");
				$("#r_dr_code").val($("#r_doctor").data("value"));
				var dr_code = $("#r_doctor").data("value");	
				var dayuse = [];
				if(dr_code == "none") {
					fn.doctorSchedule = {
						'enable' : ['none']
					};					
					fn.datepickerIsEnable(fn.doctorSchedule);				
				}else{
					$.ajax({
						type: "POST",
						url: "/con/ajax/doctor_ajax/",
						data: "mode=day&dr_code="+dr_code,
						dataType: "json",
						beforeSend: function() {
							//wrapWindowByMask();
							$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
						},  			
						success: function(data) {
							$('#ajax_load').empty();
							$.each(data, function(entryIndex, entry) {
								$('#ajax_load').empty();
								//$('#mask').hide();
								dayuse.push(entry);
							});				
							fn.doctorSchedule = {
								'enable' : dayuse
							};
							fn.datepickerIsEnable(fn.doctorSchedule);							
							
						},
						error: function(xhr, status, error) { alert(error); }
					});			
				}
			};
			fn.setMinute = function(key,value){
				var dr_code = $("#r_doctor").data("value");	
				var r_date  = $("#r_day").val();
				var ampm    = $("input:radio[name='ampm']:checked").val();
				var dept_code = $("#t_code").val();
				if(r_date == "") {
					warningBox("먼저 가능한 요일을 선택해주세요.");
					return false;
				}
				alert("mode=time&dr_code="+dr_code+"&r_date="+r_date+"&hour="+value+"&dept_code="+dept_code);
				
				$.ajax({
					type: "POST",
					url: "/con/ajax/doctor_ajax/",
					data: "mode=time&dr_code="+dr_code+"&r_date="+r_date+"&hour="+value+"&dept_code="+dept_code,
					dataType: "text",
					beforeSend: function() {
						//wrapWindowByMask();
						$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
					},  			
					success: function(data) {
						alert(data);
						$('#ajax_load').empty();
						if(ampm == "am"){
							$("#time_result").empty().append(data);
						}else{
							$("#time_result2").empty().append(data);
						}
					},
					error: function(xhr, status, error) { alert(error); }
				});	
			};
		};
		$("input:radio[name='ampm']").click(function(){
			if($("input:radio[name='ampm']:checked").val() =="am"){
				$("#r_time_am").show();
				$("#r_time_pm").hide();
			}else{
				$("#r_time_am").hide();
				$("#r_time_pm").show();
			}
		});
		
		$("#btn_confirm3").click(function() {
			if($("#r_doctor").data("value") == "") {
				warningBox("의료진을 선택해주세요.");
				return false;
			}
			var dr_name = $.trim($("#r_doctor").html());
			$("#r_dr_name").val(dr_name);			
			
			if($("#r_day").val() == "") {
				warningBox("진료일을 선택해주세요.");
				return false;
			}
			if($("input:radio[name='minute']").is(":checked") == false){
				warningBox("예약시간을 선택해주세요.");
				return false;
			}
			
			var hour = "";
			if($("input:radio[name='ampm']:checked").val() =="am"){
					hour = $("#hour_am").data("value");
			}else{
					hour = $("#hour_pm").data("value");			
			}		
			$("#r_hour").val(hour);		
			
			$("#pForm").attr("action","/con/action/reserve_action/");
			$("#pForm").submit();		
		});	
});	
	