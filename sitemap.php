<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/sitemap.css" />

<script>
	$(document).ready(function(){
// 		$("li.menu1").addClass("active");		
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">แผนผังเว็บไซต์</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				site map<br>
				<span>แผนผังเว็บไซต์</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-content-main">
	<div class="container">
		<div class="row cf">
			<div class="box-list">
				<a href="#"><h3>หน้าหลัก</h3></a>
			</div>
			<div class="box-list">
				<a href="#"><h3>รู้จักเรา</h3></a>
				<ul class="list">
					<li><a href="#">ความเป็นมาของเรา</a></li>
					<li><a href="#">โครงสร้างของเรา</a></li>
				</ul>
			</div>
			<div class="box-list">
				<a href="#"><h3>บริการของเรา</h3></a>
				<ul class="list">
					<li><a href="#">ห้องคลังความรู้</a></li>
					<li><a href="#">ห้องคลังโบราณวัตถุ</a></li>
					<li><a href="#">ร้านอาหาร</a></li>
					<li><a href="#">MUSE SHOP</a></li>
					<li><a href="#">พื้นที่ให้เช่า</a></li>
				</ul>
			</div>			
		</div>
		<div class="row cf">
			<div class="box-list">
				<a href="#"><h3>สิทธิพิเศษ</h3></a>
			</div>
			<div class="box-list">
				<a href="#"><h3>กิจกรรมและข่าวสาร</h3></a>
				<ul class="list">
					<li><a href="#">กิจกรรมและข่าวสารของมิวเซียมสยาม</a>
						<ul class="sublist">
							<li><a href="#">กิจกรรม</a></li>
							<li><a href="#">ข่าวประชาสัมพันธ์</a></li>
							<li><a href="#">ประกาศจัดซื้อจัดจ้าง</a></li>
						</ul>
					</li>
					<li><a href="#">กิจกรรมและข่าวสารของทุกระบบ</a>
						<ul class="sublist">
							<li><a href="#">รายเดือน</a></li>
							<li><a href="#">รายสัปดาห์</a></li>
							<li><a href="#">รายวัน</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="box-list">
				<a href="#"><h3>ระบบอื่นๆ ที่เกี่ยวข้อง</h3></a>
				<ul class="list">
					<li><a href="#">Knowledge Management</a></li>
					<li><a href="#">Digital Achive</a></li>
					<li><a href="#">Museum Data Network</a></li>
					<li><a href="#">Virtual Exhibition</a></li>
					<li><a href="#">GIS</a></li>
					<li><a href="#">Online System</a></li>
				</ul>
			</div>			
		</div>
		<div class="row cf">
			<div class="box-list">
				<a href="#"><h3>ถาม-ตอบ</h3></a>
			</div>
			<div class="box-list">
				<a href="#"><h3>ติดต่อเรา</h3></a>
				<ul class="list">
					<li><a href="#">E-Mail Submit Form Address & Map</a></li>
					<li><a href="#">E-Application</a>
						<ul class="sublist">
							<li><a href="#">ตำแหน่งงาน</a></li>
							<li><a href="#">เงื่อนไขข้อกำหนด</a></li>
							<li><a href="#">กรอกข้อมูล</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
