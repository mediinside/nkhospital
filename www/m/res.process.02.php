<?php
	include_once  '../_init.php';
	include_once $GP -> INC_WWW . '/m.head.php';
   	include_once($GP -> CLS."/class.doctor.php");	
	$C_Doctor 	= new Doctor;
	$args['ct_type'] = $_GET['ct_type'];
	$data = "";
	$data = $C_Doctor->Doctor_Detail_List($args);    
    

	$process_type = $_GET['ptype'];
	$process_title = '';
	if ('s' == $process_type){
		$process_title = '본인예약';
	} else if ('g' == $process_type){
		$process_title = '보호자로 예약';
	}
?>
<body>
<div id="wrap">
	<div id="header">
		<div class="hgroup">
			<h1 class="page-title"><?php echo $process_title;?></h1>
			<a href="javascript:void(0)" class="history-back"><i class="ip-icon-arrow-back"></i><span class="text-ir">이전 화면</span></a>
		</div>
		<div id="nav">
			<h2 class="trigger"><a href="javascript:void(0)">
				<i class="menu-line box-shadow"></i>
				<i class="menu-line box-shadow"></i>
				<i class="menu-line box-shadow"></i>
				<span class="text-ir">메뉴 열기</span>
			</a></h2>
			<div class="overlay"></div>
			<div class="group">
				<div class="header">
					<div class="greetings">
						<p><strong class="name">가나다</strong>님, 안녕하세요</p>
					</div>
					<ul class="tools">
						<li><a href="#"><span>로그아웃</span></a></li>
						<li><a href="user.info.html"><span>내정보 수정</span></a></li>
					</ul>
				</div>
				<div class="panel">
					<ul class="list">
						<li class="dp1">
							<a href="javascript:void(0)"><span>진료예약</span><i class="ip-icon-arrow-down"></i></a>
							<div class="dp-section">
								<ul>
									<li class="dp2"><a href="res.process.01.html?ptype=s"><span>본인예약</span></a></li>
									<li class="dp2"><a href="res.process.01.html?ptype=g"><span>보호자로 예약</span></a></li>
									<li class="dp2"><a href="http://smart.nkhospital.net/index.html" target="_blank"><span>건강검진예약</span></a></li>
								</ul>
							</div>
						</li>
						<li class="dp1"><a href="res.history.html"><span>예약조회</span></a></li>
						<li class="dp1"><a href="res.easy.html"><span>간편예약</span></a></li>
						<li class="dp1"><a href="res.call.html"><span>전화예약</span></a></li>
						<li class="dp1"><a href="res.time.html"><span>진료시간</span></a></li>
						<li class="dp1"><a href="res.map.html"><span>오시는 길</span></a></li>
					</ul>
				</div>
				<a href="javascript:void(0)" class="close"><span class="text-ir">메뉴 닫기</span></a>
			</div>
		</div>
	</div>
	<div id="container" class="reserve-process doctor">
		<div class="body">
			<form class="search-area">
				<input type="search" class="i-text" placeholder="센터, 진료과, 의료진명을 입력하세요." />
				<button type="submit" class="ip-icon-search"></button>
			</form>
			<div class="search-result">
				<div class="header">관절센터 검색결과</div>
				<div class="section">
					<ul class="list">
                    	<? foreach($data as $val=>$key) { 
                                $dr_idx 		= $key['dr_idx'];
                                $dr_name		= $key['dr_name'];
                                $dr_position	= $key['dr_position'];
                                $dr_clinic2 	= $key['dr_clinic2'];
                                $dr_treat 		= $key['dr_treat'];
                                $dr_m_sd		= $key['dr_m_sd'];
                                $dr_a_sd		= $key['dr_a_sd'];
                                $dr_face_img	= $key['dr_face_img'];										
                                $dr_regdate 	= $key['dr_regdate'];
                                $dr_ps 			= $GP -> DOCTOR_POSITION[$dr_position];	
                                $dr_cn 			= $GP -> CLINIC_TYPE1[$dr_clinic1];	
                                $moning_arr 	= explode(',', $dr_m_sd);	
                                $after_arr 		= explode(',', $dr_a_sd);
								$c_type			= $GP->CLINIC_TYPE_NEW[$dr_clinic2];
                                	
                                $dr_img = '';
                                if($dr_face_img !=  '') {
                                    $dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dr_face_img . "' alt='' />";
                                }					
                        ?>
						<li><div class="doctor-info">
							<div class="picture"><img src="./public/images/temp-doctor.jpg" alt="" class="block" /></div>
							<dl>
								<dt class="name"><?=$dr_name?> <?=$dr_ps?></dt>
								<dd class="depart"><?=$c_type?></dd>
								<dd class="explan"><?=$dr_treat?></dd>
							</dl>
							<div class="doctor-schedule">
								<table>
									<thead>
										<tr>
											<th scope=""></th>
											<th scope="row">월</th>
											<th scope="row">화</th>
											<th scope="row">수</th>
											<th scope="row">목</th>
											<th scope="row">금</th>
											<th scope="row">토</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="col">오전</th>
											<td><? if (in_array("월", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("화", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("수", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("목", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("금", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("토", $moning_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
										</tr>
										<tr>
											<th scope="col">오후</th>
											<td><? if (in_array("월", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("화", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("수", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("목", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("금", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
											<td><? if (in_array("토", $after_arr)) { echo '<span class="open">진료</span>'; }else{ echo '<span class="void">-</span>'; }?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<a href="res.process.03.html?dr_idx=<?=$dr_idx?>&ptype=<?=$_GET['ptype'];?>" class="next-step">진료 예약하기</a>
						</div></li>
                        <? } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p class="copyright">
			<span>Copyright(c) 2017</span>
			<em>NEW Korea Hospital</em>
		</p>
		<hr class="v-line" />
		<a href="https://www.nkhospital.net/" target="_blank">홈페이지 바로가기</a>
	</div>
</div>
</body>
</html>