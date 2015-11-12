<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
	<head>
		<?
		require ('../inc_meta.php');
		?>
	</head>

	<body>
		<?
		require ('../inc_header.php');
		?>
		<div class="main-container">
			<div class="main-body marginC">
				<?
				require ('../inc_side.php');
				?>

				<div class="mod-body">
					<div class="buttonActionBox">
						<input type="button" value="เพิ่ม" class="buttonAction emerald-flat-button" onclick="window.location.href = 'hero_banner_add.php'">
						<input type="button" value="ลบ" style="display: none" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="hero_banner_action.php?delete">
						<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('hero_banner_order.php');">
					</div>
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								Hero Banner
							</div>
							<div class="floatR searchBox">

							</div>
							<div class="clear"></div>
						</div>
						<div class="mod-body-inner-action">
							<div class="floatL checkAllBox"><label><input style="display: none" type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
							<div class="floatR orderBox">

							</div>
							<div class="clear"></div>
						</div>
						<?
						$sql = "SELECT * FROM  trn_hero_banner WHERE IMG_TYPE = 1  order by ORDER_ID DESC ";

						$query = mysql_query($sql, $conn);
						?>

						<div class="mod-body-main-content">
							<!-- start loop -->
							<?php while($row = mysql_fetch_array($query)) {
							?>
							<div class="Main_Content" data-id="<?=$row['PIC_ID'] ?>"  >

								<div class="floatL thumbContent">

									<a href="hero_banner_detail.php?PID=<?=$row['PIC_ID']?>" class="dBlock" style="background-image: url('<?=$row['IMG_PATH']?>');"   ></a>
								</div>
								<div class="floatL nameContent">
									<div>
										<a href="hero_banner_detail.php?PID=<?=$row['PIC_ID']?>">Hero Banner <?=$row['ORDER_ID']?></a>
									</div>
									<div></div>
								</div>
								<div class="floatL stausContent">

								</div>
								<div class="floatL EditContent">
									<a href="hero_banner_edit.php?PID=<?=$row['PIC_ID']?>" class="EditContentBtn">Edit</a>
									<a href="#" data-id=<?=$row['PIC_ID'] ?> class="DeleteContentBtn">Delete</a>
								</div>
								<div class="clear"></div>
							</div>
							<?} ?>
						</div>

					</div>
					<div class="buttonActionBox">

					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
		require ('../inc_footer.php');
		?>
		<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
		<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>
		<? logs_access('admin', 'hello'); ?>
	</body>
</html>