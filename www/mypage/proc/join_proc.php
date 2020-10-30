<?php
	include_once  '../../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();
	
	$refer = $_SERVER['HTTP_REFERER'];
	$server = "https://" .$_SERVER['HTTP_HOST'];	

	if(!ereg($GP -> HTTPS, $server)){
		$C_Func->put_msg_and_go("올바른 경로로 접근 바랍니다", $GP -> SERVICE_DOMAIN."/");
		exit();
	}
	
	
	switch($_POST['mode']){
		
		case "MEM_REG" :			
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;					
			
			$args = "";
			$args['mb_id'] = $mb_id;
			$args['mb_email'] = $mb_email1 . "@" . $mb_email2;
			$args['mb_password'] = md5($mb_pwd);			
			$args['mb_name'] = $mb_name;
			$args['mb_nick'] = $mb_nick;
			$args['mb_mobile'] = $mb_mobile1 ."-". $mb_mobile2 ."-". $mb_mobile3;
			$args['mb_sex'] = $mb_sex;
			$args['mb_birthday'] = $mb_birth;
			$args['mb_sms'] = $mb_sms;
			$args['mb_zip_code'] = $mb_post1 . "-" . $mb_post2;
			$args['mb_address1'] = $mb_addr1;
			$args['mb_address2'] = $mb_addr2;
			$args['mb_load_address1'] = $mb_load_addr1;
			$args['mb_load_address2'] = $mb_load_addr2;
			
			$rst = $C_Member->Mem_Join($args);	
?>
			<!-- This script is for AceCounter START -->
			<script language='javascript'>
			var _jn = 'join' ;          //  가입탈퇴 ( 'join','withdraw' ) 
			var _jid = '<?=$mb_id?>' ;			// 가입시입력한 ID
			</script>
			<!-- AceCounter END -->

			<!-- AceCounter Log Gathering Script V.7.5.2013010701 -->
			<script language='javascript'>
				var _AceGID=(function(){var Inf=['gtp7.acecounter.com','8080','AH5A40020363866','AW','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;var _T=new Image(0,0);if(_CI.join('.').indexOf(Inf[3])<0){ _T.src =( location.protocol=="https:"?"https://"+Inf[0]:"http://"+Inf[0]+":"+Inf[1]) +'/?cookie'; _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
				var _AceCounter=(function(){var G=_AceGID;if(G.o!=0){var _A=G.val[G.o-1];var _G=( _A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];	var _U=( _A[5]).replace(/\,/g,'_');var _S=((['<scr','ipt','type="text/javascr','ipt"></scr','ipt>']).join('')).replace('tt','t src="'+location.protocol+ '//cr.acecounter.com/Web/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[4]+'&gd='+_G+'&gp='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime())+'" t');document.writeln(_S); return _S;} })();
			</script>
			<noscript><img src='http://gtp7.acecounter.com:8080/?uid=AH5A40020363866&je=n&' border='0' width='0' height='0' alt=''></noscript>	
			<!-- AceCounter Log Gathering Script End --> 
<?
			if ($rst) {
				$C_Func->put_msg_and_go ("회원가입이 완료되었습니다", $GP -> SERVICE_DOMAIN . "/mypage/login.html");
			}else{
				$C_Func->put_msg_and_back("회원가입이 실패하였습니다.\n오류가 발생하였습니다.");
			}
		break;
		
		case "MEM_MODIFY":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;

			$args = "";
			$args['mb_code'] 					= $mb_code;
			$args['mb_nick'] 					= $mb_nick;
			$args['mb_name'] 					= $mb_name;		
			$args['mb_email'] 				= $mb_email1 . "@" .$mb_email2;		
			$args['mb_birthday'] 			= $mb_birth;
			$args['mb_address1'] 			= $mb_addr1;
			$args['mb_address2'] 			= $mb_addr2;
			$args['mb_load_address1'] = $mb_load_addr1;
			$args['mb_load_address2'] = $mb_load_addr2;
			$args['mb_sex'] 					= $mb_sex;
			$args['mb_zip_code'] 			= $mb_post1 . "-". $mb_post2;
			$args['mb_mobile'] 				= $mb_mobile1 . "-". $mb_mobile2 . "-". $mb_mobile3;
			$rst = $C_Member -> Mem_Info_Modify($args);
			
			$C_Func -> put_msg_and_go('회원정보가 수정 되었습니다.', $GP -> SERVICE_DOMAIN . '/mypage/mypage.html');
			exit();
		break;
		
		case "MEM_PASS_CH" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";
			$args['mb_code'] 	 = $mb_code;
			$args['mb_password'] = md5(trim($mb_pwd_ch));			
			$rst = $C_Member -> Mem_Pass_Modify($args);
			
			$C_Func -> put_msg_and_go('비밀번호가 변경 되었습니다.', $GP -> SERVICE_DOMAIN .'/mypage/passch.html');			
			exit();
		break;
		
		case "MEM_WITH" :		
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = "";
			$args['mb_code'] 				= $mb_code;
			$args['mb_withdrawal'] 			= $reason;
			$args['mb_withdrawal_reason'] 	= $proposal;
			$rst = $C_Member -> Mem_Withdrawal($args);
?>
			<!-- This script is for AceCounter START -->
			<script language='javascript'>
			var _jn = 'withdraw' ;          //  가입탈퇴 ( 'join','withdraw' ) 
			</script>
			<!-- AceCounter END -->

			<!-- AceCounter Log Gathering Script V.7.5.2013010701 -->
			<script language='javascript'>
				var _AceGID=(function(){var Inf=['gtp7.acecounter.com','8080','AH5A40020363866','AW','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;var _T=new Image(0,0);if(_CI.join('.').indexOf(Inf[3])<0){ _T.src =( location.protocol=="https:"?"https://"+Inf[0]:"http://"+Inf[0]+":"+Inf[1]) +'/?cookie'; _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
				var _AceCounter=(function(){var G=_AceGID;if(G.o!=0){var _A=G.val[G.o-1];var _G=( _A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];	var _U=( _A[5]).replace(/\,/g,'_');var _S=((['<scr','ipt','type="text/javascr','ipt"></scr','ipt>']).join('')).replace('tt','t src="'+location.protocol+ '//cr.acecounter.com/Web/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[4]+'&gd='+_G+'&gp='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime())+'" t');document.writeln(_S); return _S;} })();
			</script>
			<noscript><img src='http://gtp7.acecounter.com:8080/?uid=AH5A40020363866&je=n&' border='0' width='0' height='0' alt=''></noscript>	
			<!-- AceCounter Log Gathering Script End --> 
<?
			session_destroy();			
			$C_Func -> put_msg_and_go('탈퇴되었습니다. 그동안 이용해주셔서 감사합니다.', $GP -> SERVICE_DOMAIN . '/');			
			exit();						
		break;
	}
?>