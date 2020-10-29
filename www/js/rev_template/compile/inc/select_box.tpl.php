<?php /* Template_ 2.2.7 2016/04/27 10:44:43 /home/hosting_users/nkmed/www/rev_template/view/inc/select_box.tpl 000001033 */ 
$TPL_box_1=empty($TPL_VAR["box"])||!is_array($TPL_VAR["box"])?0:count($TPL_VAR["box"]);?>
<select name="<?php echo $TPL_VAR["name"]?>"<?php if($TPL_VAR["disp_msg"]){?> msg="<?php echo $TPL_VAR["msg"]?>"<?php }?><?php if($TPL_VAR["onchange"]){?> onchange="<?php echo $TPL_VAR["onchange"]?>"<?php }?> <?php if($TPL_VAR["class"]){?> class="<?php echo $TPL_VAR["class"]?>" <?php }?>  <?php if($TPL_VAR["id"]){?> id="<?php echo $TPL_VAR["id"]?>" <?php }?> <?php if($TPL_VAR["style"]){?> style="<?php echo $TPL_VAR["style"]?>" <?php }?>>
<?php if($TPL_VAR["title"]){?><option value=""><?php echo $TPL_VAR["title"]?></option><?php }?>
<?php if($TPL_box_1){foreach($TPL_VAR["box"] as $TPL_V1){?>
	<option value="<?php echo $TPL_V1["value"]?>" <?php if($TPL_V1["value"]==$TPL_VAR["selected"]){?>selected<?php }?> style="<?php echo $TPL_V1["style"]?>"><?php echo $TPL_V1["text"]?></option>
<?php }}?>
</select>