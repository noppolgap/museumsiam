<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");

$search_sql = "";
unset($_SESSION['text']);

if (isset($_GET['search'])) {
	if (isset($_POST['str_search']))
		$_SESSION['text'] = $_POST['str_search'];
	$search_sql .= "  AND (d.CONTENT_DESC_LOC like '%" . $_SESSION['text'] . "%'or  d.CONTENT_DESC_ENG like '%" . $_SESSION['text'] . "%') ";
}
?>
<!doctype html>
<html>
<head>
<?
	require ('inc_meta.php');
 ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script>
	$(document).ready(function() {
		$(".menutop li.menu5,.menu-left li.menu1,.menu-left li.menu1 .submenu3").addClass("active");
		if ($('.menu-left li.menu1').hasClass("active")) {
			$('.menu-left li.menu1').children(".submenu-left").css("display", "block");
		}
	}); 
</script>
	
</head>

<body>
	
<?php
		include ('inc/inc-top-bar.php');
 ?>
<?php
	include ('inc/inc-menu.php');
 ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php"><?=$newsAndEventCap ?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$procurementCap ?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
			include ('inc/inc-left-content-newsevent.php');
 ?>
			<?php
				include ('inc/inc-left-content-calendar.php');
 ?>
		</div>
		<div class="box-right main-content">

			<?php

			if ($_SESSION['LANG'] == 'TH') {
				$LANG_SQL = " d.CONTENT_DESC_LOC AS CONTENT_DESC , d.BRIEF_LOC AS BRIEF_LOC";
			} else if ($_SESSION['LANG'] == 'EN') {
				$LANG_SQL = " d.CONTENT_DESC_ENG AS CONTENT_DESC , d.BRIEF_ENG AS BRIEF_LOC";
			}

			$sql = " SELECT " . $LANG_SQL . ", p.IMG_PATH from trn_content_detail d
						 LEFT JOIN (
													SELECT CONTENT_ID, IMG_PATH, ORDER_ID, CAT_ID
													FROM (
														SELECT * 
														FROM trn_content_picture
														ORDER BY ORDER_ID ASC
													) AS my_table_tmp
													GROUP BY CONTENT_ID, CAT_ID
												) as p on  d.CONTENT_ID = p.CONTENT_ID
												AND d.CAT_ID = p.CAT_ID
											WHERE d.CAT_ID = $procurement_cat_id  and d.CONTENT_STATUS_FLAG = 0 ";

			$sql .= $search_sql . "ORDER BY d.ORDER_DATA DESC LIMIT 0 , 30";

			$query = mysql_query($sql, $conn);

			$num = mysql_num_rows($query);
			?>

 
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2><?=$procurementCap ?></h2>
				</div>

				<div class="box-news-main gray">

			   <? while($row = mysql_fetch_array($query)) {
			   		$IMG_PATH = str_replace("../../","",$row['IMG_PATH']);
			   		$iconType  = getEXT($IMG_PATH) ; 
			   	?>

					<div class="box-notice iconFile <?=$iconType ?>">
						<div class="box-text">
							<p class="text-title"><? echo $row['CONTENT_DESC'] ?></p>
							<p class="text-detail">
								<span><?=$typeCap ?>: <? echo getEXT($IMG_PATH) ?></span>
								<span><?=$sizeCap ?>: <?=formatSizeUnits(filesize($IMG_PATH)) ?></span>
							</p>
						</div>
						<div class="box-btn cf">
							<a href="<?=$IMG_PATH ?>" target="_blank" class="btn red"><?=$downloadCap ?></a>
						</div>
					</div>

				<? } ?>

					<div class="box-pagination-main cf Noborder" style="display: none">
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



<?php
	include ('inc/inc-footer.php');
 ?>	

</body>
</html>
