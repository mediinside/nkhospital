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
    //�� ���� ������ �߰�
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

//page ����
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

//��� ���� �������� �ƴ϶�� ���ø��� ��Ŭ��� �Ѵ�.
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


// ������ ������ �α��� â���� ���� ���ش�.
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

// common.php ������ ������ �ʿ䰡 ������ Ȯ��.
// Ȯ��� lib ���ϵ��� ��� include_extend ������ ����.
// �׸��� �ش� ���Ͽ��� common.php ���ϸ� include �ϸ� �ڵ����� include.

$tmp = dir($_SERVER['DOCUMENT_ROOT']."/rev_template/include_extend");

while ($entry = $tmp->read()) {
    // php ���ϸ� include ��
    if (preg_match("/(\.php)$/i", $entry)) {
		if(LAYOUT === false){
			if($entry!="header.php"){   //Layout �� �ƴ϶�� ������ϵ� ���� �ʴ´�.
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