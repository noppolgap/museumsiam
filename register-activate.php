<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

if(isset($_GET['p'])){
	$id = intval(end(explode('0l0',base64_decode($_GET['p']))));
	if($id == 0){
		header('Location: login.php');
	}else{
		mysql_query("UPDATE sys_app_user SET ACTIVE_FLAG = '1' WHERE ID =".$id, $conn) or die($sql);
	}
}else{
	header('Location: login.php');
}
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
					<span>Thank you from register</span>
					ขอบคุณที่ลงทะเบียนกับเรา<br>
					ตอนนี้คุณสามารถใช้เว๊บไซด์ของเราได้
				</p>
			</div>
		</div>
		<div class="box-btn-condition">
			<div class="box-btn">
				<a  href="login.php" class="btn black">กลับหน้าหลัก</a>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>

</body>
</html>
<? CloseDB(); ?>