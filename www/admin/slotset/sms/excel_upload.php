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
alert("���� ������ ÷�εǾ����ϴ�.");
location.href="../myroom_sms.html?filename=<?=$fileName?>";
</script>
<?
}
else{
?>
<script>
alert("���� ������ ÷�ε��� �ʾҽ��ϴ�. �ٽ� �õ��ϼ���.");
history.back();
</script>
<?
}
?>