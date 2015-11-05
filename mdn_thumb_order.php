<?php
require("assets/configs/config.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>		
</head>

<body class="OrderingImage">
<ul id="sortable" class="sortableBox">
</ul>	
<link rel="stylesheet" type="text/css" href="assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="css/styleForUploadPhoto.css" media="all" />
<script type="text/javascript" src="js/scriptForUploadPhoto.js"></script>
<script>
<?php if(isset($_GET['pop'])){ ?>
	var pop = true;
<?php }else{ ?>
	var pop = false;
<?php } 
	echo "\tvar box = '".$_GET['box']."';\n";
?>
</script>
</body>
</html>
