<?php

if(! isset($_SESSION['user_name']))
 
	echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/login.php';</script>";
?>