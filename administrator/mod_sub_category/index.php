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
		<div class="mod-body">
			<div class="buttonActionBox">
				 
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">กรุณาเลือกหมวดหมู่</div>
					<div class="floatR searchBox">
						<form name="search" action="?" method="post">
							<input type="search" name="str_search" value="" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>						
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"> </div>
					<div class="floatR orderBox">
						 
					</div>
					<div class="clear"></div>	
				</div>
				
				<div class="mod-body-main-content">
				
						<!-- start loop -->
						<?php
							//active_flag 0 = disable , 1 = Enable ,  2 = Delete
							$sql = "SELECT am.MODULE_ID  , am.MODULE_NAME_LOC ,  cc.* FROM sys_app_module am left join trn_content_category cc on cc.REF_MODULE_ID = am.MODULE_ID  where am.ACTIVE_FLAG <> 2 AND am.IS_FOR_OTHER_LINK = 'N' and cc.FLAG <>2 and cc.IS_LAST_NODE = 'N' ";
							if (isset($_POST['search'])) {
								$sql .= " AND (cc.CONTENT_CAT_DESC_LOC like '%" . $_POST['str_search'] . "%' or cc.CONTENT_CAT_DESC_ENG like '%" . $_POST['str_search'] . "%' ";
								$sql .= " order by cc.CONTENT_CAT_ID asc ";

							}
							$rs = mysql_query($sql) or die(mysql_error());

							$i = 0;

							while ($row = mysql_fetch_array($rs)) {

								echo "<div class='Main_Content' data-id='" . $row['CONTENT_CAT_ID'] . "'>";
								echo "<div class='floatL checkboxContent'></div>";
								echo "<div class='floatL thumbContent'>";
								echo "<a href='main_sub_category_view.php?MID=" . $row["MODULE_ID"] . "&cid=" . $row["CONTENT_CAT_ID"] . "' class='dBlock' style='background-image: url('http://cache.my.kapook.com/imgkapook_2014/31_35_1438829370.jpg')';></a>";
								echo "</div>";
								echo "<div class='floatL nameContent'>";
								echo "<div><a href='main_sub_category_view.php?MID=" . $row["MODULE_ID"] . "&cid=" . $row["CONTENT_CAT_ID"] . "'>" . $row["CONTENT_CAT_DESC_LOC"] . "</a></div>";
								echo "<div>วันที่สร้าง " . $row["CREATE_DATE"] . " | วันที่ปรับปรุง " . $row["LAST_UPDATE_DATE"] . " </div>";
								echo "</div>	";

								echo "<div class='floatL EditContent'>";

								echo "";
								echo "";
								echo "</div>";
								echo " <div class='clear'></div>	";
								echo " </div>";
								$i++;
							}mysql_free_result($rs);
						?>
						 
						<!-- end loop -->
					</div>
					<div class="pagination_box">
						<div class="floatL">จำนวนทั้งหมด <span class='RowCount'><?=$i ?></span> รายการ</div>
						<div class="floatR pagination_action">
							<a href="#"><img src="../images/skip-previous.svg" alt="first" /></a>
							<a href="#"><img src="../images/fast-rewind.svg" alt="previous" /></a>
							<select name="pagination" class="p-Relative">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>	
							<a href="#"><img src="../images/fast-forward.svg" alt="next" /></a>
							<a href="#"><img src="../images/skip-next.svg" alt="last" /></a>
						</div>
						<div class="floatR">หน้า 1 จาก 10</div>
						<div class="clear"></div>	
					</div>
				
				 
				 
			</div>	
			<div class="buttonActionBox">
				 
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<?
	require ('../inc_footer.php');
 ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />

<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>		
	
<? logs_access('admin', 'hello'); ?>	

<script type="text/javascript" src="../../assets/plugin/jquery.min.js"></script>
<script type="text/javascript" >
	/*
	 $(document).ready(function(){
	 $('.DeleteContentBtn').bind('click' , function(){
	 return confirm('คุณต้องการลบข้อมูลหรือไม่ ?');
	 });

	 });
	 */
</script>

</body>
</html>
<? CloseDB(); ?>	
