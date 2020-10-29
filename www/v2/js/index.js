$(document).ready(function(){
	console.log("sucess");
//	page_load('index','');
	/*
    $(this).swipe({ 
            swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                if( direction == "left" ){ 
                    //왼쪽
					alert("left");
                }else if( direction == "right" ){ 
                    //오른쪽
					alert("right");					
            } 
        }, 
   	}); 
	*/
	$(document).on("click","#schbtn",function(){
		console.log("click");
		var schtxt = $("#schtxt").val();
		$('html').removeClass('searchOn');
		page_load("search","schtxt="+schtxt);
	});	

});


window.onload=function(){
	mainSlide();
	mainSlide2();
	//mainSlide3();
}