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

<script>
	$(document).ready(function(){
// 		$("li.menu1").addClass("active");		
	});
</script>
	
<style>
	.box-btn .btn.black{
		width: 151px;
	}
</style>
	
</head>

<body id="noti">
	
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

<div class="box-freespace"  id="firstbox"></div>

<div class="part-content-main">
	<div class="container">
		<div class="box-content-main">
			<div class="box-noti">
				<p>
					<span>Please Check your E-mail</span>
					กรุณาตรวจสอบอีเมล์ของท่าน<br>
					เพื่อยืนยันการเป็นสมาชิก และ รับรหัสผ่านใหม่
				</p>
			</div>
		</div>
		<div class="box-btn-condition">
			<div class="box-btn">
				<a  href="login.php" class="btn black">กลับระบบสมาชิก</a>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
