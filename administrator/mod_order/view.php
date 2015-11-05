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
			        $sql= " SELECT o.ORDER_ID, CONCAT( u.NAME,'  ', u.LAST_NAME ) AS name, u.EMAIL, u.MOBILE_PHONE, os.STATUS_NAME_LOC
							, u.TELEPHONE, o.FLAG, o.EMS, concat(u.ADDRESS1,' ', t.DISTRICT_DESC_LOC,' ', s.SUB_DISTRICT_DESC_LOC,' ',p.PROVINCE_DESC_LOC) as address
							, o.CREATE_DATE , o.ADDRESS as addr
							FROM trn_order o
							
							INNER JOIN sys_app_user u ON o.CUSTOMER_ID = u.id
							left join mas_district t on t.DISTRICT_ID = u.DISTRICT_ID
							LEFT JOIN mas_sub_district s ON u.SUB_DISTRICT_ID = s.SUB_DISTRICT_ID
							LEFT JOIN mas_province p ON p.PROVINCE_ID = u.PROVINCE_ID
							LEFT JOIN trn_order_status os ON os.STATUS_ID = o.flag
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
							<div class="floatL orderDetailBoxTitle">เบอร์โทรศัพท์</div>
							<div class="floatL orderDetailBoxText"><? echo $row['TELEPHONE']; ?></div>
							<div class="floatL orderDetailBoxTitle">เบอร์มือถือ</div>
							<div class="floatL orderDetailBoxText"><? echo $row['MOBILE_PHONE']; ?></div>
							<div class="floatL orderDetailBoxTitle">สถานที่ส่ง</div>
							<div class="floatL orderDetailBoxText"><? echo $row['addr']; ?></div>
							<span class="clear"></span>
						</div>
						<div class="orderDetailBox floatL orderDetailBox2">
							<div class="floatL orderDetailBoxTitle">เลขที่ใบสั่งซื้อ</div>
							<div class="floatL orderDetailBoxText"><? echo $row['ORDER_ID']; ?></div>
							<div class="floatL orderDetailBoxTitle">วันที่</div>
							<div class="floatL orderDetailBoxText"><? echo  ConvertDate($row['CREATE_DATE']); ?></div>
							<div class="floatL orderDetailBoxTitle">ส่งสินค้า</div>
							<div class="floatL orderDetailBoxText"><? echo $row['STATUS_NAME_LOC']; ?></div>
							<div class="clear"></div>
						</div>
						<? } ?>
						<div class="clear"></div>
					</div>

					<?php 

					$order_id = intval($_GET['order_id']);
					$sql_order = " select prod.PRODUCT_ID, prod.PRODUCT_DESC_LOC,  prod.PRICE, orderd.QUANTITY,
							(prod.PRICE * orderd.QUANTITY ) total, od.ORDER_ID 
							from trn_product prod
							inner join trn_order_detail  orderd on prod.PRODUCT_ID = orderd.PRODUCT_ID
							left join trn_order od on   od.ORDER_ID = orderd .ORDER_ID
							WHERE prod.Flag <> 2 AND  orderd.order_id = '".$order_id."' ";

				   	$query_order = mysql_query($sql_order,$conn);

					$num_rows = mysql_num_rows($query_order);

					$num = 1;


 					?>

					<div class="productDetail">
						<div class="productHeader">
							<div class="floatL productColumn1" >ลำดับ</div>
							<div class="floatL productColumn2" >สินค้า</div>
							<div class="floatL productColumn3" >ราคา/หน่วย</div>
							<div class="floatL productColumn4" >จำนวน</div>
							<div class="floatL productColumn5" >รวม</div>
							<div class="clear"></div>
						</div>

					 <?  ?>
					<?php while($row_order = mysql_fetch_array($query_order)) { ?>	


						<div class="productBody">
							<div class="floatL productColumn1" ><? echo $num ?></div>
							<div class="floatL productColumn2" >
								<div><strong>Code: </strong><? echo $row_order['PRODUCT_ID']; ?></div>
								<div><? echo $row_order['PRODUCT_DESC_LOC']; ?></div>
							</div>
							<div class="floatL productColumn3" ><? echo $row_order['PRICE']; ?></div>
							<div class="floatL productColumn4" ><? echo $row_order['QUANTITY']; ?></div>
							<div class="floatL productColumn5" ><? echo $row_order['total']; ?></div>
							<div class="clear"></div>
						</div>

					<? 
						$num++;
					} ?>

					<?php 

						$price_id = intval($_GET['order_id']);
						$sql_price = " select  sum(prod.PRICE * orderd.QUANTITY ) total
									    from trn_product prod
										inner join trn_order_detail  orderd on prod.PRODUCT_ID = orderd.PRODUCT_ID
										left join trn_order od on   od.ORDER_ID = orderd .ORDER_ID
										WHERE prod.Flag <> 2  AND  orderd.order_id = '".$price_id."' ";

					   	$query_price = mysql_query($sql_price,$conn);

						$num_rows = mysql_num_rows($query_price);

 		
 					 	while($row_price = mysql_fetch_array($query_price)) {

					 	$vat = ($row_price['total'] * 7) / 100 ;  

					 	$net = $row_price['total'] - $vat;

					 	?>
						
						<div class="productFooter">
							<div class="sumpricetitle floatL">Price</div>
							<div class="sumpricetext floatL"><? echo $row_price['total']; ?></div>
							<div class="sumpricetitle floatL">Vat 7%</div>
							<div class="sumpricetext floatL"><? echo $vat ?></div>
							<div class="sumpricetitle floatL">Net Price</div>
							<div class="sumpricetext floatL"><? echo $net ?></div>
							<!--<div class="sumpricetitle floatL">Delivery Fee</div>
							<div class="sumpricetext floatL">70.00 </div>-->
							<div class="sumpricetitle floatL sumpricetitle_last">Total Payment</div>
							<div class="sumpricetext floatL sumpricetitle_last"><? echo $net ?></div>
							<div class="clear"></div>
						</div>

					<? } ?>
							
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
