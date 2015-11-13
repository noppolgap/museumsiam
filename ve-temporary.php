<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {
		if (isset($_POST['str_search'])){
			$_SESSION['text'] = $_POST['str_search'];
			$search_sql = " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%'or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')  ";
		}
	}

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/ve.css" />

<script>
	$(document).ready(function(){
		// $(".menutop li.menu6,.menu-left li.menu2,.menu-left li.menu2 .submenu2").addClass("active");
			// if ($('.menu-left li.menu2').hasClass("active")){
				// $('.menu-left li.menu2').children(".submenu-left").css("display","block");
			// }
	});
</script>

</head>

<body id="km">

<?php
include('inc/inc-top-bar.php');
include('inc/inc-menu.php');

$MID = $visual_exhibition;//$_GET['MID'];
$CID = intval($_GET['c']);//$_GET['CID'];
if($CID == 0){
	$CID = $style_exhibition;
}


$SCID = "-1";
if (isset($_GET['SCID']))
	$SCID = $_GET['SCID'];
else 
	$SCID = $temporary_exhibition ; 

$currentPage = 1;
if (isset($_GET['PG']))
	$currentPage = $_GET['PG'];

if ($currentPage < 1)
	$currentPage = 1;


$catName = "";

if (isset($_SESSION['VE_PREV_PG'])){
				$backPage = $_SESSION['VE_PREV_PG'] ;
				}
else
	{
		$backPage = "ve-temporary.php?MID=".$visual_exhibition;
	}
//$backPage = "km.php?MID=" . $MID . "&CID=" . $CID;
$currentParam = "?MID=" . $MID . "&CID=" . $CID;
//if (isset($_GET['SCID'])) {
	//$backPage .= "$SCID=" . $SCID;
	$currentParam .= "&SCID=" . $SCID;
//}

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_LOC AS CAT_DESC , content.CONTENT_DESC_LOC AS CONTENT_DESC , content.BRIEF_LOC AS BRIEF_LOC";
	$LANG_SQL_SUB_CAT = "SUB_CONTENT_CAT_DESC_LOC AS CAT_DESC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
	$LANG_SQL_SUB_CAT = "SUB_CONTENT_CAT_DESC_ENG AS CAT_DESC";
}

?>
<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php"><?=$otherSystemCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="ve.php">ระบบจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="ve-exhibition.php">นิทรรศการ</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">นิทรรศการชั่วคราว</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-ve.php'); ?>
		</div>
		<div class="box-right main-content">
<?php


//query name cat
$sql = "SELECT ".$LANG_SQL_SUB_CAT." , SUB_CONTENT_CAT_ID FROM trn_content_sub_category WHERE FLAG = 0 AND SUB_CONTENT_CAT_ID = ".$SCID;
$query = mysql_query($sql, $conn);
$row = mysql_fetch_array($query);
$cat_name = $row['CAT_DESC'];

?>
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2><?=$cat_name?></h2>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">

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
											AND content.CAT_ID = $CID ";
						if (isset($_GET['SCID']))
							$getContentSql .= " AND content.SUB_CAT_ID = $SCID ";
						 	$getContentSql .= " AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 ";
							$getContentSql .= $search_sql."ORDER BY
												content.ORDER_DATA desc
											Limit 9 offset  " . (9 * ($currentPage - 1));

//echo $getContentSql;
					//	echo 'Page '.$currentPage.' Command'. $getContentSql;
						$i = 1;

						$rsContent = mysql_query($getContentSql) or die(mysql_error());
						$rowCount = mysql_num_rows($rsContent);
						while ($rowContent = mysql_fetch_array($rsContent)) {
							$extraClass = '';
							if ($i == 2 || $i == 5 || $i == 8) {
								$extraClass = ' mid';
							}

							if ($i  == 4 || $i == 7)
								echo '<hr class="line-gray"/>';



							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 've-detail.php?MID=' . $MID . '%26CID=' . $CID . '%26CONID=' . $rowContent['CONTENT_ID'];
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' .$rowContent['CONTENT_ID'];
							$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
							$tw_link = $fullpath;

							echo '<div class="box-tumb cf' . $extraClass . '">';
							echo '<a href="ve-detail.php' . $currentParam . '&CONID=' . $rowContent['CONTENT_ID'] . '&PG='.$currentPage.'&link=temp"> ';
							echo ' <div class="box-pic"> ';
							echo '	<img style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
							echo ' </div> </a> ';

							echo ' <div class="box-text">';
							echo ' <a href="ve-detail.php' . $currentParam . '&CONID=' . $rowContent['CONTENT_ID']. '&PG='.$currentPage.'&link=temp">';
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
							echo ' <a href="ve-detail.php' . $currentParam . '&CONID=' . $rowContent['CONTENT_ID']  . '&PG='.$currentPage.'&link=temp" class="btn red">'.$readMoreCap.'</a>';

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