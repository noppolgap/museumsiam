<div class="part-left-title-page">
	<div class="box-title-page">
		<a href=""><img src="images/th/title-news-event.png" alt="title-news-event" width="" height="" /></a>
	</div>
</div>

<form name="search" action="?search" method="post">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="str_search" value="<?=$_SESSION['text'] ?>"  placeholder="ค้นหา">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1 sub"><a href="news-event-museum.php">กิจกรรมและข่าวสารของมิวเซียมสยาม</a>
				<ul class="submenu-left">
					<li class="submenu1"><a href="event-museum.php">กิจกรรมของมิวเซียมสยาม</a></li>
					<li class="submenu2"><a href="news-museum.php">ข่าวประชาสัมพันธ์ของมิวเซียมสยาม</a></li>
					<li class="submenu3"><a href="news-event-notice-all.php">ประกาศจัดซื้อจัดจ้าง</a></li>
				</ul>
			</li>
			<li class="menu2 sub"><a href="news-event.php">กิจกรรมและข่าวสารทั้งหมดของทุกระบบ</a>
				<ul class="submenu-left <?=(isset($menu_newsevent)) ? 'dBlock' : ''?>">
				<?php if(($menu_newsevent == 1) || ($menu_newsevent == 2) || ($menu_newsevent == 3)){ ?>
					<li class="submenu1 <?=$menu_newsevent == 3 ? 'active' : ''?>"><a href="news-event-month.php">รายเดือน</a></li>
					<li class="submenu2 <?=$menu_newsevent == 2 ? 'active' : ''?>"><a href="news-event-week.php">รายสัปดาห์</a></li>
					<li class="submenu3 <?=$menu_newsevent == 1 ? 'active' : ''?>"><a href="news-event-day.php">รายวัน</a></li>
				<?php }else if(($menu_newsevent == 4) || ($menu_newsevent == 5) || ($menu_newsevent == 6)){ ?>
					<li class="submenu1 <?=$menu_newsevent == 6 ? 'active' : ''?>"><a href="event-month.php">รายเดือน</a></li>
					<li class="submenu2 <?=$menu_newsevent == 5 ? 'active' : ''?>"><a href="event-week.php">รายสัปดาห์</a></li>
					<li class="submenu3 <?=$menu_newsevent == 4 ? 'active' : ''?>"><a href="event-day.php">รายวัน</a></li>
				<?php }else{ ?>
					<li class="submenu1"><a href="news-event-month.php">รายเดือน</a></li>
					<li class="submenu2"><a href="news-event-week.php">รายสัปดาห์</a></li>
					<li class="submenu3"><a href="news-event-day.php">รายวัน</a></li>
				<?php } ?>
				</ul>
			</li>
		</ul>
	</div>
</div>
