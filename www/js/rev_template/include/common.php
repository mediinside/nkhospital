<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}

// HEADER
@header("Content-Type: text/html; charset=utf-8");
@header("Cache-Control: no-cache, must-revalidate");
@header("Pragma: no-cache");
@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
@Header("Access-Control-Allow-Origin: *");
@Header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
@header("Access-Control-Allow-Headers: X-Requested-With, X-Prototype-Version");



//@session_cache_limiter('private');
@session_start();
@ini_set("session.cache_expire",3600*1);
@ini_set("session.gc_maxlifetime",3600*2);
//echo phpinfo();

define("START_TIME",microtime());

if(!get_magic_quotes_gpc() )
{

    if(isset($_POST)){

        foreach($_POST as $idx => $val) {
            
            if(is_array($val)){

                foreach($val as $idx2 => $val2){

                    $_POST[$idx][$idx2] = addslashes($val2);
                }
            }else{

                $_POST[$idx] = addslashes($val);
            }
        }
    }
    //겟 변수 슬래쉬 추가
    if(isset($_GET)){

        foreach($_GET as $idx => $val) {
            
            if(is_array($val)){

                foreach($val as $idx2 => $val2){

                    $_GET[$idx][$idx2] = addslashes($val2);
                }
            }else{

                $_GET[$idx] = addslashes($val);
            }
        }
    }
}
ob_start();
if(AJAX_PAGE !== true) {
//print_r($_GET);

//echo "<br>cd=========>".$cd."<br>";
//echo "<br>pg=========>".$pg."<br>";

//page 설정
if($_GET["pg"]) {
$pg = explode("/",$_GET["pg"]);
	$pg_arr = array_pop($pg);
	$fd   = implode("/",$pg);
	$tpl_path = $fd."/".$pg_arr.".tpl";
}else{
	$tpl_path = "index.tpl";	
}
/*
if($_GET["param"]){
	$param = explode("&",$_GET["param"]);
		foreach($param as $get => $value) {
			$val = explode("=",$value);
				${$val[0]} = $val[1];
		}
}


	echo "<br>bd_code=========>".$bd_code."<br>";
	echo "fd=============>".$fd."<br>";
	echo "tpl_path=============>".$tpl_path."<br>";
*/	
}
include "constants.php";
include	'db.php';
include $root_path.'lib/Template_.class.php'; 
include $root_path."functions/function.global.php";

//명령 수행 페이지가 아니라면 템플릿을 인클루드 한다.
if(!defined("COMMAND_PAGE")){
    include "template.php";
}

if(!$_SESSION["rev_id"])
{
    if(NEED_LOGIN === true)
    {
		?>
            <script>
				var url = "<?=urlencode($_SERVER["REQUEST_URI"])?>";
				location.href="/online/main/?redirect="+url;
			</script>
        <?
		exit;
    }
}


// 세션이 없으면 로그인 창으로 리턴 해준다.
function showAlertAndlogin($msg)
{
	?>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
	<script>
		alert("<?=$msg?>");
		var url = "<?=urlencode($_SERVER["REQUEST_URI"])?>";
		location.href="adm/login.php?redirect="+url;
	</script>
	<?
	exit;
}

// common.php 파일을 수정할 필요가 없도록 확장.
// 확장된 lib 파일들을 모두 include_extend 폴더에 있음.
// 그리고 해당 파일에선 common.php 파일만 include 하면 자동으로 include.

$tmp = dir($_SERVER['DOCUMENT_ROOT']."/rev_template/include_extend");

while ($entry = $tmp->read()) {
    // php 파일만 include 함
    if (preg_match("/(\.php)$/i", $entry)) {
		if(LAYOUT === false){
			if($entry!="header.php"){   //Layout 이 아니라면 헤더파일도 읽지 않는다.
    	    	include_once($_SERVER['DOCUMENT_ROOT']."/rev_template/include_extend/$entry");
			}
		}else{
			   	include_once($_SERVER['DOCUMENT_ROOT']."/rev_template/include_extend/$entry");
		}
	}
}

if(AJAX_PAGE === true){
	
}else{
	include "javascript.php";
	//echo "</head>";
}

include $root_path."functions/function.common.php";
?>