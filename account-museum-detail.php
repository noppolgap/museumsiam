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
<link rel="stylesheet" type="text/css" href="css/account-museum.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu5,.menu-left li.menu5 li.submenu1").addClass("active");
			if ($('.menu-left li.menu5').hasClass("active")){
				$('.menu-left li.menu5').children(".submenu-left").css("display","block");
			}
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
				<li>จัดการพิพิธภัณฑ์&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">รายละเอียดพิพิธภัณฑ์</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				ACCOUNT SETTINGS<br>
				<span>การต้ังค่าบัญชีผู้ใช้</span>
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
				<h1>จัดการพิพิธภัณฑ์ - รายละเอียดพิพิธภัณฑ์</h1>
			</div>
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อพิพิธภัณฑ์*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อพิพิธภัณฑ์*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box-title">
				<h2>ที่อยู่และเบอร์ติดต่อ</h2>
			</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ที่อยู่* (ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ที่อยู่* (ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ตำบล/แขวง*</p>
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
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>อำเภอ/เขต*</p>
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
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>จังหวัด*</p>
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
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>รหัสไปรษณีย์*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>โทรศัพท์*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>โทรสาร*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>เว็บไซต์</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Map(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>Map(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Google Map <br>(latitude,<br>longitude)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" placeholder="Latitude"></div>
							</div>
							<div class="box-input-text mT">
								<div><input type="text" placeholder="Longitude"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>วันและเวลาทำการ*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text checkbox">
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
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">

						</div>
						<div class="box-right">
							<div class="box-input-text time">
								<p>Plugin</p>
								<div class="workingtime" data-box="all">
									<input type="hidden" name="startdate" class="startdate" value="" />
									<input type="hidden" name="enddate" class="enddate" value="" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">กำหนดเอง</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>อัตราค่าเข้าชม*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>อัตราค่าเข้าชม*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเดินทาง <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเดินทาง <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-title">
				<h2>พิพิธภัณฑ์</h2>
			</div>
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ประวัติความเป็นมา <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ประวัติความเป็นมา <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							<p>ภูมิทัศน์โดยรอบ</p>
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							<p>ภาพถ่ายห้องจัดแสดง</p>
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							<p>วัตถุจัดแสดง</p>
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>ที่มีความสำคัญ</p>
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การจัดเก็บ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การจัดเก็บ <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ชมกลุ่มเป้าหมาย<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ชมกลุ่มเป้าหมาย<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="box-line cf"><hr></div>		

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเผยแพร่และ<br>ประชาสัมพันธ์ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเผยแพร่และ<br>ประชาสัมพันธ์  <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ดูแลและหน่วยงานที่<br>รับผิดชอบในปัจจุบัน*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ดูแลและหน่วยงานที่<br>รับผิดชอบในปัจจุบัน*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="box-line cf"><hr></div>		

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>แหล่งเรียนรู้อื่นๆ <br>ในเขตพื้นที่ใกล้เคียง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>แหล่งเรียนรู้อื่นๆ <br>ในเขตพื้นที่ใกล้เคียง<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>			

			<div class="box-title">
				<h2>Social Network</h2>
			</div>
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Facebook</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Twitter</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Youtube</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
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
