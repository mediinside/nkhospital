<?php
	include_once  '../_init.php';
	include_once($GP -> CLS."/class.online.php");	    
	include_once($GP -> CLS."/class.doctor.php");	        
   	include_once($GP -> CLS."/class.mcc.php");	    
	$C_Mcc	 	= new Mcc;        
    $C_Online 	= new Online;
    $C_Doctor 	= new Doctor;        
    
	include_once $GP -> INC_WWW . '/m.head.php';
    if (!$C_Func -> is_login()) {
        $C_Func -> put_msg_and_go ('로그인 해 주세요' , '/m/login.html?reurl=' . urlencode($GP -> NOWPAGE));
    }
//  $args["mb_id"] = $_SESSION["suserid"];

    $args["name"] = $_SESSION["susername"];
    $args["name"] = $_SESSION["susername"];
    $args["PROC_GB"] = "00";    
    
    $args["phone"] = str_replace("-","",$_SESSION["suserphone"]);

    $data = $C_Mcc->RevInfo($args);
    //print_r($data);
?>
<body>
<div id="wrap">
	<div id="header">
		<div class="hgroup">
			<h1 class="page-title">나의예약확인</h1>
			<a href="javascript:history.back(-1);" class="history-back"><i class="ip-icon-arrow-back"></i><span class="text-ir">이전 화면</span></a>
		</div>
		<? include_once $GP -> INC_WWW . '/m.header.php'; ?>
	</div>
	<div id="container" class="reserve-history">
		<div class="body">
			<div class="guide-grid">
				<h2 class="title">나의예약확인</h2>
                <? if(count($data) > 0) { ?>
				<table class="grid">
					<thead>
						<tr>
							<th scope="col" align="center">NO</th>
							<th scope="col" align="center">의사명</th>
							<th scope="col" align="center">예약일</th>
							<th scope="col" align="center">예약시간</th>
                            <th scope="col" align="center" width="15%">취소</th>
						</tr>
					</thead>
					<tbody>
                     <? for($i=0;$i<count($data);$i++){ 
                     		$args["dr_mcode"] = $data[$i]["PHY_EMPL_NO"];
                     		$dr_info = $C_Doctor->Doctor_Info_Code($args);
						    $dr_ps  = $GP -> DOCTOR_POSITION[$dr_info["dr_position"]];	
                     ?>
						<tr>
							<td align="center"><? echo $i+1;?></td>
							<td align="center"><?=$dr_info["dr_name"]?> <?=$dr_ps?></td>
							<td align="center"><?=date("Y-m-d", strtotime($data[$i]['PHY_YMD']))?></td>
							<td align="center"><?=date("H:i", strtotime($data[$i]['PHY_TIME']))?></td>
                            <td align="center"><button type="button" class="next-step" style="margin:0; width:70px; padding:5px;" data-empno="<?=$data[$i]["ENT_EMPL_NO"]?>" data-day="<?=$data[$i]['PHY_YMD']?>" data-time="<?=$data[$i]['PHY_TIME']?>">취소</button></td>
						</tr>

                     <? } ?>
					</tbody>
				</table>
              <? }else { ?>
					<span>예약한 내역이 없습니다.</span>		
			  <? } ?>
			</div>
         <? if(count($data) > 0) { 
         		for($i=0;$i<count($data);$i++){ 
                	if($data[$i]["tor_rs_ptype"] =="g"){
         ?>
			<div class="guide-grid"> 
				<h2 class="title">보호자로 예약하신 건입니다. (환자명 : <?=$data[$i]["tor_name"]?>) </h2>
				<table class="grid">
					<thead>
						<tr>
							<th scope="col" align="center">NO</th>
							<th scope="col" align="center">진료과</th>
							<th scope="col" align="center">예약일</th>
							<th scope="col" align="center">예약시간</th>
							<th scope="col" align="center">상태</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center"><? echo $i+1;?></td>
							<td align="center"><?=$data[$i]["tor_rs_clinic"]?> - <br><?=$data[$i]["tor_rs_doc"]?> <?=$data[$i]["tor_rs_exam"]?></td>
							<td align="center"><?=date("y-m-d", strtotime($data[$i]['tor_rs_date']))?></td>
							<td align="center"><?=$data[$i]["tor_rs_time"]?></td>
							<td align="center"><?=$GP -> RESERVE_RESULT[$data[$i]["tor_rs_type"]]?></td>
						</tr>
					</tbody>
				</table>
			</div>
         <? 		}
         		}
         	}
         ?>
			<ul class="disc-purple">
				<!--li>예약확정 전화를 받으셔야 예약이 확정됩니다.</li>
				<li>각 진료과 사정에 따라 진료접수 시간이 변경되거나 조기에 마감될 수 있습니다.</li>
				<li>예약 변경/취소는 <a href="tel:16617779" class="text-purple">1661-7779</a>번으로 연락 주시기 바랍니다.</li-->
			</ul>
			<a href="tel:16617779" class="btn-tel"><small>예약문의</small><i class="ip-icon-tel"></i><span>1661-7779</span></a>
		</div>
	</div>
	<div id="footer">
		<p class="copyright">
			<span>Copyright(c) 2019</span>
			<em>NEW Korea Hospital</em>
		</p>
		<hr class="v-line" />
		<a href="https://www.nkhospital.net/" target="_blank">홈페이지 바로가기</a>
	</div>
</div>
</body>
</html>
<script>
$(document).on('click', '.next-step', function(){
	var empno = $(this).data("empno");
	var rday = $(this).data("day");
	var rtime = $(this).data("time");		
	if(!confirm("취소 하시겠습니까?")) return;	
		$.ajax({
			type: "POST",
			url: "test.php",
			data:{
				"empno"	: empno,
				"rday" : rday, 
				"rtime"	: rtime,
				"mode"  : "rdel"
			},
			dataType: "text",
			beforeSend: function() {
				//$('#ajax_load').html('<img src="/images/ajax-loader.gif">');
			},
			success: function(data) {
				console.log(data);
				alert("예약이 취소되었습니다");
				location.reload();
			},
			error: function(xhr, status, error) { alert(error); }
		});		
	
});

</script>