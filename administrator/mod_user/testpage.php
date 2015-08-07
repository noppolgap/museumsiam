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
		<?php require('../inc_side.php'); ?>
		<div class="mod-body">
				<div class="buttonActionBox">
					<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button">
					<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
					<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
				</div>
				<div class="mod-body-inner">
					<div class="mod-body-inner-header">
						<div class="floatL titleBox">ชื่อเมนู</div>
						<div class="floatR searchBox">
							<form name="search" action="?" method="post">
								<input type="search" name="str_search" value="" />
								<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
							</form>
						</div>
						<div class="clear"></div>						
					</div>
					<div class="mod-body-inner-action">
						<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
						<div class="floatR orderBox">
							<select onchange="console.log('action');" name="orderby" class="p-Relative">
						        <option value="order">เลือกการจัดเรียงลำดับ</option>
						        <option selected="selected" value="order">การจัดเรียงของระบบ</option>
						        <option value="subject">ชื่อ</option>
						        <option value="credate">วันที่สร้าง</option>
						        <option value="status">สถานะข้อมูล</option>
						    </select>
						</div>
						<div class="clear"></div>	
					</div>
		 <?php require('userMain.php'); ?>
		 <div class="buttonActionBox">
					<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button">
					<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
					<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
				</div>
			</div>
			</div>	
			<div class="clear"></div>

		
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="mod_cms.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>		
<script type="text/javascript" src="mod_cms.js"></script>	
<?php logs_access('admin','hello'); ?>	
</body>
</html>
