<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body>
<? require('../inc_header.php'); ?>		
<div class="main-container">
	<div class="main-body marginC">
		<? require('../inc_side.php'); ?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="พิมพ์" class="buttonAction emerald-flat-button" onclick="window.print();">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>			
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">ใบสั่งซื้อสินค้า</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="customerDetail">
						<div class="orderDetailBox floatL orderDetailBox1">
							<div class="floatL orderDetailBoxTitle">ถึง</div>
							<div class="floatL orderDetailBoxText">ธนากร ประสารศรี</div>
							<div class="floatL orderDetailBoxTitle">ที่อยู่</div>
							<div class="floatL orderDetailBoxText">san apartment (ห้อง 19) 92/108 ม.14 ต.ในเมือง อ.เมือง จ.ขอนแก่น 40000</div>
							<div class="floatL orderDetailBoxTitle">เบอร์โทรศัพท์</div>
							<div class="floatL orderDetailBoxText">-</div>
							<div class="floatL orderDetailBoxTitle">เบอร์มือถือ</div>
							<div class="floatL orderDetailBoxText">0942894046</div>
							<div class="floatL orderDetailBoxTitle">อีเมล์</div>
							<div class="floatL orderDetailBoxText">imissyou27@hotmail.com</div>
							<span class="clear"></span>
						</div>
						<div class="orderDetailBox floatL orderDetailBox2">
							<div class="floatL orderDetailBoxTitle">เลขที่ใบสั่งซื้อ</div>
							<div class="floatL orderDetailBoxText">GTT-67410</div>
							<div class="floatL orderDetailBoxTitle">วันที่</div>
							<div class="floatL orderDetailBoxText">2015-09-17 11:21:00</div>
							<div class="floatL orderDetailBoxTitle">ส่งสินค้า</div>
							<div class="floatL orderDetailBoxText">ส่งสินค้าไปยังที่อยู่ที่ระบุ</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="productDetail">
						<div class="productHeader">
							<div class="floatL productColumn1" >ลำดับ</div>
							<div class="floatL productColumn2" >สินค้า</div>
							<div class="floatL productColumn3" >ราคา/หน่วย</div>
							<div class="floatL productColumn4" >จำนวน</div>
							<div class="floatL productColumn5" >รวม</div>
							<div class="clear"></div>
						</div>	 		 			
						<div class="productBody">
							<div class="floatL productColumn1" >1</div>
							<div class="floatL productColumn2" >
								<div><strong>Code: </strong>GTTH-1183</div>
								<div>NanoPi</div>
							</div>
							<div class="floatL productColumn3" >925.00</div>
							<div class="floatL productColumn4" >1</div>
							<div class="floatL productColumn5" >925.00</div>
							<div class="clear"></div>
						</div>		 			
						<div class="productBody">
							<div class="floatL productColumn1" >2</div>
							<div class="floatL productColumn2" >
								<div><strong>Code: </strong>GTTH-1182</div>
								<div>arduino r3</div>
							</div>
							<div class="floatL productColumn3" >500.00</div>
							<div class="floatL productColumn4" >2</div>
							<div class="floatL productColumn5" >1,000.00</div>
							<div class="clear"></div>
						</div>
						<div class="productFooter">
							<div class="sumpricetitle floatL">Price</div>
							<div class="sumpricetext floatL">925.00</div>
							<div class="sumpricetitle floatL">Vat 7%</div>
							<div class="sumpricetext floatL">64.75</div>
							<div class="sumpricetitle floatL">Net Price</div>
							<div class="sumpricetext floatL">989.75 </div>
							<div class="sumpricetitle floatL">Delivery Fee</div>
							<div class="sumpricetext floatL">70.00 </div>
							<div class="sumpricetitle floatL sumpricetitle_last">Total Payment</div>
							<div class="sumpricetext floatL sumpricetitle_last">1,059.75</div>
							<div class="clear"></div>
						</div>	
					</div>	
					<div class="clear"></div>		
				</div>				
			</div>
			<div class="buttonActionBox">
				<input type="button" value="พิมพ์" class="buttonAction emerald-flat-button" onclick="window.print();">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>	
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
