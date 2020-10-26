<?
//공통 치환 설정
$ctotal = count($GP->NEW_MOBILE_CENTER) + count($GP->NEW_MOBILE_CLINIC) + count($GP->NEW_MOBILE_SPECIAL) + 3;
$tpl->assign(array(
    "root" => $root_path,
	"gpa" 	=> $GP->NEW_MOBILE_CENTER,
	"gpb" 	=> $GP->NEW_MOBILE_CLINIC,
	"gpc" 	=> $GP->NEW_MOBILE_SPECIAL,
	'ctotal' => $ctotal
));

$tpl->print_("layout");

if($gourl) $js->pageload($gourl,$addurl);

ob_end_flush();

unset($DB);
unset($js);
unset($tpl);

//print microtime() - START_TIME;
exit;
?>