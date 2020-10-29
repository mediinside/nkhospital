<?php

// 자주 사용하는 값
// 서버의 시간과 실제 사용하는 시간이 틀린 경우 수정하세요.
// 하루는 86400 초입니다. 1시간은 3600초
// 6시간이 빠른 경우 time() + (3600 * 6);
// 6시간이 느린 경우 time() - (3600 * 6);

$cf['server_time'] = time();
$cf['ymd']    = date("Y-m-d", $cf['server_time']);
$cf['his']    = date("H:i:s", $cf['server_time']);
$cf['ymdhis'] = date("Y-m-d H:i:s", $cf['server_time']);
$show = time();

// --------------------------------------------------------------------------

$key_value_se = "mediinside";

$now_url = urlencode($PHP_SELF."?".$QUERY_STRING);

function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

function alert_back($msg, $back=0)
{
	if ( !$back )
	{
		echo "<script type='text/javascript'>alert('$msg');history.back();</script>";
	}
	else
	{
		echo "<script type='text/javascript'>alert('$msg');history.go($back);</script>";
	}
	exit();
}

function alert_replace($msg, $url, $mode='')
{
	if ( $mode == 'top' )
	{
		$method = 'top.location.replace';
	}
	else
	{
		$method = 'location.replace';
	}

	if ( $msg )
	{
			echo "<script type='text/javascript'>alert('$msg');$method('$url');</script>";
	}
	else
	{
			echo "<script type='text/javascript'>$method('$url');</script>";
	}
	exit();

}

function alert_exit($msg)
{
  echo "<script type='text/javascript'>alert('$msg')</script>";
  exit();
}

function salert($msg)
{
  echo "<script type='text/javascript'>alert('$msg')</script>";
}

function alert_close($msg)
{
  echo "<script type='text/javascript'>alert('$msg');self.close();</script>";
  exit();
}

// 경고메세지를 경고창으로
function alert($msg='', $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html;\">";
	echo "<script language='javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        // 4.06.00 : 불여우의 경우 아래의 코드를 제대로 인식하지 못함
        //echo "<meta http-equiv='refresh' content='0;url=$url'>";
        goto_url($url);
    exit;
}

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
    $str = "";
    if ($cur_page > 1) {
        $str .= "<a href='" . $url . "1{$add}'>처음</a>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " &nbsp;<a href='" . $url . ($start_page-1) . "{$add}'>이전</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " &nbsp;<a href='$url$k{$add}'><span>$k</span></a>";
            else
                $str .= " &nbsp;<b>$k</b> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='" . $url . ($end_page+1) . "{$add}'>다음</a>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= " &nbsp;<a href='$url$total_page{$add}'>맨끝</a>";
    }
    $str .= "";

    return $str;
}


function conv_subject($subject, $len, $suffix="")
{
    return cut_str(get_text($subject), $len, $suffix);
}


function cut_str($str, $len, $suffix="…")
{
    global $g4;

    $s = substr($str, 0, $len);
    $cnt = 0;
    for ($i=0; $i<strlen($s); $i++)
        if (ord($s[$i]) > 127)
            $cnt++;
    if (strtoupper($g4['charset']) == 'UTF-8')
        $s = substr($s, 0, $len - ($cnt % 3));
    else
        $s = substr($s, 0, $len - ($cnt % 2));
    if (strlen($s) >= strlen($str))
        $suffix = "";
    return $s . $suffix;
}

// TEXT 형식으로 변환
function get_text($str, $html=0)
{
    /* 3.22 막음 (HTML 체크 줄바꿈시 출력 오류때문)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */

    // 3.31
    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
				$source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}


function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}

function loginService($URL) {
	if(!$_SESSION["MEMBER_NO"]) {
		alert("로그인을 하신후 이용하세요.","$URL");
	}  
}

### JS 에서 입력값을 제어했지만 Null 값이 넘어오는거 방지
function arrNullCheck($arrNullCheck) {
	foreach ($arrNullCheck as $key=>$val) {
		if (!$val) {
			alert("입력받아 저장하던중 Null 값이 발생하였습니다.\n다시 확인하세요.");
		}
	}
	// [사용법] $arrNullCheck = array("123","","555");
}  

function jumin_sex_chk($jumin) {
	if ($jumin%2==0) {
		$sex = "F"; // 여자
	} else {
		$sex = "M"; // 남자
	}
	return $sex;
}

// 가운대 글자만 모두 치환하기 d****d
// $name_cut = "d홍길동d"; name_cut($name_cut,"*")
function name_cut($str,$suffix) { 

	preg_match_all( "/[\x80-\xff].|./i", $str, $matches ); 

	$h = array_shift( $matches[0] ); 
	$f = array_pop( $matches[0] ); 
	$b = str_repeat($suffix,  count( $matches[0] ) ); 
	return $h . $b . $f; 
} 

function name_cut2($str,$suffix) { 

	preg_match_all( "/[\x80-\xff].|./i", $str, $matches ); 

	$h = array_shift( $matches[0] ); 
	$h2 = array_shift( $matches[0] ); 
	$h3 = array_shift( $matches[0] ); 
	$b = str_repeat($suffix,  count( $matches[0] ) ); 
	return $h .$h2.$h3 . $b; 
} 


	//소켓통신 포스트
function post_request($url, $data='', $referer='') 
	{ 	
		$host_info = explode("/", $url);
    $host = $host_info[2];
    $path = $host_info[3]."/".$host_info[4];
		
		srand((double)microtime()*1000000);
		$boundary = "---------------------".substr(md5(rand(0,32000)),0,10);

		// 헤더 생성
		$header = "POST /".$path ." HTTP/1.0\r\n";
		$header .= "Host: ".$host."\r\n";
		$header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

		// 본문 생성
		foreach($data AS $index => $value){
				$send_data .="--$boundary\r\n";
				$send_data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
				$send_data .= "\r\n".$value."\r\n";
				$send_data .="--$boundary\r\n";
		}
		$header .= "Content-length: " . strlen($send_data) . "\r\n\r\n";
		
		$fp = fsockopen($host, 80);

    if ($fp) { 
        fputs($fp, $header.$send_data);
        $rsp = '';
        while(!feof($fp)) { 
            $rsp .= fgets($fp,8192); 
        }
        fclose($fp);
        $result = explode("\r\n\r\n",trim($rsp));
				
				$header = ''; 
				if(isset($result[0])) { 
					$header = $result[0]; 
				} 
				$content = ''; 
				if(isset($result[1])) { 
					$content = $result[1]; 
				} 
				
				// return as structured array: 
				return array( 
					'status' => 'ok', 
					'header' => $header, 
					'content' => $content 
				);  
    }
    else {
        return array( 
					'status' => 'err', 
					'error' => "$errstr ($errno)" 
				); 
    }
} 
?>