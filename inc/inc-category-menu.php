<?php

if (isset($_GET['MID']))
{
$MID = $_GET['MID'];

$sqlStr = " select sysModule.MODULE_ID ,  
sysModule.MODULE_NAME_LOC , 
sysModule.MODULE_NAME_ENG , 
sysModule.IS_LAST_NODE ,
banner.DESKTOP_ICON_PATH , 
banner.DESKTOP_BANNER_NAME  , 
banner.BANNER_LINK from sys_app_module sysModule INNER JOIN trn_banner_pic_setting banner 
on banner.APP_MODULE_ID = sysModule.MODULE_ID
where sysModule.MODULE_ID =  " . $MID;

$query = mysql_query($sqlStr, $conn);
?>
<?php while($row = mysql_fetch_array($query)) {
?>
<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="category.php?MID=<?=$row['MODULE_ID'] ?>"><img src="images/th/<?=$row['DESKTOP_BANNER_NAME'] ?>" /></a>
	</div>
</div>

<div class="part-left-search">
	<div class="box-search">
		<input type="text" placeholder="ค้นหา">
	</div>
</div>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1">
				<a href="category.php?MID=<?=$row['MODULE_ID'] ?>">หน้าหลัก</a>
			</li>

			<?php
	$mainMenuCount = 2;
	//start with 2
	if ($MID == 2) {
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if ( strpos($actual_link,'webboard') !== false )
		echo '<li class="menu' . $mainMenuCount++ . ' active">';
		else 
		echo '<li class="menu' . $mainMenuCount++ . '">';
		echo '<a href="km-webboard.php">เว็บบอร์ด</a> ';
		echo '</li>';
	}

	$sqlCategory = "SELECT
								CONTENT_CAT_ID,
								CONTENT_CAT_DESC_LOC,
								CONTENT_CAT_DESC_ENG,
								IS_LAST_NODE
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = " . $row['MODULE_ID'];
	$sqlCategory .= " AND flag = 0 
							ORDER BY
								ORDER_DATA desc ";

	//firstLoop is Category
	$categoryRS = mysql_query($sqlCategory) or die(mysql_error());

	while ($categoryRow = mysql_fetch_array($categoryRS)) {

		$isSubCat = '';
		if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'N') {
			$isSubCat = ' sub';
		}

		$activeClass = '';
		if ($CID == $categoryRow['CONTENT_CAT_ID'])
			$activeClass = ' active';

		echo '<li class="menu' . $mainMenuCount . $isSubCat . $activeClass . '">';

		if (nvl($categoryRow['IS_LAST_NODE'], 'Y') == 'Y') {
			echo ' <a href="all-content.php?MID=' . $row['MODULE_ID'] . '&CID=' . $categoryRow['CONTENT_CAT_ID'] . '">' . $categoryRow['CONTENT_CAT_DESC_LOC'] . '</a> ';
		} else {
			//has subCat render list
			echo ' <a href="subcategory.php?MID=' . $row['MODULE_ID'] . '&CID=' . $categoryRow['CONTENT_CAT_ID'] . '">' . $categoryRow['CONTENT_CAT_DESC_LOC'] . '</a> ';

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
			$sqlSubCategory .= " AND flag <> 2
													ORDER BY
														ORDER_DATA desc";

			/*
			 <ul class="submenu-left">
			 <li class="submenu1">
			 <a href="da-category.php">หมวดหมู่ย่อย</a>
			 </li>
			 <li class="submenu2">
			 <a href="da-category.php">หมวดหมู่ย่อย</a>
			 </li>
			 </ul> */
		}

		echo '</li>';
		$mainMenuCount++;
	}
			?>
		</ul>
	</div>
</div>
<?php } ?>

<?php } ?>
<!-- End if -->

