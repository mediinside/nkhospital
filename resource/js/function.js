$(document).ready(function(){
	//메인슬라이드
	var swiper = new Swiper('#top-bnnr', {
		loop: true,
		pagination: {
			el: '.swiper-pagination',
			type: 'fraction',
		},
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
});