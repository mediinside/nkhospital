<div id="location">
	<a href="/" class="home"><img src="/resource-pc/images/home.png" alt="처음으로"></a>
	<div class="depth dep-1">
    <p><?=$GP -> Navi_Dep1[$dep1][0];?></p>
		<ul>
         <?foreach ($GP -> Navi_Dep1 as $key => $val) {?>
            <li><a href="<?=$val[1]?>"><?=$val[0]?></a></li>
         <?}?>
        </ul>
	</div>
	<div class="depth dep-2">
	<p><?=$GP -> Navi_Dep2[$dep1][$dep2][0];?></p>
		<ul>
         <?foreach($GP -> Navi_Dep2[$dep1] as $dep_key => $dep_val){?>
            <li><a href="<?=$dep_val[1]?>"><?=$dep_val[0]?></a></li>
         <?}?>
        </ul>
	</div>
	<div class="depth dep-3">
	<p><?=$GP -> Navi_Dep3[$dep2][$dep3][0];?></p>
		<ul>
         <?foreach($GP -> Navi_Dep3[$dep2] as $dep_key2 => $dep_val2){?>
            <li><a href="<?=$dep_val2[1]?>"><?=$dep_val2[0]?></a></li>
         <?}?>
        </ul>
	</div>
</div>

