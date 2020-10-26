<?php	
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	$type = $_GET['type'];
?>
<script type="text/javascript">
	
	$(document).ready(function(){
														 
		//엔터키 막기
		$("*").keypress(function(e){
			if(e.keyCode==13) 
			{
				$('#img_search').click();
				return false;
			}
			else
			{
				return true;	
			}
		});	
		
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		var search_name = $(parent.document).find('#bbit-cal-what').val();
		var par = "pr_mb_name= " + search_name;
							   
		go_FindStoreList(1, par);		
		
		$('#img_search').click(function(){														
			go_FindStoreList(1, '');
			return false;
		});
		
		$('#img_submit').click(function(){
										
			var tmp = $(':input:radio[name=sel_mem]:checked').val();
			
			if(tmp == undefined) {
				alert("회원을 선택하세요");
				return false;
			}
			
			var arr_tmp = tmp.split("|");		
			var mb_code = arr_tmp[0];
			var mb_name = arr_tmp[1];		
			var mb_mobile = arr_tmp[2];	

			$(parent.document).find('#mb_code').val(mb_code);
			$(parent.document).find('#mb_name').val(mb_name);
			$(parent.document).find('#bbit-cal-what').val(mb_name);
			$(parent.document).find('#bbit-cal-mobile').val(mb_mobile);
			
			<?
				if($type == "P"){
			?>
				$(parent.document).find('#div_mem').text(mb_name);
			<?
				}
			?>
			parent.modalclose();					
		});
	});	
	
	
	var go_FindStoreList = function(page, par) {				
		var string = $("#frm_find").serialize();				
		
		if(page > 1) {		
			var data  = "page=" + page + "&" + par + "&" + string;
		}else{
			var data  = par + "&" + string;
		}
		
		var scrollpage = $(window).scrollTop();		
		var logingImg = "<div style='width:100%; text-align:center; padding-top:50px;'><img src='/admin/images/loading.gif'><div>";	
		$.ajax({
			url: './mem_search_list.php',
			type: 'POST',
			data: data,
			timeout: 1000 * 10 , //10초동안 응답이 없으면 error처리
			contentTypeString : "text/xml; charset=utf-8",
			beforeSend : function(){ $("#find_result").html(logingImg); },
			error: function(){ return;  },
			success: function(data){
				$("#find_result").html(data);
			}
		});		
		return false;
	}
</script>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer boxSearchMember">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>회원 찾기</strong></span>
		</div>
		<form id="frm_find" name="frm_find" method="post">
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">
				<ul class="mem_search_pop">
					<li><span>핸드폰</span> <input type="text" class="input_text" size="15" name="mb_mobile" id="mb_mobile" /></li>
					<li><span>고객명</span> <input type="text" class="input_text" size="15" name="mb_name" id="mb_name" /></li>
					<li><button id="img_search" class="btnSearch ">검색</button></li>					
				</ul>	
				
				<div id="find_result"></div>
											
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">확인</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>