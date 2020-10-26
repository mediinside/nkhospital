<?php /* Template_ 2.2.8 2019/06/13 15:40:48 /home/hosting_users/nkmed/www/v3/view/inc/my.top.tpl 000000694 */ ?>
<h2 class="pageTitle mypage">마이페이지</h2>
<div class="section">
    <div class="tabMenu">
        <ul>
            <li<?php if($TPL_VAR["tab"]=="mypage"){?> class="active"<?php }?>><a href="?tab=mypage"><span>정보수정</span></a></li>
            <li<?php if($TPL_VAR["tab"]=="mylist"){?> class="active"<?php }?> data-pg="mylist"><a href="?tab=mylist"><span>내글목록</span></a></li>
            <li<?php if($TPL_VAR["tab"]=="myout"){?> class="active"<?php }?> data-pg="myout"><a href="?tab=myout"><span>회원탈퇴</span></a></li>
        </ul>
    </div>