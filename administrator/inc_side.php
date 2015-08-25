<div class="floatL main-menu">
	<div class="menuhead">เมนูการใช้งาน</div>
	
	
	<?php
		$sql = "SELECT aMod.MODULE_ID, aMod.MODULE_NAME_LOC, aMod.MODULE_NAME_ENG, banner.ICON_LINK ";
		$sql .=" FROM sys_app_module AS aMod ";
		$sql .= " LEFT JOIN trn_banner_pic_setting AS banner ON banner.APP_MODULE_ID = aMod.MODULE_ID ";
		$sql .= " WHERE aMod.ACTIVE_FLAG <> 2 ORDER BY aMod.ORDER_DATA ASC, MODULE_ID ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		$i = 0 ; 
		while($row = mysql_fetch_array($rs)){
			
			echo "<a href='".nvl($row["ICON_LINK"] ,"#")."'><span class='menutab dBlock' style='background-image: url(\"../images/small-n-flat/house.svg\");'>".$row["MODULE_NAME_LOC"]."</span></a> ";
			
		}mysql_free_result($rs);

 
	?>
	
	<!--
	<a href="#"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">ระบบจัดการผู้ใช้งาน</span></a>
	<a href="#"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">ระบบจัดการองค์ความรู้</span></a>
	<a href="../mod_digital_achive/main_digital_view.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">คลังข้อมูลดิจิตอล</span></a>
	<a href="#"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">พิพิธภัณฑ์เครือข่าย</span></a>
	<a href="../mod_virtual_exhibition/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">พิพิธภัณฑ์เสมือน</span></a>
	<a href="#"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">แผนที่พิพิธภัณฑ์</span></a>
	<a href="../mod_shopping/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">ระบบ Online</span></a>
-->
	<a href="#"><span class="menutab dBlock signoutTab">ออกจากระบบ</span></a>
</div>