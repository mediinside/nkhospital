$(document).ready(function(){
	//네비 슬라이드
	var swiper = new Swiper('#top-bnnr', {
		loop: true,
		pagination: {
			el: '#top-bnnr .swiper-pagination',
			type: 'fraction',
		},
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '#top-bnnr .swiper-button-next',
			prevEl: '#top-bnnr .swiper-button-prev',
		},
	});
	//메인 슬라이드
	var swiper = new Swiper('#main-bnnr', {
		loop: true,
		pagination: {
			el: '#main-bnnr .swiper-pagination',
			clickable: true,
		},
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '#main-bnnr .swiper-button-next',
			prevEl: '#main-bnnr .swiper-button-prev',
		},
	});

	//메뉴 이벤트
	$("#menu").on("click",function(){
		$("#gnb").slideToggle(300);
	});

	//메인 진료센터,진료과,특수클리닉 이벤트
	$("#center-list .tab li a").on("click",function(){
		var $tab_li = $(this).parent("li");
		var idx = $tab_li.index();

		$tab_li.addClass("on").siblings().removeClass("on");
		$("#tab1-"+(idx+1)).fadeIn(200).siblings(".tab-cont").hide();
		$("#filter").removeClass().addClass("tab-" + (idx + 1));
		$("#filter li").eq(0).addClass("on").siblings().removeClass("on");
	});
	$("#filter li a").on("click",function(){
		var $filter_li = $(this).parent("li");
		$filter_li.addClass("on").siblings().removeClass("on");
	});

	//메인 커뮤니티 이벤트
	$("#main-notice .tab li a").on("click", function () {
		var $tab_li = $(this).parent("li");
		// var idx = $tab_li.index();

		$tab_li.addClass("on").siblings().removeClass("on");
	});

	//메인 모아보기,병원소식,건강정보 이벤트
	$("#main-notice .tab li a").on("click",function(){
		var $tab_li = $(this).parent("li");
		var idx = $tab_li.index();

		$tab_li.addClass("on").siblings().removeClass("on");
		$("#tab2-"+(idx+1)).fadeIn(200).siblings(".tab-cont").hide();
	});

	//로케이션 드롭
	$(".depth").hover(function(){
		$(this).find("ul").stop().slideToggle(200);
	});
	//로케이션 레이아웃
	$(window).on("load resize",function(){
		var ml = $("#logo").width();
		$("#location").css('margin-left',ml);
	});
});