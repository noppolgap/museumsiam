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
<script async defer src="//maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap&language=th"></script>
<script src="assets/script/gis.js"></script>
<script>
var museums = [
<?php
	$sql = "SELECT * FROM trn_museum_detail WHERE IS_GIS_MUSEUM = 'Y'";
	$query = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($query)) {
	  echo "\t\t['".$row['MUSEUM_NAME_LOC']."',".$row['LAT'].",".$row['LON'].",".$row['MUSEUM_DETAIL_ID'].",".$row['MUSEUM_DETAIL_ID']."],\n";
	}
?>
];	
</script>
</body>
</html>
<? CloseDB(); ?>