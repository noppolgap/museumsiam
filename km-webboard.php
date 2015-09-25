<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/km.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu2").addClass("active");
	});
</script>
	
</head>

<body id="km">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="km.php">ระบบการจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">เว็บบอร์ด</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-km.php'); ?>
		</div>
		<div class="box-right main-content">
			
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>เว็บบอร์ด</h1>
				<div class="box-btn">
					<a href="km-webboard-newtopic.php" class="btn red Atopic">ตั้งกระทู้</a>
				</div>
			</div>
			
			<div class="box-table-webboard cf all">

				<div class="table-row head cf">
					<div class="column list">ลำดับ</div>
					<div class="column topic">เรื่อง</div>
					<div class="column name">ชื่อ</div>
					<div class="column reply">ตอบ</div>
					<div class="column view">อ่าน</div>
					<div class="column date">ปรับปรุงล่าสุด</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>
				<div class="table-row list cf">
					<div class="column list">Q12075</div>
					<div class="column topic"><a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a></div>
					<div class="column name">Coco Toh</div>
					<div class="column reply">999,999</div>
					<div class="column view">999,999</div>
					<div class="column date">9/11/2556 16:55:17</div>
				</div>

			</div>
			<div class="box-pagination-main cf Noborder">
				<ul class="pagination">
					<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">...</a></li>
					<li><a href="" class="btn-arrow-right"></a></li>
				</ul>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
