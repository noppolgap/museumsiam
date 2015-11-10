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
	<img src="images/<?=$picFolder ?>/service/museshop/pic-service1.jpg"/>
</div>
<div class="box-text1-main cf">
	<p class="text1"><img src="images/<?=$picFolder ?>/service/museshop/title1.png"/>
	</p>
	<p class="text2">
		<?php
		//MUSE_SHOP
		$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSE_SHOP' AND ACTIVE_FLAG = 1";
		$rsContent = mysql_query($sql) or die(mysql_error());
		$rowContent = mysql_fetch_array($rsContent);
		echo str_replace('../../', '', $rowContent['CMS_TEXT']);
		?>

		<!-- “Muse Kitchen by Elefin Coffee” ร้านกาแฟไทย คั่ว บด สด ใหม่เสมอ จากเมล็ดพันธุ์ อราบิก้า ที่ดีที่สุด ด้วยเครื่องคั่วกาแฟดั้งเดิมจากเยอรมัน
		นอกจากนี้ยังมีเบเกอรี่สดใหม่ และอาหารหลากหลายเมนูให้ท่านเลือกสรร -->
	</p>
	<p class="text3"><img src="images/<?=$picFolder ?>/service/museshop/pic-service2.png"/>
	</p>
</div>
<hr class="line-gray"/>
<div class="box-text2-main cf">
	<p class="text1"><img src="images/<?=$picFolder ?>/service/museshop/title2.png"/>
	</p>
</div>
