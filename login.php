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
				<li class="active">ระบบสมาชิก</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				Login Form<br>
				<span>ระบบสมาชิก</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-content-main">
	<div class="container">
		<div class="box-content-main">
			<div class="box-login">
				<div class="box-top">
					<input type="text" placeholder="อีเมล">
					<input type="text" placeholder="รหัสผ่าน">
				</div>
				<div class="box-bottom cf">
					<div class="box-left">
						<a href="forgot.php" class="btn-forgot">ลืมรหัสผ่าน?</a>
					</div>
					<div class="box-right">
						<div class="box-btn">
							<a  class="btn black">เข้าสู่ระบบ</a>
						</div>
					</div>
				</div>
			</div>
			<div class="box-or">
				<p>
					<span>OR</span>
				</p>
			</div>
			<div  class="box-login-fb">
				<a href="f#" class="btn-login-fb"><img src="images/form/btn-login-fb.png"/></a>
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
