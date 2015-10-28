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
				
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">Hero Banner</div>
					<div class="floatR searchBox">
						
					</div>
					<div class="clear"></div>
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"></div>
					<div class="floatR orderBox">
						 
					</div>
					<div class="clear"></div>
				</div>
				<div class="mod-body-main-content">

					<div class="Main_Content"   >
						
						<div class="floatL thumbContent">
	 
							<a href="hero_banner_detail.php" class="dBlock" <?=callHeroBannerThumbList(false) ?> ></a>
						</div>
						<div class="floatL nameContent">
							<div><a href="hero_banner_detail.php">Hero Banner</a></div>
							<div></div>
						</div>
						<div class="floatL stausContent">

						 
							 
						</div>
						<div class="floatL EditContent">
							<a href="hero_banner_edit.php" class="EditContentBtn">Edit</a>
							
						</div>
						<div class="clear"></div>
				</div>
		
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