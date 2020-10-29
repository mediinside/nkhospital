<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	if(!$_SESSION['suserid']) $C_Func->go_url("/v2/");
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();
	$args = "";
	$args['jb_code'] = "40";
	$args['jb_mb_id'] = $_SESSION['suserid'];;	
	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = $C_JHBoard -> Search_New_BBS($args);
	$args['jb_code'] = "120";
	$data2 = $C_JHBoard -> Search_New_BBS($args);	
?>
    <h3 class="subTitle">전문의 상담</h3>
    <ul class="boardList">
    <? if($data) {
			foreach($data as $k=>$v){
				$regDt = date("Y.m.d", strtotime($v['jb_reg_date'])); 
				$treat_type = "기타";
				if($v['jb_treat'] != '' ) {				
					$treat_type = $GP -> CLINIC_TYPE_NEW[$v['jb_treat']];
				}
				$args = "";
				$args['jb_idx'] = $v["jb_idx"];
				$cdata = $C_JHBoard -> Comment_New_List($args);	
				$comtxt = ($cdata) ? '<span class="state com">완료</span>' : '<span class="state">대기</span>';
				echo '<li>
				         <a href="javascript:void(0);" onclick="javascript:page_load(\'board\',\'idx='.$v["jb_idx"].'\');">
							<span class="subject">['.$treat_type.'] '.$v["jb_title"].'</span>
							<span class="opt">
								<span class="date">'.$regDt.'</span>
								<span class="name">'.$jb_name.'</span>
							</span>
							'.$comtxt.'
						</a>
					</li>';
			} 
		}else{
			echo '<li class="nonList">작성하신 글이 없습니다.</li>';
		}
	?>
    </ul>

    <div class="btnWrap">
        <span><a href="#" class="btnType1">더보기</a></span>
    </div>

    <h3 class="subTitle">고객의 소리</h3>
    <ul class="boardList">
         <? if($data2) {
			foreach($data2 as $k=>$v){
				$regDt = date("Y.m.d", strtotime($v['jb_reg_date'])); 
				$treat_type = "기타";
				if($v['jb_treat'] != '' ) {				
					$treat_type = $GP -> CLINIC_TYPE_NEW[$v['jb_treat']];
				}
				$args = "";
				$args['jb_idx'] = $v["jb_idx"];
				$cdata = $C_JHBoard -> Comment_New_List($args);	
				echo '<li>
				         <a href="javascript:void(0);" onclick="javascript:page_load(\'board\',\'idx='.$v["jb_idx"].'\');">
							<span class="subject">['.$treat_type.'] '.$v["jb_title"].'</span>
							<span class="opt">
								<span class="date">'.$regDt.'</span>
								<span class="name">'.$jb_name.'</span>
							</span>
						</a>
					</li>';
			} 
		}else{
			echo '<li class="nonList">작성하신 글이 없습니다.</li>';
		}
		?>
    </ul>
