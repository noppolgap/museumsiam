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
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">

				<?php

					$id = $_GET['p'];
					$subId = $_GET['g'];

				    $sql= "SELECT * FROM  trn_digital_ach WHERE Flag <> 2 AND DIGITAL_ID = $id AND SUB_DIGITAL_ID = $subId ";

				    $query = mysql_query($sql,$conn);

				 ?>


				<?php while($row = mysql_fetch_array($query)) { ?>

						<form action="?" method="post" name="formcms">
							<div>
								<div class="floatL form_name">ชื่อ</div>
								<div class="floatL form_input"><? echo $row['DIGITAL_DESC_LOC']; ?> </div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input">
								<? echo $row['DETAIL']; ?>
								</div>
								<div class="clear"></div>
							</div>
							<div class="btn_action">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href
								 = 'digital_view.php?p=<?=$_GET['g']?>'">
							</div>
						</form>


			<? } ?>
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
