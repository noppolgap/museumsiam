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
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>
						 
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
					echo str_replace('../../', '',$rowContent['CMS_TEXT']);
					?>
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
						echo str_replace('../../', '',$rowContent['CMS_TEXT']);
						?>

					</div>
				</div>
			</div>
			<div class="box-right">
				<!-- RATE_FREE_2-->
				<?php
				$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='RATE_FREE_2' AND ACTIVE_FLAG = 1";
				$rsContent = mysql_query($sql) or die(mysql_error());
				$rowContent = mysql_fetch_array($rsContent);
				echo str_replace('../../', '',$rowContent['CMS_TEXT']);
				?>
				 
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
