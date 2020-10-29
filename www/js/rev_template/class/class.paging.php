<?
class Paging{

	var $Pagesize;
	var $Totalpage;
	var $Firstpage;
	var $Lastpage;
	var $Totalblock;
	var $Blocksize;
	var $Block;
	var $Toprecord;
	var $Bottomrecord;
	var $Page;
	var $AddURL;

	function Paging($page,$pagesize,$blocksize,$totalrecord){

		$this->Page = $page;
        if(!$this->Page) $this->Page = 1;
		$this->Pagesize = $pagesize;
		$this->Blocksize = $blocksize;
		$this->Totalrecord = $totalrecord;
        
		foreach($_GET as $idx => $val)
        {
            if(is_array($val))
            {
                foreach($val as $idx2 => $val2)
                {
                    if($idx != "page") $this->AddURL .= "&".$idx."[".$idx2."]=".$val2;
                }
            }
            else
            {
               if($idx != "page") $this->AddURL .= "&".$idx."=".$val;
            }
        }

		$this->Totalpage = @(int)ceil($this->Totalrecord / $this->Pagesize);
		if($this->Totalpage < 1) $this->Totalpage = 1;

		$this->Totalblock	=	@(int)ceil($this->Totalpage / $this->Blocksize);
		$this->Block		=	@(int)ceil($this->Page / $this->Blocksize);
        if($this->Totalblock <= $this->Block) $this->Lastpage = $this->Totalpage;

		$this->Firstpage = (int)($this->Blocksize * ($this->Block - 1)) + 1;
		if(!$this->Lastpage) $this->Lastpage = (int)($this->Firstpage + $this->Blocksize) - 1;
		
        if($this->Page == 1) $this->Toprecord = $this->Totalrecord;	 
		else $this->Toprecord = $this->Totalrecord - ($this->Pagesize * ($this->Page - 1));
		$this->Bottomrecord = ($this->Page - 1) * $this->Pagesize;
		if($this->Bottomrecord < 0) $this->Bottomrecord = 0;
	}

	function NextBlock(){
        
		if($this->Block < $this->Totalblock){

            $Next = $_SERVER[PHP_SELF]."?page=".($this->Lastpage + 1).$this->AddURL;
    		return $Next;
        }
	}

	function PrevBlock(){

		if($this->Block > 1){

            $Prev = $_SERVER[PHP_SELF]."?page=".($this->Firstpage - $this->Blocksize).$this->AddURL;
            return $Prev;
        }		
	}
	

//페이지이동
	function PrevPage(){

		if($this->Page > 1){

            $PrevPage = $_SERVER[PHP_SELF]."?page=".($this->Page - 1).$this->AddURL;
            return $PrevPage;
        }		
	}	
	
	function NextPage(){
        
		if($this->Page < $this->Totalpage){
            $NextPage = $_SERVER[PHP_SELF]."?page=".($this->Page + 1).$this->AddURL;
    		return $NextPage;
        }
	}	

	function PageLink(){

        $PageLink = "";
		for($Link = $this->Firstpage ; $Link <= $this->Lastpage ; $Link++){

			if($Link == $this->Page) $PageLink .= " <b><FONT color='#FF0000'>$Link</font></b> ";		
			else $PageLink .= " <a href='".$_SERVER[PHP_SELF]."?page=".$Link.$this->AddURL."'>$Link</a> ";
		}
		if($PageLink) return $PageLink;
	}
	
	//ajax를 위해 링크는 제외
	function NotPageLink(){

        $PageLink = "";
		for($Link = $this->Firstpage ; $Link <= $this->Lastpage ; $Link++){

			if($Link == $this->Page) $PageLink .= "<span onClick=page_list('$Link'); style='cursor:pointer'><b><FONT color='#FF0000'>$Link</font></b></span>";		
			else $PageLink .= "<span onClick=page_list('$Link'); style='cursor:pointer'><font> $Link </font></span>";
		}
		if($PageLink) return $PageLink;
	}	
}
?>