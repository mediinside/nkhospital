<?
session_start();

include $DOCUMENT_ROOT."/admin/inc/dbConn.php";
include $DOCUMENT_ROOT."/admin/inc/func.php";


//echo $total_seq;
?>
<script language="JavaScript">
<!--
function chkForm(frm) {
	
	frm.submit();
}

//-->
</script>
<Link rel="stylesheet" type="text/css" href="/admin/inc/style.css">
<Link rel="stylesheet" type="text/css" href="/admin/inc/menu.css">

<table height="50" cellpadding="0" cellspacing="0" width='720'>
<tr>
<td align="right"><a href="#" onclick="parent.location.href='../index_reserve.html?dir=slotset&menu=Reserve'"><font color='red'><b>[���� ���� ������]</b></font></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./check_del.php?total_seq=<?=$total_seq?>"><font color='blue'><b>[��ü ����]</b></font></a>
</td>
</tr>
</table>
<table>
<tr>
<td width="10"></td>
<td>
<!--���⼭ �߰��� ���� ������
-->
<?
	$list_seq = explode("|",$total_seq);
	$k=0;
	for($i=0;$i<sizeof($list_seq)-1;$i++){
		$query = "select * from admin_checkup where seq='".$list_seq[$i]."'";
		//echo $query."<br>";

		$result = mysql_query($query);
		$cnt = mysql_num_rows($result);
		$rows = mysql_fetch_array($result);

		if($cnt >0){

		
		

?>
	<table cellpadding="0" align="center" cellspacing="1" border=0 width="600" bgcolor="#c6c6c6">
		<form name='form<?=$list_seq[$i]?>' method='post' action='/admin/slotset/procExcel.php' enctype='multipart/form-data'>
		<input type="hidden" name="mode" value="update">
		<input type="hidden" name="seq" value="<?=$list_seq[$i]?>">

			<tr>
				<td width="20%" align="center" class="title_bold" bgcolor="#f2f2f2">���� ��¥
				</td>
				<td bgcolor="#ffffff">
					<table width="100%">
						<tr>
							<td>[<?=substr($rows[reserve_day],0,10)?>] <?=sel_time($rows[reserve_time]);?></td>
							<td align="right">
								<?
									if($rows[view_state]=="N"){
									?>
									<font color='red'>[�߰��ȵ�]</font>
									<?
									}
									else{
									?>
										<a href="/admin/slotset/procExcel.php?mode=del&seq=<?=$list_seq[$i]?>"><img src="/admin/img/close.gif" border="0"></a></td>
									<?
									}
									?>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td  align="center" width="20%" class="title_bold" bgcolor="#f2f2f2">�˻�����	
				</td>
				<td bgcolor="#ffffff">
					<input type="text" name="reserve_type" value="<?=$items?>" size="10" readonly> �� �˻������� �����Ҽ� �����ϴ�.
					<!--<select name="reserve_type" onchange="selectCondition(this.value)" readonly>
						<option value="">����</option>
						<option value="item1" <?if($items == "����"){echo "selected";}?>>����</option>
						<option value="item2" <?if($items == "�Ϲ�"){echo "selected";}?>>�Ϲ�</option>
						<option value="item3" <?if($items == "VIP"){echo "selected";}?>>VIP</option>
						<option value="item4" <?if($items == "MRI"){echo "selected";}?>>MRI</option>
						<option value="item5" <?if($items == "���峻�ð�"){echo "selected";}?>>���峻�ð�</option>
						<option value="item6" <?if($items == "����������"){echo "selected";}?>>����������</option>
						<option value="item7" <?if($items == "����������"){echo "selected";}?>>����������</option>
					</select>-->

				</td>
			</tr>
			
			<tr>
				<td  align="center" width="20%"   bgcolor="#f2f2f2">����	
				</td>
				<td bgcolor="#ffffff">
					<input type="text" name="reserve_name" value="<?=$rows[reserve_name]?>">
				</td>
			</tr>
			<tr>
				<td  align="center" width="20%"  class="title_bold" bgcolor="#f2f2f2">
					�ֹε�Ϲ�ȣ
				</td>
				<td bgcolor="#ffffff">
					<span class="puts3"><input type="text" name="jumin1" value="<?=$jumin_no[0]?>" style="width:100px;" onkeyup='if(document.form.jumin1.value.length==6) document.form.jumin2.focus();'/></span> - 
					<span class="puts3"><input type="password" name="jumin2" value="<?=$jumin_no[1]?>" style="width:100px;" /></span>
				</td>
			</tr>
			<tr>
                <td  align="center"  width="20%"  class="title_bold" bgcolor="#f2f2f2">�޴���ȭ</td>
                <td bgcolor="#ffffff" align="left"> <select style="BORDER-RIGHT: 1px inset; BORDER-TOP: 1px inset; FONT-SIZE: 11px; BORDER-LEFT: 1px inset; WIDTH: 80px; COLOR: #383838; BORDER-BOTTOM: 1px inset; FONT-FAMILY: ����; HEIGHT: 19px; BACKGROUND-COLOR: #f7f7f7"  name="mobile_phone1" onChange="cellfirst()" id="mobile1">
                    <option value=''>-��ȣ����-</option>
                    <option value='010' <?if($mobile_no[0] == "010"){echo "selected";}?>>010</option>
                    <option value='011' <?if($mobile_no[0] == "011"){echo "selected";}?>>011</option>
                    <option value='016' <?if($mobile_no[0] == "016"){echo "selected";}?>>016</option>
                    <option value='017' <?if($mobile_no[0] == "017"){echo "selected";}?>>017</option>
                    <option value='018' <?if($mobile_no[0] == "018"){echo "selected";}?>>018</option>
                    <option value='019' <?if($mobile_no[0] == "019"){echo "selected";}?>>019</option>
                    </select>
              -
                <input name="mobile_phone2" type="text" class="input" size="6" value="<?=$mobile_no[1]?>" maxlength="4">
              -
                <input name="mobile_phone3" type="text" class="input" size="6" value="<?=$mobile_no[2]?>" maxlength="4">
               
                </td>
            </tr>
			 <tr>
                <td width="20%"  align="center" class="title_bold" bgcolor="#f2f2f2">�̸���</td>
                <td bgcolor="#ffffff" align="left"><input name='email_id' type="text" class="input" size="12" value="<?=$email[0]?>">
                  @
                    <input name='email_url'  id="email_etc" type="text" class="input" size="16"  value="<?=$email[1]?>">
                   
                   
                </td>
            </tr>
			<tr>
				<td  width="20%"  align="center" class="title_bold" bgcolor="#f2f2f2">������	
				</td>
				<td bgcolor="#ffffff">
					<input type="text" name="reserve_name2" value="<?=$rows[reserve_name2]?>">
				</td>
			</tr>
			<tr>
				<td  width="20%"  align="center" class="title_bold" bgcolor="#f2f2f2">�μ���	
				</td>
				<td bgcolor="#ffffff">
					<input type="text" name="reserve_name3" value="<?=$rows[reserve_name3]?>">
				</td>
			</tr>
			<tr>
				<td  width="20%"  align="center" class="title_bold" bgcolor="#f2f2f2">�������	
				</td>
				<td bgcolor="#ffffff">
					<select name="reserve_place">
						<option value="��������(3��)" <?if($rows[reserve_place]=="��������(3��)"){echo "selected";}?>>��������(3��)</option>
						<option value="��������(3��)" <?if($rows[reserve_place]=="��������(3��)"){echo "selected";}?>>��������(3��)</option>
						
					</select>
				</td>
			</tr>
			
			<tr>
				<td  width="20%"  align="center"  class="title_bold" bgcolor="#f2f2f2">���	
				</td>
				<td bgcolor="#ffffff">
					<textarea name="comment" cols=40% rows=5><?=$rows['comment']?></textarea>
				</td>
			</tr>
			</table>
			<table>
			<tr align='center'>
			<td width='810' colspan="2" align='center' style='padding:5 5 0 0'>
				<input type='button' style='width:51px; height:22px;' value='�� ��' class='btn1' onClick="chkForm(document.form<?=$list_seq[$i]?>)" onfocus='this.blur();'> 
			</td>
		</tr>

			</form>
		</table>
		</center>
		<br><br>
<?
				$k++;
	}
	}
	if($k == 0){
?>
		<table cellpadding="3" align="center" cellspacing="0" border=1 width="600">
			<tr>
				<td>��ϵ� ����Ʈ�� �����ϴ�.
				</td>
			</tr>
		</table>
<?
	}
?>
</td>
</tr>
</table>

<table height="50" cellpadding="0" cellspacing="0" width='720'>
<tr>
<td align="right"><a href="#" onclick="parent.location.href='../index_reserve.html?dir=slotset&menu=Reserve'"><font color='red'><b>[���� ���� ������]</b></font></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./check_del.php?total_seq=<?=$total_seq?>"><font color='blue'><b>[��ü ����]</b></font></a>
</td>
</tr>
</table>
