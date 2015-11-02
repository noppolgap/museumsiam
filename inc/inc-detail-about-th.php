<?php

if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
	$selectedColumn = 'CMS_TEXT_LOC';
} else {
	$picFolder = 'en';
	$selectedColumn = 'CMS_TEXT_ENG';
}
?>

<div class="box-pic-main">
	<img src="images/<?=$picFolder ?>/about/pic-about1.jpg" alt="pic-about1" width="" height="" />
</div>
<div class="box-text1-main cf">
	<!-- <div class="box-left">
		<p class="title">
			<img src="images/<?=$picFolder ?>/about/title1.png"/>
		</p>
		<p class="text"> -->
			<!-- KNOW_MUSEUM -->
			<!-- มิวเซียมสยาม พิพิธภัณฑ์การเรียนรู้ (Museum Siam: Discovery Museum) ภายใต้ สถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ (สพร.) เป็นพิพิธภัณฑ์การเรียนรู้แห่งแรกที่เน้น การสร้างประสบการณ์สดใหม่ในการชมพิพิธภัณฑ์ ซึ่งจัดตั้งขึ้นเพื่อเป็นต้นแบบของ แหล่งเรียนรู้ที่น่ารื่นรมย์ และช่วยยกระดับมาตรฐานการจัดการเรียนรู้ในรูปแบบใหม่ ให้กับประชาชน โดยเฉพาะเด็กและเยาวชนไทยเกี่ยวกับการสร้างสำนึกในการรู้จัก ตนเอง รู้จักเพื่อนบ้าน และรู้จักโลก รวมถึงการสร้าง “แนวคิดและภาพลักษณ์ใหม่” ของพิพิธภัณฑ์ในสังคมแห่งการเรียนรู้ ผ่านเทคโนโลยีสมัยใหม่ และกิจกรรมสร้าง สรรค์ เพื่อให้การเรียนรู้ประวัติศาสตร์และเรื่องราวต่างๆ เป็นไปอย่างสนุกสนานยิ่งขึ้น ซึ่งประกอบด้วย -->
			<?php
			$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='KNOW_MUSEUM' AND ACTIVE_FLAG = 1";
			$rsContent = mysql_query($sql) or die(mysql_error());
			$rowContent = mysql_fetch_array($rsContent);
			echo  str_replace('../../', '',$rowContent['CMS_TEXT']);
			?>
		<!-- </p>
	</div>
	<div class="box-right">
		<img src="images/<?=$picFolder ?>/about/pic-about2.jpg" alt="pic-about2" width="" height="" />
	</div> -->
</div>
<div class="box-text2-main cf">
	<p class="text"><img src="images/<?=$picFolder ?>/about/title2.png"/>
	</p>
</div>
<hr class="line-gray"/>
<div class="box-text3-main cf">
	<p class="text"><img src="images/<?=$picFolder ?>/about/title3.png"/>
	</p>
	<img src="images/<?=$picFolder ?>/about/pic-about3.png" class="pic-about2" width="" height="" />
	<p class="text2"><img src="images/<?=$picFolder ?>/about/title4.png"/>
	</p>
	<p class="text3">
		<!-- MUSEUM_CONCEPT -->
		<!--เป็นหัวใจสำคัญของสถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ โดยมีจุดมุ่งหมายในการปฏิรูป พิพิธภัณฑ์ที่ก่อให้เกิดประโยชน์อย่างสูงสุด นำเสนอด้วยรูปแบบที่สร้างสรรค์และสนุกสนานโดยใช้กิจกรรมต่างๆ เป็นตัวขับเคลื่อนที่สำคัญ ฉะนั้น ข้าวของเครื่องใช้ที่จัดแสดงภายในพิพิธภัณฑ์จะต้องเป็นสิ่งที่สามารถจับต้องได้ เพื่อสื่อความหมายในการเล่าเรื่องและเชื่อมต่อสิ่งต่างๆ ได้อย่างสมบูรณ์-->
		<?php
		$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSEUM_CONCEPT' AND ACTIVE_FLAG = 1";
		$rsContent = mysql_query($sql) or die(mysql_error());
		$rowContent = mysql_fetch_array($rsContent);
		echo str_replace('../../', '',$rowContent['CMS_TEXT']);
		?>
	</p>
</div>
<hr class="line-gray"/>
<div class="box-text4-main cf">
	<div class="box-left">
		<img src="images/<?=$picFolder ?>/about/pic-about4.jpg" alt="pic-about4" width="" height="" />
	</div>
	<div class="box-right">
		<p class="title">
			<img src="images/<?=$picFolder ?>/about/title5.png"/>
		</p>
		<p class="text">
			<!-- MUSEUM_LOGO-->
			<?php
			$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSEUM_LOGO' AND ACTIVE_FLAG = 1";
			$rsContent = mysql_query($sql) or die(mysql_error());
			$rowContent = mysql_fetch_array($rsContent);
			echo str_replace('../../', '',$rowContent['CMS_TEXT']);
			?>
			<!--	หรือ รูปคนทำท่าเป็นกบเป็นสัญลักษณ์ของสถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ เพราะกบถือเป็น
			สัตว์ศักดิ์สิทธิ์ที่แสดงถึงความอุดมสมบูรณ์ เป็นที่เคารพบูชาทั่วทั้งเอเชียตะวันออกเฉียงใต้ เห็นได้จากลวดลาย
			บนกลองมโหระทึกที่เป็นเครื่องมือใช้ประโคมตีในพิธีกรรมขอฝน		-->
		</p>
	</div>
</div>
<hr class="line-gray"/>
<div class="box-pic">
	<a href="#"><img src="images/<?=$picFolder ?>/about/pic-about5.png" alt="pic-about5" width="" height="" /></a>
</div>

