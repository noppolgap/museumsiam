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
		$MID = $_GET['MID'];
		$sql = "SELECT * FROM sys_app_module where MODULE_ID = '" . $MID . "' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($rs);
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มหมวดหมู่ <?=$row['MODULE_NAME_LOC']; ?></div>					
				</div>
				<div class="mod-body-main-content">
					
					<div class="formCms">
						<form action="category_action.php?add&MID=<?=$MID ?>" method="post" name="formcms">
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ En</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							

 <div>
                    <div class="floatL form_name">&nbsp;&nbsp;</div>
                    <div class="floatL form_input">
                      <input  id = "chkHasSubCategory" type="checkbox" name="chkHasSubCategory" >&nbsp;มีหมวดหมู่ย่อย</input>
                          
                    </div>
                    <div class="clear"></div>
                  </div>
				   </div>
				   
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'main_category_view.php?MID=<?=$MID ?>'">
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
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="mod_cms.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>		
<script type="text/javascript" src="mod_cms.js"></script>	
<? logs_access('admin', 'hello'); ?>	
</body>
</html>
