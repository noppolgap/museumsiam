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
		<?php
		$MID = $_GET['MID'];
		$CID = $_GET['cid'];
		$sql = "SELECT * FROM trn_content_category where CONTENT_CAT_ID = '".$CID."' ";
			$rs = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($rs);
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">หมวดหมู่ย่อย ภายใต้ <?=$row['CONTENT_CAT_DESC_LOC'];?></div>					
				</div>
				<div class="mod-body-main-content">
					<div class="formCms">
						<? $id = $_GET['scid']; ?>
						<form action="" method="post" name="formcms">
							<?php
							   $sql= "SELECT sc.*  , cc.CONTENT_CAT_DESC_LOC , cc.CONTENT_CAT_DESC_ENG ";
							   $sql.=" FROM trn_content_sub_category sc ";
							   $sql.=" inner join trn_content_category cc on cc.CONTENT_CAT_ID = sc.CONTENT_CAT_ID ";
							   $sql.=" WHERE sc.Flag <> 2 AND sc.SUB_CONTENT_CAT_ID = $id  ";
							   $query = mysql_query($sql,$conn);
							?>

							<div>
							   <? while($row = mysql_fetch_array($query)) {  ?>								
							</div>	
							
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<div class="floatL form_input">
								<input type="text" name="txtCat" value="<? echo $row['CONTENT_CAT_DESC_LOC']; ?>" class="w90p" />	
								</div>
								<div class="clear"></div>
							</div>
							
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" value="<? echo $row['SUB_CONTENT_CAT_DESC_LOC']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" value="<? echo $row['SUB_CONTENT_CAT_DESC_ENG']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							
							<div>
                    <div class="floatL form_name">&nbsp;&nbsp;</div>
                    <div class="floatL form_input">
					<?php 
					/*if ($row['IS_LAST_NODE'] == "Y")
                      echo "<input  id = 'chkHasSubCategory' type='checkbox' name='chkHasSubCategory' >&nbsp;มีระบบย่อย</input> ";
					else 
						echo "<input  id = 'chkHasSubCategory' type='checkbox' name='chkHasSubCategory' checked >&nbsp;มีระบบย่อย</input> "; */
                          ?>
                    </div>
                    <div class="clear"></div>
                  </div>
				   </div>
								
							<?}?>

							<div class="btn_action">
								
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'main_sub_category_view.php?MID=<?=$MID?>&cid=<?=$CID?>' ">
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
