
$(document).ready(function(){
		/*
		$('#show_navi').hover(
         function () {
           $('.headerNaviM').stop(true,true).slideDown(1000);
         }, 
         function () {
           $('.headerNaviM').stop(true,true).slideUp(1000);
         }
     );
		*/
		
		$('#show_navi').hover(function(){																			 
				$('.headerNaviM').stop(true,true).slideDown(1000);															 
		});
		
		$('.headerNaviM').hover( function () {

			 }, 
			 function () {
				 $('.headerNaviM').stop(true,true).slideUp(1000);
			 }
	 );
	 /*$('.movList li a').click(function(){
		var _this = $(this);
		itemIdx = _this.parent().index();
		$('.movBox ul li').removeClass('on');
		$('.movBox ul li').eq(itemIdx).addClass('on');
		return false;
	 });*/
	$('.boxClinicAcc').accordion();
});