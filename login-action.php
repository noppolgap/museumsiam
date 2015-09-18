<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');
 
if (isset($_POST['UID']) && isset($_POST['PWD'])) {
	return "PASS";
}
else 
	return "ELSE";

CloseDB();

?>