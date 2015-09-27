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
			
			<?php 
				    $sql  = "SELECT p.PRODUCT_ID, p.PRODUCT_DESC_LOC,  p.PRICE,  od.QUATITY, (p.PRICE * od.QUATITY ) total,
							c.CONTENT_CAT_DESC_LOC , p.DETAIL 
							FROM trn_product  p
							left join trn_order_detail od on p.PRODUCT_ID = od.PRODUCT_ID
							left join trn_content_category c on  c.CONTENT_CAT_ID = p.CAT_ID
							WHERE p.Flag <>2 ";

				     $query = mysql_query($sql,$conn);

					 $num_rows = mysql_num_rows($query);
			?>

			<div class="box-table-main">
				<div class="table-row head">
					<div class="column list">สินค้า</div>
					<div class="column price">ราคา</div>
					<div class="column number">จำนวน</div>
					<div class="column total">มูลค่ารวม</div>
				</div>

			<?php while($row = mysql_fetch_array($query)) { ?>


				<div class="table-row list">
					<div class="column list cf">
						<div class="box-left">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</div>
						<div class="box-right">
							<p class="text-title"><? echo $row['PRODUCT_DESC_LOC']; ?></p>
							<p class="text-id">รหัสสินค้า : <span><? echo $row['PRODUCT_ID']; ?></span></p>
							<p class="text-cate">หมวดหมู่สินค้า : <span><? echo $row['CONTENT_CAT_DESC_LOC']; ?></span></p>
							<p class="text-detail">
								<? echo $row['DETAIL']; ?>
							</p>
						</div>
					</div>
					<div class="column price"><? echo $row['SALE']; ?></div>
					<div class="column number"><input type="number" name="number" value="<? echo $row['QUATITY']; ?>"></div>
					<div class="column total"><? echo $row['total']; ?></div>
					<a href="#" class="btn-delete"><span class="bin"></span>ลบรายการสินค้า</a>
				</div>


				<? } ?>
			
			</div>
			
			<div class="box-total-main cf">
				<div class="box-btn box1 cf">
					<a class="btn red">คำนวณราคาใหม่</a>
				</div>
				<hr class="line-gray"/>
				<div class="box-row cf">
					<div class="box-left">
						มูลค่า
					</div>
					<div class="box-right">
						999,999 <span>บาท</span>
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
						- <span>บาท</span>
					</div>
				</div>
				<hr class="line-gray"/>
				
				<div class="box-row cf total">
					<div class="box-left">
						ยอดสุทธิ
					</div>
					<div class="box-right">
						999,999 <span>บาท</span>
					</div>
				</div>
				
				<div class="box-row cf box2">
					<div class="box-left">
						<div class="box-btn box1 cf">
							<a class="btn red">ยกเลิกรายการ</a>
						</div>
					</div>
					<div class="box-right">
						<div class="box-btn box1 cf">
							<a class="btn red">ดำเนินการต่อ</a>
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
