<?
include './class.socket.php';

##Ŭ���� ȣ��
$smsObj	= new smsSocket();


// �̿��� ���� �Է�
$PACKETDATA['id']	= "missen";
$PACKETDATA['pw']	= "9000djr";
$PACKETDATA['msg']	= "����";
$PACKETDATA['to']   = "";//-��ȣ���� ��ȭ��ȣ�� , 1���̻��϶� ^ (��)01000001111^01012340004^01012111111
$PACKETDATA['from']	= "";//-��ȣ���� ��ȭ��ȣ�� 
$PACKETDATA['indexkey']	= "ȸ������"; 
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

switch ($RESINFO['RESULT'])	// $RESINFO['RESULT'] (�߼� ���)
{
	case '1' :
		/****** RECEIVE DATA
		$RESINFO['TOTALCNT'] :		// �� �߼۰��ɰǼ�.
		$RESINFO['SENDTOTALCNT']:	// �� ��û�Ǽ�.
		$RESINFO['SENDCNT']	:		// �߼� ��� �����Ǽ�(�ߺ�����, �߸��� ��ȣ ����).
		$RESINFO['INDEXKEY'] :		// ����� Ű��
		******/
	break;

	// ����� ���̵� ��й�ȣ�� �߸��Ǿ��� ��� �� �α��� ����
	case '2' :
	break;

	// ����Ʈ ���� ���� �߼۽���
	case '3' :
	break;

}
?>