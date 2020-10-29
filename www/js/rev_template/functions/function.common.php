<?
//if(!defined("IN_AUTH")){
    
//    die("Not Excution");
//}

function currency($int)
{
	if($int)
	{
		$len = strlen($int);
		$pt = $len - 1;
		$str = "";
		for($i = 0; $i < $len ; $i++)
		{
		   $str = substr($int,$pt,1).($i%3==0&&$i>1?",":"").$str;
		   $pt--;
		}
		return $str;
	}
	else
	{
		return 0;
	}
}

function cut_string($str,$len)
{
    if ($len >= strlen($str)) return $str;
    $klen = $len - 1;
    while(ord($str[$klen]) & 0x80) $klen--;
    return substr($str,0,$len - (($len + $klen + 1) % 2))."..";
}

function zerofill($int,$len)
{
    $str = $int;
    for($i = 1;$i <= ($len - strlen($int));$i++)
    {
        $str = "0".$str;
    }
    return $str;
}

function get_minimum_int($int)
{
    $length = strlen($int) - 1;
    return substr($int,0,1) * pow(10,$length);
}


 // 해당년,월의 날수 return
function getWeekDays($year, $month, $week_no) 
{ 
// 입력받은 년과 달로서 해당월의 첫째날짜의 unix timestamp값을 구한다. 
// == 첫째주 
$utime = mktime(0, 0, 0, $month, 1, $year); 

$getSunday = "last Sunday"; 
$getSaturday = "this Saturday"; 

if ($week_no > 1) 
{ 
$getSunday .= " +" . ($week_no - 1). " week"; 
$getSaturday .= " +" . ($week_no - 1) . " week"; 
} 

$sun=strtotime($getSunday, $utime); 
$sat=strtotime($getSaturday, $utime); 

return array('sun'	=>  $sun,'sat'	=> $sat);
} 

//function date_diff($sdate,$edate)
//{
//	$_sdate = explode("-",$sdate);
//	$_edate = explode("-",$edate);	
//	$tmp1 = mktime(0, 0, 0, $_sdate[1],$_sdate[2],$_sdate[0]);
//	$tmp2 = mktime(0, 0, 0, $_edate[1],$_edate[2],$_edate[0]);	
//	return($tmp2-$tmp1) / 86400 + 1;
//}

// 해당월의 마지막 일자 구함
function getLastDay($year, $month)
{
	$end_day = date("t", mktime(0, 0, 0,$month,1,$year));	
	return $end_day+1;
}

//네이버 지도
function get_navermap_coods($p_str_addr="") 
    { 
    $int_x = 0; 
    $int_y = 0; 
    
    $str_addr = str_replace(" ", "", $p_str_addr); 
    
    // curl 이용해서 지도에 필요한 좌표를 취득 
    $dest_url    = "http://openapi.map.naver.com/api/geocode.php?key=" . NAVER_MAP_KEY . "&encoding=utf-8&coord=LatLng&query=" . urlencode($str_addr); 
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $dest_url); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $str_result = curl_exec($ch); 
    curl_close($ch); 
    
    $obj_xml = simplexml_load_string($str_result); 
    
    $int_x = $obj_xml->item->point->x; 
    $int_y = $obj_xml->item->point->y; 
    
    return array($int_x, $int_y); 
}

//길이만큼 random 문자열 생성
function GenerateString($length)  
    {  
        $characters  = "0123456789";  
        $characters .= "abcdefghijklmnopqrstuvwxyz";  
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
        $string_generated = "";  
        $nmr_loops = $length;  
        while ($nmr_loops--)  
        {  
           $string_generated .= $characters[mt_rand(0, strlen($characters))];  
        }  
        return $string_generated;  
    } 
	
// 원본 이미지 -> 썸네일로 만드는 함수
function thumbnail($file, $save_filename, $max_width, $max_height)
{
        $src_img = ImageCreateFromJPEG($file); //JPG파일로부터 이미지를 읽어옵니다
 
        $img_info = getImageSize($file);//원본이미지의 정보를 얻어옵니다
        $img_width = $img_info[0];
        $img_height = $img_info[1];
 
        if(($img_width/$max_width) == ($img_height/$max_height))
        {//원본과 썸네일의 가로세로비율이 같은경우
            $dst_width=$max_width;
            $dst_height=$max_height;
        }
 
        elseif(($img_width/$max_width) < ($img_height/$max_height))
        {//세로에 기준을 둔경우
            $dst_width=$max_height*($img_width/$img_height);
            $dst_height=$max_height;
        }
 
        else
        {//가로에 기준을 둔경우
            $dst_width=$max_width;
            $dst_height=$max_width*($img_height/$img_width);
        }
 
 
        $dst_img = imagecreatetruecolor($dst_width, $dst_height); //타겟이미지를 생성합니다
   
        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다
   
        ImageInterlace($dst_img);
        ImageJPEG($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
        ImageDestroy($dst_img);
        ImageDestroy($src_img);
}	

function makeSelect()
{
	$args = @func_get_args ();
	$paraArr = array(
				'selectName'
				,'selArr'
				,'vals'
				,'etc'
				,'basic'
				,'desc'
				);
	$argsCnt = count($args);
	for($i = 0; $i < $argsCnt ; $i++) ${$paraArr[$i]} = $args[$i];

	$str = "<select name='$selectName' id='$selectName' $etc>";
	if($basic)
	{
		$str .= "<option value=''>$basic</option>";
	}

	if(count($selArr) && is_array($selArr))
	{
		if($desc==false) asort($selArr);
		foreach ($selArr as $key => $value)
		{
			$selValue = "";
			$selName = "";
			$selValue = $key;
			$selName = ($value)? $value : $key;

			$selected = "";
			if($vals != '' && $vals == $selValue) $selected = "selected";
			$str .= "<option value='$selValue' $selected>$selName</option>";
		}
	}
	$str .= "</select>";

	return $str;
}

//파일 업로드( 확장자 체크 )
function file_ext_check($user_file_name, $user_file_size)
{
	$file_ext = substr( strrchr($user_file_name, "."),1); 
	$file_ext = strtolower($file_ext);	//확장자를 소문자로...
	
	//확장자 체크
	if ($file_ext=="html" || $file_ext == "htm" || $file_ext=="php3" || $file_ext=="php" || $file_ext=="phtml" || $file_ext=="cgi" || $file_ext=="exe")
	{
		$this->put_msg_and_back('해당 파일은 보안 관계로 올릴 수 없습니다.');
		die;
	}	

	//업로드 허용용량체크 - MIN
	if ($user_file_size <= 1)
	{
		$this->put_msg_and_back('비정상적인 파일입니다.');
		die;
	}
	
	//업로드 허용용량체크 - MAX
	if ($user_file_size >= 5242880) {
		$this->put_msg_and_back("업로드 허용용량 초과!!");
		die;
	}
	
	return true;
}

//파일업로드("", "", "", 저장경로, 저장후 파일명, 저장전 파일명)
function file_upload($f_tmp_name, $f_name, $f_size, $save_path, $old_file_name="")
{
	echo "====".$f_tmp_name."//".$f_name."//".$f_size."//".$save_path;
	//확장자 구분
	$file_ext = substr( strrchr($f_name, "."),1); 
	$file_ext = strtolower($file_ext);	//확장자를 소문자로...
	
	
	//파일명 새로 지정
	$file_name_md5=md5($f_name);	
	$rand_key= rand_make();
	$file_name_md5=substr($file_name_md5, 5, 10);
	$file_name_md5=$file_name_md5 . $rand_key;
	$new_file_name=$file_name_md5 . "." . $file_ext;
	
	echo  "=============${save_path}/${new_file_name}";
	
	//이전파일 삭제
	if($old_file_name)
		@unlink("${save_path}/${old_file_name}");
	
	//이미지업로드
	$chk=@copy($f_tmp_name, "${save_path}/${new_file_name}");
		
	//이미업로드가 정상적으로 이루어 졌을 경우에만 썸네일 이미지 생성
	if(!$chk)
	{
		$new_file_name="";
	}
	else
	{	
		//gif, jpg, png의 경우 썸네일이미지생성
		if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png")
		{
			//이전 썸네일 이미지명 삭제
			if($old_file_name)
				$old_img_name="s_" . $old_file_name;
		
			//썸네일 이미지명 지정 
			$save_img_name="s_" . $file_name_md5 . $ex_tm . "." . $file_ext;

			//썸네일 이미지 생성
			image_create_upload($f_tmp_name, $f_name, $f_size, $save_path, $save_img_name, $old_img_name, 130, 130);
		}
	} //end_of_if(!$chk)


	//임시파일 삭제
	@unlink($f_tmp_name);
	
	return $new_file_name;
	
}//fuction image_upload


//이미지 최적화후 업로드(파일명, 확장자, 이미지사이즈가 지정된형식이나 사이즈로 변경된후 저장...)
function image_create_upload($img_tmp_name, $img_name, $img_size, $save_path, $save_img_name, $old_img_name="", $img_width, $img_height)
{		
	//이전파일 삭제
	if($old_img_name)
		@unlink("$save_path/$old_img_name");
		
	
	//파일의 확장자
	$file_ext = substr( strrchr($img_name, "."),1); 
	$file_ext = strtolower($file_ext);	//확장자를 소문자로...
	
			
	#
	# 이하 썸네일
	#
	
	//비율에 맞게 이미지 조정...
	$sz = @getimagesize($img_tmp_name);
	if($sz[0]  > $img_width || $sz[1] > $img_height)
	{        
		if($sz[0]>$sz[1]) $per=$img_width/$sz[0]; 
		else $per=$img_height/$sz[1];
		$width=ceil($sz[0]*$per); 
		$height=ceil($sz[1]*$per); 
	}
	else
	{
		$width=ceil($sz[0]);//width 값 
		$height=ceil($sz[1]);//height 값 
	}				
			
	//파일의 확장자에 따른 썸네일 생성
	switch($file_ext)
	{
		case "jpg" :
			$image = ImageCreateFromJPEG($img_tmp_name); 
			$thumb_image = ImageCreateTrueColor($width,$height); 
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image)); 
			$thumbneil = $save_path."/".$save_img_name;
			ImageJPEG($thumb_image,$thumbneil,100);
			break;
			
		case "gif" :
			$image = ImageCreateFromGIF($img_tmp_name); 
			$thumb_image = ImageCreateTrueColor($width,$height); 
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image)); 
			$thumbneil = $save_path."/".$save_img_name;
			ImageJPEG($thumb_image,$thumbneil,100); 
			break;
			
		case "png" :
			$image = ImageCreateFromPNG($img_tmp_name); 
			$thumb_image = ImageCreateTrueColor($width,$height); 
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image)); 
			$thumbneil = $save_path."/".$save_img_name;
			ImageJPEG($thumb_image,$thumbneil,100); 
			break;
			
		default : break;
	}
				
	return true;
}//fuction fileupload

// 글 인코딩 하기
function enc_contents ($contents) {
	$result = htmlspecialchars(addslashes($contents));

	return $result;
}

// 글 디코딩 하기
function dec_contents ($contents) {
	$result = stripslashes($contents);

	return $result;
}

function escape_ereg($str) 
{ 
	$str=eregi_replace("(\*|\(|\)|\+|\?|\\|\/|\"|\'|\[|\]|\^|\+)","",$str); 
	return $str; 
}

// 자동등록방지용 난수생성함수
function rand_make()
{
	srand((double)microtime()*1000000);
	$f_rand=rand();

	srand((double)microtime()*1000000);
	$s_rand=rand();

	$rand_key = $f_rand + $s_rand;
	$rand_key = substr($rand_key,0,5);
	
	return $rand_key;
}

// 에디터용 글 디코딩 하기
function dec_contents_edit ($contents) {
	$result = html_entity_decode(stripslashes($contents));

	return $result;
}

function strcut_utf8($str, $len, $checkmb=false, $tail='') {
	preg_match_all('/[\xE0-\xFF][\x80-\xFF]{2}|./', $str, $match); // target for BMP

	$m = $match[0];
	$slen = strlen($str); 
	$tlen = strlen($tail); 
	$mlen = count($m); 

	if ($slen <= $len) return $str;
	if (!$checkmb && $mlen <= $len) return $str;

	$ret = array();
	$count = 0;
	for ($i=0; $i < $len; $i++) {
		$count += ($checkmb && strlen($m[$i]) > 1)?2:1;
		if ($count + $tlen > $len) break;
		$ret[] = $m[$i];
	}

	return join('', $ret).$tail;
}

// 제목의 HTML 방지, 역슬래쉬 제거(제목, 문자열 길이제한)
function replace_string($str, $len="", $tail="")
{
	$str=htmlspecialchars($str);
	
	if($len)
		$str= $this->strcut_utf8($str, $len, $tail);
					
	return $str;				
}

function request_add_day($start_date, $add_day)
{
	$date = date("Y-m-d", strtotime($start_date."+". $add_day." days"));
	return $date;
}

//숫자를 요일로 변경
function DayWeekChange($date)
{
	$num = strftime("%w",strtotime(str_replace('-','',$date))); // 0:일 1:월	
	$M = "";
	switch ($num) 
	{ 
	  case ("0") : $M = "일"; break; 
	  case ("1") : $M = "월"; break; 
	  case ("2") : $M = "화"; break; 
	  case ("3") : $M = "수"; break; 
	  case ("4") : $M = "목"; break; 
	  case ("5") : $M = "금"; break; 
	  case ("6") : $M = "토"; break; 
	  default : 
	} 
	
	return $M;
}	
?>
