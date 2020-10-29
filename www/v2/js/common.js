var pglink = ""
var pgparam = ""
$(document).ready(function(){
//	$.getScript( '/v2/js/'+page+'.js');
  $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		//var href = current_url;
		href = "http://nkhospital.net/v2/?"+param;
		console.log("lasthref============"+href);
				
		var title = _this.attr('data-title');
		var loc = "";
		var img = $("meta[name='og:image']").attr('content');
		
		if( ! sns_type || !href || !title) return;
		
		if( sns_type == 'facebook' ) {
			loc = '//www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(href)+'&t='+title;
		}
		else if ( sns_type == 'facebook_youtube' ) {
			
			loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
		}
		else {
			return false;
		}
		window.open(loc);
		return false;
	});

	$(document).on("click","#copy_url",function(){
//		var curl = "http://nkhospital.net/v2/";
		$('#copy_text_input').select();
		document.execCommand("copy");
		alert('URL이 복사되었습니다.')
	});
});
function page_load(page,data){
	save_history(page,data)
	var url = "/v2/action/"+page+".php";
	$("#container").hide();
	$("#container").load(url, data, function(){
		$('#container').fadeIn('slow');
		if(page == "index"){
			mainSlide();
			mainSlide2();
			mainSlide3();
		}
		$('html').removeClass('menuOn');
	});
	console.log("page==="+page);
	$.getScript( '/v2/js/'+page+'.js');
	/*$.ajax({
		type: "POST",
		url: url,
		data: data,
		traditional : false,
		dataType: "text",
		beforeSend: function() {
		},  			
		success: function(data) {
			$('#container').empty().hide().append(data).fadeIn('slow');
			if(page == "index"){
				mainSlide();
				mainSlide2();
			}
			$('html').removeClass('menuOn');
		},
		error: function(xhr, status, error) { alert(error); }
	});		
	*/
}

function emailchk(sEmail){
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(sEmail)) {
	return true;
	}
	else {
	return false;
	}
}
window.onpopstate = function(event) {
   console.log(event);
   page_load(event.state["stpage"],event.state["stparam"]);
}

function save_history(pglink,pgparam){
	pglink = pglink;
	pgparam = pgparam;
	console.log("=========="+pglink+"//"+pgparam);
	var stateObj = {"stpage":""+pglink+"","stparam":""+pgparam+""};
	var sturl = "";
	strul = "/v2/?page="+pglink+"&"+pgparam;
	console.log(stateObj);
	window.history.pushState(stateObj, "뉴고려병원", sturl);
	console.log(window.history.length);
}

