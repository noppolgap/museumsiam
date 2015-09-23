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
		$CID = $_GET['cid'];

		$LV = $_GET['LV'];
		$SCID = $_GET['SCID'];
		$subfixAddAndEdit = '&LV=' . $LV;
		//$sql = "SELECT * FROM sys_app_module where MODULE_ID = '".$MID."' ";
		if (isset($SCID) && nvl($SCID, '') != '') {
			$sql = "	SELECT SUB_CONTENT_CAT_ID
					,CONTENT_CAT_ID
					,SUB_CONTENT_CAT_DESC_LOC AS CONTENT_CAT_DESC_LOC
					,SUB_CONTENT_CAT_DESC_ENG AS CONTENT_CAT_DESC_ENG
					,REF_SUB_CONTENT_CAT_ID
					,ifnull(IS_LAST_NODE, 'Y') AS IS_LAST_NODE
				FROM trn_content_sub_category
				WHERE flag <> 2
					AND sub_content_cat_id = " . $SCID . " ORDER BY order_data DESC ";
			$subfixAddAndEdit .= '&SCID=' . $SCID;
		} else {
			$sql = "SELECT * FROM trn_content_category where CONTENT_CAT_ID = '" . $CID . "' ";
		}

		$backPage = 'main_sub_category_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV  ;

		if (nvl($SCID, '0') != '0')
			$backPage .= '&SCID=' . $SCID;

		//$sql = "SELECT * FROM sys_app_module where MODULE_ID = '".$MID."' ";
		//	$sql = "SELECT * FROM trn_content_category where CONTENT_CAT_ID = '" . $CID . "' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($rs);
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มหมวดหมู่ย่อย ภายใต้ <?=$row['CONTENT_CAT_DESC_LOC']; ?></div>					
				</div>
				<div class="mod-body-main-content">
					
					<div class="formCms">
						<form action="sub_category_action.php?add&MID=<?=$MID ?>&cid=<?=$CID . $subfixAddAndEdit ?>" method="post" name="formcms">
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

 <div>
                    <div class="floatL form_name">&nbsp;&nbsp;</div>
                    <div class="floatL form_input">
                    <!--  <input  id = "chkHasSubCategory" type="checkbox" name="chkHasSubCategory" >&nbsp;มีหมวดหมู่ย่อย</input>-->
                          
                    </div>
                    <div class="clear"></div>
                  </div>
				   </div>
				   
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?=$backPage?>'">
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
