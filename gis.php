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
<link rel="stylesheet" type="text/css" href="css/km.css" />
<link rel="stylesheet" type="text/css" href="css/gis-main.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6").addClass("active");
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
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบภูมิสารสนเทศบนเครือข่าย</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-gis-main cf"  id="firstbox">
	<div class="container">
		<div class="box-left">
			<div class="box-title-page">
				<img src="images/th/title-gis.png"/>
			</div>
		</div>
		<div class="box-right">
			<div class="box-top">
				<img src="images/th/gis/title.png"/>
			</div>
			<div class="box-bottom cf">
				<div class="box-row cf box-1">
					<div class="box-input-text">
						<p>หมวดพิพิธภัณฑ์ :</p>
						<div>
							<div class="SearchMenu-item">
								เลือกหมวดพิพิธภัณฑ์
								<select class="p-Absolute">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf box-2">
					<div class="box-left">
						<div class="box-input-text checkbox">
							<p>เลือกวันทำการ :</p>
							<div class="noLine">
								<input type="checkbox"><span>ทุกวัน</span>
							</div>
							<div>
								<input type="checkbox"><span>จ</span>
							</div>
							<div>
								<input type="checkbox"><span>อ</span>
							</div>
							<div>
								<input type="checkbox"><span>พ</span>
							</div>
							<div>
								<input type="checkbox"><span>พฤ</span>
							</div>
							<div>
								<input type="checkbox"><span>ศ</span>
							</div>
							<div>
								<input type="checkbox"><span>ส</span>
							</div>
							<div>
								<input type="checkbox"><span>อา</span>
							</div>							
						</div>
					</div>
				</div>
				<div class="box-row cf box-3">
					<div class="box-left">
						<div class="box-input-text">
							<p>ราคา :</p>
							<div>
								<div class="box-radio cf">
									<a class="radio"><span>ฟรี</span></a>
									<a class="radio"><span>เสียค่าเข้า</span></a>
								</div>
							</div>							
						</div>
					</div>
				</div>
				<div class="box-row cf box-4">
					<div class="box-btn cf">
						<a href="" class="btn black">ค้นหาพิพิธภัณฑ์</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="part-map-main">


</div>

<div class="part-detail-main">
	<div class="container">


	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
