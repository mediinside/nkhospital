<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
include $GP -> INC_PATH .'/zmSpamFree/zmSpamFree.php';

if(!strstr($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME'])) {
	$C_Func->put_msg_and_back("비정상적인 접근입니다.");
	die;
}

//쓰기권한
if($check_level < $db_config_data['jba_write_level']) {
	$C_Func->put_msg_and_back("해당게시판의 쓰기권한이 없습니다.");
	die;
}

//등록관련 정보 확인
if(!$jb_code || !$jb_title || !$jb_name || !$jb_content) {
	$C_Func->put_msg_and_back("등록관련정보가 부족합니다. 등록정보를 확인해 주세요.");
	die;
}
//echo "aa : ". $_POST['zsfCode'];
//exit;
//스팸방지
/*
if ( !zsfCheck( $_POST['zsfCode'] ) ) {
	$C_Func->put_msg_and_back("스팸차단코드가 틀렸습니다.");
	die;	
}*/

//자동등록방지
/*
if(!$check_id) {
	if(!$chkrobot_key) {
		$C_Func->put_msg_and_back("비정상적인 접근입니다.");
		die;
	}

	if(!$chkrobot_key || !$_SESSION['s_chkrobot_key']) {			
		$C_Func->put_msg_and_back("자동등록은 허용되지 않습니다.");
		die;
	}

	//입력값과 세션값을 비교하기 위하여 분리...
	$ex_chkrobot_key = explode("_", $_SESSION['s_chkrobot_key']);
	$ex_chkrobot_key = $ex_chkrobot_key[1];

	//세션값 비교...
	if($ex_chkrobot_key != $chkrobot_key) {
		$C_Func->put_msg_and_back("자동등록은 허용되지 않습니다.");
		die;
	}
	
	//임시세션값 삭제 - 자등등록방지키
	session_unregister("ss_chkrobot_key");
}
*/


//업로드 파일 갯수
$file_cnt = count($_FILES[jb_file][tmp_name]); 

for($i=0; $i<$file_cnt; $i++)
{
	 //파일의 확장자 및, 용량체크 - 허용용량을 초과 할 수 있으므로 DB Insert 보다 우선 처리
	if($_FILES[jb_file][name][$i])
		$C_Func->file_ext_check($_FILES[jb_file][name][$i], $_FILES[jb_file][size][$i],"");
}


//자동줄바꿈 체크
if(!$jb_bruse_check) {
	$jb_bruse_check = 'N';
}

//비밀글 체크
if(!$jb_secret_check) {
	$jb_secret_check = 'N';
}

if($jb_code == "60"){
    $jb_secret_check = 'Y';
}
	
//공지글
if($jb_notice_check == "Y") {
	$jb_order = 50;
} else {
	$jb_order = 100;
}

//자동구문변수처리
$jb_step=0;
$jb_reg_date = date('Y-m-d H:i:s');
$jb_mod_date = date('Y-m-d H:i:s');
$jb_reg_ip=$_SERVER['REMOTE_ADDR'];
$jb_see=0;
$jb_comment_count =0;
$jb_mb_id = $check_id;
$jb_mb_level = $check_level;
$jb_del_flag = 'N';
$jb_title = addslashes($jb_title);
if($jb_code == 120){
$jb_title = strip_tags($jb_title);
}
$jb_webzine = $jb_webzine1."-".$jb_webzine2;


$safe = new HTML_Safe; // xss filter 객체 생성
$safe->setAllowTags(array('object', 'embed', 'iframe')); // 플래시를 위해 object 및 embed 태그 설정
$input = base64_decode($jb_content); 
$output = $safe->parse($input); // html 태그를 필터링 하여 $output에 대입
//$output = iconv("UTF-8", "EUC-KR", $output);
$jb_content = $C_Func->enc_contents($output);
if($jb_code == 120){
	$jb_content = preg_replace("!<script(.*?)<\/script>!is","",$jb_content);

}
//$jb_content = htmlspecialchars($output);
//$jb_content = str_replace("'","&quot;",$jb_content);

//마지막 jb_depth 입력값
$args = "";
$args['jb_code'] = $jb_code;
$rst = $C_JHBoard->Board_Depth_Max($args);

//Depth
if($rst[max_depth] > 0)
	$jb_depth=($rst[max_depth] + 10); //답변 9개
else
	$jb_depth=10;

//Group
$jb_group=($jb_depth / 10);
//frontimage
include_once($GP->CLS."class.fileup.php");
$file_movie_path = $GP -> UP_IMG_SMARTEDITOR ."jb_" . $jb_code . "/"; 
//사진 업로드	
$file_orName			= "jb_m_image";
$is_fileName			= $_FILES[$file_orName]['name'];
$insertFileCheck	= false;
if ($is_fileName) {
	$args_f = "";
	$args_f['forder'] 			= $file_movie_path;
	$args_f['files'] 				= $_FILES[$file_orName];
	$args_f['max_file_size'] 		= 1024 * 307200; 
	$args_f['able_file'] 			= array();

	$C_Fileup = new Fileup($args_f);
	$updata		= $C_Fileup -> fileUpload();

	if ($updata['error']) $insertFileCheck = true;
		$jb_m_image = $updata['new_file_name'];	//변경된 파일명
}
//영상 썸네일 
		$file_orName			= "thumb_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 			= $file_movie_path;
			$args_f['files'] 				= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 1000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$thumb_img = $updata['new_file_name'];	//변경된 파일명
		}
			



//==============================================================================================
# 자동 DB Insert 구문 생성 Start
//==============================================================================================
$keys="";
$values="";
$rst_board = $C_JHBoard->DESC_BOARD_LIST();

for($i=0; $i<count($rst_board); $i++) {
	if($rst_board[$i][Extra]=="auto_increment") continue;
	if($rst_board[$i][Field]=="jb_file_name") continue;
	if($rst_board[$i][Field]=="jb_file_code") continue;
	
	$keys.=$rst_board[$i][Field] . ",";	//자동 Key 생성
	$values.="'" . $$rst_board[$i][Field] . "',"; //자동 Value 생성
}

//끝부분 "," 제거
$keys=rtrim($keys, ",");
$values=rtrim($values, ",");


//리스트테이블에 기본정보 입력
if($keys && $values)
{
	$args = "";
	$args['keys'] = $keys;
	$args['values'] = $values;
	$result_key = $C_JHBoard->BOARD_WRITE($args);		
}
//==================================================================== 자동 DB Insert 구문 생성 End


//리스트 입력이 완료되면 내용을 입력
if($result_key)
{
	//리스트에 입력된 게시물 번호
	$jb_idx = $result_key;
	
	$keys="";
	$values="";
	$rst_detail = $C_JHBoard->DESC_BOARD_DETAIL();
	for($i=0; $i<count($rst_detail); $i++) {
		if($rst_detail[$i][Extra]=="auto_increment") continue;
	
		$keys.=$rst_detail[$i][Field] . ",";	//자동 Key 생성
		$values.="'" . $$rst_detail[$i][Field] . "',"; //자동 Value 생성
	}
	
	//끝부분 "," 제거
	$keys=rtrim($keys, ",");
	$values=rtrim($values, ",");	
	
	//내용 테이블에 기본정보 입력
	if($keys && $values)
	{
		$args = "";
		$args['keys'] = $keys;
		$args['values'] = $values;
		$result_key_detail = $C_JHBoard->BOARD_WRITE_DETAIL($args);		
	}
}


//다중 파일 업로드
$file_save_path = $GP -> UP_IMG_SMARTEDITOR ."jb_" . $jb_code; //저장될 경로...
$real_file_names="";
$new_file_names="";
for($i=0; $i<$file_cnt; $i++) {
	$new_file_name="";
	
	//파일업로드	
	if($_FILES[jb_file][name][$i]) {
		$new_file_name = $C_Func->file_upload($_FILES[jb_file][tmp_name][$i], $_FILES[jb_file][name][$i], $_FILES[jb_file][size][$i], $file_save_path, "");
		
		$real_file_names.=$_FILES[jb_file][name][$i] . "|";
		$new_file_names.=$new_file_name . "|";
	}	
}


$args = "";
//첨부파일
if($real_file_names!="" && $new_file_names!="")
{
	$real_file_names = rtrim($real_file_names, "|");
	$new_file_names = rtrim($new_file_names, "|");
	
	$args['jb_file_name'] = $real_file_names;
	$args['jb_file_code'] = $new_file_names;
}


//에디터
if($img_full_name != "") {
	$Arr_img = explode(',', $img_full_name);	
	$img_name = "";
	for	($i=0; $i<count($Arr_img); $i++) {		
		if(ereg($C_Func->escape_ereg($Arr_img[$i]), $C_Func->escape_ereg($jb_content))) {		
			$img_name .= trim($Arr_img[$i]) . ",";		
		}else{
			@unlink($file_save_path. "/". $Arr_img[$i]);
		}
	}
	$img_name = rtrim($img_name , ",");
	
	$args['jb_img_code'] = $img_name;
}

$args['jb_code'] = $jb_code;
$args['jb_idx'] = $jb_idx;	
$file_update = $C_JHBoard->BOARD_FILE_UPDATE($args);	


//전문의 상담
if($jb_code == '130') {
	
	include_once($GP -> CLS."class.sms.php");
	$C_Sms 	= new Sms;
	

/*	
	$args = "";
	$args['jb_treat'] = $jb_treat;
	$data = $C_JHBoard->Board_Doctor_Mobile($args);		
	
	$dr_mobile = $data['dr_mobile'];
	
	if($dr_mobile != '') {
		$send_mobile = "010-7512-1587,010-3083-3575," . $dr_mobile;
		$send_num = "3";
	}else{
		$send_mobile = "010-7512-1587,010-3083-3575";
		$send_num = "2";
	}

	'send_date' => $send_date,
	'send_time' => '080000',
*/	
	
	if($jb_code == '130') {
		//$send_mobile = "010-3294-4009";
		$send_mobile = "";
		$send_num = "1";
	}
	
	$msg = "고객이 질문글을 등록하였습니다";
	
	$now_day = date('Y-m-d');
	$send_date = $C_Func->request_add_day2($now_day, 1);
	
	//보낼 데이터
	$data = array(
		'type' => 'send',
		'msg' => $msg,    
		'sm_to' => $send_mobile,
		'destination' => '',
		'sm_from1' => $GP -> SMS_HP1,
		'sm_from2' => $GP -> SMS_HP2,
		'sm_from3' => $GP -> SMS_HP3,
		'send_date' => '',
		'send_time' => '',
		'returnurl' => '',
		'testflag' => 'N',			//Y:실방송 N:테스트발송
		'repeatFlag' => '',
		'repeatNum' => '1',
		'repeatTime' => '15',			
		'send_num' => $send_num,
		'return_type' => 'json',			
		'login_id' => $GP -> SMS_ID,			
		'login_pwd' => $GP -> SMS_PWD	
	);	
	$result = $C_Func->post_request('http://mediinside.co.kr/api/sms_api.php', $data); 		
}



//페이지 이동 관련 변수 설정
$get_par = "${index_page}?jb_code=${jb_code}";

$C_Func->put_msg_and_go("등록되었습니다.", "${get_par}");

?>