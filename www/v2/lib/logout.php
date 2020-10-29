<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
session_destroy();

$C_Func->go_url("/v2/");
?>