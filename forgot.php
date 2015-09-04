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
<link rel="stylesheet" type="text/css" href="css/login.css" />

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
				<li><a href="login.php">ระบบสมาชิก</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ลืมรหัสผ่าน</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				Forgot password<br>
				<span>ลืมรหัสผ่าน</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-content-main">
	<div class="container">
		<div class="box-content-main">
			<div class="box-forgot">
				<div class="box-top">
					<p>กรุณากรอกอีเมล์เพื่อทำการขอรหัสผ่าน</p>
					<input type="text">
				</div>
				<div class="box-bottom cf">
					<div class="box-btn cf">
						<a  class="btn black">ขอรหัสผ่านใหม่</a>
					</div>
				</div>
			</div>
			<div class="box-or">
				<p>
					<span>OR</span>
				</p>
			</div>
			<div class="box-createacc cf">
				<p>ต้องการสมัครสมาชิก?</p>
				<div class="box-btn">
					<a  class="btn black">สมัครสมาชิก</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
