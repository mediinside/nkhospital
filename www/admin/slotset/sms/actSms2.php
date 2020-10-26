<?
session_start();

include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/func.php";

$content =iconv("UTF-8","CP949",$content); // ÇÑ±Û¶«¿¡

$fileName = $_FILES['upFile']['name'];
$fileSize = $_FILES['upFile']['size'];
$fileTmp = @getimagesize($_FILES['upFile']['tmp_name'],&$type);

$newFile = $fileName;
$uploadFile = $DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile;

$chk = move_uploaded_file($_FILES['upFile']['tmp_name'], $uploadFile);

//-------------------------------------------------------------------------------------

	require_once $DOCUMENT_ROOT.'/admin/slotset/phpExcelReader/Excel/reader.php';


	// ExcelFile($filename, $encoding);
	$data = new Spreadsheet_Excel_Reader();


	// Set output Encoding.
	$data->setOutputEncoding('CP949');
	$data->read($DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile);

	error_reporting(E_ALL ^ E_NOTICE);
	$k=0;
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		$phonenum_real = "";
		$field_value = "";
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			$field_value .= "'".addslashes(str_replace(',',' ',$data->sheets[0]['cells'][$i][$j]))."',";
		}
		$field_value = substr($field_value,0,-1);
		//	echo $data->sheets[0]['numCols'];
			
			$query = "insert into admin_checkup(";
			for($k=1;$k<=$data->sheets[0]['numCols'];$k++){
				if($k == $data->sheets[0]['numCols']){
					$query .= "c_".$k.")";
				}
				else{
					$query .= "c_".$k.",";
				}
			}
			$query .= "value(".$field_value.")";
			
			
		//echo $query."<br><br><br>";
		$result = mysql_query($query);
		$newSeq = mysql_insert_id();
		$total_seq = $total_seq.$newSeq."|";
	}
	//echo $filed_value;

	if($newFile != "sample.xls"){
		@unlink($DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile);
	}
MYSQL_CLOSE();
echo "<script language='JavaScript'>parent.location.href='../?dir=slotset&menu=Reserve7'</script>";
	exit;
}
?>