<?php /* Template_ 2.2.7 2016/09/02 10:41:48 /home/hosting_users/nkmed/www/rev_template/view/online/r_list.tpl 000003713 */ 
$TPL_list_n_1=empty($TPL_VAR["list_n"])||!is_array($TPL_VAR["list_n"])?0:count($TPL_VAR["list_n"]);
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
<header id="header">
		<h1 class="page-title">예약정보확인</h1>
		<a href="/online/reserve/" class="btn-previous-page icon-before-previous ntxt"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
<?php $this->print_("menu",$TPL_SCP,1);?>

		</nav>
	</header>
	<article id="container">
<?php if($TPL_list_n_1){foreach($TPL_VAR["list_n"] as $TPL_V1){?>
		<header class="explain-text header"><strong><?php echo $TPL_V1["regDt"]?></strong>에 예약하신 예약정보입니다.</header>
		<section>
			<h1 class="section-title">최근 예약</h1>
			<section class="well">
	          
				<a href="/online/rev_list/rv_no=<?php echo $TPL_V1["rv_no"]?>" class="reserv-info">
					<!-- <div class="company-logo"><img src="" alt="" class="block" /></div> -->
                    <ul>
                        <li class="date"><?php echo $TPL_V1["regDt"]?></li>
                        <li class="people">
                            <small>환자</small>
                            <strong><?php echo $TPL_V1["p_name"]?></strong>
                        </li>
                        <li class="people">
                            <small>예약자</small>
                            <strong><?php echo $TPL_V1["r_name"]?></strong>
                        </li>
                        <li class="doctor">
                            <strong><?php echo $TPL_V1["dr_name"]?></strong>
                            <small>전문의</small>
                            <span class="category"><?php echo $TPL_V1["t_code_name"]?></span>
                        </li>
                    </ul>
				</a>
                
			</section>
		</section>
<?php }}else{?>
        <section>
        <h1 class="section-title">최근 예약</h1>
			<section class="well">
            	예약하신 내역이 없습니다.
            </section>
        </section>
<?php }?>
		<section>
			<h1 class="section-title">예약 내역</h1>
			<section class="well">
				<ul class="reserv-list">
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
					<li class="reserv-info">
						<!-- <div class="company-logo"><img src="" alt="" class="block" /></div> -->
						<ul>
							<li class="date"><?php echo $TPL_V1["regDt"]?></li>
							<li class="people">
								<small>환자</small>
								<strong><?php echo $TPL_V1["p_name"]?></strong>
							</li>
							<li class="people">
								<small>예약자</small>
								<strong><?php echo $TPL_V1["r_name"]?></strong>
							</li>
							<li class="doctor">
								<strong><?php echo $TPL_V1["dr_name"]?></strong>
								<small>전문의</small>
								<span class="category"><?php echo $TPL_V1["t_code_name"]?></span>
							</li>
						</ul>
					</li>
<?php }}else{?>
                    	예약하신 내역이 없습니다.
<?php }?>
				</ul>
			</section>
			<footer class="pagination">
<?php if($TPL_VAR["prevblock"]){?><a href="javascript:void(0)" class="btn-prev">&lt;</a><?php }?>
                <?php echo $TPL_VAR["link"]?> <?php if($TPL_VAR["nextblock"]){?><a href="javascript:void(0)" class="btn-next">&gt;</a><?php }?>
			</footer>
		</section>
		<footer class="btn-group">
			<a href="/online/reserve/" class="btn btn-half">확인</a>
		</footer>
	</article>