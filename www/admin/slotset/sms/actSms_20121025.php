<?
session_start();

include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/func.php";


$content =iconv("UTF-8","CP949",$content); // �ѱ۶���

$fileName = $_FILES['upFile']['name'];
//echo $fileName;
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

	function item_change($item){
		if($item == "����"){
			$items = "item1";
		}
		else if($item == "�Ϲ�"){
			$items = "item2";
		}
		else if($item == "VIP"){
			$items = "item7";
		}
		else if($item == "MRI"){
			$items = "item5";
		}
		else if($item == "�볻"){
			$items = "item3";
		}
		else if($item == "����"){
			$items = "item4";
		}
		else if($item == "����"){
			$items = "item6";
		}
		return $items;
	}


	error_reporting(E_ALL ^ E_NOTICE);
	$k=0;
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		$phonenum_real = "";
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			//echo "aa\"".$data->sheets[0]['cells'][$i][$j]."\",<br>";
			//echo $data->sheets[0]['cells'][$i][$j]."<br>";
			if($j == 3){
				$phonenum_real2 = item_change($data->sheets[0]['cells'][$i][$j]); //
			}
			else{
				$phonenum_real2 = $data->sheets[0]['cells'][$i][$j]; //
			}
			$pass_day = "";



			
			if($j == 2){#�ð� ������ ������� üũ�ؼ�
				if($data->sheets[0]['cells'][$i][2] == ""){
					
					$item = $data->sheets[0]['cells'][$i][3];
					$sel_week_end = $data->sheets[0]['cells'][$i][1];#�Է� ��¥������
					
					$item = item_change($item);
				
					//echo $item;
					#�������� üũ��
					$pass_day = "";

					$holiday_query = "select * from reserve_holiday where day_start='".$sel_week_end."' and view_state='Y' and day_type='4'";
					
					$holiday_result = mysql_query($holiday_query);
					$holiday_cnt = mysql_num_rows($holiday_result);
					//echo $holiday_cnt;
					if($holiday_cnt > 0){
						$pass_day = "Y";
						break;
					}
					else{
						#���������� üũ��
						$target_query = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3'";
						$target_result = mysql_query($target_query);
						$target_cnt = mysql_num_rows($target_result);
						//echo $target_cnt;
						if($target_cnt > 0){#������ 
							$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and $item!=0";
							$target_result2 = mysql_query($target_query2);

							while($target_rows2 = mysql_fetch_array($target_result2)){
								$limit_count =  $target_rows2[$item];

								$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$target_rows2[timezone]."' and view_state='Y'";
								//echo $limit_count."==".$list_query."<br>";
								
								$list_result = mysql_query($list_query);
								$list_cnt = mysql_num_rows($list_result);
								$list_rows = mysql_fetch_array($list_result);

								if($limit_count > $list_cnt){
									$phonenum_real2 = $target_rows2[timezone];
									break;
								}
								if($phonenum_real2 == ""){
									$pass_day = "Y";
								}
								
							}
							if($pass_day == "Y"){
								break;
							}
							
						}
						else{
							$sel_day = date("w",strtotime($sel_week_end));
						
							//exit;
							
							if($sel_day == "6"){#����� ����
								$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and $item!=0";
								//echo $ban_query;
								
								$ban_result = mysql_query($ban_query);

								while($ban_rows = mysql_fetch_array($ban_result)){
									$limit_count =  $ban_rows[$item];

									$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$ban_rows[timezone]."' and view_state='Y'";
									//echo $limit_count."==".$list_query."<br>";
									
									$list_result = mysql_query($list_query);
									$list_cnt = mysql_num_rows($list_result);
									$list_rows = mysql_fetch_array($list_result);

									if($limit_count > $list_cnt){
										$phonenum_real2 = $ban_rows[timezone];
										break;
									}
									if($phonenum_real2 == ""){
										$pass_day = "Y";
									}
									
								}
								if($pass_day == "Y"){
									break;
								}
							
							}
							else if($sel_day == "0"){#�Ͽ��� �޹�
								$pass_day = "Y";
								break;
								
							}
							else{#����
								$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and $item!=0";
								//echo $situation_query;
								$situation_result = mysql_query($situation_query);
								while($situation_rows = mysql_fetch_array($situation_result)){
									$limit_count =  $situation_rows[$item];

									$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$situation_rows[timezone]."' and view_state='Y'";
									//echo $limit_count."==".$list_query."<br>";
									
									$list_result = mysql_query($list_query);
									$list_cnt = mysql_num_rows($list_result);
									$list_rows = mysql_fetch_array($list_result);

									if($limit_count > $list_cnt){
										$phonenum_real2 = $situation_rows[timezone];
										break;
									}
									if($phonenum_real2 == ""){
										$pass_day = "Y";
									}
									
								}
								if($pass_day == "Y"){
									break;
								}

							}
						}
					}

				}
			}
			else{#�ð��� �ԷµǾ� ������ �ش� ������ ��������









					$item = $data->sheets[0]['cells'][$i][3];
					$timezone = $data->sheets[0]['cells'][$i][2];
					$sel_week_end = $data->sheets[0]['cells'][$i][1];#�Է� ��¥������
					
					$item = item_change($item);
				
					//echo $item;
					#�������� üũ��
					$pass_day = "";

					$holiday_query = "select * from reserve_holiday where day_start='".$sel_week_end."' and view_state='Y' and day_type='4'";
					
					$holiday_result = mysql_query($holiday_query);
					$holiday_cnt = mysql_num_rows($holiday_result);
					//echo $holiday_cnt;
					if($holiday_cnt > 0){
						$pass_day = "Y";
						break;
					}
					else{
						#���������� üũ��
						$target_query = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3'";
						$target_result = mysql_query($target_query);
						$target_cnt = mysql_num_rows($target_result);
						//echo $target_cnt;
						if($target_cnt > 0){#������ 
							$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and $item!=0";
							$target_result2 = mysql_query($target_query2);

							while($target_rows2 = mysql_fetch_array($target_result2)){
								$limit_count =  $target_rows2[$item];

								$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$timezone."' and view_state='Y'";
								//echo $limit_count."==".$list_query."<br>";
								
								$list_result = mysql_query($list_query);
								$list_cnt = mysql_num_rows($list_result);
								$list_rows = mysql_fetch_array($list_result);

								if($limit_count < $list_cnt){
									$pass_day = "Y";
									break;
								}
								
								
							}
							if($pass_day == "Y"){
								break;
							}
							
						}
						else{
							$sel_day = date("w",strtotime($sel_week_end));
						
							//exit;
							
							if($sel_day == "6"){#����� ����
								$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and $item!=0";
								//echo $ban_query;
								
								$ban_result = mysql_query($ban_query);

								while($ban_rows = mysql_fetch_array($ban_result)){
									$limit_count =  $ban_rows[$item];

									$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$timezone."' and view_state='Y'";
									//echo $limit_count."==".$list_query."<br>";
									
									$list_result = mysql_query($list_query);
									$list_cnt = mysql_num_rows($list_result);
									$list_rows = mysql_fetch_array($list_result);

									if($limit_count < $list_cnt){
										$pass_day = "Y";
										break;
									}
									
									
								}
								if($pass_day == "Y"){
									break;
								}
							
							}
							else if($sel_day == "0"){#�Ͽ��� �޹�
								$pass_day = "Y";
								break;
								
							}
							else{#����
								$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and $item!=0";
								
								$situation_result = mysql_query($situation_query);
								while($situation_rows = mysql_fetch_array($situation_result)){
									$limit_count =  $situation_rows[$item];

									$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' and reserve_type='".$item."' and reserve_time='".$timezone."' and view_state='Y'";
									
									
									$list_result = mysql_query($list_query);
									$list_cnt = mysql_num_rows($list_result);
									
									$list_rows = mysql_fetch_array($list_result);
									if($limit_count < $list_cnt){
										$pass_day = "Y";
										break;
									}
									//echo $list_cnt."==".$limit_count."==".$pass_day."<br>";

									
								}
								if($pass_day == "Y"){
									break;
								}

							}
						}
					}




				
			}
			
			if($j == $data->sheets[0]['numCols']){
				$phonenum_real=$phonenum_real."'".$phonenum_real2."',now(),'".$sess_AID."','".$sess_ANM."','Y','Y'";
			}
			else{
				$phonenum_real=$phonenum_real."'".$phonenum_real2."',";
			}
			
			
		}
		if($pass_day != "Y"){
			
			$query = "insert into reserve_list(reserve_day,reserve_time,reserve_type,reserve_name,jumin_no,mobile_no,email,reserve_name2,reserve_name3,reserve_place,comment,reg_date,reg_id,reg_name,view_state,state) values(".$phonenum_real.");";
			echo $query."<br>";
			mysql_query($query);
			$newSeq = mysql_insert_id();
			$total_seq = $total_seq.$newSeq."|";
			
			//exit;
			//exit;
		}
		
		
		//$phonenum_real=$phonenum_real."|";
		//echo "11";
		//echo "\n";
		
	}	exit;
	//echo $total_seq;
	@unlink($DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile);

//echo $total_seq;
//exit;
MYSQL_CLOSE();
	
?>
<meta http-equiv="refresh" content="0;url=/admin/slotset/check_list.php?total_seq=<?=$total_seq?>">