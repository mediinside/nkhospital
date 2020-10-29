<select name="{name}"{?disp_msg} msg="{msg}"{/}{?onchange} onchange="{onchange}"{/} {?class} class="{class}" {/}  {?id} id="{id}" {/} {?style} style="{style}" {/}>
{?title}<option value="">{title}</option>{/}
{@ box}
	<option value="{box.value}" {?box.value==selected}selected{/} style="{box.style}">{box.text}</option>
{/}
</select>