<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
require ('inc_meta.php');

	$search_sql = "";
	unset($_SESSION['text']);

	if (isset($_GET['search'])) {
			if (isset($_POST['str_search'])){
				$_SESSION['text'] = $_POST['str_search'];
				$search_sql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
			}
	}

?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/da.css" />

<script>
	$(document).ready(function() {
		$(".menutop li.menu6").addClass("active");
	});
</script>

</head>

<body id="km">

<?php
include ('inc/inc-top-bar.php');
include ('inc/inc-menu.php');

//get Module ID
if ((!isset($_GET['MID'])) OR ($_GET['MID'] == '')){
	$MID = $digial_module_id;
}else{
	$MID = $_GET['MID'];
}


if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_LOC AS CAT_DESC , content.CONTENT_DESC_LOC AS CONTENT_DESC , content.BRIEF_LOC AS BRIEF_LOC";
	$LANG_SQL_Category = "CONTENT_CAT_DESC_LOC AS CAT_DESC_LOG";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
	$LANG_SQL_Category = "CONTENT_CAT_DESC_ENG AS CAT_DESC_LOG";
}

?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
		<?	include ('inc/inc-da-black-breadcrumbs.php'); ?>
			<!-- <ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">คลังความรู้</li>
			</ol> -->
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
<?php
			include ('inc/inc-left-content-da.php');
 ?>
		</div>
		<div class="box-right main-content">

			<div class="box-category-main news BBlack">


				<?php

				$sqlStr = " SELECT ".$LANG_SQL_Category.",
									CONTENT_CAT_ID,
									LINK_URL,
									IS_LAST_NODE,
									REF_SUB_MODULE_ID
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = $digial_module_id
							AND FLAG = 0
							AND ORDER_DATA = (
								SELECT
									max(ORDER_DATA)
								FROM
									trn_content_category
								WHERE
									REF_MODULE_ID = $digial_module_id
								AND FLAG = 0
							)";

				$rsCat = mysql_query($sqlStr) or die(mysql_error());
				$rowCat = mysql_fetch_array($rsCat);
				?>
				<div class="box-title cf">
					<h2><?=$rowCat['CAT_DESC_LOG'] ?></h2>
					<div class="box-btn">
						<?php
						$pageNext = '';

						if ($rowCat['IS_LAST_NODE'] == 'Y'){
							$pageNext = 'da-all-black.php';
							}
						else{
							$pageNext = 'da-category-black.php';

						}
						?>
						<a href="<?=$pageNext ?>?MID=<?=$digial_module_id ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?php
						$contentSql = " SELECT ".$LANG_SQL.",
												cat.CONTENT_CAT_ID,
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
												cat.REF_MODULE_ID = $digial_module_id
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'];
						$contentSql .= "		AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/";

						$contentSql .= $search_sql." ORDER BY content.ORDER_DATA desc LIMIT 0,3 ";

						$rsContent = mysql_query($contentSql) or die(mysql_error());
						$i = 1;

						$categoryID = $rowCat['CONTENT_CAT_ID'];
						while ($rowContent = mysql_fetch_array($rsContent)) {

							$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}

							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
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
							echo '<p class="text-title">';
							echo $rowContent['CONTENT_DESC'];
							echo '</p>';
							echo '</a>';
							echo '<p class="text-date">';
							echo ConvertDate($rowContent['LAST_DATE']);
							echo '</p>';
							echo '<p class="text-des">';
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

			<div class="box-category-main news BGray2">
				<div class="box-title cf ">
					<?php
				$sqlStr = " SELECT ".$LANG_SQL_Category.",
									CONTENT_CAT_ID,
									LINK_URL,
									IS_LAST_NODE,
									REF_SUB_MODULE_ID
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = $digial_module_id
							AND FLAG = 0
							AND ORDER_DATA = (
								SELECT
									max(ORDER_DATA) -1
								FROM
									trn_content_category
								WHERE
									REF_MODULE_ID = $digial_module_id
								AND FLAG = 0
							)";

					$rsCat = mysql_query($sqlStr) or die(mysql_error());
					$rowCat = mysql_fetch_array($rsCat);
				?>
					<h2><?=$rowCat['CAT_DESC_LOG'] ?></h2>
					<div class="box-btn">
						<?php
						$pageNext = '';

						if ($rowCat['IS_LAST_NODE'] == 'Y'){
							$pageNext = 'da-all-gray.php';
						}
						else{
							$pageNext = 'da-category-gray.php';

						}
						?>

						<a href="<?=$pageNext ?>?MID=<?=$digial_module_id ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">

					<div class="box-tumb-main cf ">

						<?php

						$contentSql = " SELECT ".$LANG_SQL.",
												cat.CONTENT_CAT_ID,
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
												cat.REF_MODULE_ID = $digial_module_id
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'];
						$contentSql .= "		AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/";

						if (isset($_GET['search'])) {
								if (isset($_POST['str_search'])){
									$_SESSION['text'] = $_POST['str_search'];
									$contentSql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
								}
						}
						else {
								unset($_SESSION['text']);
						}
						
						$contentSql .= " ORDER BY content.ORDER_DATA desc LIMIT 0,3 ";

						$rsContent = mysql_query($contentSql) or die(mysql_error());
						$i = 1;
						$categoryID = $rowCat['CONTENT_CAT_ID'];
						while ($rowContent = mysql_fetch_array($rsContent)) {
							$extraClass = '';
							if ($i == 2) {
								$extraClass = ' mid';
							}

							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
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


<!-- Repeat at order > 5 -->

<?php
				$sqlStr = " SELECT ".$LANG_SQL_Category.",
									CONTENT_CAT_ID,
									LINK_URL,
									IS_LAST_NODE,
									REF_SUB_MODULE_ID
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = $digial_module_id
							AND FLAG = 0
							AND ORDER_DATA <= (
								SELECT
									max(ORDER_DATA) -4
								FROM
									trn_content_category
								WHERE
									REF_MODULE_ID = $digial_module_id
								AND FLAG = 0
							)
							ORDER BY ORDER_DATA desc";

$rsCat = mysql_query($sqlStr) or die(mysql_error());

while ($rowCat = mysql_fetch_array($rsCat)) {
	echo '<div class="box-category-main news BGray2">';
	echo '<div class="box-title cf ">';
	echo '<h2>' . $rowCat['CAT_DESC_LOG'] . '</h2>';
	echo '<div class="box-btn">';
	$pageNext = '';
	$extraParam = '' ;
	if ($rowCat['IS_LAST_NODE'] == 'Y'){
		$pageNext = 'da-all-gray.php';
	}
	else{
		$pageNext = 'da-category-gray.php';

	}
	echo '<a href="' . $pageNext . '?MID=' . $digial_module_id . '&CID=' . $rowCat['CONTENT_CAT_ID'] . '" class="btn black">ดูทั้งหมด</a>';
	echo '</div>';
	echo '</div>';
	echo '<div class="box-news-main">';
	echo '<div class="box-tumb-main cf ">';

						$contentSql = " SELECT ".$LANG_SQL.",
												cat.CONTENT_CAT_ID,
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
												cat.REF_MODULE_ID = $digial_module_id
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'];
						$contentSql .= "		AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/";
							
							if (isset($_GET['search'])) {
								if (isset($_POST['str_search'])){
									$_SESSION['text'] = $_POST['str_search'];
									$contentSql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
								}
						}
						else {
								unset($_SESSION['text']);
						}
						
						$contentSql .= " ORDER BY content.ORDER_DATA desc LIMIT 0,3 ";

	$rsContent = mysql_query($contentSql) or die(mysql_error());
	$i = 1;
	 $categoryID = $rowCat['CONTENT_CAT_ID'];
	while ($rowContent = mysql_fetch_array($rsContent)) {
		$extraClass = '';
		if ($i == 2) {
			$extraClass = ' mid';
		}

							$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
							$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
							$fullpath = _FULL_SITE_PATH_ . '/' . $path;
							$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
							$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
							$tw_link = $fullpath;

		echo '<div class="box-tumb cf' . $extraClass . '">';
		echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
		echo '<div class="box-pic">';
		echo '<img style="width:250px;height:187px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '">'; 		echo '</div>';
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

	echo '</div>';
	echo '</div>';
	echo '</div>';
}
				?>




<!-- End Repeat -->
			<div class="box-row-content cf">
				<div class="box-left">
					<div class="box-category-main news BGray2">
						<?php
				$sqlStr = " SELECT ".$LANG_SQL_Category.",
									CONTENT_CAT_ID,
									LINK_URL,
									IS_LAST_NODE,
									REF_SUB_MODULE_ID
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = $digial_module_id
							AND FLAG = 0
							AND ORDER_DATA = (
								SELECT
									max(ORDER_DATA) -2
								FROM
									trn_content_category
								WHERE
									REF_MODULE_ID = $digial_module_id
								AND FLAG = 0
							)";

						$rsCat = mysql_query($sqlStr) or die(mysql_error());
						$rowCat = mysql_fetch_array($rsCat);
				?>
						<div class="box-title cf ">
							<h2><?=$rowCat['CAT_DESC_LOG'] ?></h2>
							<div class="box-btn">
								<?php
								$pageNext = '';
								$extraParam = '';
								if ($rowCat['IS_LAST_NODE'] == 'Y'){
									$pageNext = 'da-all-gray.php';
								}
								else{
									$pageNext = 'da-category-gray.php';

								}
						?>
								<a href="<?=$pageNext ?>?MID=<?=$digial_module_id ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>" class="btn black">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

								<?php

						$contentSql = " SELECT ".$LANG_SQL.",
												cat.CONTENT_CAT_ID,
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
												cat.REF_MODULE_ID = $digial_module_id
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'];
								$contentSql .= "		AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/";
								
								if (isset($_GET['search'])) {
									if (isset($_POST['str_search'])){
										$_SESSION['text'] = $_POST['str_search'];
										$contentSql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
									}
								}
								else {
										unset($_SESSION['text']);
								}
								
								$contentSql .= " ORDER BY content.ORDER_DATA desc LIMIT 0,2 ";

								$categoryID = $rowCat['CONTENT_CAT_ID'];
								$rsContent = mysql_query($contentSql) or die(mysql_error());
								$i = 1;
								while ($rowContent = mysql_fetch_array($rsContent)) {
									$extraClass = '';
									if ($i == 1) {
										$extraClass = ' left';
									}
									$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
									$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
									$fullpath = _FULL_SITE_PATH_ . '/' . $path;
									$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
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
				</div>
				<div class="box-right">
					<div class="box-category-main news BRed">
						<?php
				$sqlStr = " SELECT ".$LANG_SQL_Category.",
									CONTENT_CAT_ID,
									LINK_URL,
									IS_LAST_NODE,
									REF_SUB_MODULE_ID
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = $digial_module_id
							AND FLAG = 0
							AND ORDER_DATA = (
								SELECT
									max(ORDER_DATA) -3
								FROM
									trn_content_category
								WHERE
									REF_MODULE_ID = $digial_module_id
								AND FLAG = 0
							)";

						$rsCat = mysql_query($sqlStr) or die(mysql_error());
						$rowCat = mysql_fetch_array($rsCat);
				?>
						<div class="box-title cf ">
							<h2><?=$rowCat['CAT_DESC_LOG'] ?></h2>
							<div class="box-btn">
								<?php
								$pageNext = '';
								$extraParam ='';
								if ($rowCat['IS_LAST_NODE'] == 'Y'){
									$pageNext = 'da-all-red.php';
								}
								else{
									$pageNext = 'da-category-red.php';
									}
						?>
								<a href="<?=$pageNext ?>?MID=<?=$digial_module_id ?>&CID=<?=$rowCat['CONTENT_CAT_ID'] ?>" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">
								<?php
								$contentSql = " SELECT ".$LANG_SQL.",
												cat.CONTENT_CAT_ID,
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
												cat.REF_MODULE_ID = $digial_module_id
											AND cat.flag = 0
											AND cat.CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'];
						$contentSql .= "		AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/";
						
						if (isset($_GET['search'])) {
								if (isset($_POST['str_search'])){
									$_SESSION['text'] = $_POST['str_search'];
									$contentSql .= " AND (content.CONTENT_DESC_LOC like '%" .$_SESSION['text']. "%' or  content.CONTENT_DESC_ENG like '%" .$_SESSION['text']. "%')";
								}
						}
						else {
								unset($_SESSION['text']);
						}
						
						$contentSql .= " ORDER BY content.ORDER_DATA desc LIMIT 0,1 ";

						$rsContent = mysql_query($contentSql) or die(mysql_error());
						$i = 1;
						$categoryID = $rowCat['CONTENT_CAT_ID'] ;
						while ($rowContent = mysql_fetch_array($rsContent)) {

									$rowContent['CONTENT_DESC'] = htmlspecialchars($rowContent['CONTENT_DESC']);
									$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'];
									$fullpath = _FULL_SITE_PATH_ . '/' . $path;
									$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
									$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
									$tw_link = $fullpath;
							?>
								<div class="box-tumb cf">
									<a href="da-detail.php?MID=<?=$MID ?>&CID=<?=$categoryID ?>&CONID=<?=$rowContent['CONTENT_ID'] ?>">
										<div class="box-pic">
											<img style="width:250px;height:187px;" src="<?=callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) ?>" >
										</div>
									</a>
									<div class="box-text">
										<a href="da-detail.php?MID=<?=$MID ?>&CID=<?=$categoryID ?>&CONID=<?=$rowContent['CONTENT_ID'] ?>">
											<p class="text-title TcolorWhite">
												<?=$rowContent['CONTENT_DESC'] ?>
											</p>
										</a>
										<p class="text-date TcolorGray">
											<?=ConvertDate($rowContent['LAST_DATE']) ?>
										</p>
										<p class="text-des TcolorWhite">
											<?=$rowContent['BRIEF_LOC'] ?>
										</p>
										<div class="box-btn cf">
											<a href="da-detail.php?MID=<?=$MID ?>&CID=<?=$categoryID ?>&CONID=<?=$rowContent['CONTENT_ID'] ?>" class="btn black">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
								<?php
									echo '<a href="'.$fb_link.'" onclick="shareFB(\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
									echo '<a href="'.$fullpath.'" onclick="shareTW(\''.$rowContent['CONTENT_ID'].'\',\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
								?>
											</div>
										</div>
									</div>
								</div>
									<?php } ?>
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

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['DA_PREV_PG'] = $current_url;
?>


<?php
include ('inc/inc-footer.php');
include ('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>