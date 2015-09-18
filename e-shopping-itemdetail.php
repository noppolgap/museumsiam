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
		$(".menutop li.menu6,.menu-left li.menu3,.submenu-left li.submenu1").addClass("active");
		
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
			items : 6,
			itemsMobile       : [320,6],
			itemsTablet       : [768,6],
			itemsDesktop      : [1024,6],
			navigation: false,
			pagination:false,
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
				<li><a href="#">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">e-SHOPPING</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">หมวดหมู่</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ชื่อสินค้า</li>
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
				<div class="box-detailitem-main cf">
					<div class="box-left">
						<div class="slide-gallery-main">
							<div class="box-slide-big">
								<div id="sync1" class="owl-carousel">
									<div class="slide-content">
										<img src="http://placehold.it/462x304">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/462x304/ccc">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/462x304">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/462x304/ccc">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/462x304">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/462x304/ccc">
									</div>
								</div>
								<a class="btn-arrow-slide pev"></a>
								<a class="btn-arrow-slide next"></a>
							</div>
							<div class="box-slide-small">
								<div id="sync2" class="owl-carousel">
									<div class="slide-content">
										<img src="http://placehold.it/85x63">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/85x63/ccc">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/85x63">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/85x63/ccc">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/85x63">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/85x63/ccc">
									</div>
								</div>
							</div>
							<div class="text-id">รหัสสินค้า : xxxxxx</div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-text-detail">
							<div class="text-tilte">
								New Look Embroidered Cami Top
							</div>
							<div class="text-detail">
								Top by New Look<br>
								- Lightweight wool-mix fabric<br>
								- Soft-touch finish<br>
								- All-over check design
							</div>
							<div class="text-price">
								<p>
									<span>ราคาปกติ : 980 บาท</span>
									ราคาพิเศษ : 882 บาท
								</p>
							</div>
							<div class="text-ship">
								Free Shipping
							</div>
							<div class="box-btn">
								<a href="e-shopping-cart.php" class="btn red">หยิบสินค้าลงตะกร้า</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>