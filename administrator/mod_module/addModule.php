<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
$indexPage = "/administrator/mod_module/index.php";
?>
<!doctype html>
<html>
  <head>
    <?
	require ('../inc_meta.php');
 ?>


    <script type="text/javascript">
		$(document).ready(function() {

		});

		function onValidate() {
			var ret = true;
			$('#nameLocError').hide();
			$('#nameEngError').hide();

			if ($('#txtNameLoc').val() == '') {
				$('#nameLocError').show();
				ret = false;
			}
			if ($('#txtNameEng').val() == '') {
				$('#nameEngError').show();
				ret = false;
			}

			if (ret) {
				document.getElementById("frmcms").submit();
			}
		}

    </script>

    <style  >
		.error, .error span {
			color: red;
		}
    </style>
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
          <div class="mod-body-inner">
            <div class="mod-body-inner-header">
              <div class="floatL titleBox">เพิ่มระบบ</div>
            </div>
            <div class="mod-body-main-content">
              <div class="formCms">
                <form action="?" method="post" name="formcms" id = "frmcms" >
				 <div >
                  <div class="floatL form_name">ชื่อภาษาไทย</div>
                    <div class="floatL form_input">
                      <input id = "txtNameLoc" type="text" name="txtNameLoc"   class="w90p"  value="<?php echo $rowModule["MODULE_NAME_LOC"] ?>" />
      <span class="error" >* <span id = "nameLocError" style="display:none">กรุณาระบุชื่อภาษาไทย </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">ชื่อภาษาอังกฤษ</div>
                    <div class="floatL form_input">
                      <input  id = "txtNameEng" type="text" name="txtNameEng" value="" class="w90p" />
                          <span class="error" >* <span id = "nameEngError" style="display:none">กรุณาระบุชื่อภาษาอังกฤษ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>

				   <div>
                    <div class="floatL form_name">URL</div>
                    <div class="floatL form_input">
                      <input  id = "txtUrlLink" type="text" name="txtUrlLink" value="" class="w90p" />
                          <span class="error" >* <span id = "urlError" style="display:none">กรุณาระบุ URL</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>

				 <div>
										<div class="floatL form_name">รูปภาพ Iconขนาดใหญ่ (ขนาด 209 x 218)</div>
										<div class="floatL form_input"><?=admin_upload_image('BigIcon') ?></div>
										<div class="clear"></div>
									</div>

									<!-- <div >
										<div class="floatL form_name">รูปภาพ Iconขนาดเล็ก</div>
										<div class="floatL form_input"><?=admin_upload_image('SmallIcon') ?></div>
										<div class="clear"></div>
									</div> -->


				    <div>
                    <div class="floatL form_name">&nbsp;&nbsp;</div>
                    <div class="floatL form_input">
                      <input  id = "chkHasSubModule" type="checkbox" name="chkHasSubModule" >&nbsp;มีระบบย่อย</input>

                    </div>
                    <div class="clear"></div>
                  </div>
                  
                    <div>
                    <div class="floatL form_name">&nbsp;&nbsp;</div>
                    <div class="floatL form_input">
                      <input  id = "chkShowOnMenu" type="checkbox" name="chkShowOnMenu" >&nbsp;แสดงเมนูที่หน้าหลัก</input>

                    </div>
                    <div class="clear"></div>
                  </div>
                  
				   </div>

                  <div class="btn_action">
                    <input type="button" name="save" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="onValidate()" >
                      <input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
                        <input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
							</div>
              <input type="hidden" name="action" value="submit" />
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

      <script type="text/javascript" src="../master/script.js"></script>

	  <script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>

<?php

if (isset($_POST["action"]) && $_POST["action"] == "submit") {

	$txtNameLoc = $_POST['txtNameLoc'];
	$txtNameEng = $_POST['txtNameEng'];

	$txtUrlLink = $_POST['txtUrlLink'];
	$txtImg = $_POST['txtImg'];
	$chkHasSubModule = $_POST['chkHasSubModule'];

	$isLastNode = "";
	if ($chkHasSubModule)
		$isLastNode = "N";
	else
		$isLastNode = "Y";

	if ($_POST['chkShowOnMenu'])
		$showOnMenu = "Y";
	else
		$showOnMenu = "N";

	$bigIconName = "";
	$smallIconName = "";

	if (count($_POST['BigIcon_file']) > 0) {
		foreach ($_POST['BigIcon_file'] as $k => $file) {
			$bigIconName = admin_move_image_upload_dir('icon_files', end(explode('/', $file)), 1000, '', false, 150, 150);
		}
	}
	if (count($_POST['SmallIcon_file']) > 0) {
		foreach ($_POST['SmallIcon_file'] as $k => $file) {
			$smallIconName = admin_move_image_upload_dir('icon_files', end(explode('/', $file)), 1000, '', false, 150, 150);
		}
	}

	mysql_query("BEGIN");

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM sys_app_module where ACTIVE_FLAG <> 2 AND IS_FOR_OTHER_LINK = 'N' ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	$strSQL = "INSERT INTO sys_app_module ";
	$strSQL .= "(MODULE_NAME_LOC,MODULE_NAME_ENG , USER_CREATE , CREATE_DATE , LAST_FUNCTION , IS_LAST_NODE , ORDER_DATA , RENDER_ON_FRONT , IS_FOR_OTHER_LINK  , LINK_URL) ";
	$strSQL .= "VALUES ";
	$strSQL .= "('" . $txtNameLoc . "','" . $txtNameEng . "','Test' , now() , 'A' , '" . $isLastNode . "' , " . $max . " , '".$showOnMenu."' ,'N' , '".$txtUrlLink."') ";
	$objQueryAppModule = mysql_query($strSQL);
	$last_id = mysql_insert_id($conn);

	$strSQL = "INSERT INTO trn_banner_pic_setting ";
	$strSQL .= "(APP_MODULE_ID , DESKTOP_ICON_PATH , MOBILE_ICON_PATH ,ICON_LINK ,USER_CREATE , CREATE_DATE , LAST_FUNCTION) ";
	$strSQL .= " values ";
	$strSQL .= "('" . $last_id . "','" . $bigIconName . "','" . $smallIconName . "','" . $txtUrlLink . "' , 'Test' , now() , 'A')";
	$objQueryBannerSetting = mysql_query($strSQL);
	if (($objQueryAppModule) and ($objQueryBannerSetting)) {
		mysql_query("COMMIT");
		echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . $indexPage . "';</script>";

	} else {
		mysql_query("ROLLBACK");
		echo "Error Save [" . $strSQL . "]";
	}
	logs_access($_SESSION['user_name'], 'Add Module');
}
?>
  </body>
</html>
