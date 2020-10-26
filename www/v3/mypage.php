<?php 
/*
BY-SHIN - 2019-06-11
*/
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors", 1);

include "include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "";

include $root_path."include/common.php";
if(!$_SESSION['suserid']) $C_Func->go_url("/v3/");

$tab = ($_GET["tab"]) ? $_GET["tab"] : "mypage";
if($tab=="mypage"){
	include_once($GP->CLS."class.member.php");
	$C_Member = new Member();	
	
	$args["mb_code"] = $_SESSION['susercode'];
	$data = $C_Member->Mem_Info($args);
	extract($data);	

	$tpl->assign(array(
		"mcode"		=> $mb_code,
		"id"		=> $mb_id,
		"name"		=> $mb_name,
		"email"		=> $mb_email,
		'mobile' 	=> $mb_mobile
	));	
}else if($tab=="mylist"){
	include_once($GP->CLS."class.jhboard.php");	
	$C_JHBoard = new JHBoard();
	$args = "";
	$args['jb_code'] = "40";
	$args['jb_mb_id'] = $_SESSION['suserid'];;	
	$args["order"] = "A.jb_order ASC, A.jb_reg_date DESC";
	$data = $C_JHBoard -> Search_New_BBS($args);
	$args['jb_code'] = "120";
	$data2 = $C_JHBoard -> Search_New_BBS($args);	
	
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
		
		$list[] = array(
			'idx'		=> $v["jb_idx"],
			'regdt'		=> $regDt,
			'ttype'		=> $treat_type,
			'comtxt'	=> $comtxt,			
			'title'		=> $v["jb_title"],
			'name'		=> $v["jb_name"]
		);
		
	}
	foreach($data2 as $k=>$v){
		$regDt = date("Y.m.d", strtotime($v['jb_reg_date'])); 
		$treat_type = "기타";
		if($v['jb_treat'] != '' ) {				
			$treat_type = $GP -> CLINIC_TYPE_NEW[$v['jb_treat']];
		}
		$args = "";
		$args['jb_idx'] = $v["jb_idx"];
		$cdata = $C_JHBoard -> Comment_New_List($args);		

		$list2[] = array(
			'idx'		=> $v["jb_idx"],
			'regdt'		=> $regDt,
			'ttype'		=> $treat_type,
			'title'		=> $v["jb_title"],
			'name'		=> $v["jb_name"]
		);		
	}
}

$js->load_script("/v3/controller/js/mypage.js");

$tab = ($_GET["tab"]) ? $_GET["tab"] : "mypage";

$tpl->define("main","mypage/".$tab.".tpl");

$tpl->define("mymenu","inc/my.top.tpl");

$tpl->assign(array(
	"ctxt"	=> $ctxt,
	"ttxt"	=> $ttxt,
	"tab" 	=> $tab,
	'depth' => $depth,
	'list1' => $list,
	'list2' => $list2,	
));

include $root_path."include/footer.php";
?>

