<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
require ("../../inc/inc-cat-id-conf.php");

$search_sql = "";
unset($_SESSION['text']);

if (isset($_GET['search'])) {
	if (isset($_POST['str_search'])) {
		$_SESSION['text'] = $_POST['str_search'];
		$search_sql = " AND (MUSEUM_NAME_LOC like '%" . $_POST['str_search'] . "%' or MUSEUM_NAME_ENG like '%" . $_POST['str_search'] . "%') ";
	}
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
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">พิพิธภัณฑ์เครือข่าย</div>
					<div class="floatR searchBox">
						 

						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="<?=$_SESSION['text'] ?>" />
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

		    <?php

			$sql = "SELECT
	*
FROM
	trn_museum_detail
WHERE
	MUSEUM_DETAIL_ID <> - 1
AND MUSEUM_DETAIL_ID NOT IN (
	SELECT
		MUSEUM_DETAIL_ID
	FROM
		mapping_museum_admin
)
AND IS_GIS_MUSEUM = 'N'
AND ACTIVE_FLAG = 1";

			$sql .= $search_sql . " ORDER BY MUSEUM_DETAIL_ID ASC ";

			$query = mysql_query($sql, $conn);

			$num_rows = mysql_num_rows($query);
			 ?>
					<!-- start loop -->
				<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content" data-id="<?=$row['MUSEUM_DETAIL_ID'] ?>" >
						<div class="floatL checkboxContent"> </div>
						 
						<div class="floatL nameContent"> 
							
							
						 <?
						$nextPage = 'mapping_admin_museum.php?MID=' . $row['MUSEUM_DETAIL_ID'];
								 ?>
							
							<div ><? echo '<a href="'.$nextPage.'">'. $row['MUSEUM_NAME_LOC'].'</a>' ?></div>
							
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>	
						<div class="floatL stausContent">
						
						 </div>
						<div class="floatL EditContent">
							 
						</div>
						<div class="clear"></div>	
				</div>
							<?php } ?>
					<!-- end loop -->
				</div>
				<!-- <div class="pagination_box" style="display: none">
					<div class="floatL">จำนวนทั้งหมด  <span class='RowCount'><? echo $num_rows; ?></span>  รายการ</div>
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
				</div> -->
			</div>	
			<div class="buttonActionBox">
				<!-- <input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'add_museum.php'"> -->
			
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
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
