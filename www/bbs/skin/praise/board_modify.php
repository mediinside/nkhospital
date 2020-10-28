<script type="text/javascript" src="<?=$GP -> JS_SMART_PATH?>/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/resource-pc/js/jquery.base64.js"></script>
<form name="frm_Board" id="frm_Board" action="<?=$get_par?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="jb_password" value="<?=$input_passd;?>">
  <input type="hidden" name="img_full_name" id="img_full_name" value="<?=$jb_img_code;?>" />
  <input type="hidden" name="upfolder" id="upfolder" value="jb_<?=$jb_code?>" />

  <div class="tableType-01 green">
					<table width="100%" class="writeType">
						<colgroup>
							<col width="15%" />
							<col width="*" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="row">제 목</th>
								<td><input type="text" class="txtInput" style="width:578px;" id="jb_title" name="jb_title" value="<?=$jb_title;?>" /></td>
							</tr>
              <tr>
              <th scope="row">구분</th>
              <td><? echo $treat_select = $C_Func -> makeSelect_Normal('jb_treat', $GP -> CLINIC_TYPE_NEW, $jb_treat, ' style="border:1px solide #ddd; height:27px; line-height:27px;" ', '::선택::');?></td>
            </tr>							
							<tr>
								<th scope="row">작성자</th>
								<td>
									<input type="text" class="txtInput" style="width:228px;" id="jb_name"  name="jb_name" value="<?=$jb_name;?>" />
								</td>
							</tr>							
							<tr>
								<th scope="row">이메일</th>
								<td>
									<input type="text" class="txtInput" id="jb_email" name="jb_email" value="<?=$jb_email;?>" style="width:578px;" />
								</td>
							</tr>               
							<tr>
								<th scope="row">공개여부</th>
								<td>
									<span class="chkBox">
                                    <?
                                    //공지는 관리자만 할 수 있다.
                                    if(isset($check_id) && $check_level >= 9) {
                                    if($jb_order=="50")
                                        $notice_checked=" checked";
                                    else
                                        $notice_checked="";											
                                    echo "<label class='noti'><input type=\"checkbox\" name=\"jb_notice_check\" value=\"Y\" class='chk' ${notice_checked}>공지</label>";
                                    }
                                    ?>									
									</span>
								</td>
							</tr>
							<tr>
								<th scope="row" class="viewLink">링크</th>
								<td>
									<input type="text" class="txtInput" style="width:578px;" id="jb_homepage" name="jb_homepage" value="<?=$jb_homepage;?>" />
								</td>
							</tr>
							<tr>
								<th scope="row" class="viewFile"><span class="icon">첨부파일</span></th>
								<td>
									<ul>
										<li>
                      <?php
                      //첨부파일의 숫자는 $i의 범위로 조정하면 된다.
                      for($i=0; $i<1; $i++) {
                      ?>						
                          <span class="inputFile">
                          <input type="text" class="txt" placeholder="첨부파일" readonly />
                          <span class="fileBtn">
                              <input type="file" title="파일선택" name="jb_file[]" class="fileInput"/>
                              <span class="btnT btnFile">파일선택</span>
                          </span>
                          </span>
                          <?php
                          if($ex_jb_file_name[$i]){
                              $code_file = $GP->UP_IMG_SMARTEDITOR. "/jb_${jb_code}/${ex_jb_file_code[$i]}";							
                              echo "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">$ex_jb_file_name[$i]</a>";
                              echo " <input type=\"checkbox\" name=\"del_file[${i}]\" value=\"Y\"> X(체크 후 수정 버튼 누르면 삭제 됩니다.)";				
                          }			
                          ?>					
                      <?
                      } 
                      ?>
  
										</li>
									</ul>
								</td>
							</tr>
							<tr>
								<th scope="row" class="alignTop">본문</th>
								<td>
									<!-- Text Editor 영역 -->
									<textarea name="jb_content" id="jb_content" style="display:none"></textarea>
									<textarea name="ir1" id="ir1"
										style="width:100%; height:300px; min-width:280px; display:none;"><?=$jb_content;?></textarea>
									<!-- // Text Editor 영역 끝 -->
								</td>
							</tr>
							<tr>
								<th scope="row">자동입력방지</th>
								<td>
									<img src="/bbs/zmSpamFree/zmSpamFree.php?zsfimg=1603706232" id="zsfImg"
										alt="아래 새로고침을 클릭해 주세요." />
									<input type="text" id="zsfCode" class="txtInput" name="zsfCode" maxlength="10" size="8">
									<a title="새로고침" href="#"
										onclick="document.getElementById('zsfImg').src='/bbs/zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime(); return false;">새로고침</a>
								</td>
							</tr>
						</tbody>
					</table>
					<div id="btn-box" class="center">
						<a href="#none" class="btn bg-deepblue" id="img_submit">확인</a>
						<a href="#none" href="javascript:history.go(-1);" class="btn bg-red">취소</a>
					</div>
				</div>
</form>
<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir1",
		sSkinURI: "/bbs/smarteditor/SmartEditor2Skin.html",
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

	$('#img_submit').click(function(){
		
		if($('#jb_title').val() == '')	{
			alert('제목을 입력하세요');
			$('#jb_title').focus();
			return false;
		}		
		
		if($('#jb_name').val() == '')	{
			alert('작성자를 입력하세요');
			$('#jb_name').focus();
			return false;
		}
		
		if($('#jb_password').val() == '')	{
			alert('비밀번호를 입력하세요');
			$('#jb_password').focus();
			return false;
		}
		
		/*if($('#jb_email').val() == '' || !CheckEmail($('#jb_email').val()))	{
			alert('이메일을 정확히 입력하세요');
			$('#jb_email').focus();
			return false;
		}*/
       
		
		if($('#zsfCode').val() == '')	{
			alert('자동방지 입력키를 입력하세요');
			$('#zsfCode').focus();
			return false;
		}		
		
		oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
        
	
		var con	= $('#ir1').val();
		$('#jb_content').val(con);		

		if($('#jb_content').val() == '')
		{
			alert('내용을 입력하세요');
			return false;
		}	
       
		var t = $.base64Encode($('#ir1').val());		
		$('#jb_content').val(t);

		$('#frm_Board').submit();
		return false;
		
	});

	function CheckEmail(str)
	{
	   var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	   if (filter.test(str)) { return true; }
	   else { return false; }
	}	
	
	function insertIMG(filename){
		var tname = document.getElementById('img_full_name').value;

		if(tname != "")
		{
			document.getElementById('img_full_name').value = tname + "," + filename;
		}
		else
		{
			document.getElementById('img_full_name').value = filename;
		}
	}
</script>
