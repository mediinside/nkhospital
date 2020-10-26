<?
	include_once  '../_init.php';
   	include_once($GP -> CLS."/class.mcc.php");	    
	$C_Mcc	 	= new Mcc;    

	switch($mode){
		case "d" :
			$nYear 		= $_POST["year"];
			$nMonth		= $_POST["month"];
			$nMonth 	= (strlen($nMonth) == "1") ? "0".$nMonth : $nMonth; 
			
			$pDay 		= "1";
			$minDay = date("Ymd",strtotime("+".$pDay." days"));
			$args = array();
			$args["dr_mcode"] = $dr_mcode;
			$args["rev_mon"]  = $nYear.$nMonth;
			$args["min_day"]  = $minDay;	
			$args["dr_mcode"] = "10002";		
		
            $revDay = $C_Mcc->SchDoctorMonth($args);        
                        
            
		
			echo '<option value="">일 선택</option>';
			foreach($revDay as $k=>$v){
				$vDay = substr($v["CLINIC_YMD"],-2,2);
				echo "<option value='".$v["CLINIC_YMD"]."'>".$vDay."일"; 
			}
		break;
		case "t" :
			$rDay 		= $_POST["rday"];
			$args = array();
			$args["rev_date"] 	= $rDay;
			$args["dr_mcode"] 	= $dr_mcode;			
			$revTime = $C_Mcc->SchDoctorDay($args);
			echo '<option value="">시간 선택</option>';
			foreach($revTime as $k=>$v){
				$vTime = substr($v["CLINIC_TIME"],0,2)."시 ".substr($v["CLINIC_TIME"],-2,2)."분";
				echo "<option value='".$v["CLINIC_TIME"]."'>".$vTime; 
			}
			
		break;	
		case "rdel" :
			$empno 		= $_POST["empno"];
			$rday 		= $_POST["rday"];
			$rtime 		= $_POST["rtime"];
			$args = "";
			$args["empno"] 	= $empno;
			$args["rday"] 	= $rday;
			$args["rtime"] 	= $rtime;						
			$args["name"] 	= $_SESSION["susername"];
			$args["phone"] 	= str_replace("-","",$_SESSION["suserphone"]);			
		    //$data = $C_Mcc->RevInfo($args);
			$rst = $C_Mcc->MccReserveCancel($args);   
		break;			
	}
?>
