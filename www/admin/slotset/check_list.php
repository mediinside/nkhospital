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
<tr align="center">
	<td><font style="font-size:20px;color:red;font-weight:bold;">엑셀 업로드 결과 입니다. </font>
	</td>
</tr><tr>
<td align="right">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./check_del.php?total_seq=<?=$total_seq?>"><font color='blue'><b>[전체 삭제]</b></font></a>
</td>
</tr>
</table>
<table>
<tr>
<td width="10"></td>
<td>
<!--여기서 추가된 내용 가져옴
-->
<?
	$list_seq = explode("|",$total_seq);
	$k=0;
	for($i=0;$i<sizeof($list_seq)-1;$i++){
		$query = "select * from reserve_list_new where seq='".$list_seq[$i]."'";
		//echo $query."<br>";

		$result = mysql_query($query);
		$cnt = mysql_num_rows($result);
		$rows = mysql_fetch_array($result);

		if($cnt >0){

		$item = $rows[reserve_type];
		$jumin_no = explode("-",$rows[jumin_no]);
		$mobile_no = explode("-",$rows[mobile_no]);
		$email = explode("@",$rows[email]);

		

		if($rows[reserve_type0] == "Y"){
			$items = "기본 예약";
		}
		else if($rows[reserve_type27] == "Y"){
			$items = "일반 예약";
		}
		//echo $items;	

?>
	<table cellpadding="0" align="center" cellspacing="1" border=0 width="600" bgcolor="#c6c6c6">
		<form name='form<?=$list_seq[$i]?>' method='post' action='/admin/slotset/procExcel.php' enctype='multipart/form-data'>
		<input type="hidden" name="mode" value="update">
		<input type="hidden" name="seq" value="<?=$list_seq[$i]?>">

			<tr>
				<td width="20%" align="center" class="title_bold" bgcolor="#f2f2f2">예약 날짜
				</td>
				<td bgcolor="#ffffff">
					<table width="100%">
						<tr>
							<td><font style="color:#0000FF;font-weight:bold;"><?=$items?></font> <font style="font-weight:bold;">[<?=substr($rows[reserve_day],0,10)?>] <?=sel_time($rows[reserve_time]);?></font></td>
							<td align="right">
								<?
									if($rows[view_state]=="N"){
									?>
									<font color='red'>[추가안됨]</font>
									<?
									}
									else{
									?>
										<font color='red'>[추가됨]</font> <a href="/admin/slotset/procExcel.php?mode=del&seq=<?=$list_seq[$i]?>"><img src="/admin/img/close.gif" border="0"></a></td>
									<?
									}
									?>
						</tr>
					</table>
				</td>
			</tr>
			
			
			<tr>
				<td  align="center" width="20%" height="30"  bgcolor="#f2f2f2">고객정보
				</td>
				<td bgcolor="#ffffff">
					[<?=$rows[reserve_name]?>] [<?=$rows[jumin_no]?>] [<?=$rows[reserve_place]?>]
				</td>
			</tr>

			<tr>
				<td  align="center" width="20%" height="30"  bgcolor="#f2f2f2">정보수정 및 추가	
				</td>
				<td bgcolor="#ffffff">
					<a href="javascript:void(0)" onclick="javascript:window.open('/admin/reservation/<?if($rows[reserve_type0] == "Y"){echo "pop_res_write";}else{ echo "pop_res_write2";}?>.html?input_date=<?=substr($rows[reserve_day],0,10)?>&re_seq=<?=$rows[seq]?>','','width=1110,height=600');"> <font style="font-size:12px;font-weight:bold;">[세부 사항 수정]</font> </a>
				</td>
			</tr>
			
			</table>
			<table>
			<tr align='center'>
			<td width='810' colspan="2" align='center' style='padding:5 5 0 0'>
				
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
				<td>등록된 리스트가 없습니다.
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
<td align="right">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./check_del.php?total_seq=<?=$total_seq?>"><font color='blue'><b>[전체 삭제]</b></font></a>
</td>
</tr>
</table>
