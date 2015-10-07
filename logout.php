<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
unset($_SESSION['user_name']);
$last_url = $_SESSION['last_url'];
if ($last_url != '') {
	header("Location:$last_url");
} else {
	// Redirect the user to the common menu
	header("Location:" . _FULL_SITE_PATH_);
}
?>