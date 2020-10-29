<?php
// Dedc : admin 메뉴 Array
// Writer :
$GP -> MENU_ADMIN = array(
		array("tab"=>"1",			"folder"=>"main", 		"name"=>"관리자정보",		"link"=> "/admin/main/adm_info/m_tab=1"),
		array("tab"=>"2",			"folder"=>"bbs", 			"name"=>"게시판관리",		"link"=> "/admin/bbs/bbs_list/m_tab=2"),
		array("tab"=>"3",			"folder"=>"doctor", 		"name"=>"의료진관리",		"link"=> "/adm/doctor/dr_list.php?m_tab=3"),
		array("tab"=>"4",			"folder"=>"member", 	"name"=>"회원관리",			"link"=> "/adm/member/mem_list.php?m_tab=4"),
		array("tab"=>"6",			"folder"=>"nonpay", 		"name"=>"비급여관리",		"link"=> "/adm/nonpay/nonpay_list.php?m_tab=6"),
		array("tab"=>"7",			"folder"=>"mc", 			"name"=>"장비관리",			"link"=> "/adm/mc/mc_list.php?m_tab=7"),
		array("tab"=>"9",			"folder"=>"online", 		"name"=>"예약관리",			"link"=> "/adm/online/online_reserve_list.php?m_tab=9"),
		array("tab"=>"11",			"folder"=>"popup", 		"name"=>"팝업관리",			"link"=> "/adm/popup/popup_list.php?m_tab=11"),
		array("tab"=>"12",			"folder"=>"sms", 			"name"=>"SMS관리",			"link"=> "/adm/sms/sms_send.php?m_tab=12"),
		array("tab"=>"13",			"folder"=>"analytics", 	"name"=>"통계관리",			"link"=> "/adm/analytics/day_visit.php?m_tab=13")
);


$GP -> MENU_SUB_ADMIN = array();

$GP -> MENU_SUB_ADMIN['main'] = array(
	"시스템관리"   => array(
		array("tab"=>"1",		"title"=>"main1",		"name"=>"관리자 정보",		"link"=>  "/admin/main/adm_info/"),
		array("tab"=>"2",		"title"=>"main2",		"name"=>"권한 정보",			"link"=>  "/admin/main/adm_auth/"),
	)
);

$GP -> MENU_SUB_ADMIN['bbs'] = array(
	"게시판관리"   => array(
		array("tab"=>"1",		"title"=>"bbs1",		"name"=>"게시판 리스트",				"link"=>  "/adm/bbs/bbs_list.php"),		
	)
);

$GP -> MENU_SUB_ADMIN['doctor'] = array(
	"의료진관리"   => array(
		array("tab"=>"1",	"title"=>"doctor1", "name"=>"의료진 정보",			"link"=>  "/adm/doctor/dr_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['mc'] = array(
	"장비관리"   => array(
		array("tab"=>"1",	"title"=>"mc1",	"name"=>"장비 정보",			"link"=>  "/adm/mc/mc_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['member'] = array(
	"회원관리"   => array(
		array("tab"=>"1",	"title"=>"member1",		"name"=>"회원 리스트",				"link"=>  "/adm/member/mem_list.php"),
		array("tab"=>"2",	"title"=>"member2",		"name"=>"탈퇴회원 리스트",				"link"=>  "/adm/member/mem_out_list.php"),
		array("tab"=>"3",	"title"=>"member3",	"name"=>"휴먼계정 발송전 리스트",				"link"=>  "/adm/member/mem_hu_list.php"),
		array("tab"=>"4",	"title"=>"member4",	"name"=>"휴먼계정 발송후 리스트",				"link"=>  "/adm/member/mem_hu_end_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['treat'] = array(
	"치료법관리"   => array(
		array("tab"=>"1",	"title"=>"treat1",		"name"=>"치료법 정보",			"link"=>  "/adm/treat/treat_list.php"),
		array("tab"=>"2",	"title"=>"trea2",		"name"=>"치료법 노출여부",	"link"=>  "/adm/treat/treat_show_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['nonpay'] = array(
	"비급여관리"   => array(
	  array("tab"=>"1",		"title"=>"nonpay1",		"name"=>"비급여 리스트",			"link"=>  "/adm/nonpay/nonpay_list.php"),		
	)
);

$GP -> MENU_SUB_ADMIN['online'] = array(
	"예약관리"   => array(		
		array("tab"=>"1",		"title"=>"online", "name"=>"예약 리스트",				"link"=>  "/adm/online/online_reserve_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['popup'] = array(
	"팝업관리"   => array(
		array("tab"=>"1",	"title"=>"popup1",		"name"=>"팝업 리스트",				"link"=>  "/adm/popup/popup_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['sms'] = array(
	"SMS관리"   => array(
		array("tab"=>"1",	"title"=>"sms1",	"name"=>"SMS 발송",					"link"=>  "/adm/sms/sms_send.php"),										 
		array("tab"=>"2",	"title"=>"sms2",	"name"=>"SMS 설정",					"link"=>  "/adm/sms/sms_setup.php"),		
		array("tab"=>"3",	"title"=>"sms3",	"name"=>"SMS 발송리스트",		"link"=>  "/adm/sms/sms_send_list.php"),
		array("tab"=>"4",	"title"=>"sms4",	"name"=>"SMS 그룹관리",			"link"=>  "/adm/sms/sms_grouplist.php"),
		array("tab"=>"5",	"title"=>"sms5",	"name"=>"SMS 회원관리",			"link"=>  "/adm/sms/sms_memlist.php"),
	)
);


$GP -> MENU_SUB_ADMIN['analytics'] = array(
	"통계관리"   => array(	
		array("tab"=>"1",	"title"=>"analytics1",	"name"=>"일별 통계",				"link"=>  "/adm/analytics/day_visit.php"),
		array("tab"=>"2",	"title"=>"analytics2",	"name"=>"월별 통계",				"link"=>  "/adm/analytics/month_visit.php"),
		array("tab"=>"3",	"title"=>"analytics3",	"name"=>"년별 통계",				"link"=>  "/adm/analytics/year_visit.php"),		
		array("tab"=>"4",	"title"=>"analytics4",	"name"=>"Agent 통계",				"link"=>  "/adm/analytics/Agent.php"),
		array("tab"=>"5",	"title"=>"analytics5",	"name"=>"기타 통계",				"link"=>  "/adm/analytics/OS.php"),
	)
);


$GP -> BOARD_CONFIG_LEVEL	 = array(
						"0" => "일반"
						, "3" => "회원"
						, "9" => "관리자"
					);

$GP -> BOARD_FAQ_TYPE	 = array(
						"A" => "소화기"
						, "B" => "종합검진"
						, "C" => "갑상선/당뇨센터"
						, "D" => "인공신장센터"
					);

$GP -> BOARD_THESIS_TYPE	 = array(
						 " " => "전체"
						,"S" => "국제학회"
						, "F" => "해외논문"
						, "L" => "국내논문"
					);

$GP -> MEM_SEX	 = array(
						"M" => "남"
						, "F" => "여"
					);


$GP -> QNA_RESULT	 = array(
						"N" => "미처리"
						, "M" => "처리중"
						, "Y" => "처리완료"
					);

$GP -> QNA_USER_TYPE	 = array(
						"M" => "회원"
						, "G" => "비회원"
					);

$GP -> RESERVE_RESULT	 = array(
						"N" => "예약신청"
						, "M" => "처리중"
						, "Y" => "예약완료"
					);

$GP -> WITHDRAWAL_REASON	 = array(
						"1" => "사생활 기록 삭제 목적"
						, "2" => "새 아이디 생성 목적"
						, "3" => "이벤트 등의 목적으로 한시 사용함"
						, "4" => "서비스 기능 불편"
						, "5" => "제재조치로 이용제한됨"
						, "6" => "본 웹싸이트 정책 불만"
						, "7" => "개인정보 및 보안 우려"
						, "8" => "피부과 이용 안 함"
						, "9" => "기타"
					);


//요일 정보
$GP -> GL_WEEK_INFO =
		array (
			"sun" => "일",
                        "mon" => "월",
                        "tue" => "화",
                        "wed" => "수",
                        "thu" => "목",
                        "fri" => "금",
                        "set" => "토"
                    );

//전화번호 기본 입력(휴대폰만)
$GP -> MOBILE =
			array(
				"010" => "010"
				, "011" => "011"
				, "016" => "016"
				, "017" => "017"
				, "018" => "018"
				, "019" => "019"
			);

//전화번호 기본 입력(휴대폰포함)
$GP -> TELEPHONE =
				array(
					"02" => "02"
					, "031" => "031"
					, "032" => "032"
					, "033" => "033"
					, "041" => "041"
					, "042" => "042"
					, "043" => "043"
					, "051" => "051"
					, "052" => "052"
					, "053" => "053"
					, "054" => "054"
					, "055" => "055"
					, "061" => "061"
					, "062" => "062"
					, "063" => "063"
					, "064" => "064"
					, "070" => "070"
					, "080" => "080"
					, "0505" => "0505"
					, "1544" => "1544"
					, "1566" => "1566"
					, "1577" => "1577"
					, "1588" => "1588"
					, "1599" => "1599"
					, "1577" => "1577"
				);


/************************************************/
/*          이메일 정보                         */
/************************************************/
$GP -> EMAIL =
			array (
					'hanmail.net' => '다음(한메일)'
					, 'yahoo.com' => '야후'
					, 'naver.com' => '네이버'
					, 'paran.com' => '파란'
					, 'nate.com' => '네이트'
					, 'empal.com' => '엠팔'
					, 'hitel.net' => '하이텔'
					, 'hanmir.com' => '한미르'
					, 'chol.com' => '천리안'
					, 'korea.com' => '코리아닷컴'
					, 'netian.com' => '네띠앙'
					, 'dreamwiz.com' => '드림위즈'
					, 'lycos.co.kr' => '라이코스'
					, 'orgio.net' => '오르지오'
					, 'unitel.co.kr' => '유니텔'
					, 'kornet.net' => '코넷'
					, 'freechal.com' => '프리첼'
					, 'hanafos.com' => '하나포스'
					, 'hotmail.com' => '핫메일'
					, 'gmail.com' => '구글'
					, 'msn.com' => 'MSN'
			);



//진료과목
$GP -> CENTER_TYPE = array(
				'A' => '척추센터',
				'B' => '관절센터',
				'C' => '내과클리닉',
				'D' => '검진센터',
				'E' => '통증센터',
			);


//진료과목
$GP -> CLINIC_TYPE = array(
				'A' => '내과',
				'B' => '외과',
				'C' => '신경외과',
				'D' => '정형외과',
				'E' => '산부인과',
				'F' => '소아청소년과',
				'G' => '비뇨기과',
				'H' => '이비인후과',
				'I' => '마취통증의학과',
				'J' => '영상의학과',
				'K' => '진단검사의학과',
				'L' => '응급의학과',
				'M' => '치과센터',
				'N' => '가정의학과',
				'O' => '직업환경의학과',
				'P' => '재활의학과',
				'Q' => '건강증진센터',
			);


//의료진 직책
$GP -> DOCTOR_POSITION = array(
				'A' => '병원장',
				'H' => '부원장',
				'B' => '이사',
				'C' => '진료부장',
				'D' => '교육수련부장',
				'E' => '재활의학센터장',
				'F' => '건강증진센터장',
				'G' => '진료과장',
			);


$GP -> DOCTOR_SPECIAL = array(
				'S' => '전문의',
				'N' => '비전문의',
				'H' => '한의사',
			);


//진료일정타입
$GP -> DOCTOR_SCH = array(
				'1' => '진료',
				'2' => '진료안함',
				'3' => '수술'

			);

//대분류
$GP -> CATE_TYPE1 = array(
				'1' => '증명서발급',
				'2' => '검사',
				'3' => '주사요법',
				'4' => '한방',
				'5' => '기타',
			);


//치료법
$GP->CATE_CURE = array(
				'A'=>'허리',
				'B'=>'목',
				'C'=>'어깨',
				'D'=>'팔꿈치',
				'E'=>'수부(손/손목)',
				'F'=>'고관절',
				'G'=>'무릎',
				'H'=>'족부(발/발목)',
			);


//치료법 카테고리
$GP->CATE1 = array(
			'A' => '어디가 불편하십니까?',
			'B' => '비수술로 힘내라',
			'C' => '수술로 힘내라',
		);


//치료법 카테고리
$GP->CATE2 = array(
			'A' => array(
				'A-1' => '허리',
				'A-2' => '목',
				'A-3' => '어깨',
				'A-4' => '무릎',
				'A-5' => '팔꿈치',
				'A-6' => '수부(손/손목)',
				'A-7' => '고관절',
				'A-8' => '족부(발/발목)',
				),
			'B' => array(
				'B-1' => '힘내라 허리',
				'B-2' => '힘내라 목',
				'B-3' => '힘내라 어깨',
				'B-4' => '힘내라 무릎',
				'B-5' => '힘내라 팔꿈치',
				'B-6' => '힘내라 수부',
				'B-7' => '힘내라 고관절',
				'B-8' => '힘내라 족부',
				),
			'C' => array(
				'C-1' => '힘내라 허리',
				'C-2' => '힘내라 목',
				'C-3' => '힘내라 어깨',
				'C-4' => '힘내라 무릎',
				'C-5' => '힘내라 팔꿈치',
				'C-6' => '힘내라 수부',
				'C-7' => '힘내라 고관절',
				'C-8' => '힘내라 족부',
				),
			);

$GP->CON_TYPE = array(
				'1' => '일반',
				'2' => '좌우배치',
				'3' => '왼쪽 이미지',
				'4' => '오른쪽 이미지',
				'5' => '이미지',
				'6' => '리스트 형태',
				'7' => '탭 형태',
				'8' => '아코디언 형태',
				'9' => '동영상',
				'10' => '페이지 주요문구',
				'11' => '최종 버튼',
			);


$GP->CON_CNT = array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
			);


//대분류
$GP -> NONPAY_CATE_TYPE1 = array(
				'1' => '행위',
				'2' => '치료재료',
				'3' => '약제',
				'4' => '제증명수수료',
			);

//중분류
$GP -> NONPAY_CATE_TYPE1_1 = array(
				'1' => '제1장 기본진료료',
				'2' => '      1-1장 상급병실료 차액',
				'3' => '제2장 검사료',
				'4' => '      2-1장 초음파검사료',
				'5' => '제3장 영상진단 및 방사선 치료료',
				'6' => '    3-1장 초음파 영상료',
				'7' => '    3-2장 자기공명영상진단료(MRI)',
				'8' => '    3-3장 양전자단층촬영료(PET) ',
				'9' => '제5장 주사료',
				'10' => '제6장 마취료',
				'11' => '제7장 이학요법료(물리치료료)',
				'12' => '제8장 정신요법료',
				'13' => '제9장 처치 및 수술료 등',
				'99' => '기타',
			);


// 예약간격 구분
$GP -> RESERVE_INTERVAL_TYPE	 = array(
						"15" => "15분",
						"30" => "30분",
						"60" => "1시간"
					);

$GP->RESERVE_CL_TYPE = array(
					'1'=>'초진',
					'2'=>'재진',
					);



//페이지통계 잡을 곳
$GP->PAGE_TYPE = array(
				'/intro/intro01.html' => array(
										'0' => 'SW1',
										'1'=>'윌병원 다짐'
									),

			);

$GP -> DOCTOR_SCH_SHOW = array(
				'1' => '<span class="check1">진료</span>',
				'2' => '<span class="non">X</span>',
				'3' => '<span class="check2">수술</span>',
			);


$GP->RECRUIT_TYPE = array(
				'D' => '의료진',
				'A' => '간호부',
				'B' => '진료지원부',
				'C' => '행정부',
			);


$GP->HELP_TYPE = array(
				'A' => '예약문의',
				'B' => '이용안내',
				'C' => '제증명발급관련',
				'D' => '기타',
			);


function BOARD_CONFIG_LEVEL($code) {
	switch($code) {
		case '0':	
			$txt = "일반";
			break;
		case '3':	
			$txt = "회원";
			break;
		case '9':	
			$txt = "관리자";
			break;
	}
	return $txt;
}
function AUTH_LEVEL($code) {
	switch($code) {
		case '9':	
			$txt = "관리자";
			break;
		case '6':	
			$txt = "매니져";
			break;
	}
	return $txt;
	
}
?>