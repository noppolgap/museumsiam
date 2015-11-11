<?php

if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
	$selectedColumn = 'CMS_TEXT_LOC';
} else {
	$picFolder = 'en';
	$selectedColumn = 'CMS_TEXT_ENG';
}
?>
<?php
$sql = "select " . $selectedColumn . " as CMS_TEXT from trn_content_cms where CMS_KEY ='RENT_PAGE' AND ACTIVE_FLAG = 1";
$rsContent = mysql_query($sql) or die(mysql_error());
$rowContent = mysql_fetch_array($rsContent);
echo str_replace('../../', '', $rowContent['CMS_TEXT']);
?>

