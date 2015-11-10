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
				$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu2").addClass("active");
				if ($('.menu-left li.menu2').hasClass("active")) {
					$('.menu-left li.menu2').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="condition">

		<?php
		include ('inc/inc-top-bar.php');
		include ('inc/inc-menu.php');

		if ($_SESSION['LANG'] == 'TH') {
			$selectedColumn = 'CMS_TEXT_LOC';
		} else {
			$selectedColumn = 'CMS_TEXT_ENG';
		}
		?>

		?>

		<div class="part-nav-main"  id="firstbox">
			<div class="container">
				<div class="box-nav">
					<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							ติดต่อเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							เงื่อนไขข้อกำหนด
						</li>
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
						<h1>E-APPLICATION <span>เงื่อนไขข้อกำหนด</span></h1>
					</div>
					<hr class="line-gray"/>
					<div class="box-detail-main">

						<!-- EAPP_CONDITION-->
						<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='EAPP_CONDITION' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>
						
						<!-- <p>
						มีหลักฐานที่เป็นข้อเท็จจริงยืนยันมานานแล้ว ว่าเนื้อหาที่อ่านรู้เรื่องนั้นจะไปกวนสมาธิของคนอ่านให้เขวไปจากส่วนที้เป็น Layout เรานำ Lorem Ipsum มาใช้เพราะความที่มันมีการกระจายของตัวอักษรธรรมดาๆ แบบพอประมาณ ซึ่งเอามาใช้แทนการเขียนว่า ‘ตรงนี้เป็นเนื้อหา, ตรงนี้เป็นเนื้อหา' ได้ และยังทำให้มองดูเหมือนกับภาษาอังกฤษที่อ่านได้ปกติ ปัจจุบันมีแพ็กเกจของซอฟท์แวร์การทำสื่อสิ่งพิมพ์ และซอฟท์แวร์การสร้างเว็บเพจ (Web Page Editor) หลายตัวที่ใช้ Lorem Ipsum เป็นแบบจำลองเนื้อหาที่เป็นค่าตั้งต้น และเวลาที่เสิร์ชด้วยคำว่า 'lorem ipsum' ผลการเสิร์ชที่ได้ก็จะไม่พบบรรดาเว็บไซต์ที่ยังคงอยู่ในช่วงเริ่มสร้างด้วย โดยหลายปีที่ผ่านมาก็มีการคิดค้นเวอร์ชั่นต่างๆ ของ Lorem Ipsum ขึ้นมาใช้ บ้างก็เป็นความบังเอิญ บ้างก็เป็นความตั้งใจ (เช่น การแอบแทรกมุกตลก)
						</p>
						<p>
						มีหลักฐานที่เป็นข้อเท็จจริงยืนยันมานานแล้ว ว่าเนื้อหาที่อ่านรู้เรื่องนั้นจะไปกวนสมาธิของคนอ่านให้เขวไปจากส่วนที้เป็น Layout เรานำ Lorem Ipsum มาใช้เพราะความที่มันมีการกระจายของตัวอักษรธรรมดาๆ แบบพอประมาณ ซึ่งเอามาใช้แทนการเขียนว่า ‘ตรงนี้เป็นเนื้อหา, ตรงนี้เป็นเนื้อหา' ได้ และยังทำให้มองดูเหมือนกับภาษาอังกฤษที่อ่านได้ปกติ ปัจจุบันมีแพ็กเกจของซอฟท์แวร์การทำสื่อสิ่งพิมพ์ และซอฟท์แวร์การสร้างเว็บเพจ (Web Page Editor) หลายตัวที่ใช้ Lorem Ipsum เป็นแบบจำลองเนื้อหาที่เป็นค่าตั้งต้น และเวลาที่เสิร์ชด้วยคำว่า 'lorem ipsum' ผลการเสิร์ชที่ได้ก็จะไม่พบบรรดาเว็บไซต์ที่ยังคงอยู่ในช่วงเริ่มสร้างด้วย โดยหลายปีที่ผ่านมาก็มีการคิดค้นเวอร์ชั่นต่างๆ ของ Lorem Ipsum ขึ้นมาใช้ บ้างก็เป็นความบังเอิญ บ้างก็เป็นความตั้งใจ (เช่น การแอบแทรกมุกตลก)
						</p> -->

					</div>
					<div class="box-pagination-main cf">
						<div class="box-btn">
							<a href="contact-eapp.php" class="btn black">ย้อนกลับ</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
		?>

	</body>
</html>
