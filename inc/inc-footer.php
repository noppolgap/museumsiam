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
										AND IS_FOR_OTHER_LINK = 'N'
										ORDER BY
										ORDER_DATA DESC";
					$query = mysql_query($sqlStr, $conn);
					$classIdx = 1;
					while ($row = mysql_fetch_array($query)) {
						echo '<div class="box-other">';
						echo '<a href="' . $row['LINK_URL'] . '?MID=' . $row['MODULE_ID'] . '">';
						echo '<div class="box-pic">';

						echo '<img src="' . callIconThumbListFrontend('BIG', $row['MODULE_ID'], NULL, false) . '">';
						echo '</div>';
						echo '<div class="text-name">';
						echo $row['MODULE_DESC'];
						echo '</div>';
						echo '</a>';
						echo '</div>';
					}
					?>
				</div>
				<a class="btn-arrow left"></a>
				<a class="btn-arrow right"></a>
				<div class="box-btn cf">
					<a href="other-system.php" class="btn black"><?=$seeAllCap?></a>
				</div>
			</div>

		</div>
	</div>
	<div class="part-icon">
		<div class="container">
			<div class="box-icon-main cf">
				<?php
				if ($_SESSION['LANG'] == 'TH')
					$selectedColumn = " modul.MODULE_NAME_LOC as MODULE_DESC ,";
				else
					$selectedColumn = " modul.MODULE_NAME_ENG as MODULE_DESC , ";

				$sqlStr = "SELECT
modul.MODULE_ID, " . $selectedColumn;
				$sqlStr .= " banner.ICON_LINK as  LINK_URL,
modul.IS_LAST_NODE
FROM
sys_app_module modul
left join trn_banner_pic_setting banner
on banner.APP_MODULE_ID = modul.MODULE_ID
WHERE
modul.ACTIVE_FLAG <> 2
AND modul.IS_FOR_OTHER_LINK = 'Y'
ORDER BY
modul.ORDER_DATA DESC";
				$query = mysql_query($sqlStr, $conn);
				//echo $sqlStr ;
				$classIdx = 1;
				while ($row = mysql_fetch_array($query)) {

					echo '<a target = "_blank" href="' . $row['LINK_URL'] . '">';

					echo '<img   src="' . callIconThumbListFrontend('BIG', $row['MODULE_ID'], NULL, false) . '">';

					echo '</a>';

				}
				?>
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
						<a id="btnMuseMag" class="btn gold"><?=$career?> MUSE MAG</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="part-copy">
		<div class="container cf">
			<div class="box-text">
				<p>Ⓒ Copyright 2015 National Discovery Museum Institute, All right Reserved.</p>
			</div>
			<div class="box-logo">
				<a href="index.php"><img src="images/th/logo-footer.png"/></a>
			</div>
		</div>
	</div>
</div>
<a class="btn-top"></a>
<script type="text/javascript">
	var please_fill_email =  '<?=$please_fill_email ?>' ;
	var email_invalid = '<?=$email_invalid ?>';
	var regis_complete = '<?=$reg_musemag_complete ?>';
	</script>
<script type="text/javascript" src="js/musemag.js"></script>