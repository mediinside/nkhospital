<?php 
/*
BY-SHIN - 2019-06-11
*/

include "include/head.php";

define("IN_AUTH",true);
define("LAYOUT",true);
define("NEED_LOGIN",false);

$root_path = "";

include $root_path."include/common.php";
if($_SESSION['suserid']) $C_Func->go_url("/v3/");
if($_POST["use"]!="Y" || $_POST["info"]!="Y" || $_POST["uni"]!="Y" ) $C_Func -> put_msg_and_go ('잘못된 접근입니다.' , '/v3/join.php');
$js->load_script("/v3/controller/js/join.js");

$tpl->define("main","join.step2.tpl");

$tpl->assign(array(
));

include $root_path."include/footer.php";
?>

