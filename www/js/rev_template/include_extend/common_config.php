<?php

// ���� ����ϴ� ��
// ������ �ð��� ���� ����ϴ� �ð��� Ʋ�� ��� �����ϼ���.
// �Ϸ�� 86400 ���Դϴ�. 1�ð��� 3600��
// 6�ð��� ���� ��� time() + (3600 * 6);
// 6�ð��� ���� ��� time() - (3600 * 6);

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

// ���޼����� ���â����
function alert($msg='', $url='')
{
    if (!$msg) $msg = '�ùٸ� ������� �̿��� �ֽʽÿ�.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html;\">";
	echo "<script language='javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        // 4.06.00 : �ҿ����� ��� �Ʒ��� �ڵ带 ����� �ν����� ����
        //echo "<meta http-equiv='refresh' content='0;url=$url'>";
        goto_url($url);
    exit;
}

// ����������, ����������, ���������� ������ ��, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
    $str = "";
    if ($cur_page > 1) {
        $str .= "<a href='" . $url . "1{$add}'>ó��</a>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>����</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " &nbsp;<a href='" . $url . ($start_page-1) . "{$add}'>����</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " &nbsp;<a href='$url$k{$add}'><span>$k</span></a>";
            else
                $str .= " &nbsp;<b>$k</b> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='" . $url . ($end_page+1) . "{$add}'>����</a>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>����</a>]";
        $str .= " &nbsp;<a href='$url$total_page{$add}'>�ǳ�</a>";
    }
    $str .= "";

    return $str;
}


function conv_subject($subject, $len, $suffix="")
{
    return cut_str(get_text($subject), $len, $suffix);
}


function cut_str($str, $len, $suffix="��")
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

// TEXT �������� ��ȯ
function get_text($str, $html=0)
{
    /* 3.22 ���� (HTML üũ �ٹٲ޽� ��� ��������)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */

    // 3.31
    // TEXT ����� ��� &amp; &nbsp; ���� �ڵ带 �������� ����� �ֱ� ����
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
		alert("�α����� �Ͻ��� �̿��ϼ���.","$URL");
	}  
}

### JS ���� �Է°��� ���������� Null ���� �Ѿ���°� ����
function arrNullCheck($arrNullCheck) {
	foreach ($arrNullCheck as $key=>$val) {
		if (!$val) {
			alert("�Է¹޾� �����ϴ��� Null ���� �߻��Ͽ����ϴ�.\n�ٽ� Ȯ���ϼ���.");
		}
	}
	// [����] $arrNullCheck = array("123","","555");
}  

function jumin_sex_chk($jumin) {
	if ($jumin%2==0) {
		$sex = "F"; // ����
	} else {
		$sex = "M"; // ����
	}
	return $sex;
}

// ����� ���ڸ� ��� ġȯ�ϱ� d****d
// $name_cut = "dȫ�浿d"; name_cut($name_cut,"*")
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


	//������� ����Ʈ
function post_request($url, $data='', $referer='') 
	{ 	
		$host_info = explode("/", $url);
    $host = $host_info[2];
    $path = $host_info[3]."/".$host_info[4];
		
		srand((double)microtime()*1000000);
		$boundary = "---------------------".substr(md5(rand(0,32000)),0,10);

		// ��� ����
		$header = "POST /".$path ." HTTP/1.0\r\n";
		$header .= "Host: ".$host."\r\n";
		$header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

		// ���� ����
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