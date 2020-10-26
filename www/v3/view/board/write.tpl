{#btop}
<h2 class="pageTitle write">{ttxt|</h2>
<div class="section">
<form id="bform" name="bform" method="post" enctype="multipart/form-data">
    <input type="hidden" name="jb_code" value="{jbcode}" />
    <input type="hidden" name="jb_secret_check" value="{secret}" />    
    <input type="hidden" name="mode" value="{mode}" />    
        <table class="boardWrite">
            <caption>전문의 상담 작성</caption>
                <tbody>
                    <!--{?jbcode == "40"}-->
                    <tr>
                        <th scope="row">진료과목<span class="essential">*</span></th>
                        <td>
                            <span class="formRow">
                                <span class="cell">
                                    <select name="jb_tgubun" id="jb_tgubun">
                                        <option value="a" {?jb_tgubun == "a"}selected{/}>전문센터</option>
                                        <option value="b" {?jb_tgubun == "b"}selected{/}>진료과</option>
                                        <option value="c" {?jb_tgubun == "c"}selected{/}>특수클리닉</option>
                                    </select>
                                </span>
                                <span class="cell">
                                    <select name="jb_treat" id="jb_treat">
                                        <!--{@menu}-->
                                            <option value="{.key_}" {?jb_treat==.key_}selected{/}>{.value_}</option>
                                        <!--{/}-->
                                    </select>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <!--{/}-->
                    <tr>
                        <th scope="row">제목<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_title" id="jb_title" value="{jb_title}">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">작성자<span class="essential">*</span></th>
                        <td>
                            <input type="text" class="inputTxt" placeholder="입력해주세요." name="jb_name" id="jb_name" value="{mb_name}">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">내용<span class="essential">*</span></th>
                        <td>
                            <textarea name="jb_content" id="jb_content" cols="30" rows="10" placeholder="- 노출 우려가 있는 개인정보는 기재하지 마세요.
 게시판 의도와 상관없는 글은 사전 동의없이 삭제됩니다.">{content}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="inputFile">
                                <label class="btnFileUpload">
                                    <input type="file" title="파일첨부" name="jb_file[]" onchange="fileUpload(this);">
                                    <span class="btn">파일첨부</span>
                                </label>
                                <input type="text" class="inputTxt" readonly>
                                <button type="button" class="btnDel" onclick="fileValDel(this);">삭제</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">비밀번호<span class="essential">*</span></th>
                        <td>
                            <input type="password" class="inputTxt" placeholder="4자리 이상" name="jb_password" id="jb_password" value="{jb_password}">
                        </td>
                    </tr>
                </tbody>
        </table>
</form>
    <p class="boardAlert">
        답변이 달린 이후엔 공개글로 전환되어<br>
        게시글의 수정 및 삭제를 하실 수 없습니다.
    </p>
    
    <div class="btnWrap">
        <span><a href="#" class="btnType1" onclick="javascript:history.back();">취소/목록</a></span>
        <span><a href="javascript:void(0);" class="btnType2" id="board_write">작성완료</a></span>
    </div>
</div>
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alertmsg">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="aconfirm" data-url="?code={jbcode}&stext={stext}&sec={sec}">확인</button>
    </div>
</div>
<div class="layerAlert" id="alertmsg2">
    <div class="cont">
        <p class="chkTxt"></p>
        <button type="button" class="btnType2" id="nconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->   