<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

$search_sql = "";
unset($_SESSION['text']);
if (isset($_GET['search'])) {
			if (isset($_POST['str_search']))
				$_SESSION['text'] = $_POST['str_search'];
				$search_sql .= " AND (prod.PRODUCT_DESC_LOC like '%" .$_SESSION['text']. "%' or  prod.PRODUCT_DESC_ENG like '%" .$_SESSION['text']. "%')";
}


$currentPage = 1;
if (isset($_GET['PG'])){
	$currentPage = $_GET['PG'];
}

if ($currentPage < 1)
	$currentPage = 1;

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['SHOPPING_PREV_PG'] = $current_url;

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/shopping.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu3,.menu-left li.menu3 .submenu1").addClass("active");
			if ($('.menu-left li.menu3').hasClass("active")){
				$('.menu-left li.menu3').children(".submenu-left").css("display","block");
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
				<li><a href="#">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">e-SHOPPING</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ของที่ระลึก</li>
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
					<a href="e-shopping.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<?php
			$sql = "SELECT SUM(trn_shopping_cart_Quantity)  FROM `trn_shopping_cart` WHERE `trn_shopping_cart_SSID` = '".session_id()."'";
			$query = mysql_query($sql, $conn) or die($sql);
			$row = mysql_fetch_row($query);
			?>
			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart">ตะกร้าสินค้า <span><?=$row[0]?></span></a>
			</div>


			<?php
				if ($_SESSION['LANG'] == 'TH') {
					$sql_cat_lang  = "cc.CONTENT_CAT_DESC_LOC AS CONTENT_LOC ";
					$sql_proc_lang = 'prod.PRODUCT_DESC_LOC AS PRODUCT_DESC';
				} else if ($_SESSION['LANG'] == 'EN') {
					$sql_cat_lang  = "cc.CONTENT_CAT_DESC_ENG AS CONTENT_LOC ";
					$sql_proc_lang = 'prod.PRODUCT_DESC_ENG AS PRODUCT_DESC';
				}
			        $sql_cat  = "SELECT ".$sql_cat_lang." , cc.CONTENT_CAT_ID
					FROM trn_content_category cc
					JOIN sys_app_module am ON cc.REF_MODULE_ID = am.MODULE_ID
					WHERE cc.REF_MODULE_ID = 7 AND cc.CONTENT_CAT_ID = ".$_GET['cid']."
					AND cc.FLAG = 0 ";

			    $query_cat = mysql_query($sql_cat,$conn);

				$num_rows = mysql_num_rows($query_cat);
				$row = mysql_fetch_array($query_cat);
			?>


			<div class="box-category-main">

				<div class="box-title cf">
					<h2><? echo $row['CONTENT_LOC']; ?></h2>
				</div>
				<?php
					$sql_proc  = "SELECT * FROM trn_product AS prod
											LEFT JOIN (
												SELECT CONTENT_ID, IMG_PATH, ORDER_ID, CAT_ID
												FROM (
													SELECT *
													FROM trn_content_picture
													ORDER BY ORDER_ID ASC
												) AS my_table_tmp
												GROUP BY CONTENT_ID, CAT_ID
											) AS pic ON prod.PRODUCT_ID = pic.CONTENT_ID
											AND prod.CAT_ID = pic.CAT_ID
											WHERE prod.CAT_ID = ".$row['CONTENT_CAT_ID']." AND prod.FLAG = 0 ";

					
  				    $sql_proc .=	$search_sql." ORDER BY prod.ORDER_DATA DESC Limit 30 offset " . (30 * ($currentPage - 1));
					$query_proc = mysql_query($sql_proc,$conn);
					$num_rows = mysql_num_rows($query_proc);
				?>

				<div class="box-item-main cf">

					<?php while($row_proc = mysql_fetch_array($query_proc)) { ?>

					   <div class="item">
						<a href="e-shopping-itemdetail.php?proid=<?=$row_proc['PRODUCT_ID']?>">
							<div class="box-pic">
								<span class="helper"></span>
								<img src="<?=str_replace('../../','',$row_proc['IMG_PATH'])?>">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-itemdetail.php?proid=<?=$row_proc['PRODUCT_ID']?>">
								<p class="text-title">
									<? echo $row_proc['PRODUCT_DESC_LOC']; ?>
								</p>
							</a>
							<p class="text-price">
								ราคา : <? echo $row_proc['PRICE']; ?> บาท<br>
								<?php
								if($row_proc['SALE'] > 0){
									echo '<span>ราคาพิเศษ : '.$row_proc['SALE'].' บาท</span>';
								}
								?>
							</p>
						</div>

				</div>
				<? } ?>
				</div>
				<div class="box-pagination-main cf">
					<ul class="pagination">
						<?php

							$countContentSql = "SELECT count(1) as ROW_COUNT FROM trn_product WHERE CAT_ID = ".$row['CONTENT_CAT_ID']." AND FLAG = 0 ";

							$queryCount = mysql_query($countContentSql, $conn);

							$dataCount = mysql_fetch_assoc($queryCount);

							$contentCount = $dataCount['ROW_COUNT'];

							$maxPage = ceil($contentCount / 30);

							$extraClass = '';
							if ($currentPage == 1) {
								$extraClass = 'class="deactive"';
							}
							echo $pageStart;
							echo '<li ' . $extraClass . '><a href="?PG=' . ($currentPage - 1) . '" class="btn-arrow-left"></a></li>';

							for ($idx = 0; $idx < 3; $idx++) {
								if (($currentPage + $idx) > $maxPage)
									break;
								$activeClass = '';
								if ($idx == 0) {
									$activeClass = ' class="active"';
								}
								echo '<li ' . $activeClass . '><a href="?PG=' . ($currentPage + $idx) . '">' . ($currentPage + $idx) . '</a></li>';
							}
							$extraClassAtEnd = '';
							if (($currentPage + 1) >= $maxPage) {
								$extraClassAtEnd = 'class="deactive"';
							}
							echo '<li ' . $extraClassAtEnd . '><a href="?PG=' . ($currentPage + 1) . '" class="btn-arrow-right"></a></li>';
							?>
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>

</body>
</html>
