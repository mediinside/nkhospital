<?
	include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();
	
	$gubun = $_POST["gubun"];
	switch($gubun) {
		case "id"; //전문센터		
				$args = array();
				$args['mb_name'] = $_POST['name'];
				$args['mb_email'] = $_POST['email'];
				$rst = $C_Member->Find_ID_Check($args);
				if($rst) {
					echo "요청하신 아이디는 [<b>".$rst['mb_id']."</b>] 입니다.";	
				}else{
					echo "일치하는 정보가 없습니다.";	
				}				
				
		break;
		case "pw"; //진료과		
				$args = array();
				$args['mb_id'] = $_POST['id'];
				$args['mb_email'] = $_POST['email'];
				$rst = $C_Member->membersFindInfoNew($args);
				
				if(!$rst['mb_code']){
					echo "존재하지 않는 아이디 입니다.";
					exit;
				}
				//sender_email, sender_name, receive_email, receive_name, email_subject , contents
				$args = '';
				$args['sender_email'] = $GP -> Admin_Email;
				$args['sender_name'] = $GP -> Admin_HP_NAME;
				$args['receive_email'] = $rst['mb_email'];
				$args['receive_name'] = $rst['mb_name'];
				$args['email_subject'] = '고객님께서 요청하신 정보입니다.';
				$args['new_pw'] = $rst['new_pw'];
				$send_rst = $C_Member->sendMail($args);	
				
				echo $rst['mb_email'] ."로 임시비밀번호를 발급하였습니다";
				exit;
		break;
	}
	
?>