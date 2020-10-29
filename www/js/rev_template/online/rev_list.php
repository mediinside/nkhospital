<?php 
/*
BY-SHIN - 2016-04-27
*/
$page_title = "예약자 정보 / 환자 정보 입력 &gt; 실시간예약";
include "../include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",true);

$root_path = "../";

include $root_path."include/common.php";
include $root_path."include/select_box.php";
include $root_path."include/paging.php";  

if(!$_SESSION["rev_info"] == ""){
	$info = explode("|",$_SESSION["rev_info"]);
	$r_name 	= $info[0];
	$r_phone 	= explode("-",$info[1]);	
}

$rev_no = $_SESSION['rev_no'];

$rv_no = $_GET["rv_no"];

if($rv_no) {
	$db->sql("select * from ".RESERVE_TABLE." where RvNo='$rv_no'");
	$db->exec();
	$rec = $db->mfa();
	$rec['RvPSex'] = ($rec['RvPSex'] == "M") ? "남자" : "여자";	
	$r_time_arr = explode(":",$rec["RvRevTime"]);
	$r_time_txt = ($r_time_arr[0] > "12") ? "오후" :"오전" ;
	
	$loop[] = array(
		'rv_no'			=> $rec['RvNo'],
		'r_name'		=> $rec['RvName'],
		'r_phone'		=> $rec['RvPhone'],
		'p_name'		=> $rec['RvPName'],
		'p_birth'		=> $rec['RvPBrith'],
		'p_sex'			=> $rec['RvPSex'],
		'r_tcode'		=> $rec['RvDptCodeName'],
		'r_dr_name'		=> $rec['RvDrName'],
		'p_name'		=> $rec['RvName'],
		'r_date'		=> $rec["RvRevDt"],
		'r_time'		=> $rec["RvRevTime"],					
		'r_time_txt'	=> $r_time_txt,
		'p_phone'		=> $rec['RvPPhone'],
		'regDt'			=> date("Y.m.d",strtotime($rec["RvRegDt"]))
	);	
	
	$tpl_path = "r_view.tpl";
}else{
	if($rev_no == "0"){
		$db->sql("select count(*) from ".RESERVE_TABLE." where RvMemNo='$rev_no' and RvName='$_SESSION[rev_name]' and RvPhone = '$_SESSION[rev_phone]' and RvType = 'M' and RvCancelFlag = 'N' order by RvRevDt desc");			
	}else{
		$db->sql("select count(*) from ".RESERVE_TABLE." where RvMemNo='$rev_no' and RvType = 'M' and RvCancelFlag = 'N' order by RvRevDt desc");			
	}
	$db->exec();
		$total = $db->mr(0,0);
		$pg = new Paging($_GET["page"],$pagesize,"10",$total);
		$limit = "LIMIT $pg->Bottomrecord, $pagesize";	
	
	if($rev_no == "0"){
		$db->sql("select * from ".RESERVE_TABLE." where RvMemNo='$rev_no' and RvName='$_SESSION[rev_name]' and RvPhone = '$_SESSION[rev_phone]' and RvType = 'M' and RvCancelFlag = 'N' order by RvRevDt desc $limit");
	}else{
		$db->sql("select * from ".RESERVE_TABLE." where RvMemNo='$rev_no' and RvType = 'M' and RvCancelFlag = 'N' order by RvRevDt desc $limit");
	}
	$db->exec();
	while($rec = $db->mfa()) {
		$loop[] = array(
			'dr_name'		=> $rec["RvDrName"],
			't_code_name'	=> $rec["RvDptCodeName"],
			'r_name'		=> $rec["RvName"],
			'p_name'		=> $rec["RvPName"],
			'r_date'		=> $rec["RvRevDt"],
			'r_time'		=> $rec["RvRevTime"],
			'regDt'			=> date("Y.m.d",strtotime($rec["RvRegDt"]))
		);
		
	}
	
	$tpl->assign(array(
		'totalrecord'	=> $pg->Totalrecord,
		'totalpage' 	=> $pg->Totalpage,
		'page' 			=> $page,
		'prevblock' 	=> $pg->PrevBlock(),
		'nextblock' 	=> $pg->NextBlock(),
		'prevpage'	 	=> $pg->PrevPage(),
		'nextpage' 		=> $pg->NextPage(),
		'link' 			=> $pg->PageLink(),
	));
	
	$db->sql("select * from ".RESERVE_TABLE." where RvMemNo='$rev_no' and RvType = 'M' and RvCancelFlag = 'N' order by RvRegDt desc limit 0,1",2);
	$db->exec(2);
	
	if($rec2 = $db->mfa(2)) {
		$loop_new[] = array(
			'rv_no'			=> $rec2["RvNo"],
			'dr_name'		=> $rec2["RvDrName"],
			't_code_name'	=> $rec2["RvDptCodeName"],
			'r_name'		=> $rec2["RvName"],
			'p_name'		=> $rec2["RvPName"],
			'r_date'		=> $rec2["RvRevDt"],
			'r_time'		=> $rec2["RvRevTime"],
			'regDt'			=> date("Y.m.d",strtotime($rec2["RvRegDt"]))		
		);
	}
	$tpl_path = "r_list.tpl";
}
$tpl->assign(array(
	'list'			=> $loop,
	'list_n'		=> $loop_new,
	'mode'			=> $_SESSION['mode'],
	
));

$tpl->define("main","online/".$tpl_path);

include $root_path."include/footer.php";
?>