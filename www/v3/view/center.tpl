<div class="subTop2">
    <p class="category"><strong>진료과/의료진</strong> 첨단 의료장비와 전문 의료진들이 최상의 서비스를 제공합니다.</p>
    <nav class="location">
        <div class="depth2">
            <button type="button" class="btn" onclick="locActive();">{gtxt}</button>
            <ul class="list">
                <li><a href="/v3/center.php?depart=A&gubun=A" data-gubun="a">전문센터</a></li>
                <li><a href="/v3/center.php?depart=AB&gubun=B" data-gubun='b'>진료과</a></li>
                <li><a href="/v3/center.php?depart=A&gubun=C" data-gubun='c'>특수클리닉</a></li>
                <li><a href="/v3/doctor.php?depart=A&gubun=A" data-gubun='d'>의료진소개</a></li>
            </ul>
        </div>
        <div class="depth3">
            <button type="button" class="btn" onclick="locActive();">{stxt}</button>
            <ul class="list" style="z-index:9999999;">
               {?gubun=="A"}
               		<!--{@gpa}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=A">{.value_}</a></li>
                    <!--{/}-->
               {: gubun=="B"}
               		<!--{@gpb}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=B">{.value_}</a></li>
                    <!--{/}-->
               {: gubun=="C"}
               		<!--{@gpc}-->
                    	 <li><a href="/v3/center.php?depart={.key_}&gubun=C">{.value_}</a></li>
                    <!--{/}-->
                {/}
               		<!--{@dlist}-->                        
	                    <li class="dlist" style="display:none;"><a href="/v3/detail.php?idx={.code}&gubun=D">{.name}</a></li>
                    <!--{/}-->                    
            </ul>
        </div>
    </nav>
</div>
<div class="vodWrap">
    <div class="vod" style="top:0;left:0;width:100%;min-height:203px; height:auto;" id="play_main">
		 <div class="vlayer" style="width:100%; padding-bottom:56.25%; z-index:7;" id="layer_main">
         	<!--{@list1}-->
            	{?.vd_thumb} 
					<img src="{vdurl}{.vd_thumb}" alt="" style="width:100%; z-index:7; position:absolute; ">                
                {:} 
					<img src="/resource/images/sample2.jpg" alt="" style="width:100%; z-index:7; position:absolute; ">
                {/} 
             <img src="/images/mask_720405.png" alt="" style="width:100%; z-index:8; position:absolute;" id="vstart_main" data-vid="{.vd_uid}">
			<!--{/}-->
        </div>        
    </div>
    <div class="vodLink">
        <p class="share">공유하기</p>
        <span class="link">
            <a href="#" class="btnKakao" data-url="{mainlink}">카카오톡</a>
            <a href="#" class="btnFacebook" data-url="{mainlink}">페이스북</a>
            <a href="#" class="btnUrl" data-url="{mainlink}">URL</a>
        </span>
        <a href="/v3/board.php?code=40" class="btnAsk">의료상담</a>
    </div>
</div>

<section class="section centerHome">
    <h3 class="title">뉴고려병원 {ctxt}{josa}</h3>
    <p class="txt"><!--{@list1}-->{.vd_intro_content}<!--{/}-->
    </p>
	<!--{@list2}-->
    <div class="doctor">
        <div class="docTop">
            <div class="pic">{.dr_img}</div>
            <h2 class="name"><span>{.dr_name}</span> {.dr_ps}	</h2>
            <p class="cate">{.dr_treat}</p>
        </div>
        <div class="tableType1">
            <table class="center">
                <caption>진료시간표</caption>
                <colgroup>
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                    <col style="width:14%;">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">시간</th>
                        <th scope="col">월</th>
                        <th scope="col">화</th>
                        <th scope="col">수</th>
                        <th scope="col">목</th>
                        <th scope="col">금</th>
                        <th scope="col">토</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col">오전</th>
						{.moning_txt}
                        <td rowspan="2">문의</td>
                    </tr>
                    <tr>
                        <th scope="col">오후</th>
                        {.after_txt}
                    </tr>
                    <tr>
                        <th scope="col">비고</th>
                        <!-- <td class="left" colspan="6">{ctxt} 예약문의 031-980-9114</td> -->
                        <td class="left" colspan="6">{.dr_gita}</td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btnWrap">
            <span><a href="/v3/detail.php?idx={.dr_idx}&gubun=D" class="btnType1">상세보기</a></span>
            <!--<span><a href="http://www.nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>-->
            {?gubun=="C"}
            <span><a href="http://nkhospital.net/m/main.html" target="_blank" class="btnType2">진료예약</a></span>
            {:}
            <span><a href="http://nkhospital.net/m/res.process.03.html?dr_idx={.dr_idx}&ptype=s&ct_type={depart}" target="_blank" class="btnType2">진료예약</a></span>
            {/}
        </div>
    </div>
  	<!--{/}-->
</section>

<hr>
	<div class="section">
        <div class="tabMenu">
            <ul id="vod_gubun">
                <li {?!list3}class="active"{/} data-gubun="C"><a href="javascript:void(0)"><span>질환정보</span></a></li>
                <li {?list3}class="active"{/}data-gubun="D"><a href="javascript:void(0)"><span>질환영상</span></a></li>
            </ul>
        </div>
		<!--{?list4}-->
		<section class="relationList" id="board_result">
			<ul> 
	            <!--{@list4}-->
                <li>
                    <a href="?bidx={.jb_idx}&m=v&gubun={gubun}&depart={depart}">
                        <div class="thumb" style="border-color:#e4e4e4;">
                            {.img_src}
                        </div>
                        <div class="cont">
                            <b class="tit">{.title}</b>
                            <span class="txt">{.content}</span>
                            <span class="link">더보기</span>
                        </div>
                    </a>
                </li>
                <!--{/}-->
            </ul>
            <!--<div class="btnWrap" {mbtn}>
                <span><a href="javascript:void(0);" class="btnType1" id="bmore" data-total={bcnt}>더보기 </a></span>
            </div>-->
        </section>           
        <!--{/}-->    
            <section class="relationVod" id="vod_result">
            </section>
            <br />
		
	</div>
<style>
.vod{position:relative;min-height:231px;height:auto;overflow:hidden;} 
.vod iframe,.video-container object,.video-container embed{position:absolute;top:0;left:0;width:100%;} 
</style>
<script>
   var cl1 = "{cl1}";
   var cl2 = "{cl2}";
   var cl3 = "{cl3}";    
   var psize = "3";  
</script>
{?list3}<script>vod_page_load();</script>{/}