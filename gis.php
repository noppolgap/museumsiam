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
<link rel="stylesheet" type="text/css" href="css/km.css" />
<link rel="stylesheet" type="text/css" href="css/gis-main.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6").addClass("active");
		
		var sync1 = $("#sync1");
		
		sync1.owlCarousel({
			singleItem : true,
			paginationSpeed : 500,
			rewindSpeed : 1000,
			navigation: false,
			pagination:false,
			responsiveRefreshRate : 200,
			mouseDrag : false,
			rewindNav:true
		});
		$(".box-slide-big a.pev").click(function(){	
			$("#sync1").data('owlCarousel').prev();
		});
		$(".box-slide-big a.next").click(function(){	
			$("#sync1").data('owlCarousel').next();
		});
		
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
								<input type="checkbox"><span class="icon-pin">ทุกวัน</span>
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
									<a class="radio active"><span class="icon-pin">ฟรี</span></a>
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
	<div class="container cf">
		<div class="box-content-left">
			<div class="box-title-museum">
				<div class="title">
					Rattanakosin<br>Exhibition Hall
					<span>นิทรรศน์รัตนโกสินทร์</span>
				</div>
			</div>
			<div class="box-gray">
				<p class="text-date">อังคาร - อาทิตย์</p>
				<p class="text-time">10.30 น. - 18.00 น.</p>
			</div>
			<div class="box-gray">
				<p class="text-ticket">ผู้ใหญ่ และชาวต่างชาติ ราคา 100 บาท<br>
				เข้าชมฟรี สำหรับ เด็ก นักเรียน/นักศึกษา ผู้สูงอายุ ภิกษุ สามเณร และ ผู้พิการ</p>
			</div>
			<div class="box-gray">
				<p class="text-tel"><a href="tel:+66026210043" target="_blank">+66(0)2 621 0043</a></p>
			</div>
			<div class="box-gray">
				<div class="box-btn">
					<a href="" class="btn red">ขอเส้นทาง</a>
				</div>

			</div>
		</div>
		<div class="box-content-right">
			<div class="box-slide-big">
				<div id="sync1" class="owl-carousel">
					<div class="slide-content">
						<img src="http://placehold.it/754x562">
					</div>
					<div class="slide-content">
						<img src="http://placehold.it/754x562/ccc">
					</div>
					<div class="slide-content">
						<img src="http://placehold.it/754x562">
					</div>
					<div class="slide-content">
						<img src="http://placehold.it/754x562/ccc">
					</div>
					<div class="slide-content">
						<img src="http://placehold.it/754x562">
					</div>
					<div class="slide-content">
						<img src="http://placehold.it/754x562/ccc">
					</div>
				</div>
				<a class="btn-arrow-slide pev"></a>
				<a class="btn-arrow-slide next"></a>
			</div>
			<div class="box-news-text">
				<p>
					Levitated Mass is a 2012 large-scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art. The installation consists of a 340-ton boulder affixed above a concrete trench through which visitors may walk. The nature, expense and scale of the installation made it an instant topic of discussion The work comprises a 21.5-foot tall boulder mounted on the walls of a 456-foot long concrete trench, surrounded by 2.5 acres of compressed decomposed granite. The boulder is bolted to two shelves affixed to the inner walls of the trench, which descends from ground level to 15 feet below the stone at its center, allowing visitors to stand directly below the megalith.
				</p>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
