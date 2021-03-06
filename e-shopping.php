<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require("inc/inc-cat-id-conf.php");

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {
		if (isset($_POST['str_search']))
			$_SESSION['text'] = $_POST['str_search'];
			$search_sql .= " AND (prod.PRODUCT_DESC_LOC like '%" .$_SESSION['text']. "%' or  prod.PRODUCT_DESC_ENG like '%" .$_SESSION['text']. "%')";
	}

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/shopping.css" />

<script>
	$(document).ready(function(){
		//$(".menutop li.menu6,.menu-left li.menu3").addClass("active");
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
				<li><a href="other-system.php"><?=$otherSystemCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="online-system.php?MID=<?=$_GET['MID']?>">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">e-SHOPPING</li>
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
					<a href="online-system.php?MID=<?=$_GET['MID']?>" class="btn red"><?=$backCap?></a>
				</div>
			</div>

			<?php
			/*
			     $sql_sumorder  = " SELECT count( o.ORDER_ID ) total_order
										FROM trn_order_detail od
										LEFT JOIN trn_order o ON od.ORDER_ID = o.ORDER_ID
										WHERE od.CUSTOMER_ID =1 ";

			     $query_sumorder = mysql_query($sql_sumorder,$conn);

				 $num_rows = mysql_num_rows($query_sumorder);

				 while($row_sumorder = mysql_fetch_array($query_sumorder)){
			*/
			$sql = "SELECT SUM(trn_shopping_cart_Quantity)  FROM `trn_shopping_cart` WHERE `trn_shopping_cart_SSID` = '".session_id()."'";
			$query = mysql_query($sql, $conn) or die($sql);
			$row = mysql_fetch_row($query);
			?>

			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart"><?=$cart?> <span><?=$row[0]?></span></a>
			</div>

			<? //} ?>


		<?php
		        $sql_cat  = "SELECT cc.CONTENT_CAT_ID , ";

				if ($_SESSION['LANG'] == 'TH') {
					$sql_cat .= "cc.CONTENT_CAT_DESC_LOC AS CONTENT_LOC ";
					$sql_proc_lang = 'prod.PRODUCT_DESC_LOC AS PRODUCT_DESC';
				} else if ($_SESSION['LANG'] == 'EN') {
					$sql_cat .= "cc.CONTENT_CAT_DESC_ENG AS CONTENT_LOC ";
					$sql_proc_lang = 'prod.PRODUCT_DESC_ENG AS PRODUCT_DESC';
				}
				$sql_cat  .= "FROM trn_content_category cc
					JOIN sys_app_module am ON cc.REF_MODULE_ID = am.MODULE_ID
					WHERE cc.REF_MODULE_ID = ".$education_cat_id."
					AND cc.FLAG = 0 order by cc.ORDER_DATA desc ";

			    $query_cat = mysql_query($sql_cat,$conn);

				$num_rows = mysql_num_rows($query_cat);
				while($row = mysql_fetch_array($query_cat)) {
		?>
			<div class="box-category-main">
				<div class="box-title cf">

					<h2><?=$row['CONTENT_LOC']?></h2>

					<div class="box-btn">
						<a href="e-shopping-category.php?cid=<?=$row['CONTENT_CAT_ID']?>" class="btn gold"><?=$seeAllCap?></a>
					</div>
				</div>
				<div class="box-item-main cf">

					<?php
						    $sql_proc  = "SELECT prod.PRODUCT_ID, ".$sql_proc_lang.", prod.PRICE, prod.SALE, pic.CONTENT_ID, pic.IMG_PATH, pic.ORDER_ID
											FROM trn_product AS prod
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

							

							$sql_proc  .= $search_sql."	ORDER BY prod.ORDER_DATA DESC";

						     $query_proc = mysql_query($sql_proc,$conn);

							while($row_proc = mysql_fetch_array($query_proc)) { ?>


					<div class="item">
						<a href="e-shopping-itemdetail.php?proid=<?=$row_proc['PRODUCT_ID']?>&cid=<?=$row['CONTENT_CAT_ID']?>">
							<div class="box-pic">
								<span class="helper"></span>
								<img src="<?=str_replace('../../','',$row_proc['IMG_PATH'])?>">
							</div>
						</a>
						<div class="box-text">
							<a href="e-shopping-itemdetail.php?proid=<?=$row_proc['PRODUCT_ID']?>&cid=<?=$row['CONTENT_CAT_ID']?>">
								<p class="text-title">
									<? echo $row_proc['PRODUCT_DESC']; ?>
								</p>
							</a>
							<p class="text-price">
								<?=$price?> : <? echo $row_proc['PRICE']; ?> <?=$bath?><br>
							<?php
							if($row_proc['SALE'] > 0){
								echo '<span>'.$sale.' : '.$row_proc['SALE'].' <?=$bath?></span>';
							}
							?>
							</p>
						</div>
					</div>

				<? } ?>

				</div>
			</div>
			<? } ?>


		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>
<script src="js/cart.js"></script>

</body>
</html>
<? CloseDB(); ?>
