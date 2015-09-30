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
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu1,.menu-left li.menu1 .submenu2").addClass("active");
		if ($('.menu-left li.menu1').hasClass("active")){
			$('.menu-left li.menu1').children(".submenu-left").css("display","block");
		}
			
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
				<li><a href="news-event-museum.php">กิจกรรมและข่าวสาร</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php">กิจกรรมและข่าวสารของมิวเซียมสยาม</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-museum.php">ข่าวประชาสัมพันธ์ของมิวเซียมสยาม</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ชื่อข่าว</li>
			</ol>
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
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>ข่าวประชาสัมพันธ์ของมิวเซียมสยาม</h1>
				<div class="box-btn">
					<a href="" class="btn red">กลับไปข่าวประชมสัมพันธ์</a>
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
						<div class="box-date-tumb">
							<p class="date">99</p>
							<p class="month">พ.ย.</p>
						</div>
						<div class="box-text">
							<p class="text-title">Levitated Mass 340 Ton Giant Stone</p>
							<p class="text-des">by MUSEUM SIAM</p>
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
							<a href="" class="btn black">ดูทั้งหมด</a>
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
				<div class="box-news-text">
					<p>
						Levitated Mass is a 2012 large-scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art. The installation consists of a 340-ton boulder affixed above a concrete trench through which visitors may walk. The nature, expense and scale of the installation made it an instant topic of discussion The work comprises a 21.5-foot tall boulder mounted on the walls of a 456-foot long concrete trench, surrounded by 2.5 acres of compressed decomposed granite. The boulder is bolted to two shelves affixed to the inner walls of the trench, which descends from ground level to 15 feet below the stone at its center, allowing visitors to stand directly below the megalith.
					</p>
				</div>
				<div class="box-footer-content cf">
					<div class="box-date-modified">
						วันที่แก้ไขล่าสุด :  28 พ.ย. 2559
					</div>
					<div class="box-plugin-social">
						Plugin Social
					</div>
				</div>
				
			</div>
			<div class="part-btn-back">
				<div class="box-btn cf">
					<a href="" class="btn red">กลับไปข่าวประชมสัมพันธ์</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
