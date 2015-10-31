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
$secid = $_GET['secid'];
$sql = "SELECT
	DEPARTMENT_ID,
	DEPARTMENT_DESC_LOC,
	DEPARTMENT_DESC_ENG,
	REF_SECTION_ID ,
	CREATE_DATE , 
	LAST_UPDATE_DATE
FROM
	mas_department
WHERE
	ACTIVE_FLAG <> 2 ";
if (isset($_GET['search'])) {
	$sql .= "AND ( DEPARTMENT_DESC_LOC like '%" . $_POST['str_search'] . "%' or DEPARTMENT_DESC_ENG like '%" . $_POST['str_search'] . "%' )";
}
$sql .= " AND REF_SECTION_ID = " . $secid;
$sql .= " ORDER BY ORDER_DATA DESC";

//echo $sql ;
$query = mysql_query($sql, $conn);

$num_rows = mysql_num_rows($query);
		?>
	
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'department_add.php?secid=<?=$secid ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="department_action.php?delete" >
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('department_order.php?secid=<?=$secid ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'manage_people_section.php?secid=<?=$secid ?>'">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">ข้อมูลแผนก</div>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="" />
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
while ($row = mysql_fetch_array($query)) {
?>
					<div class="Main_Content" data-id="<?= $row['DEPARTMENT_ID'] ?>" >
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?= $row['DEPARTMENT_ID'] ?>"></div>
						 
						<div class="floatL nameContent">
							 
							<div><?
							echo '<a href="manage_people_department.php?secid=' . $row['REF_SECTION_ID'] . '&did=' . $row['DEPARTMENT_ID'] . '">' . $row['DEPARTMENT_DESC_LOC'] . '</a>';
						?></div>
							<div>วันที่สร้าง <?
							echo ConvertDate($row['CREATE_DATE']);
						?> | วันที่ปรับปรุง <?
						echo ConvertDate($row['LAST_UPDATE_DATE']);
					?></div>
						</div>
						<div class="floatL stausContent">

					</div>
						<div class="floatL EditContent">
							<a href="department_edit.php?secid=<?= $row['REF_SECTION_ID'] ?>&did=<?=$row['DEPARTMENT_ID'] ?>" class="EditContentBtn">Edit</a>
							<a href="#" data-id=<?= $row['DEPARTMENT_ID'] ?> class="DeleteContentBtn">Delete</a>
						</div>
						<div class="clear"></div>
				</div>
							<?php
							}
						?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">จำนวนทั้งหมด  <span class='RowCount'><?
					echo $num_rows;
				?></span>  รายการ</div>
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
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'department_add.php?secid=<?=$secid ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="department_action.php?delete" >
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('department_order.php?secid=<?=$secid ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'manage_people_section.php?secid=<?=$secid ?>'">
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
<?
logs_access('admin', 'hello');
?>
</body>
</html>
