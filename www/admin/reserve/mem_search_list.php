<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP -> CLS .'/class.list.php');		
	include_once($GP -> CLS."/class.reserve.php");
	$C_Reserve 	= new Reserve;
	$C_ListClass 	= new ListClass;

	
	$args = array();
	$args['show_row'] = 7;
	$args['pagetype'] = "go_FindStoreList";
	$args['ajax'] = "true";
	$args['page'] = $_POST['page'] == "" ? "1" : $_POST['page'];
	$data = "";
	$data = $C_Reserve->FindMemList(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];	
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
?>
<div id="BoardHead" class="boxBoardHead">				
		<div class="boxMemberBoard_layer">
			<table>						
				<tbody>
					<?
						$dummy = 1;
						for($i=0; $i<$data_list_cnt; $i++) {
							$mb_name 			= $data_list[$i]['mb_name'];
							$mb_code 			= $data_list[$i]['mb_code'];
							$mb_email 			= $data_list[$i]['mb_email'];			
							$mb_mobile 			= $data_list[$i]['mb_mobile'];				
						?>
						<tr>
							<td>
								<input type="radio" name="sel_mem" value="<?=$mb_code?>|<?=$mb_name?>|<?=$mb_mobile?>" />
								<a href="#">[<?=$mb_name?>] <?=$mb_email?></a>  
							</td>								
						</tr>
						 <?
								$dummy++;
							}
						?>						
				</tbody>
			</table>
		</div>			
	</div>
	<ul class="boxBoardPaging">
		<?=$page_link?>
	</ul>
</div>