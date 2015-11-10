<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<?
	require ('inc_meta.php');
 ?>

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/contact.css" />

<script>
	$(document).ready(function() {
		$(".menutop li.menu8,.menu-left li.menu1").addClass("active");
	}); 
</script>

</head>

<body id="contact">

<?php
	include ('inc/inc-top-bar.php');
	include ('inc/inc-menu.php');

	if ($_SESSION['LANG'] == 'TH')
		$picFolderName = 'th';
	else
		$picFolderName = 'en';
 ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>ติดต่อเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">E-MAIL FORM & ADDRESS & MAP</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
			include ('inc/inc-left-content-contact.php');
 ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>
					<img src="images/<?=$picFolderName?>/contact/title1.png" alt="E-MAIL SUBMIT FORM ADDRESS & MAP"/>
				</h1>
			</div>

		<form action="contact_action.php?add" method="post" name="formcms" id = "myform" >
			<div class="box-contact-main cf">
				<div class="box-left">
					<div class="box-contact-from">
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เลือกหน่วยงาน</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="SearchMenu-item province_box box-select">
											<span>เลือกตำแหน่ง</span>

											<?php

											$sql = " SELECT * FROM  trn_content_category Where REF_MODULE_ID = " . $contact_us . " AND FLAG = 0 ";
											$rs = mysql_query($sql) or die(mysql_error());
											?>

											<select class="p-Absolute" name="position" id="positionTxt">

													<option value="0" >กรุณาเลือกตำแหน่ง</option>
												<? while ($row = mysql_fetch_array($rs)) {  ?>

													<option value="<?=$row["CONTENT_CAT_ID"] ?>" ><? echo $row["CONTENT_CAT_DESC_LOC"] ?></option>

												<?	} ?>

											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">ชื่อ นามสกุล</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="txtName" id="txtName"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">ที่อยู่</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="txtAddress" id="txtAddress"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">e-mail</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="txtMail" id="txtMail"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เบอร์โทรศัพท์</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="txtTel" id="txtTel"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">ข้อความ</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><textarea name="txtText" ></textarea></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">

							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div class="g-recaptcha" data-sitekey="6Ld2VgwTAAAAAEmFQsLXE8zem5b7CCg3Jxbjds6p"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">

							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><span>*กรุณกดเพื่อยืนยันตัวตนว่าคุณไม่ใช่โปรแกรมอัตโนมัติ</span></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">

							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<input type="submit" value="save" style="display:none">
											<input type="button" value="ส่ง"class="btnSubmit btn red">
											<input type="button" value="ล้างข้อมูล" class="btnReset btn red">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>


				<div class="box-right">
					<div class="box-top"></div>
					<div class="box-bottom">
						<p class="text-pin">เลขที่ 4 ถนนสนามไชย แขวงบรมมหาราชวัง เขตพระนคร กรุงเทพฯ<br><br>
							ละติจูด   : 13.767397<br>
							ลองติจูด : 100.498604

						</p>
						<p class="text-tel">โทรศัพท์  : <a href="tel:022552777">02 255 2777</a><br>
						โทรสาร   : <a href="tel:022552777">02 255 2775</a></p>
						<p class="text-email"><a href="mailto:webmaster@ndmi.or.th">webmaster@ndmi.or.th</a></p>
					</div>
				</div>
			</div>
			<div class="box-map2d-main">
				<div class="box-map">
					<a href="images/<?=$picFolderName?>/map.jpg" class="lightbox"><img src="images/contact/2dmap-small.jpg"></a>
				</div>
				<div class="box-btn cf">
					<a href="images/<?=$picFolderName?>/map.jpg" class="btn black lightbox">ดูทั้งหมด</a>
				</div>
			</div>
			<div class="box-mapgoogle-main">
				<div class="box-map contact-map">
					<iframe class="scrolloff" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15502.300962222918!2d100.48538226819628!3d13.744146990352395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29904e60c66bb%3A0x2d5ff22f7bc5bea0!2z4Lih4Li04Lin4LmA4LiL4Li14Lii4Lih4Liq4Lii4Liy4LihIChNdXNldW0gU2lhbSk!5e0!3m2!1sth!2s!4v1444907893150" width="878" height="277" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="box-btn cf">
					<a href="https://www.google.com/maps?ll=13.725471,100.506497&z=14&t=m&hl=en-US&gl=US&mapclient=embed&cid=3269598140248211104" class="btn black" target="_blank">ดูทั้งหมด</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php
	include ('inc/inc-footer.php');
 ?>
<script type="text/javascript" src="//www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="js/contact.js"></script>
</body>
</html>
