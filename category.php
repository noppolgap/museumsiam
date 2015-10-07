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
				 <?include ('inc/inc-breadcrumbs.php');?> 
					<!--<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							<?=$moduleName ?>
						</li>
					</ol>-->
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<div class="part-main">
			<div class="container cf">
				<div class="box-left main-content">
					<?php
					include ('inc/inc-category-menu.php');
					//include ('inc/inc-left-content-km.php');
					?>
				</div>
				<div class="box-right main-content">

					<?php
					$sql = " SELECT
CONTENT_CAT_DESC_LOC,
CONTENT_CAT_DESC_ENG,
CONTENT_CAT_ID , 
IS_LAST_NODE
FROM
trn_content_category
WHERE
REF_MODULE_ID = " . $MID;
					$sql .= " AND flag  = 0
order by order_data desc ";

					$categoryName = '';
					$categoryID = 0;

					$rs = mysql_query($sql) or die(mysql_error());
					$catCount = 1;

					while ($row = mysql_fetch_array($rs)) {
						$categoryID = $row['CONTENT_CAT_ID'];
						$categoryName = $row['CONTENT_CAT_DESC_LOC'];
						//CONTENT_CAT_DESC_ENG

						$divGroupExtraClass = ' BGray';
						$btnExtraClass = 'btn black';
						
						if ($catCount == 1){
							$divGroupExtraClass = ' BBlack';
							$btnExtraClass = 'btn gold';
							}

						echo '<div class="box-category-main news ' . $divGroupExtraClass . '">';

						echo '<div class="box-title cf">';
						echo '<h2>' . $categoryName . '</h2>';
						echo '<div class="box-btn">';
						if ( nvl($row['IS_LAST_NODE'],'Y') == 'Y')
							echo '<a href="all-content.php?MID='.$MID.'&CID='.$categoryID.'" class="'.$btnExtraClass.'">ดูทั้งหมด</a>';
						else 	
						echo '<a href="sub-category.php?MID='.$MID.'&CID='.$categoryID.'" class="'.$btnExtraClass.'">ดูทั้งหมด</a>';
						echo '</div>';
						echo '</div>';
						echo '<div class="box-news-main">';
						echo '<div class="box-tumb-main cf ">';

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
							echo '<a href="content-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'"> ';
							echo ' <div class="box-pic" > ';
							echo '	<img  style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';
							echo ' <div class="box-text">';
							echo ' <a href="content-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'">';
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
							echo ' <a href="content-detail.php?MID='.$MID.'&CID='.$categoryID.'&CONID='.$rowContent['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
							echo ' <div class="box-btn-social cf">';
							echo ' <a href="#" class="btn-socila fb"></a>';
							echo ' <a href="#" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							$i++;
						}

						//<!-- end Loop inner -->
						echo '</div>';
						echo '</div>';
						echo '</div>';
						$catCount++;
					}
					?>

					<div class="box-category-main news">
						<div class="box-title cf">
							<h2>เว็บบอร์ด</h2>
							<div class="box-btn">
								<a href="km-webboard.php" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-table-webboard cf">

								<div class="table-row head cf">
									<div class="column list">
										ลำดับ
									</div>
									<div class="column topic">
										เรื่อง
									</div>
									<div class="column name">
										ชื่อ
									</div>
									<div class="column reply">
										ตอบ
									</div>
									<div class="column view">
										อ่าน
									</div>
									<div class="column date">
										ปรับปรุงล่าสุด
									</div>
								</div>
								<div class="table-row list cf">
									<div class="column list">
										Q12075
									</div>
									<div class="column topic">
										<a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a>
									</div>
									<div class="column name">
										Coco Toh
									</div>
									<div class="column reply">
										999,999
									</div>
									<div class="column view">
										999,999
									</div>
									<div class="column date">
										9/11/2556 16:55:17
									</div>
								</div>
								<div class="table-row list cf">
									<div class="column list">
										Q12075
									</div>
									<div class="column topic">
										<a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a>
									</div>
									<div class="column name">
										Coco Toh
									</div>
									<div class="column reply">
										999,999
									</div>
									<div class="column view">
										999,999
									</div>
									<div class="column date">
										9/11/2556 16:55:17
									</div>
								</div>
								<div class="table-row list cf">
									<div class="column list">
										Q12075
									</div>
									<div class="column topic">
										<a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a>
									</div>
									<div class="column name">
										Coco Toh
									</div>
									<div class="column reply">
										999,999
									</div>
									<div class="column view">
										999,999
									</div>
									<div class="column date">
										9/11/2556 16:55:17
									</div>
								</div>
								<div class="table-row list cf">
									<div class="column list">
										Q12075
									</div>
									<div class="column topic">
										<a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์</a>
									</div>
									<div class="column name">
										Coco Toh
									</div>
									<div class="column reply">
										999,999
									</div>
									<div class="column view">
										999,999
									</div>
									<div class="column date">
										9/11/2556 16:55:17
									</div>
								</div>
								<div class="table-row list cf">
									<div class="column list">
										Q12075
									</div>
									<div class="column topic">
										<a href="km-webboard-topic.php">ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์</a>
									</div>
									<div class="column name">
										Coco Toh
									</div>
									<div class="column reply">
										999,999
									</div>
									<div class="column view">
										999,999
									</div>
									<div class="column date">
										9/11/2556 16:55:17
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
		?>
	</body>
</html>
