<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/view360.css" />
<script>
	function closeWin(){
		window.close(); 
	}
</script>
	
</head>

<body>

<div class="box-top">
	<div class="container">
		<div class="box-title-main cf">
			<div class="box-left">
				<img src="images/th/title-360.png"/>
			</div>
			<div class="box-right">
				<div class="box-btn cf">
					<a class="btn red"  onclick="closeWin(); return false;">ปิด</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="box-bottom">	
	<div class="box-content-360">
		<div class="box-title">
			ชื่อวัตถุโบราณ
		</div>
		<div class="box-plugin-360">
			<img src="http://placehold.it/592x382">
		</div>
		<div class="box-des">
			<img src="images/icon-hand.png" />กรุณาเลื่อนรูปภาพเพื่อรับชมภาพ 360&deg;
		</div>
	</div>	
</div>

</body>
</html>
