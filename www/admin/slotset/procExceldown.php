<?
//session_start();

session_start();
include "../inc/dbConn.php";
include "../inc/chkLogin.php";
include "../inc/func.php";
$today = date("Ymd");
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


<table width='100%' height='' border='1' cellpadding='0' cellspacing='1' align='center' bgcolor='#CCCCCC'>
<tr align="center" bgcolor="#eeeeee" height="40">
		<th width="5%">��ȣ</th>
		<th width="10%">�����</th>
		<th width="10%">��������׸�</th><!---->
		<th width="10%">��������</th><!---->
		<th width="10%">���೯¥</th>
		<th width="10%">����ð�</th><!---->
		<th width="10%">��ġ</th><!---->
		<th width="10%">����</th>
		<th width="10%">�����</th>
		<th width="10%">�����ȣ</th>
		<th width="10%">�μ���</th>
		<th width="10%">���ο���</th>
		<th width="10%">�ֹι�ȣ</th>
		<th width="10%">�޴��ȣ</th>
		<th width="10%">�̸���</th>
		<th width="10%">�ּ�</th>
		<th width="300">�߰������׸�</th>
		<th width="10%">�ڸ�Ʈ</th>
		<th width="10%">������Ʈ</th>
		<!--<th width="15%">�߰������׸�</td>-->
		<th width="10%">�����</th>
		<!--<td>�����</td>-->
</tr>
<?
#���� üũ
	#���� üũ
	$numPerPage		=	$listNum ? $listNum : 50;				// �Խ��� ����Ʈ ��¼�
	$pagePerList	=	$pagePerList ? $pagePerList : 10;	// �Խ��� ����¡ �����
	$pageNum		=	$pageNum ? $pageNum : 1;
	$start			=	($pageNum - 1) * $numPerPage;
	$searchQuery	=	"dir=".$dir."&menu=".$menu."&tbl=".$tbl."&field=".$field."&keyword=".$keyword."&listNum=".$listNum."&column=".$column."&order=".$order.$searchQuery;	// ������ �̵��� ����Ʈ ������

	if($search_name2 == "" && $search_name3==""){
		$search_name2 = $today;
		$search_name3 = $today;
	}
	$where = "";
	if($search_name_1 != "" && $search_name_2 != ""){#�ֹι�ȣ �˻���
		$search_name = $search_name_1."-".$search_name_2;
	}

	//echo $search_date;
	//echo $search_date;
	if($search_name2 != "" && $search_date != "all"){
		$where  = "and left(reserve_day,10) between '$search_name2' and '$search_name3'";
	}
	if($search_name != ""){
		$where  .= " and $search_field like '%$search_name%'";
	}
	if($search_name4 != ""){
		if($search_name4 == "item1"){
			$where  .= " and reserve_type0 = 'Y'";
			
		}
		else if($search_name4 == "item2"){
			$where  .= " and reserve_type5 = 'Y'";
			
		}
		else if($search_name4 == "item3"){
			$where  .= " and (reserve_type16 = 'Y' || reserve_type17 = 'Y' || reserve_type18 = 'Y' || reserve_type19 = 'Y' || reserve_type20 = 'Y' || reserve_type21 = 'Y')";
			
		}
		else if($search_name4 == "item4"){
			$where  .= " and (reserve_type23 = 'Y' || reserve_type24 = 'Y')";
			
		}
		else if($search_name4 == "item5"){
			$where  .= " and reserve_type25 = 'Y'";
			
		}
		else if($search_name4 == "item6"){
			$where  .= " and reserve_type26 = 'Y'";
			
		}
		else if($search_name4 == "item7"){
			$where  .= " and reserve_type15 = 'Y'";
			
		}
		else if($search_name4 == "item8"){
			$where  .= " and reserve_type13 = 'Y'";
			
		}
		else if($search_name4 == "item9"){
			$where  .= " and reserve_type27 = 'Y'";
			
		}
	}
	if($search_field == "jumin_no"){
		$jumin_nos = $jumin1."-".$jumin2;
		$where .= " and jumin_no='".$jumin_nos."' ";
	}

	if($search_field == "reserve_place"){
		
		$where .= " and place='".$place."' ";
	}
	//echo $where;
	//echo $search_name;
	$chk_query = "select * from reserve_list_new where view_state='Y' $where order by seq desc ";
	//echo $chk_query;
	$chk_result = mysql_query($chk_query);

	$chk_query2 = "select * from reserve_list_new where view_state='Y' $where ";

	//echo $search_field;
	//echo $jumin1;
	$chk_result2 = mysql_query($chk_query2);

	$totalCount = mysql_num_rows($chk_result2);

	

	if($totalCount == 0){

	}


	
	


	$k=0;
	while($chk_rows = mysql_fetch_array($chk_result)){
		$no = $totalCount - $start - $k;
		
		
	?>
				<tr align="center" bgcolor="#FFFFFF">
					<td><?=$no?></td>
					<td><?=$chk_rows[reserve_place]?></td>
					<td><?=$chk_rows[reserve_type_name]?></td>
					<td><?if($chk_rows[reserve_type0] == "Y"){echo "�⺻����";}else{ echo "�Ϲݿ���";}?></td>



					<td><?=substr($chk_rows[reserve_day],0,10)?></td>

					<td><?if($chk_rows[reserve_type0] == "Y"){echo sel_time($chk_rows[reserve_time0]);}else{ echo sel_time($chk_rows[reserve_time27]);}?></td>

					<td><?=$chk_rows[place]?></td>
					
                    <td><?=$chk_rows[reserve_name]?></td>
					<td><?=$chk_rows[reg_id]?>(<?=$chk_rows[reg_name]?>)</td>

					<td><?=$chk_rows[member_no]?></td>
					<td><?=$chk_rows[position]?></td>
					<td><?=$chk_rows[person]?></td>
					<td><?=$chk_rows[jumin_no]?></td>
					<td><?=$chk_rows[mobile_no]?></td>
					<td><?=$chk_rows[email]?></td>
					<td>[<?=$chk_rows[post1]?>-<?=$chk_rows[post2]?>]<?=$chk_rows[addr1]?> <?=$chk_rows[addr1]?></td>
					

					<td>
					<?
						if($chk_rows[reserve_type1] == "Y"){echo "���������Կ� | ";}
						
						if($chk_rows[reserve_type3] == "Y"){echo "�Ϲ��� | ";}
						if($chk_rows[reserve_type4] == "Y"){echo "������ | ";}

						if($chk_rows[reserve_type5] == "Y"){echo "�������(".sel_time($chk_rows[reserve_time5]).") | ";}
						if($chk_rows[reserve_type6] == "Y"){echo "�Ϲݴ���(".sel_time($chk_rows[reserve_time6]).") | ";}

						if($chk_rows[reserve_type7] == "Y"){echo "����CT | ";}
						if($chk_rows[reserve_type8] == "Y"){echo "�� �հ� | ";}


						if($chk_rows[reserve_type9] == "Y"){echo "���� CT | ";}




						if($chk_rows[reserve_type10] == "Y"){echo "��� CT | ";}




						if($chk_rows[reserve_type11] == "Y"){echo "���� CT | ";}
						if($chk_rows[reserve_type12] == "Y"){echo "���κ� | ";}

						if($chk_rows[reserve_type13] == "Y"){echo "VIP(".sel_time($chk_rows[reserve_time13]).") | ";}



						if($chk_rows[reserve_type17] == "Y"){echo "��MRA(".sel_time($chk_rows[reserve_time17]).") | ";}
						if($chk_rows[reserve_type18] == "Y"){echo "MRI MBA(".sel_time($chk_rows[reserve_time18]).") | ";}
						if($chk_rows[reserve_type19] == "Y"){echo "��MRI(".sel_time($chk_rows[reserve_time19]).") | ";}
						if($chk_rows[reserve_type20] == "Y"){echo "����MRI(".sel_time($chk_rows[reserve_time20]).") | ";}
						if($chk_rows[reserve_type21] == "Y"){echo "����MRI(".sel_time($chk_rows[reserve_time21]).") | ";}


						if($chk_rows[reserve_type23] == "Y"){echo "PET-CT(����)(".sel_time($chk_rows[reserve_time23]).") | ";}
						if($chk_rows[reserve_type24] == "Y"){echo "PET-CT(��)(".sel_time($chk_rows[reserve_time24]).") | ";}

						if($chk_rows[reserve_type25] == "Y"){echo "����(".sel_time($chk_rows[reserve_time25]).") | ";}
						if($chk_rows[reserve_type26] == "Y"){echo "����(".sel_time($chk_rows[reserve_time26]).") | ";}

						if($chk_rows[reserve_type15] == "Y"){echo "�����ϸ�(".sel_time($chk_rows[reserve_time15]).") | ";}



						if($rows[reserve_type4] == "Y"){echo "������ | ";}
						if($rows[reserve_type4] == "Y"){echo "������ | ";}
						if($rows[reserve_type4] == "Y"){echo "������ | ";}
						if($rows[reserve_type4] == "Y"){echo "������ | ";}
					?>
					</td>

					<td><?=$chk_rows[comment]?></td>
					<td><?=$chk_rows[black_list]?></td>
					<td><?=substr($chk_rows[reg_date],0,10)?>
					
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

