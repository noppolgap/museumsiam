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
			 <?include ('inc/inc-breadcrumbs.php');?> 
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include ('inc/inc-category-menu.php'); ?>
		</div>
		<div class="box-right main-content">

			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>เว็บบอร์ด</h1>
				<div class="box-btn">
					<a href="km-webboard-newtopic.php" class="btn red Atopic">ตั้งกระทู้</a>
				</div>
			</div>

			<?php

			    $sq_qa = " SELECT WEBBOARD_ID, CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_webboard
						   WHERE REF_WEBBOARD_ID = 0
						   AND FLAG = 0 ORDER BY ORDER_DATA DESC LIMIT 0 , 30";

				$query_qa = mysql_query($sq_qa, $conn);

				$num_rows = mysql_num_rows($query_qa);

				$num = 1;
			?>

			<div class="box-table-webboard cf all">

				<div class="table-row head cf">
					<div class="column list">ลำดับ</div>
					<div class="column topic">เรื่อง</div>
					<div class="column name">ชื่อ</div>
					<div class="column reply">ตอบ</div>
					<div class="column view">อ่าน</div>
					<div class="column date">ปรับปรุงล่าสุด</div>
				</div>

				<?php while($row = mysql_fetch_array($query_qa)) {
					////ส่วนคำตอบ
				   $sq_ans = " SELECT COUNT( WEBBOARD_ID ) ans, COUNT( VISIT_COUNT ) re FROM trn_webboard
								WHERE REF_WEBBOARD_ID = ".$row['WEBBOARD_ID']." AND FLAG = 2 ";

					$query_ans = mysql_query($sq_ans, $conn);

					$num_rows = mysql_num_rows($query_ans);
				?>

				<div class="table-row list cf">
					<div class="column list"><? echo $num ?></div>
					<div class="column topic"><a href="km-webboard-topic.php?web_id=<?=$row['WEBBOARD_ID']?>"><? echo $row['CONTENT'] ?></a></div>
					<div class="column name"><? echo $row['USER_CREATE'] ?></div>

					<? while($row_ans = mysql_fetch_array($query_ans)) {?>

						<div class="column reply"><? echo $row_ans['ans'] ?></div>
						<div class="column view"><? echo $row_ans['re'] ?></div>

					<? } ?>

					<div class="column date"><? echo ConvertDate($row['LAST_UPDATE_DATE	']) ?></div>
				</div>


			 <? $num++;  } ?>

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
