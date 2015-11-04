<?php
if (!isset($_SESSION['user_name'])) {
	header('Location:' . _FULL_SITE_PATH_ . "/login.php");
} else {

	$getMuseumIDSql = "select MUSEUM_DETAIL_ID from mapping_museum_admin where
						ADMIN_USER_ID = '" . $_SESSION['user_name'] . "'";
	$query_getMuseumID = mysql_query($getMuseumIDSql, $conn);
	$row_getMuseumID = mysql_fetch_array($query_getMuseumID);
	$rowCount = mysql_num_rows($query_getMuseumID);
	if ($rowCount == 0) {
		echo "No Permission";
	}
}
?>