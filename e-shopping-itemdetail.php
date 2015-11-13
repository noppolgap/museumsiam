<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

$PROID = intval($_GET['proid']);
$CID = intval($_GET['cid']);


if ($_SESSION['LANG'] == 'TH') {
$sql_cat_lang = "cc.CONTENT_CAT_DESC_LOC AS CONTENT_LOC ";
$sql_proc_lang = 'PRODUCT_DESC_LOC AS PRODUCT_DESC';
} else if ($_SESSION['LANG'] == 'EN') {
$sql_cat_lang = "cc.CONTENT_CAT_DESC_ENG AS CONTENT_LOC ";
$sql_proc_lang = 'PRODUCT_DESC_ENG AS PRODUCT_DESC';
}

$sql  = " SELECT ".$sql_proc_lang." , DETAIL , PRODUCT_ID , PRICE , SALE , CAT_ID FROM trn_product pro
LEFT JOIN trn_content_category cc ON pro.CAT_ID = cc.CONTENT_CAT_ID
WHERE pro.PRODUCT_ID = ".$PROID." AND pro.FLAG = 0 ";

$query = mysql_query($sql,$conn);
$row_detail = mysql_fetch_array($query);

$sql_cat = "SELECT " . $sql_cat_lang . " , cc.CONTENT_CAT_ID
FROM trn_content_category cc
JOIN sys_app_module am ON cc.REF_MODULE_ID = am.MODULE_ID
WHERE cc.REF_MODULE_ID = 7 AND cc.CONTENT_CAT_ID = " . $CID . "
AND cc.FLAG = 0 ";

$query_cat = mysql_query($sql_cat, $conn);
$rowCat = mysql_fetch_array($query_cat);
//echo $sql_cat;
?>
<!doctype html>
<html>
<head>
<?
	require ('inc_meta.php');
 ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/shopping.css" />

<script src="js/e-shopping.js"></script>

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
				<li><a href="other-system.php"><?=$otherSystemCap ?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="online-system.php">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="e-shopping.php">e-SHOPPING</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="e-shopping-category.php?cid=<?=$CID ?>"><?=$rowCat['CONTENT_LOC'] ?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$row_detail['PRODUCT_DESC']?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
			include ('inc/inc-left-content-shopping.php');
 ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-SHOPPING</h1>
				<div class="box-btn">
					<a href="e-shopping-category.php?cid=<?=$row_detail['CAT_ID'] ?>" class="btn red"><?=$backCap?></a>
				</div>
			</div>
			<?php
			$sql = "SELECT SUM(trn_shopping_cart_Quantity)  FROM `trn_shopping_cart` WHERE `trn_shopping_cart_SSID` = '" . session_id() . "'";
			$query = mysql_query($sql, $conn) or die($sql);
			$row = mysql_fetch_row($query);
			?>
			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart"><?=$cart?> <span><?=$row[0] ?></span></a>
			</div>

			<form action="product_action.php?add'" method="post" name="formcms">

			<input type="hidden" name="cus_id" value="1">
			<input type="hidden" name="price" value="<?=$row_detail['PRICE'] ?>">
			<input type="hidden" name="proid" value="<?=$row_detail['PRODUCT_ID'] ?>">
			<input type="hidden" name="cid" value="<?=$row_detail['CAT_ID'] ?>">

			<div class="box-category-main">
				<div class="box-title cf">
					<h2><? echo $rowCat['CONTENT_LOC']; ?></h2>
				</div>
				
				<div class="box-detailitem-main cf">
					<div class="box-left">
						<div class="slide-gallery-main">
							<div class="box-slide-big">
								<div id="sync1" class="owl-carousel">

						<?
						$thumb = '';
						$getPicSql = "SELECT IMG_PATH FROM trn_content_picture WHERE CONTENT_ID = " . $row_detail['PRODUCT_ID'] . " AND CAT_ID = " . $row_detail['CAT_ID'] . " ORDER BY ORDER_ID ASC";
						$query_pic = mysql_query($getPicSql, $conn);
						while ($row_pic = mysql_fetch_array($query_pic)) {
							$path = str_replace('../../', '', $row_pic['IMG_PATH']);
							echo $show = '<div class="slide-content slideProductImage" style="background-image: url(\'' . $path . '\');"> <img src="' . $path . '"> </div>';
							$thumb .= $show;
						}
						?>
								</div>
								<a class="btn-arrow-slide pev"></a>
								<a class="btn-arrow-slide next"></a>
							</div>
							<div class="box-slide-small">
								<div id="sync2" class="owl-carousel">
									<?=$thumb ?>
								</div>
							</div>
							<div class="text-id"><?=$product_code?> : <?=str_pad($row_detail['PRODUCT_ID'], 5, 0, STR_PAD_LEFT); ?></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-text-detail">
							<div class="text-tilte">
								<? echo $row_detail['PRODUCT_DESC']; ?>
							</div>
							<div class="text-detail">
								<?=nl2br(strip_tags($row_detail['DETAIL'], $allowTag)); ?>
								<!-- <? echo $row_detail['DETAIL']; ?> -->
							</div>
							<div class="text-price">
								<p>
									<?php
									if ($row_detail['SALE'] > 0) {
										echo '<span>'.$normalPrice.' : ' . $row_detail['PRICE'] . ' '.$bath.'</span>';
										echo $sale.' : ' . $row_detail['SALE'] . ' '.$bath;
									} else {
										echo '<strong>ราคา : ' . $row_detail['PRICE'] . ' '.$bath.'</strong>';
									}
									?>
								</p>
							</div>
							<div class="text-ship">
								Free Shipping
							</div>
							<div class="box-btn">
								<a href="#" onclick="addtocart(<?=$row_detail['PRODUCT_ID'] ?>,'shopping');" class="btn red">หยิบสินค้าลงตะกร้า</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php
	include ('inc/inc-footer.php');
 ?>
<script src="js/cart.js"></script>

</body>
</html>
<? CloseDB(); ?>
