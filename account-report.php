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
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-report.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu6").addClass("active");
	});
</script>
	
</head>

<body id="account-report">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">รายงานภาพรวมพิพิธภัณฑ์</li>
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
				<h1>รายงานภาพรวมพิพิธภัณฑ์</h1>
			</div>

			<div class="box-news-main gray">
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ชื่อรายงาน</p>
					</div>
					<div class="box-btn cf">
						<a href="#" class="btn red">แสดงรายงาน</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
