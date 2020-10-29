<?
if(!defined("IN_AUTH")){
    
    die("Not Excution");
}

class select_box
{
    var $selected_value;
    var $display_message = false;
    var $onchange_event;
    var $box_id;
    var $box_title;
    var $element = array();
    var $message;
    var $source_file;
    var $idx = 1;
    var $where_syntax;

    function select_box($element_name)
    {
        global $db;
        $this->box_id = $element_name."_select_box";
        $this->element_name = $element_name;
        $this->source_file = "select_box/select_box.".$element_name.".php";
    }
    function display()
    {
        global $tpl,$root_path,$include_dir;
        $this->get_source();
        $tpl->setScope($this->box_id);
        $tpl->define($this->box_id,$include_dir."inc/select_box.tpl");
        $tpl->assign(array(
            'box'       => $this->element,
            'msg'       => $this->message,
            'name'      => $this->element_name,
            'title'     => $this->box_title,
            'disp_msg'  => $this->display_message,
            'onchange'  => $this->onchange_event,
            'selected'  => $this->selected_value,
			'class'		=> $this->class,
			'id'		=> $this->id
        ));
        //unset($this->element);
        $tpl->setScope();
    }
    function init()
    {
        $this->idx++;
        $this->element_name .= $this->idx;
		$this->element = "";
        $this->box_id .= $this->idx;
        $this->display_message = false;
        $this->onchange_event = "";
        $this->selected_value = "";
		//echo  $this->element_name;
    }

    function get_source()
    {
        global $db,$root_path;
        include $this->source_file;
    }

    function get_element($value)
    {
        foreach($this->element as $idx => $val)
        {
            if($this->element[$idx]["value"] == $value)
            {
                return $this->element[$idx]["text"];
            }
        }
    }
}

class radio_button extends select_box
{
    function display()
    {
        global $tpl,$db,$root_path;
        include $this->source_file;
        $tpl->setScope($this->box_id);
        $tpl->define($this->box_id,"radio_button.tpl");
        $tpl->assign(array(
            'box'       => $this->element,
            'msg'       => $this->message,
            'name'      => $this->element_name,
            'title'     => $this->box_title,
            'disp_msg'  => $this->display_message,
            'onchange'  => $this->onchange_event,
            'selected'  => $this->selected_value
        ));
        //unset($this->element);
        $tpl->setScope();
    }
}
?>