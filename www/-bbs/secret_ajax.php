<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
include_once($GP -> CLS."class.jhboard.php");
$C_JHBoard = new JHBoard();
$jb_idx = $_POST["idx"];
$args = "";
$args["jb_idx"] = $jb_idx;
$data = $C_JHBoard->Secret_Check($args);
echo "수정되었습니다";
?>