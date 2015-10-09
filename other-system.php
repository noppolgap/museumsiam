<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/other-system.css" />

<script>
	$(document).ready(function(){
		$("li.menu6").addClass("active");				
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>	
	
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main" id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบอื่นๆ ที่เกี่ยวข้อง</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="box-other-system">
	<div class="container">
		<div class="system-row cf">
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
		</div>
		<div class="system-row cf">
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
