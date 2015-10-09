<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />

<script>
	$(document).ready(function(){
// 		$("li.menu1").addClass("active");		
	});
</script>
	
</head>

<body id="account">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบสมาชิก</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				ACCOUNT SETTINGS<br>
				<span>การต้ังค่าบัญชีผู้ใช้</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-account-main">
	<div class="container cf">
		<div class="box-account-left">
			<div class="box-menu-account">
				<ul class="menu-left">
					<li class="menu1 ac"><a href="account.php">ข้อมูลส่วนตัว</a></li>
					<li class="menu2 ed active"><a href="account-edit.php">แก้ไขข้อมูล</a></li>
					<li class="menu3 ps"><a href="account-password.php">เปลี่นรรหัสผ่าน</a></li>
					<li class="menu4 pc sub"><a href="account-ebook.php">ประวัติการสั่งซื้อ</a>
						<ul class="submenu-left">
							<li class="submenu1 es"><a href="account-ebook.php">e-Booking</a></li>
							<li class="submenu2 eb"><a href="account-eshopping.php">e-Shopping</a></li>
						</ul>
					</li>
					<li class="menu5 mu sub"><a href="account-museum.php">จัดการพิพิธภัณฑ์</a>
						<ul class="submenu-left">
							<li class="submenu1 md"><a href="account-museum.php">รายละเอียดพิพิธภัณฑ์</a></li>
							<li class="submenu2 me"><a href="account-museum-event.php">กิจกรรม</a></li>
							<li class="submenu3 mn"><a href="account-museum-news.php">ข่าวสาร</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="box-account-right">
			test
			
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
