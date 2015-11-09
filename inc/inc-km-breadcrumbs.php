<?php
//echo $MID ;
if (!isset($_GET['MID']))
	$MID = $km_module_id;
else
	$MID = $_GET['MID'];


echo '<ol class="cf">';
echo '<li>';
echo '<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp; ';
echo '</li>';
echo '<li>';
echo '<a href="other-system.php">'.$otherSystemCap.'</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;';
echo '</li>';
/*
echo '<li class="active">';
echo $moduleName;
echo '</li>';*/
$breadArr;
/*
getSubCatBread(92, 1, $breadArr);

getCatBread(47, 1, $breadArr);

getModuleBread (1 , $breadArr);
*/

$breadArr = "";
if (isset ($_GET['CONID']))
{
	getContentBread($_GET['CONID'] , $breadArr);

}

if (isset($_GET['SCID'])) {
	//Gen for last node to cat to module
	
	getSubCatBread($_GET['SCID'], $MID, $breadArr);
	getCatBread($_GET['CID'], $MID, $breadArr);
	getModuleBread ($MID , $breadArr);

} else if (isset($_GET['CID'])) {
	//Gen for cat to Module
	getCatBread($_GET['CID'], $MID, $breadArr);
	getModuleBread ($MID, $breadArr);
} else if (isset($MID)) {
	//Gen only Module
	getModuleBread ($MID , $breadArr);
}

$breadArr = array_reverse($breadArr);

foreach ($breadArr as $v) {
			echo $v;
		//	echo "Current value of \$breadArr: $v.\n";
}

echo '</ol>';





function getSubCatBread($scid, $mid, &$breadArr) {

	$sqlStr = "select * from trn_content_sub_category where SUB_CONTENT_CAT_ID = " . $scid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	if ($_SESSION['LANG'] == 'TH')
		$selectedColName = 'SUB_CONTENT_CAT_DESC_LOC'; 
	else 
		$selectedColName = 'SUB_CONTENT_CAT_DESC_ENG';
	
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row[$selectedColName] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="km.php?MID=' . $mid . '&CID=' . $row['CONTENT_CAT_ID'] . '&SCID=' . $row['SUB_CONTENT_CAT_ID'] . '">' . $row[$selectedColName] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}
		if ($row['REF_SUB_CONTENT_CAT_ID'] > 0)
			return getSubCatBread($row['REF_SUB_CONTENT_CAT_ID'], $mid, $breadArr);
	}

}

function getCatBread($cid, $mid, &$breadArr) {

	$sqlStr = "select * from trn_content_category where CONTENT_CAT_ID = " . $cid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	if ($_SESSION['LANG'] == 'TH')
		$selectedColName = 'CONTENT_CAT_DESC_LOC'; 
	else 
		$selectedColName = 'CONTENT_CAT_DESC_ENG';
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row[$selectedColName] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="km.php?MID=' . $mid . '&CID=' . $row['CONTENT_CAT_ID'] . '">' . $row[$selectedColName] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}

	}
}

function getModuleBread($mid, &$breadArr) {

	$sqlStr = "select * from sys_app_module where MODULE_ID = " . $mid;
	$rs = mysql_query($sqlStr) or die(mysql_error());
	if ($_SESSION['LANG'] == 'TH')
		$selectedColName = 'MODULE_NAME_LOC'; 
	else 
		$selectedColName = 'MODULE_NAME_ENG';
	while ($row = mysql_fetch_array($rs)) {
		//echo count($breadArr);
		if (count($breadArr) == 0) {
			$breadArr[] = '<li class="active">' . $row[$selectedColName] . '</li>';
		} else {
			$breadArr[] = '<li ><a href="km.php?MID=' . $row['MODULE_ID'] .  '">' . $row[$selectedColName] . '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>';
		}

	}
}

function getContentBread($conid, &$breadArr)
{
	$sqlStr = "select * from trn_content_detail where CONTENT_ID = " . $conid;
	 
	 
	$rs = mysql_query($sqlStr) or die(mysql_error());
	if ($_SESSION['LANG'] == 'TH')
		$selectedColName = 'CONTENT_DESC_LOC'; 
	else 
		$selectedColName = 'CONTENT_DESC_ENG';
		
	while ($row = mysql_fetch_array($rs)) {
			$breadArr[] = '<li class="active">' . $row[$selectedColName] . '</li>';
	}
	
	
}
?>