$(document).ready(function(){
	$(document).on("click","#schbtn",function(){
		var schtxt = $("#schtxt").val();
		$('html').removeClass('searchOn');
		location.href = "/v3/search.php?stext="+schtxt;
	});
	
  $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		//var href = current_url;
		href = $(location).attr('href');
				
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

	$(document).on("click",".btnFacebook",function(){
		href = $(this).data('url');
		var title = $(this).data('title');
		loc = '//www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(href)+'&t='+title;
		window.open(loc);
	});	

	$(document).on("click","#copy_url",function(){
		$("#copyurl").show();
		$("#copyurl").val($(location).attr('href'));
		$('#copyurl').select();
		document.execCommand("copy");
		alert('URL이 복사되었습니다.');
		$("#copyurl").hide();		
	});	
	$(document).on("click",".btnUrl",function(){
		$("#copyurl").show();
		$("#copyurl").val($(this).data('url'));
		$('#copyurl').select();
		document.execCommand("copy");
		alert('URL이 복사되었습니다.');
		$("#copyurl").hide();		
	});		
		$(document).on("click","#kakao_share",function(){
			console.log("kakao");
			//<![CDATA[
			 Kakao.Link.sendScrap({
				requestUrl: $(location).attr('href')
		  });	
		});
	//]]>
		$(document).on("click",".btnKakao",function(){
			console.log($(this).data('url'));
			//<![CDATA[
			 Kakao.Link.sendScrap({
				requestUrl: $(location).attr('href')
		  });	
		});
	//]]>	
});		

