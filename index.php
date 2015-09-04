<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/index.css" />

<script type="text/javascript" src="js/index.js"></script>

<script>
	$(document).ready(function(){
		$("li.menu1").addClass("active");		
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>	
	
<div class="part-banner" id="firstbox">
	<div class="slide-herobanner">
		<div class="slide" style="background-image: url(http://placehold.it/1920x545);"></div>
		<div class="slide" style="background-image: url(http://placehold.it/1920x545);"></div>
		<div class="slide" style="background-image: url(http://placehold.it/1920x545);"></div>
		<div class="slide" style="background-image: url(http://placehold.it/1920x545);"></div>
		<div class="slide" style="background-image: url(http://placehold.it/1920x545);"></div>
	</div>
</div>

<?php include('inc/inc-menu.php'); ?>	

<div  class="part-detail-museum">
	<?php include('inc/inc-detail-museum-th.php'); ?>
</div>

<div class="part-event cf">
	<div class="container">
		<div class="box-left">
			<div class="box-date-main cf">
				<div class="text-title">
					event all
				</div>
				<a>
					<div class="box-tumb-date  sun  today">
						<div class="text-date">
							อาทิตย์
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date mon">
						<div class="text-date">
							จันทร์
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date tue">
						<div class="text-date">
							อังคาร
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date wed">
						<div class="text-date">
							พุธ
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date thu">
						<div class="text-date">
							พฤหัสบดี
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date fri">
						<div class="text-date">
							ศุกร์
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date sat">
						<div class="text-date">
							เสาร์
							<span>30</span>
						</div>
						<div class="text-month">
							พฤศจิกายน
						</div>
					</div>
				</a>
				<a>
					<div class="box-tumb-date btn-all">
						<div class="box-text">
							<p>
								ดูทั้งหมด
								<img src="images/icon-arrow-right.png"/>
							</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="box-right">
			<div class="box-slideevent-main cf">
				<div class="slide-event cf">
					
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf sun">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf mon">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf tue">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf wed">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf thu">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf fri">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					<div class="box-content-slide cf">
						<div class="box-left">
							<div class="box-date cf sat">
								<div class="box-left">
									<p>30</p>
								</div>
								<div class="box-right">
									<p>
										ศุกร์<br>
										<span>พ.ย. 2559</span>
									</p>
								</div>
							</div>
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
						<div class="box-right">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/287x405">
								</div>
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
								</div>
							</a>
						</div>
					</div>
					
				</div>
				<div class="box-float">
					<div class="box-btn-left">
						<a class="btn black" href="">กิจกรรมวันนี้</a>
					</div>
					<div class="box-btn-right">
						<a class="btn-arrow left"></a>
						<div class="box-number cf">
							<p class="currentItem"><span class="result">30</span></p>
							<p class="ofCenter"> / </p>
							<p class="owlItems"><span class="result">00</span></p>
						</div>
						<a class="btn-arrow right"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="part-news cf">
	<div class="container">
		<div class="box-title">news</div>
		<div class="box-left">
			<div class="box-top cf">
				<div class="box-left">
					<div class="text-title">all exhibition<span>news</span></div>
					<a class="btn black" href="">ดูทั้งหมด</a>
				</div>
				<div class="box-right">
					<div class="box-news-bold cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
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
				</div>
			</div>
			<div class="box-bottom">
				<div class="box-news-main cf">
					<div class="box-news cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
								<div class="box-tag-cate">
									มิวเซี่ยม สยาม
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
					<div class="box-news cf mid">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
								<div class="box-tag-cate">

									มิวเซี่ยม สยาม

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
					<div class="box-news cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
								<div class="box-tag-cate">

									มิวเซี่ยม สยาม

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
				</div>
			</div>
		</div>
		<div class="box-right">
			<div class="box-museum-news-main">
				<div class="box-title">
					museum siam
					<span>news</span>
				</div>
				<div class="box-museum-news">
					<div class="museum-news cf">
						<div class="box-pic">
							<a href=""><img src="http://placehold.it/274x205"></a>
						</div>
						<div class="box-text">
							<a href=""><p class="text-title TcolorRed">
								Levitated Mass 340 Ton Giant Stone
							</p></a>
							<p class="text-date TcolorGray">
								28 พ.ย. 2559
							</p>
						</div>
					</div>
					<div class="museum-news cf">
						<div class="box-pic">
							<a href=""><img src="http://placehold.it/274x205"></a>
						</div>
						<div class="box-text">
							<a href=""><p class="text-title TcolorRed">
								Levitated Mass 340 Ton Giant Stone
							</p></a>
							<p class="text-date TcolorGray">
								28 พ.ย. 2559
							</p>
						</div>
					</div>
					<div class="museum-news cf">
						<div class="box-pic">
							<a href=""><img src="http://placehold.it/274x205"></a>
						</div>
						<div class="box-text">
							<a href=""><p class="text-title TcolorRed">
								Levitated Mass 340 Ton Giant Stone
							</p></a>
							<p class="text-date TcolorGray">
								28 พ.ย. 2559
							</p>
						</div>
					</div>
					<div class="museum-news cf">
						<div class="box-pic">
							<a href=""><img src="http://placehold.it/274x205"></a>
						</div>
						<div class="box-text">
							<a href=""><p class="text-title TcolorRed">
								Levitated Mass 340 Ton Giant Stone
							</p></a>
							<p class="text-date TcolorGray">
								28 พ.ย. 2559
							</p>
						</div>
					</div>
					<div class="box-btn cf">
						<a href="" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<div class="part-datanetwork">
	<div class="container">
		<div class="box-title">museum<span>data network</span></div>
		<div class="box-slide-network-main cf">
			<div class="slide-network cf">
				<div class="box-network">
					<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/274x205">
						</div>
					</a>
					<div class="box-text">
						<a href="">
							<p class="text-title">
								Levitated Mass 340 Ton Giant Stone
							</p>
						</a>
						<p class="text-location TcolorWhite">
							กรุงเทพมหานคร
						</p>
						<p class="text-date TcolorGray">
							28 พ.ย. 2559
						</p>
					</div>
				</div>
				<div class="box-network">
					<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/274x205">
						</div>
					</a>
					<div class="box-text">
						<a href="">
							<p class="text-title">
								Levitated Mass 340 Ton Giant Stone
							</p>
						</a>
						<p class="text-location TcolorWhite">
							กรุงเทพมหานคร
						</p>
						<p class="text-date TcolorGray">
							28 พ.ย. 2559
						</p>
					</div>
				</div>
				<div class="box-network">
					<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/274x205">
						</div>
					</a>
					<div class="box-text">
						<a href="">
							<p class="text-title">
								Levitated Mass 340 Ton Giant Stone
							</p>
						</a>
						<p class="text-location TcolorWhite">
							กรุงเทพมหานคร
						</p>
						<p class="text-date TcolorGray">
							28 พ.ย. 2559
						</p>
					</div>
				</div>
				<div class="box-network">
					<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/274x205">
						</div>
					</a>
					<div class="box-text">
						<a href="">
							<p class="text-title">
								Levitated Mass 340 Ton Giant Stone
							</p>
						</a>
						<p class="text-location TcolorWhite">
							กรุงเทพมหานคร
						</p>
						<p class="text-date TcolorGray">
							28 พ.ย. 2559
						</p>
					</div>
				</div>
				<div class="box-network">
					<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/274x205">
						</div>
					</a>
					<div class="box-text">
						<a href="">
							<p class="text-title">
								Levitated Mass 340 Ton Giant Stone
							</p>
						</a>
						<p class="text-location TcolorWhite">
							กรุงเทพมหานคร
						</p>
						<p class="text-date TcolorGray">
							28 พ.ย. 2559
						</p>
					</div>
				</div>
			</div>
			<a class="btn-arrow left"></a>
			<a class="btn-arrow right"></a>
			<div class="box-btn cf">
				<a href="" class="btn gold">ดูทั้งหมด</a>
			</div>
		</div>
	</div>
</div>

<div class="part-exhibition cf">
	<div class="container cf">
		<div class="box-exhibition-main cf">
			<div class="box-top">
				<div class="box-title">Virtual<span>Exhibition</span></div>
				<div class="box-btn cf">
					<a href="" class="btn black">ดูทั้งหมด</a>
				</div>
			</div>
			<div class="box-slide-exhibition-main">
				<div class="slide-exhibition">
					<div class="box-exhibition cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-exhibition cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-exhibition cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-exhibition cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-exhibition cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="box-archive-main cf">
			<div class="box-top">
				<div class="box-title">Digital<span>Archive</span></div>
				<div class="box-btn cf">
					<a href="" class="btn black">ดูทั้งหมด</a>
				</div>
			</div>
			<div class="box-slide-archive-main">
				<div class="slide-archive">
					<div class="box-archive cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-archive cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-archive cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-archive cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
					<div class="box-archive cf">
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
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="box-knowledge-main cf">
			<div class="box-left">
				<div class="box-title">KnowLedge<span>Management</span></div>
				<div class="box-btn cf">
					<a href="" class="btn gold">ดูทั้งหมด</a>
				</div>
			</div>
			<div class="box-right">
				<div class="box-knowledge-wrap">
					<div class="box-knowledge cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
						<div class="box-text">
							<a href="">
								<p class="text-title">
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
					<div class="box-knowledge cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
						<div class="box-text">
							<a href="">
								<p class="text-title">
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
					<div class="box-knowledge cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
						<div class="box-text">
							<a href="">
								<p class="text-title">
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
					<div class="box-knowledge cf">
						<a href="">
							<div class="box-pic">
								<img src="http://placehold.it/274x205">
							</div>
						</a>
						<div class="box-text">
							<a href="">
								<p class="text-title">
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
	</div>
</div>

<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
