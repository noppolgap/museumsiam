<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

	$CID = 11;

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script src="js/news-event.js"></script>
</head>

<body>

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<?php
				include ('inc/inc-news-event-breadcrumbs.php');
			?>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-newsevent.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">

			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>กิจกรรมของมิวเซียมสยาม</h2>
					<div class="box-btn">
						<a href="event-museum.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">
<?php
	for($i=1;$i<=9;$i++){
?>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
									<div class="box-date-tumb">
										<p class="date">99</p>
										<p class="month">พ.ย.</p>
									</div>
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
<?php
		if($i == 3){
			echo '<hr class="line-gray">';
		}
	}
?>
					</div>

				</div>

			</div>
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>ข่าวประชาสัมพันธ์ของมิวเซียมสยาม</h2>
					<div class="box-btn">
						<a href="news-museum.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">

						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf mid">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<hr class="line-gray"/>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf mid">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>ประกาศจัดซื้อจัดจ้าง</h2>
					<div class="box-btn">
						<a href="news-event-notice-all.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main gray">
					<div class="box-notice pdf">
						<div class="box-text">
							<p class="text-title">ราคากลางจ้างพัฒนาหลักสูตร และฝึกอบรมบุคลากรพิพิธภัณฑ์</p>
							<p class="text-detail">
								<span>ประเภท: .pdf</span>
								<span>ขนาด: 0.61 เมกะไบต์</span>
							</p>
						</div>
						<div class="box-btn cf">
							<a href="#" class="btn red">ดาวน์โหลด</a>
						</div>
					</div>
					<div class="box-notice pdf">
						<div class="box-text">
							<p class="text-title">ราคากลางจ้างพัฒนาหลักสูตร และฝึกอบรมบุคลากรพิพิธภัณฑ์</p>
							<p class="text-detail">
								<span>ประเภท: .pdf</span>
								<span>ขนาด: 0.61 เมกะไบต์</span>
							</p>
						</div>
						<div class="box-btn cf">
							<a href="#" class="btn red">ดาวน์โหลด</a>
						</div>
					</div>
					<div class="box-notice pdf">
						<div class="box-text">
							<p class="text-title">ราคากลางจ้างพัฒนาหลักสูตร และฝึกอบรมบุคลากรพิพิธภัณฑ์</p>
							<p class="text-detail">
								<span>ประเภท: .pdf</span>
								<span>ขนาด: 0.61 เมกะไบต์</span>
							</p>
						</div>
						<div class="box-btn cf">
							<a href="#" class="btn red">ดาวน์โหลด</a>
						</div>
					</div>
					<div class="box-notice pdf">
						<div class="box-text">
							<p class="text-title">ราคากลางจ้างพัฒนาหลักสูตร และฝึกอบรมบุคลากรพิพิธภัณฑ์</p>
							<p class="text-detail">
								<span>ประเภท: .pdf</span>
								<span>ขนาด: 0.61 เมกะไบต์</span>
							</p>
						</div>
						<div class="box-btn cf">
							<a href="#" class="btn red">ดาวน์โหลด</a>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php
include('inc/inc-footer.php');
include('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>