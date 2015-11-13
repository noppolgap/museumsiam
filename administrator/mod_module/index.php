<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {

		if (isset($_POST['str_search']))
			$_SESSION['text'] = $_POST['str_search'];

		    $search_sql .= " AND MODULE_NAME_LOC like '%" .$_SESSION['text']. "%' or MODULE_NAME_ENG like '%" .$_SESSION['text']. "%' ";
	}
	

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
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'addModule.php'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="delModule.php">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('order.php');">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">ชื่อระบบ</div>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="<?=$_SESSION['text'] ?>" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>						
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
					<div class="floatR orderBox">
						 
					</div>
					<div class="clear"></div>	
				</div>
				
				<div class="mod-body-main-content">
						<!-- start loop -->
						<?php
							//active_flag 0 = disable , 1 = Enable ,  2 = Delete
						    
							$sql = "SELECT * FROM sys_app_module where ACTIVE_FLAG <> 2 and IS_FOR_OTHER_LINK = 'N'";
						    $sql .= $search_sql." order by ORDER_DATA DESC ";
							$rs = mysql_query($sql) or die(mysql_error());

							$i = 0;
							while ($row = mysql_fetch_array($rs)) {

								echo "<div class='Main_Content' data-id='" . $row['MODULE_ID'] . "'>";
								echo "<div class='floatL checkboxContent'><input type='checkbox' name='check' value='" . $row["MODULE_ID"] . "'></div>";
								echo "<div class='floatL thumbContent'>";
								echo "<a href='viewModule.php?MID=" . $row["MODULE_ID"] . "' class='dBlock'  " .callIconThumbList('BIG' ,$row['MODULE_ID'] , NULL , true)." ></a>";
								echo "</div>";
								echo "<div class='floatL nameContent'>";
								echo "<div><a href='viewModule.php?MID=" . $row["MODULE_ID"] . "'>" . $row["MODULE_NAME_LOC"] . "</a></div>";

								echo "<div>วันที่สร้าง " . $row["CREATE_DATE"] . " | วันที่ปรับปรุง " . $row["LAST_UPDATE_DATE"] . " </div>";
								echo "</div>	";

								echo "<div class='floatL EditContent'>";

								echo "<a href='editModule.php?MID=" . $row["MODULE_ID"] . "' class='EditContentBtn'>Edit</a>";
								echo "<a href='#' data-id='" . $row['MODULE_ID'] . "' class='DeleteContentBtn' >Delete</a>";
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
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'addModule.php'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('order.php');">
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



</body>
</html>
<? CloseDB(); ?>	
