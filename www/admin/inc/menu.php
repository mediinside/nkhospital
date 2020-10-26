<?php
// Dedc : admin 메뉴 Array
// Writer :



$GP -> MENU_ADMIN = array(
		array("tab"=>"1",			"folder"=>"main", 				"name"=>"관리자정보",		"link"=> "/admin/main/adm_info.php?m_tab=1"),
		array("tab"=>"2",			"folder"=>"bbs", 					"name"=>"게시판관리",		"link"=> "/admin/bbs/bbs_list.php?m_tab=2"),
		array("tab"=>"3",			"folder"=>"member", 			"name"=>"회원관리",			"link"=> "/admin/member/mem_list.php?m_tab=3"),		
		array("tab"=>"4",			"folder"=>"doctor", 			"name"=>"의료진관리",			"link"=> "/admin/doctor/dt_list.php?m_tab=4"),		
		array("tab"=>"5",			"folder"=>"nonpay", 			"name"=>"비급여관리",			"link"=> "/admin/nonpay/nonpay_list_new.php?m_tab=5"),		
		array("tab"=>"6",			"folder"=>"popup", 				"name"=>"팝업관리",			"link"=> "/admin/popup/popup_list.php?m_tab=6"),
		array("tab"=>"12",			"folder"=>"slidem", 			"name"=>"슬라이드관리",		"link"=> "/admin/slidem/slide_PC_list.php?m_tab=12"),		
		array("tab"=>"7",			"folder"=>"analytics", 		"name"=>"통계관리",			"link"=> "/admin/analytics/day_visit.php?m_tab=7"),
		array("tab"=>"8",			"folder"=>"sms", 					"name"=>"SMS관리",			"link"=> "/admin/sms/sms_send.php?m_tab=8"),
		array("tab"=>"9",			"folder"=>"online", 		"name"=>"온라인예약관리",			"link"=> "/admin/online/online_reserve_list.php?m_tab=9"),
		array("tab"=>"10",			"folder"=>"phone", 		"name"=>"간편예약관리",			"link"=> "/admin/phone/phone_list.php?m_tab=10"),
		array("tab"=>"11",			"folder"=>"video", 		"name"=>"동영상관리",			"link"=> "/admin/video/vd_list.php?m_tab=11"),
		
);



$GP -> MENU_SUB_ADMIN = array();

$GP -> MENU_SUB_ADMIN['main'] = array(
	"시스템관리"   => array(
		array("tab"=>"1",		"title"=>"main1",		"name"=>"관리자 정보",		"link"=>  "/admin/main/adm_info.php"),
		array("tab"=>"2",		"title"=>"main2",		"name"=>"권한 정보",			"link"=>  "/admin/main/adm_auth.php"),
	)
);
;

$GP -> MENU_SUB_ADMIN['doctor'] = array(
	"의료진관리"   => array(
		array("tab"=>"1",	"title"=>"doctor1", "name"=>"의료진 정보",			"link"=>  "/admin/doctor/dr_list.php"),
	)
);
$GP -> MENU_SUB_ADMIN['nonpay'] = array(
	"비급여관리"   => array(
		array("tab"=>"1",	"title"=>"nonpay1",		"name"=>"비급여 리스트",			"link"=>  "/admin/nonpay/nonpay_list_new.php"),
		/*array("tab"=>"2",		"name"=>"비급여 카테고리",			"link"=>  "/admin/nonpay/cate_list.php"),*/
	)
);

$GP -> MENU_SUB_ADMIN['reserve'] = array(
	"예약관리"   => array(
	  array("tab"=>"1",		"name"=>"예약 현황",			"link"=>  "/admin/reserve/reserve_list.php"),
		array("tab"=>"2",		"name"=>"진료과 설정",				"link"=>  "/admin/reserve/treatsection.php"),
		array("tab"=>"3",		"name"=>"진료과 상품설정",		"link"=>  "/admin/reserve/treatproduct.php"),
		array("tab"=>"4",		"name"=>"진료과 옵션설정",		"link"=>  "/admin/reserve/treatsection_option.php"),
		array("tab"=>"5",		"name"=>"일별 예약설정",				"link"=>  "/admin/reserve/treatsection_day.php"),		
		array("tab"=>"6",		"name"=>"회원 상품관리",		"link"=>  "/admin/reserve/mem_product.php"),
	)
);

$GP -> MENU_SUB_ADMIN['sms'] = array(
	"SMS관리"   => array(
		array("tab"=>"1",		"name"=>"SMS 설정",					"link"=>  "/admin/sms/sms_setup.php"),										 	
		array("tab"=>"2",		"name"=>"SMS 발송",					"link"=>  "/admin/sms/sms_send.php"),
		array("tab"=>"3",		"name"=>"SMS 발송리스트",		"link"=>  "/admin/sms/sms_send_list.php"),
		array("tab"=>"4",		"name"=>"SMS 그룹관리",			"link"=>  "/admin/sms/sms_grouplist.php"),
		array("tab"=>"5",		"name"=>"SMS 회원관리",			"link"=>  "/admin/sms/sms_memlist.php"),
	)
);

$GP -> MENU_SUB_ADMIN['secret'] = array(
	"시크릿룸"   => array(
		array("tab"=>"1",		"name"=>"시크릿룸 이벤트",				"link"=>  "/admin/secret/se_list.php"),		
		array("tab"=>"2",		"name"=>"응모리스트",				"link"=>  "/admin/secret/so_list.php"),	
	)
);


$GP -> MENU_SUB_ADMIN['webcrm'] = array(
	"CRM"   => array(
	    array("tab"=>"1",		"name"=>"환경설정",			"link"=>  "/admin/webcrm/base_setting.php"),		
		array("tab"=>"2",		"name"=>"예약현황",		"link"=>  "/admin/webcrm/reserve_list.php"),
	)
);


$GP -> MENU_SUB_ADMIN['bbs'] = array(
	"게시판관리"   => array(
		array("tab"=>"1",		"name"=>"게시판 리스트",				"link"=>  "/admin/bbs/bbs_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['member'] = array(
	"회원관리"   => array(
		array("tab"=>"1",	"title"=>"member1",		"name"=>"회원 리스트",							"link"=>  "/admin/member/mem_list.php"),
		array("tab"=>"2",	"title"=>"member2",		"name"=>"탈퇴회원 리스트",						"link"=>  "/admin/member/mem_out_list.php"),
		array("tab"=>"3",	"title"=>"member3",		"name"=>"휴먼계정 발송전 리스트",				"link"=>  "/admin/member/mem_hu_list.php"),
		array("tab"=>"4",	"title"=>"member4",		"name"=>"휴먼계정 발송후 리스트",				"link"=>  "/admin/member/mem_hu_end_list.php"),

	)
);

$GP -> MENU_SUB_ADMIN['online'] = array(
	"온라인관리"   => array(
		//array("tab"=>"1",		"name"=>"온라인상담 리스트",				"link"=>  "/admin/online/online_qna_list.php"),
		array("tab"=>"1",							"name"=>"온라인예약 리스트",				"link"=>  "/admin/online/online_reserve_list.php"),
		array("tab"=>"2",							"name"=>"온라인예약 시간설정 리스트",				"link"=>  "/admin/online/online_time_list.php"),

	)
);

$GP -> MENU_SUB_ADMIN['partner'] = array(
	"파트너관리"   => array(
		array("tab"=>"1",		"name"=>"파트너 리스트",				"link"=>  "/admin/partner/partner_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['popup'] = array(
	"팝업관리"   => array(
		array("tab"=>"1",		"name"=>"팝업 리스트",				"link"=>  "/admin/popup/popup_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['slidem'] = array(
	"슬라이드관리"   => array(
		array("tab"=>"1",	"title"=>"slide1",		"name"=>"PC 슬라이드",			"link"=>  "/admin/slidem/slide_PC_list.php"),
		array("tab"=>"2",	"title"=>"slide2",		"name"=>"모바일 슬라이드",			"link"=>  "/admin/slidem/slide_list.php"),
	)
);


$GP -> MENU_SUB_ADMIN['analytics'] = array(
	"통계관리"   => array(	
		//array("tab"=>"1",		"name"=>"PageViews 통계",				"link"=>  "/admin/analytics/PageViews.php"),
		//array("tab"=>"2",		"name"=>"Browser 통계",				"link"=>  "/admin/analytics/Browser.php"),
		array("tab"=>"3",		"name"=>"OS 통계",				"link"=>  "/admin/analytics/OS.php"),
		//array("tab"=>"4",		"name"=>"Visit 통계",				"link"=>  "/admin/analytics/Visit.php"),
		//array("tab"=>"5",		"name"=>"Total 통계",				"link"=>  "/admin/analytics/total.php"),
		array("tab"=>"6",		"name"=>"일별 통계",				"link"=>  "/admin/analytics/day_visit.php"),
		array("tab"=>"7",		"name"=>"월별 통계",				"link"=>  "/admin/analytics/month_visit.php"),
		array("tab"=>"8",		"name"=>"년별 통계",				"link"=>  "/admin/analytics/year_visit.php"),
		array("tab"=>"9",		"name"=>"영상 통계",				"link"=>  "/admin/analytics/Video.php"),		
	)
);

$GP -> MENU_SUB_ADMIN['phone'] = array(
	"모바일 온라인예약"   => array(
		array("tab"=>"1",	"title"=>"phone1",	"name"=>"간편예약신청정보",				"link"=>  "/admin/phone/phone_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['video'] = array(
	"동영상관리"   => array(
		array("tab"=>"1",	"title"=>"video1", "name"=>"동영상 정보",			"link"=>  "/admin/video/vd_list.php"),
	)
);
?>