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
		$(".menu-left li.menu4,.menu-left li.menu4 li.submenu1").addClass("active");
			if ($('.menu-left li.menu4').hasClass("active")){
				$('.menu-left li.menu4').children(".submenu-left").css("display","block");
			}
	});
</script>
	
</head>

<body id="account-booking">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ประวัติการสั่งซื้อ e-Booking</li>
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
			<?php include('inc/inc-account-menu.php'); ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1>ประวัติการสั่งซื้อ e-Booking</h1>
			</div>
			<div class="box-table-main">
				<div class="table-row head cf">
					<div class="column order">เลขที่จอง</div>
					<div class="column date">วันที่จอง</div>
					<div class="column name">นิทศรรการ</div>
					<div class="column num">จำนวน</div>
					<div class="column price">ราคา</div>
					<div class="column total">รวม</div>
					<div class="column status">สถานะ</div>
				</div>

				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				<div class="table-row list cf">
					<div class="column order">158686047</div>
					<div class="column date">11/06/2015</div>
					<div class="column name">มองใหม่ด้ายไหม</div>
					<div class="column num">999,999</div>
					<div class="column price">999,999</div>
					<div class="column total">999,999,999</div>
					<div class="column status">จองเรียบร้อย</div>
				</div>
				
				<div class="box-pagination-main cf">
					<ul class="pagination">
						<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
						<li class="active"><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">...</a></li>
						<li><a href="" class="btn-arrow-right"></a></li>
					</ul>
				</div>
			
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
