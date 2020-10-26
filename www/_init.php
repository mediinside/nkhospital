<?php
@session_start();
// default include path
$_DEF_PATH = str_replace('\\', '/', dirname(__FILE__));
$_DEF_PATH = explode('/',$_DEF_PATH);
array_pop($_DEF_PATH);
$_DEF_PATH = implode('/',$_DEF_PATH);
include_once  $_DEF_PATH . '/_INC/config.inc';
include_once $GP -> CLS . 'class.func.php';
include_once $GP -> CLS . 'class.button.php';
$C_Func = new Func();
$C_Button = new Button();

$mAgent = array("iPhone","iPod","Android","Blackberry", 
	"Opera Mini", "Windows ce", "Nokia", "sony" );
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
	if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
		$chkMobile = true;
		break;
	}
}
//if($chkMobile) $C_Func -> go_url ("/v3/");


include_once $GP -> CLS . 'class.dbconn.php';
$C_DB = new Dbconn($GP -> DB);

?>
