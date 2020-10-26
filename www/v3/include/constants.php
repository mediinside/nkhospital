<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}
//api key setting
define("KAKAO_KEY","e0c73e1ceb6a6b38df5c9422c463ae5d");
define("KOLLUS_ACCESS_TOKEN","rmfqo16ppfjttbsd");
define("KOLLUS_CHANEL_KEY","9w4xv241");
// youtube api
define("YOUTUBE_KEY","AIzaSyAsXqP218sJgl8XigtAjokUKqgH2pTaSHQ");
define("YOUTUBE_API_URL","https://www.googleapis.com/youtube/v3/videos?key=".YOUTUBE_KEY."&part=snippet,contentDetails,statistics&id=");


//TABLE NAME
define("MEMBER_TABLE","RFAdmin");
define("AUDIENCE_TABLE","RFAudience");
define("AUDIENCE_TEMP_TABLE","RFAudienceTemp");
define("HOSPITAL_TABLE","RFHospital");
define("GROUP_TABLE","RFGroupCode");
define("TREAT_TABLE","RFTreatCode");
define("VIDEO_TABLE","RFVideo");
define("VIDEO_SUBTITLE","RFSubtitle");
define("VIDEO_LOG_TABLE","RFVideoLog");
define("QNA_TABLE","RFQna");
define("RESERVED_TABLE","RFReserved");
define("SMS_LOG","RFSmsLog");

// define("VIDEO_URL","http://r5kr.com/controller/admin/vodplayer.php?v=");
define("VIDEO_URL","http://r5kr.com/r5/watch.php?v=");


//에러코드
define("MEMBER_IS_NOT_FOUND",100);
define("ERR_NO_PAGE_PERMIT","해당 페이지를 이용할 권한이 없습니다. 관리자에게 권한을 요청 하십시오.");
define("ERR_NO_MAIL_NUMBER","메일 번호가 없습니다.");


//api url

define("SMS_ID",'medisms');
define("SMS_AUTH_KEY",'55105d1ea13afab6809b633dbd471245');

define("SMS_NEW_ID",'r5korea');
define("SMS_NEW_AUTH_KEY",'g6lxpwk4sdlt7hs65lbemod73ckb5z0q');

define('BOT_TOKEN', '748713785:AAGEyo6cOOSjkC_85lepbEasnR7cvHu0ak0');
define('BOT_CHAT_ID', '297371786');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
?>
