<?php /* Template_ 2.2.8 2019/06/13 16:08:56 /home/hosting_users/nkmed/www/v3/view/mypage/mylist.tpl 000002071 */ 
$TPL_list1_1=empty($TPL_VAR["list1"])||!is_array($TPL_VAR["list1"])?0:count($TPL_VAR["list1"]);
$TPL_list2_1=empty($TPL_VAR["list2"])||!is_array($TPL_VAR["list2"])?0:count($TPL_VAR["list2"]);?>
<?php $this->print_("mymenu",$TPL_SCP,1);?>

    <h3 class="subTitle">전문의 상담</h3>
    <ul class="boardList">
<?php if($TPL_list1_1){foreach($TPL_VAR["list1"] as $TPL_V1){?>
		<li>
             <a href="/v3/board.php?code=40&bidx=<?php echo $TPL_V1["idx"]?>">
                <span class="subject">[<?php echo $TPL_V1["ttype"]?>] <?php echo $TPL_V1["title"]?></span>
                <span class="opt">
                    <span class="date"><?php echo $TPL_V1["regdt"]?></span>
                    <span class="name"><?php echo $TPL_V1["name"]?></span>
                </span>
                <?php echo $TPL_V1["comtxt"]?>

            </a>
        </li>
<?php }}else{?>
		<li class="nonList">작성하신 글이 없습니다.</li>
<?php }?>
    </ul>

    <h3 class="subTitle">고객의 소리</h3>
    <ul class="boardList">
<?php if($TPL_list2_1){foreach($TPL_VAR["list2"] as $TPL_V1){?>
		<li>
             <a href="/v3/board.php?code=40&bidx=<?php echo $TPL_V1["idx"]?>">
                <span class="subject">[<?php echo $TPL_V1["ttype"]?>] <?php echo $TPL_V1["title"]?></span>
                <span class="opt">
                    <span class="date"><?php echo $TPL_V1["regdt"]?></span>
                    <span class="name"><?php echo $TPL_V1["name"]?></span>
                </span>
            </a>
        </li>
<?php }}else{?>
		<li class="nonList">작성하신 글이 없습니다.</li>
<?php }?>
    </ul>
<!-- 알럿 레이어 -->
<div class="layerAlert" id="alert_mypage">
    <div class="cont">
        <p class="chkTxt">회원정보가 변경되었습니다.</p>
        <button type="button" class="btnType2" id="mconfirm">확인</button>
    </div>
</div>
<!-- //알럿 레이어 -->