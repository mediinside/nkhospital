<?
class jsscript
{
    var $head = "\n<script language='javascript'>";
    var $foot = "</script>\n";
    var $root_obj = "this";

    function jsscript()
    {
        echo $this->head."var obj = ".$this->root_obj.";".$this->foot;
    }
    function getparent()
    {   
        $this->root_obj .= ".parent";
        echo $this->head."obj = ".$this->root_obj.";".$this->foot;
    }
    function getopener()
    {
        $this->root_obj .= ".opener";
        echo $this->head."obj = ".$this->root_obj.";".$this->foot;
    }
    function getobject($obj)
    {
        $this->root_obj .= ".".$obj;
        echo $this->head."obj = ".$this->root_obj.";".$this->foot;
    }
    function resetobject()
    {
        $this->root_obj = "this";
        $this->jsscript();
    }
    function gourl($url){

        echo $this->head."obj.location.href='".$url."'".$this->foot;
    }
    function goback($num){

        echo $this->head."obj.history.go(-".$num.");".$this->foot;
    }
    function msgbox($msg){

        echo $this->head."alert(\"".$msg."\");".$this->foot;
    }
    function reload(){

        echo $this->head."obj.location.reload();".$this->foot;
    }
    function replace(){

        echo $this->head."obj.location.replace('".$url."');".$this->foot;
    }	
    function load_script($file){

        echo "<script language=javascript src=".$file."></script>\n";
    }
    function setscript($script){

        echo $this->head.$script.$this->foot;
    }
    function close(){

        echo $this->head."obj.close();".$this->foot;
    }
    function openerreload(){

        echo $this->head."obj.opener.location.reload();".$this->foot;
    }	
    function openergourl($url){

        echo $this->head."obj.opener.location.href='$url';  self.close();".$this->foot;
    }	
	
    function parentreload(){

        echo $this->head."obj.parent.location.reload();".$this->foot;
    }
	function smsgbox($title, $msg, $status){
		 echo $this->head."swal(\"".$title."\", \"".$msg."\", \"".$status."\");".$this->foot;
	}
   /* function pageload($url,$data){
        echo $this->head."alert('".$url."');$('#container').load('".$url.".php','".$data."',function(){
			$('#container').fadeIn('slow');$('html').removeClass('menuOn');});".$this->foot;
    }*/
    function pageload($url,$data){
        echo $this->head."page_load(\"".$url.".php\", \"".$data."\");".$this->foot;
    }			
}
?>