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
		$(".menu-left li.menu2").addClass("active");
	});
</script>
	
</head>

<body id="account">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">แก้ไขข้อมูล</li>
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
				<h1>แก้ไขข้อมูล</h1>
			</div>
			<div class="box-left">
				<div class="box-row cf">
					<div class="box-left">
						<p>คำนำหน้าชื่อ</p>
					</div>
					<div class="box-right">
						<div class="box-input-text radio">
							<div><input type="radio" name="title-name" value="mr">นาย</div>
							<div><input type="radio" name="title-name" value="mrs">นาง</div>
							<div><input type="radio" name="title-name" value="miss" checked="">นางสาว</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ชื่อ</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name="name" value="ชมพูนุช"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>นามสกุล</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name="surname" value="ซัน"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>เพศ</p>
					</div>
					<div class="box-right">
						<div class="box-input-text radio">
							<div><input type="radio" name="sex" value="male">ชาย</div>
							<div><input type="radio" name="sex" value="female" checked="">หญิง</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>วันเกิด</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="9 กันยายน 2531"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรศัพท์</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="02-3456789"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรศัพท์มือถือ</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="086-6656556"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรสาร</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="02-3456789"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>รหัสประจำตัวประชาชน</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="1255688954213"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">

					</div>
					<div class="box-right">
						<div class="box-input-text cf">
							<div class="box-btn fl">
								<a class="btn black checkEmail">ตรวจสอบ</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ที่อยู่</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><textarea name="address">96 เอกพัฒนาอพาทเมนต์ ห้อง 810 ซ.ลาดพร้าว26</textarea></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ตำบล/แขวง</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item province_box box-select">
									<span title="- เลือกจังหวัด -">แขวงลาดยาว</span>
									<select class="p-Absolute" name="province">
										<option value="0">แขวงลาดยาว</option>
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
						<p>อำเภอ/เขต</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item province_box box-select">
									<span title="- เลือกจังหวัด -">เขตจตุจักร</span>
									<select class="p-Absolute" name="province">
										<option value="0">เขตจตุจักร</option>
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
						<p>จังหวัด</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item province_box box-select">
									<span title="- เลือกจังหวัด -">กรุงเทพมหานคร</span>
									<select class="p-Absolute" name="province">
										<option value="0">กรุงเทพมหานคร</option>
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
						<p>รหัสไปรษณีย์</p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" value="10220"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-right">
				<div class="box-user">
					<div class="box-pic">
						<img src="images/account/user.jpg"/>
					</div>
					<div class="box-detail cf">
						<div class="box-name">
							<h2>นางสาว ชมพูนุช ซัน</h2>
						</div>
						<p>LOG IN ล่าสุด</p>
						<div class="row cf">
							<div class="box-left">
								วันที่
							</div>
							<div class="box-right">
								20 มิถุนายน 2558
							</div>
						</div>
						<div class="row cf">
							<div class="box-left">
								เวลา
							</div>
							<div class="box-right">
								14:03น.
							</div>
						</div>
					</div>
					<div class="box-btn cf">
						<div class="row cf">
<!-- 							<div class="box-left"> -->
								<a href="#" class="ac fl">แก้ไขรูปประจำตัว</a>
<!-- 							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="box-btn-main cf">
				<div class="box-btn">
					<a class="btn black">ยกเลิก</a>
					<a class="btn black">ตกลง</a>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
