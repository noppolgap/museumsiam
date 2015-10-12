<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".intval($_POST['pid'])." AND IMG_TYPE = '1' AND CAT_ID = ".intval($_POST['cid'])." ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$row = mysql_fetch_array($query);
	echo trim(str_replace("../../","",$row['IMG_PATH']));

CloseDB();
?>