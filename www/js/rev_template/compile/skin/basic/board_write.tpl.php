<?php /* Template_ 2.2.7 2016/03/21 16:27:16 /home/hosting_users/meditest1/www/view/skin/basic/board_write.tpl 000007634 */ ?>
<script type="text/javascript" src="<?php echo $TPL_VAR["edit_path"]?>js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $TPL_VAR["js_path"]?>/admin/jquery.base64.js"></script>
<form name="frm_Board" id="frm_Board" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="W" />
  <div class="bbsWrite">
    <table>
      <caption>게시물 작성<?php echo $TPL_VAR["param"]?></caption>
      <colgroup>
        <col />
        <col />
      </colgroup>
      <tbody>
        <tr>
          <th scope="row">제목</th>
          <td><input type="text" class="txt w100" title="제목 입력" placeholder="제목을 입력해 주세요." id="bl_title" name="bl_title" /></td>
        </tr>
        <tr>
          <th scope="row">작성자</th>
          <td><input type="text" class="txt w100" title="작성자 입력" placeholder="작성자를 입력해 주세요."id="bl_name" name="bl_name" value="<?php echo $TPL_VAR["check_name"]?>" /></td>
        </tr>
        <tr>
          <th scope="row">이메일</th>
          <td><input type="text" class="txt w100" title="이메일 입력" placeholder="이메일을 입력해 주세요." id="bl_email" name="bl_email" value="<?php echo $TPL_VAR["suseremail"]?>" /></td>
        </tr>
        <!--//회원일 경우 비밀번호를 입력할 필요가 없다.-->
<?php if(!$TPL_VAR["check_id"]){?>
        <tr>
          <th scope="row">비밀번호</th>
          <td><input type="text" class="txt w100" title="비밀번호 입력" placeholder="비밀번호를 입력해 주세요." id="bl_password" name="bl_password" /></td>
        </tr>
<?php }else{?>
         	  <input type="hidden" name="bl_password" value="<?php echo $TPL_VAR["password"]?>">
<?php }?>
        <tr>
          <th scope="row">공개여부</th>
          <td>
            <label><input type="checkbox" class="chk" value="Y" id="bl_secret_check" name="bl_secret_check" /> 비밀글</label>
<?php if($TPL_VAR["check_id"]&&$TPL_VAR["check_level"]>= 9){?>
              	<label class='noti'><input type="checkbox" value="Y" id="bl_notice_check" name="bl_notice_check" class='chk'>공지</label>
<?php }?>
          </td>
        </tr>
        <tr>
          <th scope="row">첨부파일</th>
          <td class="files">
           <?php
                //첨부파일의 숫자는 $i의 범위로 조정하면 된다.
                for($i=0; $i<1; $i++) {
                ?>
                <span class="inputFile">
                  <input type="text" class="txt" placeholder="첨부파일" readonly />
                  <span class="fileBtn">
                    <input type="file" title="파일선택" name="file[]" />
                    <span class="btnT btnFile">파일선택</span>
                  </span>
                </span>
			<? } ?>
          </td>
        </tr>
        <tr>
          <th scope="row">본문</th>
          <td>
            <textarea name="bd_content" id="bd_content" style="display:none"></textarea>
            <textarea name="ir1" id="ir1" style="width:100%; height:300px; min-width:280px; display:none;"></textarea>
          </td>
        </tr>      
        <tr>
          <th scope="row">링크</th>
          <td><input type="text" class="txt w100" title="링크 입력" placeholder="링크" id="bl_homepage" name="bl_homepage" /></td>
        </tr>
<?php if($TPL_VAR["check_level"]< 9){?>
        <tr>
          <th scope="row">자동입력방지</th>
          <td>
            <strong class="mobTh">자동입력방지</strong>
            <img src="<?php echo $TPL_VAR["bbs_path"]?>zmSpamFree/zmSpamFree.php?zsfimg=<?php echo $TPL_VAR["time"]?>" id="zsfImg" alt="아래 새로고침을 클릭해 주세요." style="vertical-align:middle;" />
            <input type="text" class="txt" title="자동입력방지 숫자 입력" style="width:60px;" name="zsfCode" id="zsfCode" />
            <a href="#;" class="btnT btnReplace" onclick="document.getElementById('zsfImg').src='<?php echo $TPL_VAR["bbs_path"]?>zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime(); return false;">새로고침</a>
          </td>
        </tr>
<?php }?>
      </tbody>
    </table>
  </div>

  <div class="btnWrap">
    <a href="#;" id="img_submit" class="btnM btnConfirm">글쓰기</a>
    <a href="javascript:history.go(-1);" class="btnM btnCancel">취소</a>
  </div>
  <input type="hidden" name="bl_bruse_check" value="Y" checked>
  <input type="hidden" name="img_full_name" id="img_full_name" />
  <input type="text" name="upfolder" id="upfolder" value="bd_<?php echo $TPL_VAR["bd_code"]?>" />
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
		
		if($('#bl_title').val() == '')	{
			alert('제목을 입력하세요');
			$('#bl_title').focus();
			return false;
		}		
		
		if($('#bl_name').val() == '')	{
			alert('이름을 입력하세요');
			$('#bl_name').focus();
			return false;
		}
		
		if($('#bl_password').val() == '')	{
			alert('비밀번호를 입력하세요');
			$('#bl_password').focus();
			return false;
		}
		
		if($('#bl_email').val() == '' || !CheckEmail($('#bl_email').val()))	{
			alert('이메일을 정확히 입력하세요');
			$('#bl_email').focus();
			return false;
		}
	
		oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
	
		var con	= $('#ir1').val();
		
		
		$('#bd_content').val(con);		

		if($('#bd_content').val() == '' || $('#bd_content').val() == '<br> ')
		{
			alert('내용을 입력하세요');
			return false;
		}	
		var t = $.base64Encode($('#ir1').val());		
		$('#bd_content').val(t);
		
<?php if($TPL_VAR["check_level"]< 9){?>	
		if($('#zsfCode').val() == '')	{
			alert('자동방지 입력키를 입력하세요');
			$('#zsfCode').focus();
			return false;
		}		
<?php }?>
		
		$('#frm_Board').attr("action","/con/action/board_action/<?php echo $TPL_VAR["param"]?>");
		
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
		alert("start");
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