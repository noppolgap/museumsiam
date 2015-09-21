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
<link rel="stylesheet" type="text/css" href="css/shopping.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu3,.menu-left li.menu3 .submenu1").addClass("active");	
			if ($('.menu-left li.menu3').hasClass("active")){
				$('.menu-left li.menu3').children(".submenu-left").css("display","block");
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
				<li><a href="#">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">e-SHOPPING</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ของที่ระลึก</li>
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
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-SHOPPING</h1>
				<div class="box-btn">
					<a href="" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart">ตะกร้าสินค้า 999</a>
			</div>
			
			<div class="box-category-main">
				<div class="box-title cf">
					<h2>ของที่ระลึก</h2>
				</div>
				<div class="box-item-main cf">
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
						</div>
					</div>
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
						</div>
					</div>
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
						</div>
					</div>
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
						</div>
					</div>
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
						</div>
					</div>
					<div class="item">
						<a href="e-shopping-detail.php">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-detail.php">
								<p class="text-title">
									Fodor's Thailand<br>Fodor's Thailand
								</p>
							</a>
							<p class="text-price">
								ราคาปกติ : 980 บาท<br>
								<span>ราคาพิเศษ : 882 บาท</span>
							</p>
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
