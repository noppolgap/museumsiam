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

<script>
	$(document).ready(function(){
// 		$("li.menu1").addClass("active");		
	});
</script>
	
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
		<div class="box-content-main">
			<div class="box-select-type">
				<div><input type="radio" name="radio1" value="type1" checked>สมาชิกทั่วไป</div>
				<div><input type="radio" name="radio1" value="type2">สมาชิกพิพิธภัณฑ์</div>
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
							<div><input type="text"></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p>นามสกุล*</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text radio">
							<p>เพศ*</p>
							<div><input type="radio" name="radio2" value="type1" checked>ชาย</div>
							<div><input type="radio" name="radio2" value="type2">หญิง</div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p>วันเกิด*</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left w600">
						<div class="box-input-text">
							<p>อีเมล์*</p>
							<div><input type="text"></div>
						</div>
					</div>
					<div class="box-right w150">
						<div class="box-input-text">
							<p></p>
							<div class="box-btn">
								<a  class="btn black">ตรวจสอบ</a>
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
							<div><input type="text"></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<p></p>
							<div><span>*กรุณากรอกรหัสผ่านอย่างน้อย 4 ตัวอักษรและต้องเป็นตัวเลข<br>หรือตัวอักษรภาษาอังกฤษเท่านั้น</span></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>ยืนยันรหัสผ่าน*</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
			</div>	
			<div class="box-group-form Bred cf">
				<div class="box-row cf">
					<div class="box-left w600">
						<div class="box-input-text">
							<p>รหัสประจำตัวประชาชน</p>
							<div><input type="text"></div>
						</div>
					</div>
					<div class="box-right w150">
						<div class="box-input-text">
							<p></p>
							<div class="box-btn">
								<a  class="btn black">ตรวจสอบ</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>โทรศัพท์</p>
							<div><input type="tel" name="telephone" pattern="[0-9]{10}" ></div>
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
							<div><input type="tel" name="mobile" pattern="[0-9]{10}" ></div>
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
							<div><input type="tel" name="fax" pattern="[0-9]{10}" ></div>
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
							<div><textarea></textarea></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text">
							<p>จังหวัด</p>
							<div>
								<div class="SearchMenu-item">
									- เลือกจังหวัด -
									<select class="p-Absolute">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
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
								<div class="SearchMenu-item">
									- เลือกอำเภอ/เขต -
									<select class="p-Absolute">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
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
								<div class="SearchMenu-item">
									- เลือกตำบล/แขวง -
									<select class="p-Absolute">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
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
							<div><textarea></textarea></div>
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
				<a  href="login.php" class="btn black">ยกเลิก</a>
				<a  href="" class="btn black">ตกลง</a>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
