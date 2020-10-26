<?php /* Template_ 2.2.8 2020/10/26 06:02:56 C:\xampp\htdocs\newkorea\www\v3\view\inc\foot.tpl 000003336 */ 
$TPL_gpa_1=empty($TPL_VAR["gpa"])||!is_array($TPL_VAR["gpa"])?0:count($TPL_VAR["gpa"]);
$TPL_gpb_1=empty($TPL_VAR["gpb"])||!is_array($TPL_VAR["gpb"])?0:count($TPL_VAR["gpb"]);
$TPL_gpc_1=empty($TPL_VAR["gpc"])||!is_array($TPL_VAR["gpc"])?0:count($TPL_VAR["gpc"]);?>
<footer id="footer">
    <div class="footSns">
        <p class="tit">현재페이지 공유하기</p>
        <a href="javascript:void(0);" class="kakao" id="kakao_share">카카오톡</a>
        <a href="javascript:void(0);" data-toggle="sns_share"  data-service="facebook" data-title="페이스북 SNS공유" class="facebook">페이스북 SNS 공유하기</a>
        <!--<a href="http://www.facebook.com/sharer/sharer.php?u=http://nkhospital.net/v2/&t=뉴고려병원" class="facebook" target="_blank">페이스북</a>-->
        <a href="javascript:void(0);" id="copy_url">URL</a>
    </div>
    <div class="footLink">
        <a href="/v3/agree.php?tab=terms">이용약관</a>
        <a href="/v3/agree.php?tab=privacy">개인정보취급방침</a>
        <a href="http://nkhospital.net/guide/guide_06_2.html" target="_blank">비급여안내</a>
        <a href="/v3/agree.php?tab=signature">고유식별정보</a>
        <a href="/v3/agree.php?tab=infomation">영상정보처리방침</a>
        <a href="/v3/agree.php?tab=right">환자권리장전</a>
    </div>
    <small class="footCopy">&copy; 2019 NEW Korea Hospital  All right reserved.</small>
    <nav class="footMenu">
        <div class="cate">
            <p class="cateTit">전문센터</p>
            <ul>
<?php if($TPL_gpa_1){foreach($TPL_VAR["gpa"] as $TPL_K1=>$TPL_V1){?>
               <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=A" <?php if($TPL_K1=="I"){?>class="ftColor0"<?php }?>><?php echo $TPL_V1?></a></li>
<?php }}?>
            </ul>
        </div>
        <div class="cate">
            <p class="cateTit">진료과</p>
            <ul>
<?php if($TPL_gpb_1){foreach($TPL_VAR["gpb"] as $TPL_K1=>$TPL_V1){?>
               <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=B"><?php echo $TPL_V1?></a></li>
<?php }}?>
			</ul>
        </div>
        <div class="cate">
            <p class="cateTit">특수클리닉</p>
<?php if($TPL_gpc_1){foreach($TPL_VAR["gpc"] as $TPL_K1=>$TPL_V1){?>
               <li><a href="/v3/center.php?depart=<?php echo $TPL_K1?>&gubun=C"><?php echo $TPL_V1?></a></li>
<?php }}?>
            </ul>
        </div>
    </nav>
    <div class="footInfo">
        <p>
            의료법인 인봉의료재단 뉴고려병원<br>
            경기도김포시 김포한강3로 283 (우)10086<br>
            대표자: 윤영순<br>
            사업자등록번호: 137-82-06618<br>
            <span class="contact1">대표전화: <a href="tel:0319809114">031-980-9114</a></span><br>
            <span class="contact2">응급실: <a href="tel:0319809119">031-980-9119</a></span><br>
             <span class="contac1">원무과 팩스: 031-982-9800</span><br></p>
        <button type="button" class="btnTop" onclick="docTop();">TOP</button>
        <a href="/" class="btnPc">PC 화면</a>
    </div>
</footer>
<input id="copyurl" style="display:none;"/>