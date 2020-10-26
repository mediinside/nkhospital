<?
	include_once($GP -> INC_ADM_PATH."inc.login_check.php");
	include_once $GP -> INC_ADM_PATH.'menu.php';
?>
	<div class="boxLeft">
		<div class="boxTitleArea" id="top_title" style="cursor:pointer;">
			<h1>뉴고려병원<br></h1>
		</div>
		<?
			$menuQuery = "";
			$menuMainArr = array("/","","index.html");
		
			$folderNameArr = explode("/",$_SERVER['SCRIPT_NAME']);
			$folderName = $folderNameArr[2];
		
			if(in_array($folderName,$menuMainArr)){
				$menuQuery = "main";
			}else{
				$menuQuery = $folderName;
			}			
		?>
		<ul class="boxLeftMenu">
			<?
				if($_GET['m_tab']) {
					if($_SESSION['main_tab'] != $_GET['m_tab']) {
						unset($_SESSION['sub_tab']);
					}
				}

				foreach ($GP -> MENU_ADMIN as $key => $val){
					$a1_class = "top_menu_off";
					if(!empty($_GET['m_tab']))	{
						$_SESSION['main_tab'] = $_GET['m_tab'];

						if($val['tab'] == $_GET['m_tab']) {
							$a1_class = "top_menu_on";
						}
					}else{
						if(!empty($_SESSION['main_tab'])) {
							if($val['tab'] == $_SESSION['main_tab'])	{
								$a1_class = "top_menu_on";
							}
						}
						else
						{
							if($val['tab'] == "1")	{
								$a1_class = "top_menu_on";
							}
						}
					}
				?>
				<li><a href="<?=$val['link']?>" class="<?=$a1_class?>"><?=$val['name']?></a></li>
				<?
				}
			?>			
		</ul>		
	</div
	><div class="boxContent">		
		<div class="boxContentHeader">
			<? 
				foreach ($GP -> MENU_SUB_ADMIN[$menuQuery] as $key => $val) {
			?>
			<span class="boxTopNav"><strong><?=$key?></strong></span>
			<?
			}
			?>			
			<span class="boxTopBtns">
				<a href="/admin/">HOME</a>&nbsp;&nbsp;|&nbsp;&nbsp;	
                 <a href="/" target="_blank">홈페이지</a>&nbsp;&nbsp;|&nbsp;&nbsp;				
				<a href="/admin/login/action/login.proc.php?mode=logout">LOGOUT</a>
			</span>
		</div>
		<div id="BoardHead" class="boxBoardHead">
				<ul>
				<?
					foreach ($GP -> MENU_SUB_ADMIN[$menuQuery] as $key => $val) {
						foreach ($val as $key2 => $val2) {
									$a2_class = "";
									if(!empty($_GET['tab']))	{
										$_SESSION['sub_tab'] = $_GET['tab'];

										if($val2['tab'] == $_GET['tab']) {
											$a2_class = "active";
										}
									}else{
										if(!empty($_SESSION['sub_tab'])) {
											if($val2['tab'] == $_SESSION['sub_tab'])	{
												$a2_class = "active";
											}
										}else{

											if($val2['tab'] == "1")	{
												$a2_class = "active";
											}
										}
									}
				?>
					<li><a href="<?=$val2['link']?>?tab=<?=$val2['tab']?>" class="<?=$a2_class?>"><?=$val2['name']?></a></li
					>
				<?
						}
					}
				?>
				</ul>
		</div>		