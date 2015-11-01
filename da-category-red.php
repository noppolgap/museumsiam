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
		<?	include ('inc/inc-da-red-breadcrumbs.php');?>
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

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_LOC AS CAT_DESC , content.CONTENT_DESC_LOC AS CONTENT_DESC , content.BRIEF_LOC AS BRIEF_LOC";
	$LANG_SQL_CAT = "SUB_CONTENT_CAT_DESC_LOC AS SUB_CONTENT_CAT_DESC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
	$LANG_SQL_CAT = "SUB_CONTENT_CAT_DESC_ENG AS SUB_CONTENT_CAT_DESC";
}

		$sqlCategory = "";
		if (isset($_GET['SCID'])) {

			$sqlCategoryForLoop = "SELECT ".$LANG_SQL_CAT.",
								SUB_CONTENT_CAT_ID,
								CONTENT_CAT_ID,
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
			$sqlCategoryForLoop = "SELECT ".$LANG_SQL_CAT.",
								SUB_CONTENT_CAT_ID,
								CONTENT_CAT_ID,
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

	$rsCat = mysql_query($sqlCategoryForLoop) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) {
?>
			<div class="box-category-main news BRed2">
				<div class="box-title cf ">
					<h2><?=$rowCat['SUB_CONTENT_CAT_DESC_LOC'] ?></h2>
					<div class="box-btn">
						<?php if ($rowCat['IS_LAST_NODE'] == 'Y'){?>
						<a href="da-all-red.php?MID=<?=$MID ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>&SCID=<?=$rowCat['SUB_CONTENT_CAT_ID'] ?>" class="btn gold">ดูทั้งหมด</a>
						<?php } else { ?>
							<a href="da-category-red.php?MID=<?=$MID ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>&SCID=<?=$rowCat['SUB_CONTENT_CAT_ID'] ?>" class="btn gold">ดูทั้งหมด</a>
							<?php } ?>

					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">

						<?php

						$sqlContent  = "SELECT ".$LANG_SQL;
						$sqlContent .= "  ,	cat.CONTENT_CAT_ID,
												content.CONTENT_ID,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE,
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
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/ ";
							

							if (isset($_GET['search'])) {
								if (isset($_POST['str_search'])){
									$_SESSION['text'] = $_POST['str_search'];
									$sqlContent .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
								}
							}
							else {
								unset($_SESSION['text']);
							}

						    $sqlContent .= "		ORDER BY content.ORDER_DATA desc LIMIT 0,3 " ;



						$rsContent = mysql_query($sqlContent) or die(mysql_error());
						$i = 1;

						$categoryID = $rowCat['CONTENT_CAT_ID'];
						$subCategoryID = $rowCat['SUB_CONTENT_CAT_ID'];
						while ($rowContent = mysql_fetch_array($rsContent)) {

							$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}

							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' .$rowContent['CONTENT_ID'];
							$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
							$tw_link = $fullpath;

							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
							echo '<div class="box-pic">';
							echo '<img style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '">';
							echo '</div>';
							echo '</a>';
							echo '<div class="box-text">';
							echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
							echo '<p class="text-title TcolorRed">';
							echo $rowContent['CONTENT_DESC'];
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
							echo '<a href="'.$fb_link.'" onclick="shareFB(\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
							echo '<a href="'.$fullpath.'" onclick="shareTW(\''.$rowContent['CONTENT_ID'].'\',\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							$i++;
						}
						?>

					</div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['DA_PREV_PG'] = $current_url;

include ('inc/inc-footer.php');
include ('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>