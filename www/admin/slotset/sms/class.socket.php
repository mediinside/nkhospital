<?php
$sms_id = "missen";
$sms_pw = "9000djr";

class smsSocket
{
	var $conf	= array('host' => 'daemon.smsjjang.com', 'port' => '8888');
	var $sock	= NULL;
	var $packet	= NULL;

	function smsSocket ($conf=array())
	{
		$confs	= (is_array($conf) == true) ? $conf : $this->conf;
		foreach ($confs as $key => $val)
		{
			$this->conf[$key]	= $val;
		}
	}

	function setConnect ()
	{
		$this->sock	= @fsockopen($this->conf['host'], $this->conf['port'], $errno, $errstr);
		return (!$this->sock) ? false : true;
	}

	function getPaket ($data)
	{

		foreach ($data as $key => $val)
		{
			switch ($key)
			{
				case 'id' :
				case 'pw' :
					$packet[$key]	= $key."=".$val;
					break;
				case 'reserve' :
					$packet[$key]	= $key."=".$val;
					break;
				case 'from' :
					$packet[$key]	= $key."=".$val;
					break;
				case 'msg' :
					$packet[$key]	= $key."=".$val;
					break;
				case 'to' :
					$packet[$key]	= $key."=".$val;
					break;
				case 'indexkey' :
					$packet[$key]	= $key."=".$val;
					break;
			}
		}
	
		$datas	= $packet['id'] ."&". $packet['pw']."&". $packet['reserve']."&".$packet['from']."&". $packet['to'] ."&". $packet['msg']."&". $packet['indexkey'];
		$this->packet  = "Host: ".$this->conf['host']."\r\n"; 
		$this->packet .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
		$this->packet .= "Content-Length: ".strlen($datas)."\r\n"; 
		$this->packet .= "Connection: close\r\n\r\n"; 
		$this->packet .= $datas;

	}

	function socketOpen ()
	{
		return ($this->setConnect()) ? true : false;
	}

	function socketPutData ()
	{
		fputs($this->sock, "POST /  HTTP/1.1\r\n");
		fputs($this->sock, $this->packet);
		fputs($this->sock, "\r\n");
	}

	function socketReade ()
	{
		$sockData	= NULL;
		
		$buffer =  fread($this->sock, 1024*10);
		$buffers = explode("\r\n\r\n",$buffer);
		return unserialize(trim($buffers[1]));
	}

	function disConnect ()
	{
		if ($this->sock) { fclose($this->sock); unset($this->sock); }
	}
}
?>