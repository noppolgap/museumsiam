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
<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/booking.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu2").addClass("active");		
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
				<li class="active">e-BOOKING</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-shopping.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-BOOKING</h1>
			</div>
			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart">ตะกร้าสินค้า 999</a>
			</div>

			<?php
						    $sql_proc  = "SELECT prod.PRODUCT_ID, prod.PRICE, prod.SALE, pic.CONTENT_ID, pic.IMG_PATH, pic.ORDER_ID
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
							
											WHERE prod.CAT_ID = ".$ebook_sub_cat ." AND prod.FLAG = 0 ";

							if (isset($_GET['search'])) {
								if (isset($_POST['str_search']))
									$_SESSION['text'] = $_POST['str_search'];
									$sql_proc .= " AND (prod.PRODUCT_DESC_LOC like '%" .$_SESSION['text']. "%' or  prod.PRODUCT_DESC_ENG like '%" .$_SESSION['text']. "%')";
							}
							else {
									unset($_SESSION['text']);
							}

							$sql_proc  .= "	ORDER BY prod.ORDER_DATA DESC LIMIT 0,6";

						    $query_proc = mysql_query($sql_proc,$conn);

							while($row_proc = mysql_fetch_array($query_proc)) { ?>


			<div class="box-booking-main">
				<div class="box-pic">
					<img src="<?=str_replace('../../','',$row_proc['IMG_PATH'])?>">
				</div>
				<div class="box-content-booking">
					<div class="box-top cf TcolorGold">
						<div class="box-text cf">
							<div class="box-left">
								อัตราค่าเข้าชม
							</div>
							<div class="box-right">
								<span><? echo $row_proc['PRICE']; ?></span> บาท/ท่าน
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>จำนวนผู้เข้าชม</p>
								<div><input type="number" name="number" value="1"></div>
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>รอบการเข้าชม</p>
								<div>
									<div class="SearchMenu-item">
										- เลือกรอบการเข้าชม -
										<select class="p-Absolute">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="box-text cf">
							<div class="box-left">
								ยอดสุทธิ
							</div>
							<div class="box-right">
								<span>-</span> บาท
							</div>
						</div>
						<div class="box-btn cf">
							<a href="e-booking-cart.php" class="btn red">ดำเนินการต่อ</a>
						</div>
						<hr class="line-gray"/>
					</div>
					<div class="box-detail">
						<p class="text-title">
							<?=$row['CONTENT_LOC']?>
						</p>
						<p class="text-des">
							<? echo $row_proc['PRODUCT_DESC']; ?>
						</p>
					</div>
				</div>
			</div>	


	   <? } ?>		

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
