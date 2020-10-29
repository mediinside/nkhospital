<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<a href="javascript:;" id="kakao-link-btn">
<img src="//developers.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_small.png" width="10px" />
</a>

<script type="text/javascript">
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('97634374c23a55427c514fb41590ad54');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createDefaultButton({
      container: '#kakao-link-btn',
      objectType: 'feed',
      content: {
        title: "뉴고려병원",
        description: '내용, 주로 해시태그',
        imageUrl: document.images[0].src,
        link: {
          webUrl: document.location.href,
          mobileWebUrl: document.location.href
        }
      }
    });
  //]]>
</script>