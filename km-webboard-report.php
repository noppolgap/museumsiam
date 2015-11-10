<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

if ($_SESSION['LANG'] == 'TH')
	require ("inc/inc-th-lang.php");
else if ($_SESSION['LANG'] == 'EN')
	require ("inc/inc-en-lang.php");


?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Report</title>
<?php
if(isset($_POST['save'])){

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE APPROVE_FLAG <>2 AND REF_WEBBOARD_ID= 0 AND cat_id = 17 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	$insert['CAT_ID'] =  "17";
	$insert['CONTENT_DESC_LOC'] = "'WEBBOARD Report'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['report'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_STATUS_FLAG'] = 2;
	$insert['USER_CREATE'] = "'".$_SESSION['user_name'] ."'";
	$insert['CREATE_DATE'] = "NOW()";

	$sql = "INSERT INTO trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">if (!window.jQuery) document.write(unescape('%3Cscript src="assets/plugin/jquery.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">
parent.jQuery.colorbox.close();
</script>
<?
}
?>
</head>

<body>
<?=$report_webboard?>
<form action="?" method="post" name="form_report">
<textarea name="report" style="width:98%; height:75px; margin:15px 0px;"></textarea>
<br/>
<input type="submit" name="save" value="Send">
</form>
</body>
</html>
<?
CloseDB();
?>