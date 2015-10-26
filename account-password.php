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
<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu3").addClass("active");
	});
</script>
	
</head>

<body id="account-pass">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">เปลี่ยนรหัสผ่าน</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/th/title-accout.png" alt="ACCOUNT SETTINGS"/>
			</p>	
		</div>
	</div>
</div>

<div class="part-account-main">
	<div class="container cf">
		<div class="box-account-left">
			<?php include('inc/inc-account-menu.php'); ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1>เปลี่ยนรหัสผ่าน</h1>
			</div>
			<div class="box-left">
				<div class="box-row cf">
					<div class="box-left">
						<p>รหัสผ่านเดิม</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>รหัสผ่านใหม่</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ยืนยันรหัสผ่านใหม่</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-btn-main cf">
				<div class="box-btn">
					<a class="btn black">ยกเลิก</a>
					<a class="btn black">ตกลง</a>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
