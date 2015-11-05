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
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/contact.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu3").addClass("active");
			if ($('.menu-left li.menu2').hasClass("active")){
				$('.menu-left li.menu2').children(".submenu-left").css("display","block");
			}
	});
</script>
	
</head>

<body id="register">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>ติดต่อเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">กรอกข้อมูล</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-contact.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>E-APPLICATION
					<span>เงื่อนไขข้อกำหนด</span>
				</h1>
			</div>
			<hr class="line-gray"/>
				

				<form action="e-application-action.php?add" method="post" name="formcms" id = "myform" >
					<div class="box-contact-from">
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Specify type of job onterested</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="jobname"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">ชื่อ นามสกุล</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="name_th"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Name (English Language)</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="name_eng"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เพศ</p>
							</div>
							<div class="box-right">
								<div class="box-input-text radio">
									<div><input type="radio" name="sex" value="male" checked>ชาย</div>
									<div><input type="radio" name="sex" value="female">หญิง</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">วันเกิด</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="birthdate"></div>
								</div>
							</div>
						</div>
						
						<div class="box-row cf">
							<div class="box-left">
								<p>Nataionlity (สัญชาติ)</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="nationality"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เบอร์โทรศัพท์</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="telephone"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">อีเมล</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="email"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เบอร์โทรศัพท์มือถือ</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="mobile"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Present Address</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><textarea name="address"></textarea></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Photograph</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red">browse</a>
										</div>					
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Resume</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red">browse</a>
										</div>					
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Application Form</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red">browse</a>
										</div>					
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Salary Desired</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="salary"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<div class="box-input-text">
									<div class="g-recaptcha" data-sitekey="6Ld2VgwTAAAAAEmFQsLXE8zem5b7CCg3Jxbjds6p">Plugin</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><span>*กรุณกดเพื่อยืนยันตัวตนว่าคุณไม่ใช่โปรแกรมอัตโนมัติ</span></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<input type="submit" value="save" style="display:none">
											<input type="button" value="ยกเลิก" class="btnReset btn red">
											<!--<a href="#" class="btnSubmit btn red">ตกลง</a>
											<a href="#" class="btnReset btn red">ยกเลิก</a> -->
										</div>					
									</div>
								</div>
							</div>
							<div class="box-right">
							</div>
						</div>
					</div>

				</form>	
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
