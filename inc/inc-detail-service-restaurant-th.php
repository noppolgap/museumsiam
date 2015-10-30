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
				<img src="images/<?=$picFolder?>/service/restaurant/pic-service1.jpg"/>
			</div>
			<div class="box-text1-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/restaurant/title1.png"/></p>
				<!-- MUSE_KITCHEN -->
				<?php
						$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='MUSE_KITCHEN' AND ACTIVE_FLAG = 1";
						$rsContent = mysql_query($sql) or die(mysql_error());
						$rowContent = mysql_fetch_array($rsContent);
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>
			</div>
			<hr class="line-gray"/>
			<div class="box-text2-main cf">
				<p class="text1"><img src="images/<?=$picFolder?>/service/restaurant/title2.png"/></p>
			</div>
