<?php /* Template_ 2.2.7 2016/09/09 12:00:15 /home/hosting_users/nkmed/www/rev_template/view/online/step3.tpl 000006482 */ ?>
<header id="header">
		<h1 class="page-title">예약정보</h1>
		<!--a href="/online/step2/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a-->
		<a href="javascript:history.go('-1');" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a-->        
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
<?php $this->print_("menu",$TPL_SCP,1);?>

		</nav>
	</header>
	<article id="container">
	<form id="pForm" method="post">
   	    <input type="hidden" name="mode" value="add" />  
		<input type="hidden" id="r_phone" name="r_phone" value="<?php echo $TPL_VAR["r_phone"]?>" />
	    <input type="hidden" id="r_name" name="r_name" value="<?php echo $TPL_VAR["r_name"]?>" />
	    <input type="hidden" id="r_birth" name="r_birth" value="<?php echo $TPL_VAR["r_birth"]?>" />
	    <input type="hidden" id="r_sex" name="r_sex" value="<?php echo $TPL_VAR["r_sex"]?>" />    
		<input type="hidden" id="r_phone" name="p_phone" value="<?php echo $TPL_VAR["p_phone"]?>" />
	    <input type="hidden" id="r_name" name="p_name" value="<?php echo $TPL_VAR["p_name"]?>" />
	    <input type="hidden" id="r_birth" name="p_birth" value="<?php echo $TPL_VAR["p_birth"]?>" />
	    <input type="hidden" id="r_sex" name="p_sex" value="<?php echo $TPL_VAR["p_sex"]?>" />    
        <input type="hidden" id="t_code" name="t_code" value="<?php echo $TPL_VAR["t_code"]?>" />  
        <input type="hidden" id="t_code_name" name="t_code_name" value="<?php echo $TPL_VAR["t_code_name"]?>" /> 
    
    
        <input type="hidden" id="r_dr_code" name="r_dr_code" value="" />  
        <input type="hidden" id="r_dr_name" name="r_dr_name" value="" />  
        <input type="hidden" id="r_day" name="r_day" value="" /> 
        <input type="hidden" id="r_hour" name="r_hour" value="" />                        
		<section>
			<h1 class="section-title">medical doctor</h1>
			<section class="entry-field">
				<div id="doctor-selection" class="select-layout" data-change="getDoctorSchedule">
					<a href="javascript:void(0)" class="trigger" id="r_doctor" data-value="">의료진을 선택하세요</a>
					<ul class="list">
						<?php echo $TPL_VAR["select_doctor"]?>

					</ul>
				</div>
			</section>
		</section>
		<section>
			<h1 class="section-title">date</h1>
			<p class="entry-field">
				<span class="text-point">*</span> 원하는 진료일자를 선택하십시오.
			</p>
			<div class="entry-datepicker"></div>
			<ul class="entry-datepicker-attr">
				<li class="today">오늘</li>
				<li class="enable">예약가능</li>
				<li class="disable">예약불가</li>
			</ul>
		</section>
		<section>
			<h1 class="section-title">schedule</h1>
			<p class="entry-field">
				<span class="text-point">*</span> 원하는 시간을 선택하십시오.
			</p>
			<div class="select-tab-layout">
				<label>
					<input type="radio" name="ampm" value="am" checked="checked"/>
					<span>오전</span>
				</label>
				<label>
					<input type="radio" name="ampm" value="pm"/>
					<span>오후</span>
				</label>
			</div>
			<div class="time-divide-section on" id="r_time_am">
				<div id="hour-selection" class="select-layout half" data-change="setMinute">
					<a href="javascript:void(0)" class="trigger" id="hour_am">Hour</a>
					<ul class="list">
						<!li><a href="javascript:void(0)" data-value="09">09시</a></li>
						<li><a href="javascript:void(0)" data-value="10">10시</a></li>
						<li><a href="javascript:void(0)" data-value="11">11시</a></li>
						<li><a href="javascript:void(0)" data-value="12">12시</a></li>
					</ul>
				</div>
				<div id="minute-selection" class="half">
					<ul id="time_result">
						<!--li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">00</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">10</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">20</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">30</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">40</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">50</span></label></li-->
					</ul>
				</div>
			</div>
			<div class="time-divide-section on" style="display:none;" id="r_time_pm">
				<div id="hour-selection2" class="select-layout half" data-change="setMinute">
					<a href="javascript:void(0)" class="trigger" id="hour_pm">Hour</a>
					<ul class="list">
						<li><a href="javascript:void(0)" data-value="13">13시</a></li>
						<li><a href="javascript:void(0)" data-value="14">14시</a></li>
						<li><a href="javascript:void(0)" data-value="15">15시</a></li>
						<li><a href="javascript:void(0)" data-value="16">16시</a></li>
						<li><a href="javascript:void(0)" data-value="17">17시</a></li>                        
					</ul>
				</div>
				<div id="minute-selection" class="half">
					<ul id="time_result2">
						<!--li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">00</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">10</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">20</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">30</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">40</span></label></li>
						<li><label class="radio-label"><input type="radio" name="minute"/><span class="minute">50</span></label></li-->
					</ul>
				</div>
			</div>            
            
		</section>
		<footer class="btn-group entry">
			<a href="#" class="btn btn-disabled" id="btn_confirm3">확인</a>
			<a href="/online/main/" class="btn btn-empty">취소</a>
		</footer>
        </form>
	</article>
<script type="text/javascript" src="/path/js/step.min.js"></script>