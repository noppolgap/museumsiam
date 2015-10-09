<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<?
	require ('inc_meta.php');
 ?>
</head>

<body>
<?php
		include ('inc/inc-top-bar.php');
 ?>
		<?php
		include ('inc/inc-menu.php');
 ?>
 
 <div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include ('inc/inc-category-menu.php'); ?>
		</div>
		<div class="box-right main-content">

			<!-- start loop -->
						<?php

						$sql = "SELECT * FROM sys_app_module where ACTIVE_FLAG <> 2 ";
						
						$sql .= " order by MODULE_ID asc ";

			    
					$rs = mysql_query($sql) or die(mysql_error());

					$i = 0 ;
					while($row = mysql_fetch_array($rs)){
					?>
						<div data-id="<?=$row['MODULE_ID'] ?>" class="Main_Category_Content floatL">

							<a href="main_category_view.php?MID=<?=$row["MODULE_ID"] ?>"><span class="thumbCategoryContent dBlock" <?=callIconThumbListFrontend( 'BIG', $row['MODULE_ID'], NULL, true) ?>></span></a>
							<div class="nameCategoryContent">
								<div><a href="main_category_view.php?MID=<?=$row["MODULE_ID"] ?>"><?=$row["MODULE_NAME_LOC"] ?></a></div>
								<div>วันที่สร้าง <?=$row["CREATE_DATE"] ?></div>
								<div>วันที่ปรับปรุง <?=$row["LAST_UPDATE_DATE"] ?></div>
							</div>
						</div>
					<?
							
							$i++;
							}mysql_free_result($rs);
						?>

						<!-- end loop -->
						<div class="clear"></div>
				 


			 
			 
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	
 
 
 
 
   

</body>
</html>
<? CloseDB(); ?>
