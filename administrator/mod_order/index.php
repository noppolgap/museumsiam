<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {
			if (isset($_POST['str_search'])){
				$_SESSION['text'] = $_POST['str_search'];
				$search_sql .= " AND u.NAME like '%".$_POST['str_search']."%' ";
		}
	}


					
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
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">ชื่อเมนู</div>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="<?=$_SESSION['text'] ?>" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>						
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
					<div class="floatR orderBox">
						<select onchange="console.log('action');" name="orderby" class="p-Relative">
					        <option value="order">เลือกการจัดเรียงลำดับ</option>
					        <option selected="selected" value="order">การจัดเรียงของระบบ</option>
					        <option value="subject">ชื่อ</option>
					        <option value="credate">วันที่สร้าง</option>
					        <option value="status">สถานะข้อมูล</option>
					    </select>
					</div>
					<div class="clear"></div>	
				</div>
				<div class="mod-body-main-content">
					<!-- start loop -->
				<?php 

				    $sql= " SELECT o.ORDER_ID, CONCAT( u.NAME,'  ', u.LAST_NAME ) AS name, u.EMAIL, u.MOBILE_PHONE, u.TELEPHONE, o.FLAG, o.EMS, os.STATUS_NAME_LOC
							FROM trn_order o
				
					INNER JOIN sys_app_user u ON o.CUSTOMER_ID = u.id
					LEFT JOIN mas_sub_district s ON u.SUB_DISTRICT_ID = s.SUB_DISTRICT_ID
					LEFT JOIN mas_province p ON p.PROVINCE_ID = u.PROVINCE_ID
					LEFT JOIN trn_order_status os ON os.STATUS_ID = o.flag ";

				    $sql .= $search_sql."order by o.ORDER_ID desc";

				    $query = mysql_query($sql,$conn);

					$num_rows = mysql_num_rows($query);

 				?>

					<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content Main_Content_order" data-id="<?=$i?>">
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$i?>"></div>
						<div class="floatL thumbContent">
							<a href="view.php" class="dBlock"></a>
						</div>
						<div class="floatL orderNameContent">
							<div><a href="view.php?order_id=<?=$row['ORDER_ID'];?>">เลขที่ใบสั่งซื้อ <? echo $row['ORDER_ID']; ?></a></div>
							<div>ชื่อ-นามสกุล : <? echo $row['name']; ?></div>
							<div>อีเมล์ : <? echo  $row['EMAIL']; ?></div>
							<div>เบอร์โทรศัพท์ : <? $row['TELEPHONE']; ?> </div>
							<div>เบอร์มือถือ : <? echo $row['MOBILE_PHONE']; ?></div>
						</div>

						<? 
							$sql_or_status = " SELECT * FROM trn_order_status ";

						    $query_or_status = mysql_query($sql_or_status,$conn);
							$num_rows = mysql_num_rows($query_or_status);

						?>

					
						<div class="floatL orderContent">
							<select name="newgroup">
								<?php while($row_or_status = mysql_fetch_array($query_or_status)) { 

										$selected = "";
										if($row_or_status['STATUS_ID'] == $row['FLAG']){

											$selected = "selected";
										}
									?>
				            	  <option <?=$selected?> value="<?=$row_or_status['STATUS_ID'];?>"><?=$row_or_status['STATUS_NAME_LOC'];?></option>
	                        	<? } ?>
	                        </select> 
						</div>
					

						<div class="floatL orderEmsContent">
							<span> EMS CODE </span>
							<strong><? echo  $row['EMS'];  ?></strong>
						</div>					
						<div class="clear"></div>	
					</div>
					<?php } ?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">จำนวนทั้งหมด <span class="RowCount"><?=$i?></span> รายการ</div>
					<div class="floatR pagination_action">
						<a href="#"><img src="../images/skip-previous.svg" alt="first" /></a>
						<a href="#"><img src="../images/fast-rewind.svg" alt="previous" /></a>
						<select name="pagination" class="p-Relative">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>	
						<a href="#"><img src="../images/fast-forward.svg" alt="next" /></a>
						<a href="#"><img src="../images/skip-next.svg" alt="last" /></a>
					</div>
					<div class="floatR">หน้า 1 จาก 10</div>
					<div class="clear"></div>	
				</div>
			</div>	
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
<? CloseDB(); ?>
