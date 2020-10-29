$(document).ready(function(){
	
	
	//큰 네비
	var open_id = "";
	$('.menubtn').click(function(){
			var id = $(this).attr('id');
			var sv_id = id.replace("m_nav","");
			
			if(open_id != id){
				open_id = id;
				
				$('.boxGnbMenu').hide();
				$('#s_nav' + sv_id).show();
			}else{
				open_id = "";
				$('.boxGnbMenu').hide();
			}												
	});	
	
	$('.menubtn').hover(function(){
		var id = $(this).attr('id');
			var sv_id = id.replace("m_nav","");
			
			if(open_id != id){
				open_id = id;
				
				$('.boxGnbMenu').hide();
				$('#s_nav' + sv_id).stop(true,true).show();
			}else{
				$('.boxGnbMenu').hide();
			}																												 
	},function(){
		open_id = "";
	});
	
	
	
	//서브 네비
	var sub_open_id = "";
	$('.treatbtn').click(function(){
			var s_id = $(this).attr('id');									
			var svv_id = s_id.replace("dc_menu","");	
			
			if(sub_open_id != s_id){
				sub_open_id = s_id;
				
				$('.sub_dep1').hide();
				$('#sub_menu' + svv_id).show();
				$('.gnbMenu li').removeClass('on');
				$('#li_menu' + svv_id).addClass('on');
			}else{									
				sub_open_id = "";
				$('.sub_dep1').hide();									
			}												
	});
	
	$('.treatbtn').hover(function(){
		var s_id = $(this).attr('id');
		var svv_id = s_id.replace("dc_menu","");
		
		if(sub_open_id != s_id){
			sub_open_id = s_id;
			
			$('.sub_dep1').hide();
			$('#sub_menu' + svv_id).show();
			$('.gnbMenu li').removeClass('on');
			$('#li_menu' + svv_id).addClass('on');
		}else{
			$('.sub_dep1').hide();	
		}																												 
	},function(){
		sub_open_id = "";
	});
	
	
	//서브 네비
	var go_open_id = "";
	$('.newgobtn').click(function(){
			var s_id = $(this).attr('id');		
			if(s_id == undefined) {
				$('.gnbMenu li').removeClass('on');
				$('.sub_go1').hide();		
				var url = $(this).attr('href');
				location.href = url;
				return false;
			}		
			var svv_id = s_id.replace("dc_menu","");	
			
			$('.sub_go1').hide();		
			if(go_open_id != s_id){
				go_open_id = s_id;
				
				$('.sub_go1').hide();
				$('#sub_menu' + svv_id).show();
				$('.gnbMenu li').removeClass('on');
				$('#li_menu' + svv_id).addClass('on');
			}else{									
				go_open_id = "";
				$('.sub_go1').hide();									
			}												
	});
	
	$('.newgobtn').hover(function(){																		
		var s_id = $(this).attr('id');
		
		if(s_id == undefined) {
			$('.gnbMenu li').removeClass('on');
			$('.sub_go1').hide();		
			return false;
		}		
		var svv_id = s_id.replace("dc_menu","");		
		
		if(go_open_id != s_id){
			go_open_id = s_id;
			
			$('.sub_go1').hide();
			$('#sub_menu' + svv_id).show();
			$('.gnbMenu li').removeClass('on');
			$('#li_menu' + svv_id).addClass('on');
		}else{
			$('.sub_go1').hide();	
		}																												 
	},function(){
		go_open_id = "";
	});
	
});	