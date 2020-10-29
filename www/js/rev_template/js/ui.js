var co = [],
	fn = [];

// 브라우저 버전 체크
co.getBrowserVersion = function(browser){
	var rv = -1, // Return value assumes failure.
		ua = navigator.userAgent,
		re = null;
	if (browser == 'MSIE') re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	else re = new RegExp(ver+"/([0-9]{1,}[\.0-9]{0,})");
	if (re.exec(ua) != null) rv = parseFloat(RegExp.$1);
	return rv;
};

// ie 버전체크
co.ieVersionCheck = function(){
	var ieVersion = 0;
	if (navigator.appName.charAt(0) == 'M'&& co.getBrowserVersion('MSIE') < '9'){
		var version = $('<div id="version"><p>고객님께서는 현재 Explorer 구형버전으로 접속 중이십니다. 이 사이트는 Explorer 최신버전에 최적화 되어 있습니다. <a href="http://windows.microsoft.com/ko-kr/internet-explorer/download-ie" target="_blank">Explorer 업그레이드 하기</a></p> <button type="button" class="versionClose">X</button></div>');
		$('body').prepend(version);
		version.on('click','.versionClose',function(){
			version.hide();
		});
	}
};
co.init = function(){
	co.ieVersionCheck();
	var nav = $('#nav');
	nav.find('.ntrigger a').on('click',function(){
		nav.toggleClass('on');
	});
	$('.select-layout').each(function(eq,select){
		var me = $(select),
			trigger = me.children('.trigger'),
			list = me.children('.list'),
			menu = list.find('a');
		//2016.09.01 select-layout이 disabled 클래스 가 있을 경우 이벤트 적용 안되게 변경
		trigger.on('click',function(){
			if (!me.hasClass('disabled')){
				if (!me.hasClass('on')){
					me.addClass('on');
				} else {
					me.removeClass('on');
				}
			}
		});
		menu.on('click',function(e){
			e.preventDefault();
			var current = $(this),
				key = current.text(),
				value = current.data('value');
			var callback = me.data('change') ? fn[me.data('change')] : null;
			trigger.text(key);
			trigger.data('value',value);
			me.removeClass('on').addClass('success');
			if (typeof callback == 'function') callback(key, value);
			return false;
		});
	});
	$('.swipe-header.tab').each(function(eq,tab_head){
		$(tab_head).find('a').on('click',function(e){
			e.preventDefault();
			var me = $(this),
				parent = me.parent(),
				id = me.attr('href'), 
				idx = me.parent().index();
			parent.parent().children('.active').removeClass('active');
			parent.addClass('active');
			if ($(id).length > 0){
				var section = $(id),
					tab_conts = section.parent();
				var callback = section.data('init') ? fn[section.data('init')] : null;
				if (!section.hasClass('on')){
					tab_conts.children('.on').removeClass('on');
					section.addClass('on');
					if (typeof callback == 'function') callback(section);
				}
			}
		});
		$(tab_head).find('li').eq(0).find('a').trigger('click');
	});
};
co.reszieEvent = 'orientationchange' in window ? 'orientationchange' : 'resize';
co.resize = function(screen){
	if (fn.resize) fn.resize();
};

($(function(){
	$(document).on('ready',function(){
		co.init();
		if (fn.init) fn.init();
	});
	$(window).on(co.reszieEvent, function() {
		co.resize();
		if (fn.resize) fn.resize();
	});
	$(window).on('scroll',function(){
		if (fn.scroll) fn.scroll();
	});
}(jQuery)));

Date.prototype.format = function(f) {
	if (!this.valueOf()) return ' ';
	var weekName = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
	var d = this;
	var h;
	return f.replace(/(yyyy|yy|MM|dd|E|hh|mm|ss|a\/p)/gi, function($1) {
		switch ($1) {
			case 'yyyy': return d.getFullYear();
			case 'yy': return (d.getFullYear() % 1000).zf(2);
			case 'MM': return (d.getMonth() + 1).zf(2);
			case 'dd': return d.getDate().zf(2);
			case 'E': return weekName[d.getDay()];
			case 'HH': return d.getHours().zf(2);
			case 'hh': return ((h = d.getHours() % 12) ? h : 12).zf(2);
			case 'mm': return d.getMinutes().zf(2);
			case 'ss': return d.getSeconds().zf(2);
			case 'a/p': return d.getHours() < 12 ? 'AM' : 'PM';
			default: return $1;
		}
	});
};
Date.prototype.getWeek = function(){return Math.ceil((this.getDate() + this.getDay() + 1) / 7);};
String.prototype.string = function(len){var s = '', i = 0; while (i++ < len) { s += this; } return s;};
String.prototype.zf = function(len){return '0'.string(len - this.length) + this;};
Number.prototype.zf = function(len){return this.toString().zf(len);};
