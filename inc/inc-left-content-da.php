<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="da.php"><img src="images/th/title-da.png"/></a>
	</div>
</div>
<?

	$CID_S = "";
	$CID = $_GET['CID'];
	$MID = $_GET['MID'];
    $SCID = $_GET['SCID'];

	if($CID != ""){
		$CID_S = "&CID=$CID";
	}
	if($MID != ""){
		$CID_S .="&MID=$MID";
	}
	if($SCID != ""){
		$CID_S .="&SCID=$SCID";
	}
 ?>

<form name="search" action="?search<?=$CID_S?>" method="post">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="str_search" value="<?=$_SESSION['text'] ?>"  placeholder="ค้นหา">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<?php
			$currentPageName = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
			if ($currentPageName == "da.php")
				echo '<li class="menu1 active"><a href="da.php">'.$mainPageCap.'</a></li>';
			else
				echo '<li class="menu1"><a href="da.php">'.$mainPageCap.'</a></li>';

			$sqlMaxOrder = "select max(ORDER_DATA) as MAX_ORDER from trn_content_category
							WHERE
								REF_MODULE_ID = " . $digial_module_id;
			$sqlMaxOrder .= " AND flag = 0 ";
			//echo $sqlMaxOrder ;
			$maxOrderRS = mysql_query($sqlMaxOrder) or die(mysql_error());
			$maxOrder = 0;
			while ($maxOrderRow = mysql_fetch_array($maxOrderRS)) {
				$maxOrder = $maxOrderRow['MAX_ORDER'];
			}

			$sqlCategory = "SELECT
								CONTENT_CAT_ID,
								CONTENT_CAT_DESC_LOC,
								CONTENT_CAT_DESC_ENG,
								IS_LAST_NODE , 
								LINK_URL , 
								ORDER_DATA
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = " . $digial_module_id;
			$sqlCategory .= " AND flag = 0 
							ORDER BY
								ORDER_DATA desc ";

			//firstLoop is Category
			$categoryRS = mysql_query($sqlCategory) or die(mysql_error());
			$mainMenuCount = 2;

			if ($_SESSION['LANG'] == 'TH') {
				$selectedCatColumn = 'CONTENT_CAT_DESC_LOC';
				$selectedSubCatColumn = 'SUB_CONTENT_CAT_DESC_LOC';
			} else {
				$selectedCatColumn = 'CONTENT_CAT_DESC_ENG';
				$selectedSubCatColumn = 'SUB_CONTENT_CAT_DESC_LOC';
			}
			while ($categoryRow = mysql_fetch_array($categoryRS)) {

				$pageColorTheme = '';

				$isSubCat = '';
				if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'N') {
					$isSubCat = ' sub';
					if ($categoryRow['ORDER_DATA'] == $maxOrder) {
						$catNextPage = 'da-category-black.php';
						$pageColorTheme = 'black';
					} else if ($categoryRow['ORDER_DATA'] == ($maxOrder - 3)) {
						$catNextPage = 'da-category-red.php';
						$pageColorTheme = 'red';
					} else {
						$catNextPage = 'da-category-gray.php';
						$pageColorTheme = 'gray';
					}
				} else {
					if ($categoryRow['ORDER_DATA'] == $maxOrder) {
						$catNextPage = 'da-all-black.php';
						$pageColorTheme = 'black';
					} else if ($categoryRow['ORDER_DATA'] == ($maxOrder - 3)) {
						$catNextPage = 'da-all-red.php';
						$pageColorTheme = 'red';
					} else {
						$catNextPage = 'da-all-gray.php';
						$pageColorTheme = 'gray';
					}
				}

				$activeClass = '';
				if ($CID == $categoryRow['CONTENT_CAT_ID'])//&& !isset($_GET['SCID']))
					$activeClass = ' active';

				echo '<li class="menu' . $mainMenuCount . $isSubCat . $activeClass . '">';

				if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'Y') {
					echo ' <a href="' . $catNextPage . '?MID=' . $digial_module_id . '&CID=' . $categoryRow['CONTENT_CAT_ID'] . '">' . $categoryRow[$selectedCatColumn] . '</a> ';
				} else {

					//has subCat render list
					echo ' <a href="' . $catNextPage . '?MID=' . $digial_module_id . '&CID=' . $categoryRow['CONTENT_CAT_ID'] . '">' . $categoryRow[$selectedCatColumn] . '</a> ';

					$sqlSubCategory = "SELECT
														SUB_CONTENT_CAT_ID,
														SUB_CONTENT_CAT_DESC_LOC,
														SUB_CONTENT_CAT_DESC_ENG,
														REF_SUB_CONTENT_CAT_ID,
														IS_LAST_NODE
													FROM
														trn_content_sub_category
													WHERE
														CONTENT_CAT_ID = " . $categoryRow['CONTENT_CAT_ID'];
					//if (isset($_GET['SCID']))
					//$sqlSubCategory .= " AND REF_SUB_CONTENT_CAT_ID = " . $_GET['SCID'];
					$sqlSubCategory .= " AND flag <> 2
													ORDER BY
														ORDER_DATA desc";

					$subCategoryRS = mysql_query($sqlSubCategory) or die(mysql_error());
					$subMenuCount = 1;

					$displayStyle = '';
					if ($CID == $categoryRow['CONTENT_CAT_ID'])
						$displayStyle = 'style="display:block"';

					echo '<ul class="submenu-left "' . $displayStyle . '>';
					while ($subCategoryRow = mysql_fetch_array($subCategoryRS)) {
						$prePage = '';

						if (nvl($subCategoryRow['IS_LAST_NODE'], 'Y') == 'N')
							$prePage = 'da-category-';
						else
							$prePage = 'da-all-';
						$subActive = '';
						if (isset($_GET['SCID'])) {
							if ($_GET['SCID'] == $subCategoryRow['SUB_CONTENT_CAT_ID']) {
								$subActive = ' active';
							}
						}

						echo '<li class="submenu' . $subMenuCount++ . $subActive . '"><a href="' . $prePage . $pageColorTheme . '.php?MID=' . $digial_module_id . '&CID=' . $categoryRow['CONTENT_CAT_ID'] . '&SCID=' . $subCategoryRow['SUB_CONTENT_CAT_ID'] . '">' . $subCategoryRow[$selectedSubCatColumn] . '</a></li>';
					}

					// <li class="submenu2"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
					echo '</ul>';
				}

				echo '</li>';
				$mainMenuCount++;
			}

			function getSubCategory() {

			}
			?>

			<!-- <li class="menu2 sub"><a href="da-category.php">โบราณวัตถุ</a>
			<ul class="submenu-left">
			<li class="submenu1"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
			<li class="submenu2"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
			</ul>
			</li>
			<li class="menu3 sub"><a href="da-category.php">คลังภาพเก่า</a>
			<ul class="submenu-left">
			<li class="submenu1"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
			<li class="submenu2"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
			</ul>
			</li>
			<li class="menu4 sub"><a href="da-category.php">จดหมายเหตุ</a>
			<ul class="submenu-left">
			<li class="submenu1"><a href="da-category.php">หมวดหมู่ย่อย</a></li>
			<li class="submenu2">
			<a href="da-category.php">หมวดหมู่ย่อย</a>
			</li>
			</ul>
			</li>
			<li class="menu5 sub">
			<a href="da-category-red.php">มัลติมีเดีย</a>
			<ul class="submenu-left">
			<li class="submenu1">
			<a href="da-category-red.php">หมวดหมู่ย่อย</a>
			</li>
			<li class="submenu2">
			<a href="da-category-red.php">หมวดหมู่ย่อย</a>
			</li>
			</ul>
			</li>
			<li class="menu6">
			<a href="da-all.php">บทความ</a>
			</li>
			<li class="menu7">
			<a href="da-all.php">MUSE MAG</a>
			</li> -->
		</ul>
	</div>
</div>
