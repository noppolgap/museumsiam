<?php
//echo $MID ;

echo '<ol class="cf">';
echo '<li>';
echo '<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp; ';
echo '</li>';
echo '<li>';
echo '<a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;';
echo '</li>';
 
$breadArr;
/*
getSubCatBread(92, 1, $breadArr);

getCatBread(47, 1, $breadArr);

getModuleBread (1 , $breadArr);
*/
if (isset($_GET['SCID'])) {
	//Gen for last node to cat to module
	$breadArr = "";
	getSubCatBread($_GET['SCID'], $_GET['MID'], $breadArr);
	getCatBread($_GET['CID'], $_GET['MID'], $breadArr);
	getModuleBread ($_GET['MID'] , $breadArr);

} else if (isset($_GET['CID'])) {
	//Gen for cat to Module
	getCatBread($_GET['CID'], $_GET['MID'], $breadArr);
	getModuleBread ($_GET['MID'] , $breadArr);
} else if (isset($_GET['MID'])) {
	//Gen only Module
	getModuleBread ($_GET['MID'] , $breadArr);
}

$breadArr = array_reverse($breadArr);

foreach ($breadArr as $v) {
			echo $v;
}

echo '</ol>';





function getSubCatBread($scid, $mid, &$breadArr) {

	$sqlStr = "select * from trn_content_sub_category where SUB_CONTENT_CAT_ID = " . $scid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row['SUB_CONTENT_CAT_DESC_LOC'] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="da-category-gray.php?MID=' . $mid . '&CID=' . $row['CONTENT_CAT_ID'] . '&SCID=' . $row['SUB_CONTENT_CAT_ID'] . '">' . $row['SUB_CONTENT_CAT_DESC_LOC'] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}
		if ($row['REF_SUB_CONTENT_CAT_ID'] > 0)
			return getSubCatBread($row['REF_SUB_CONTENT_CAT_ID'], $mid, $breadArr);
	}

}

function getCatBread($cid, $mid, &$breadArr) {

	$sqlStr = "select * from trn_content_category where CONTENT_CAT_ID = " . $cid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row['CONTENT_CAT_DESC_LOC'] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="da-all-gray.php?MID=' . $mid . '&CID=' . $row['CONTENT_CAT_ID'] . '">' . $row['CONTENT_CAT_DESC_LOC'] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}

	}
}

function getModuleBread($mid, &$breadArr) {

	$sqlStr = "select * from sys_app_module where MODULE_ID = " . $mid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row['MODULE_NAME_LOC'] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="da.php?MID=' . $row['MODULE_ID'] .  '">' . $row['MODULE_NAME_LOC'] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}

	}
}
?>