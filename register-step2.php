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
			<div class="box-group-form cf">
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ชื่อพิพิธภัณฑ์* (ภาษาไทย)</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ชื่อพิพิธภัณฑ์* (ภาษาอังกฤษ)</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-group-form red cf">
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ที่อยู่*</p>
							<div><input type="text"></div>
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
					<div class="box-right">
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
					<div class="box-right">
						<div class="box-input-text">
							<p>รหัสไปรษณีย์</p>
							<div><input type="text"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text checkbox">
							<p>วันและเวลาทำการ</p>
							<div>
								<input type="checkbox"><span>จ</span>
							</div>
							<div>
								<input type="checkbox"><span>อ</span>
							</div>
							<div>
								<input type="checkbox"><span>พ</span>
							</div>
							<div>
								<input type="checkbox"><span>พฤ</span>
							</div>
							<div>
								<input type="checkbox"><span>ศ</span>
							</div>
							<div>
								<input type="checkbox"><span>ส</span>
							</div>
							<div>
								<input type="checkbox"><span>อา</span>
							</div>							
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text time">
							<div><img src="images/mog-time.png"/></div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text time">
							<div class="box-btn submit">
								<a  href="" class="btn black">กำหนดเอง</a>
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
			</div>	
			<div class="box-group-form Bred cf">
				<div class="box-row cf">
					<div class="box-left w600">
						<div class="box-input-text">
							<p>กรุณาแนบเอกสารยืนยัน*</p>
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
