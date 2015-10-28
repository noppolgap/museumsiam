<?php
if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
} else {
	$picFolder = 'en';
}
?>
<div class="part-footer">
	<div class="part-other">
		<div class="container">
			<div class="box-other-main">
				<div class="slide-other">

					<?php
					if ($_SESSION['LANG'] == 'TH')
						$selectedColumn = " MODULE_NAME_LOC as MODULE_DESC ,";
					else
						$selectedColumn = " MODULE_NAME_ENG as MODULE_DESC , ";

					$sqlStr = "SELECT
										MODULE_ID, " . $selectedColumn;
					$sqlStr .= "LINK_URL,
										IS_LAST_NODE
										FROM
										sys_app_module
										WHERE
										ACTIVE_FLAG <> 2
										AND RENDER_ON_FRONT = 'Y'
										ORDER BY
										ORDER_DATA DESC";
					$query = mysql_query($sqlStr, $conn);
					$classIdx = 1;
					while ($row = mysql_fetch_array($query)) {
						echo '<div class="box-other">';
						echo '<a href="' . $row['LINK_URL'] . '?MID=' . $row['MODULE_ID'] . '">';
						echo '<div class="box-pic">';
						
						
						echo '<img src="'.callIconThumbListFrontend('BIG', $row['MODULE_ID'], NULL, false).'">';
						echo '</div>';
						echo '<div class="text-name">';
						echo $row['MODULE_DESC'];
						echo '</div>';
						echo '</a>';
						echo '</div>';
					}
					?>

					<!-- <div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div>
					<div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div>
					<div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div>
					<div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div>
					<div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div>
					<div class="box-other">
						<a href="">
						<div class="box-pic">
							<img src="http://placehold.it/209x218">
						</div>
						<div class="text-name">
							NAME SYSTEM
						</div> </a>
					</div> -->
				</div>
				<a class="btn-arrow left"></a>
				<a class="btn-arrow right"></a>
				<div class="box-btn cf">
					<a href="other-system.php" class="btn black">ดูทั้งหมด</a>
				</div>
			</div>

		</div>
	</div>
	<div class="part-icon">
		<div class="container">
			<div class="box-icon-main cf">
				<a href=""><img src="http://placehold.it/90x90"></a>
				<a href=""><img src="http://placehold.it/90x90"></a>
				<a href=""><img src="http://placehold.it/90x90"></a>
				<a href=""><img src="http://placehold.it/90x90"></a>
				<a href=""><img src="http://placehold.it/90x90"></a>
				<a href=""><img src="http://placehold.it/90x90"></a>
			</div>
		</div>
	</div>
	<div class="part-muse">
		<div class="container">
			<div class="box-muse cf">
				<div class="box-left">
					<input id="txtEmailMuseMag" type="text" placeholder="กรอกอีเมล์ของคุณ">
				</div>
				<div class="box-right">
					<div class="box-btn cf">
						<a id="btnMuseMag" class="btn gold">สมัครรับ MUSE MAG</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="part-copy">
		<div class="container cf">
			<div class="box-left">
				<a href="index.php"><img src="images/th/logo-footer.png"/></a>
			</div>
			<div class="box-right">
				<p>
					Ⓒ Copyright 2015 National Discovery Museum Institute, All right Reserved.
				</p>
			</div>
		</div>
	</div>
</div>
<a class="btn-top"></a>
<script type="text/javascript">
	var please_fill_email = '<?=$please_fill_email?>' ;
	var email_invalid = '<?=$email_invalid?>';
	var regis_complete = '<?=$reg_musemag_complete?>';
</script>
<script type="text/javascript" src="js/musemag.js"></script>