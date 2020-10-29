var npage = 1;
$(document).ready(function(){
	console.log("intro55");
	console.log("npage==="+page);
});
$(document).on("click","#intro_menu > li > a",function(){
	var page =  $(this).data("page");
	$(".depth3").children(".btn").html($(this).html());
	$(".depth3").toggleClass('active').siblings().removeClass('active');
	var url = "/v2/action/intro/"+page+".php";
	$("#result_intro").hide();
	$("#result_intro").load(url, "", function(){
		$('#result_intro').fadeIn('slow');
		$('html').removeClass('menuOn');
	});
});

$(document).on("click","#more",function(){
	npage++;
	$(".cardList > li[data-page='"+npage+"']").show();
	/*$.ajax({
		type: "POST",
		url: "/v2/ajax/board_ajax.php",
		data: "jbcode="+jbcode+"&psize="+psize+"&npage="+npage,
		dataType: "text",
		beforeSend: function() {
		},  			
		success: function(data) {
			console.log(data);
			$(".cardList.typeRecruit").append(data);
			npage++;			
		},
		error: function(xhr, status, error) { alert(error); }
	});	
	*/
});

function intro_load(page,data){
	npage = 1;
	var url = "/v2/action/intro/"+page+".php";
	$("#result_intro").hide();
	$("#result_intro").load(url, data, function(){
		$('#result_intro').fadeIn('slow');
		$('html').removeClass('menuOn');
	});
}
