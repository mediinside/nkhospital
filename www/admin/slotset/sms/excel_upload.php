<?php

$fileName = $_FILES['upFile']['name'];
//echo $fileName;
$fileSize = $_FILES['upFile']['size'];
$fileTmp = @getimagesize($_FILES['upFile']['tmp_name'],&$type);

$newFile = $fileName;
$uploadFile = $DOCUMENT_ROOT."/template/phpExcelReader/".$newFile;

$chk = move_uploaded_file($_FILES['upFile']['tmp_name'], $uploadFile);

if($chk == "1"){
?>
<script>
alert("엑셀 파일이 첨부되었습니다.");
location.href="../myroom_sms.html?filename=<?=$fileName?>";
</script>
<?
}
else{
?>
<script>
alert("엑셀 파일이 첨부되지 않았습니다. 다시 시도하세요.");
history.back();
</script>
<?
}
?>