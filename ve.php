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
<link rel="stylesheet" type="text/css" href="css/ve.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu1").addClass("active");
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
	$LANG_SQL_CAT = "SUB_CONTENT_CAT_DESC_LOC AS CAT_DESC";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "cat.CONTENT_CAT_DESC_ENG AS CAT_DESC , content.CONTENT_DESC_ENG AS CONTENT_DESC , content.BRIEF_ENG AS BRIEF_LOC";
	$LANG_SQL_CAT = "SUB_CONTENT_CAT_DESC_ENG AS CAT_DESC";
}

?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบพิพิธภัณฑ์เสมือนจริง</li>
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
$temporary_exhibition_show = 0;
$temporary_exhibition_log = '';

//query name cat
$sql = "SELECT ".$LANG_SQL_CAT." , SUB_CONTENT_CAT_ID FROM trn_content_sub_category WHERE FLAG = 0 AND CONTENT_CAT_ID = ".$style_exhibition;
$query = mysql_query($sql, $conn);
while($row = mysql_fetch_array($query)){
$cat_name[$row['SUB_CONTENT_CAT_ID']] = $row['CAT_DESC'];
}

$sqlCategory = "SELECT ".$LANG_SQL." ,
			cat.CONTENT_CAT_ID, content.CONTENT_ID, content.EVENT_START_DATE, content.EVENT_END_DATE, content.CREATE_DATE , content.LAST_UPDATE_DATE, content.SUB_CAT_ID,
			IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
			FROM trn_content_category cat INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
			WHERE cat.REF_MODULE_ID = ".$MID." AND cat.flag = 0 AND cat.CONTENT_CAT_ID = ".$style_exhibition." AND content.APPROVE_FLAG = 'Y' AND content.CONTENT_STATUS_FLAG = 0
			ORDER BY content.SUB_CAT_ID desc , content.ORDER_DATA desc";
	$query_Category = mysql_query($sqlCategory, $conn);
	while ($row_Category = mysql_fetch_array($query_Category)) {

			$row_Category['CONTENT_DESC'] = htmlspecialchars($row_Category['CONTENT_DESC']);
			$path = 've-detail.php?MID=' . $MID . '%26CID=' . $row_Category['SUB_CAT_ID'] . '%26CONID=' . $row_Category['CONTENT_ID'];
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
						<a href="ve-category.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<div class="box-tumb cf">
							<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['SUB_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>">
								<div class="box-pic">
									<img src="<?=callThumbListFrontEnd($row_Category['CONTENT_ID'], $row_Category['CONTENT_CAT_ID'], true)?>">
								</div>
							</a>
							<div class="box-text">
								<div class="wrap">
									<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['SUB_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>">
										<p class="text-title"><?=$row_Category['CONTENT_DESC']?></p>
									</a>
									<p class="text-date"><?=ConvertDate($row_Category['LAST_DATE'])?></p>
									<p class="text-des"><?=$row_Category['BRIEF_LOC']?></p>
									<div class="box-btn cf">
										<a href="ve-detail.php?MID=<?=$MID?>&amp;CID=<?=$row_Category['SUB_CAT_ID']?>&amp;CONID=<?=$row_Category['CONTENT_ID']?>" class="btn red">อ่านเพิ่มเติม</a>
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
<?  	}else if(($temporary_exhibition_show < 3) && ($row_Category['SUB_CAT_ID'] == $temporary_exhibition)){
			$temporary_exhibition_show++;

			if($temporary_exhibition_show == 2){
				$temporary_exhibition_log .= '<div class="box-tumb cf mid">';
			}else{
				$temporary_exhibition_log .= '<div class="box-tumb cf">';
			}


			$temporary_exhibition_log .= '<a href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['SUB_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'">';
			$temporary_exhibition_log .= '<div class="box-pic">';
			$temporary_exhibition_log .= '<img src="';
			$temporary_exhibition_log .= callThumbListFrontEnd($row_Category['CONTENT_ID'], $row_Category['CONTENT_CAT_ID'], true);
			$temporary_exhibition_log .= '" /></div>';
			$temporary_exhibition_log .= '</a>';
			$temporary_exhibition_log .= '<div class="box-text">';
			$temporary_exhibition_log .= '<a href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['SUB_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'">';
			$temporary_exhibition_log .= '<p class="text-title TcolorRed">';
			$temporary_exhibition_log .= $row_Category['CONTENT_DESC'];
			$temporary_exhibition_log .= '</p>';
			$temporary_exhibition_log .= '</a>';
			$temporary_exhibition_log .= '<p class="text-date TcolorGray">';
			$temporary_exhibition_log .= ConvertDate($row_Category['LAST_DATE']);
			$temporary_exhibition_log .= '</p>';
			$temporary_exhibition_log .= '<p class="text-des TcolorBlack">';
			$temporary_exhibition_log .= $row_Category['BRIEF_LOC'];
			$temporary_exhibition_log .= '</p>';
			$temporary_exhibition_log .= '<div class="box-btn cf">';
			$temporary_exhibition_log .= '<a class="btn red" href="ve-detail.php?MID='.$MID.'&amp;CID='.$row_Category['SUB_CAT_ID'].'&amp;CONID='.$row_Category['CONTENT_ID'].'">';
			$temporary_exhibition_log .= 'อ่านเพิ่มเติม</a>';
			$temporary_exhibition_log .= '<div class="box-btn-social cf">';
			$temporary_exhibition_log .= ' <a href="'.$fb_link.'" onclick="shareFB(\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
			$temporary_exhibition_log .= ' <a href="'.$fullpath.'" onclick="shareTW(\''.$row_Category['CONTENT_ID'].'\',\''.$row_Category['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
			$temporary_exhibition_log .= '</div>';
			$temporary_exhibition_log .= '</div>';
			$temporary_exhibition_log .= '</div>';
			$temporary_exhibition_log .= '</div>';
			$temporary_exhibition_log .= "\n\n";
		}
		if(($temporary_exhibition_show == 3) && (!$permanent_exhibition_show)){
			break;
		}
} ?>
			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2><?=$cat_name[$temporary_exhibition]?></h2>
					<div class="box-btn">
						<a href="ve-category.php" class="btn black">ดูทั้งหมด ++ </a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf ">
						<?=$temporary_exhibition_log?>
					</div>
				</div>
			</div>

			<div class="box-category-main news BGray">
				<div class="box-title cf ">
					<h2>พิพิธภัณฑ์เครือข่ายและพิพิธภัณฑ์ที่น่าสนใจ</h2>
					<div class="box-btn">
						<a href="ve-category.php" class="btn black">ดูทั้งหมด</a>
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
					<h2>Museum tour</h2>
					<div class="box-btn">
						<a href="ve-category.php" class="btn black">ดูทั้งหมด</a>
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