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
		$(".menutop li.menu6,.menu-left li.menu2").addClass("active");
	});
</script>

</head>

<body id="cart">

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
				<div class="box-btn">
					<a href="e-booking.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>

			<div class="box-table-main">
				<form name="bookingForm" action="?" method="post">
				<div class="table-row head">
					<div class="column list">นิทรรศการ</div>
					<div class="column price">ราคา</div>
					<div class="column number">จำนวน</div>
					<div class="column total">มูลค่ารวม</div>
				</div>
			<?php
				$Quantity = $_POST['person'];

				if ($_SESSION['LANG'] == 'TH') {
					$LANG_SQL = "prod.PRODUCT_DESC_LOC AS CONTENT_DESC";
				} else if ($_SESSION['LANG'] == 'EN') {
					$LANG_SQL = "prod.PRODUCT_DESC_ENG AS CONTENT_DESC";
				}
				$sql_proc  = "SELECT ".$LANG_SQL.", prod.PRODUCT_ID, IF(prod.SALE > 0, prod.SALE, prod.PRICE) AS pro_PRICE, pic.CONTENT_ID, pic.IMG_PATH, pic.ORDER_ID , prod.DETAIL
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
							WHERE prod.CAT_ID = ".$ebook_sub_cat ." AND prod.FLAG = 0 AND PRODUCT_ID = ".intval($_POST['id']);

				$query_proc = mysql_query($sql_proc,$conn);
				$row_proc = mysql_fetch_array($query_proc);

				$total = ($row_proc['pro_PRICE'] * $Quantity);
			?>
				<div class="table-row list">
					<div class="column list cf">
						<div class="box-left">
							<div class="box-pic booking-pic">
								<img src="<?=str_replace('../../','',$row_proc['IMG_PATH'])?>">
							</div>
						</div>
						<div class="box-right">
							<p class="text-title"><?=$row_proc['CONTENT_DESC']?></p>
							<p class="text-detail"><?=strip_tags($row_proc['prod'])?></p>
						</div>
					</div>
					<div class="column price"><?=number_format($row_proc['pro_PRICE'],2)?></div>
					<div class="column number"><input min="0" type="number" name="person" value="<?=$Quantity?>"></div>
					<div class="column total"><?=number_format($total,2)?></div>
					<a href="#" class="btn-delete"><span class="bin"></span>ลบรายการสินค้า</a>
				</div>
				<input type="hidden" name="round" value="<?=$_POST['round']?>" />
				<input type="hidden" name="price" value="<?=$row_proc['pro_PRICE']?>" />
				<input type="hidden" name="id" value="<?=$row_proc['PRODUCT_ID']?>" />
				</form>
			</div>

			<div class="box-total-main cf">
				<div class="box-btn box1 cf">
					<a class="btn red" href="#" onclick="$('form[name=bookingForm]').submit();">คำนวณราคาใหม่</a>
				</div>
				<hr class="line-gray"/>
				<div class="box-row cf">
					<div class="box-left">
						มูลค่า
					</div>
					<div class="box-right">
						<?=number_format($total,2)?> <span>บาท</span>
					</div>
				</div>
				<hr class="line-gray"/>

				<div class="box-row cf total">
					<div class="box-left">
						ยอดสุทธิ
					</div>
					<div class="box-right">
						<?=number_format($total,2)?> <span>บาท</span>
					</div>
				</div>
				<form name="bookingSave" action="e-booking-action.php" method="post">
				<input type="hidden" name="round" value="<?=$_POST['round']?>" />
				<input type="hidden" name="price" value="<?=$row_proc['pro_PRICE']?>" />
				<input type="hidden" name="id" value="<?=$row_proc['PRODUCT_ID']?>" />
				<input type="hidden" name="person" value="<?=$Quantity?>" />
				<input type="hidden" name="type" value="" id="booking_type" />
				</form>
<?php
if(isset($_SESSION['UID'])){
	$ticket = "#\" onclick=\"$('#booking_type').val('ticket'); $('form[name=bookingSave]').submit(); return false;";
	$booking = "#\" onclick=\"$('#booking_type').val('booking'); $('form[name=bookingSave]').submit(); return false;";
}else{
	$ticket = "login.php";
	$booking = "login.php";
}
?>
				<div class="box-row cf box2">
					<div class="box-left">
						<div class="box-btn box1 cf">
							<a class="btn red" href="<?=$ticket?>">จองตั๋ว</a>
						</div>
					</div>
					<div class="box-right">
						<div class="box-btn box1 cf">
							<a class="btn red" href="<?=$booking?>" >ซื้อตั๋ว</a>
						</div>
					</div>
				</div>

			</div>
			<div class="box-btn-back">
				<div class="box-btn cf">
					<a href="e-shopping.php" class="btn red">ดูสินค้าเพิ่มเติม</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>

</body>
</html>
