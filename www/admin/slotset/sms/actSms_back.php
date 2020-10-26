<?
session_start();

include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/func.php";


$content =iconv("UTF-8","CP949",$content); // 한글땜에

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
	if($item == "기본"){
		$items = "item1";
	}
	
	else if($item == "수면대장" || $item == "일반대장"){
		$items = "item2";
	}
	else if($item == "뇌MRA" || $item == "MRI MBA" || $item == "뇌MRI" || $item == "요추MRI" || $item == "경추MRI" ){
		$items = "item3";
	}
	else if($item == "PET-CT(몸통)" || $item == "PET-CT(뇌)"){
		$items = "item4";
	}
	else if($item == "심초"){
		$items = "item5";
	}
	else if($item == "유초"){
		$items = "item6";
	}
	else if($item == "스케일링"){
		$items = "item7";
	}
	else if($item == "VIP"){
		$items = "item8";
	}
	else if($item == "일반"){
		$items = "item9";
	}
	
	return $items;
	/*if($item == "기본"){
		$items = "reserve_type0";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	else if($item == "일반"){
		$items = "reserve_type27";
	}
	return $items;
	*/
}

$item = "item0";
if($item == "item0"){
	$item = "item1";
	$sel_item = "item1";
	$where = "and reserve_type0='Y'";

}
else if($item == "item5" || $item == "item6"){
	$item = "item2";
	$sel_item = "item2";
	$where = " and (reserve_type5='Y' || reserve_type6='Y')";
}
else if($item == "item17"|| $item == "item18" || $item == "item19" || $item == "item20" || $item == "item21"){
	$item = "item3";
	$sel_item = "item3";
	$where = " and (reserve_type17='Y' || reserve_type18='Y' || reserve_type19='Y' || reserve_type20='Y' || reserve_type21='Y')";
}
else if($item == "item23" || $item == "item24"){
	$item = "item4";
	$sel_item = "item4";
	$where = " and (reserve_type23='Y' || reserve_type24='Y')";
}
else if($item == "item25"){
	$item = "item5";
	$sel_item = "item5";
	$where = "and reserve_type25='Y'";
}
else if($item == "item26"){
	$item = "item6";
	$sel_item = "item6";
	$where = "and reserve_type26='Y'";
}
else if($item == "item15"){#스케일링
	$item = "item7";
	$sel_item = "item7";
	$where = "and reserve_type15='Y'";
}
else if($item == "item13"){#vip
	$item = "item8";
	$sel_item = "item8";
	$where = "and reserve_type13='Y'";
}


error_reporting(E_ALL ^ E_NOTICE);
$k=0;

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
	$phonenum_real = "";
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		
		//echo "aa\"".$data->sheets[0]['cells'][$i][$j]."\",<br>";
		//echo $data->sheets[0]['cells'][$i][$j]."<br>";
		
		$phonenum_real2 = $data->sheets[0]['cells'][$i][$j]; //
		
		//echo $phonenum_real2."<br>";

		$pass_day = "";
		if($j == 4){#시간 설정이 없을경우 체크해서
			if($data->sheets[0]['cells'][$i][4] == ""){
				$item = "item1";
				$sel_week_end = $data->sheets[0]['cells'][$i][3];#입력 날짜가져옴
				
				$item = item_change($item);

				//echo $item."<br>";
			}
		
			#휴일인지 체크함
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
				#지정일인지 체크함
				$target_query = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3'";
				$target_result = mysql_query($target_query);
				$target_cnt = mysql_num_rows($target_result);
				//echo $target_cnt;
				if($target_cnt > 0){#지정일 
					$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and item1!=0";
					$target_result2 = mysql_query($target_query2);

					while($target_rows2 = mysql_fetch_array($target_result2)){
						$limit_count =  $target_rows2[$item];

						$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' and reserve_time0 ='".$timezone."' $where and view_state='Y' and state='Y'";
						//echo $limit_count."==".$list_query."<br>";
						
						$list_result = mysql_query($list_query);
						$list_cnt = mysql_num_rows($list_result);
						$list_rows = mysql_fetch_array($list_result);

						if($limit_count > $list_cnt){
							$phonenum_real2 = $target_rows2[timezone];
							break;
						}
						
						
					}
					if($phonenum_real2 == ""){
						$pass_day = "Y";
					}
					if($pass_day == "Y"){
						break;
					}
					
				}
				else{
					$sel_day = date("w",strtotime($sel_week_end));
				
					//exit;
					
					if($sel_day == "6"){#토요일 반일
						$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and item1!=0";
						//echo $ban_query;
						
						$ban_result = mysql_query($ban_query);

						while($ban_rows = mysql_fetch_array($ban_result)){
							$limit_count =  $ban_rows[$item];

							$reserve_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."'  $where and view_state='Y' and state='Y'";
							//echo $limit_count."==".$list_query."<br>";
							
							$list_result = mysql_query($list_query);
							$list_cnt = mysql_num_rows($list_result);
							$list_rows = mysql_fetch_array($list_result);

							if($limit_count > $list_cnt){
								$phonenum_real2 = $ban_rows[timezone];
								break;
							}
							
							
						}
						if($phonenum_real2 == ""){
							$pass_day = "Y";
						}
						if($pass_day == "Y"){
							break;
						}
					
					}
					else if($sel_day == "0"){#일요일 휴무
						$pass_day = "Y";
						break;
						
					}
					else{#전일
						$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and item1!=0";
						//echo $situation_query;
						$situation_result = mysql_query($situation_query);
						while($situation_rows = mysql_fetch_array($situation_result)){
							$limit_count =  $situation_rows[$item];

						//	list($wait_reserve_item1, $wait_reserve_item2, $wait_reserve_item3, $wait_reserve_item4, $wait_reserve_item5, $wait_reserve_item6, $wait_reserve_item7, $wait_item1, $wait_item2, $wait_item3, $wait_item4, $wait_item5, $wait_item6, $wait_item7) = wait_list($this_week_end1);

							$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y' and state='Y'";
							
							$list_result = mysql_query($list_query);
							$list_cnt = mysql_num_rows($list_result);
							$list_rows = mysql_fetch_array($list_result);
							
							if($limit_count > $list_cnt){
								$phonenum_real2 = $situation_rows[timezone];
								break;
							}
						}
						if($phonenum_real2 == ""){
							$pass_day = "Y";
						}
						if($pass_day == "Y"){
							break;
						}

					}
				}
			}
		}
			else{#시간이 입력되어 있을때 해당 슬롯이 가능한지
				$item = $data->sheets[0]['cells'][$i][4];
				$timezone = $data->sheets[0]['cells'][$i][4];
				$sel_week_end = $data->sheets[0]['cells'][$i][3];#입력 날짜가져옴
				
				$item = item_change($item);
			
				//echo $item;
				#휴일인지 체크함
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
					#지정일인지 체크함
					$target_query = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3'";
					$target_result = mysql_query($target_query);
					$target_cnt = mysql_num_rows($target_result);
					//echo $target_cnt;
					if($target_cnt > 0){#지정일 
						$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and item1!=0";
						$target_result2 = mysql_query($target_query2);

						while($target_rows2 = mysql_fetch_array($target_result2)){
							$limit_count =  $target_rows2[$item];

							$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y' and state='Y'";



							//echo $limit_count."==".$list_query."<br>";
							
							$list_result = mysql_query($list_query);
							$list_cnt = mysql_num_rows($list_result);
							$list_rows = mysql_fetch_array($list_result);

							if($limit_count < $list_cnt){
								$pass_day = "Y";
								break;
							}
							
							
						}
						
						
					}
					else{
						$sel_day = date("w",strtotime($sel_week_end));
					
						//exit;
						
						if($sel_day == "6"){#토요일 반일
							$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and item1!=0";
							//echo $ban_query;
							
							$ban_result = mysql_query($ban_query);

							while($ban_rows = mysql_fetch_array($ban_result)){
								$limit_count =  $ban_rows[$item];

								$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' $where and view_state='Y'";
								//echo $limit_count."==".$list_query."<br>";
								
								$list_result = mysql_query($list_query);
								$list_cnt = mysql_num_rows($list_result);
								$list_rows = mysql_fetch_array($list_result);

								if($limit_count < $list_cnt){
									$pass_day = "Y";
									break;
								}
								
								
							}
							
						
						}
						else if($sel_day == "0"){#일요일 휴무
							$pass_day = "Y";
							break;
							
						}
						else{#전일
							$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and item1!=0";

							//echo $situation_query;
							
							$situation_result = mysql_query($situation_query);
							while($situation_rows = mysql_fetch_array($situation_result)){
								$limit_count =  $situation_rows[$item];

								$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y'";
								//echo  $list_query;
												
								
								
								$list_result = mysql_query($list_query);
								$list_cnt = mysql_num_rows($list_result);
								
								$list_rows = mysql_fetch_array($list_result);

								//echo $limit_count."==".$list_cnt."<br>";
								if($limit_count <= $list_cnt){
									$pass_day = "Y";
									break;
								}
								//echo $list_cnt."==".$limit_count."==".$pass_day."<br>";	
							}
						}
					}
				}
			
			$phonenum_real=$phonenum_real."'".$phonenum_real2."',";

			if($pass_day != "Y"){#추가된 항목
				$plus_query = "now(),'".$sess_AID."','".$sess_ANM."','Y','Y'";
				$query = "insert into reserve_list_new(reserve_day,reserve_time,reserve_type,reserve_name,jumin_no,mobile_no,email,reserve_name2,reserve_name3,reserve_place,comment,reg_date,reg_id,reg_name,view_state,state) values(".$phonenum_real.$plus_query.");";
			//	echo "Y".$query."<br>";
				//mysql_query($query);
				
				
				//exit;
				//exit;
			}
			else{#추가안된 항목
				$plus_query = "now(),'".$sess_AID."','".$sess_ANM."','N','Y'";
				$query = "insert into reserve_list_new(reserve_day,reserve_time,reserve_type,reserve_name,jumin_no,mobile_no,email,reserve_name2,reserve_name3,reserve_place,comment,reg_date,reg_id,reg_name,view_state,state) values(".$phonenum_real.$plus_query.");";
				//echo "N".$query."<br>";
				//mysql_query($query);
				
			}
		//	exit;
		//	echo $query."<br>";
			$newSeq = mysql_insert_id();
			$total_seq = $total_seq.$newSeq."|";
}

		}
		if($newFile != "sample.xls"){
			@unlink($DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile);
		}
	



}	//exit;
	
MYSQL_CLOSE();
	
?>
