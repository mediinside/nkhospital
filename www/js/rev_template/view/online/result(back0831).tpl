		<div class="pageTitle">
			<p>예약 정보 확인</p>
			<button class="backBtn">back</button>
		</div>
		<div class="container">
			<div class="reserveOk">
				<div class="box">
					<p class="txt1">* 선택하신 예약정보를 확인하시기 바랍니다.</p>
                    <div class="nameCon">
						<p><span class="tit">예약자</span><span class="con">{name}({phone})</span></p>
						<p><span class="tit">환자</span><span class="con">{r_name}({r_phone})</span></p>
					</div>
					<div class="view">
						<div class="date">
							<p class="day">{r_date}</p>
							<p class="time">{time}</p>
						</div>
						<div class="doc">
							<span class="subject">{treat}</span>
							<strong class="name">{doctor}</strong>
						</div>
					</div>
				</div>

				<p class="txt2">예약이 완료되었습니다.</p>
			
			</div>

			<div class="btnWrap btn2">
				<span><button type="button" id="img_next" class="btnM btnConfirm" onclick="javascript:location.href='/online/reserve/'">확인</button></span>
				<span><button type="button" class="btnM btnCancel" onclick="javascript:logout('{mode}');">로그아웃</button></span>
			</div>
		</div>


<script language="javascript">
	function logout(mode){
		if(mode == "kakao"){
			location.href = "/con/action/login_action/?mode=kakao_out";
		}else{
			location.href = "/con/action/login_action/?mode=logout";
		}
	}
</script>	