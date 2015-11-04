<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {
		if (isset($_POST['str_search']))
			$_SESSION['text'] = $_POST['str_search'];
			$search_sql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
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
		$(".menutop li.menu6").addClass("active");
	});
</script>

</head>

<body id="km">

<?php
include('inc/inc-top-bar.php');
include('inc/inc-menu.php');
$MID = $km_module_id;
$CID = $reseach_cat_id;
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

if (isset($_SESSION['KM_PREV_PG'])) {
	$backPage = $_SESSION['KM_PREV_PG'];
} else {
	$backPage = "km.php?MID=".$km_module_id;
}
//$backPage = "km.php?MID=" . $MID . "&CID=" . $CID;
$currentParam = "?MID=" . $MID . "&CID=" . $CID;
if (isset($_GET['SCID'])) {
	//$backPage .= "$SCID=" . $SCID;
	$currentParam .= "$SCID=" . $SCID;
}

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_LOC AS CAT_DESC , content.CONTENT_DESC_LOC AS CONTENT_DESC , content.BRIEF_LOC AS BRIEF_LOC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
}

?>
<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="km.php"><?=getModuleDescription($km_module_id);?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=getCategoryDescription($CID)?></li>
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
<?php


$sqlCategory = "";
if (isset($_GET['SCID'])) {
	$sqlCategory = "select SUB_CONTENT_CAT_ID ,
											CONTENT_CAT_ID ,
											SUB_CONTENT_CAT_DESC_LOC ,
											SUB_CONTENT_CAT_DESC_ENG
											from trn_content_sub_category where SUB_CONTENT_CAT_ID = $SCID ";
	$rsCat = mysql_query($sqlCategory) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) {
		if ($_SESSION['LANG'] == 'TH') {
			$catName = $rowCat['SUB_CONTENT_CAT_DESC_LOC'];
		} else if ($_SESSION['LANG'] == 'EN') {
			$catName = $rowCat['SUB_CONTENT_CAT_DESC_ENG'];
		}
	}
} else {
	$sqlCategory = "select CONTENT_CAT_ID ,
											CONTENT_CAT_DESC_LOC ,
											CONTENT_CAT_DESC_ENG from trn_content_category where CONTENT_CAT_ID	= $CID ";
	$rsCat = mysql_query($sqlCategory) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) {
		if ($_SESSION['LANG'] == 'TH') {
			$catName = $rowCat['CONTENT_CAT_DESC_LOC'];
		} else if ($_SESSION['LANG'] == 'EN') {
			$catName = $rowCat['CONTENT_CAT_DESC_ENG'];
		}
	}
}
?>
			<div class="box-category-main news BGray">
				<div class="box-title cf">
					<h2><?=$catName ?></h2>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">
						<?php

						$getContentSql  = "SELECT ".$LANG_SQL;
						$getContentSql .= "  ,	cat.CONTENT_CAT_ID,
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
											AND cat.flag  = 0
											AND cat.CONTENT_CAT_ID = $CID ";
						if (isset($_GET['SCID']))
							$getContentSql .= " AND content.SUB_CAT_ID = $SCID ";
						$getContentSql .= " AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0";

												
						
						$getContentSql .= $search_sql." 	ORDER BY
												content.ORDER_DATA desc
											Limit 9 offset  " . (9 * ($currentPage - 1));

						$i = 1;

						$rsContent = mysql_query($getContentSql) or die(mysql_error());
						$rowCount = mysql_num_rows($rsContent);
						while ($rowContent = mysql_fetch_array($rsContent)) {
							$extraClass = '';
							if ($i == 2 || $i == 5 || $i == 8) {
								$extraClass = ' mid';
							}

							if ($i == 4 || $i == 7)
								echo '<hr class="line-gray"/>';


							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 'km-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'].'&link=reseach';
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' .$rowContent['CONTENT_ID'];
							$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
							$tw_link = $fullpath;

							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="km-detail.php?MID=' . $MID . '&CID=' . $CID . '&CONID=' . $rowContent['CONTENT_ID'] . '&PG=' . $currentPage . '&link=reseach"> ';
							echo ' <div class="box-pic"> ';
							echo '	<img style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';

							echo ' <div class="box-text">';
							echo ' <a href="km-detail.php?MID=' . $MID . '&CID=' . $CID . '&CONID=' . $rowContent['CONTENT_ID'] . '&PG=' . $currentPage . '&link=reseach">';
							echo ' <p class="text-title TcolorRed">';
							echo $rowContent['CONTENT_DESC'];
							echo ' </p> </a>';
							echo ' <p class="text-date TcolorGray">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo ' </p>';

							echo ' <p class="text-des TcolorBlack">';
							echo $rowContent['BRIEF_LOC'];
							echo ' </p>';
							echo ' <div class="box-btn cf">';
							echo ' <a href="km-detail.php?MID=' . $MID . '&CID=' . $CID . '&CONID=' . $rowContent['CONTENT_ID'] . '&PG=' . $currentPage . '&link=reseach" class="btn red">อ่านเพิ่มเติม</a>';

							echo ' <div class="box-btn-social cf">';
							echo ' <a href="'.$fb_link.'" onclick="shareFB(\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
							echo ' <a href="'.$fullpath.'" onclick="shareTW(\''.$rowContent['CONTENT_ID'].'\',\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';
							echo ' </div>';

							$i++;

						}
						?>

					</div>
					<div class="box-pagination-main cf">
						<ul class="pagination">
							<?php

							$countContentSql = "SELECT
												count(1)
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $MID
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $CID ";
							if (isset($_GET['SCID']))
								$countContentSql .= " AND content.SUB_CAT_ID = $SCID ";
							$countContentSql .= " AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
											ORDER BY
												content.ORDER_DATA desc ";

							$query = mysql_query($countContentSql, $conn);

							$contentCount = mysql_num_rows($query);

							$maxPage = ceil($contentCount / 9);

							$extraClass = '';
							if ($currentPage == 1) {
								$extraClass = 'class="deactive"';
							}
							echo $pageStart;
							echo '<li ' . $extraClass . '><a href="' . $currentParam . '&PG=' . ($currentPage - 1) . '" class="btn-arrow-left"></a></li>';

							for ($idx = 0; $idx < 3; $idx++) {
								if (($currentPage + $idx) > $maxPage)
									break;
								$activeClass = '';
								if ($idx == 0) {
									$activeClass = ' class="active"';
								}
								echo '<li ' . $activeClass . '><a href="' . $currentParam . '&PG=' . ($currentPage + $idx) . '">' . ($currentPage + $idx) . '</a></li>';
							}
							$extraClassAtEnd = '';
							if (($currentPage + 1) >= $maxPage) {
								$extraClassAtEnd = 'class="deactive"';
							}
							echo '<li ' . $extraClassAtEnd . '><a href="' . $currentParam . '&PG=' . ($currentPage + 1) . '" class="btn-arrow-right"></a></li>';
							?>
						</ul>
					</div>
				</div>
			</div>



		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php
include ('inc/inc-footer.php');
include ('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>