<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/online-system.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu1").addClass("active");		
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#"><?=$otherSystemCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">e-SHOPPING</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-shopping.php'); ?>
		</div>
		<div class="box-right main-content">
			<div class="box-system">
				<a href="e-booking.php">
					<div class="box-pic">
						<img src="images/th/online-system/e-booking.jpg" />
					</div>
				</a>
				<a href="e-booking.php">
					<div class="text-title">
						e-BOOKING + ONLINE TICKET
					</div>
				</a>
				<div class="text-detail">
					Advance tickets to The Museum siam allow the visitor to avoid waiting in admission lines at the Museum.
				</div>
			</div>
			<div class="box-system">
				<a href="e-shopping.php">
					<div class="box-pic">
						<img src="images/th/online-system/e-shopping.jpg"/>
					</div>
				</a>
				<a href="e-shopping.php">
					<div class="text-title">
						e-SHOPPING
					</div>
				</a>
				<div class="text-detail">
					Advance tickets to The Museum siam allow the visitor to avoid waiting in admission lines at the Museum.
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
