<?php

if(isset($_POST['connect'])){
	include ("assets/configs/config.inc.php");
	include ("assets/configs/connectdb.inc.php");
	include ("assets/configs/function.inc.php");
	include ("inc/inc-cat-id-conf.php");
	if($_SESSION['LANG'] == 'TH')
		include ("inc/inc-th-lang.php");
	else
		include ("inc/inc-en-lang.php");
}

$whereDate = " AND (EVENT_START_DATE <= '" . date('Y-m-d') . "' AND EVENT_END_DATE >= '" . date('Y-m-d') . "')";
$sqlCount = " select * from trn_manual_event_order where EVENT_DATE = DATE(NOW()) ";

// $whereDate = " AND (EVENT_START_DATE <= '" . $first_date . "' AND EVENT_END_DATE >= '" . $first_date . "')";
// $sqlCount = " select * from trn_manual_event_order where EVENT_DATE = DATE('".$first_date."') ";
if (isset($_POST['date'])) {
	$whereDate = " AND (EVENT_START_DATE <= '" . $_POST['date'] . "' AND EVENT_END_DATE >= '" . $_POST['date'] . "')";
	$sqlCount = " select * from trn_manual_event_order where EVENT_DATE = DATE('" . $_POST['date'] . "') ";
}
//echo $conn  ;

$query_MaualOrder = mysql_query($sqlCount, $conn);
$num_rows_MaualOrder = mysql_num_rows($query_MaualOrder);
$hasManualOrder = FALSE;
if ($num_rows_MaualOrder > 0)
	$hasManualOrder = TRUE;

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = 'content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF , content.PLACE_DESC_LOC as PLACE_DESC ,';
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = 'content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,content.PLACE_DESC_ENG as PLACE_DESC ,';
}
$MID = $new_and_event;
if ($hasManualOrder) {
	$sql = " SELECT ";
	$sql .= $LANG_SQL;
	$sql .= " 			content.SUB_CAT_ID,
												content.CAT_ID,
												content.CONTENT_ID,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE ,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
											FROM
												trn_content_detail AS content
											LEFT JOIN trn_manual_event_order manualOrder
												on manualOrder.CONTENT_ID = content.CONTENT_ID
											WHERE
											    content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0
											and content.SUB_CAT_ID  in ( " . $event_sub_cat_id . " , " . $museumDataNetworkEventSubCat . " ) ".
											" AND content.CAT_ID in (select CONTENT_CAT_ID from trn_content_category
where
REF_MODULE_ID = " . $new_and_event . " )";
	$sql .= $whereDate;
	$sql .= " ORDER BY manualOrder.ORDER_DATA desc Limit 20 offset 0";

} else {
	$sql = " SELECT ";
	$sql .= $LANG_SQL;
	$sql .= " 			content.SUB_CAT_ID,
												content.CAT_ID,
												content.CONTENT_ID,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE,
												IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
											FROM
												trn_content_detail AS content
											WHERE
											    content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0
											and content.SUB_CAT_ID  in ( " . $event_sub_cat_id . " , " . $museumDataNetworkEventSubCat . " ) ".
											" AND content.CAT_ID in (select CONTENT_CAT_ID from trn_content_category
where
REF_MODULE_ID = " . $new_and_event . " )";
	$sql .= $whereDate;
	$sql .= " ORDER BY content.MUSUEM_ID asc , content.ORDER_DATA desc Limit 20 offset 0";
}
//echo $sql;

$query_event = mysql_query($sql, $conn);
while ($row = mysql_fetch_array($query_event)) {

	$date = ConvertBoxDate($row['EVENT_START_DATE']);
	/*social*/
	$path = 'event-detail.php?MID=' . $MID . '%26CID=' . $row['CAT_ID'] . '%26SID=' . $row['SUB_CAT_ID'] . '%26CONID=' . $row['CONTENT_ID'];
	$fullpath = _FULL_SITE_PATH_ . '/' . $path;
	$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row['CONTENT_ID'];
	$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
	$path = str_replace("%26", "&amp;", $path);

	$title = htmlspecialchars(trim($row['CONTENT_LOC']));
	$detail = strip_tags(trim($row['CONTENT_BRIEF']));
	/*social*/
	$dt = new DateTime($_POST['date']);

	if ($_SESSION['LANG'] == 'TH') {
		$Month = returnThaiMonth($dt -> format("m"));
		$DayOfWeek = returnThaiDayOfWeek($dt -> format("l"));
		$shortMonth = returnThaiShortMonth($dt -> format("m"));
	} else if ($_SESSION['LANG'] == 'EN') {
		$Month = $dt -> format("F");
		$shortMonth = $dt -> format("M");
		$DayOfWeek = $dt ->  format("D");//format("l");
	}


?>
<div class="box-content-slide cf">
	<div class="box-left">
		<div class="box-date cf <?=strtolower($dt -> format("D"))?>">
			<div class="box-left">
				<p>
					<?=$dt -> format("j")?>
				</p>
			</div>
			<div class="box-right">
				<p>
					<?=$DayOfWeek?>
					<br>
					<span><?=$shortMonth?> <?=ShowYear($row['EVENT_START_DATE'])?></span>
				</p>
			</div>
		</div>
		<div class="box-text">
			<a href="">
			<p class="text-title TcolorRed">
				<?=$title?>
			</p> </a>
			<p class="text-date TcolorGray">
				<?=ConvertDate($row['LAST_DATE'])?>
			</p>
			<p class="text-des TcolorBlack">
				<?=$detail?>
			</p>
			<div class="box-btn cf">
				<a href="event-detail.php?MID=<?=$MID?>&CID=<?=$row['CAT_ID']?>&SID=<?=$row['SUB_CAT_ID']?>&CONID=<?=$row['CONTENT_ID']?>" class="btn red"><?=$seeAllCap?></a>
				<div class="box-btn-social cf">
<?php
					echo ' <a href="'.$fb_link.'" onclick="shareFB(\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
					echo ' <a href="'.$fullpath.'" onclick="shareTW(\''.$rowContent['CONTENT_ID'].'\',\''.$rowContent['CONTENT_DESC'].'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
?>
				</div>
			</div>
		</div>
	</div>
	<div class="box-right">
		<a href="event-detail.php?MID=<?=$MID?>&CID=<?=$row['CAT_ID']?>&SID=<?=$row['SUB_CAT_ID']?>&CONID=<?=$row['CONTENT_ID']?>">



		<div class="box-pic wrapperA" style="background-image: url('<?=callThumbListFrontEnd($row['CONTENT_ID'], $row['CAT_ID'], true)?>');">
			<!-- <img src="<?=callThumbListFrontEnd($row['CONTENT_ID'], $row['CAT_ID'], true)?>"> -->
		</div>
		<div class="box-tag-cate">
			<?=$row['PLACE_DESC']?>
		</div> </a>
	</div>
</div>



<?}?>