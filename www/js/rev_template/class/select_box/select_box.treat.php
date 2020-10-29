<?
$ora_db = new Oracle(); 

	$query = "select * from dreamer.BTC_Dept where PrintRanking > 0 order by PrintRanking ASC";
	$rs = $ora_db->selectList($query); 
	
	for( $i=0 ; $i < sizeof($rs["DEPTCODE"]) ; $i++ ){ 
		$this->element[] = array(
			"text"  =>iconv('EUC-KR','UTF-8',$rs["DEPTNAMEK"][$i]),
			"value" =>$rs["DEPTCODE"][$i]
		);		
	}
?>
