<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/faqs.css" />

<script>
	$(document).ready(function(){
		$("li.menu7").addClass("active");	
		
		$('.box-q').on('click', function(e){ 
			$(".box-q").next().slideUp();
			$(".box-q").removeClass("active");
			e.stopPropagation();
			if ($(this).hasClass("opened")) {
				$(".box-q").next().slideUp();
				$(".box-q").removeClass("opened");
				$(this).next().slideUp();
				$(this).removeClass("active");
				$(this).removeClass("opened");
			}else{
				$(".box-q").removeClass("opened");
				$(this).next().slideDown();
				$(this).addClass("active");
				$(this).addClass("opened");
			}
		});

			
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>	
	
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ถาม-ตอบ</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p style="text-transform: capitalize;">
				FAQs<br>
				<span>ถาม-ตอบ</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-faq-main">
	<div class="container">
		<div class="box-faq-main">
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					คำถาม
				</div>
				<div class="content-hide">
					<div class="box-a">
						<span class="tri-a"></span>
						ใช้งานไกด์น็อค จุ๊ยแคนูปัจฉิมนิเทศเฟอร์นิเจอร์นู้ด ทับซ้อนวานิลาโชว์รูมสะเด่าแอโรบิค สุริยยาตร์ช็อปเก๊ะห่วยพาสปอร์ต รันเวย์แจ็กเก็ตซิงก๋ากั่น บริกรทำงาน วโรกาสเลิฟคีตกวีอุเทน สเตเดียม รามเทพแคมเปญเช็งเม้งเป็นไงมาเฟีย สไลด์เอ็นทรานซ์เซ็กซ์ พาร์ทเนอร์ถ่ายทำ มาร์คมินต์โหลยโท่ยลามะ อาร์ติสต์เวณิกาแอโรบิคอ่อนด้อยโจ๋ การันตีคอร์รัปชันทาวน์เฮาส์ วอฟเฟิล ปิโตรเคมีมาม่าแมชีน
					</div>
				</div>	
			</div>
			
		</div>
	</div>
</div>


<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
