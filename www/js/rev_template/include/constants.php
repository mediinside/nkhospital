<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}
//kakao setting
define("CLIENT_ID","9821ebf5f096a00469683033d1ba1abf");
define("REDIRECT_URI","http://nkhospital.net/online/kakao/");
//TABLE NAME
define("MEMBER_TABLE","Member");
define("GUEST_TABLE","MemberGuest");
define("RESERVE_TABLE","Reservation");

//공통
define("ZIPCODE_TABLE","zipcode");

//SMS
define("SMS_ID","newgo");
define("SMS_PW","medi_newgo1203");
define("SMS_HP","070-8830-8903");
define("SMS_HP_TEST","010-7512-1587");

//에러코드
define("MEMBER_IS_NOT_FOUND",100);
define("ERR_NO_PAGE_PERMIT","해당 페이지를 이용할 권한이 없습니다. 관리자에게 권한을 요청 하십시오.");
define("ERR_NO_MAIL_NUMBER","메일 번호가 없습니다.");
?>
