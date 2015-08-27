<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body>
<? require('../inc_header.php'); ?>		
<div class="main-container">
	<div class="main-body marginC">
		<? require('../inc_side.php'); ?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มรายการ</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="formCms">
						<? $id = $_GET['g']; ?>
						<?php
							   $sql= "SELECT * FROM  trn_main_digital_ach  WHERE FLAG <> 2 AND MAIN_DIGITAL_ID = $id";
							   $query = mysql_query($sql,$conn);
						?>

						<form action="sub_digital_action.php?add&p=<?=$id?>" method="post" name="formcms">
					
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<input type="hidden" name="main_id" value="<? echo $id; ?>" class="w90p" />

								<? while($row = mysql_fetch_array($query)) {  ?>
									<div class="floatL form_input"><input type="text" name="sub_digi_id"  class="w90p" value="<? echo $row['MAIN_DIGITAL_DESC_LOC']; ?>" />
								
								<?}?>
								</div>
								<div class="clear"></div>
				
							</div>
							<div>
								<div class="floatL form_name">หมวดฟมู่</div>
								<div class="floatL form_input">
 <?php
					$sql = "SELECT MODULE_ID  , MODULE_NAME_LOC , MODULE_NAME_ENG FROM sys_app_module where ACTIVE_FLAG <> 2 ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbModule' name = 'cmbModule'>";
					echo "<option value='-1'>กรุณาเลือกโมดูล</option>";
				while($row = mysql_fetch_array($rs)){
				echo "<option value='".$row["MODULE_ID"]."'>".$row["MODULE_NAME_LOC"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
				?>
      <span class="error" >* <span id = "moduleError" style="display:none">กรุณาระบุโมดูลหลัก </span> </span>
                    </div>
								</div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="sub_name_th" value="<? echo $row['DIGITAL_DESC_LOC']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="sub_name_en" value="<? echo $row['DIGITAL_DESC_ENG']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'sub_digital_view.php?p=<?=$_GET['g']?>' ">
							</div>
						</form> 
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
