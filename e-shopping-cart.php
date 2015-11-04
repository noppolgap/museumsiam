<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

if($_POST['action'] == 'reCal'){
	foreach ($_POST['Quantity'] as $key => $value) {
		if($value > 0){
			$update = "";
			$update[] = "trn_shopping_cart_Quantity = ".$value;
			$update[] = "trn_shopping_cart_CreateDate = NOW()";

			$sql = "UPDATE trn_shopping_cart SET  " . implode(",", $update) . " WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_Type = 'shopping' AND trn_shopping_cart_pID = ".intval($key);
		}else{
			$sql = "DELETE FROM trn_shopping_cart WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_Type = 'shopping' AND  trn_shopping_cart_pID = ".intval($key);
		}
		mysql_query($sql, $conn) or die($sql);
	}
}
if($_POST['action'] == 'DelAll'){
	foreach ($_POST['Quantity'] as $key => $value) {
		$sql = "DELETE FROM trn_shopping_cart WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_Type = 'shopping' AND  trn_shopping_cart_pID = ".intval($key);
		mysql_query($sql, $conn) or die($sql);
	}
	header('Location: e-shopping.php');
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
		$(".menutop li.menu6,.menu-left li.menu3").addClass("active");
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
					<a href="e-shopping.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
<form action="?" name="cart" id="cart_form" method="post">
			<?php
			/*
				    $sql  = "SELECT p.PRODUCT_ID, p.PRODUCT_DESC_LOC,  p.PRICE,  od.QUATITY, (p.PRICE * od.QUATITY ) total,
							c.CONTENT_CAT_DESC_LOC , p.DETAIL
							FROM trn_product  p
							left join trn_order_detail od on p.PRODUCT_ID = od.PRODUCT_ID
							left join trn_content_category c on  c.CONTENT_CAT_ID = p.CAT_ID
							WHERE p.Flag = 0 ";
			*/
$totalCost = 0;

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "PRODUCT_DESC_LOC AS CAT_DESC";
	$LANG_SQL_CAT = "CONTENT_CAT_DESC_LOC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "PRODUCT_DESC_ENG AS CAT_DESC";
	$LANG_SQL_CAT = "CONTENT_CAT_DESC_ENG";
}

				$sql  = "SELECT ".$LANG_SQL;
				$sql .= ",trn_shopping_cart_Quantity AS Total
						 ,PRICE
						 ,SALE
						 ,PRODUCT_ID
						 ,DETAIL
						 ,trn_product.CAT_ID AS MY_CAT
						 ,(SELECT ".$LANG_SQL_CAT." FROM trn_content_category WHERE CONTENT_CAT_ID = CAT_ID) AS CAT_DESC_LOC
						 ,(SELECT IMG_PATH FROM trn_content_picture WHERE CONTENT_ID = PRODUCT_ID AND IMG_TYPE = 1 AND CAT_ID = MY_CAT ORDER BY ORDER_ID ASC LIMIT 0 , 1) AS IMG_PATH
				FROM trn_shopping_cart LEFT JOIN trn_product ON trn_shopping_cart_pID = PRODUCT_ID WHERE trn_shopping_cart_Type = 'shopping' AND `trn_shopping_cart_SSID` = '" . session_id() . "'";
				$query = mysql_query($sql,$conn);

			if(mysql_num_rows($query) == 0){
				echo '<div Class="box-table-main box-no-item">No item</div>';
				$zeroItem = true;
			}else{
			?>

			<div class="box-table-main">
				<div class="table-row head">
					<div class="column list">สินค้า</div>
					<div class="column price">ราคา</div>
					<div class="column number">จำนวน</div>
					<div class="column total">มูลค่ารวม</div>
				</div>

			<?php
			while($row = mysql_fetch_array($query)) {

				if($row['SALE'] > 0){
					$price = $row['SALE'];
					$sum_price = $row['SALE']*$row['Total'];
				}else{
					$price = $row['PRICE'];
					$sum_price = $row['PRICE']*$row['Total'];
				}
				$path = str_replace('../../','',$row['IMG_PATH']);
				$totalCost += $sum_price;
			?>


				<div class="table-row list">
					<div class="column list cf">
						<div class="box-left">
							<a href="e-shopping-itemdetail.php?proid=<?=$row['PRODUCT_ID']?>"><span class="box-pic cart-pic"  style="background-image: url('<?=$path?>');"></span></a>
						</div>
						<div class="box-right">
							<p class="text-title"><a href="e-shopping-itemdetail.php?proid=<?=$row['PRODUCT_ID']?>"><? echo $row['CAT_DESC']; ?></a></p>
							<p class="text-id">รหัสสินค้า : <span><?=str_pad($row['PRODUCT_ID'], 5, 0, STR_PAD_LEFT);?></span></p>
							<p class="text-cate">หมวดหมู่สินค้า : <span><? echo $row['CAT_DESC_LOC']; ?></span></p>
							<p class="text-detail"><? echo $row['DETAIL']; ?></p>
						</div>
					</div>
					<div class="column price"><?=number_format($price,2)?></div>
					<div class="column number"><input id="Num_pro_ID<?=$row['PRODUCT_ID']?>" min="0" type="number" name="Quantity[<?=$row['PRODUCT_ID']?>]" value="<? echo $row['Total']; ?>"></div>
					<div class="column total"><?=number_format($sum_price,2)?></div>
					<a href="#" class="btn-delete" onclick="$('#Num_pro_ID<?=$row['PRODUCT_ID']?>').val(0); saveFormCart('reCal'); return false;"><span class="bin"></span>ลบรายการสินค้า</a>
				</div>


			<? } } ?>

			</div>

			<div class="box-total-main cf">
				<div class="box-btn box1 cf">
					<a class="btn red" href="#" onclick="saveFormCart('reCal'); return false;">คำนวณราคาใหม่</a>
				</div>
				<hr class="line-gray"/>
				<div class="box-row cf">
					<div class="box-left">
						มูลค่า
					</div>
					<div class="box-right">
						<?=number_format($totalCost,2)?> <span>บาท</span>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						รูปแบบการจัดส่ง
					</div>
					<div class="box-right">
						จัดส่งแบบลงทะเบียน
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						ค่าจัดส่งสินค้า
					</div>
					<div class="box-right">
						<?=number_format($shipping_cost,2)?> <span>บาท</span>
					</div>
				</div>
				<hr class="line-gray"/>

				<div class="box-row cf total">
					<div class="box-left">
						ยอดสุทธิ
					</div>
					<div class="box-right">
						<?=number_format(($totalCost+$shipping_cost),2)?> <span>บาท</span>
					</div>
				</div>

				<div class="box-row cf box2">
					<div class="box-left">
						<div class="box-btn box1 cf">
							<a class="btn red" href="#" onclick="saveFormCart('DelAll')">ยกเลิกรายการ</a>
						</div>
					</div>
					<div class="box-right">
						<div class="box-btn box1 cf">
						<?php
						if(isset($zeroItem)){
							echo '<a class="btn red zeroItem" href="#">ดำเนินการต่อ</a>';
						}else if(isset($_SESSION['UID'])){
							echo '<a class="btn red" href="e-shopping-address.php">ดำเนินการต่อ</a>';
						}else{
							echo '<a class="btn red" href="login.php?p=shopping">ดำเนินการต่อ</a>';
						}
						?>
						</div>
					</div>
				</div>
		<input type="hidden" id="hidden_action" name="action" value="">
</form>



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
<script src="js/cart.js"></script>

</body>
</html>
<? CloseDB(); ?>
