<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require("inc/inc-cat-id-conf.php");

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
		// $(".menutop li.menu6,.menu-left li.menu2").addClass("active");
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

//get Module ID
if ((!isset($_GET['MID'])) OR ($_GET['MID'] == '')){
	$MID = $visual_exhibition;
}else{
	$MID = $_GET['MID'];
}

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_LOC AS CAT_DESC , content.CONTENT_DESC_LOC AS CONTENT_DESC , content.BRIEF_LOC AS BRIEF_LOC";
	$LANG_SQL_CAT = "CONTENT_CAT_DESC_LOC AS CAT_DESC";
	$LANG_SQL_SUB_CAT = "SUB_CONTENT_CAT_DESC_LOC AS CAT_DESC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
	$LANG_SQL_CAT = "CONTENT_CAT_DESC_ENG AS CAT_DESC";
	$LANG_SQL_SUB_CAT = "SUB_CONTENT_CAT_DESC_ENG AS CAT_DESC";
}

?>
<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="ve.php">ระบบจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">นิทรรศการ</li>
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
$permanent_exhibition_show = true;
$temporary_exhibition_show = array();
$temporary_exhibition_log = array();

//query name cat
$sql = "SELECT ".$LANG_SQL_SUB_CAT." , SUB_CONTENT_CAT_ID FROM trn_content_sub_category WHERE FLAG = 0 AND CONTENT_CAT_ID = ".$style_exhibition;
$query = mysql_query($sql, $conn);
while($row = mysql_fetch_array($query)){
$cat_name[$row['SUB_CONTENT_CAT_ID']] = $row['CAT_DESC'];
}

     $sqlCategory = "SELECT ".$LANG_SQL." ,
			cat.CONTENT_CAT_ID, content.CONTENT_ID, content.EVENT_START_DATE, content.EVENT_END_DATE, content.CREATE_DATE , content.LAST_UPDATE_DATE, content.SUB_CAT_ID,
			IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
			FROM trn_content_category cat INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
			WHERE cat.flag = 0 AND cat.REF_MODULE_ID = ".$MID." AND cat.CONTENT_CAT_ID = ".$style_exhibition." AND content.APPROVE_FLAG = 'Y' AND content.CONTENT_STATUS_FLAG = 0 ";
	$sqlCategory .= $search_sql." ORDER BY content.SUB_CAT_ID desc , content.ORDER_DATA desc";

	$query_Category = mysql_query($sqlCategory, $conn);
	while ($row_Category = mysql_fetch_array($query_Category)) {

			$row_Category['CONTENT_DESC'] = htmlspecialchars($row_Category['CONTENT_DESC']);
			$path = 've-detail.php?MID=' . $MID . '%26CID=' . $row_Category['CONTENT_CAT_ID'] . '%26CONID=' . $row_Category['CONTENT_ID'];
			$fullpath = _FULL_SITE_PATH_ . '/' . $path;
			$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row_Category['CONTENT_ID'];
			$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
			$tw_link = $fullpath;

		if(($permanent_exhibition_show) && ($row_Category['SUB_CAT_ID'] == $permanent_exhibition)){

			$permanent_exhibition_show = false;
?>
			<div class="box-category-main news BBlack w100">
				<div class="box-title cf">
					<h2><?=$cat_name[$row_Category['SUB_CAT_ID']]?></h2>
					<div class="box-btn">
						<a href="ve-permanent.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<div class="box-tumb cf">
							<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['CONTENT_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>&link=exh">
								<div class="box-pic">
									<img src="<?=callThumbListFrontEnd($row_Category['CONTENT_ID'], $row_Category['CONTENT_CAT_ID'], true)?>">
								</div>
							</a>
							<div class="box-text">
								<div class="wrap">
									<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['CONTENT_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>&link=exh">
										<p class="text-title"><?=$row_Category['CONTENT_DESC']?></p>
									</a>
									<p class="text-date"><?=ConvertDate($row_Category['LAST_DATE'])?></p>
									<p class="text-des"><?=$row_Category['BRIEF_LOC']?></p>
									<div class="box-btn cf">
										<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['CONTENT_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>&link=exh" class="btn red">อ่านเพิ่มเติม</a>
										<div class="box-btn-social cf">
										<?php
										echo ' <a href="'.$fb_link.'" onclick="shareFB(\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
										echo ' <a href="'.$fullpath.'" onclick="shareTW(\''.$row_Category['CONTENT_ID'].'\',\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
										?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?  	}else if(($temporary_exhibition_show[$row_Category['SUB_CAT_ID']] < 9) && ($row_Category['SUB_CAT_ID'] != $permanent_exhibition)){
			$temporary_exhibition_show[$row_Category['SUB_CAT_ID']]++;
			$index = $temporary_exhibition_show[$row_Category['SUB_CAT_ID']];

			if ($index == 2 || $index == 5 || $index == 8) {
				$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-tumb cf mid">';
			}else{
				$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-tumb cf">';
			}


			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<a href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['CONTENT_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'&link=exh">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-pic">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<img src="';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= callThumbListFrontEnd($row_Category['CONTENT_ID'], $row_Category['CONTENT_CAT_ID'], true);
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '" /></div>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</a>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-text">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<a href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['CONTENT_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'&link=exh">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<p class="text-title TcolorRed">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= $row_Category['CONTENT_DESC'];
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</p>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</a>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<p class="text-date TcolorGray">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= ConvertDate($row_Category['LAST_DATE']);
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</p>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<p class="text-des TcolorBlack">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= $row_Category['BRIEF_LOC'];
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</p>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-btn cf">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<a class="btn red" href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['CONTENT_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'&link=exh">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= 'อ่านเพิ่มเติม</a>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '<div class="box-btn-social cf">';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= ' <a href="'.$fb_link.'" onclick="shareFB(\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= ' <a href="'.$fullpath.'" onclick="shareTW(\''.$row_Category['CONTENT_ID'].'\',\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</div>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</div>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</div>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= '</div>';
			$temporary_exhibition_log[$row_Category['SUB_CAT_ID']] .= "\n\n";
		}

}
foreach ($temporary_exhibition_log as $key => $value) {
?>
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2><?=$cat_name[$key]?></h2>
					<div class="box-btn">
						<a href="ve-temporary.php?c=<?=$key?>" class="btn black">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?=$value?>
					</div>
				</div>
			</div>
<?	}
?>

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
include ('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>