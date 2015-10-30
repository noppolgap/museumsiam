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
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>

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
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>

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
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>
				 
				<p class="text3"> 
					<img src="images/<?=$picFolder?>/service/knowlagetitle5.png"/>
				</p>
				<div class="box-btn cf">
					<a href="#" class="btn black">ดูแผนที่</a>
				</div>
			</div>

