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
				<img src="images/<?=$picFolder?>/service/archive/pic-service1.jpg"/>
			</div>
			<div class="box-text1-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/archive/title1.png"/></p>
				<!-- ARCHIVE_STORY-->
				
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='ARCHIVE_STORY' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>
				<p class="text4">
					<img src="images/<?=$picFolder?>/service/archive/pic-service2.png"/>
				</p>
			</div>
			<hr class="line-gray"/>
			<div class="box-text2-main cf">
				<p class="text1">
					<img src="images/<?=$picFolder?>/service/archive/title3.png"/>
				</p>
				<p class="text6">
					<a href="#" target="_blank"><img src="images/<?=$picFolder?>/service/archive/pic-service3.png"/></a>
				</p>
			</div>
			<hr class="line-gray"/>
			
			<div class="box-text3-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/archive/title4.png"/></p>
				<!-- ARCHIVE_ADDRESS -->
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='ARCHIVE_ADDRESS' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>

				
				<p class="text3">
					<img src="images/<?=$picFolder?>/service/archive/title5.png"/>
				</p>
				<div class="box-btn cf">
					<a href="#" class="btn black">ดูแผนที่</a>
				</div>
			</div>

