<div class="pageTitle">
			<p>진료 날짜 선택</p>
			<button class="backBtn">back</button>
		</div>
	<div class="container">
		<div class="contReserv">
			<p class="calHead">        
                <button type="button" class="prev" onClick="ch_cal('{p_m}')"><span>이전달</span></button>
                <strong>{s_Y}년 {s_m}월</strong>
                <button type="button" class="next" onClick="ch_cal('{n_m}')"><span>다음달</span></button>
			</p>
<div class="calBody">
	<table>
		<caption>진료일정 선택 달력</caption>
		<colgroup>
			<col style="width:14%" />
			<col style="width:14%" />
			<col style="width:14%" />
			<col style="width:14%" />
			<col style="width:14%" />
			<col style="width:14%" />
			<col style="width:14%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col" class="sun">일</th>
				<th scope="col">월</th>
				<th scope="col">화</th>
				<th scope="col">수</th>
				<th scope="col">목</th>
				<th scope="col">금</th>
				<th scope="col">토</th>
			</tr>
		</thead>
		<tbody>
		{cal_table}
		</tbody>
	</table>
</div>
<p class="calInfo">
	<span class="today"> 오늘</span>
	<span class="possible"> 예약가능</span>
	<span class="del"> 예약불가</span>
</p>

<script language="javascript">
	function ch_cal(date) {
		location.href = '?date='+date;
	}
	function next_step(date) {
		location.href = '/online/step1/?date='+date;
	}

</script>
