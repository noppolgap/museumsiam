<div class="part-left-title-page">
	<div class="box-title-page">
		<a href=""><img src="images/th/title-news-event.png" alt="title-news-event" width="" height="" /></a>
	</div>
</div>

<form name="search" action="?search" method="post">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="str_search" value="<?=$_SESSION['text'] ?>"  placeholder="<?=$searchCap?>">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1 sub"><a href="news-event-museum.php"><?=$activityNewsMuseumCap?></a>
				<ul class="submenu-left">
					<li class="submenu1"><a href="event-museum.php"><?=$activityMuseumCap?></a></li>
					<li class="submenu2"><a href="news-museum.php"><?=$newsMuseumCap?></a></li>
					<li class="submenu3"><a href="news-event-notice-all.php"><?=$procurementCap?></a></li>
				</ul>
			</li>
			<li class="menu2 sub"><a href="news-event-month.php"><?=$allEventAndNewsAllSystemCap?></a>
				<ul class="submenu-left <?=(isset($menu_newsevent)) ? 'dBlock' : ''?>">
				<?php if(($menu_newsevent == 1) || ($menu_newsevent == 2) || ($menu_newsevent == 3)){ ?>
					<li class="submenu1 <?=$menu_newsevent == 3 ? 'active' : ''?>"><a href="news-event-month.php"><?=$monthlyCap?></a></li>
					<li class="submenu2 <?=$menu_newsevent == 2 ? 'active' : ''?>"><a href="news-event-week.php"><?=$weeklyCap?></a></li>
					<li class="submenu3 <?=$menu_newsevent == 1 ? 'active' : ''?>"><a href="news-event-day.php"><?=$dailyCap?></a></li>
				<?php }else if(($menu_newsevent == 4) || ($menu_newsevent == 5) || ($menu_newsevent == 6)){ ?>
					<li class="submenu1 <?=$menu_newsevent == 6 ? 'active' : ''?>"><a href="event-month.php"><?=$monthlyCap?></a></li>
					<li class="submenu2 <?=$menu_newsevent == 5 ? 'active' : ''?>"><a href="event-week.php"><?=$weeklyCap?></a></li>
					<li class="submenu3 <?=$menu_newsevent == 4 ? 'active' : ''?>"><a href="event-day.php"><?=$dailyCap?></a></li>
				<?php }else{ ?>
					<li class="submenu1"><a href="news-event-month.php"><?=$monthlyCap?></a></li>
					<li class="submenu2"><a href="news-event-week.php"><?=$weeklyCap?></a></li>
					<li class="submenu3"><a href="news-event-day.php"><?=$dailyCap?></a></li>
				<?php } ?>
				</ul>
			</li>
		</ul>
	</div>
</div>
