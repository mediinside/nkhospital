<?
//���� ġȯ ����
$tpl->assign(array(
    "root" => $root_path
));

$tpl->print_("layout");

ob_end_flush();

unset($DB);
unset($js);
unset($tpl);

//print microtime() - START_TIME;
exit;
?>