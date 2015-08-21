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
<div class="infobox"> 
	<strong>โรงพยาบาลจันทรุเบกษา</strong>
	<div>
	    <div class="infoboxAddress">1 หมู่ 7 กระตีบ กำแพงแสน นครปฐม 73180</div>
	    <div class="infobox-control-btn">
	      	<div class="infobox-btn btndetail" onclick="showResult3(2416);">รายละเอียด</div>
		  	<div class="infobox-btn btndirection" onclick="ShowDirectionsPanel();">ขอเส้นทาง</div>
	    </div>
  	</div>
</div>
</body>
</html>
<? CloseDB(); ?>