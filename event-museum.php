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
				<li class="active">กิจกรรมของมิวเซียมสยาม</li>
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

			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>กิจกรรมของมิวเซียมสยาม</h2>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">

						<?php

						    $sql = " select d.CONTENT_DESC_LOC, d.CREATE_DATE, d.BRIEF_LOC, p.IMG_PATH
									from trn_content_detail d
									left join trn_content_category c on d.cat_id = c.content_cat_id
									left join trn_content_picture p on d.content_id = p.content_id
									where c.content_cat_id = 60 and d.sub_cat_id = 130 ";

							$query = mysql_query($sql, $conn);

							$num_rows = mysql_num_rows($query);

							$num = 0;
					    ?>

					<?php while($row = mysql_fetch_array($query)) { 

					    $IMG_PATH = str_replace("../../","",$row['IMG_PATH']);

						$space = "";
						$gap = "";

						

					?>

						<div class="box-tumb <? $gap ?>">
							<a href="">
								<div class="box-pic">
									<img src="<? echo $IMG_PATH ?>">
									<div class="box-tag-cate">
										<? echo $row['CONTENT_DESC_LOC'] ?>
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
										<? echo $row['CONTENT_DESC_LOC'] ?>
									</p>
								</a>
								<p class="text-date TcolorGray">
									<? echo ConvertDate($row['CREATE_DATE']) ?>
								</p>
								<p class="text-des TcolorBlack">
									<? echo $row['BRIEF_LOC'] ?>
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
					

					<? 
						$num++;
					    $line = $num / 3; 
					}
						
					
					?>

					<!--
						<div class="box-tumb cf mid">
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
						<hr class="line-gray"/>
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
						<div class="box-tumb cf mid">
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
						<hr class="line-gray"/>
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
						<div class="box-tumb cf mid">
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
					-->
						
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
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
