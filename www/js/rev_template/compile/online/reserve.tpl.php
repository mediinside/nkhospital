<?php /* Template_ 2.2.7 2016/09/09 10:12:51 /home/hosting_users/nkmed/www/rev_template/view/online/reserve.tpl 000001295 */ ?>
<header id="header">
		<h1 class="page-title"><?php if($TPL_VAR["rev_no"]=="0"){?>비회원 이용하기<?php }else{?>예약하기<?php }?></h1>
		<a href="/online/main/" class="btn-previous-page icon-before-previous ntxt none"><span>이전페이지</span></a>
		<nav id="nav" class="">
			<h2 class="ntrigger"><a href="javascript:void(0);"><span>메뉴</span></a></h2>
<?php $this->print_("menu",$TPL_SCP,1);?>

		</nav>
	</header>
	<article id="container">
		<section class="well">
			<h1 class="none">예약 메뉴</h1>
			<ul class="reservation-menu-list">
				<li>
					<a href="/online/step1/" class="panel panel-contents icon-after-calendar">
						<small><?php if($TPL_VAR["rev_no"]=="0"){?>비회원<?php }else{?>초진 / 재진<?php }?></small>
						<span>예약하기</span>
					</a>
				</li>
				<li>
					<a href="/online/rev_list/" class="panel panel-contents icon-after-document">
						<small><?php if($TPL_VAR["rev_no"]=="0"){?>비회원<?php }else{?>예약확인 및<?php }?></small>
						<span><?php if($TPL_VAR["rev_no"]=="0"){?>예약확인<?php }else{?>예약내역보기<?php }?></span>
					</a>
				</li>
			</ul>
		</section>
	</article>