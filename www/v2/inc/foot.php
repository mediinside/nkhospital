		<footer id="footer">
			<div class="footSns">
				<p class="tit">현재페이지 공유하기</p>
				<a href="javascript:void(0);" class="kakao" id="kakao_share">카카오톡</a>
                <a href="javascript:void(0);" data-toggle="sns_share"  data-service="facebook" data-title="페이스북 SNS공유" class="facebook">페이스북 SNS 공유하기</a>
				<!--<a href="http://www.facebook.com/sharer/sharer.php?u=http://nkhospital.net/v2/&t=뉴고려병원" class="facebook" target="_blank">페이스북</a>-->
				<a href="javascript:void(0);" id="copy_url">URL</a>
			</div>
			<div class="footLink">
				<a href="#" onClick="javascript:page_load('privacy/terms','');">이용약관</a>
				<a href="#" onClick="javascript:page_load('privacy/privacy','');">개인정보취급방침</a>
				<a href="http://nkhospital.net/guide/guide_06_2.html" target="_blank">비급여안내</a>
				<a href="#" onClick="javascript:page_load('privacy/signature','');">고유식별정보</a>
				<a href="#" onClick="javascript:page_load('privacy/infomation','');">영상정보처리방침</a>
				<a href="#" onClick="javascript:page_load('privacy/right','');">환자권리장전</a>
			</div>
			<small class="footCopy">&copy; 2019 NEW Korea Hospital  All right reserved.</small>
			<nav class="footMenu">
				<div class="cate">
					<p class="cateTit">전문센터</p>
					<ul>
                     <?php foreach($GP->NEW_MOBILE_CENTER as $k=>$v) { ?>
                 	   <li><a href="#" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=a');"><?=$v?></a></li>
                    <? } ?>
					</ul>
				</div>
				<div class="cate">
					<p class="cateTit">진료과</p>
					<ul>
                      <?php foreach($GP->NEW_MOBILE_CLINIC as $k=>$v) { ?>
							<li><a href="#" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=b');"><?=$v?></a></li>
                     <? } ?>

					</ul>
				</div>
				<div class="cate">
					<p class="cateTit">특수클리닉</p>
					<ul>
                      <?php foreach($GP->NEW_MOBILE_SPECIAL as $k=>$v) { ?>
							<li><a href="#" onClick="javascript:page_load('doctor','pg=center&depart=<?=$k?>&gubun=c');"><?=$v?></a></li>
                     <? } ?>

					</ul>
				</div>
			</nav>
			<div class="footInfo">
				<p>
					의료법인 인봉의료재단 뉴고려병<br>
					경기도김포시 김포한강3로 283 (우)10086<br>
					대표자: 윤영순<br>
					사업자등록번호: 137-82-06618<br>
					<span class="contact1">대표전화: <a href="tel:0319809114">031-980-9114</a></span><br>
					<span class="contact2">응급실: <a href="tel:0319809119">031-980-9119</a></span><br>
				</p>
				<button type="button" class="btnTop" onclick="docTop();">TOP</button>
				<a href="/" class="btnPc">PC 화면</a>
			</div>
		</footer>
	</div>
</body>
</html>
<script type="text/javascript">
console.log(document.location.href);
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('97634374c23a55427c514fb41590ad54');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createDefaultButton({
      container: '#kakao_share',
      objectType: 'feed',
      content: {
        title: "뉴고려병원",
        description: "뉴고려병원은 의료법인 인봉의료재단 ‘영등포병원’에 이은 제 2의 병원으로 2000년 김포시 장기동에 ‘고려병원’ 으로 개원하여 2009년 김포 한강신도시 장기지구에 ‘뉴고려병원’ 으로 제 2의 도약을 하였습니다.300병상 규모로 신축한 뉴고려병원은 각 전문진료과의 우수한 의료진과 최신의료장비를 바탕으로 전문 의료 서비스를 제공하고 있습니다. 가현산 주변 숲으로 둘러싸인 아름다운 외관과 환자중심으로 설계된 넓고 편안한 병실은 환자분들의 쾌유에 최적의 환경을 제공하고 있습니다. 급격히 변화하는 의료환경의 변화 속에서 특화된 전문 진료센터의 운영을 통해 2011년에는 보건복지부 지정 (지정기간 : 2011.11. 01. ~ 2014.10.31) 대한민국 제 1기 “관절전문병원”으로 선정되었습니다. 또한 2013년에 심혈관/뇌혈관센터를 개설하여 환자들의 소중한 생명을 지켜내고 있습니다.뉴고려병원은 풍부한 임상경험을 바탕으로 전문화된 진료체계를 구축하여 변화하는 의료환경을 선도해가는 대한민국 대표병원으로 도약하겠습니다.",
        imageUrl: document.images[0].src,
        link: {
          webUrl: document.location.href,
          mobileWebUrl: document.location.href
        }
      }
    });
  //]]>
</script>
<input type="hidden" id="copy_text_input" value="http://nkhospital.net/v2/">