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
		<form name="myform" id="myform" method="post" action="register-museum-action.php" enctype="multipart/form-data">
		<div class="box-content-main">
			<div class="box-group-form cf">
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ชื่อพิพิธภัณฑ์* (ภาษาไทย)</p>
							<div><input type="text" name="txtMuseumDescLoc"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ชื่อพิพิธภัณฑ์* (ภาษาอังกฤษ)</p>
							<div><input type="text" name="txtMuseumDescEng"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-group-form red cf">
				<div class="box-row cf">
					<div class="box-max">
						<div class="box-input-text">
							<p>ที่อยู่*</p>
							<div><input type="text" name="txtMuseumAddress"></div>
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
					<div class="box-right">
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
					<div class="box-right">
						<div class="box-input-text">
							<p>รหัสไปรษณีย์</p>
							<div><input type="text" pattern="[0-9]{5}" maxlength="5" name="postcode"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text checkbox">
							<p>วันและเวลาทำการ</p>
							<div>
								<input type="checkbox" name = "auto_open[]" value="1"><span>จ</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="2"><span>อ</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="3"><span>พ</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="4"><span>พฤ</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="5"><span>ศ</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="6"><span>ส</span>
							</div>
							<div>
								<input type="checkbox" name = "auto_open[]" value="7"><span>อา</span>
							</div>							
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<div class="box-input-text time">
							<p id="timeText">เวลาทำการ <span class="amount-time" id="amount-time-all">08:00 - 20:00</span></p>
							<div class="workingtime" data-box="all">
								<input type="hidden" name="startdate" class="startdate" value="08:00" />
								<input type="hidden" name="enddate" class="enddate" value="20:00" />
							</div>
						</div>
					</div>
					<div class="box-right">
						<div class="box-input-text time">
							<div class="box-btn submit">
								<a href="#" class="btn black toogleworkingtimeBlock">กำหนดเอง</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="1"></div>
						<div class="fixDateBoxDate">วันจันทร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-mon">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="mon">
							<input type="hidden" name="startdate1" class="startdate" value="08:00" />
							<input type="hidden" name="enddate1" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="2"></div>
						<div class="fixDateBoxDate">วันอังคาร เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-tue">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="tue">
							<input type="hidden" name="startdate2" class="startdate" value="08:00" />
							<input type="hidden" name="enddate2" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="3"></div>
						<div class="fixDateBoxDate">วันพุธ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-wed">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="wed">
							<input type="hidden" name="startdate3" class="startdate" value="08:00" />
							<input type="hidden" name="enddate3" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="4"></div>
						<div class="fixDateBoxDate">วันพฤหัสบดี เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-thu">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="thu">
							<input type="hidden" name="startdate4" class="startdate" value="08:00" />
							<input type="hidden" name="enddate4" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="5"></div>
						<div class="fixDateBoxDate">วันศุกร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-fri">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="fri">
							<input type="hidden" name="startdate5" class="startdate" value="08:00" />
							<input type="hidden" name="enddate5" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="6"></div>
						<div class="fixDateBoxDate">วันเสาร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sat">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sat">
							<input type="hidden" name="startdate6" class="startdate" value="08:00" />
							<input type="hidden" name="enddate6" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="7"></div>
						<div class="fixDateBoxDate">วันอาทิตย์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sun">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sun">
							<input type="hidden" name="startdate7" class="startdate" value="08:00" />
							<input type="hidden" name="enddate7" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
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
							<div>
								  <input type="file" name="fileToUpload" id="fileToUpload">
							</div>
						</div>
					</div>
					<div class="box-right w150">
						<div class="box-input-text">
							<p></p>
							<div class="box-btn">
								<a style="display: none" class="btn black">ตรวจสอบ</a>
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
				<a  href="" class="btnSubmit btn black">ตกลง</a>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	
 
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="js/registerMuseum.js"></script>
 
 
</body>
</html>
