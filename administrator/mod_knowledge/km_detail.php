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
					<div class="floatL titleBox">รายละเอียด</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">

				<? $id = $_GET['cid']; 
							$contentID = $_GET['conid'];
						?>
						<?php 
						$sql= "select cdetail.* , cat.CONTENT_CAT_DESC_LOC from 
								trn_content_detail cdetail 
								inner JOIN trn_content_category cat
								on cdetail.CAT_ID = cat.CONTENT_CAT_ID
								where 
								REF_MODULE_ID = 2 and CONTENT_ID = $contentID ";
								
								//echo  $sql;
								
						$query = mysql_query($sql,$conn);			 
						?>


				<? while($row = mysql_fetch_array($query)) {  ?>
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<input type="hidden" name="txtCatID" value="<? echo $id ; ?>" class="w90p" />
									<div class="floatL form_input"><input type="text" name="txtCatDesc"  class="w90p" value="<? echo $row['CONTENT_CAT_DESC_LOC']; ?>" />
								</div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" value="<? echo $row['CONTENT_DESC_LOC']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" value="<? echo $row['CONTENT_DESC_ENG']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="txtBriefLoc" class="mytextarea2 w90p"><?echo $row['BRIEF_LOC'] ;?></textarea></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="txtBriefEng" class="mytextarea2 w90p"><?echo $row['BRIEF_ENG'] ;?></textarea></div>
								<div class="clear"></div>
							</div>
							<<div class="bigForm">
								<div class="floatL form_name">รายละเอียด TH</div>
								<div class="floatL form_input"><textarea name="txtDetailLoc" value="" class="mytextarea w90p"><?echo $row['CONTENT_DETAIL_LOC'] ;?></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด EN</div>
								<div class="floatL form_input"><textarea name="txtDetailEng" value="" class="mytextarea w90p"><?echo $row['CONTENT_DETAIL_ENG'] ;?></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm" style="display:none">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo')?></div>
								<div class="clear"></div>
							</div>	

							<?}?>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />

<script type="text/javascript" src="../master/script.js"></script>		
	
<? logs_access('admin','hello'); ?>	
</body>
</html>
