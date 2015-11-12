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

		<link rel="stylesheet" type="text/css" href="css/index.css" />

		<script type="text/javascript" src="js/index.js"></script>

		<script>
			$(document).ready(function() {
				$("li.menu1").addClass("active");
			});
		</script>
		<style type="text/css">
			.wrapperA {
				/*width: 200px;*/
				height: 420px;
				overflow: hidden;
				/*border: solid 1px #9f0000;*/
				/*margin: 0 0 20px 0;*/
				background-size: auto 102%;
				background-position: center center;

			}
		</style>
	</head>

	<body>

		<?php
		include ('inc/inc-top-bar.php');
		?>

		<div class="part-banner" id="firstbox">
			<div class="slide-herobanner">
				<?php
				$heroBannerSql = "SELECT pic_ID, IMG_PATH FROM trn_hero_banner WHERE img_type = 1 ORDER BY ORDER_ID";

				$rsHeroBanner = mysql_query($heroBannerSql) or die(mysql_error());
				while ($rowHeroBanner = mysql_fetch_array($rsHeroBanner)) {
					echo '	<div class="slide" style="background-image: url(' . callHeroBannerFrontEnd($rowHeroBanner['pic_ID'], $rowHeroBanner['IMG_PATH'], true) . ');"></div> ';
				}
				?>
			</div>
		</div>

		<?php
		include ('inc/inc-menu.php');
		?>

		<div  class="part-detail-museum">
			<?php
			include ('inc/inc-detail-museum-th.php');
			?>
		</div>

		<?php
		if ($_SESSION['LANG'] == 'TH')
			$picFolderName = 'th';
		else
			$picFolderName = 'en';
		?>
		<div class="part-event cf">
			<div class="container">
				<div class="box-left">
					<div class="box-date-main cf">
						<div class="text-title">
							<img src="images/<?=$picFolderName ?>/index/part2-pic1.png" />
						</div>
<?php
		 /*
		$Now = date('d');
		list($start_date, $end_date) = x_week_range(date('Y-m-d'));

		$begin = new DateTime( $start_date );
		$end = new DateTime( $end_date );
		$end = $end->modify( '+1 day' );

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		foreach ( $period as $dt ){
			if ($_SESSION['LANG'] == 'TH'){
				$Month = returnThaiMonth($dt->format( "m" ));
				$DayOfWeek = returnThaiDayOfWeek($dt->format( "l" ));
			}else if ($_SESSION['LANG'] == 'EN'){
				$Month = $dt->format( "F" );
				$DayOfWeek = $dt->format( "l" );
			}
			$dayNow = $dt->format( "d" );
			$class  = 'box-tumb-date ';
			$class .= strtolower($dt->format( "D" ));
			if(($dayNow == $Now)){
				$class .= ' today';
			}
		 	 $timestr = $dt->format( "Y-m-d" );


		$first_date = '';
		$first_action = true;

		$Now = date('d');
		$sql_event = "SELECT DISTINCT (content.EVENT_START_DATE) AS START_DATE  FROM trn_content_detail AS content WHERE
				content.APPROVE_FLAG = 'Y' AND content.CONTENT_STATUS_FLAG  = 0 AND DATE(content.EVENT_START_DATE) >= DATE(NOW()) AND
				content.CAT_ID in (select CONTENT_CAT_ID from trn_content_category where REF_MODULE_ID = ".$new_and_event." )
				and content.SUB_CAT_ID  in ( " . $event_sub_cat_id . " , " . $museumDataNetworkEventSubCat . " ) ".
				" ORDER BY EVENT_START_DATE LIMIT 0 , 7";
				//echo $sql_event ;
			    $query_event = mysql_query($sql_event, $conn);
				while($row_event = mysql_fetch_array($query_event)) {
					if($first_action){
						$first_action = false;
						$first_date = $row_event['START_DATE'];
					}

					$time_string = strtotime($row_event['START_DATE']);

					if ($_SESSION['LANG'] == 'TH'){
						$Month = returnThaiMonth(date( "m" , $time_string ));
						$DayOfWeek = returnThaiDayOfWeek(date( "l" , $time_string ));
					}else if ($_SESSION['LANG'] == 'EN'){
						$Month = date( "F" , $time_string );
						$DayOfWeek = date( "D" , $time_string );
					}
					$dayNow = date( "d" , $time_string);
					$class  = 'box-tumb-date ';
					$class .= strtolower(date( "D" , $time_string));
					if(($dayNow == $Now)){
						$class .= ' today';
					}
		 * */
		$dateShow = array();
		$sql_event = "SELECT DATE(content.EVENT_START_DATE) AS START_DATE , DATE(content.EVENT_END_DATE) AS END_DATE
					FROM trn_content_detail AS content WHERE content.APPROVE_FLAG = 'Y'
					AND content.CONTENT_STATUS_FLAG = 0 AND DATE(content.EVENT_START_DATE) >= DATE(NOW())
					AND content.CAT_ID in (select CONTENT_CAT_ID from trn_content_category where REF_MODULE_ID = 12 )
					AND content.SUB_CAT_ID in ( " . $event_sub_cat_id . " , " . $museumDataNetworkEventSubCat . " )
					ORDER BY EVENT_START_DATE LIMIT 0 , 40";
					//echo $sql_event ;
		$query_event = mysql_query($sql_event, $conn);
		while($row_event = mysql_fetch_array($query_event)) {
			$date = $row_event['START_DATE'];
			$end_date = $row_event['END_DATE'];
			while (strtotime($date) <= strtotime($end_date)) {

						$str_to_time = strtotime($date);
		               	$dateShow[] = $str_to_time;
                		$date = date ("Y-m-d", strtotime("+1 day", $str_to_time));

			}
		}

		$result = array_unique($dateShow);
		sort($result);
		for($i=0;$i<7;$i++){
			if($result[$i] != ''){
				$MYDATE = date("Y-m-d", $result[$i]);
				if($first_action){
					$first_action = false;
					$first_date = $MYDATE;
				}

				if ($_SESSION['LANG'] == 'TH'){
					$Month = returnThaiMonth(date( "m" , $result[$i] ));
					$DayOfWeek = returnThaiDayOfWeek(date( "l" , $result[$i] ));
				}else if ($_SESSION['LANG'] == 'EN'){
					$Month = date( "F" , $result[$i] );
					$DayOfWeek = date( "D" , $result[$i] );
				}
				$dayNow = date( "d" , $result[$i]);
				$class  = 'box-tumb-date ';
				$class .= strtolower(date( "D" , $result[$i]));
				if(($dayNow == $Now)){
					$class .= ' today';
				}
		?>
			<a href="#" onclick="loadEvent('<?=$MYDATE?>'); return false;">
				<div class="<?=$class ?>">
					<div class="text-date">
						<?=$DayOfWeek ?>
						<span><?=$dayNow ?></span>
					</div>
					<div class="text-month">
						<?=$Month ?>
					</div>
				</div>
			</a>
		<?
		} }
	?>
<a href="#">
						<div class="box-tumb-date btn-all">
							<div class="box-text">
								<p>
									<?=$seeAllCap ?>
									<span></span>
								</p>
							</div>
						</div> </a>
					</div>
				</div>

				<div class="box-right">
					<div class="box-slideevent-main cf">
						<div class="slide-event cf">
							<?
							include ('index-ajax.php');
 ?>
						</div>

						<div class="box-float">
							<div class="box-btn-left">
								<a class="btn black" href=""><?=$todayEventCap ?></a>
							</div>
							<div class="box-btn-right">
								<a class="btn-arrow left"></a>
								<div class="box-number cf">
									<p class="currentItem">
										<span class="result">30</span>
									</p>
									<p class="ofCenter">
										/
									</p>
									<p class="owlItems">
										<span class="result">00</span>
									</p>
								</div>
								<a class="btn-arrow right"></a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?
		$categoryID = $all_event_cat_id;

		$index = 0;

		$sql_all_exh = " SELECT ";
		if ($_SESSION['LANG'] == 'TH')
			$sql_all_exh .= " content.CONTENT_DESC_LOC as CONTENT_DESC ,content.BRIEF_LOC as CONTENT_BRIEF ,";
		else
			$sql_all_exh .= " content.CONTENT_DESC_ENG as CONTENT_DESC ,content.BRIEF_ENG as CONTENT_BRIEF ,";
		$sql_all_exh .= " cat.CONTENT_CAT_ID,
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
				AND cat.CONTENT_CAT_ID = $all_event_cat_id
				AND content.APPROVE_FLAG = 'Y'
				AND content.CONTENT_STATUS_FLAG  = 0
				ORDER BY
					content.ORDER_DATA desc
				LIMIT 0,4 ";

		$query_all_exh = mysql_query($sql_all_exh, $conn);
		$num_rows = mysql_num_rows($query_all_exh);

		$index = 0;
		while ($row_all_exh = mysql_fetch_array($query_all_exh)) {
			$extraSCID = '';
			if ($row_all_exh['SUB_CAT_ID'] > 0) {
				$extraSCID = '&SID=' . $row_all_exh['SUB_CAT_ID'];
			}

			$path = 'event-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $row_all_exh['CONTENT_ID'] . $extraSCID;
			$fullpath = _FULL_SITE_PATH_ . '/' . $path;
			$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row_all_exh['CONTENT_ID'];
			$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;

			$exh_title[$index] = htmlspecialchars(trim($row_all_exh['CONTENT_DESC']));
			$exh_detail[$index] = strip_tags(trim($row_all_exh['CONTENT_BRIEF']));
			$exh_path[$index] = $path = 'news-detail.php?MID=' . $MID . '&amp;CID=' . $categoryID . '&amp;CONID=' . $row_all_exh['CONTENT_ID'] . $extraSCID;
			$exhimg_path[$index] = callThumbListFrontEnd($row_all_exh['CONTENT_ID'], $categoryID, true);
			$exhimg_date[$index] = ConvertDate($row_all_exh['CREATE_DATE']);

			$social_link[$index] = '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
			$social_link[$index] .= '<a href="' . $fullpath . '" onclick="shareTW(' . $row_all_exh['CONTENT_ID'] . ',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
			$index++;
		}
		?>
		<div class="part-news cf">
			<div class="container">
				<div class="box-title"><img src="images/<?=$picFolderName ?>/index/part3-pic1.png" />
				</div>
				<div class="box-left">
					<div class="box-top cf">
						<div class="box-left">
							<div class="text-title"><img src="images/<?=$picFolderName ?>/index/part3-pic2.png" />
							</div>
							<a class="btn black" href="news-event.php"><?=$seeAllCap ?></a>
						</div>
						<div class="box-right">
							<div class="box-news-bold cf">
								<a href="<?=$exh_path[0] ?>">
								<div class="box-pic">
									<img src="<?=$exhimg_path[0] ?>" width="274" height="205">
									<div class="box-tag-cate"><?=$exh_title[0] ?></div>
								</div> </a>
								<div class="box-text">
									<a href="<?=$exh_path[0] ?>">
									<p class="text-title TcolorRed"><?=$exh_title[0] ?></p>
									</a>
									<p class="text-date TcolorGray"><?=$exhimg_date[0] ?></p>
									<p class="text-des TcolorBlack"><?=$exh_detail[0] ?></p>
									<div class="box-btn cf">
										<a href="<?=$exh_path[0] ?>" class="btn red"><?=$txt_more ?></a>
										<div class="box-btn-social cf">
											<?=$social_link[0] ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-bottom">
						<div class="box-news-main cf">
						<?
						$max = count($exh_title);
							for($i = 1;$i < $max;$i++){
							if($i == 2){
								echo '<div class="box-news cf mid">';
							}else{
								echo '<div class="box-news cf">';
							}
						?>

								<a href="<?=$exh_path[$i] ?>">
								<div class="box-pic">
									<img src="<?=$exhimg_path[$i] ?>" width="274" height="205">
									<div class="box-tag-cate">
										<?=$exh_title[$i] ?>
									</div>
								</div> </a>
								<div class="box-text">
									<a href="<?=$exh_path[$i] ?>">
									<p class="text-title TcolorRed">
										<?=$exh_detail[$i] ?>
									</p> </a>
									<p class="text-date TcolorGray">
										<?=$exhimg_date[$i] ?>
									</p>
									<p class="text-des TcolorBlack">
										<?=$exh_detail[$i] ?>
									</p>
									<div class="box-btn cf">
										<a href="<?=$exh_path[$i] ?>" class="btn red"><?=$txt_more ?></a>
										<div class="box-btn-social cf">
											<?=$social_link[$i] ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
						</div>
					</div>
				</div>

				<div class="box-right" style="min-height:635px;">
					<div class="box-museum-news-main" style="min-height:635px;">
						<div class="box-title">
							<img src="images/<?=$picFolderName ?>/index/part3-pic3.png" />
						</div>
						<div class="box-museum-news" >

							<?php

							$MID = $new_and_event;
							$contentSqlStr = "SELECT ";
							if ($_SESSION['LANG'] == 'TH')
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_LOC as CAT_DESC ,content.CONTENT_DESC_LOC as CONTENT_DESC ,content.BRIEF_LOC as CONTENT_BRIEF ,";
							else
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_ENG as CAT_DESC ,content.CONTENT_DESC_ENG as CONTENT_DESC ,content.BRIEF_ENG as CONTENT_BRIEF ,";

							$contentSqlStr .= " cat.CONTENT_CAT_ID,
content.CONTENT_ID,
content.EVENT_START_DATE,
content.EVENT_END_DATE,
content.CREATE_DATE ,
content.LAST_UPDATE_DATE ,
IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE ,
content.SUB_CAT_ID
FROM
trn_content_category cat
INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
WHERE
cat.REF_MODULE_ID = $MID
AND content.CAT_ID = " . $museum_event_cat_id;
							$contentSqlStr .= " AND content.SUB_CAT_ID = " . $mesum_sub_cat_id;
							$contentSqlStr .= " AND cat.flag = 0
AND content.APPROVE_FLAG = 'Y'
AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
ORDER BY RAND() LIMIT 0,4 ";

							// start Loop Activity
							$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
							while ($rowContent = mysql_fetch_array($rsContent)) {
								$categoryID = $rowContent['CONTENT_CAT_ID'];
								$extraSCID = '';
								if ($rowContent['SUB_CAT_ID'] > 0) {
									$extraSCID = '&SID=' . $rowContent['SUB_CAT_ID'];
								}

								$path = 'news-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'] . $extraSCID;
								$fullpath = _FULL_SITE_PATH_ . '/' . $path;
								$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $rowContent['CONTENT_ID'];
								$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;

								$title = htmlspecialchars(trim($rowContent['CONTENT_DESC']));
								$detail = strip_tags(trim($rowContent['CONTENT_BRIEF']));

								echo '<div class="museum-news cf">';

								echo '<div class="box-pic">';
								echo '<a href="news-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '">';
								echo '<img src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"></a>';
								echo '</div>';

								echo '<div class="box-text">';
								echo '<a href="news-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '"> ';
								echo '<p class="text-title TcolorRed">';
								echo $rowContent['CONTENT_DESC'];
								echo '</p> </a>';
								echo '<p class="text-date TcolorGray">';
								echo ConvertDate($rowContent['LAST_DATE']);
								echo '</p>';

								echo '</div>';
								echo '</div>';

							}

							$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$_SESSION['MU_EVENT_PREV_PG'] = $current_url;
							?>


						</div>
						<div class="box-btn cf">
							<a href="news-event-museum.php" class="btn black"><?=$seeAllCap ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Data Network -->
		<div class="part-datanetwork">
			<div class="container">
				<div class="box-title"><img src="images/<?=$picFolderName ?>/index/part4-pic1.png" />
				</div>
				<div class="box-slide-network-main cf">
					<div class="slide-network cf">
						<?php

						if ($_SESSION['LANG'] == 'TH')
							$selectedColumn = " muse.MUSEUM_NAME_LOC as MUSEUM_NAME , muse.DESCRIPT_LOC as MUSEUM_DESCRIPT, muse.PLACE_DESC_LOC as PLACE_DESC , dist.DISTRICT_DESC_LOC as DISTRICT_DESC ,subDist.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC , province.PROVINCE_DESC_LOC  as PROVINCE_DESC , ";
						else
							$selectedColumn = " muse.MUSEUM_NAME_ENG as MUSEUM_NAME , muse.DESCRIPT_ENG as MUSEUM_DESCRIPT, muse.PLACE_DESC_ENG as PLACE_DESC , dist.DISTRICT_DESC_ENG as DISTRICT_DESC, subDist.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC , province.PROVINCE_DESC_ENG as PROVINCE_DESC , ";

						$sql = " SELECT " . $selectedColumn;
						$sql .= " muse.MUSEUM_DETAIL_ID, ";
						$sql .= " muse.MUSEUM_DISPLAY_NAME, ";
						$sql .= " muse.ADDRESS1, ";
						$sql .= " muse.DISTRICT_ID, ";
						$sql .= " muse.SUB_DISTRICT_ID, ";
						$sql .= " muse.PROVINCE_ID, ";
						$sql .= " muse.POST_CODE, ";
						$sql .= " muse.TELEPHONE, ";
						$sql .= " muse.EMAIL, ";
						$sql .= " muse.LAT, ";
						$sql .= " muse.LON, ";
						$sql .= " IFNULL( ";
						$sql .= " 	muse.LAST_UPDATE_DATE, ";
						$sql .= " 	muse.CREATE_DATE ";
						$sql .= " ) AS LAST_DATE, ";
						$sql .= " muse.MOBILE_PHONE, ";
						$sql .= " muse.FAX ";
						$sql .= " FROM ";
						$sql .= " trn_museum_detail muse ";
						$sql .= " left join mas_district dist on dist.DISTRICT_ID = muse.DISTRICT_ID ";
						$sql .= " left join mas_sub_district subDist  on subDist.SUB_DISTRICT_ID = muse.SUB_DISTRICT_ID ";
						$sql .= " LEFT JOIN mas_province province on province.PROVINCE_ID= muse.PROVINCE_ID ";
						$sql .= " WHERE ";
						$sql .= " muse.IS_GIS_MUSEUM = 'N' ";
						$sql .= " AND muse.ACTIVE_FLAG <> 2 ";
						$sql .= " AND muse.APPROVE_FLAG = 'Y' ";
						$sql .= " ORDER BY RAND() LIMIT 0,5 ";
						$rsMDN = mysql_query($sql) or die(mysql_error());
						while ($rowMDN = mysql_fetch_array($rsMDN)) {
							echo '<div class="box-network">';
							echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
							echo '<div class="box-pic">';
							echo '<img src="' . callMDNThumbListFrontEnd($rowMDN['MUSEUM_DETAIL_ID'], true) . '">';
							echo '</div> </a>';
							echo '<div class="box-text">';
							echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
							echo '<p class="text-title">';
							echo $rowMDN['MUSEUM_NAME'];
							echo '</p> </a>';
							echo '<p class="text-location TcolorWhite">';
							echo $rowMDN['PROVINCE_DESC'];
							echo '</p>';
							echo '<p class="text-date TcolorGray">';
							echo $rowMDN['LAST_DATE'];
							echo '</p>';
							echo '</div>';
							echo '</div>';
						}
						?>

					</div>
					<a class="btn-arrow left"></a>
					<a class="btn-arrow right"></a>
					<div class="box-btn cf">
						<a href="mdn.php" class="btn gold"><?=$seeAllCap ?></a>
					</div>
				</div>
			</div>
		</div>
		<!--Data Network -->

		<div class="part-exhibition cf">
			<div class="container cf">
				<div class="box-exhibition-main cf">
					<div class="box-top">
						<div class="box-title"><img src="images/<?=$picFolderName ?>/index/part5-pic1.png" />
						</div>
						<div class="box-btn cf">
							<a href="ve.php" class="btn black"><?=$seeAllCap ?></a>
						</div>
					</div>
					<div class="box-slide-exhibition-main">
						<div class="slide-exhibition">
							<?php

							$MID = $visual_exhibition;
							$contentSqlStr = "SELECT ";
							if ($_SESSION['LANG'] == 'TH')
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_LOC as CAT_DESC ,content.CONTENT_DESC_LOC as CONTENT_DESC ,content.BRIEF_LOC as CONTENT_BRIEF ,";
							else
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_ENG as CAT_DESC ,content.CONTENT_DESC_ENG as CONTENT_DESC ,content.BRIEF_ENG as CONTENT_BRIEF ,";

							$contentSqlStr .= " cat.CONTENT_CAT_ID,
content.CONTENT_ID,
content.EVENT_START_DATE,
content.EVENT_END_DATE,
content.CREATE_DATE ,
content.LAST_UPDATE_DATE ,
IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE ,
content.SUB_CAT_ID
FROM
trn_content_category cat
INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
WHERE
cat.REF_MODULE_ID = $MID
AND cat.flag = 0
AND content.APPROVE_FLAG = 'Y'
AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
ORDER BY RAND() LIMIT 0,5 ";

							// start Loop Activity
							$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
							while ($rowContent = mysql_fetch_array($rsContent)) {
								$categoryID = $rowContent['CONTENT_CAT_ID'];
								$extraSCID = '';
								if ($rowContent['SUB_CAT_ID'] > 0) {
									$extraSCID = '&SCID=' . $rowContent['SUB_CAT_ID'];
								}

								$path = 've-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'] . $extraSCID;
								$fullpath = _FULL_SITE_PATH_ . '/' . $path;
								$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $rowContent['CONTENT_ID'];
								$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;

								$title = htmlspecialchars(trim($rowContent['CONTENT_DESC']));
								$detail = strip_tags(trim($rowContent['CONTENT_BRIEF']));

								echo '<div class="box-exhibition cf">';
								echo '<div class="box-text ve-box-text" >';
								echo '<a href="ve-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '"> ';
								echo '<p class="text-title TcolorRed">';
								echo $rowContent['CONTENT_DESC'];
								echo '</p> </a>';
								echo '<p class="text-date TcolorGray">';
								echo ConvertDate($rowContent['LAST_DATE']);
								echo '</p>';

								echo '<p class="text-des TcolorBlack ve-text-des" >';
								echo $rowContent['CONTENT_BRIEF'];
								echo '</p>';
								echo '<div class="box-btn cf">';
								echo ' <a href="ve-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '" class="btn red">' . $txt_more . '</a>';
								echo '<div class="box-btn-social cf">';
								echo '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
								echo '<a href="' . $fullpath . '" onclick="shareTW(' . $rowContent['CONTENT_ID'] . ',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								echo ' <a href="ve-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '">';
								echo '<div class="box-pic box-pic-thumb">';
								echo '<img  src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
								echo '</div>';
								echo '</a>';
								echo '</div>';
								//echo "\n\t\t";

							}

							$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$_SESSION['VE_PREV_PG'] = $current_url;
							?>
						</div>
					</div>
				</div>

				<!-- Digital Arc-->
				<div class="box-archive-main cf">

					<div class="box-top">
						<div class="box-title"><img src="images/<?=$picFolderName ?>/index/part5-pic2.png" />
						</div>
						<div class="box-btn cf">
							<a href="da.php" class="btn black"><?=$seeAllCap ?></a>
						</div>
					</div>
					<div class="box-slide-archive-main">
						<div class="slide-archive">

							<?php
							$MID = $digial_module_id;
							$contentSqlStr = "SELECT ";
							if ($_SESSION['LANG'] == 'TH')
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_LOC as CAT_DESC ,content.CONTENT_DESC_LOC as CONTENT_DESC ,content.BRIEF_LOC as CONTENT_BRIEF ,";
							else
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_ENG as CAT_DESC ,content.CONTENT_DESC_ENG as CONTENT_DESC ,content.BRIEF_ENG as CONTENT_BRIEF ,";

							$contentSqlStr .= " cat.CONTENT_CAT_ID,
content.CONTENT_ID,
content.EVENT_START_DATE,
content.EVENT_END_DATE,
content.CREATE_DATE ,
content.LAST_UPDATE_DATE ,
IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE ,
content.SUB_CAT_ID
FROM
trn_content_category cat
INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
WHERE
cat.REF_MODULE_ID = $MID
AND cat.flag = 0
AND content.APPROVE_FLAG = 'Y'
AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
ORDER BY RAND() LIMIT 0,5 ";

							// start Loop Activity
							$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
							while ($rowContent = mysql_fetch_array($rsContent)) {
								$categoryID = $rowContent['CONTENT_CAT_ID'];
								$extraSCID = '';
								if ($rowContent['SUB_CAT_ID'] > 0) {
									$extraSCID = '&SCID=' . $rowContent['SUB_CAT_ID'];
								}

								$path = 'da-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID'] . $extraSCID;
								$fullpath = _FULL_SITE_PATH_ . '/' . $path;
								$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $rowContent['CONTENT_ID'];
								$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;

								$title = htmlspecialchars(trim($rowContent['CONTENT_DESC']));
								$detail = strip_tags(trim($rowContent['CONTENT_BRIEF']));

								echo '<div class="box-archive cf">';
								echo '<div class="box-text">';
								echo '<a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '"> ';
								echo '<p class="text-title TcolorRed">';
								echo $rowContent['CONTENT_DESC'];
								echo '</p> </a>';
								echo '<p class="text-date TcolorGray">';
								echo ConvertDate($rowContent['LAST_DATE']);
								echo '</p>';
								echo '<p class="text-des TcolorBlack">';
								echo $rowContent['CONTENT_BRIEF'];
								echo '</p>';
								echo '<div class="box-btn cf">';
								echo ' <a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '" class="btn red">' . $txt_more . '</a>';
								echo '<div class="box-btn-social cf">';
								echo '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
								echo '<a href="' . $fullpath . '" onclick="shareTW(' . $rowContent['CONTENT_ID'] . ',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
								echo '</div>';
								echo '</div>';
								echo '</div>';

								echo ' <a href="da-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . $extraSCID . '">';
								echo '<div class="box-pic box-pic-thumb">';
								echo '<img src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
								echo '</div>';
								echo '</a>';
								echo '</div>';

							}

							$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$_SESSION['DA_PREV_PG'] = $current_url;
							?>
						</div>
					</div>
				</div>
				<!-- End Digital Arc-->

				<!-- KM -->
				<div class="box-knowledge-main cf">
					<div class="box-left">
						<div class="box-title"><img src="images/<?=$picFolderName ?>/index/part5-pic3.png" />
						</div>
						<div class="box-btn cf">
							<a href="km.php" class="btn gold"><?=$seeAllCap ?></a>
						</div>
					</div>
					<div class="box-right">
						<div class="box-knowledge-wrap">

							<?php
							$MID = $km_module_id;
							$contentSqlStr = "SELECT ";
							if ($_SESSION['LANG'] == 'TH')
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_LOC as CAT_DESC ,content.CONTENT_DESC_LOC as CONTENT_DESC ,content.BRIEF_LOC as CONTENT_BRIEF ,";
							else
								$contentSqlStr .= " cat.CONTENT_CAT_DESC_ENG as CAT_DESC ,content.CONTENT_DESC_ENG as CONTENT_DESC ,content.BRIEF_ENG as CONTENT_BRIEF ,";

							$contentSqlStr .= " cat.CONTENT_CAT_ID,
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
cat.REF_MODULE_ID = $MID
AND cat.flag = 0
AND content.APPROVE_FLAG = 'Y'
AND content.CONTENT_STATUS_FLAG  = 0 /*and content.EVENT_START_DATE <= now() and content.EVENT_END_DATE >= now()*/
ORDER BY RAND() LIMIT 0,4 ";

							// start Loop Activity
							$rsContent = mysql_query($contentSqlStr) or die(mysql_error());
							while ($rowContent = mysql_fetch_array($rsContent)) {
								$categoryID = $rowContent['CONTENT_CAT_ID'];

								$path = 'km-detail.php?MID=' . $MID . '%26CID=' . $categoryID . '%26CONID=' . $rowContent['CONTENT_ID']; ;
								$fullpath = _FULL_SITE_PATH_ . '/' . $path;
								$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $rowContent['CONTENT_ID'];
								$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;

								$title = htmlspecialchars(trim($rowContent['CONTENT_DESC']));
								$detail = strip_tags(trim($rowContent['CONTENT_BRIEF']));

								echo '<div class="box-knowledge cf">';
								echo '<a href="km-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '"> ';
								echo '<div class="box-pic">';
								echo '<img style="width:197px;height:147px;" src="' . callThumbListFrontEnd($rowContent['CONTENT_ID'], $rowContent['CONTENT_CAT_ID'], true) . '"> ';
								echo '</div>';
								echo '</a>';
								echo '<div class="box-text">';
								echo ' <a href="km-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '">';
								echo '<p class="text-title">';
								echo $rowContent['CONTENT_DESC'];
								echo '</p>';
								echo '</a>';
								echo '<p class="text-date TcolorGray">';
								echo ConvertDate($rowContent['LAST_DATE']);
								echo '</p>';
								echo '<p class="text-des TcolorBlack">';
								echo $rowContent['CONTENT_BRIEF'];
								echo '</p>';
								echo '<div class="box-btn cf">';
								echo ' <a href="km-detail.php?MID=' . $MID . '&CID=' . $categoryID . '&CONID=' . $rowContent['CONTENT_ID'] . '" class="btn red">' . $txt_more . '</a>';
								echo '<div class="box-btn-social cf">';
								echo '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
								echo '<a href="' . $fullpath . '" onclick="shareTW(' . $rowContent['CONTENT_ID'] . ',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								echo '</div>';

							}

							$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$_SESSION['KM_PREV_PG'] = $current_url;
							?>
						</div>
					</div>
				</div>
				<!--End KM -->
			</div>
		</div>

		<?php
		include ('inc/inc-footer.php');
		include ('inc/inc-social-network.php');
		?>
	</body>
</html>
<? CloseDB(); ?>