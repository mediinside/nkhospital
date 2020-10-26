<div id="location">
	<a href="/" class="home"><img src="/resource-pc/images/home.png" alt="처음으로"></a>
	<div class="depth dep-1">
		<p><?=$title?></p>
		<ul></ul>
	</div>
	<div class="depth dep-2">
		<p><?=$page_title?></p>
		<ul></ul>
	</div>
	<div class="depth dep-3">
		<p><?=$page_sub_title?></p>
		<ul></ul>
	</div>
</div>

<script>
	$(document).ready(function(){
		var dep1 = $("header #gnb li > .gnb-tit").clone();
		var dep2_1 = $("header #gnb li > .bc1").siblings(".row").find("dt").clone();
		var dep2_2 = $("header #gnb li > .bc2").siblings(".row").find("dt").clone();
		var dep2_3 = $("header #gnb li > .bc3").siblings(".row").find("dt").clone();
		// var dep3_1 = $("header #gnb li > .bc1").siblings(".row").find("dd");
		// var dep3_2 = $("header #gnb li > .bc2").siblings(".row").find("dd");
		// var dep3_3 = $("header #gnb li > .bc3").siblings(".row").find("dd");

		console.log($("header #gnb li > .bc1").siblings(".row").find("dt").eq(0).siblings('dd').length);

		function dep2_bc1(){
			$(".dep-2 ul").find('li').remove();
			for(var i=0; i<dep2_1.length; i++){
				$(".dep-2 ul").append(
					$('<li>').append(
						$("header #gnb li > .bc1").siblings(".row").find("dt").eq(i).find('a').clone()
					)
				);
			};
		};
		function dep2_bc2(){
			$(".dep-2 ul").find('li').remove();
			for(var i=0; i<dep2_2.length; i++){
				$(".dep-2 ul").append(
					$('<li>').append(
						$("header #gnb li > .bc2").siblings(".row").find("dt").eq(i).find('a').clone()
					)
				);
			};
		};
		function dep2_bc3(){
			$(".dep-2 ul").find('li').remove();
			for(var i=0; i<dep2_3.length; i++){
				$(".dep-2 ul").append(
					$('<li>').append(
						$("header #gnb li > .bc3").siblings(".row").find("dt").eq(i).find('a').clone()
					)
				);
			};
		};

		$(window).load(function(){
			if($(".dep-1 > p").text()=="서비스 이용안내"){
				for(var i=0; i<dep1.length; i++){
					$(".dep-1 ul").append(
						$('<li>').append(
							$('<a href="#none" data-idx="'+i+'">').append(
								$("header #gnb li > .gnb-tit").eq(i).text()
							)
						)
					);
					var dep3_1 = $("header #gnb li > .bc1").siblings(".row").find("dt").eq(i).siblings('dd');
					var text = $(".dep-2 > p").text();
					switch(text){
						case '예약/발급':
							for(var j=0; j<dep3_1.length && i==0; j++){
								$(".dep-3 ul").append(
									$('<li>').append(
										dep3_1.eq(j).find('a').clone()
									)
								);
							};
							break;
						case '입/퇴원 안내':
							for(var j=0; j<dep3_1.length && i==1; j++){
								$(".dep-3 ul").append(
									$('<li>').append(
										dep3_1.eq(j).find('a').clone()
									)
								);
							};
							break;
						case '진료안내':
							for(var j=0; j<dep3_1.length && i==2; j++){
								$(".dep-3 ul").append(
									$('<li>').append(
										dep3_1.eq(j).find('a').clone()
									)
								);
							};
							break;
						case '병원안내':
							for(var j=0; j<dep3_1.length && i==3; j++){
								$(".dep-3 ul").append(
									$('<li>').append(
										dep3_1.eq(j).find('a').clone()
									)
								);
							};
							break;
					}
				};

				dep2_bc1();
			}else if($(".dep-1 > p").text()=="진료과/의료진"){
				for(var i=0; i<dep1.length; i++){
					$(".dep-1 ul").append(
						$('<li>').append(
							$('<a href="#none" data-idx="'+i+'">').append(
								$("header #gnb li > .gnb-tit").eq(i).text()
							)
						)
					);
				};
				dep2_bc2();
			}else{
				dep2_bc3();
			};
		});


		$(document).on("click",".depth ul li a",function(){
			// $(this).css('color','#111')
			var this_text = $(this).text();
			var idx = $(this).data('idx');
			$(this).parents(".depth").find('p').text(this_text);
		});
		$(document).on("click",".dep-1 a",function(){
			var idx = $(this).data('idx');

			if(idx == 0){
				dep2_bc1();
			}else if(idx == 1){
				dep2_bc2();
			}else{
				dep2_bc3();
			}
		});
		$(document).on("click",".dep-2 a",function(){
			var text = $(this).text();
			var v = $(this).parent('li').index();
			var dep3_1 = $("header #gnb li > .bc1").siblings(".row").find("dt").eq(v).siblings('dd');
			switch(text){
				case '예약/발급':
					$(".dep-3 ul").find('li').remove();
					for(var j=0; j<dep3_1.length && v==0; j++){
						$(".dep-3 ul").append(
							$('<li>').append(
								dep3_1.eq(j).find('a').clone()
							)
						);
					};
					break;
				case '입/퇴원 안내':
					$(".dep-3 ul").find('li').remove();
					for(var j=0; j<dep3_1.length && v==1; j++){
						$(".dep-3 ul").append(
							$('<li>').append(
								dep3_1.eq(j).find('a').clone()
							)
						);
					};
					break;
				case '진료안내':
					$(".dep-3 ul").find('li').remove();
					for(var j=0; j<dep3_1.length && v==2; j++){
						$(".dep-3 ul").append(
							$('<li>').append(
								dep3_1.eq(j).find('a').clone()
							)
						);
					};
					break;
				case '병원안내':
					$(".dep-3 ul").find('li').remove();
					for(var j=0; j<dep3_1.length && v==3; j++){
						$(".dep-3 ul").append(
							$('<li>').append(
								dep3_1.eq(j).find('a').clone()
							)
						);
					};
					break;
			}
		});
	});
</script>

