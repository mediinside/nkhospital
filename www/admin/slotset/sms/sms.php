

<script language="JavaScript">
<!--

var req;
var sendnum = 0;

function newXMLHttpRequest() {

	var xmlreq = false;

	if (window.XMLHttpRequest) {

		xmlreq = new XMLHttpRequest();

	} else if (window.ActiveXObject) {

		try {
			xmlreq = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				xmlreq = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) { }
		}
	}

	return xmlreq;
}

function processReqChange(param,content) {

	if (req.readyState == 4) {

		if (req.status == 200) {



			if(req.responseText == 'END') printEnd();
			else printData(param,content);
		} else {

			alert("F5 키를 눌러 새로고침 해주세요!!");
		}
	}
}

function ajaxsend(param,content) {
	req = newXMLHttpRequest();
	req.onreadystatechange = function() { processReqChange(param,content); };
	req.open("POST", "http://cymeditour.com/template/sms/actSms.php", true);
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8'");
	req.send(param+'&content='+encodeURIComponent(content)+'&sendnum='+sendnum);
}



function printData(param,content) {

	document.getElementById("SMSRESULT").innerHTML = req.responseText;
	sendnum++;
	sendSMS(param,content)
}

function printEnd() {
	te = document.getElementById("SMSRESULT").innerHTML
	te = te + req.responseText;
	sendnum = 0;
}

function sendSMS(param,content) {


	//param = param + '&content=' +encodeURIComponent(content)+'&sendnum='+sendnum;

//	alert(param);
	document.getElementById('S1').disabled= true;
	document.getElementById('S2').disabled= true;
	document.getElementById('S3').disabled= true;
	document.getElementById('S4').disabled= true;
	document.getElementById('DISABLE').style.display='';
	document.getElementById('SENDSMS').style.display='';

	ajaxsend(param,content);
}

function chkLen(maxlen,field) {

	var temp;
	var msglen = maxlen*2;
	var value= field.value;

	getsize =  field.value.length;

	tmpstr = "" ;

	if (getsize == 0) {
		value = maxlen*2;
	} else {
		for(k=0;k<getsize;k++) {
			 temp =value.charAt(k);

			if (escape(temp).length > 4) {
				msglen -= 2;
			} else {
			 msglen--;
			}

			if(msglen < 0) {

				alert("총 영문 "+(maxlen*2)+"자 한글 " + maxlen + "자 까지 작성하실 수 있습니다.");
				field.value= tmpstr;
				break;
			} else {
				tmpstr += temp;
			}
			document.getElementById('msglen').innerHTML = (maxlen *  2) - parseInt(msglen) + ' / '+ (maxlen*2)+ ' Bytes'
		}
	}
}

function selectCondition(val) {
	form.sel_condition.value = val;

	if(val == "all") {
		ALL.style.display = "";
		PRIVATE.style.display = "none";
	}
	
	else if(val == "private") {
		ALL.style.display = "none";
		PRIVATE.style.display = "";
	}
	
}
//-->
</script>
<Link rel="stylesheet" type="text/css" href="http://cymeditour.com/template/sms/style.css">

<body topmargin="0" leftmargin="0">
<div id="DISABLE" style="position:absolute;left:0;top;0;width:100%;height:100%;background-color:black;filter:alpha(Opacity:30,style:0,finishOpacity:100);display:none"></div>
<div id="SENDSMS" style="z-index:0;position:absolute;left:200;top:130;display:none;border:2px solid black;">
	<table border="0" width="200" height="160" bgcolor="white">
	<col align="center">
	<tr>
		<td height="25"><b>SMS 문자 보내기</b></td>
	</tr>
	<tr>
		<td>
			<div id="SMSRESULT"></div>
		</td>
	</tr>
	<tr>
		<td align="center" height="25"><input type="button" class="btn" value="닫기" onClick="document.getElementById('SENDSMS').style.display='none';document.getElementById('DISABLE').style.display='none';document.getElementById('S1').disabled=false;document.getElementById('S2').disabled=false;document.getElementById('S3').disabled=false;document.getElementById('S4').disabled=false;"></td>
	</tr>
	</table>
</div>

<div id="MAIN" style="padding:10 10 10 10">
	<div class="box"><b>SMS 문자 보내기  <a href="<?=$PHP_SELF?>"><font color='blue'>[설정 초기화]</font></a></b></div>
	<div style="margin : 0px 0px 0px 0px; width: 610px;">
		<div class="rt7"></div>
		<div class="rt6"></div>
		<div class="rt5"></div>
		<div class="rt4"></div>
		<div class="rt3"></div>
		<div class="rt2"></div>
		<div class="rtoutLRline">
			<table width='600' height='' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC' align='center'>
			<form name='form2' method='post' action='./sms/actSms.php' enctype='multipart/form-data'>

			<tr id='ALL' bgcolor='#EEEEEE' style='display:none'>
				<td width='70' style='padding : 5 0 5 5'>엑셀 첨부</td>
				<td width='520' bgcolor='#FFFFFF' style='padding : 5 0 5 5'>
					<input type='file' name='upFile' style='width:69%' class='textfield'>
					<input type='submit' style='width:50px; height:18px;' value='등 록' class='btn' onfocus='this.blur();'>
					<br><br><font color='blue'>엑셀파일은 xls파일로 저장하세요!!</font> <a href="/template/phpExcelReader/test.xls" target="_blank"><font color='red'>[엑셀 파일 샘플]</a></font>

				</td>
			</tr>
			</form>
			<form name='form' method='post'>
			<input type='hidden' name='flag' value='<?=$flag?>'>
			<input type='hidden' name='user_id'>
			
			<tr bgcolor='#EEEEEE'>
				<td width='70' style='padding : 5 0 5 5'>발송조건</td>
				<?if($filename!=""){
					?>
					<input type="hidden" name="sel_condition" value="all">
					<td bgcolor='#FFFFFF' style='padding : 5 0 5 5' colspan='3'>
					<input type="radio" name='condition' value='all' onFocus='this.blur();' onClick="selectCondition(this.value)" checked>엑셀발송
					<!--<input type="radio" name='condition' value='lecture' onFocus='this.blur();' onClick="selectCondition(this.value)">강좌별발송-->
					<input type="radio" name='condition' value='private' onFocus='this.blur();' onClick="selectCondition(this.value)" >개별발송
					<!--<input type="radio" name='condition' value='prof' onFocus='this.blur();' onClick="selectCondition(this.value)">강사발송-->
				</td>
					<?
				}
				else{

				?>
				<input type="hidden" name="sel_condition" value="private">
				<td bgcolor='#FFFFFF' style='padding : 5 0 5 5' colspan='3'>
					<input type="radio" name='condition' value='all' onFocus='this.blur();' onClick="selectCondition(this.value)">엑셀발송
					<!--<input type="radio" name='condition' value='lecture' onFocus='this.blur();' onClick="selectCondition(this.value)">강좌별발송-->
					<input type="radio" name='condition' value='private' onFocus='this.blur();' onClick="selectCondition(this.value)" checked>개별발송
					<!--<input type="radio" name='condition' value='prof' onFocus='this.blur();' onClick="selectCondition(this.value)">강사발송-->
				</td>
				<?
				}
				?>
			</tr>
			<tr id='LECTURE1' bgcolor='#EEEEEE' style='display:none'>
				<td width='70' style='padding : 5 0 5 5'>강좌선택</td>
				<td width='220' bgcolor='#FFFFFF' style='padding : 5 0 5 5'>
					<?
					$que_subject = MYSQL_QUERY("SELECT subject_name, subject_code FROM lecture_subject ORDER BY subject_name");
					$num_subject = MYSQL_NUM_ROWS($que_subject);
					?>
					<select id='S1' name='subject_code' class='font_small' onChange="SUBJECT.selectSubject(this.options[this.selectedIndex].value);">
						<option value=''>---과목선택---</option>
						<?
						for($i = 0; $i < $num_subject; $i++) {
							$row_subject = MYSQL_FETCH_ARRAY($que_subject);
						?>
						<option value='<?=$row_subject['subject_code']?>' <?if($subject_code == $row_subject['subject_code']) echo "selected";?>><?=strip_tags($row_subject['subject_name'])?></option>
						<?}?>
					</select>
				</td>
				<td width='70' style='padding : 5 0 5 5'>과정</td>
				<td width='220' bgcolor='#FFFFFF' style='padding : 5 0 5 5'>
					<select id='S2' name='course_code' class='font_small' onChange="STATE.selectState(this.options[this.selectedIndex].value, state.options[state.selectedIndex].value);">
						<option value=''>---과정선택---</option>
					</select>
				</td>
			</tr>
			<tr id='LECTURE2' bgcolor='#EEEEEE' style='display:none'>
				<td width='70' style='padding : 5 0 5 5'>강좌명</td>
				<td bgcolor='#FFFFFF' colspan='4' style='padding : 5 0 5 5'>
					<select id='S3' name='state' class='font_small' onChange="STATE.selectState(course_code.options[course_code.selectedIndex].value, this.options[this.selectedIndex].value);">
						<option value='A'>전체</option>
						<option value='Y' selected>사용</option>
						<option value='N'>미사용</option>
						<option value='H'>사용중지</option>
					</select>
					<select id='S4' name='lecture_code' class='font_small' >
						<option value=''>---강좌선택---</option>
					</select>
				</td>
			</tr>
						
			<?if($filename!=""){
					?>
			<tr id='PRIVATE' bgcolor='#EEEEEE'>
				<td width='70' style='padding : 5 0 5 5'>엑셀 파일</td>
				<td width='520' bgcolor='#FFFFFF' style='padding : 5 0 5 5' colspan='3'><input type="text" name='phonenum' value='<?=$filename?>' class='textfield' readonly></td>
			</tr>
			<?
			}
			else{
			?>
			<tr id='PRIVATE' bgcolor='#EEEEEE'>
				<td width='70' style='padding : 5 0 5 5'>발송번호</td>
				<td width='520' bgcolor='#FFFFFF' style='padding : 5 0 5 5' colspan='3'><input type="text" name='phonenum' value='<?=$mobileNo?>' class='textfield'></td>
			</tr>
			<?
			}
			?>
			<tr>
				<td colspan="4" bgcolor="white" align="center" style="padding-bottom:5px">
					<div align="center">
						<!-- <div style="margin-top:10px" class='font_small'>총 000명에게 발송합니다.</div> -->
						<div style="margin-top:10px"><textarea name="content" style="width:240; height:80" class="textfield" onKeyUp="chkLen(40,this);" onChange="chkLen(40,this);"></textarea>
						<div id="msglen" class='font_small'>0 / 80 Byte</div></div>
						<div style="margin-top:10px" class='font_small'> 회신번호 <input type="text" style='width:85px;' class="textfield" value='07042728896' name="from"></div>
						<div style="margin-top:10px"><input type="button" value="SMS발송" class='btn' onFocus='this.blur();' onClick="if(confirm('전송하시겠습니까?')) { sendSMS('condition='+form.sel_condition.value+'&lecture_code='+form.lecture_code.value+'&phonenum='+form.phonenum.value+'&from='+form.from.value,form.content.value);}">
						</div>
					</div>
				</td>
			</tr>
			</form>
			
			</table>

		</div>
		<div class="rt2"></div>
		<div class="rt3"></div>
		<div class="rt4"></div>
		<div class="rt5"></div>
		<div class="rt6"></div>
		<div class="rt7"></div>
	</div>
</div>
