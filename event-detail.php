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
		$(".menutop li.menu5,.menu-left li.menu1,.menu-left li.menu1 .submenu1").addClass("active");
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
				<li><a href="news-museum.php">กิจกรรมของมิวเซียมสยาม</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>

				<? 
					$MID = intval($_GET['MID']);
					$CID = intval($_GET['CID']);
					$SID = intval($_GET['SID']);
					$NID = intval($_GET['NID']);


				    $sql_title = " select CONTENT_DESC_LOC from trn_content_detail where CONTENT_ID = $NID";

					$query_title = mysql_query($sql_title, $conn);


					while($row_title = mysql_fetch_array($query_title)) {
				?>

					<li class="active"><? echo $row_title['CONTENT_DESC_LOC'] ?></li>

				<? } ?>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php

			    $sql = " SELECT
							cat.CONTENT_CAT_DESC_LOC,
							cat.CONTENT_CAT_DESC_ENG,
							cat.CONTENT_CAT_ID,
							content.SUB_CAT_ID,
							content.CONTENT_ID,
							content.CONTENT_DESC_LOC,
							content.CONTENT_DESC_ENG,
							content.BRIEF_LOC,
							content.BRIEF_ENG,
							content.EVENT_START_DATE,
							content.EVENT_END_DATE,
							content.CREATE_DATE ,
							content.LAST_UPDATE_DATE ,
							content.USER_CREATE,
							content.PLACE_DESC_LOC,
							IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
						FROM
							trn_content_category cat
						INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
						WHERE
							cat.REF_MODULE_ID = $MID
						AND cat.flag = 0
						AND cat.CONTENT_CAT_ID = $CID
						AND content.SUB_CAT_ID = $SID
						AND content.APPROVE_FLAG = 'Y'
						AND content.CONTENT_STATUS_FLAG  = 0 
						AND content.CONTENT_ID = $NID
						ORDER BY content.ORDER_DATA desc ";

				$query = mysql_query($sql, $conn);

			    $num_rows = mysql_num_rows($query);
?>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-newsevent.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>กิจกรรมของมิวเซียมสยาม</h1>
				<div class="box-btn">
					<a href="event-museum.php" class="btn red">กลับไปกิจกรรมของมิวเซียมสยาม</a>
				</div>
			</div>

		<? 

			while($row = mysql_fetch_array($query)) {

			$date = ConvertBoxDate($row['EVENT_START_DATE']);

	   ?>

			<div class="box-newsdetail-main">
				<div class="box-slide-big">
					<div id="sync1" class="owl-carousel">

						<? 
							$sql_pic = " select  IMG_PATH
							from  trn_content_picture 
							where content_id = ".$row['CONTENT_ID']." ";

							$query_pic = mysql_query($sql_pic, $conn);

							$num_rows = mysql_num_rows($query_pic); 

							while($row_pic = mysql_fetch_array($query_pic)) { 

								$IMG_PATH = str_replace("../../","",$row_pic['IMG_PATH']);
						?>
						<div class="slide-content">
							<img src="<? echo $IMG_PATH ?>">
						</div>

						<? }  ?>
						
					</div>
					<a class="btn-arrow-slide pev"></a>
					<a class="btn-arrow-slide next"></a>
					<div class="box-title-main">
						<div class="box-date-tumb">
							<p class="date"><?=$date[0]?></p>
							<p class="month"><?=$date[1]?></p>
						</div>
						<div class="box-text">
							<p class="text-title"><? echo $row['CONTENT_DESC_LOC'] ?></p>
							<p class="text-des">By <? echo $row['USER_CREATE'] ?></p>
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
				<div class="box-when">
					<h3>WHEN</h3>
					<p class="text-date"><? echo ConvertDate($row['EVENT_START_DATE']) ?> - <? echo ConvertDate($row['EVENT_END_DATE']) ?></p>
					<p class="text-time">10.30 น. - 18.00 น.</p>
					<p class="text-location"><? echo $row['PLACE_DESC_LOC'] ?></p>
				</div>
				<div class="box-ticket">
					<h3>TICKET</h3>
					<p class="text-ticket">Free with Museum Admission</p>
				</div>
				<div class="box-news-text">
					<p>
						<? echo $row['CONTENT_DETAIL_LOC'] ?>
					</p>
				</div>
				<div class="box-footer-content cf">
					<div class="box-date-modified">
						วันที่แก้ไขล่าสุด :  <? echo ConvertDate($row['LAST_UPDATE_DATE']) ?>
					</div>
					<div class="box-plugin-social">
						Plugin Social
					</div>
				</div>
				
			</div>
		<? } ?>
			<div class="part-btn-back">
				<div class="box-btn cf">
					<a href="event-museum.php" class="btn red">กลับไปกิจกรรมของมิวเซียมสยาม</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
