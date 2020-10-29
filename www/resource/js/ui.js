var win = $(window);
var html = $('html');
var sno = 1;

(function(){
	var agent = navigator.userAgent.toLocaleLowerCase();
	var html = document.getElementsByTagName('html')[0];
	var htmlClass = html.getAttribute('class');
	var device, deviceVer, ver = null;
	if(agent.indexOf('mobile') > -1) { //모바일 체크
		ver = 'mobile';
		if(agent.indexOf('iphone') > -1 || agent.indexOf('ipad') > -1) { //ios 체크
			device = agent.substring(agent.indexOf('os') + 3);
			deviceVer = device.substring(0, device.indexOf('like mac os x'));
			osVer = 'ios' + deviceVer;
		}
		if(agent.indexOf('android') > -1) { //안드로이드 체크
			device = agent.substring(agent.indexOf('android') + 8);
			deviceVer = device.substring(0, device.indexOf(';'));
			andVer = deviceVer.replace(/[.]/gi,'_');
			osVer = 'android' + andVer;

			if(agent.indexOf('samsung') > -1) osVer += ' samsung'; //삼성 인터넷브라우져 체크
		}
	} else {
		ver = 'pc';
		if(agent.indexOf('msie') > -1) { //ie10 이하 체크
			device = agent.substring(agent.indexOf('msie') + 4);
			deviceVer = Math.floor(device.substring(0, device.indexOf(';')));
			osVer = 'ie' + deviceVer;
		} else {
			osVer = '';
		};
	}
	if(agent.indexOf('naver') > -1) osVer += ' naver'; //네이버 앱 체크
	if(ver !== null) {
		(htmlClass !== null) ? html.setAttribute('class', htmlClass + ' ' + ver + ' ' + osVer) : html.setAttribute('class', ver + ' ' + osVer); //html 클래스 부여
	}
	fontSize();
})();

win.on({
	'resize' : function() {
		var winW = win.width();
		fontSize();
	}
});

function fontSize() {
	var baseW = 360 / 62.5;
	var winW = win.width();
	if (winW <= 600) {
		var fontSize = winW / baseW;
		html.css('font-size', Math.floor(fontSize*100)/100 + '%');
	} else { 
		html.css('');
	}
}

// 쿠키 설정
function setCookie(name, value, expiredays) {
	var today = new Date();
	today.setDate( today.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";"
}

// 쿠키 가져오기
function getCookie(key) {
	var cook = document.cookie + ";";
	var idx = cook.indexOf(key, 0);
	var val = "";

	if(idx != -1) {
		cook = cook.substring(idx, cook.length);
		begin = cook.indexOf("=", 0) + 1;
		end = cook.indexOf(";", begin);
		val = unescape( cook.substring(begin, end) );
	}
	return val;
}

/* url 파라미터 값 확인 함수*/
function getUrlParams() {
	var params = {};
	window.location.search.replace(
		/[?&]+([^=&]+)=([^&]*)/gi,
		function(str, key, value) { params[key] = value;}
	);
	return params;
}
oParams = getUrlParams();

function menu() {
	var wrap = $('html, body');
	wrap.toggleClass('menuOn');
}
function subMenu(obj) {
	var menu = $(obj);
	var subMenu = menu.closest('.menuList').find('.subMenu2');
	if(menu.parent().hasClass('active')) {
		menu.next().slideUp(300).parent().removeClass('active');
	} else {
		subMenu.stop().slideUp(300).parent().removeClass('active');
		menu.next().stop().slideDown(300).parent().addClass('active');
	}
}

function langList(obj) {
	var $this = $(obj);
	$this.toggleClass('open').next().slideToggle(300);
}

var slideObj = {};
function mainSlide() {
	var obj = 'mainSlide';
	var slide = new Swiper('.' + obj + ' .slide', {
		loop: true,
		speed: 500,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false			
		},
		pagination: {
			el: '.' + obj + ' .slidePage',
			clickable: true,
			renderBullet: function (index, className) {
				return '<a href="#" class="' + className + '">' + (index + 1) + '</a>';
			}
		}
	});
	slideObj.mainSlide = slide;
}

function mainSlide2() {
	var obj = 'mainSlide2';
	var slideWrap = $('.' + obj);
	var slideNum = slideWrap.find('.slideNum .activeNum');
	var slideTotal = slideWrap.find('.slideNum .totalNum');
	slideTotal.text($('.' + obj + ' .swiper-slide').length);
	var slide = new Swiper('.' + obj + ' .slide', {
		loop: true,
		speed: 500,
		effect: 'fade',
		autoplay: {
			delay: 3000,
			disableOnInteraction: false			
		},
		pagination: {
			el: '.' + obj + ' .slidePage',
			clickable: true,
			renderBullet: function (index, className) {
				return '<a href="#" class="' + className + '">' + (index + 1) + '</a>';
			},
		},
		navigation: {
			nextEl: '.' + obj + ' .slideNext',
		}
	});
	slideObj.mainSlide2 = slide;
	slideObj.mainSlide2.on('slideChange', function(){
		var num = this.realIndex + 1;
		slideNum.text(num);
		if(num) sno = num;
	});
}

function mainSlide3() {
	var obj = 'mainNotice';
	var tabMenu = $('.mainNotice .tabMenu li');
	var slide = new Swiper('.' + obj + ' .slide', {
		loop: true,
		speed: 500,
		on: {
			init : function() {
				$('.mainNotice .cont').each(function(){
					rollingTxt(this);
				});
			},
			slideChange : function(){
				var num = this.realIndex;
				tabMenu.eq(num).addClass('active').siblings().removeClass('active');
			}
		}
	});
	slideObj.mainSlide3 = slide;
}
function floorSlide() {
	var obj = 'showAcc';
	var slideWrap = $('.' + obj + ' .active');
	var slideNum = slideWrap.find('.slideNum .activeNum');
	var slideTotal = slideWrap.find('.slideNum .totalNum');
	slideTotal.text('');
	if(slideObj['showAcc']) {slideObj['showAcc'].destory;}
	slideTotal.text($('.' + obj + ' .active .swiper-slide').length);
	var slide = new Swiper('.' + obj + ' .active .cont', {
		loop: true,
		speed: 500
	});
	slideObj[obj] = slide;
	slideObj['showAcc'].on('slideChange', function(){
		var num = this.realIndex + 1;
		slideNum.text(num);
	});
}

function rollingTxt(obj) {
	var slideWrap = $(obj);
	var slideCont = slideWrap.find('.inner');
	var slideItem = slideCont.find('span');
	var direction = 'left';
	var position = 0;
	var slideContWidth;

	setTimeout(function(){
		slideCont.append(slideCont.html());
		slideContWidth = slideItem.outerWidth() * slideItem.length;
		slideWrap.action();
	},300);
	
	var timer;
	slideWrap.action = function(){
		clearInterval(timer);
		timer = setInterval(function(){
			if (direction == 'left') {
				position--;
				if (position == '-' + slideContWidth) {
					position = 0;
				}
			}
			if (direction == 'right') {
				position++;
				if (position == 0) {
					position = '-' + slideContWidth;
				}
			}
			slideCont.css('left', position);
		},50);
	}
}

function historySlide(obj) {
	var ele = obj;
	slide = new Swiper('.' + ele + ' .slide', {
		loop: true,
		speed: 500,
		autoplay: {
			delay: 3000,
		},
		pagination: {
			el: '.' + ele + ' .slidePage',
			clickable: true,
			renderBullet: function (index, className) {
				return '<a href="#" class="' + className + '">' + (index + 1) + '</a>';
			}
		}
	});
	slideObj[obj] = slide;
}

function layerOpen(ele) {
	var layer = $('#'+ele);
	layer.show();
}
function layerClose(ele) {
	var layer = $('#'+ele);
	layer.hide();
}
function layerFind(ele) {
	layerClose('loginLayer');
	layerOpen(ele);
}

function tabOpen(obj) {
	var $this = $(obj);
	$this.toggleClass('open').next().slideToggle(200);
}
function tabActive(obj, idx, type) {
	if(typeof obj !== 'string') {
		var $this = $(obj);
		var idx = $this.parent().index();
		var txt = $this.text();
		var tabContents = $this.closest('.tabMenu').next('.tabContents');

		if(type === true && !$this.parent().hasClass('active')) event.preventDefault(event);

		$this.parent().addClass('active').siblings().removeClass('active');
		
		if($this.closest('.tabMenu').find('.tabBtn').is(':visible')) {
			$this.parent().parent().slideUp(200).closest('.tabMenu').find('.tabBtn').text(txt);
		}
	} else {
		var tab = $('#' + obj);
		var menu = tab.find('li');
		var tabContents = tab.next('.tabContents');
		
		idx = idx - 1;

		menu.eq(idx).addClass('active').siblings().removeClass('active');
	}
	tabContents.find('.tabCont').eq(idx).addClass('active').siblings().removeClass('active');
}

function accoActive(obj, idx) {
	if(typeof obj !== 'string') {
		var $this = $(obj);
		var cont = $this.closest('.accordianCont').find('.cont');

		if($this.parent().hasClass('active')) {
			cont.slideUp(300);
			$this.parent().removeClass('active');
		} else {
			cont.slideUp(300);
			$this.parent().addClass('active').find('.cont').slideDown(300);
			$this.parent().siblings().removeClass('active');
		}
	} else {
		var acco = $(obj);
		acco.find('li').eq(idx).addClass('active').find('.cont').show();
	}
}

function fileUpload(obj) {
	var $this = $(obj);
	var thisFile = $this[0].files;
	var thisVal = $this.val();
	var txtVal = $this.parent().next('.inputTxt');
	
	(thisVal.length > 0 || thisFile.length > 0) ? txtVal.removeClass('error').val(thisVal).parent().addClass('active') : txtVal.val(thisVal).parent().removeClass('active');
}
function fileValDel(obj) {
	var $this = $(obj);
	$this.parent().removeClass('active').find('input').val('');
}

function docTop() {
	$('html, body').animate({scrollTop: 0},300);
}

function layerAgree(obj) {
	$.ajax({
		url: '/member/' + obj + '.html',
		dataType: 'html',
		success: function(data){
			$('body').append(data);
			$('.layerAgree').show().focus();
		}
	});
	event.preventDefault();
}
function agreeClose(obj) {
	var $this = $(obj);
	$this.closest('.layerAgree').remove();
}

function locActive() {
	var ele = event.target;
	var $this = $(ele);
	$this.parent().toggleClass('active').siblings().removeClass('active');
}

function sortActive() {
	var ele = event.target;
	var $this = $(ele);
	var list = $this.next('.list');
	var btn = list.find('button');
	$this.next('.list').slideToggle(300).parent().toggleClass('active');
	btn.off('click').on('click', function() {
		var _this = $(this);
		$this.text(_this.text()).parent().removeClass('active');
		list.slideUp(300);
	});
}

function touchActive() {
	$('[class*="telLink"], .btnType1').off('touchstart').on({
		touchstart : function() {
			$(this).addClass('touch');
		},
		touchend : function(){
			$(this).removeClass('touch');
		}
	});
}
$(window).on('load', function(){
	touchActive();
});