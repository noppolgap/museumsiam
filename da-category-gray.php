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
<link rel="stylesheet" type="text/css" href="css/da.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6").addClass("active");
	});
</script>
	
</head>

<body id="km">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
		<?	include ('inc/inc-da-gray-breadcrumbs.php'); ?>
			<!-- <ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="da.php">คลังความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">หมวดหมู่</li>
			</ol> -->
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-da.php'); ?>
		</div>
		<div class="box-right main-content">
			<?php
		$MID = $_GET['MID'];
		$CID = $_GET['CID'];
		$CONID = $_GET['CONID'];

		$SCID = "-1";
		if (isset($_GET['SCID']))
			$SCID = $_GET['SCID'];

		$currentPage = 1;
		if (isset($_GET['PG']))
			$currentPage = $_GET['PG'];

		if ($currentPage < 1)
			$currentPage = 1;

		$catName = "";
		$backPage = "";
		if (isset($_SESSION['DA_PREV_PG']))
			$backPage = $_SESSION['DA_PREV_PG'];
		else
			$backPage = "da.php?MID=" . $digial_module_id;

		$currentParam = "?MID=" . $MID . "&CID=" . $CID;
		if (isset($_GET['SCID'])) {
			$currentParam .= "$SCID=" . $SCID;
		}

		$sqlCategory = "";
		if (isset($_GET['SCID'])) {

			$sqlCategoryForLoop = "SELECT
								SUB_CONTENT_CAT_ID,
								CONTENT_CAT_ID,
								SUB_CONTENT_CAT_DESC_LOC,
								SUB_CONTENT_CAT_DESC_ENG,
								REF_SUB_CONTENT_CAT_ID,
								IS_LAST_NODE
							FROM
								trn_content_sub_category
							WHERE
								CONTENT_CAT_ID = $CID
							AND FLAG = 0
							AND REF_SUB_CONTENT_CAT_ID = " . $_GET['SCID'];
			$sqlCategoryForLoop .= "ORDER BY
								ORDER_DATA DESC";
			/*
			 $sqlCategory = "select SUB_CONTENT_CAT_ID ,
			 CONTENT_CAT_ID ,
			 SUB_CONTENT_CAT_DESC_LOC ,
			 SUB_CONTENT_CAT_DESC_ENG
			 from trn_content_sub_category where SUB_CONTENT_CAT_ID = $SCID ";
			 $rsCat = mysql_query($sqlCategory) or die(mysql_error());
			 while ($rowCat = mysql_fetch_array($rsCat)) {
			 $catName = $rowCat['SUB_CONTENT_CAT_DESC_LOC'];
			 }*/
		} else {
			$sqlCategoryForLoop = "SELECT
								SUB_CONTENT_CAT_ID,
								CONTENT_CAT_ID,
								SUB_CONTENT_CAT_DESC_LOC,
								SUB_CONTENT_CAT_DESC_ENG,
								REF_SUB_CONTENT_CAT_ID,
								IS_LAST_NODE
							FROM
								trn_content_sub_category
							WHERE
								CONTENT_CAT_ID = $CID
							AND FLAG = 0
							ORDER BY
								ORDER_DATA DESC";

			/*$sqlCategory = "select CONTENT_CAT_ID ,
			 CONTENT_CAT_DESC_LOC ,
			 CONTENT_CAT_DESC_ENG from trn_content_category where CONTENT_CAT_ID	= $CID ";
			 $rsCat = mysql_query($sqlCategory) or die(mysql_error());
			 while ($rowCat = mysql_fetch_array($rsCat)) {
			 $catName = $rowCat['CONTENT_CAT_DESC_LOC'];
			 }*/
		}
	?>	
			
		<?php 		
				$rsCat = mysql_query($sqlCategoryForLoop) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) { ?>
			<div class="box-category-main news BGray">
				
				<div class="box-title cf ">
					<h2><?=$rowCat['SUB_CONTENT_CAT_DESC_LOC'] ?></h2>
					<div class="box-btn">
						<?php if ($rowCat['IS_LAST_NODE'] == 'Y'){?>
						<a href="da-all-gray.php?MID=<?=$MID ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>&SCID=<?=$rowCat['SUB_CONTENT_CAT_ID'] ?>" class="btn black">ดูทั้งหมด</a>
						<?php } else { ?>
							<a href="da-category-gray.php?MID=<?=$MID ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>&SCID=<?=$rowCat['SUB_CONTENT_CAT_ID'] ?>" class="btn black">ดูทั้งหมด</a>
							<?php } ?>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<?php 
						
						$sqlContent = "SELECT
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
											AND cat.CONTENT_CAT_ID = $CID
											and content.SUB_CAT_ID = ".$rowCat['SUB_CONTENT_CAT_ID'];
						   $sqlContent .= " AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
												ORDER BY content.ORDER_DATA desc LIMIT 0,3 " ;
						
						
						
						$rsContent = mysql_query($sqlContent) or die(mysql_error());
						$i = 1;

						$categoryID = $rowCat['CONTENT_CAT_ID'];
						$subCategoryID = $rowCat['SUB_CONTENT_CAT_ID'];
						while ($rowContent = mysql_fetch_array($rsContent)) {

							$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}
							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
							echo '<div class="box-pic">';
							echo '<img style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '">';
							echo '</div>';
							echo '</a>';
							echo '<div class="box-text">';
							echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
							echo '<p class="text-title TcolorRed">';
							echo $rowContent['CONTENT_DESC_LOC'];
							echo '</p>';
							echo '</a>';
							echo '<p class="text-date TcolorGray">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo '</p>';
							echo '<p class="text-des TcolorBlack">';
							echo $rowContent['BRIEF_LOC'];
							echo '</p>';
							echo '<div class="box-btn cf">';
							echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '" class="btn red">อ่านเพิ่มเติม</a>';
							echo '<div class="box-btn-social cf">';
							echo '<a href="#" class="btn-socila fb"></a>';
							echo '<a href="#" class="btn-socila tw"></a>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							$i++;
						}
						?>
						
						<!-- <div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf mid">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div> -->
						
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- <div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>หมวดหมู่ย่อย</h2>
					<div class="box-btn">
						<a href="da-all.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf mid">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>หมวดหมู่ย่อย</h2>
					<div class="box-btn">
						<a href="da-all.php" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf mid">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
								</div>
							</a>
							<div class="box-text">
								<a href="">
									<p class="text-title TcolorRed">
										Levitated Mass 340 Ton Giant Stone
									</p>
								</a>
								<p class="text-date TcolorGray">
									28 พ.ย. 2559
								</p>
								<p class="text-des TcolorBlack">
									Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
								</p>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
									<div class="box-btn-social cf">
										<a href="#" class="btn-socila fb"></a>
										<a href="#" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div> -->
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
