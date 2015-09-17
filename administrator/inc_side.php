<div class="floatL main-menu">
	<div class="menuhead">
		เมนูการใช้งาน
	</div>

	<?php
	/*
	 $sql = "SELECT aMod.MODULE_ID, aMod.MODULE_NAME_LOC, aMod.MODULE_NAME_ENG, banner.ICON_LINK ";
	 $sql .=" FROM sys_app_module AS aMod ";
	 $sql .= " LEFT JOIN trn_banner_pic_setting AS banner ON banner.APP_MODULE_ID = aMod.MODULE_ID ";
	 $sql .= " WHERE aMod.ACTIVE_FLAG <> 2 ORDER BY aMod.ORDER_DATA ASC, MODULE_ID ASC";
	 $rs = mysql_query($sql) or die(mysql_error());
	 $i = 0 ;
	 while($row = mysql_fetch_array($rs)){

	 echo "<a href='".nvl($row["ICON_LINK"] ,"#")."'><span class='menutab dBlock' style='background-image: url(\"../images/small-n-flat/house.svg\");'>".$row["MODULE_NAME_LOC"]."</span></a> ";

	 }mysql_free_result($rs);

	 */
	?>

	<a href="../mod_user/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">ระบบจัดการผู้ใช้งาน</span></a>
	<a href="../mod_module/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการระบบ</span></a>
	<a href="../mod_sub_module/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการระบบย่อย</span></a>
	<a href="../mod_category/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการหมวดหมู่</span></a>
	<a href="../mod_sub_category/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการหมวดหมู่ย่อย</span></a>
	<a href="../mod_content/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการเนื้อหา</span></a>
	<a href="../mod_faq/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการ FAQ</span></a>
	<a href="../mod_webboard/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการ WEBBOARD</span></a>
	<a href="../mod_order/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการสินค้า</span></a>
	
	<a href="../mod_network_museum/index.php"><span class="menutab dBlock" style="background-image: url('../images/small-n-flat/house.svg');">การจัดการพิพทธภัณฑ์เครือข่าย</span></a>


	<a href="#"><span class="menutab dBlock signoutTab">ออกจากระบบ</span></a>
</div>