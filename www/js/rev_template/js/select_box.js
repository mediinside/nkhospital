//지역 이름
function load_gugun(frm,from_box,to_box){

	table = "GUGUN";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

function load_group_course(from_box,to_box,group_no){

	table = "GC";
	value = document.getElementById(from_box).value;
	etc_w = "group_no = " + group_no;
	create_post_submit_form(from_box,to_box,table,value,etc_w);
}

function load_group_degree(from_box,to_box){

	table = "GD";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

//교육 과정
function load_course(from_box,to_box){
	
	table = "C";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

function load_subject(from_box,to_box){

	table = "S";
	value =document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

function load_subject_from_course(from_box,to_box){

	table = "SC";
	value =document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

function load_lesson_code(from_box,to_box){
	
	table = "LC";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}
function load_lesson(from_box,to_box){
	
	table = "L";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}

function load_subject_lesson(from_box,to_box){
	
	table = "S2L";
	subject_no = document.getElementById('subject_no').value;
	etc_w = "subject_no = " + subject_no
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,etc_w);
}

function load_board_cagegory(from_box,to_box){
	
	table = "BC";
	value = document.getElementById(from_box).value;
	create_post_submit_form(from_box,to_box,table,value,'');
}


//포스트 서브밋
function create_post_submit_form(from_box,to_box,table_name,value,etc){
	
	new_form = document.createElement("form");
	new_form.setAttribute("name","hidden_post");
	new_form.setAttribute("target","action_frame");
	new_form.setAttribute("method","post");
	new_form.setAttribute("action","select_box_process.php");

	from = document.createElement("input");
	from.setAttribute("name","from");
	from.setAttribute("type","hidden");
	from.setAttribute("value",from_box);

	to = document.createElement("input");
	to.setAttribute("name","to");
	to.setAttribute("type","hidden");
	to.setAttribute("value",to_box);

	table = document.createElement("input");
	table.setAttribute("name","table");
	table.setAttribute("type","hidden");
	table.setAttribute("value",table_name);

	s_value = document.createElement("input");
	s_value.setAttribute("name","s_value");
	s_value.setAttribute("type","hidden");
	s_value.setAttribute("value",value);
	
	etc_w = document.createElement("input");
	etc_w.setAttribute("name","etc_w");
	etc_w.setAttribute("type","hidden");
	etc_w.setAttribute("value",etc);

	new_form.appendChild(to);
	new_form.appendChild(from);
	new_form.appendChild(table);
	new_form.appendChild(s_value);
	new_form.appendChild(etc_w);
	
	document.body.appendChild(new_form);
	new_form.submit();
}