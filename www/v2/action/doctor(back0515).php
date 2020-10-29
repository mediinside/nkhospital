<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.doctor.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Doctor 		= new Doctor;
	$C_Button 		= new Button;
	foreach($GP->NEW_MOBILE_CENTER as $k=>$v) { $ce_array[] = $k;};
	foreach($GP->NEW_MOBILE_CLINIC as $k=>$v) { $cl_array[] = $k;};
	foreach($GP->NEW_MOBILE_SPECIAL as $k=>$v) { $sp_array[] = $k;};	
?>
<div id="container">
    <div class="subTop2">
        <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
        <nav class="location">
            <div class="depth2">
                <button type="button" class="btn" onclick="locActive();">선택해주세요</button>
                <ul class="list">
                    <li><a href="#" data-gubun="a">전문센터</a></li>
                    <li><a href="#" data-gubun='b'>진료과</a></li>
                    <li><a href="#" data-gubun='c'>특수클리닉</a></li>
                    <li><a href="#" data-gubun='d'>의료진소개</a></li>
                </ul>
            </div>
            <div class="depth3">
                <button type="button" class="btn" onclick="locActive();">선택해주세요</button>
                <ul class="list">
                   <!--<li><a href="#">관절센터</a></li>
                    <li><a href="#">척추센터</a></li>
                    <li><a href="#">외상센터</a></li>
                    <li><a href="#">뇌혈관센터</a></li>
                    <li><a href="#">심혈관센터</a></li>
                    <li><a href="#">소화기센터</a></li>
                    <li><a href="#">신장센터</a></li>
                    <li><a href="#">소아청소년센터</a></li>
                    <li><a href="#">통증센터</a></li>
                    <li><a href="#">재활치료센터</a></li>
                    <li><a href="#">응급의료센터</a></li>
                    <li><a href="#">평생건강증진센터</a></li>-->
                </ul>
            </div>
        </nav>
    </div>
    <div class="section">
        <div class="tabMenu">
            <ul>
                <li class="active" data-gubun="a"><a href="#"><span>전문센터</span></a></li>
                <li data-gubun="b"><a href="#"><span>진료과</span></a></li>
                <li data-gubun="c"><a href="#"><span>특수클리닉</span></a></li>
            </ul>
        </div>
        <div class="boardSort">
            <button type="button" class="btn" onclick="sortActive();">선택해주세요</button>
            <ul class="list">
                <!--<li><button type="button">관절센터</button></li>
                <li><button type="button">척추센터</button></li>
                <li><button type="button">외상센터</button></li>
                <li><button type="button">뇌혈관센터</button></li>
                <li><button type="button">심혈관센터</button></li>
                <li><button type="button">소화기센터</button></li>
                <li><button type="button">신장센터</button></li>
                <li><button type="button">소아청소년센터</button></li>
                <li><button type="button">통증센터</button></li>
                <li><button type="button">재활치료센터</button></li>
                <li><button type="button">응급의료센터</button></li>
                <li><button type="button">평생건강증진센터</button></li>-->
            </ul>
        </div>
	<?PHP foreach($GP -> NEW_MOBILE_CENTER as $key=>$val){
				echo '<section class="docList" data-depart="'.strtolower($key).'">
						<h3 class="subTitle">'.$val.'</h3>
							<ul class="list">';
				$args = "";
				$args["ct_type"] = strtolower($key);;
				$data = $C_Doctor->Doctor_Detail_List($args);
					foreach($data as $k=>$v){
						echo  '<li>
									<a href="#">
										<span class="pic">
											<img src="'.$GP -> UP_DOCTOR_URL . $v["dr_face_img"].'" alt="">
											<i></i>
										</span>
										<span class="name">
											<b>'.$v["dr_name"].'</b> '. $GP -> DOCTOR_POSITION[$v["dr_position"]].'
										</span>
									</a>
								</li>';
					};
	
            	echo '</ul>
						<a href="#" class="link">'.$val.' 바로가기</a>
					</section>';
		} ?>
    </div>

</div>
<script>
select_menu("a");
/*
var ce_array = new Array(<?=json_encode($ce_array)?>);
var cl_array = new Array(<?=json_encode($cl_array)?>);
var sp_array = new Array(<?=json_encode($cl_array)?>);
	console.log(ce_array);
	$.each(ce_array[0], function(entryIndex, entry){
		console.log(entry+"=="+entryIndex);	
	});
*/
</script>