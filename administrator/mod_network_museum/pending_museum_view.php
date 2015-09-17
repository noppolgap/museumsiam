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
		<?php

		$sql = "SELECT * FROM  trn_museum_detail where ACTIVE_FLAG <> 2 and IFNULL(APPROVE_FLAG , 'N') = 'N' and IS_GIS_MUSEUM = 'N'";
		$rs = mysql_query($sql) or die(mysql_error());
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">พิพิธภัฑณ์เครือข่ายรอการอนุมัติ</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="formCms">
						 
						<form action="" method="post" name="formcms">
							<div>
							   <? while($row = mysql_fetch_array($rs)) {  ?>
							
							
							<div class="Main_Content" data-id="<?=$row['MESEUM_DETAIL_ID'] ?>" >
						<div class="floatL checkboxContent"></div>
						
						<div class="floatL nameContent">
							<div><? echo '<a href="pending_museum_approve.php?MUID='.$row['MESEUM_DETAIL_ID'].'">'. $row['MUSEUM_NAME_LOC'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>	
						<div class="floatL stausContent">
						
							   </div>
					 
						<div class="floatL EditContent">
							<!--<a href="content_edit.php?MUID=<?=$row['MESEUM_DETAIL_ID'] ?>" class="EditContentBtn">Edit</a>-->
							<!--<a href="#" data-id="<?=$row['CONTENT_ID'] ?>" class="DeleteContentBtn">Delete</a>-->
						</div> 
						<div class="clear"></div>	
				</div>	
								
							<?} ?>

							<div class="btn_action">
								
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'main_category_view.php?MID=<?=$MID ?>' ">
							</div>
						</form> 
					</div>
				</div>
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
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin', 'hello'); ?>	
</body>
</html>
