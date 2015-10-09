<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<?
require ('inc_meta.php');
 ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/km.css" />

<script>
	$(document).ready(function() {
		$(".menutop li.menu6,.menu-left li.menu1").addClass("active");
	});
</script>
	
</head>

<body id="km">
	
<?php
include ('inc/inc-top-bar.php');
 ?>
<?php
include ('inc/inc-menu.php');
 ?>	
<?php
//get Module ID
if (!isset($_GET['MID']))
	$MID = $km_module_id;
else
	$MID = $_GET['MID'];

$sqlModule = "select * from sys_app_module where MODULE_ID = " . $MID;
$moduleName = '';
$rs = mysql_query($sqlModule) or die(mysql_error());

while ($row = mysql_fetch_array($rs)) {
	$moduleName = $row['MODULE_NAME_LOC'];
	// MODULE_NAME_ENG
}
		?>
<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบการจัดการความรู้</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
			include ('inc/inc-left-content-km.php');
 ?>
		</div>
		<div class="box-right main-content">

 
	
	
			 <div class="box-category-main news BBlack">
				<div class="box-title cf">
					<h2>กิจกรรม</h2>
					<div class="box-btn">
						<a href="km-event.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?php
						$categoryID = $event_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
						
					</div>
				</div>
			</div>
			
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>นิทรรศการ</h2>
					<div class="box-btn">
						<a href="km-exhibition.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<?php
						$categoryID = $exhibition_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
					</div>
				</div>
			</div>

			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>การค้นคว้าและอ้างอิง</h2>
					<div class="box-btn">
						<a href="km-reseach.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?php
						$categoryID = $reseach_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>ระบบการศึกษา</h2>
					<div class="box-btn">
						<a href="km-education.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<?php
						$categoryID = $education_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>สัมมนาและอบรม</h2>
					<div class="box-btn">
						<a href="km-seminar.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?php
						$categoryID = $seminar_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>สื่อการเรียนรู้</h2>
					<div class="box-btn">
						<a href="km-media.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<?php
						$categoryID = $media_cat_id;
						$contentSqlStr = "SELECT
												cat.CONTENT_CAT_DESC_LOC,
												cat.CONTENT_CAT_DESC_ENG,
												cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.CONTENT_DESC_LOC,
												content.CONTENT_DESC_ENG,
												content.BRIEF_LOC,
												content.BRIEF_ENG,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE 
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $categoryID
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,3 ";

						// start Loop Activity
						$i = 1;
						$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
						while ($rowContent = mysql_fetch_array($rsContent)) {
						$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
							echo ' <p class="text-title">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo ' </p> </a>';
							echo ' <p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';
							echo ' <p class="text-des">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
							}
						?>
					</div>
				</div>
			</div>  
			
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>เว็บบอร์ด</h2>
					<div class="box-btn">
						<a href="km-webboard.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>


				<?php
				//// ส่วนคำถาม
				$sq_qa = " SELECT WEBBOARD_ID, CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_webboard
						   WHERE REF_WEBBOARD_ID = 0
						   AND FLAG <>2 ORDER BY ORDER_DATA DESC ";

				$query_qa = mysql_query($sq_qa, $conn);

				$num_rows = mysql_num_rows($query_qa);

				$num = 1;
				?>

				<div class="box-news-main">
					<div class="box-table-webboard cf">

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
						  $sq_ans = " SELECT COUNT( WEBBOARD_ID ) ans, COUNT( VISIT_COUNT ) re  FROM trn_webboard
										WHERE REF_WEBBOARD_ID = ".$row['WEBBOARD_ID']." AND FLAG <>2 ";

							$query_ans = mysql_query($sq_ans, $conn);

							$num_rows = mysql_num_rows($query_ans);
						?>

							<div class="table-row list cf">
								<div class="column list"><? echo $num ?></div>
								<div class="column topic"><a href="km-webboard-topic.php?web_id=<?=$row['WEBBOARD_ID'] ?>"><? echo my_substring($row['CONTENT'], 150); ?></a></div>
								<div class="column name"><? echo $row['USER_CREATE'] ?></div>
						
								<? while($row_ans = mysql_fetch_array($query_ans)) {?> 

								<div class="column reply"> <? echo $row_ans['ans'] ?></div>
								<div class="column view"><? echo $row_ans['re'] ?></div>

								<? } ?>

								
								<div class="column date"><? echo ConvertDate($row['LAST_UPDATE_DATE	']) ?></div>
							</div>

					   <? $num++;
	}
 ?>
	
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['KM_PREV_PG'] = $current_url;
?>

<?php
include ('inc/inc-footer.php');
 ?>	

</body>
</html>
