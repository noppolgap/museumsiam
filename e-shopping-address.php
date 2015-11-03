<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

if(!isset($_SESSION['UID'])){
	header('Location: e-shopping.php');
}
if($_GET['action'] == 'Del'){
	$sql = "DELETE FROM trn_shopping_cart WHERE trn_shopping_cart_SSID = '".session_id()."'";
	mysql_query($sql, $conn) or die($sql);

	header('Location: e-shopping.php');
}

if ($_SESSION['LANG'] == 'TH') {
	$PROVINCE_SQL = "PROVINCE_DESC_LOC";
	$DISTRICT_SQL = "DISTRICT_DESC_LOC";
	$SUB_DISTRICT_SQL = "SUB_DISTRICT_DESC_LOC";
} else if ($_SESSION['LANG'] == 'EN') {
	$PROVINCE_SQL = "PROVINCE_DESC_ENG";
	$DISTRICT_SQL = "DISTRICT_DESC_ENG";
	$SUB_DISTRICT_SQL = "SUB_DISTRICT_DESC_ENG";
}

//find address
$sql_address = "SELECT * ,
				(SELECT ".$PROVINCE_SQL." FROM mas_province WHERE mas_province.PROVINCE_ID = sys_app_address.PROVINCE_ID) AS PROVINCE ,
				(SELECT ".$DISTRICT_SQL." FROM mas_district WHERE mas_district.DISTRICT_ID = sys_app_address.DISTRICT_ID) AS DISTRICT ,
				(SELECT ".$SUB_DISTRICT_SQL." FROM mas_sub_district WHERE mas_sub_district.SUB_DISTRICT_ID = sys_app_address.SUB_DISTRICT_ID) AS SUB_DISTRICT
 			FROM sys_app_address WHERE UID = ".$_SESSION['UID'];
$query_address = mysql_query($sql_address, $conn) or die($sql_address);
if(mysql_num_rows($query_address) == 0){
	$sql = "SELECT * FROM sys_app_user WHERE USER_ID  = ".$_SESSION['UID'];
	$query = mysql_query($sql, $conn) or die($sql);
	$row = mysql_fetch_array($query);
	if($row['PROVINCE_ID'] != 0){
		unset($insert);
		$insert['NAME'] 	= "'" . $row['NAME']  . ' '.$row['LAST_NAME']  . "'";
		$insert['ADDRESS1'] 	= "'" . $row['ADDRESS1']  . "'";
		$insert['ADDRESS2'] 	= "'" . $row['ADDRESS2']  . "'";
		$insert['DISTRICT_ID'] 	= "'" . $row['DISTRICT_ID']  . "'";
		$insert['SUB_DISTRICT_ID'] = "'" . $row['SUB_DISTRICT_ID']  . "'";
		$insert['PROVINCE_ID'] 	= "'" . $row['PROVINCE_ID']  . "'";
		$insert['POST_CODE'] 	= "'" . $row['POST_CODE']  . "'";
		$insert['UID'] 		= "'" . $_SESSION['UID']  . "'";
		$sql = "INSERT INTO sys_app_address (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
	}
}

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
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
		<form action="e-shopping-action.php" method="post" name="form_action" id="form_action">
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-SHOPPING</h1>
				<div class="box-btn">
					<a href="e-shopping.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<div class="box-address-main">
				<div class="box-title">
					ยืนยันการสั่งซื้อ
				</div>
				<div class="box-form-address-main">
					<div class="text-title">ที่อยู่ในการจัดส่งสินค้า</div>
				<?php
					while ($row = mysql_fetch_array($query_address)) {
				?>
					<div class="box-group group1">
						<input type="radio" name="address" value="<?=$row['ID']?>">
						<p class="">
							<?=$row['NAME']?><br>
							<?=$row['ADDRESS1']?> <?=$row['ADDRESS2']?><br>
							<?=$row['SUB_DISTRICT']?> <?=$row['DISTRICT']?><br>
							<?=$row['PROVINCE']?> <?=$row['POST_CODE']?>
						</p>
					</div>
					<hr class="line-gray"/>
				<? 	}	?>
					<div class="box-group form">
						<input type="radio" name="address" value="0" >
						<div class="box-form">

							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ชื่อ-นามสกุล*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><input type="text" name="name" ></div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ที่อยู่*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><textarea name="adds"></textarea></div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>จังหวัด*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item province_box">
												<strong title="เลือกจังหวัด">เลือกจังหวัด</strong>
												<select class="p-Absolute" name="province">
													<option value="0">- เลือกจังหวัด -</option>
												<?php
													$sql = "SELECT * FROM mas_province ORDER BY PROVINCE_DESC_LOC";
													$query = mysql_query($sql,$conn);
													while($row = mysql_fetch_array($query)){
												?>
													<option value="<?=$row['PROVINCE_ID']?>"><?=$row['PROVINCE_DESC_LOC']?></option>
												<? } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>อำเภอ/เขต*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item district_box">
												<strong title="เลือกอำเภอ/เขต">เลือกอำเภอ/เขต</strong>
												<select class="p-Absolute" name="district">
													<option value="0">- เลือกอำเภอ/เขต -</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ตำบล/แขวง*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item sub_district_box">
												<strong title="เลือกตำบล/แขวง">เลือกตำบล/แขวง</strong>
												<select class="p-Absolute" name="sub_district">
												<option value="0">- เลือกตำบล/แขวง -</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>รหัสไปรษณีย์*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><input type="text" name="postcode"></div>
									</div>
								</div>
							</div>

							<div class="box-btn submit">
								<a  href="?action=Del" class="btnReset btn red">ยกเลิก</a>
								<a  href="#" onclick="checkForm();" class="btnSubmit btn red">ดำเนินการต่อ</a>
							</div>

						</div>
					</div>


				</div>
			</div>
		</form>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>
<script type="text/javascript" src="js/cart.js" ></script>
</body>
</html>
