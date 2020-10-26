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
	else if($item == "일반"){
		$items = "item9";
	}
	//echo $items."<br>";
	
	return $items;
}

//$item = "item0";

error_reporting(E_ALL ^ E_NOTICE);
$k=0;


for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
	$phonenum_real = "";
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		
		$phonenum_real2 = $data->sheets[0]['cells'][$i][5]; //
		$post = explode("-",$data->sheets[0]['cells'][$i][17]);
		$pass_day = "";
		if($data->sheets[0]['cells'][$i][5] == ""){#시간 설정이 없을경우 체크해서

			$item = $data->sheets[0]['cells'][$i][4];
			$sel_week_end2 = $data->sheets[0]['cells'][$i][3];#입력 날짜가져옴
			$sel_week_end2 = explode("/",$sel_week_end2);
			$sel_week_end = $sel_week_end2[2]."-".$sel_week_end2[1]."-".$sel_week_end2[0];	
			$item = item_change($item);

			if($item == "item1"){
				$item = "item1";
				$sel_item = "item1";
				$where = "and reserve_type0='Y'";
				$reserve_type = "reserve_type0";
				$reserve_time = "reserve_time0";
			}
			else if($item == "item9"){
				$item = "item9";
				$sel_item = "item9";
				$where = "and reserve_type27='Y'";
				$reserve_type = "reserve_type27";
				$reserve_time = "reserve_time27";
			}
				//echo $item."<br>";
			
			#휴일인지 체크함
			$pass_day = "";
			$holiday_query = "select * from reserve_holiday where day_start='".$sel_week_end."' and view_state='Y' and day_type='4'";
			$holiday_result = mysql_query($holiday_query);
			$holiday_cnt = mysql_num_rows($holiday_result);
			if($holiday_cnt > 0){
				$pass_day = "Y";
				break;
			}
			else{
				#지정일인지 체크함
				$target_query = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3'";
				$target_result = mysql_query($target_query);
				$target_cnt = mysql_num_rows($target_result);
				if($target_cnt > 0){#지정일 
					$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and $item!=0";
					$target_result2 = mysql_query($target_query2);
					while($target_rows2 = mysql_fetch_array($target_result2)){
						$limit_count =  $target_rows2[$item];
						$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where  and view_state='Y' and state='Y'";						
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
					
					if($sel_day == "6"){#토요일 반일
						$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and $item!=0";
						
						$ban_result = mysql_query($ban_query);

						while($ban_rows = mysql_fetch_array($ban_result)){
							$limit_count =  $ban_rows[$item];
							$reserve_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."'  $where and view_state='Y' and state='Y'";
							//echo $limit_count."==".$reserve_query."<br>";
							$list_result = mysql_query($reserve_query);
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
						$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and $item!=0";
						//echo $situation_query;
						$situation_result = mysql_query($situation_query);
						while($situation_rows = mysql_fetch_array($situation_result)){
							$limit_count =  $situation_rows[$item];
							$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y' and state='Y'";

							echo $list_query."<br>";
							$list_result = mysql_query($list_query);
							$list_cnt = mysql_num_rows($list_result);
							$list_rows = mysql_fetch_array($list_result);

							//echo $limit_count."<br>";
							//echo $phonenum_real2;
							//echo $list_cnt."<br>";
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

			//echo $phonenum_real2."<br>";
		//	exit;
			//$phonenum_real=$phonenum_real."'".$phonenum_real2."',";
			if($pass_day != "Y"){#추가된 항목
				$query = "1111111111111insert reserve_list_new11 set 
				reserve_day='".$sel_week_end."', 
				reserve_time='".$phonenum_real2."',
				reserve_name = '".$data->sheets[0]['cells'][$i][7]."',
				jumin_no     = '".$data->sheets[0]['cells'][$i][14]."',
				mobile_no     = '".$data->sheets[0]['cells'][$i][15]."',
				email     = '".$data->sheets[0]['cells'][$i][16]."',
				post1     = '".$post[0]."',
				post2     = '".$post[1]."',
				addr1     = '".$data->sheets[0]['cells'][$i][18]."',
				addr2     = '".$data->sheets[0]['cells'][$i][19]."',
				reserve_place = '".$data->sheets[0]['cells'][$i][1]."',
				$reserve_time='".$phonenum_real2."',
				$reserve_type='Y',
				reserve_type_name='".$data->sheets[0]['cells'][$i][2]."',
				reserve_time1='".$phonenum_real2."',
				reserve_type1='".$data->sheets[0]['cells'][$i][20]."',
				reserve_time3='".$phonenum_real2."',
				reserve_type3='".$data->sheets[0]['cells'][$i][21]."',
				reserve_time4='".$phonenum_real2."',
				reserve_type4='".$data->sheets[0]['cells'][$i][22]."',
				reserve_time7='".$phonenum_real2."',
				reserve_type7='".$data->sheets[0]['cells'][$i][23]."',
				reserve_time8='".$phonenum_real2."',
				reserve_type8='".$data->sheets[0]['cells'][$i][24]."',
				reserve_time9='".$phonenum_real2."',
				reserve_type9='".$data->sheets[0]['cells'][$i][25]."',
				reserve_time10='".$phonenum_real2."',
				reserve_type10='".$data->sheets[0]['cells'][$i][26]."',
				reserve_time11='".$phonenum_real2."',
				reserve_type11='".$data->sheets[0]['cells'][$i][27]."',
				reserve_time12='".$phonenum_real2."',
				reserve_type12='".$data->sheets[0]['cells'][$i][28]."',
				comment = '".$data->sheets[0]['cells'][$i][29]."',
				reg_date = now(),
				reg_id='".$data->sheets[0]['cells'][$i][8]."',
				view_state='Y',
				place = '".$data->sheets[0]['cells'][$i][6]."',
				member_no = '".$data->sheets[0]['cells'][$i][9]."',
				postion = '".$data->sheets[0]['cells'][$i][10]."',
				person = '".$data->sheets[0]['cells'][$i][11]."',
				office = '".$data->sheets[0]['cells'][$i][12]."',
				delivery = '".$data->sheets[0]['cells'][$i][13]."',
				black_list = '".$data->sheets[0]['cells'][$i][30]."',
				state='Y'
				";

				//echo $query."<br><br>";

			}
			else{#추가안된 항목
				$query = "aaaaaaaaaaaaaaaaaaaaaaainsert reserve_list_new set 
				reserve_day='".$sel_week_end."', 
				reserve_time='".$phonenum_real2."',
				reserve_name = '".$data->sheets[0]['cells'][$i][7]."',
				jumin_no     = '".$data->sheets[0]['cells'][$i][14]."',
				mobile_no     = '".$data->sheets[0]['cells'][$i][15]."',
				email     = '".$data->sheets[0]['cells'][$i][16]."',
				post1     = '".$post[0]."',
				post2     = '".$post[1]."',
				addr1     = '".$data->sheets[0]['cells'][$i][18]."',
				addr2     = '".$data->sheets[0]['cells'][$i][19]."',
				reserve_place = '".$data->sheets[0]['cells'][$i][1]."',
				$reserve_time='".$phonenum_real2."',
				$reserve_type='Y',
				reserve_type_name='".$data->sheets[0]['cells'][$i][2]."',
				reserve_time1='".$phonenum_real2."',
				reserve_type1='".$data->sheets[0]['cells'][$i][20]."',
				reserve_time3='".$phonenum_real2."',
				reserve_type3='".$data->sheets[0]['cells'][$i][21]."',
				reserve_time4='".$phonenum_real2."',
				reserve_type4='".$data->sheets[0]['cells'][$i][22]."',
				reserve_time7='".$phonenum_real2."',
				reserve_type7='".$data->sheets[0]['cells'][$i][23]."',
				reserve_time8='".$phonenum_real2."',
				reserve_type8='".$data->sheets[0]['cells'][$i][24]."',
				reserve_time9='".$phonenum_real2."',
				reserve_type9='".$data->sheets[0]['cells'][$i][25]."',
				reserve_time10='".$phonenum_real2."',
				reserve_type10='".$data->sheets[0]['cells'][$i][26]."',
				reserve_time11='".$phonenum_real2."',
				reserve_type11='".$data->sheets[0]['cells'][$i][27]."',
				reserve_time12='".$phonenum_real2."',
				reserve_type12='".$data->sheets[0]['cells'][$i][28]."',
				comment = '".$data->sheets[0]['cells'][$i][29]."',
				reg_date = now(),
				reg_id='".$data->sheets[0]['cells'][$i][8]."',
				view_state='N',
				place = '".$data->sheets[0]['cells'][$i][6]."',
				member_no = '".$data->sheets[0]['cells'][$i][9]."',
				postion = '".$data->sheets[0]['cells'][$i][10]."',
				person = '".$data->sheets[0]['cells'][$i][11]."',
				office = '".$data->sheets[0]['cells'][$i][12]."',
				delivery = '".$data->sheets[0]['cells'][$i][13]."',
				black_list = '".$data->sheets[0]['cells'][$i][30]."',
				state='Y'
				";
			}
			echo $query."<br><br><br>";
		}
		else{
			$item = $data->sheets[0]['cells'][$i][4];
				$timezone = sel_time3($data->sheets[0]['cells'][$i][5]);
				$sel_week_end2 = $data->sheets[0]['cells'][$i][3];#입력 날짜가져옴
				$sel_week_end2 = explode("/",$sel_week_end2);

				$sel_week_end = $sel_week_end2[2]."-".$sel_week_end2[1]."-".$sel_week_end2[0];
				
				$item = item_change($item);

				if($item == "item1"){
					$item = "item1";
					$sel_item = "item1";
					$where = "and reserve_type0='Y'";
					$reserve_type = "reserve_type0";
					$reserve_time = "reserve_time0";
				}
				else if($item == "item9"){
					$item = "item9";
					$sel_item = "item9";
					$where = "and reserve_type27='Y'";
					$reserve_type = "reserve_type27";
					$reserve_time = "reserve_time27";
				}
				//echo $item."<br>";

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
						$target_query2 = "select * from reserve_setday where day_start='".$sel_week_end."' and view_state='Y' and day_type='3' and $item!=0 and timezone='".$timezone."'";
						$target_result2 = mysql_query($target_query2);

						while($target_rows2 = mysql_fetch_array($target_result2)){
							$limit_count =  $target_rows2[$item];

							$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y' and state='Y' and reserve_time='".$timezone."'";
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
							$ban_query = "select * from reserve_setday where  view_state='Y' and day_type='2' and $item!=0 and timezone='".$timezone."'";
							//echo $ban_query;
							
							$ban_result = mysql_query($ban_query);

							while($ban_rows = mysql_fetch_array($ban_result)){
								$limit_count =  $ban_rows[$item];

								$list_query = "select * from reserve_list where reserve_day='".$sel_week_end."' $where and view_state='Y' and reserve_time='".$timezone."'";
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
							$situation_query = "select * from reserve_setday where  view_state='Y' and day_type='1' and $item!=0 and timezone='".$timezone."'";

							//echo $situation_query;
							
							$situation_result = mysql_query($situation_query);
							while($situation_rows = mysql_fetch_array($situation_result)){
								$limit_count =  $situation_rows[$item];

								$list_query = "select * from reserve_list_new where reserve_day='".$sel_week_end."' $where and view_state='Y' and reserve_time='".$timezone."'";
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




	
	}
	//$phonenum_real=$phonenum_real."'".$phonenum_real2."',";
	if($pass_day != "Y"){#추가된 항목
		$query = "333333333333insert reserve_list_new set 
		reserve_day='".$sel_week_end."', 
		reserve_time='".$timezone."',
		reserve_name = '".$data->sheets[0]['cells'][$i][7]."',
		jumin_no     = '".$data->sheets[0]['cells'][$i][14]."',
		mobile_no     = '".$data->sheets[0]['cells'][$i][15]."',
		email     = '".$data->sheets[0]['cells'][$i][16]."',
		post1     = '".$post[0]."',
		post2     = '".$post[1]."',
		addr1     = '".$data->sheets[0]['cells'][$i][18]."',
		addr2     = '".$data->sheets[0]['cells'][$i][19]."',
		reserve_place = '".$data->sheets[0]['cells'][$i][1]."',
		$reserve_time='".$timezone."',
		$reserve_type='Y',
		reserve_type_name='".$data->sheets[0]['cells'][$i][2]."',
		reserve_time1='".$timezone."',
		reserve_type1='".$data->sheets[0]['cells'][$i][20]."',
		reserve_time3='".$timezone."',
		reserve_type3='".$data->sheets[0]['cells'][$i][21]."',
		reserve_time4='".$timezone."',
		reserve_type4='".$data->sheets[0]['cells'][$i][22]."',
		reserve_time7='".$timezone."',
		reserve_type7='".$data->sheets[0]['cells'][$i][23]."',
		reserve_time8='".$timezone."',
		reserve_type8='".$data->sheets[0]['cells'][$i][24]."',
		reserve_time9='".$timezone."',
		reserve_type9='".$data->sheets[0]['cells'][$i][25]."',
		reserve_time10='".$timezone."',
		reserve_type10='".$data->sheets[0]['cells'][$i][26]."',
		reserve_time11='".$timezone."',
		reserve_type11='".$data->sheets[0]['cells'][$i][27]."',
		reserve_time12='".$timezone."',
		reserve_type12='".$data->sheets[0]['cells'][$i][28]."',
		comment = '".$data->sheets[0]['cells'][$i][29]."',
		reg_date = now(),
		reg_id='".$data->sheets[0]['cells'][$i][8]."',
		view_state='Y',
		place = '".$data->sheets[0]['cells'][$i][6]."',
		member_no = '".$data->sheets[0]['cells'][$i][9]."',
		postion = '".$data->sheets[0]['cells'][$i][10]."',
		person = '".$data->sheets[0]['cells'][$i][11]."',
		office = '".$data->sheets[0]['cells'][$i][12]."',
		delivery = '".$data->sheets[0]['cells'][$i][13]."',
		black_list = '".$data->sheets[0]['cells'][$i][30]."',
		state='Y'
		";

		//echo $query."<br><br>";

	}
	else{#추가안된 항목
		$query = "444444444444insert reserve_list_new set 
		reserve_day='".$sel_week_end."', 
		reserve_time='".$timezone."',
		reserve_name = '".$data->sheets[0]['cells'][$i][7]."',
		jumin_no     = '".$data->sheets[0]['cells'][$i][14]."',
		mobile_no     = '".$data->sheets[0]['cells'][$i][15]."',
		email     = '".$data->sheets[0]['cells'][$i][16]."',
		post1     = '".$post[0]."',
		post2     = '".$post[1]."',
		addr1     = '".$data->sheets[0]['cells'][$i][18]."',
		addr2     = '".$data->sheets[0]['cells'][$i][19]."',
		reserve_place = '".$data->sheets[0]['cells'][$i][1]."',
		$reserve_time='".$timezone."',
		$reserve_type='Y',
		reserve_type_name='".$data->sheets[0]['cells'][$i][2]."',
		reserve_time1='".$timezone."',
		reserve_type1='".$data->sheets[0]['cells'][$i][20]."',
		reserve_time3='".$timezone."',
		reserve_type3='".$data->sheets[0]['cells'][$i][21]."',
		reserve_time4='".$timezone."',
		reserve_type4='".$data->sheets[0]['cells'][$i][22]."',
		reserve_time7='".$timezone."',
		reserve_type7='".$data->sheets[0]['cells'][$i][23]."',
		reserve_time8='".$timezone."',
		reserve_type8='".$data->sheets[0]['cells'][$i][24]."',
		reserve_time9='".$timezone."',
		reserve_type9='".$data->sheets[0]['cells'][$i][25]."',
		reserve_time10='".$timezone."',
		reserve_type10='".$data->sheets[0]['cells'][$i][26]."',
		reserve_time11='".$timezone."',
		reserve_type11='".$data->sheets[0]['cells'][$i][27]."',
		reserve_time12='".$timezone."',
		reserve_type12='".$data->sheets[0]['cells'][$i][28]."',
		comment = '".$data->sheets[0]['cells'][$i][29]."',
		reg_date = now(),
		reg_id='".$data->sheets[0]['cells'][$i][8]."',
		view_state='N',
		place = '".$data->sheets[0]['cells'][$i][6]."',
		member_no = '".$data->sheets[0]['cells'][$i][9]."',
		postion = '".$data->sheets[0]['cells'][$i][10]."',
		person = '".$data->sheets[0]['cells'][$i][11]."',
		office = '".$data->sheets[0]['cells'][$i][12]."',
		delivery = '".$data->sheets[0]['cells'][$i][13]."',
		black_list = '".$data->sheets[0]['cells'][$i][30]."',
		state='Y'
		";
	}
		echo $query."<br><br><br>";
			
}
		


	

}
if($newFile != "sample121212121.xls"){
	//@unlink($DOCUMENT_ROOT."/admin/slotset/phpExcelReader/".$newFile);
}
exit;
MYSQL_CLOSE();
	
?>
<meta http-equiv="refresh" content="0;url=/admin/slotset/check_list.php?total_seq=<?=$total_seq?>">
