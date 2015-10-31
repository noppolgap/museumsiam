<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$secid = $_GET['secid'];
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

		$navigateBackPage = 'main_section_view.php';
		$link = "section_people_add.php?secid=" . $secid;
		?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="เพิ่มบุคลากร" class="buttonAction emerald-flat-button" onclick="window.location.href = '<?=$link ?>'">
				<input type="button" value="จัดการแผนก" class="buttonAction emerald-flat-button" onclick="window.location.href = 'main_department_view.php?secid=<?=$secid ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="section_people_action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('section_people_order.php?secid=<?=$secid ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?=$navigateBackPage ?>'">
			</div>
			<div class="mod-body-inner">
				<?php
				$sectionSql = "select * from mas_section where section_id = " . $secid;
				$query = mysql_query($sectionSql, $conn);

				$num_rows = mysql_num_rows($query);

				$row = mysql_fetch_array($query);
				$sectionName = $row['SECTION_DESC_LOC'];
			?>
			
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">การจัดการฝ่าย <?=$sectionName ?></div>
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

		    <?php

			$sql = " SELECT ORG_ID,
	NAME_LOC,
	NAME_ENG,
	PHONE,
	EMAIL,
	IMG_PATH
FROM
	mas_org
WHERE
	SECTION_ID = " . $secid;
			$sql .= " AND DEPARTMENT_ID = - 1
AND ACTIVE_FLAG <> 2
AND PARENT_ORG_ID <> 0 ";
			if (isset($_GET['search'])) {
				$sql .= " AND ( NAME_LOC like '%" . $_POST['str_search'] . "%' or NAME_ENG like '%" . $_POST['str_search'] . "%' )";
			}

			$sql .= " ORDER BY ORDER_DATA DESC ";

			$query = mysql_query($sql, $conn);

			$num_rows = 0;
			 ?>
					<!-- start loop -->
				<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content" data-id="<?=$row['ORG_ID'] ?>" >
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['ORG_ID'] ?>"></div>


						<div class="floatL thumbContent">
							<a href="section_people_detail.php?secid=<?=$secid ?>&orgid=<?=$row['ORG_ID'] ?>" class="dBlock" <?=callOrgPictureAdmin($row['IMG_PATH']) ?> ></a>
						</div>
						<div class="floatL nameContent">
							<div><? echo '<a href="section_people_detail.php?secid='.$secid.'&orgid='.$row['ORG_ID'].'">'. $row['NAME_LOC'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>
						<div class="floatL stausContent">

						</div>
						<div class="floatL EditContent">
							<a href="section_people_edit.php?secid=<?=$secid ?>&orgid=<?=$row['ORG_ID'] ?>" class="EditContentBtn">Edit</a>
							<a href="#" data-id="<?=$row['ORG_ID'] ?>" class="DeleteContentBtn">Delete</a>
						</div>
						<div class="clear"></div>
				</div>
					<?php $num_rows++;
					}
 ?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">จำนวนทั้งหมด <span class='RowCount'><? echo $num_rows; ?></span>  รายการ</div>
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
			<input type="button" value="เพิ่มบุคลากร" class="buttonAction emerald-flat-button" onclick="window.location.href = '<?=$link ?>'">
				<input type="button" value="จัดการแผนก" class="buttonAction emerald-flat-button" onclick="window.location.href = 'main_department_view.php?secid=<?=$secid ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="section_people_action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('section_people_order.php?secid=<?=$secid ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?=$navigateBackPage ?>'">
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