<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}

function make_query_by_array($table,$field_array,$where){
    if($where)
    {
		if(count($field_array) == 0) {
			$field = 	$field_array;
		}else{
			foreach($field_array as $idx => $val){
				if($val!='') {
					$field[] = $idx."='".$val."'";
				}
			}
			$field = implode(",",$field);
		}
        return "update ".$table." set ".$field.($where?" where ".$where:"");
    }
    else
    {
        foreach($field_array as $idx => $val){
             if($val || $val =='0' ){
                 $field[] = $idx;
                 $values[] = "'".$val."'";
             }
        }
        return "insert into ".$table."(".implode(",",$field).") values(".implode(",",$values).")";
    }
}
?>