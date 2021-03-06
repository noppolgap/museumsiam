<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

unset($_SESSION['text']);

$search_sql = "";
if (isset($_GET['search'])) {
	if (isset($_POST['str_search']))
		$_SESSION['text'] = $_POST['str_search'];
	$search_sql .= " AND (content.CONTENT_DESC_LOC like '%" . $_SESSION['text'] . "%' or  content.CONTENT_DESC_ENG like '%" . $_SESSION['text'] . "%')";
}
?>
<!doctype html>
<html>
<head>
<?
require ('inc_meta.php');
 ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script>
	$(document).ready(function() {
		$(".menutop li.menu5,.menu-left li.menu1,.menu-left li.menu1 .submenu1").addClass("active");
		if ($('.menu-left li.menu1').hasClass("active")) {
			$('.menu-left li.menu1').children(".submenu-left").css("display", "block");
		}
	});
</script>

</head>

<body>

<?php
include ('inc/inc-top-bar.php');
 ?>
<?php
include ('inc/inc-menu.php');
 ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php"><?=$newsAndEventCap ?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php"><?=$activityNewsMuseumCap ?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$activityMuseumCap ?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
			include ('inc/inc-left-content-newsevent.php');
 ?>
			<?php
			include ('inc/inc-left-content-calendar.php');
 ?>
		</div>
		<div class="box-right main-content">

			<div class="box-category-main news">
				<div class="box-title cf">
					<h2><?=$activityMuseumCap ?></h2>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">

					<?php

					if (!isset($_GET['MID']))
						$MID = $new_and_event;
					else
						$MID = $_GET['MID'];

					$index = 1;
					$categoryID = $museum_event_cat_id;

					if ($_SESSION['LANG'] == 'TH') {
						$LANG_SQL = 'cat.CONTENT_CAT_DESC_LOC AS CONTENT_CAT_LOC , content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
					} else if ($_SESSION['LANG'] == 'EN') {
						$LANG_SQL = 'cat.CONTENT_CAT_DESC_ENG AS CONTENT_CAT_LOC , content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
					}

					$sql = " SELECT ";
					$sql .= $LANG_SQL;
					$sql .= " 			cat.CONTENT_CAT_ID,
												content.SUB_CAT_ID,
												content.CONTENT_ID,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
											FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $new_and_event
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $museum_event_cat_id
											AND content.SUB_CAT_ID = $event_sub_cat_id
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 ";

					$sql .= $search_sql . " ORDER BY content.ORDER_DATA desc LIMIT 0,30 ";

					$query = mysql_query($sql, $conn);

					while ($row = mysql_fetch_array($query)) {

						$IMG_PATH = str_replace("../../", "", $row['IMG_PATH']);

						$gap = "";
						if ($index == 2) {
							$gap = "mid";
						}

						$date = ConvertBoxDate($row['EVENT_START_DATE']);
						$dateEnd = ConvertBoxDate($row['EVENT_END_DATE']);

						/*social*/
						$path = 'event-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26SID=' . $row['SUB_CAT_ID'] . '%26CONID=' . $row['CONTENT_ID'];
						$fullpath = _FULL_SITE_PATH_ . '/' . $path;
						$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row['CONTENT_ID'];
						$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
						$path = str_replace("%26", "&amp;", $path);

						$title = htmlspecialchars(trim($row['CONTENT_LOC']));
						$detail = strip_tags(trim($row['CONTENT_BRIEF']));
						/*social*/

						echo '<div class="box-tumb ' . $gap . ' ">';
						echo '<a href="event-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&SID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '">';
						echo '<div class="box-pic">';
						echo '<img style="max-height: 186px;height: 186px;" src="' . callThumbListFrontEnd($row['CONTENT_ID'], $row['CONTENT_CAT_ID'], true) . '">';
						// echo '<div class="box-tag-cate">';
						// echo $title;
						// echo '</div>';
						echo '<div class="box-date-tumb type2">';
						echo '<p class="date">' . $date[0] . '-' . $dateEnd[0] . '</p>';
						echo '<p class="month">' . $date[1] . '-' . $dateEnd[1] . '</p>';
						echo '</div>';
						echo '</div>';
						echo '</a>';
						echo '<div class="box-text">';
						echo '<a href="event-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&SID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '">';
						echo '<p class="text-title TcolorRed">';
						echo $title;
						echo '</p>';
						echo '</a>';
						echo '<p class="text-date TcolorGray">';
						echo ConvertDate($row['LAST_DATE']);
						echo '</p>';
						echo '<p class="text-des TcolorBlack">';
						echo $detail;
						echo '</p>';
						echo '<div class="box-btn cf">';
						echo '<a href="event-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&SID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '" class="btn red">' . $txt_more . '</a>';
						echo '<div class="box-btn-social cf">';
						echo '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
						echo '<a href="' . $fullpath . '" onclick="shareTW(\'' . $row_row1['CONTENT_ID'] . '\',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';

						if ($index == 3) {
							echo '<hr class="line-gray"/>';
							$index = 0;
						}
						$index++;
					}
					?>

					</div>
					<div class="box-pagination-main cf">
						<ul class="pagination">
					<?php

					$countContentSql = "SELECT count(1) as ROW_COUNT FROM
												trn_content_category cat
											INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
											WHERE
												cat.REF_MODULE_ID = $new_and_event
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = $museum_event_cat_id
											AND content.SUB_CAT_ID = $event_sub_cat_id
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 ";

					$countContentSql .= $search_sql;

					$queryCount = mysql_query($countContentSql, $conn);

					$dataCount = mysql_fetch_assoc($queryCount);

					$contentCount = $dataCount['ROW_COUNT'];

					$maxPage = ceil($contentCount / 30);

					$extraClass = '';
					if (nvl($currentPage,-1))
						$currentPage = 1;
					if ($currentPage == 1) {
						$extraClass = 'class="deactive"';
					}
					echo $pageStart;
					echo '<li ' . $extraClass . '><a href="?PG=' . ($currentPage - 1) . '" class="btn-arrow-left"></a></li>';

					for ($idx = 0; $idx < 3; $idx++) {
						if (($currentPage + $idx) > $maxPage)
							break;
						$activeClass = '';
						if ($idx == 0) {
							$activeClass = ' class="active"';
						}
						echo '<li ' . $activeClass . '><a href="?PG=' . ($currentPage + $idx) . '">' . ($currentPage + $idx) . '</a></li>';
					}
					$extraClassAtEnd = '';
					if (($currentPage + 1) >= $maxPage) {
						$extraClassAtEnd = 'class="deactive"';
					}
					echo '<li ' . $extraClassAtEnd . '><a href="?PG=' . ($currentPage + 1) . '" class="btn-arrow-right"></a></li>';
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
 ?>
<?php
include ('inc/inc-social-network.php');
 ?>

</body>
</html>
<? CloseDB(); ?>
