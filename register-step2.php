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
							<div><input type="number" maxlength="5" name="postcode"></div>
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
							<p id="timeText">เวลาทำการ <span class="amount-time" id="amount-time-all">8:00 - 20:00</span></p>
							<div class="workingtime" data-box="all">
								<input type="hidden" name="startdate" class="startdate" value="" />
								<input type="hidden" name="enddate" class="enddate" value="" />
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
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="mon"></div>
						<div class="fixDateBoxDate">วันจันทร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-mon">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="mon">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="tue"></div>
						<div class="fixDateBoxDate">วันอังคาร เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-tue">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="tue">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="wed"></div>
						<div class="fixDateBoxDate">วันพุธ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-wed">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="wed">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="thu"></div>
						<div class="fixDateBoxDate">วันพฤหัสบดี เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-thu">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="thu">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="fri"></div>
						<div class="fixDateBoxDate">วันศุกร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-fri">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="fri">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="sat"></div>
						<div class="fixDateBoxDate">วันเสาร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sat">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sat">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date" value="sun"></div>
						<div class="fixDateBoxDate">วันอาทิตย์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sun">8:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sun">
							<input type="hidden" name="startdate" class="startdate" value="" />
							<input type="hidden" name="enddate" class="enddate" value="" />
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
<script>
$(function() {
    $(".workingtime").slider({
        range: true,
        min: 0,
        max: 1440,
        step: 5,
        values: [ 480, 1080 ],
        slide: function( event, ui ) {
            var hours1 = Math.floor(ui.values[0] / 60);
            var minutes1 = ui.values[0] - (hours1 * 60);

            if(hours1.length < 10) hours1= '0' + hours;
            if(minutes1.length < 10) minutes1 = '0' + minutes;

            if(minutes1 == 0) minutes1 = '00';

            var hours2 = Math.floor(ui.values[1] / 60);
            var minutes2 = ui.values[1] - (hours2 * 60);

            if(hours2.length < 10) hours2= '0' + hours;
            if(minutes2.length < 10) minutes2 = '0' + minutes;

            if(minutes2 == 0) minutes2 = '00';

            
			var id = $(this).attr("data-box");
			$('#amount-time-'+id).text(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
            $(this).find('.startdate').val(hours1+':'+minutes1);
            $(this).find('.enddate').val(hours2+':'+minutes2);
        }
    });
    
    $('.toogleworkingtimeBlock').on( "click", function(e) {
		$('.fixDateBox').toggle('blind'); 
		e.preventDefault();
		e.stopPropagation(); 
	});
});
</script>
</body>
</html>
