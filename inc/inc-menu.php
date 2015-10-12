<div class="part-menu"  id="menu">
	<div class="container cf">
		<div class="box-menu cf">
			<div class="box-logo">
				<a href="index.php"><img src="images/th/logo-header.svg" width="202"/></a>
			</div>
			<div class="menu">
				<ul class="menutop cf">
					<li class="menu1"><a href="index.php">หน้าแรก</a></li>
					<li class="menu2 sub"><a href="">รู้จักเรา</a>
						<ul class="submenu-top">
							<a href="#"><li class="sub1">Supmenu 1</li></a>
							<a href="#"><li class="sub2">Supmenu 2</li></a>
						</ul>
					</li>
					<li class="menu3 sub"><a href="">บริการของเรา</a>
						<ul class="submenu-top">
							<a href="#"><li class="sub1">Supmenu 1</li></a>
							<a href="#"><li class="sub2">Supmenu 2</li></a>
						</ul>
					</li>
					<li class="menu4"><a href="">สิทธิพิเศษ</a></li>
					<li class="menu5 sub"><a href="">กิจกรรมและข่าวสาร</a>
						<ul class="submenu-top">
							<a href="#"><li class="sub1">Supmenu 1</li></a>
							<a href="#"><li class="sub2">Supmenu 2</li></a>
						</ul>
					</li>
					<li class="menu6 sub"><a href="">ระบบอื่นๆ ที่เกี่ยวข้อง</a>
						<ul class="submenu-top">
							<?
								$sqlStr = "SELECT
												MODULE_ID,
												MODULE_NAME_LOC,
												MODULE_NAME_ENG,
												LINK_URL
											FROM
												sys_app_module
											WHERE
												ACTIVE_FLAG <> 2
											AND RENDER_ON_FRONT = 'Y'
											ORDER BY
												ORDER_DATA ASC";
								$query = mysql_query($sqlStr, $conn);
								$classIdx = 1;
 								while($row = mysql_fetch_array($query)) {
									echo '<a href="'.$row['LINK_URL'].'?MID='.$row['MODULE_ID'].'"><li class="sub'.$classIdx++.'">'.$row['MODULE_NAME_LOC'].'</li></a>';
								}
							?>
							<!--<a href="category.php?MID=2"><li class="sub1">ระบบการจัดการความรู้</li></a>-->
							<!--<a href="#"><li class="sub2">Supmenu 2</li></a>-->
						</ul>
					</li>
					<li class="menu7 sub"><a href="">คำถามที่พบบ่อย</a>
						<ul class="submenu-top">
							<a href="#"><li class="sub1">Supmenu 1</li></a>
							<a href="#"><li class="sub2">Supmenu 2</li></a>
						</ul>
					</li>
					<li class="menu8 sub"><a href="">ติดต่อเรา</a>
						<ul class="submenu-top">
							<a href="#"><li class="sub1">Supmenu 1</li></a>
							<a href="#"><li class="sub2">Supmenu 2</li></a>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
