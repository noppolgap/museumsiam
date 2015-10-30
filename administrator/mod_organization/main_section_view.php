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
		$MID = $_GET['MID'];
		$CID = $_GET['cid'];
		$LV = $_GET['LV'];
		$SCID = $_GET['SCID'];
		$subfixAddAndEdit = '&LV=' . $LV;
		//$sql = "SELECT * FROM sys_app_module where MODULE_ID = '".$MID."' ";
		if (isset($SCID) && nvl($SCID, '') != '') {
			$sql = "	SELECT SUB_CONTENT_CAT_ID
					,CONTENT_CAT_ID
					,SUB_CONTENT_CAT_DESC_LOC AS CONTENT_CAT_DESC_LOC
					,SUB_CONTENT_CAT_DESC_ENG AS CONTENT_CAT_DESC_ENG
					,REF_SUB_CONTENT_CAT_ID
					,ifnull(IS_LAST_NODE, 'Y') AS IS_LAST_NODE
				FROM trn_content_sub_category
				WHERE flag <> 2
					AND sub_content_cat_id = " . $SCID . " ORDER BY order_data DESC ";
			$subfixAddAndEdit .= '&SCID=' . $SCID;
		} else {
			$sql = "SELECT * FROM trn_content_category where CONTENT_CAT_ID = '" . $CID . "' ";
		}

		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($rs);

		$backPage = '';
		if ($LV == 0) {
			$backPage = 'main_category_view.php?MID=' . $MID;
		} else {
			$backPage = 'main_sub_category_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . ($LV - 1);

			if (nvl($row['REF_SUB_CONTENT_CAT_ID'], '0') != '0')
				$backPage .= '&SCID=' . $row['REF_SUB_CONTENT_CAT_ID'];
		}
	?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'sub_category_add.php?MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="sub_category_action.php?delete" >
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('sub_category_order.php?MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?= $backPage ?>'">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">หมวดหมู่ย่อย  ภายใต้<?= $row['CONTENT_CAT_DESC_LOC']; ?></div>
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

			$sql = "SELECT * FROM  trn_content_sub_category WHERE Flag <> 2 and CONTENT_CAT_ID  = '" . $CID . "' ";
			if (isset($_GET['search'])) {
				$sql .= "AND SUB_CONTENT_CAT_DESC_LOC like '%" . $_POST['str_search'] . "%' ";
			}

			if (isset($SCID) && nvl($SCID, '0') != '0') {
				$sql .= " AND REF_SUB_CONTENT_CAT_ID = " . $SCID;
			} else {
				$sql .= " AND REF_SUB_CONTENT_CAT_ID = 0 ";
			}
			$sql .= " ORDER BY ORDER_DATA DESC ";

			//echo $sql;
			$query = mysql_query($sql, $conn);

			$num_rows = mysql_num_rows($query);
		?>
					<!-- start loop -->
				<?php
while ($row = mysql_fetch_array($query)) {
?>
					<div class="Main_Content" data-id="<?= $row['SUB_CONTENT_CAT_ID'] ?>" >
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?= $row['SUB_CONTENT_CAT_ID'] ?>"></div>
						 
						<div class="floatL nameContent">
							<?
							$nextPage = '';
							if (nvl($row['IS_LAST_NODE'], 'Y') == 'Y') {
								//content no LV use current LV
								$nextPage = 'content_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV  . '&SCID=' . $row['SUB_CONTENT_CAT_ID'];
							} else {
								//recursive to self page
								$nextPage = 'main_sub_category_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . ($LV + 1) . '&SCID=' . $row['SUB_CONTENT_CAT_ID'];
							}
						?>
							<div><?
							//echo '<a href="sub_category_view.php?scid='.$row['SUB_CONTENT_CAT_ID'].'&MID='.$MID.'&cid='.$CID.'">'. $row['SUB_CONTENT_CAT_DESC_LOC'].'</a>'
							echo '<a href="' . $nextPage . '">' . $row['SUB_CONTENT_CAT_DESC_LOC'] . '</a>';
						?></div>
							<div>วันที่สร้าง <?
							echo ConvertDate($row['CREATE_DATE']);
						?> | วันที่ปรับปรุง <?
echo ConvertDate($row['LAST_UPDATE_DATE']);
?></div>
						</div>
						<div class="floatL stausContent">

						<?
    if ($row['FLAG'] == 0) {
?>
							<span class="staus1"></span> <a href="sub_category_action.php?enable&subcid=<?= $row['SUB_CONTENT_CAT_ID'] ?>&vis=<?= $row['FLAG'] ?>&MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>">
							Enable
						</a> <?
						} else {
					?>
							<span class="staus2"></span>
							<a href="sub_category_action.php?enable&subcid=<?= $row['SUB_CONTENT_CAT_ID'] ?>&vis=<?= $row['FLAG'] ?>&MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>"> Disable </a>
						<?
						}
					?></div>
						<div class="floatL EditContent">
							<a href="sub_category_edit.php?subcid=<?= $row['SUB_CONTENT_CAT_ID'] ?>&MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>" class="EditContentBtn">Edit</a>
							<a href="#" data-id=<?= $row['SUB_CONTENT_CAT_ID'] ?> class="DeleteContentBtn">Delete</a>
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
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'sub_category_add.php?MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="sub_category_action.php?delete" >
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('sub_category_order.php?MID=<?= $MID ?>&cid=<?= $CID . $subfixAddAndEdit ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?= $backPage ?>'">
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
