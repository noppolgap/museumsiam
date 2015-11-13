<?php
if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
} else {
	$picFolder = 'en';
}

if (!isset($_GET['MID']))
	$MID = $museum_data_network_module_id;
else
	$MID = $_GET['MID'];

if (!isset($_GET['CID'])) {
	$CID = $regionCategory;
} else {
	$CID = $_GET['CID'];
}
?>
<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="mdn.php"><img src="images/<?=$picFolder ?>/title-mdn.png"/></a>
	</div>
</div>

<form name="search_form" method="post" action="system-search.php?MID=<?=$museum_data_network_module_id?>">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="txt_search_form" value="<?=$_POST['txt_search_form'] ?>" placeholder="<?=$searchCap?>">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1">
				<a href="mdn.php"><?=$mainPageCap?></a>
			</li>
			<li class="menu2 sub">
				<a href="mdn-news-event.php"><?=$activityAndNewsCap?></a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="mdn-event.php"><?=$activityCa?></a>
					</li>
					<li class="submenu2">
						<a href="mdn-news.php"><?=$newsCap?></a>
					</li>
				</ul>
			</li>

			<?

			if ($_SESSION['LANG'] == 'TH') {
				$selectedColumn = " CONTENT_CAT_DESC_LOC as CONTENT_CAT_DESC , ";
				$subCatSelectedColumn = "SUB_CONTENT_CAT_DESC_LOC as SUB_CONTENT_CAT ";
			} else {
				$selectedColumn = " CONTENT_CAT_DESC_ENG as CONTENT_CAT_DESC , ";
				$subCatSelectedColumn = "SUB_CONTENT_CAT_DESC_ENG as SUB_CONTENT_CAT ";
			}
			$categorySql = "SELECT
CONTENT_CAT_ID, " . $selectedColumn . " IS_LAST_NODE
FROM
trn_content_category
WHERE
REF_MODULE_ID = " . $MID . " AND flag = 0
ORDER BY
ORDER_DATA DESC";
			$menuIdx = 3;

			$query = mysql_query($categorySql, $conn) or die($categorySql);
			while ($row = mysql_fetch_array($query)) {
				echo '<li class="menu' . $menuIdx . ' sub">';
				echo '<a href="mdn-category.php?MID=' . $MID . '&CID=' . $row['CONTENT_CAT_ID'] . '">' . $row['CONTENT_CAT_DESC'] . '</a>';

				echo '<ul class="submenu-left">';

				$subCatSql = "SELECT
					SUB_CONTENT_CAT_ID," . $subCatSelectedColumn . " FROM
					trn_content_sub_category
					WHERE
					CONTENT_CAT_ID = " . $row['CONTENT_CAT_ID'] . " AND flag = 0
					ORDER BY
					ORDER_DATA DESC";

				$querySubCat = mysql_query($subCatSql, $conn) or die($subCatSql);
				$subCatMenuIdx = 1;
				while ($rowSubCat = mysql_fetch_array($querySubCat)) {
					echo '<li class="submenu' . $subCatMenuIdx . '">';
					echo '<a href="mdn-category2.php?MID=' . $MID . '&CID=' . $row['CONTENT_CAT_ID'] . '&SCID=' . $rowSubCat['SUB_CONTENT_CAT_ID'] . '">' . $rowSubCat['SUB_CONTENT_CAT'] . '</a>';
					echo '</li>';
					$subCatMenuIdx++;
				}
				echo '</ul>';
				echo '</li>';
				$menuIdx++;
			}
			?>
			<!-- <li class="menu3 sub">
				<a href="mdn-category.php">ภูมิภาค</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="mdn-category.php">ภาคเหนือ</a>
					</li>
					<li class="submenu2">
						<a href="mdn-category.php">ภาคใต้</a>
					</li>
					<li class="submenu2">
						<a href="mdn-category.php">ภาคตะวันออกเฉียงเหนือ</a>
					</li>
				</ul>
			</li>
			<li class="menu4 sub">
				<a href="mdn-category.php">การบริหารจัดการพิพิธภัณฑ์</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="mdn-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="mdn-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li>
			<li class="menu5 sub">
				<a href="mdn-category-red.php">ประเภทพิพิธภัณฑ์</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="mdn-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="mdn-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li> -->
		</ul>
	</div>
</div>
