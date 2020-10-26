<?
// HEADER
@header("Content-Type: text/html; charset=utf-8");
@header("Cache-Control: no-cache, must-revalidate");
@header("Pragma: no-cache");
@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
@Header("Access-Control-Allow-Origin: *");
@Header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
@header("Access-Control-Allow-Headers: X-Requested-With, X-Prototype-Version");



@ini_set("session.cache_expire",3600*2);
@ini_set("session.gc_maxlifetime",3600*2);
@ini_set("session.cookie_domain", ".nkhospital.net");
//@ini_set("session.save_path", "");
@ini_set("session.use_trans_sid", "1");

@session_set_cookie_params ( 0, "/", ".nkhospital.net");
@session_start();

@extract($_GET);
@extract($_POST);
@extract($_SERVER);

//print_r($_SESSION);
//echo phpinfo();
//echo session_module_name();
class object {};
$GP = new object;

////////////////////////////////////////////////////////////////
//# Path config
////////////////////////////////////////////////////////////////
// default include path
$GP -> DOCROOT	= $_DEF_PATH;
$GP -> WEBROOT 		= '/';
$GP -> ROOT 		= $GP -> DOCROOT . $GP -> WEBROOT;

$GP -> CLS		= $GP -> ROOT . '_CLASS/';
$GP -> INC		= $GP -> ROOT . '_INC/';
$GP -> COM		= $GP -> ROOT . '_COMMON/';
$GP -> HOME		= $GP -> ROOT . 'www/';

$GP -> IP				= $_SERVER['SERVER_ADDR'];
$GP -> DOMAIN			= $_SERVER['HTTP_HOST'];
$GP -> SERVICE_DOMAIN		= 'http://nkhospital.net';
$GP -> HTTPS			= 'https://' . $GP -> DOMAIN;
$GP -> HTTP			= 'http://' . $GP -> DOMAIN;
$GP -> HTTPS_PORT		= 44809;

$GP -> QUERY_STRING = $_SERVER['QUERY_STRING'];
$GP -> SELFPAGE 		= $_SERVER['PHP_SELF'];
$GP -> NOWPAGE 			= $GP -> SELFPAGE . '?' . $_SERVER['QUERY_STRING'];
$GP -> NOWPAGE_ENC 	= urlencode($GP -> NOWPAGE);

$GP -> INC_ADM = $GP -> HOME ."admin/";
$GP -> INC_ADM_PATH = $GP -> HOME ."admin/inc/";


$GP -> INC_WWW		= $GP -> HOME ."inc";
$GP -> INC_V2		= $GP -> HOME ."v2";
$GP -> INC_V2_INC	= $GP -> HOME ."v2/inc";
$GP -> INC_PATH = $GP -> HOME . "bbs";
$GP -> IMG_PATH = $GP -> HTTP . "/bbs";
$GP -> JS_SMART_PATH = $GP -> HTTP . "/bbs/smarteditor/js";
$GP -> JS_PATH = $GP -> HTTP . "/js";

## 스마트에디터 업로드 경로
$GP -> UP_IMG_SMARTEDITOR = $GP -> HOME . 'bbs/files/';
$GP -> UP_IMG_SMARTEDITOR_URL = $GP -> HTTP . '/bbs/files/';

## 의료진 관련
$GP -> UP_DOCTOR			= $GP -> HOME . 'common/doctor/';
$GP -> UP_DOCTOR_URL			= $GP -> HTTP . '/common/doctor/';


## 팝업 링크
$GP -> UP_POPUP					= $GP -> HOME . 'popup/upfile/';
$GP -> UP_POPUP_URL			= $GP -> HTTP . '/popup/upfile/';

## 저서 및 논문
$GP -> UP_BOOK				= $GP -> HOME . 'common/book/';
$GP -> UP_BOOK_URL			= $GP -> HTTP . '/common/book/';

## 동영상 관련
$GP -> UP_VIDEO			= $GP -> HOME . 'common/video/';
$GP -> UP_VIDEO_URL			= $GP -> HTTP . '/common/video/';

## 동영상 관련
$GP -> UP_SLIDE				= $GP -> HOME . 'common/slide/';
$GP -> UP_SLIDE_URL			= $GP -> HTTP . '/common/slide/';


////////////////////////////////////////////////////////////////
//# Load class
////////////////////////////////////////////////////////////////
// 기본 함수
include_once $GP -> CLS . 'class.func.php';
$C_Func 		= new Func;

////////////////////////////////////////////////////////////////
//# Database config
////////////////////////////////////////////////////////////////
include_once $GP -> INC . 'db.inc';


////////////////////////////////////////////////////////////////
//# Admin config
////////////////////////////////////////////////////////////////
$GP -> Admin_Email = "webmaster@nkhospital.net";
$GP -> Admin_Phone = "031-980-9114";
$GP -> Admin_Name = "관리자";
$GP -> Admin_HP_NAME = "뉴고려병원";
$GP -> Admin_HP_NAME1 = "뉴고려병원";
$GP -> Admin_BizNum = "";
$GP -> HOME_MAIN_ADDRESS = "경기도 김포시 김포한강3로 283번지";
//$GP -> SMS_HP1 = "031";
//$GP -> SMS_HP2 = "980";
//$GP -> SMS_HP3 = "9114";

$GP -> SMS_HP1 = "010";
$GP -> SMS_HP2 = "7512";
$GP -> SMS_HP3 = "1587";

////////////////////////////////////////////////////////////////
//# SMTP config
////////////////////////////////////////////////////////////////
$GP -> SMTP_USE 		= true;
$GP -> SMTP_SERVER		= 'uws64-009.cafe24.com';
$GP -> SMTP_IP			= '211.196.153.97';
$GP -> SMTP_PORT		= '587';
$GP -> SMTP_USER		= 'webmaster@nkhospital.net';
$GP -> SMTP_PASS		= 'nk9809114';


////////////////////////////////////////////////////////////////
//# NAVER config
////////////////////////////////////////////////////////////////
$GP -> NAVER_CLIENT_ID = 'lj16OSSmMtUkxbIyNHAI';
$GP -> NAVER_CLIENT_SECRET = 'iaOfH7mt91';
$GP -> NAVER_RETURN_URL = 'http://nkhospital.net/mypage/proc/login_proc.php?mode=naver';
$GP -> NAVER_RETURN_URL_M = 'http://nkhospital.net/v3/?mode=naver';

////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////
//# Pass config
////////////////////////////////////////////////////////////////
$GP -> PASS = 'ka-100';


////////////////////////////////////////////////////////////////
//# SMS config
////////////////////////////////////////////////////////////////
$GP -> SMS_ID = 'newgo';
$GP -> SMS_PWD = md5('medi_newgo1203');



////////////////////////////////////////////////////////////////
//# 권한 설정
////////////////////////////////////////////////////////////////
$GP -> AUTH_LEVEL	 = array(
						"9" => "관리자"
						, "6" => "매니져"
					);

$GP -> BOARD_CONFIG_LEVEL	 = array(
						"0" => "일반"
						, "3" => "회원"
						, "9" => "관리자"
					);

$GP -> BOARD_FAQ_TYPE	 = array(
						"M" => "병원이용"
						, "D" => "피부미용"
						, "L" => "피부질환"
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
						"N" => "예약<br>신청"
						, "M" => "확인중"
						, "C" => "답변<br>완료"
						, "Y" => "예약<br>완료"
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

$GP -> BANNER_TYPE	 = array(
						"L" => "좌측"
						, "T" => "상단"
					);

$GP -> NOTICE_TYPE	 = array(
						"" => "전체보기"
						,"A" => "공지사항"
						, "B" => "일반안내"
						, "C" => "병원소식"
					);

$GP -> WEBZINE_TYPE	 = array(
						"A" => "커버스토리"
						,"B" => "건강하십니까?"
						, "C" => "김포리포트"
						, "D" => "튼튼한아이"
						, "E" => "굿모닝레시피"
						, "F" => "뉴고려人"
					);
$GP -> WEBZINE_YEAR	 = array(
						"2017" => "2017"
						,"2018" => "2018"
						, "2019" => "2019"
						, "2020" => "2020"
					);
$GP -> WEBZINE_MONTH = array(
						"01" => "01"
						,"02" => "02"
						, "03" => "03"
						, "04" => "04"
						, "05" => "05"
						, "06" => "06"
						, "07" => "07"
						, "08" => "08"
						, "09" => "09"
						, "10" => "10"
						, "11" => "11"
						, "12" => "12"
					);
//요일 정보
$GP -> GL_WEEK_INFO = array (
    										"sun" => "일",
                        "mon" => "월",
                        "tue" => "화",
                        "wed" => "수",
                        "thu" => "목",
                        "fri" => "금",
                        "set" => "토"
                    );

//요일 정보
$GP -> GL_WEEK_INFO1 = array (
                        "월" => "월",
                        "화" => "화",
                        "수" => "수",
                        "목" => "목",
                        "금" => "금",
                        "토" => "토"
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
$GP -> CLINIC_TYPE1 = array(
				'K' => '일반외과',
				/*'L' => '흉부외과',*/
				'M' => '신경과',
				'N' => '산부인과',
				'O' => '치과',
				'P' => '영상의학과',
				'Q' => '진단검사의학과',
				'R' => '내분비내과',
				'T' => '호흡기내과',
				'U' => '이비인후과',
				'V' => '피부비뇨의학과'
			);

//진료과목_URL
$GP -> CLINIC_URL1 = array(
				'/clinic/clinic_01.html?tr_type=A' => '정형외과',
				'/clinic/clinic_01.html?tr_type=B' => '신경외과',
				'/clinic/clinic_01.html?tr_type=C' => '내과',
				'/clinic/clinic_01.html?tr_type=D' => '소아청소년과',
				'/clinic/clinic_01.html?tr_type=E' => '산부인과',
				'/clinic/clinic_01.html?tr_type=F' => '마취통증의학과',
				'/clinic/clinic_01.html?tr_type=G' => '응급의학과',
				'/clinic/clinic_01.html?tr_type=H' => '평생건강증진센터',
				'/clinic/clinic_01.html?tr_type=I' => '일반외과',
				/*'/clinic/clinic_01.html?tr_type=J' => '흉부외과',*/
				'/clinic/clinic_01.html?tr_type=K' => '신경과',
				'/clinic/clinic_01.html?tr_type=L' => '치과',
				'/clinic/clinic_01.html?tr_type=M' => '영상의학과',
				'/clinic/clinic_01.html?tr_type=N' => '진단검사의학과'
			);



//진료센터
$GP -> CLINIC_TYPE2 = array(
				'A' => '관절센터',
				'B' => '척추센터',
				'C' => '외상센터',
				'D' => '뇌신경센터',
				'E' => '소화기센터',
				'F' => '심혈관센터',
				'G' => '소아청소년센터',
				'H' => '통증센터',
				'I' => '응급의학센터',
				'J' => '평생건강증진센터',
				'S' => '신장센터',
			);

//통합 20150206 최신
$GP -> CLINIC_TYPE_NEW = array(
				'A' => '관절센터',
				'B' => '척추센터',
				'C' => '외상센터',
				'D' => '뇌신경센터',
				'E' => '소화기센터',
				'F' => '심혈관센터',
				'G' => '소아청소년센터',
				'H' => '통증센터',
				'I' => '응급의료센터',
				'J' => '평생건강증진센터',
				'K' => '일반외과',
				/*'L' => '흉부외과',*/
				'M' => '신경과',
				'N' => '산부인과',
				'O' => '치과',
				'P' => '영상의학과',
				'Q' => '진단검사의학과',
				'R' => '내분비내과',
				'S' => '신장센터',
				'T' => '호흡기내과',
				'U' => '이비인후과',
				'V' => '피부비뇨의학과',
				'W' => '재활의학과',
				'X' => '가정의학과',
				'Y' => '감염내과',
				'Z' => '정신건강의학과',
				'AA' => '직업환경의학과',
			);
$GP -> CLINIC_TYPE_NEW2 = array(
				'A' => '관절센터',
				'B' => '척추센터',
				'C' => '외상센터',
				'D' => '뇌신경센터',
				'E' => '소화기센터',
				'F' => '심혈관센터',
				'G' => '소아청소년센터',
				'H' => '신경통증의학센터',
				'I' => '응급의학센터',
				'J' => '평생건강증진센터',
				'K' => '일반외과',
				/*'L' => '흉부외과',*/
				'M' => '신경과',
				'N' => '산부인과',
				'O' => '치과',
				'P' => '영상의학과',
				'Q' => '진단검사의학과',
				'R' => '내분비내과',
				'S' => '신장센터',
				'T' => '호흡기내과',
				'U' => '이비인후과',
				'V' => '피부비뇨의학과',
				'W' => '재활의학과',
				'X' => '기타',
			);




$GP -> CLINIC_TYPE4 = array(
				'O' => '일반 상담',
				'A' => '정형외과',
				'B' => '신경외과',
				'C' => '내과',
				'D' => '소아청소년과',
				'E' => '산부인과',
				'F' => '마취통증의학과',
				'G' => '응급의학과',
				'H' => '평생건강증진센터',
				'I' => '일반외과',
				/*'J' => '흉부외과',*/
				'K' => '신경과',
				'L' => '치과',
				'M' => '영상의학과',
				'N' => '진단검사의학과'
			);




//진료센터
$GP -> CLINIC_TYPE6 = array(
				'A' => '관절센터',
				'B' => '외상센터',
				'C' => '척추센터',
				'D' => '뇌신경센터',
				'E' => '소화기센터',
				'F' => '심혈관센터',
				'G' => '소아청소년센터',
				'H' => '여성센터',
				'I' => '통증의학센터',
				'J' => '응급의학센터',
				'K' => '평생건강증진센터',
				'L' => '일반외과',
				/*'M' => '흉부외과',*/
				'N' => '신경과',
				'O' => '치과',
				'P' => '영상의학과',
				'Q' => '진단검사의학과'
			);



//진료센터_URL
$GP -> CLINIC_URL2 = array(
				'/clinic/clinic_center.html?ct_type=A' => '관절센터',
				'/clinic/clinic_center.html?ct_type=B' => '외상센터',
				'/clinic/clinic_center.html?ct_type=C' => '척추센터',
				'/clinic/clinic_center.html?ct_type=D' => '뇌신경센터',
				'/clinic/clinic_center.html?ct_type=E' => '소화기센터',
				'/clinic/clinic_center.html?ct_type=F' => '심혈관센터',
				'/clinic/clinic_center.html?ct_type=G' => '소아청소년센터',
				'/clinic/clinic_center.html?ct_type=H' => '여성센터',
				'/clinic/clinic_center.html?ct_type=I' => '통증의학센터',
				'/clinic/clinic_center.html?ct_type=J' => '응급의학센터',
				'/clinic/clinic_center.html?ct_type=K' => '평생건강증진센터'
			);


//특수클리닉
$GP -> CLINIC_TYPE3 = array(
				'A' => '하지정맥류',
				'B' => '아토피클리닉',
				'C' => '요실금클리닉',
				'D' => '성장클리닉',
				'E' => '맘모톰클리닉',
				'F' => '뷰티클리닉',
				'G' => '비만클리닉',
				'H' => '당뇨클리닉',
				'I' => '갑상선클리닉',
				'J' => '복강경수술 클리닉'
			);


//의료진 직책
$GP -> DOCTOR_POSITION = array(
				'A' => '이사장',
				'B' => '의료원장',
				'C' => '병원장',
				'D' => '센터원장',
				'G' => '센터장',
				'E' => '과장',
				'F' => '이사',
				'H' => '명예원장',
				'I' => '실장'
			);




$GP -> CLINIC_TYPE5 = array(

				'H' => '평생건강증진센터',

			);





//대분류
$GP -> CATE_TYPE1 = array(
				'A' => '행위',
				'B' => '치료재료',
				'C' => '약제',
				'D' => '제증명수수료',
				'E' => '상급병실료 차액'
			);


//중분류
$GP -> CATE_TYPE2 = array(
				'A-1' => '물리치료',
				'A-2' => '처치 및 수술료 등',
				'A-3' => '검사료(특수검사)',
				'A-4' => '검사료(진단검사)',
				'A-5' => '검사료(내시경)',
				'A-6' => '검사료',
				'A-7' => '초음파검사료',
				'A-8' => '자기공명영상진단료(MRI)',
				'A-9' => '기타',
				'A-10' => '치과 처치ㆍ수술료',
				'B-1' => '처치재료',
				'B-2' => '수술재료',
				'B-3' => 'CAST재료',
				'C-1' => '내복약',
				'C-2' => '외용약',
				'C-3' => '주사약제',
				'D-1' => '제증명수수료',
				'E-1' => '상급병실료 차액',
			);
/*$GP -> CATE_TYPE2 = array(

				'A-1' => '상급병실료 차액',
				'A-2' => '검사료',
				'A-3' => '초음파 검사료',
				'A-4' => '초음파 영상료',
				'A-5' => '전산화단층영상진단(CT)',
				'A-6' => '자기공명영상진단료(MRI)',
				'A-7' => '이학요법료(물리치료료)',
				'A-8' => '처치 및 수술료 등',
				'A-9' => '치과 처치ㆍ수술료',
				'A-10' => '기타',
				'B-1' => '치료재료',
				'B-3' => '치료재료대',
				'B-4' => '수술재료대',
				'B-2' => '기타',
				'C-1' => '약제',
				'D-1' => '제증명수수료',
				'E-1' => '가격정보(%)',
				'E-2' => '가격정보(원)',
			);*/

//모바일 진료과 구분
$GP -> MOBILE_CLINIC = array(
				'K' => '일반외과',
				'M' => '신경과',
				'N' => '산부인과',
				'O' => '치과',
				'P' => '영상의학과',
				'Q' => '진단검사의학과',
				'R' => '내분비내과',
				'T' => '호흡기내과',
				'U' => '이비인후과',
				'V' => '피부비뇨의학과',
				'w' => '재활의학과',
				'X' => '가정의학과',
				'Y' => '감염내과',
			//	'Z' => '정신건강의학과',
				'AA' => '직업환경의학과',
		);


//모바일 센터 구분
$GP -> MOBILE_CLINIC2 = array(
				'A' => '관절센터',
				'B' => '척추센터',
				'C' => '외상센터',
				'D' => '뇌신경센터',
				'E' => '소화기센터',
				'F' => '심혈관센터',
				'G' => '소아청소년센터',
				'H' => '마취통증의학과센터',
				'I' => '응급의학센터',
				'J' => '평생건강증진센터',
		);

//NEW 모바일
$GP -> NEW_MOBILE_CENTER_ALL = array(
	'A' => '관절센터',
	'B' => '척추센터',
	'C' => '외상센터',
	'D' => '뇌신경센터',
	'F' => '심혈관센터',
	'E' => '소화기센터',
	'S' => '신장센터',
	'G' => '소아청소년센터',
	'H' => '통증센터',
	'I' => '응급의료센터',
	'J' => '평생건강증진센터',
	'AB' => '정형외과',
	'AC' => '신경외과',
	'K' => '일반외과',
	'AD' => '소화기내과',
	'AE' => '순환기내과',
	'AF' => '신장내과',
	'T' => '호흡기내과',
	'R' => '내분비내과',
	'M' => '신경과',
	'AG' => '소아청소년과',
	'N' => '산부인과',
	'U' => '이비인후과',
	'V' => '피부비뇨의학과',
	'Z' => '정신건강의학과',
	'W' => '재활의학과',
	'O' => '치과',
	'P' => '영상의학과',
	'AH' => '마취통증의학과',
	'Q' => '진단검사의학과',
	'X' => '가정의학과',
	'AA' => '직업환경의학과',
	'AI' => '응급의학과'
);

$GP -> NEW_MOBILE_CENTER = array(
	'A' => '관절센터',
	'B' => '척추센터',
	'C' => '외상센터',
	'D' => '뇌신경센터',
	'F' => '심혈관센터',
	'E' => '소화기센터',
	'S' => '신장센터',
	'G' => '소아청소년센터',
	'H' => '통증센터',
	'I' => '응급의료센터',
	'J' => '평생건강증진센터'
);

$GP -> NEW_MOBILE_CENTER_OLD = array(
	'A' => '관절센터',
	'F' => '심혈관센터',
	'B' => '척추센터',
	'G' => '소아청소년센터',
	'C' => '외상센터',
	'H' => '통증센터',
	'D' => '뇌신경센터',
	'I' => '응급의학센터',
	'E' => '소화기센터',
	'J' => '평생건강증진센터',
	'S' => '신장센터'
);

$GP -> NEW_MOBILE_CLINIC = array(
	'AB' => '정형외과',
	'AC' => '신경외과',
	'K' => '일반외과',
	'AD' => '소화기내과',
	'AE' => '순환기내과',
	'AF' => '신장내과',
	'T' => '호흡기내과',
	'R' => '내분비내과',
	'M' => '신경과',
	'AG' => '소아청소년과',
	'N' => '산부인과',
	//'U' => '이비인후과',
	'V' => '피부비뇨의학과',
	//'Z' => '정신건강의학과',
	'W' => '재활의학과',
	'O' => '치과',
	'P' => '영상의학과',
	'AH' => '마취통증의학과',
	'Q' => '진단검사의학과',
	//'X' => '가정의학과',
	'AA' => '직업환경의학과',
	'AI' => '응급의학과'
);

$GP -> NEW_MOBILE_CLINIC_OLD = array(
	'K' => '일반외과',
	'P' => '영상의학과',
	'Q' => '진단검사의학과',
	'M' => '신경과',
	'R' => '내분비내과',
	'N' => '산부인과',
	'O' => '치과',
	'T' => '호흡기내과',
	'U' => '이비인후과',
	'V' => '피부비뇨의학과',
	'W' => '재활의학과',
	'X' => '가정의학과',
	'Z' => '정신건강의학과',
	'AA' => '직업환경의학과'
);

$GP -> NEW_MOBILE_SPECIAL= array(
	'A' => '하지정맥류 클리닉',
	'C' => '요실금클리닉',
	'G' => '비만클리닉',
	'I' => '갑상선클리닉',
	'J' => '복강경 클리닉',
	'H' => '당뇨클리닉',
	'E' => '맘모톰클리닉',
	'F' => '재활치료센터'
);

//메뉴 네비관련
$GP -> Navi_Dep1 = array(
				'0' =>  array('서비스 이용안내','/guide/page01.html'),
				'1' =>  array('진료과/의료진','/center01/page.php?depart=A&gubun=A'),
				'2' =>  array('뉴고려커뮤니티','/health/page01.html'),
			);
$GP -> Navi_Dep2 = array(
			'0' => array(
					'0-0' => array('예약/발급', '/guide/page01.html'),
					'0-1' => array('진료안내', '/guide/page03.html'),
					'0-2' => array('입/퇴원 안내', '/guide/page06.html'),
					'0-3' => array('병원안내', '/guide/page08.html'),
				),
			'1' => array(
					'1-0' => array('전문센터', '/center01/page.php?depart=A&gubun=A'),
					'1-1' => array('진료과', '/center01/page.php?depart=AB&gubun=B'),
					'1-2' => array('특수클리닉', '/center01/page.php?depart=A&gubun=C'),
					'1-3' => array('의료진 소개', '/doctor/page.php?depart=A&gubun=A'),
				),
			'2' => array(
					'2-0' => array('소통/공감', '/notice/page01.html'),
					'2-1' => array('병원소개', '/notice/page07.html'),
				)
		);
$GP -> Navi_Dep3 = array(
			'0-0' => array(
					'0-0-0' => array('진료예약', '/guide/page01.html'),
					'0-0-1' => array('검진예약', '/guide/page02.html'),
					'0-0-2' => array('증명서발급안내', '/guide/page02.html'),
				),
			'0-1' => array(
					'0-1-0' => array('외래진료안내', '/guide/page03.html'),
					'0-1-1' => array('응급진료안내', '/guide/page04.html'),
				),
			'0-2' => array(
					'0-2-0' => array('입/퇴원 안내', '/guide/page06.html'),
					'0-2-1' => array('입원생활안내', '/guide/page06.html'),
					'0-2-2' => array('면회안내', '/guide/page06.html'),
				),
			'0-3' => array(
					'0-3-0' => array('병원둘러보기', '/guide/page08.html'),
					'0-3-1' => array('오시는길/주차안내', '/guide/page08.html'),
					'0-3-2' => array('장례식장', '/guide/page08.html'),
					'0-3-3' => array('전화번호 안내', '/guide/page08.html'),
				),
			'1-0' => array(
					'1-0-0' => array('관절센터', '/center01/page.php?depart=A&gubun=A'),
					'1-0-1' => array('외상센터', '/center01/page.php?depart=C&gubun=A'),
                    '1-0-2' => array('심혈관센터', '/center01/page.php?deparF=C&gubun=A'),
                    '1-0-3' => array('신장센터', '/center01/page.php?depart=S&gubun=A'),
                    '1-0-4' => array('통증센터', '/center01/page.php?depart=H&gubun=A'),
                    '1-0-5' => array('평생건강증진센터', '/center01/page.php?depart=J&gubun=A'),
                    '1-0-6' => array('척추센터', '/center01/page.php?depart=B&gubun=A'),
                    '1-0-7' => array('뇌신경센터', '/center01/page.php?depart=D&gubun=A'),
                    '1-0-8' => array('소화기센터', '/center01/page.php?depart=E&gubun=A'),
                    '1-0-9' => array('소아청소년센터', '/center01/page.php?depart=G&gubun=A'),
                    '1-0-10' => array('응급의료센터', '/center01/page.php?depart=I&gubun=A'),
				),
            '1-1' => array(
					'1-1-0' => array('정형외과', '/center01/page.php?depart=AB&gubun=B'),
					'1-1-1' => array('일반외과', '/center01/page.php?depart=K&gubun=B'),
					'1-1-2' => array('순환기내과', '/center01/page.php?depart=AE&gubun=B'),
					'1-1-3' => array('호흡기내과', '/center01/page.php?depart=T&gubun=B'),
					'1-1-4' => array('신경과', '/center01/page.php?depart=M&gubun=B'),
					'1-1-5' => array('산부인과', '/center01/page.php?depart=N&gubun=B'),
					'1-1-6' => array('재활의학과', '/center01/page.php?depart=W&gubun=B'),
					'1-1-7' => array('마취통증의학과', '/center01/page.php?depart=AH&gubun=B'),
					'1-1-8' => array('직업환경의학과', '/center01/page.php?depart=AA&gubun=B'),
					'1-1-9' => array('신경외과', '/center01/page.php?depart=AC&gubun=B'),
					'1-1-10' => array('소화기내과', '/center01/page.php?depart=AD&gubun=B'),
					'1-1-11' => array('신장내과', '/center01/page.php?depart=AF&gubun=B'),
					'1-1-12' => array('내분비내과', '/center01/page.php?depart=R&gubun=B'),
					'1-1-13' => array('소아청소년과', '/center01/page.php?depart=AG&gubun=B'),
					'1-1-14' => array('피부비뇨의학과', '/center01/page.php?depart=V&gubun=B'),
					'1-1-15' => array('치과', '/center01/page.php?depart=O&gubun=B'),
					'1-1-16' => array('영상의학과', '/center01/page.php?depart=P&gubun=B'),
					'1-1-17' => array('진단검사의학과', '/center01/page.php?depart=Q&gubun=B'),
					'1-1-18' => array('응급의학과', '/center01/page.php?depart=AI&gubun=B'),
				),
			'1-2' => array(
					'1-2-0' => array('하지정맥류클리닉', '/center01/page.php?depart=A&gubun=C'),
					'1-2-1' => array('요실금클리닉', '/center01/page.php?depart=C&gubun=C'),
					'1-2-2' => array('비만클리닉', '/center01/page.php?depart=G&gubun=C'),
					'1-2-3' => array('갑상선클리닉', '/center01/page.php?depart=I&gubun=C'),
					'1-2-4' => array('복강경클리닉', '/center01/page.php?depart=J&gubun=C'),
					'1-2-5' => array('당뇨클리닉', '/center01/page.php?depart=H&gubun=C'),
					'1-2-6' => array('맘모톰클리닉', '/center01/page.php?depart=E&gubun=C'),
					'1-2-7' => array('재활치료센터', '/center01/page.php?depart=F&gubun=C'),
				),
			'1-3' => array(
					'1-3-0' => array('전문센터', '/doctor/page.php?depart=A&gubun=A'),
					'1-3-1' => array('진료과', '/doctor/page.php?depart=AB&gubun=B'),
					'1-3-2' => array('특수클리닉', '/doctor/page.php?depart=A&gubun=C'),
				),
            '2-0' => array(
					'2-0-0' => array('건강증진센터소개', '/health/page01.html'),
					'2-0-1' => array('보험공단검진', '/health/page02-1.html'),
                    '2-0-2' => array('개인종합검진', '/health/page03-1.html'),
                    '2-0-3' => array('기업검진', '/health/page04.html'),
                    '2-0-4' => array('특수검진', '/health/page05.html'),
                    '2-0-5' => array('기타검진', '/health/page06-1.html'),
				),
			//'2-1' => array(
			//		'2-1-0' => array('이용안내', '/health/page07.html'),
			//	)
		);
$GP-> WEB_TITLE = "뉴고려병원";
$GP-> ADM_TITLE = "뉴고려병원 관리자 페이지";
?>