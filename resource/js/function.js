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
});