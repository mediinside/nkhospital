<?
class mysql extends Database{

    var $sql = array();
    var $result = array();
    var $linkno;
    var $print_mode = false;
    var $excute_time = array();

    function mysql($host,$user,$pass,$db,$linkno)
    {
        $this->linkno = $linkno;
        $this->Database($host,$user,$pass,$db);
        Database::Connect($this->linkno);
    }
    public function sql($sql,$idx='')
    {
        if(!$idx) $idx = 1;
        $this->sql[$idx] = $sql;
        return $this->sql[$idx];
    }
    function mid($idx='')
    {
        if(!$idx) $idx = 1;
        return mysql_insert_id();
    }
    function mfa($idx='')
    {
        if(!$idx) $idx = 1;
        return mysql_fetch_array($this->result[$idx]);
    }
    function mfs($idx='')
    {
        if(!$idx) $idx = 1;
        return mysql_fetch_assoc($this->result[$idx]);
    }	
    function mnr($idx='')
    {
        if(!$idx) $idx = 1;
        return @mysql_num_rows($this->result[$idx]);
    }
    function mr($r,$c,$idx='')
    {
        if(!$idx) $idx = 1;
        return @mysql_result($this->result[$idx],$r,$c);
    }
    function mfr($idx='')
    {
        if(!$idx) $idx = 1;
        return mysql_free_result($this->result[$idx]);
    }
    function afr()
    {
        return mysql_affected_rows($this->identifier[$this->linkno]);
    }

    function exec($idx='') // return 값이 없는 실행문
    {
        if(!$idx) $idx = 1;
        if($this->print_mode){

            $this->print_sql($idx);
        }
        else{

            $start = microtime();
            $this->result[$idx] = mysql_query($this->sql[$idx],$this->identifier[$this->linkno]) or die($this->error($idx));
            $this->excute_time[$idx] = microtime() - $start;
        }
    }
    function exec2($idx='') // return 값이 없는 실행문
    {
        if(!$idx) $idx = 1;
        if($this->print_mode){

            $this->print_sql($idx);
        }
        else{

            $start = microtime();
            if($this->result[$idx] = mysql_query($this->sql[$idx],$this->identifier[$this->linkno]))
            {
                return true;
            }
            else
            {
                return false;
                $this->error($idx);
            }
            $this->excute_time[$idx] = microtime() - $start;
        }
    }
    function excute_time($idx=''){

        if(!$idx) $idx = 1;
        return $this->excute_time[$idx];
    }
    function print_sql($idx='')
    {
        if(!$idx) $idx = 1;
        print "<font size=2 color=blue><b>".$this->sql[$idx]."</b></font><br>";
    }
    function error($idx='')
    {
        if(!$idx) $idx = 1;
        print "<font size=2 color=blue>ERROR IN <b>".$_SERVER["PHP_SELF"]."</b> on lin <B>".__LINE__."</B></font><br><br>";
        print "<font size=2 color=red><b>"
             .mysql_errno($this->identifier[$this->linkno])." : ".mysql_error($this->identifier[$this->linkno])
             ."<br><br>=>".__LINE__." : ".$this->sql[$idx]."</b></font><br>";
    }
    function disconnect()
    {
        foreach($this->result as $idx => $val) @mysql_free_result($this->result[$idx]);
        Database::DisConnect($this->linkno);
    }
}
?>