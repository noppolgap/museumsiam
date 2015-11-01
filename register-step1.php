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
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" type="text/css" href="css/register.css" />	
</head>

<body id="register">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="login.php">ระบบสมาชิก</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">สมัครสมาชิก</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				Registration Form<br>
				<span>สมัครสมาชิก</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-content-main">
	<div class="container">
		<form name="myform" id="myform" method="post" action="register-action.php">
		<div class="box-content-main">
			<div class="box-select-type">
				<div><input type="radio" name="radio1" value="2" checked>สมาชิกทั่วไป</div>
				<div><input type="radio" name="radio1" value="3">สมาชิกพิพิธภัณฑ์</div>
			</div>
			<div  class="box-login-fb">
				<a href="f#" class="btn-login-fb"><img src="images/form/btn-login-fb.png"/></a>
			</div>
			<div class="box-or">
				<p>
					<span>OR</span>
				</p>
			</div>
			<div class="box-group-form cf">
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>ชื่อ*</p>
							<div><input type="text" name="name"></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p>นามสกุล*</p>
							<div><input type="text" name="surname"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text radio">
							<p>เพศ*</p>
							<div><input type="radio" name="sex" value="M" checked>ชาย</div>
							<div><input type="radio" name="sex" value="F">หญิง</div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p>วันเกิด*</p>
							<div><input type="text" name="birthday" class="DatePicker"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left w600">
						<div class="box-input-text">
							<p>อีเมล์*</p>
							<div><input type="email" name="email"></div>
						</div>
					</div>
					<div class="box-right w150">
						<div class="box-input-text">
							<p></p>
							<div class="box-btn">
								<a  class="btn black checkEmail">ตรวจสอบ</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-group-form red cf">
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>รหัสผ่าน*</p>
							<div><input type="password" name="password1"></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษรและต้องเป็นตัวเลข<br>หรือตัวอักษรภาษาอังกฤษเท่านั้น</span></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>ยืนยันรหัสผ่าน*</p>
							<div><input type="password" name="password2"></div>
						</div>
					</div>
				</div>
			</div>	
			<div class="box-group-form Bred cf">
				<div class="box-row cf">
					<div class="box-left w600">
						<div class="box-input-text">
							<p>รหัสประจำตัวประชาชน</p>
							<div><input type="text" name="idcard" maxlength="13"></div>
						</div>
					</div>
					<div class="box-right w150">
						<div class="box-input-text">
							<p></p>
							<div class="box-btn">
								<a  class="btn black checkIDCard" href="#" >ตรวจสอบ</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>โทรศัพท์</p>
							<div><input type="tel" name="telephone" pattern="[0-9]{10}" maxlength="10" ></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณากรอกตามตัวอย่าง เช่น 021234567</span></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>โทรศัพท์มือถือ</p>
							<div><input type="tel" name="mobile" pattern="[0-9]{10}" maxlength="10" ></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณากรอกตามตัวอย่าง เช่น 0811234567</span></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>โทรสาร</p>
							<div><input type="tel" name="fax" pattern="[0-9]{10}" maxlength="10" ></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณากรอกตามตัวอย่าง เช่น 021234567</span></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>ที่อยู่</p>
							<div><textarea name="address"></textarea></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>จังหวัด</p>
							<div>
								<div class="SearchMenu-item province_box box-select">
									<span title="- เลือกจังหวัด -">- เลือกจังหวัด -</span>
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
							<p>อำเภอ/เขต</p>
							<div>
								<div class="SearchMenu-item district_box box-select">
									<span title="- เลือกอำเภอ/เขต -">- เลือกอำเภอ/เขต -</span>
									<select class="p-Absolute" name="district">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>ตำบล/แขวง</p>
							<div>
								<div class="SearchMenu-item sub_district_box box-select">
									<span title="- เลือกตำบล/แขวง -">- เลือกตำบล/แขวง -</span>
									<select class="p-Absolute" name="sub_district">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>รหัสไปรษณีย์</p>
							<div><input type="tel" name="postcode" pattern="[0-9]{5}" maxlength="5" ></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>รหัสยืนยัน</p>
							<div class="g-recaptcha" data-sitekey="6Ld2VgwTAAAAAEmFQsLXE8zem5b7CCg3Jxbjds6p"></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณกดเพื่อยืนยันตัวตนว่าคุณไม่ใช่โปรแกรมอัตโนมัติ</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-btn submit">
				<a  href="#" class="btnReset btn black">ยกเลิก</a>
				<a  href="#" class="btnSubmit btn black">ตกลง</a>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="assets/plugin/maskedinput/jquery.maskedinput.min.js"></script>
<script src="js/register.js"></script>
<script>
	var mytext = {
		name:"ชื่อ", 
		surname:"นามสกุล",
		sex:"เพศ", 
		birthday:"วันเกิด",
		email:"อีเมล์",
		password1:"รหัสผ่าน", 
		password2:"ยืนยันรหัสผ่าน",
		idcard:"รหัสประจำตัวประชาชน", 
		telephone:"โทรศัพท์",
		mobile:"โทรศัพท์มือถือ", 
		fax:"โทรสาร",
		postcode:"รหัสไปรษณีย์",
		captcha:"รหัสยืนยัน",
		warning0:"ไม่สามารถลงทะเบียนได้เพราะ ",
		warning1:"กรุณาระบุ ",
		warning2:"รหัสผ่านไม่ตรงกัน ",
		warning3:"รูปแบบอีเมล์ไม่ถูกต้อง ",
		warning4:"รหัสผ่านไม่น้อยกว่า 6 ตัวอีกษร ",
		warning5:"ไม่ถูกต้อง",
		warning6:"ถูกต้อง",
		warning7:"ไม่สามารถใช้งานได้ เพราะถูกใช้งานแล้ว"
	};
</script>
</body>
</html>
<? CloseDB(); ?>