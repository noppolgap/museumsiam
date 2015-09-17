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

				<?php 

					$id = intval($_GET['order_id']);
					$sql= " SELECT o.ORDER_ID, CONCAT( u.NAME,'  ', u.LAST_NAME ) AS name, u.EMAIL, u.MOBILE_PHONE
							, u.TELEPHONE, o.FLAG, o.EMS, concat(u.ADDRESS1,' ', t.DISTRICT_DESC_LOC,' ', s.SUB_DISTRICT_DESC_LOC,' ',p.PROVINCE_DESC_LOC) as address
							, o.CREATE_DATE , o.ADDRESS as addr
							FROM trn_order o
							INNER JOIN trn_order_detail d ON o.ORDER_ID = d.ORDER_ID
							INNER JOIN sys_app_user u ON o.ORDER_ID = u.id
							left join mas_district t on t.DISTRICT_ID = u.DISTRICT_ID
							LEFT JOIN mas_sub_district s ON u.SUB_DISTRICT_ID = s.SUB_DISTRICT_ID
							LEFT JOIN mas_province p ON p.PROVINCE_ID = u.PROVINCE_ID
							where o.order_id = '".$id."'  ";

				   	$query = mysql_query($sql,$conn);

					$num_rows = mysql_num_rows($query);

 				?>


				<div class="mod-body-main-content">
					<div class="customerDetail">

						<?php while($row = mysql_fetch_array($query)) { ?>

						<div class="orderDetailBox floatL orderDetailBox1">
							<div class="floatL orderDetailBoxTitle">ถึง</div>
							<div class="floatL orderDetailBoxText"><? echo $row['name']; ?></div>
							<div class="floatL orderDetailBoxTitle">ที่อยู่</div>
							<div class="floatL orderDetailBoxText"><? echo $row['address']; ?></div>
							<div class="floatL orderDetailBoxTitle">เบอร์โทรศัพท์</div>
							<div class="floatL orderDetailBoxText"><? echo $row['TELEPHONE']; ?></div>
							<div class="floatL orderDetailBoxTitle">เบอร์มือถือ</div>
							<div class="floatL orderDetailBoxText"><? echo $row['MOBILE_PHONE']; ?></div>
							<div class="floatL orderDetailBoxTitle">อีเมล์</div>
							<div class="floatL orderDetailBoxText"><? echo $row['EMAIL']; ?></div>
							<span class="clear"></span>
						</div>
						<div class="orderDetailBox floatL orderDetailBox2">
							<div class="floatL orderDetailBoxTitle">เลขที่ใบสั่งซื้อ</div>
							<div class="floatL orderDetailBoxText"><? echo $row['ORDER_ID']; ?></div>
							<div class="floatL orderDetailBoxTitle">วันที่</div>
							<div class="floatL orderDetailBoxText"><? echo  ConvertDate($row['CREATE_DATE']); ?></div>
							<div class="floatL orderDetailBoxTitle">ส่งสินค้า</div>
							<div class="floatL orderDetailBoxText"><? echo $row['addr']; ?></div>
							<div class="clear"></div>
						</div>
						<? } ?>
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
