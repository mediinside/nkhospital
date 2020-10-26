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
             <!--{@gpa}-->
               <li><a href="/v3/center.php?depart={.key_}&gubun=A" {?.key_=="I"}class="ftColor0"{/}>{.value_}</a></li>
			 <!--{/}-->
            </ul>
        </div>
        <div class="cate">
            <p class="cateTit">진료과</p>
            <ul>
              <!--{@gpb}-->
               <li><a href="/v3/center.php?depart={.key_}&gubun=B">{.value_}</a></li>
			 <!--{/}-->
			</ul>
        </div>
        <div class="cate">
            <p class="cateTit">특수클리닉</p>
             <!--{@gpc}-->
               <li><a href="/v3/center.php?depart={.key_}&gubun=C">{.value_}</a></li>
			 <!--{/}-->
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