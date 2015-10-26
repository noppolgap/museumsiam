<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>
	
<!-- ScrollIt -->
<script src="js/scrollIt.js"></script>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/system-template.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu3,.menu-left li.menu3 .submenu1").addClass("active");
			if ($('.menu-left li.menu3').hasClass("active")){
				$('.menu-left li.menu3').children(".submenu-left").css("display","block");
			}
		$.scrollIt({
			topOffset: -130 // offste (in px) for fixed top navigation
		});
			
		var sync1 = $("#sync1");
		var sync2 = $("#sync2");
		
		sync1.owlCarousel({
			singleItem : true,
			paginationSpeed : 500,
			rewindSpeed : 1000,
			navigation: false,
			pagination:false,
			afterAction : syncPosition,
			responsiveRefreshRate : 200,
			mouseDrag : false,
			rewindNav:true
		});
		
		sync2.owlCarousel({
			paginationSpeed : 500,
			rewindSpeed : 1000,
			items : 5,
			itemsMobile       : [320,5],
			itemsTablet       : [768,5],
			itemsDesktop      : [1024,5],
			navigation: false,
			pagination:true,
			responsiveRefreshRate : 100,
			mouseDrag : false,
			afterInit : function(el){
			el.find(".owl-item").eq(0).addClass("synced");
			},
			rewindNav:false
		});
		
		function syncPosition(el){
		var current = this.currentItem;
			$("#sync2")
			.find(".owl-item")
			.removeClass("synced")
			.eq(current)
			.addClass("synced")
			if($("#sync2").data("owlCarousel") !== undefined){
				center(current)
			}
		}
		
		$("#sync2").on("click", ".owl-item", function(e){
			e.preventDefault();
			var number = $(this).data("owlItem");
			sync1.trigger("owl.goTo",number);
		});
		
		function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		
		var num = number;
		var found = false;
		for(var i in sync2visible){
			if(num === sync2visible[i]){
				var found = true;
			}
		}
		
		if(found===false){
			if(num>sync2visible[sync2visible.length-1]){
				sync2.trigger("owl.goTo", num - sync2visible.length+2)
			}else{
				if(num - 1 === -1){
					num = 0;
				}
			sync2.trigger("owl.goTo", num);
			}
			} else if(num === sync2visible[sync2visible.length-1]){
				sync2.trigger("owl.goTo", sync2visible[1])
			} else if(num === sync2visible[0]){
				sync2.trigger("owl.goTo", num-1)
			}
		}
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

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="system-template.php">ชื่อระบบ</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="system-all-template.php">ชื่อหมวดหมู่</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ชื่อหัวข้อ</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-system.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<div class="box-btn">
					<a href="" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<div class="box-newsdetail-main">
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
					<div class="box-title-main">
						<div class="box-text">
							<p class="text-title">Levitated Mass 340 Ton Giant Stone</p>
							<p class="text-des pin">ชื่อสถานที่</p>
						</div>
					</div>
				</div>
				<div class="box-social-main cf">
					<a href="#" class="btn fb"></a>
					<a href="#" class="btn tw"></a>
					<a href="#" class="btn g"></a>
					<a href="#" class="btn line"></a>
				</div>
				<div class="part-tumb-main">
					<div  class="text-title cf">
						<p>แกลเลอรี</p>
						<div class="box-btn">
							<a href="all-media.php" class="btn black">ดูทั้งหมด</a>
						</div>
					</div>
					<div class="box-slide-small">
						<div id="sync2" class="owl-carousel">
							<div class="slide-content">
								<img src="http://placehold.it/125x94">
							</div>
							<div class="slide-content">
								<img src="images/tumb-sound.jpg">
							</div>
							<div class="slide-content">
								<img src="http://placehold.it/125x94">
							</div>
							<div class="slide-content">
								<img src="images/tumb-vdo.jpg">
							</div>
							<div class="slide-content">
								<img src="http://placehold.it/125x94">
							</div>
							<div class="slide-content">
								<img src="http://placehold.it/125x94/ccc">
							</div>
						</div>
					</div>
				</div>
				
				<div class="box-btn cf toBottom">
					<a class="btn red" data-scroll-nav='1'>กิจกรรมและข่าวสารของพิพิธภัณฑ์</a>
				</div>
				
				<div class="box-gray first">
					<h3>ที่อยู่และเบอร์ติดต่อ</h3>
					<p class="text-location">100 ถนนราชดำเนินกลาง แขวงบวรนิเวศ เขตพระนคร กรุงเทพมหานคร 10220</p>
					<p class="text-tel"><a href="tel:+66026210044" target="_blank">+66(0)2 621 0044</a> , <a href="tel:+66022265047" target="_blank">+66(0)2 226 5047</a></p>
					<p class="text-fax"><a href="tel:+66026210043" target="_blank">+66(0)2 621 0043</a></p>
					<p class="text-web"><a href="http://www.nitasrattanakosin.com/" target="_blank">http://www.nitasrattanakosin.com/</a></p>
				</div>
				<div class="box-gray">
					<h3>วันและเวลาทำการ</h3>
					<p class="text-date">อังคาร - อาทิตย์</p>
					<p class="text-time">10.30 น. - 18.00 น.</p>
				</div>
				<div class="box-gray">
					<h3>ผู้ชมกลุ่มเป้าหมาย</h3>
					<p>ผู้ใหญ่ และชาวต่างชาติ เด็ก นักเรียน/นักศึกษา ผู้สูงอายุ ภิกษุ สามเณร และ ผู้พิการ</p>
				</div>
				<div class="box-gray">
					<h3>ค่าเข้าชม</h3>
					<p class="text-ticket">ผู้ใหญ่ และชาวต่างชาติ ราคา 100 บาท<br>
					เข้าชมฟรี สำหรับ เด็ก นักเรียน/นักศึกษา ผู้สูงอายุ ภิกษุ สามเณร และ ผู้พิการ</p>
				</div>
				
				<div class="box-gray noIcon">
					<h3>การเดินทางถึงพิพิธภัณฑ์/แหล่งเรียนรู้</h3>
					<span>สถานที่สำคัญใกล้เคียง</span>
					<p>โลหะ ปราสาท วัดราชนัดดาฯ, ลานพลับพลามหาเจษฎาบดินทร์ (ศาลาเฉลิมไทยเก่า), ป้อมมหากาฬ,<br>
					        พระบรมบรรพต หรือ ภูเขาทอง วัดสระเกศ และอนุสาวรีย์ประชาธิปไตย
					 </p>
					<span>สถานที่สำคัญใกล้เคียง</span>
					<p>โลหะ ปราสาท วัดราชนัดดาฯ, ลานพลับพลามหาเจษฎาบดินทร์ (ศาลาเฉลิมไทยเก่า), ป้อมมหากาฬ,<br>
					        พระบรมบรรพต หรือ ภูเขาทอง วัดสระเกศ และอนุสาวรีย์ประชาธิปไตย
					 </p>
					<span>สถานที่สำคัญใกล้เคียง</span>
					<p>โลหะ ปราสาท วัดราชนัดดาฯ, ลานพลับพลามหาเจษฎาบดินทร์ (ศาลาเฉลิมไทยเก่า), ป้อมมหากาฬ,<br>
					        พระบรมบรรพต หรือ ภูเขาทอง วัดสระเกศ และอนุสาวรีย์ประชาธิปไตย
					 </p>
				</div>
				
				<div class="box-white">
					<h3>ประวัติความเป็นมา</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>ลักษณะทางกายภาพของพิพิธภัณฑ์/แหล่งเรียนรู้</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				
				<div class="box-white">
					<h3>ภูมิทัศน์โดยรอบ</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>ภาพถ่ายห้องจัดแสดง</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>วัตถุจัดแสดง</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>วัตถุจัดแสดงที่มีความสำคัญ</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>การจัดเก็บ</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>แหล่งเรียนรู้อื่นๆในเขตพื้นที่ใกล้เคียง</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
					<div class="box-img cf">
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
						<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
					</div>
				</div>
				<div class="box-white">
					<h3>ผู้ดูแลและหน่วยงานที่รับผิดชอบในปัจจุบัน</h3>
					<p>อาคารบริเวณถนนราชดำเนินกลาง เป็นงานสถาปัตยกรรมที่เป็นส่วนหนึ่งของประวัติศาสตร์กรุงเทพมหานคร นับตั้งแต่มี พระราชดำริของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว(รัชกาลที่ ๕) ให้ตัดถนนราชดำเนินจากพระราชวังดุสิตไปยัง พระบรมมหาราชวัง โดยจัดวางรูปแบบตามลักษณะของ Champs Elysees ในประเทศฝรั่งเศส<br><br>
						การก่อสร้างถนนราชดำเนินเริ่มตั้งแต่ปี พ.ศ. ๒๔๔๒ ส่วนอาคารตลอดแนวถนนราชดำเนินกลางได้เริ่มดำเนินการในปี พ.ศ. ๒๔๘๐ โดยการเวนคืนที่ดินทั้งสองฝั่งถนนข้างละ ๔๐ เมตร และออกแบบโดยสถาปนิกหลายท่าน ได้แก่ มล.ปุ่ม มาลากุล, คุณหมิว อภัยวงศ์ ซึ่งใช้แนวความคิดในการออกแบบจาก Champ Elysees ตามพระราชดำริเดิมของพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว
					 </p>
				</div>

				<div class="box-white social">
					<h3>การเผยแผร่และประชาสัมพันธ์</h3>
					<p><span>Facebook</span><a href="http://www.facebook.com/nitasrattanakosin" target="_blank">http://www.facebook.com/nitasrattanakosin</a></p>
					<p><span>Twitter </span><a href="http://www.twtter.com/nitasrattanakosin" target="_blank">http://www.twtter.com/nitasrattanakosin</a></p>
					<p><span>Youtube</span><a href="http://www.youtube.com/nitasrattanakosin" target="_blank">http://www.youtube.com/nitasrattanakosin</a></p>
				</div>

				<div class="box-footer-content cf">
					<div class="box-date-modified">
						วันที่แก้ไขล่าสุด :  28 พ.ย. 2559
					</div>
					<div class="box-plugin-social">
						Plugin Social
					</div>
				</div>
				
				<div class="box-newsevent-main cf" data-scroll-index="1">
					<div class="box-category-main news BGray box-left">
						<div class="box-title cf ">
							<h2>กิจกรรม</h2>
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
						</div>
					</div>
					<div class="box-category-main news BGray box-right">
						<div class="box-title cf ">
							<h2>ข่าวสาร</h2>
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
						</div>
					</div>
				</div>
				
			</div>
			<div class="part-btn-back">
				<div class="box-btn cf">
					<a href="" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
