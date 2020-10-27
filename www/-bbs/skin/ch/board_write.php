<script type="text/javascript" src="<?=$GP -> JS_SMART_PATH?>/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<form name="frm_Board" id="frm_Board" action="<?=$get_par;?>" method="post" enctype="multipart/form-data">
<fieldset>
	<legend>공지사항 상세</legend>
	<table width="100%" class="writeType">
		<caption>공지사항 상세</caption>
		<colgroup>
			<col width="15%" />
			<col width="*" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="row">제 목</th>
				<td><input type="text" class="txtInput" style="width:578px;" id="jb_title" name="jb_title" /></td>
			</tr>
      <tr>
				<th scope="row">구분</th>
				<td><? echo $treat_select = $C_Func -> makeSelect_Normal('jb_treat', $GP -> CLINIC_TYPE_NEW, $jb_treat, ' style="border:1px solide #ddd; height:27px; line-height:27px;" ', '::선택::');?></td>
			</tr>
			<tr>
				<th scope="row">작성자</th>
				<td><input type="text" class="txtInput" style="width:228px;" id="jb_name" value="<?=$check_name?>" name="jb_name" /></td>
			</tr>
			<?php
			//회원일 경우 비밀번호를 입력할 필요가 없다.
			if(empty($check_id)) {
	 		?>
      <tr>
        <th scope="row">비밀번호</th>
        <td><input type="text" id="jb_password" value="" name="jb_password" style="width:228px;" /></td>
      </tr>
      <?php
			} else {
				$password_key=md5($check_id);	
				$tm=explode(" ",microtime());
				$jb_password=$password_key . $tm[1];
				echo ("<input type=\"hidden\" name=\"jb_password\" value=\"${jb_password}\">");
			}
	  ?>
		<tr>
        <th scope="row">이메일</th>
        <td><input type="text" class="txtInput" id="jb_email" name="jb_email" value="<?=$_SESSION['suseremail']?>" style="width:578px;" /></td>
      </tr>
      <tr>
        <th scope="row">공개여부</th>
        <td>
						<span class="chkBox">		
						<input type="checkbox" value="Y" id="jb_secret_check" name="jb_secret_check" class="checBbs" /><label>비밀글</label>
          	<?
						if(isset($check_id) && $check_level>=9){
							echo "<input type=\"checkbox\" value=\"Y\" id=\"jb_notice_check\" name=\"jb_notice_check\">공지";
						}
						?>
						</span>
					</td>
      </tr>
			<tr>
				<th scope="row" class="viewLink"><span class="icon">링크</span></th>
				<td><input type="text" class="txtInput" style="width:578px;" id="jb_homepage" name="jb_homepage" /></td>
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
							<input type="file" name="jb_file[]" class="fileInput">
						<? } ?>
						</li>
					</ul>
       </td>
      </tr>
			<tr>
        <th scope="row" class="alignTop">본문</th>
        <td><!-- Text Editor 영역 -->
          <textarea name="jb_content" id="jb_content" style="display:none"></textarea>
          <textarea name="ir1" id="ir1" style="width:100%; height:300px; min-width:280px; display:none;"></textarea>
          <!-- // Text Editor 영역 끝 --></td>
      </tr>
      <tr>
        <th scope="row">자동입력방지</th>
        <td><img src="<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?zsfimg=<?php echo time();?>" id="zsfImg" alt="아래 새로고침을 클릭해 주세요." />
          <input type="text" id="zsfCode" name="zsfCode" maxlength="10" size="8">
          <a title="새로고침" href="#" onclick="document.getElementById('zsfImg').src='<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime(); return false;" >새로고침</a></td>
      </tr>			
		</tbody>
	</table>

	<div class="btnWrap mg-t20">
		<div class="btnL">
			<?php
        //글목록버튼
        echo "<a href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&${search_key}&search_keyword=${search_keyword}&page=${page}'\" title='목록보기'><span>목록</span></a>";						
			?>
		</div>
		<div class="btnR">
			<a href="javascript:history.go(-1);"><span>취소</span></a>
			<a href="javascript:;" id="img_submit"  class="bgGray"><span>글쓰기</span></a> 
		</div>
	</div>
</fieldset>
<input type="hidden" name="jb_bruse_check" value="Y" checked>
<input type="hidden" name="img_full_name" id="img_full_name" />
<input type="hidden" name="upfolder" id="upfolder" value="jb_<?=$jb_code?>" />
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
			alert('이름을 입력하세요');
			$('#jb_name').focus();
			return false;
		}
		
		if($('#jb_password').val() == '')	{
			alert('비밀번호를 입력하세요');
			$('#jb_password').focus();
			return false;
		}
		
		if($('#jb_email').val() == '' || !CheckEmail($('#jb_email').val()))	{
			alert('이메일을 정확히 입력하세요');
			$('#jb_email').focus();
			return false;
		}
		
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
