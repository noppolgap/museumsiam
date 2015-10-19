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
<link rel="stylesheet" type="text/css" href="css/contact.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu1").addClass("active");
			if ($('.menu-left li.menu2').hasClass("active")){
				$('.menu-left li.menu2').children(".submenu-left").css("display","block");
			}
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
				<li>ติดต่อเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ตำแหน่งงาน</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-contact.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>E-APPLICATION
					<span>ตำแหน่งงาน</span>
				</h1>
			</div>
			<div class="box-carrer-main">
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
				</div>
				<div class="box-row">
					<div class="box-top cf">
						<h3>ผู้จัดการฝ่ายพัฒนาธุรกิจ</h3>
						<div class="number"><span>2</span> อัตรา</div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php" class="btn red">รายละเอียด</a>
							<a href="contact-eapp-register.php" class="btn red">สมัครงาน</a>
						</div>						
					</div>
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
