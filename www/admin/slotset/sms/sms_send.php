<?
include './class.socket.php';

##클레스 호출
$smsObj	= new smsSocket();


// 이용자 정보 입력
$PACKETDATA['id']	= "missen";
$PACKETDATA['pw']	= "9000djr";
$PACKETDATA['msg']	= "내용";
$PACKETDATA['to']   = "";//-기호없이 전화번호만 , 1명이상일때 ^ (예)01000001111^01012340004^01012111111
$PACKETDATA['from']	= "";//-기호없이 전화번호만 
$PACKETDATA['indexkey']	= "회원가입"; 
# socket connect and sending packet data

if ($smsObj->socketOpen())
{
	$smsObj->getPaket($PACKETDATA);
	$smsObj->socketPutData();
	$RESINFO = $smsObj->socketReade();
	$smsObj->disConnect();
}

##result receive
echo "<PRE>";
print_R($RESINFO);
echo "</PRE>";

switch ($RESINFO['RESULT'])	// $RESINFO['RESULT'] (발송 결과)
{
	case '1' :
		/****** RECEIVE DATA
		$RESINFO['TOTALCNT'] :		// 총 발송가능건수.
		$RESINFO['SENDTOTALCNT']:	// 총 신청건수.
		$RESINFO['SENDCNT']	:		// 발송 등록 성공건수(중복제거, 잘못된 번호 제거).
		$RESINFO['INDEXKEY'] :		// 사용자 키값
		******/
	break;

	// 사용자 아이디나 비밀번호가 잘못되었을 경우 및 로그인 오류
	case '2' :
	break;

	// 포인트 부족 오류 발송실패
	case '3' :
	break;

}
?>