<?
class Database
{
    var $host;
    var $db;
    var $user;
    var $pass;
    var $identifier = array();

    function Database($host,$user,$pass,$db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
		
		@ini_set("memory_limit" , -1);
        @ini_set(mysql.allow_persistent,"On");
        @ini_set(mysql.max_persistent,"-1");
        @ini_set(mysql.max_links,"-1");
        @ini_set(mysql.default_port,NULL);
        @ini_set(mysql.default_socket,NULL);
        @ini_set(mysql.default_host,NULL);
        @ini_set(mysql.default_user,NULL);
        @ini_set(mysql.default_password,NULL);
        @ini_set(mysql.connect_timeout,"0");
    }
    function Connect($linkno)
    {
        if($this->identifier[$linkno] = mysql_connect($this->host,$this->user,$this->pass))
        {
            if($this->db)
            {
                if(mysql_select_db($this->db,$this->identifier[$linkno])) return true;
                else die("DATABASE is not selected");
            }
        }
        else
        {
            die("DATABASE connect failed");
        }
    }
    function DisConnect($linkno)
    {
        mysql_close($this->identifier[$linkno]);
    }
}
?>