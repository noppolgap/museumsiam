<?php

if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
	$selectedColumn = 'CMS_TEXT_LOC';
} else {
	$picFolder = 'en';
	$selectedColumn = 'CMS_TEXT_ENG';
}
?>

<div class="box-detail-museum">
	<div class="box-top cf">
		<div class="container cf">
			<div class="box-left">
				<div class="box-title">
					<img src="images/<?=$picFolder ?>/index/title-museum-main.png"/>
				</div>
				<img src="images/pic-detail-meseum1.jpg"/>
				<div class="box-timeopen">
					<div class="box-text">
						<p class="text-title">
							<img src="images/<?=$picFolder ?>/index/part1-pic1.png" />
						</p>
						<!-- MUSEUM_OPENDAY-->
						<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSEUM_OPENDAY' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo $rowContent['CMS_TEXT'];
						?>
						<!-- <p class="text-date2">เปิดให้บริการวันอังคาร-วันอาทิตย์ (ปิดให้บริการทุกวันจันทร์)</p>
						<p class="text-time">10.00 - 18.00 น.</p> -->
					</div>
				</div>
			</div>
			<div class="box-right">
				<div class="box-text">
					<p class="text-title"><img src="images/<?=$picFolder ?>/index/part1-pic2.png" />
					</p>

					<!--MUSEUM_RATE-->
					<?php
					$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSEUM_RATE' AND ACTIVE_FLAG = 1";
					$rsContent = mysql_query($sql) or die(mysql_error());
					$rowContent = mysql_fetch_array($rsContent);
					echo $rowContent['CMS_TEXT'];
					?>

					<!-- <p class="text-title2 icon-money">บุคคลทั่วไป</p>

					<div class="row-text BcolorGray cf">
					<p class="text-1">นักเรียน นักศึกษา (อายุ 15 ปีขึ้นไป)</p>
					<p class="text-2">50</p>
					<p class="text-3">บาท</p>
					</div>
					<div class="row-text cf">
					<p class="text-1">ผู้ใหญ่คนไทย</p>
					<p class="text-2">100</p>
					<p class="text-3">บาท</p>
					</div>
					<div class="row-text BcolorGray cf MarginB">
					<p class="text-1">ผู้ใหญ่ชาวต่างชาติ</p>
					<p class="text-2">200</p>
					<p class="text-3">บาท</p>
					</div>

					<p class="text-title2">หมู่คณะ 5 คนขึ้นไป</p>

					<div class="row-text BcolorGray cf">
					<p class="text-1">นักเรียน นักศึกษา (อายุ 15 ปีขึ้นไป)</p>
					<p class="text-2">25</p>
					<p class="text-3">บาท</p>
					</div>
					<div class="row-text cf">
					<p class="text-1">ผู้ใหญ่คนไทย</p>
					<p class="text-2">50</p>
					<p class="text-3">บาท</p>
					</div>
					<div class="row-text BcolorGray cf MarginB">
					<p class="text-1">ผู้ใหญ่ชาวต่างชาติ</p>
					<p class="text-2">100</p>
					<p class="text-3">บาท</p>
					</div>
					<p class="text-title2">หมู่คณะตั้งแต่ 20 คนขึ้นไป <span>(ไม่เกิน 80 คน)</span> <a href="tel:02 225 277 #413">ติดต่อ 02 225 277 ต่อ 413</a></p> -->
				</div>
			</div>
		</div>
	</div>
	<div class="box-middle cf">
		<div class="container cf">
			<div class="box-left">
				<div class="box-timeopen">
					<div class="box-text">
						<p class="text-title"><img src="images/<?=$picFolder ?>/index/part1-pic3.png" />
						</p>
						<!-- RATE_FREE-->
						<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='RATE_FREE' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo $rowContent['CMS_TEXT'];
						?>

						<!-- <p class="text-date2">วันหยุดนักขัตฤกษ์ที่ประกาศโดยสถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ</p>
						<p class="text-time">ตั้งแต่เวลา 16.00-18.00 น. ของทุกวันทำการ</p> -->
					</div>
				</div>
			</div>
			<div class="box-right">
				<!-- RATE_FREE_2-->
				<?php
				$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='RATE_FREE_2' AND ACTIVE_FLAG = 1";
				$rsContent = mysql_query($sql) or die(mysql_error());
				$rowContent = mysql_fetch_array($rsContent);
				echo $rowContent['CMS_TEXT'];
				?>
				<!-- <p>
				เยาวชนไทยและเยาวชนต่างชาติ อายุต่ำกว่า 15 ปี ผู้สูงอายุ 60 ปีขึ้นไป พระภิกษุสงฆ์ นักบวช ผู้พิการและทุพพลภาพ มัคคุเทศน์
				<span>(แสดงบัตรประจำตัวที่ออกโดยกระทรวงการท่องเที่ยวและกีฬา)</span>
				</p> -->
			</div>
		</div>
	</div>
	<div class="box-bottom">
		<div class="container cf">
			<div class="box-btn cf">
				<a href="images/<?=$picFolder ?>/map.jpg" class="btn black lightbox">แผนที่</a>
				<a href="images/<?=$picFolder ?>/park.jpg" class="btn black lightbox">ที่จอดรถ</a>
				<a href="images/<?=$picFolder ?>/transport.jpg" class="btn black lightbox">การเดินทาง</a>
			</div>
		</div>
	</div>
</div>
