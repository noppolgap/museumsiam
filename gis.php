<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	
<link rel="stylesheet" type="text/css" href="css/gis.css" />	
</head>

<body>
	 <div id="map"></div>
<script async defer src="//maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>	 
<script src="assets/script/gis.js"></script>
</body>
</html>
<? CloseDB(); ?>