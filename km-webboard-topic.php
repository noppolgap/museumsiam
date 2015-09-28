<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");


$id = intval($_GET['web_id']);
if($id == 0){
	header('Location: index.php');
}

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

			<?
				$sq_qa = " SELECT WEBBOARD_ID, CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_webboard
						   WHERE  WEBBOARD_ID = ".$id." AND FLAG <>2 ORDER BY ORDER_DATA DESC ";
				
				$query_qa = mysql_query($sq_qa, $conn);

				$num_rows = mysql_num_rows($query_qa);

				$num = 1;

			?>

			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>เว็บบอร์ด</h1>
				<div class="box-btn">
					<a href="km-webboard.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>

			<?php while($row = mysql_fetch_array($query_qa)) { ?>

			<div  class="box-topic-main">

				<div class="box-top">
					<div class="box-topic-title">
						<? echo $row['CONTENT'] ?>
					</div>
				</div>
				<div class="box-bottom">
					<div class="box-topic-detail">
						<p>
							<? echo $row['DETAIL'] ?>
						</p>
					</div>
					<hr/>
					<div class="box-footer-topic cf">
						<div class="box-left">
							<p>ตั้งโดย : <? echo $row['USER_CREATE'] ?></p>
						</div>
						<div class="box-right">
							<p><? echo ConvertDate($row['LAST_UPDATE_DATE	']) ?></p>
						</div>
					</div>
				</div>

			</div>
			
			<?php
			}
			 while($row = mysql_fetch_array($query_qa)) { 
						
			////ส่วนคำตอบ
			  $sq_ans = "  SELECT CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_webboard
							WHERE REF_WEBBOARD_ID = ".$id." AND FLAG <>2
							ORDER BY ORDER_DATA DESC ";

				$query_ans = mysql_query($sq_ans, $conn);

				$num_rows = mysql_num_rows($query_ans);

				$num = 1;
			?>

			<div  class="box-replay-main">

				<? while($row_ans = mysql_fetch_array($query_ans)) {?> 

				<div class="box-top">
					<p>
						ความคิดเห็น <? echo $num; ?> :
					</p>
				</div>
				<div class="box-bottom">
					<div class="box-replay-detail">
						<p>
							<? echo $row_ans['CONTENT'] ?>
						</p>
					</div>
					<div class="box-footer-replay cf">
						<div class="box-left">
							<p>ตอบโดย : <? echo $row_ans['USER_CREATE'] ?></p>
						</div>
					</div>
					<hr/>
				</div>

				<? $num++; } ?>

			</div>

			<? } ?>


			<div class="box-pagination-main cf Noborder pageTopic">
				<ul class="pagination">
					<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">...</a></li>
					<li><a href="" class="btn-arrow-right"></a></li>
				</ul>
			</div>
			
			<div class="box-form-reply">
				<div class="text-title">
					ตอบกระทู้
				</div>
				<textarea></textarea>
				<div class="condition">
					<p>
					<span>ข้อตกลง</span>
						ขอสงวนสิทธิ์ในการตรวจสอบข้อความก่อนแสดงบนหน้าเว็บและใช้ดุลพินิจที่จะลบกระทู้ใดๆ ที่มีข้อความที่ไม่เหมาะสม ไม่สุภาพหรือพาดพิงถึงลุคคลใดๆ ในการเสื่อมเสีย
					</p>
				</div>
				<div class="box-btn cf">
					<a href="#" class="btn red">ตอบกระทู้</a>
				</div>
			</div>
			
			<div class="box-pagination-main cf">
				<div class="box-btn topic">
					<a href="#" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
