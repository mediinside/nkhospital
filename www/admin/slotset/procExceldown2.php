<?
//session_start();

session_start();
include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";
$today = date("YmdHis");
header("Content-type: application/vnd.ms-excel" );				// ����� ����ϴ� �κ� (�� ���α׷��� �ٽ�)
header("Content-Disposition: attachment; filename=���ฮ��Ʈ_".$today.".xls" );
echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\"></head><body>";	//yong �ѱ۹���

echo "<style>
<!--table
@page
	{margin:1.0in .75in 1.0in .75in;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;}
col
	{mso-width-source:auto;
	mso-ruby-visibility:none;}
br
	{mso-data-placement:same-cell;}
.style0
	{mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	white-space:nowrap;
	mso-rotate:0;
	mso-background-source:auto;
	mso-pattern:auto;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:����;
	mso-generic-font-family:auto;
	mso-font-charset:129;
	border:none;
	mso-protection:locked visible;
	mso-style-name:ǥ��;
	mso-style-id:0;}
.xl24
	{mso-style-parent:style0;
	vertical-align:middle;}
.xl25
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	vertical-align:middle;}
.xl26
	{mso-style-parent:style0;;
	mso-number-format:None;;
	border:.5pt solid windowtext;}
.xl27
	{mso-style-parent:style0;
	text-align:center;
	border:.5pt solid windowtext;
	background:#CCFFFF;
	mso-pattern:auto none;}
.xl28
	{mso-style-parent:style0;
	mso-number-format:'\@';}
ruby
	{ruby-align:left;}
rt
	{color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:����, monospace;
	mso-font-charset:129;
	mso-char-type:none;
	display:none;}
.naive
{mso-number-format:'\@';}

-->
</style>
";

?>


<table width='1500' height='' border='1' cellpadding='5' cellspacing='5' >
<tr align="center" bgcolor="#d1d1d1"  height="40">
	<td width='50'>��ȣ</td>
	<td width='100'>����ڸ�</td>
	<td width='200'>�����Ͻ�</td>
	<td width='50'>��������� ��</td>
	<td width='100'>����</td>
	<td width='100'>����ڸ�</td>
	<?if($table == "reserve_outchecklist"){
	?>
	<td width='100'>��������</td>
	<?
	}
	?>
	<td width='100'>�����</td>
	<td width='100'>�����</td>
	<td width='200'>����
	</td>
	
	
</tr>
<?
#���� üũ
	$chk_date = $year."-".$month;
	$chk_query = "select * from $table where view_state='Y' and left(start_day,7) = '$chk_date'  order by start_day asc";
	//echo $chk_query;
	$chk_result = mysql_query($chk_query);

	$chk_query2 = "select * from $table where view_state='Y' and left(start_day,7) = '$chk_date'  order by start_day asc";
	$chk_result2 = mysql_query($chk_query2);

	$totalCount = mysql_num_rows($chk_result2);

	if($totalCount == 0){

	}

	


	$k=0;
	while($chk_rows = mysql_fetch_array($chk_result)){
		$no = $totalCount - $start - $k;
		
	?>
				<tr  align="center">
					<td><?=$no?>
					</td>
					<td><?=$chk_rows[driver_name]?>
					</td>
					<td><?=substr($chk_rows[start_day],0,10)?> [<?=substr($chk_rows[start_time],0,10)?>]~[<?=substr($chk_rows[end_time],0,10)?>]
					</td>
					<td><?=$chk_rows[number_limit]?>
					</td>

					<td><?=$chk_rows[car_sort]?>
					</td>
					<td><?=$chk_rows[business_name]?>
					</td>
					<?if($table == "reserve_outchecklist"){
					?>
					<td ><?=$chk_rows[reserve_sort]?></td>
					<?
					}
					?>
					<td><?=$chk_rows[reg_name]?>
					</td>
					<td><?=substr($chk_rows[reg_date],0,10)?>
					</td>
	
					
				</tr>
	<?
		
		$k++;
	}
	if($k==0){
	?>
	<?
	}
	
	?>
			
			</table>

</table>

