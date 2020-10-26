<?php
	ini_set('allow_url_fopen', 'On');
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.video.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Video 	= new Video;
	$C_Button 		= new Button;
	
	//error_reporting(E_ALL);
	//@ini_set("display_errors", 1);

	$args = array();
	$args['show_row'] = 50;
	$args['pagetype'] = "admin";
	$args['excel_file']		= $_GET['excel_file'];
	$args['excel']			= $excelHanArr;		
	if($_GET["vd_tgubun"] == "a"){
		$args["vd_clinic1"] = $_GET["vd_clinic"];
		$cn_select = $C_Func -> makeSelect_Normal('vd_clinic', $GP -> NEW_MOBILE_CENTER, $_GET['vd_clinic'], '', '::선택::');			
	}else if($_GET["vd_tgubun"] == "b"){
		$args["vd_clinic2"] = $_GET["vd_clinic"];	
		$cn_select = $C_Func -> makeSelect_Normal('vd_clinic', $GP -> NEW_MOBILE_CLINIC, $_GET['vd_clinic'], '', '::선택::');			
	}else if($_GET["vd_tgubun"] == "c"){
		$args["vd_clinic3"] = $_GET["vd_clinic"];		
		$cn_select = $C_Func -> makeSelect_Normal('vd_clinic', $GP -> NEW_MOBILE_SPECIAL, $_GET['vd_clinic'], '', '::선택::');			
	}else{
		$cn_select = $C_Func -> makeSelect_Normal('vd_clinic', $GP -> NEW_MOBILE_CENTER, $_GET['vd_clinic'], '', '::선택::');			
	}
	$data = "";
	$data = $C_Video->Video_List(array_merge($_GET,$_POST,$args));
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	

	$start_num = $data['page_info']['start_num'];
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
										
			<form name="base_form" id="base_form" method="GET">
			<ul>
                <strong class="tit">진료과목</strong>
                <span>
                	<select name="vd_tgubun" id="vd_tgubun">
                    	<option value="a" <? if($vd_tgubun == "a") echo "selected";?>>전문센터</option>
                    	<option value="b" <? if($vd_tgubun == "b") echo "selected";?>>진료과</option>
                    	<option value="c" <? if($vd_tgubun == "c") echo "selected";?>>특수클리닉</option>
					</select>                                                                        
                </span>
                <span>
                	<?=$cn_select?>                                                                      
                </span>                
            				
				<li>
					<strong class="tit">검색조건</strong>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="vd_title" <? if($_GET['search_key'] == "vd_title"){ echo "selected";}?> >제목</option>
						<option value="vd_dr_name" <? if($_GET['search_key'] == "vd_dr_name"){ echo "selected";}?> >의사명</option>                        
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="16" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>	
				</li>
			</ul>
			</form>
			</div>
		</div>		
		<div class="btnWrap">
			<!--<p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p>-->
			<button onClick="layerPop('ifm_reg','./vd_reg.php', '100%', 700)"; class="btnSearch btnRight">동영상 등록</button>
		</div>
    
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<colgroup>
							<col />
							<col />
							<col />
							<col />
							<col />
							<col />
							<col style="width:55px;" />
							<col style="width:55px;" />
							<col style="width:80px;" />
						</colgroup>
						<thead>
							<tr>
								<th>No</th>								
								<th>제목</th>
								<th>의사</th>                                
								<th>진료센터</th>	
								<th>진료과</th>								
								<th>특수클리닉</th>								
								<!--<th>YOUTUBE</th>-->
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$vd_idx 			= $data_list[$i]['vd_idx'];
									$vd_title			= $data_list[$i]['vd_title'];
									$vd_dr_name		= $data_list[$i]['vd_dr_name'];
									$vd_regdate 		= $data_list[$i]['vd_regdate'];		
									$vd_clinic1 	= $data_list[$i]['vd_clinic1'];
									$vd_clinic2 	= $data_list[$i]['vd_clinic2'];
									$vd_clinic3		= $data_list[$i]['vd_clinic3'];	
									$vd_link1		= $data_list[$i]['vd_link1'];
									$you_link = "X";
									/*if($vd_link1) {
										$you_id = explode("watch?v=",$vd_link1);
										$you_id = $you_id[1];
										$youtube_link = file_get_contents("http://youtube.com/get_video_info?video_id=".$you_id);
										parse_str($youtube_link, $data);
										if($data["status"] == "ok") $you_link = "O";
									}
									*/
									$cn_arr1 = explode(",", $vd_clinic1);
									$cn_arr2 = explode(",", $vd_clinic2);
									$cn_arr3 = explode(",", $vd_clinic3);
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./vd_edit.php?vd_idx=" . $vd_idx. "', '100%', 700)", 50,'');	
									$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"vd_delete('" . $vd_idx. "')", 50,'');									
								?>
										<tr>
											<td><?=$start_num--?></td>											
											<td><?=$vd_title?></td>
                                           <td><?=$vd_dr_name?></td>	
											<td>
												<?
													$str = "";
													foreach ($cn_arr1 as $key => $val) {
														$str .= $GP -> NEW_MOBILE_CENTER[$val] . ",";
													}
													echo rtrim($str , ",");
												?>
											</td>                                           																					
											<td>
												<?
													$str = "";
													foreach ($cn_arr2 as $key => $val) {
														$str .= $GP -> NEW_MOBILE_CLINIC[$val] . ",";
													}
													echo rtrim($str , ",");
												?>
											</td>
											<td>
												<?
													$str = "";
													foreach ($cn_arr3 as $key => $val) {
														$str .= $GP -> NEW_MOBILE_SPECIAL[$val] . ",";
													}
													echo rtrim($str , ",");
												?>
											</td>
											<!--<td align="center"><?=$you_link?></td>-->
											<td><?=$edit_btn?></td>
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
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->


</body>
</html>

 
<script type="text/javascript">

	
		
	$(document).ready(function(){		
	//엑셀 출력
		$('#excel_btn').click(function(){
				var string = $("#base_form").serialize();
				location.href = "?excel_file=non_pay" + "&" + string;
				return false;
		});														 
														 
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
		callDatePick('s_date');
		callDatePick('e_date');

		$('#search_submit').click(function(){																			 

			if($.trim($('#search_content').val()) != '')
			{
				if($('#search_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#search_key option:selected').val() != '')
			{
				if($.trim($('#search_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#search_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
		});
		
		$(document).on("change","#vd_tgubun",function(){
			var gubun = $(this).val();
			var html = "<option value=''>::선택::</option>>";
			$.ajax({
				type: "POST",
				url: "center_ajax.php",
				data: "gubun="+gubun,
				dataType: "json",
				beforeSend: function() {
				},  			
				success: function(data) {
					$.each(data, function(entryIndex, entry) {
						html += '<option value="'+entry["code"].toUpperCase()+'">'+entry["name"]+'</option>';
					});
					$("#vd_clinic").empty().append(html);
				},
				error: function(xhr, status, error) { alert(error); }
			});		
		});		

	});

	function vd_delete(vd_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/vd_proc.php",
			data: "mode=VIDEO_DEL&vd_idx=" + vd_idx,
			dataType: "text",
			success: function(msg) {
				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
					alert('삭제에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});

	}
</script>