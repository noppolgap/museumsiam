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
				<img src="images/<?=$picFolder?>/service/knowlagepic-service1.jpg"/>
			</div>
			<div class="box-text1-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/knowlagetitle1.png"/></p>
				<!-- KM_STORY -->
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='KM_STORY' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo $rowContent['CMS_TEXT'];
						?>
						
				<!-- <p class="text2">
					การเรียนรู้จากนิทรรศการอาจจุดประกายให้ผู้เข้าชมโดยเฉพาะเยาวชน มีความสนใจจะต่อยอดองค์ความรู้ ที่ได้รับมาจากการชมนิทรรศการ ณ "มิวเซียมสยาม" ดังนั้น "สถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ (สพร.)" จึงจัดตั้ง “ห้องคลังความรู้” ให้เป็นที่รวบรวมองค์ความรู้ ด้วยสื่อที่หลากหลาย ส่งเสริมการเรียนรู้ การค้นคว้าฐานองค์ความรู้ที่อาจจะเป็นแรงกระตุ้นให้เกิดการสืบค้นในด้านโบราณคดี ประวัติศาสตร์ พิพิธภัณฑ์วิทยา และศาสตร์ความรู้ในด้านอื่นๆ
				</p>
				<p class="text3">
					นอกจากนี้ยังเป็นการเปิดโลกทัศน์ให้เห็นมุมมองด้านพิพิธภัณฑ์ในต่างประเทศด้วยการสรรหาสื่อในรูปแบบ เช่น DVD ภาพยนตร์ บทความ นวนิยาย ฯลฯ ที่อาจสร้างแรงบันดาลใจให้คนรุ่นใหม่เห็นความสำคัญ ต่อพิพิธภัณฑ์มากขึ้น
				</p> -->
			</div>
			<hr class="line-gray"/>
			<div class="box-text2-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/knowlagetitle2.png"/></p>
				<p class="text2">
					<img src="images/<?=$picFolder?>/service/knowlagepic-service2.png"/>
				</p>
				<!-- KM_INFOR_MGR -->
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='KM_INFOR_MGR' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo $rowContent['CMS_TEXT'];
						?>
						
				<!-- <p class="text3">
					การจัดเก็บเอกสารใช้ระบบหอสมุดรัฐสภาอเมริกัน (LC) โดยจะเน้นเนื้อหาในหมวดพิพิธภัณฑ์ (A) ประวัติศาสตร์ (D) รวมทั้งหนังสือเด็ก และวิทยานิพนธ์ที่เกี่ยวข้องกับพิพิธภัณฑ์ รวมเนื้อหาทรัพยากรมากกว่า 4,000 รายการ
				</p>
				<p class="text4">
					* ในระยะแรก “ห้องสมุด” ให้บริการ ยืม – คืน หนังสือแก่เจ้าหน้าที่ในสถาบัน พิพิธภัณฑ์การเรียนรู้แห่งชาติ และในอนาคตจึงจะเปิดให้บริการแก่สมาชิก ประชาชนทั่วไป
				</p> -->
				<p class="text5">
					<img src="images/<?=$picFolder?>/service/knowlagetitle3.png"/>
				</p>
				<p class="text6">
					<a href="#" target="_blank"><img src="images/<?=$picFolder?>/service/knowlagepic-service3.png"/></a>
				</p>
			</div>
			<hr class="line-gray"/>
			
			<div class="box-text3-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/knowlagetitle4.png"/></p>
				<!-- KM_ADDRESS -->
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='KM_ADDRESS' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
					//	echo $rowContent['CMS_TEXT'];
						?>
				<!-- <p class="text2">
					"ห้องคลังความรู้" ชั้น 1 อาคารสำนักงาน สถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ เลขที่ 4 
ถนนสนามไชย เขตพระนคร กรุงเทพ 10230 
				</p> -->
				<p class="text3"> 
					<img src="images/<?=$picFolder?>/service/knowlagetitle5.png"/>
				</p>
				<div class="box-btn cf">
					<a href="#" class="btn black">ดูแผนที่</a>
				</div>
			</div>

