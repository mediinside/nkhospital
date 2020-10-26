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
@ini_set("session.cache_expire",3600*24);
@ini_set("session.gc_maxlifetime",3600*24);
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
    //Í≤?Î≥Ä???¨Îûò??Ï∂îÍ?
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
}
$_DEF_PATH = str_replace('\\', '/', dirname(__FILE__));
$_DEF_PATH = explode('/',$_DEF_PATH);
array_pop($_DEF_PATH);
array_pop($_DEF_PATH);
array_pop($_DEF_PATH);
$_DEF_PATH = implode('/',$_DEF_PATH);
include_once  $_DEF_PATH . '/_INC/config.inc';
include_once  $_DEF_PATH . '/_INC/config.inc';
include_once $GP -> CLS . 'class.func.php';
include_once $GP -> CLS . 'class.button.php';
$C_Func = new Func();
$C_Button = new Button();
include_once $GP -> CLS . 'class.dbconn.php';
$C_DB = new Dbconn($GP -> DB);

include "constants.php";
include $root_path.'lib/Template_.class.php'; 
include $root_path."functions/function.global.php";


if(!defined("COMMAND_PAGE")){
    include "template.php";
}

if(!$_SESSION["a_id"])
{
    if(NEED_LOGIN === true)
    {
		?>
            <script>
				var url = "<?=urlencode($_SERVER["REQUEST_URI"])?>";
				location.href="/r5/login.php?redirect="+url;
				//location.href="/r5/lg";
			</script>
        <?
		exit;
    }
}else{
	
	if(ADMIN_MODE === true) {
		if($_SESSION["a_level"] != "00") {
		?>
            <script>
				var url = "<?=urlencode($_SERVER["REQUEST_URI"])?>";
				location.href="/r5/?main";
			</script>
        <?
		exit;			
		}
	}	
}


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


$tmp = dir($_SERVER['DOCUMENT_ROOT']."/v3/include_extend");

while ($entry = $tmp->read()) {
    // php ?åÏùºÎß?include ??
    if (preg_match("/(\.php)$/i", $entry)) {
		if(LAYOUT === false){
			if($entry!="header.php"){   //Layout ???ÑÎãà?ºÎ©¥ ?§Îçî?åÏùº???ΩÏ? ?äÎäî??
    	    	include_once($_SERVER['DOCUMENT_ROOT']."/v3/include_extend/$entry");
			}
		}else{
			   	include_once($_SERVER['DOCUMENT_ROOT']."/v3/include_extend/$entry");
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