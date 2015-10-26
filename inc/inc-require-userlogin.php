<?php
if(!isset($_SESSION['user_name'])){
	header('Location:'. _FULL_SITE_PATH_ . "/login.php");
}
?>