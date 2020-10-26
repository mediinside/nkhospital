<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP -> CLS."/class.reserve.php");	
	$C_Reserve 	= new Reserve;
	
	$args = '';
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$rst = $C_Reserve -> TrestSection_All($args);
	
	if(!$rst) {
		$C_Func->put_msg_and_modalclose("진료과 정보를 먼저 등록하세요.");
	}
	
	$args='';
	$args['mp_idx'] = $_GET['mp_idx'];
	$args['hp_idx'] = $_SESSION['adminhpidx'];
	$args['mb_code'] = $_GET['mb_code'];
	$rst1 = $C_Reserve -> Mem_PD_Info($args);
	
	if($rst1) {
		extract($rst1);
	}
	
	
	$sel_treat = $C_Func ->makeSelect("ts_idx", $rst, $ts_idx, "class='select_type1'", "::: 선택 :::");	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>고객 상품 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?">
		<input type="hidden" name="mode" id="mode" value="MEM_PD_MODI" />
		<input type="hidden" name="hp_idx" id="hp_idx" value="<?=$_SESSION['adminhpidx']?>" />
		<input type="hidden" name="mp_idx" id="mp_idx" value="<?=$_GET['mp_idx']?>" />
		<input type="hidden" name="mb_code" id="mb_code" value="<?=$mb_code?>" />
		<input type="hidden" name="mb_name" id="mb_name" value="<?=$mb_name?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="20%"><span>*</span>진료과</th>
							<td width="80%">
								<?=$sel_treat?>
							</td>
						</tr>
						<tr>
							<th ><span>*</span>회원선택</th>
							<td>
								<div id="div_mem"><?=$mb_name?></div>
								<input type="button" value="회원찾기" onClick="layerPop_new('ifram_st', './mem_search.php?type=P', 550, 400)" />
							</td>
						</tr>
						<tr>
							<th ><span>*</span>상품</th>
							<td>
								<select id="pd_idx" name="pd_idx">
                	<option value="">::: 선택하세요 :::</option>
                </select>
							</td>
						</tr>
						<tr>
              <th><span>*</span>상품횟수</th>
              <td >
              	<input type="text" class="input_text" size="5" name="mp_buy_num" id="mp_buy_num" value="<?=$mp_buy_num?>" />              
              </td>
            </tr>   
            <tr>
              <th><span>*</span>금액</th>
              <td >
              	<input type="text" class="input_text" size="15" name="mp_buy_price" id="mp_buy_price" value="<?=$mp_buy_price?>" />              
              </td>
            </tr>  
            <tr>
              <th><span>*</span>구입일자</th>
              <td >
              	<input type="text" class="input_text" size="15" name="mp_buy_date" id="mp_buy_date" value="<?=$mp_buy_date?>" />              
              </td>
            </tr> 
						<tr>
              <th><span>*</span>사용횟수</th>
              <td >
              	<input type="text" class="input_text" size="15" name="mp_use_num" id="mp_use_num" value="<?=$mp_use_num?>" />              
              </td>
            </tr>   
					</tbody>
				</table>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">수정</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="/js/jquery.alphanumeric.js"></script>
<script type="text/javascript">
	
 function callDatePick (id) {	
		var dates = $( "#" + id ).datepicker({
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			dateFormat: 'yy-mm-dd',
			showMonthAfterYear: true,
			yearSuffix: '년'	  
		});
	}
	
	$(document).ready(function(){	
		
		$('#mp_buy_num').numeric();
		$('#mp_buy_price').numeric();	
		
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});
		
		callDatePick('mp_buy_date');
		
		var logingImg = "<div style='width:100%; text-align:center; padding-top:50px;'><img src='/admin/img/common/loading.gif'><div>";	
			$.ajax({
				url: './proc/reserve_proc.php',
				type: 'POST',
				data: "mode=TREATPRODUCT_SEL&ts_idx=<?=$ts_idx?>&pd_idx=<?=$pd_idx?>",
				timeout: 1000 * 10 , //10초동안 응답이 없으면 error처리
				contentTypeString : "text/xml; charset=utf-8",
				error: function(){ return;  },
				success: function(data){
					$('#pd_idx').empty();
					$('#pd_idx').append(data);
					return;
				}
			});	
		
		$('#ts_idx').change(function(){
			var val = $(this).val();
			
			var logingImg = "<div style='width:100%; text-align:center; padding-top:50px;'><img src='/admin/img/common/loading.gif'><div>";	
			$.ajax({
				url: './proc/reserve_proc.php',
				type: 'POST',
				data: "mode=TREATPRODUCT_SEL&ts_idx=" + val,
				timeout: 1000 * 10 , //10초동안 응답이 없으면 error처리
				contentTypeString : "text/xml; charset=utf-8",
				error: function(){ return;  },
				success: function(data){
					$('#pd_idx').empty();
					$('#pd_idx').append(data);
					return;
				}
			});	
			
		});
							   
														 
		$('#img_submit').click(function(){
										
			if($('#ts_idx option:selected').val() == '') {
				alert("진료과를 선택하세요");
				return false;
			}											
										
			if($('#mb_code').val() == '') {
				alert("회원을 선택하세요");				
				return false;
			}
			
			if($('#pd_name option:selected').val() == '') {
				alert("상품을 선택하세요");
				return false;
			}				
			
			if($('#mp_buy_num').val() == '') {
				alert("상품횟수를 입력하세요");
				$('#mp_buy_num').focus();
				return false;
			}
			
			if($('#mp_buy_price').val() == '') {
				alert("금액을 입력하세요");
				$('#mp_buy_price').focus();
				return false;
			}
			
			$('#base_form').attr('action','./proc/reserve_proc.php');
			$('#base_form').submit();
			return false;
		});
	});
</script>