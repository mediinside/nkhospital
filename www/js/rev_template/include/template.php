<?
/*
BY-SHIN - 2016-03-04
*/

if(!defined("IN_AUTH")){
    
    die("Not Excution");
}


if(!defined("DO_NOT_SEND_DATA")) define("DO_NOT_SEND_DATA",false);

    //템플릿 클래스 선언
    $tpl = new Template_;
    $tpl->cache_dir = $root_path."cache";
    $tpl->compile_dir = $root_path."compile";
    $tpl->template_dir = $root_path."view";
	
    //레이아웃 템플릿 설정
    if(LAYOUT === true)
    {
		$tpl->define("top",$include_dir."inc/top.tpl");			
		$tpl->define("foot",$include_dir."inc/foot.tpl");			
		$tpl->define("left",$include_dir."inc/left.tpl");
		$tpl->define("menu",$include_dir."inc/menu.tpl");
        $tpl->define("layout",$include_dir."inc/layout.tpl");
    }
    else
    {
		$tpl->define("top",$include_dir."inc/top.tpl");
		$tpl->define("left",$include_dir."inc/left.tpl");
		$tpl->define("foot",$include_dir."inc/foot.tpl");		
        $tpl->define("layout",$include_dir."inc/no_layout.tpl");
    }

    $tpl->assign(array(
        'do_not_send_data'=>DO_NOT_SEND_DATA
    ));

/*else if(Ajax_PAGE === true)
{
    //템플릿 클래스 선언
    $tpl = new Template_;
    $tpl->cache_dir = $root_path."cache";
    $tpl->compile_dir = $root_path."compile";
    $tpl->template_dir = "./";
} 
*/
?>
