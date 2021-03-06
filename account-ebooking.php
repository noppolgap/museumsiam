<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu4,.menu-left li.menu4 li.submenu1").addClass("active");
			if ($('.menu-left li.menu4').hasClass("active")){
				$('.menu-left li.menu4').children(".submenu-left").css("display","block");
			}
	});
</script>

</head>

<body id="account-booking">

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><?=$account_setting?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$history_shop?> e-Booking</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/th/title-accout.png" alt="ACCOUNT SETTINGS"/>
			</p>
		</div>
	</div>
</div>

<div class="part-account-main">
	<div class="container cf">
		<div class="box-account-left">
			<?php include('inc/inc-account-menu.php'); ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1><?=$history_shop?> e-Booking</h1>
			</div>
			<div class="box-table-main">
				<div class="table-row head cf">
					<div class="column order"><?=$booking_no?></div>
					<div class="column date"><?=$booking_date?></div>
					<div class="column name"><?=$exhibition?></div>
					<div class="column num"><?=$quantity?></div>
					<div class="column price"><?=$price?></div>
					<div class="column total"><?=$sum?></div>
					<div class="column status"><?=$status?></div>
				</div>

				<?php

					if ($_SESSION['LANG'] == 'TH') {
						$LANG_SQL = "PRODUCT_DESC_LOC AS CAT_DESC";
						$LANG_STATUS = "STATUS_NAME_LOC";
					} else if ($_SESSION['LANG'] == 'EN') {
						$LANG_SQL = "PRODUCT_DESC_ENG AS CAT_DESC";
						$LANG_STATUS = "STATUS_NAME_ENG";
					}

			        $sql= " SELECT ".$LANG_SQL.", ".$LANG_STATUS.", prod.CREATE_DATE, pic.QUANTITY, pic.PRICE, prod.SUMPRICE
							FROM trn_order AS prod
							LEFT JOIN ( SELECT ORDER_ID, PRODUCT_ID, QUANTITY, PRICE FROM ( SELECT * FROM trn_order_detail ORDER BY ORDER_DETAIL_ID ASC ) AS my_table_tmp GROUP BY ORDER_ID ) AS pic
							ON prod.ORDER_ID = pic.ORDER_ID AND prod.ORDER_ID = pic.ORDER_ID
							LEFT JOIN sys_app_user u ON u.USER_ID = prod.CUSTOMER_ID
							LEFT JOIN trn_product p ON p.PRODUCT_ID = pic.PRODUCT_ID
							LEFT JOIN trn_order_status s ON s.STATUS_ID = prod.FLAG
							WHERE prod.CUSTOMER_ID = '".$_SESSION['UID']."' AND (prod.TYPE = 'ticket' OR prod.TYPE = 'booking') ";

				    $sql .= "order by prod.ORDER_ID desc";

				   	$query = mysql_query($sql,$conn);

				   	while($row = mysql_fetch_array($query)) {

 				?>

					<div class="table-row list cf">
						<div class="column order">158686047</div>
						<div class="column date"><? echo ConvertDate($row['CREATE_DATE']); ?></div>
						<div class="column name"><? echo $row['PRODUCT_DESC_LOC']; ?></div>
						<div class="column num"><? echo $row['QUANTITY']; ?></div>
						<div class="column price"><? echo $row['PRICE']; ?></div>
						<div class="column total"><? echo $row['SUMPRICE']; ?></div>
						<div class="column status"><? echo $row['STATUS_NAME_LOC']; ?></div>
					</div>

				<? }
/*
				 ?>

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
<? */ ?>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>

</body>
</html>
<? CloseDB(); ?>