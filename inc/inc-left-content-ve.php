<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="ve.php"><img src="images/th/title-ve.png"/></a>
	</div>
</div>

<?
$MID = "";
if ((!isset($_GET['MID'])) OR ($_GET['MID'] == '')) {
	$MID = $visual_exhibition;
} else {
	$MID = $_GET['MID'];
}

$MID_S = "&MID=" . $MID;
 ?>

<!--<form name="search" action="?search<?=$MID_S ?>" method="post">-->
<form name="search_form" method="post" action="system-search.php?MID=<?=$visual_exhibition?>">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="txt_search_form" value="<?=$_POST['txt_search_form'] ?>"  placeholder="<?=$searchCap?>">
		</div>
	</div>
</form>



<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1"><a href="ve.php?MID=<?=$MID ?>"><?=$mainPageCap ?></a></li>
			<?
			if ($_SESSION['LANG'] == 'TH') {
				$selectedColumn = " CONTENT_CAT_DESC_LOC as CONTENT_DESC , ";
				$subSelectedColumn = " SUB_CONTENT_CAT_DESC_LOC as SUB_CONTENT_DESC , ";

			} else {
				$selectedColumn = " CONTENT_CAT_DESC_ENG as CONTENT_DESC , ";
				$subSelectedColumn = " SUB_CONTENT_CAT_DESC_ENG as SUB_CONTENT_DESC , ";
			}

			$sqlMenu = "select 
							CONTENT_CAT_ID , " . $selectedColumn . " IS_LAST_NODE,
							REF_MODULE_ID  as MODULE_ID , 
							LINK_URL 
						from trn_content_category
						where REF_MODULE_ID = " . $MID . " 
							and FLAG = 0 
						ORDER BY ORDER_DATA desc ";

			$rsMenu = mysql_query($sqlMenu) or die(mysql_error());

			while ($categoryRow = mysql_fetch_array($rsMenu)) {
				$mainMenuCount = 2;
				//start with 2

				$isSubCat = '';
				if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'N') {
					$isSubCat = ' sub';
				}

				$activeClass = '';
				//if ($CID == $categoryRow['CONTENT_CAT_ID'])
				//$activeClass = ' active';

				echo '<li class="menu' . $mainMenuCount . $isSubCat . $activeClass . '">';

				$link = "ve-category.php?c=" . $categoryRow['CONTENT_CAT_ID'];
				if (nvl($categoryRow['LINK_URL'], '') != '')
					$link = $categoryRow['LINK_URL'];

				if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'Y') {
					echo ' <a href="' . $link . '">' . $categoryRow['CONTENT_DESC'] . '</a> ';
				} else {
					echo ' <a href="' . $link . '">' . $categoryRow['CONTENT_DESC'] . '</a> ';

					$sqlSubCategory = "SELECT
														SUB_CONTENT_CAT_ID," . $subSelectedColumn . "
														REF_SUB_CONTENT_CAT_ID,
														IS_LAST_NODE , 
														LINK_URL
													FROM
														trn_content_sub_category
													WHERE
														CONTENT_CAT_ID = " . $categoryRow['CONTENT_CAT_ID'];
					$sqlSubCategory .= " AND flag  = 0
													ORDER BY
														ORDER_DATA desc";

					$rsSubMenu = mysql_query($sqlSubCategory) or die(mysql_error());
					$subCount = 1;
					echo '<ul class="submenu-left">';
					while ($subCategoryRow = mysql_fetch_array($rsSubMenu)) {

						$subLink = "ve-category.php?c=" . $categoryRow['CONTENT_CAT_ID'] . "&SCID=" . $subCategoryRow['SUB_CONTENT_CAT_ID'];
						if (nvl($subCategoryRow['LINK_URL'], '') != '')
							$subLink = $subCategoryRow['LINK_URL'];

						echo '<li class="submenu' . $subCount . '"><a href="' . $subLink . '">' . $subCategoryRow['SUB_CONTENT_DESC'] . '</a></li>';
						$subCount++;
					}
					echo '</ul>';

				}

				echo '</li>';
				$mainMenuCount++;

			}
			?>
			
			
			
			<!-- <li class="menu2 sub"><a href="ve-exhibition.php?MID=<?=$MID ?>"><?=$exhibition ?></a>
				<ul class="submenu-left">
					<li class="submenu1"><a href="ve-permanent.php?MID=<?=$MID ?>"><?=$exh_permanent ?></a></li>
					<li class="submenu2"><a href="ve-temporary.php?MID=<?=$MID ?>"><?=$exh_temporary ?></a></li>
				</ul>
			</li>
			<li class="menu3"><a href="ve-category.php?c=19"><?=$exh_virsual ?></a></li>
			<li class="menu4"><a href="ve-category.php?c=18"><?=$visit_museum ?></a></li> -->
		</ul>
	</div>
</div>
