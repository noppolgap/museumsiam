<?php
require("../../assets/configs/config.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body class="OrderingImage">
<ul id="sortable" class="sortableBox">
</ul>	
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>
<script>
<?php if(isset($_GET['pop'])){ ?>
	var pop = true;
<?php }else{ ?>
	var pop = false;
<?php } ?>
</script>
</body>
</html>
