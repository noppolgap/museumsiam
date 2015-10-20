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

				<?
				$currentPage = 1;
				if (isset($_GET['PG']))
					$currentPage = intval($_GET['PG']);

				if (isset($_GET['PC']))
					$currentPage = intval($_POST['pagination']);

				if ($currentPage < 1)
					$currentPage = 1;

				//active_flag 0 = disable , 1 = Enable ,  2 = Delete
				$sql = "SELECT * FROM sys_app_sub_module where ACTIVE_FLAG <> 2  ";

				if (isset($_GET['search'])) {
					if (isset($_POST['str_search']))
						$_SESSION['SUBM_SEARCH'] = $_POST['str_search'];

					$sql .= " AND (SUB_MODULE_NAME_LOC like '%" . $_SESSION['SUBM_SEARCH'] . "%' or SUB_MODULE_NAME_ENG like '%" . $_SESSION['SUBM_SEARCH'] . "%' ) ";
					//	$sql .= " order by SUB_MODULE_ID asc ";

				}
				$sql .= " order by ORDER_DATA DESC ";
				$sql .= " Limit 10 offset  " . (10 * ($currentPage - 1));

				$rs = mysql_query($sql) or die(mysql_error());

				$i = 0;
				?>
				<div class="mod-body">
					<div class="buttonActionBox">
						<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'addSubModule.php'">
						<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="delSubModule.php">
						<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('order.php');">
					</div>
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								ชื่อระบบย่อย
							</div>
							<div class="floatR searchBox">
								<form name="search" action="?search" method="post">
									<input type="search" name="str_search" value="<?=$_SESSION['SUBM_SEARCH'] ?>" />
									<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
								</form>
							</div>
							<div class="clear"></div>
						</div>
						<div class="mod-body-inner-action">
							<div class="floatL checkAllBox">
								<label>
									<input type="checkbox" name="checkall" value="0">
									เลือกทั้งหมด</label>
							</div>
							<div class="floatR orderBox">

							</div>
							<div class="clear"></div>
						</div>

						<div class="mod-body-main-content">
							<!-- start loop -->
							<?php

							while ($row = mysql_fetch_array($rs)) {

								echo "<div class='Main_Content' data-id='" . $row['SUB_MODULE_ID'] . "'>";
								echo "<div class='floatL checkboxContent'><input type='checkbox' name='check' value='" . $row["SUB_MODULE_ID"] . "'></div>";
								echo "<div class='floatL thumbContent'>";
								echo "<a href='viewSubModule.php?SMID=" . $row["SUB_MODULE_ID"] . "' class='dBlock' " . callIconThumbList('BIG', NULL, $row["SUB_MODULE_ID"], true) . "></a>";
								echo "</div>";
								echo "<div class='floatL nameContent'>";
								echo "<div><a href='viewSubModule.php?SMID=" . $row["SUB_MODULE_ID"] . "'>" . $row["SUB_MODULE_NAME_LOC"] . "</a></div>";

								echo "<div>วันที่สร้าง " . $row["CREATE_DATE"] . " | วันที่ปรับปรุง " . $row["LAST_UPDATE_DATE"] . " </div>";
								echo "</div>	";

								echo "<div class='floatL EditContent'>";

								echo "<a href='editSubModule.php?SMID=" . $row["SUB_MODULE_ID"] . "' class='EditContentBtn'>Edit</a>";
								echo "<a href='#' class='DeleteContentBtn' data-id='" . $row['SUB_MODULE_ID'] . "'>Delete</a>";
								echo "</div>";
								echo " <div class='clear'></div>	";
								echo " </div>";
								$i++;
							}mysql_free_result($rs);
							?>

							<!-- end loop -->
						</div>
						<div class="pagination_box">
							<div class="floatL">
							<?php

							$countContentSql = "SELECT count(1) as ROW_COUNT FROM sys_app_sub_module where ACTIVE_FLAG <> 2 ";
							if (isset($_GET['search'])) {
								$countContentSql .= " AND (SUB_MODULE_NAME_LOC like '%" . $_SESSION['SUBM_SEARCH'] . "%' or SUB_MODULE_NAME_ENG like '%" . $_SESSION['SUBM_SEARCH'] . "%' ) ";
							}

							$countContentSql .= " order by ORDER_DATA DESC ";

							$queryCount = mysql_query($countContentSql, $conn);

							$dataCount = mysql_fetch_assoc($queryCount);

							$contentCount = $dataCount['ROW_COUNT'];

							$maxPage = ceil($contentCount / 10);

							if ($maxPage == 0)
								$pagingStyle = 'style = "display:none"';
							?>
								จำนวนทั้งหมด <span class='RowCount'> <?echo $contentCount; ?></span> รายการ
							</div>
							 <form id = "frmPagination" action='?PC' method="post" >
							<div class="floatR pagination_action" <?=$pagingStyle ?>>
								<?php

								$extraClass = '';
								if ($currentPage == 1) {
									$extraClass = ' style="display:none;"';
								}

								echo '<a href="?PG=1' . $currentParam . '" ' . $extraClass . '><img src="../images/skip-previous.svg" alt="first" /></a> ';
								echo '<a href="?PG=' . ($currentPage - 1) . $currentParam . '" ' . $extraClass . '><img src="../images/fast-rewind.svg" alt="previous" /></a>';
								if ($maxPage == 1)
									$hideCombo = ' style = "display:none;" ';
								echo '<select name="pagination" class="p-Relative" onchange="this.form.submit();" ' . $hideCombo . ' >';
								for ($idx = 1; $idx <= $maxPage; $idx++) {
									if ($idx == $currentPage)
										echo '<option value="' . $idx . '" selected>' . $idx . '</option>';
									else
										echo '<option value="' . $idx . '">' . $idx . '</option>';
								}
								echo '</select>';

								$extraClassAtEnd = '';
								if (($currentPage + 1) >= $maxPage) {
									$extraClassAtEnd = ' style="display:none;"';
								}

								echo '<a href="?PG=' . ($currentPage + 1) . $currentParam . '" ' . $extraClassAtEnd . '><img src="../images/fast-forward.svg" alt="next" /></a>';
								echo '<a href="?PG=' . $maxPage . $currentParam . '" ' . $extraClassAtEnd . '><img src="../images/skip-next.svg" alt="last" /></a>';
							?>
							</div>
							</form>
							<div class="floatR"<?=$pagingStyle ?>>หน้า <?=$currentPage ?> จาก <?=$maxPage ?>
							</div>
							<div class="clear"></div>
						</div>

					</div>
					<div class="buttonActionBox">
						<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'addSubModule.php'">
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
