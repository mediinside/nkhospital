var returnAjaxData = function(string, url, errorDis, rstId){

	var string = string;	//ex &mode=1234
	var url = url; //ex ./proc/setup_proc.php
	var rst = "";
	$.ajax({
		url: url,
		type: 'POST',
		data: string,
		timeout: 1000 * 10000 , //1초동안 응답이 없으면 error처리
		contentTypeString : "text/xml; charset=utf-8",		
		error: function(){
				alert('데이터 전송중 에러가 발생하였습니다.');
		},
		success: function(rstData){
			if(rstId){
				$("#"+rstId).html(rstData);
			}else{
				alert(rstData);
			}
		}
	});
	return;
}

function layerPop (target, src, width, height) {
	 $.modal('<iframe id="layerPop" name="layerPop" src="' + src + '" height="' + height + '" width="' + width + '" frameborder="0" scrolling="no" style="border:0"></iframe>', {
	 	overlayClose:true
	 });
	// $("#" + target).modal();
}


function layerPop_new (target, src, width, height) {
	$('#' + target).remove();
	$("head").append("<link href='/css/_adm/basic.css' rel='stylesheet' type='text/css'>");
	$("head").append("<script type='text/javascript' src='/admin/js/jquery.simplemodal.js'></script>");
	$("body").append("<div id='" + target + "'></div>");

	 $.modal('<iframe id="layerPop" name="layerPop" src="' + src + '" height="' + height + '" width="' + width + '" style="border:0"></iframe>', {
	 	overlayClose:true
	 });
	 $("#" + target).modal();
}


function fnWinPopup(w_url, w_name, w_width, w_height) {
	var w_left = (screen.width-w_width)/2;
	var w_top = (screen.height-w_height)/2;
	var ChkWindow  =  window.open(w_url,w_name,'left='+w_left+', top='+w_top+', width='+w_width+', height='+w_height+', scrollbars=yes, statusbars=no');
	ChkWindow.focus();
}


function modalclose()
{
	$.modal.close();
}


var imgExtCheck = function(obj) {
	//	e_thumb_img
	//alert('선택한 파일은 '+ event.srcElement.value + '입니다');
  if( !event.srcElement.value.match(/(.jpg|.jpeg|.gif|.png)/)) {
		alert('이미지 파일만 업로드 가능합니다.');
		return;
  }
}

// 라디오 버튼값 확인하기
var checkRadioValue = function(obj) {
	for (i=0; i<obj.length; i++)
	{
		if (obj[i].checked)
		{
			return obj[i].value;
		}
	}
	return false;
}

// 이메일 유효성 체크
var checkEmail = function(str){
	var reg = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
	if (str.search(reg) != -1) {
		return true;
	}
	return false;
}


var noSpecialStr = function (obj) {
	var onvalue = obj.value;

  count=0
  for (i=0;i<onvalue.length;i++) {
    ls_one_char = onvalue.charAt(i);

    if(ls_one_char.search(/[0-9|a-z|A-Z|ㄱ-ㅎ|ㅏ-ㅣ|가-힝]/) == -1) {
   count++
    }
  }
  if(count!=0) {
  	result = false;
  } else {
  	result = true;
  }
	return result;

}


function CheckEmail(str)
{
	 var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	 if (filter.test(str)) { return true; }
	 else { return false; }
}

function setCookie( name, value, expiredays ) { 
 var todayDate = new Date(); 
 if (expiredays == null){
	expiredays = 30;
 }
 todayDate.setDate( todayDate.getDate() + expiredays ); 
 document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
}

//Alert
function alertBox(txt, callbackMethod, jsonData){
    modal({
        type: 'alert',
        title: '알림',
        text: txt,
        callback: function(result){
            if(callbackMethod){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function alertBoxFocus(txt, obj){
    modal({
        type: 'alert',
        title: '알림',
        text: txt,
        callback: function(result){
            obj.focus();
        }
    });
}
 
    
function confirmBox(txt, callbackMethod, jsonData){
    modal({
        type: 'confirm',
        title: '알림',
        text: txt,
        callback: function(result) {
            if(result){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function promptBox(txt, callbackMethod, jsonData){
    modal({
        type: 'prompt',
        title: 'Prompt',
        text: txt,
        callback: function(result) {
            if(result){
                callbackMethod(jsonData);
            }
        }
    });
}
 
function successBox(txt){
    modal({
        type: 'success',
        title: 'Success',
        text: txt
    });
}
 
function warningBox(txt){
    modal({
        type: 'warning',
        title: 'Warning',
        text: txt,
        center: false
    });
}
 
function infoBox(txt){
    modal({
        type: 'info',
        title: 'Info',
        text: txt,
        autoclose: true
    });
}
 
function errorBox(txt){
    modal({
        type: 'error',
        title: 'Error',
        text: txt
    });
}
 
function invertedBox(txt){
    modal({
        type: 'inverted',
        title: 'Inverted',
        text: txt
    });
}
 
function primaryBox(txt){
    modal({
        type: 'primary',
        title: 'Primary',
        text: txt
    });
}
//Alter End

function showObj(obj) {
	var str = "";
	for(key in obj) {
		str += key+"="+obj[key]+"\n";
	}

	alert(str);
	return;
}

function countdown( elementName, minutes, seconds , state)
{
    var element, endTime, hours, mins, msLeft, time;
	var timer_id = 0;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
		//alert(timer_id);
        msLeft = endTime - (+new Date);
		//alert(msLeft);
        if ( msLeft < 0 ) {
            $("#"+elementName+"_p").attr("placeholder","요청하신 시간이 만료되었습니다.");
			$("#confirmNo_p").prop('disabled',true);
			return false;
		//	$("#confirmTo").html("인증번호 발송");
		//	clearInterval(timer_id);
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();

			$("#"+elementName).html((hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds()) );
			
//            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            timer_id = setInterval( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }
	
    //element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}


function wrapWindowByMask(){
		var maskHeight = $(document).height();  
		var maskWidth = $(window).width();
		$('#mask').css({'width':maskWidth,'height':maskHeight});  
        $('#mask').fadeTo("fast",0.5);    
}
