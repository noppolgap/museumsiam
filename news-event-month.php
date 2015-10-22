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
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu2,.menu-left li.menu2 .submenu1").addClass("active");
		if ($('.menu-left li.menu2').hasClass("active")){
			$('.menu-left li.menu2').children(".submenu-left").css("display","block");
		}
	});
</script>

</head>

<body>

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="index.php">กิจกรรมและข่าวสาร</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-month.php">กิจกรรมและข่าวสารทั้งหมดของทุกระบบ</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">กิจกรรมและข่าวสารทั้งหมดของทุกระบบ รายเดือน</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-newsevent.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>รายเดือน</h1>
			</div>
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>กิจกรรมของทุกระบบ </h2>
					<div class="box-btn">
						<a href="event-month.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">

						<?php

						if (!isset($_GET['MID']))
							$MID = $new_and_event;
						else
							$MID = $_GET['MID'];

						$index = 1;
						$categoryID = $all_event_cat_id;

							if ($_SESSION['LANG'] == 'TH'){
								$LANG_SQL = 'cat.CONTENT_CAT_DESC_LOC AS CONTENT_CAT_LOC , content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
							}else if ($_SESSION['LANG'] == 'EN'){
								$LANG_SQL = 'cat.CONTENT_CAT_DESC_ENG AS CONTENT_CAT_LOC , content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
							}

						    $sql =  " SELECT ";
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
											AND cat.CONTENT_CAT_ID = $all_event_cat_id
											AND content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0
											ORDER BY
												content.ORDER_DATA desc
											LIMIT 0,30 ";

					$query = mysql_query($sql, $conn);

					while($row = mysql_fetch_array($query)) {

					    $IMG_PATH = str_replace("../../","",$row['IMG_PATH']);

					$gap = "";
					if($index == 2){
						$gap = "mid";
					}

					$date = ConvertBoxDate($row['EVENT_START_DATE']);


						/*social*/
						$path = 'event-detail.php?MID='.$MID.'%26CID='.$categoryID.'%26SID='.$row['SUB_CAT_ID'].'%26CONID='.$row['CONTENT_ID'];
						$fullpath = _FULL_SITE_PATH_.'/'.$path;
						$redirect_uri = _FULL_SITE_PATH_.'/callback.php?p='.$row['CONTENT_ID'];
						$fb_link = 'https://www.facebook.com/dialog/share?app_id='._FACEBOOK_ID_.'&display=popup&href='.$fullpath.'&redirect_uri='.$redirect_uri;
						$path = str_replace("%26","&amp;",$path);

						$title = htmlspecialchars(trim($row['CONTENT_LOC']));
						$detail = strip_tags(trim($row['CONTENT_BRIEF']));
						/*social*/

						echo	'<div class="box-tumb '.$gap.' ">';
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$categoryID.'&SID='.$row['SUB_CAT_ID'].'&CONID'.$row['CONTENT_ID'].'">';
					    echo	'<div class="box-pic">';
						echo	'<img src="' . callThumbListFrontEnd($row['CONTENT_ID'], $row['CONTENT_CAT_ID'], true) . '">';
						echo    '<div class="box-tag-cate">';
						echo  	$title;
						echo 	'</div>';
						echo 	'<div class="box-date-tumb">';
						echo	'<p class="date">'.$date[0].'</p>';
						echo	'<p class="month">'.$date[1].'</p>';
						echo 	'</div>';
						echo 	'</div>';
						echo 	'</a>';
						echo 	'<div class="box-text">';
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$categoryID.'&SID='.$row['SUB_CAT_ID'].'&CONID='.$row['CONTENT_ID'].'">';
						echo	'<p class="text-title TcolorRed">';
						echo	$title;
						echo	'</p>';
						echo	'</a>';
						echo	'<p class="text-date TcolorGray">';
						echo		ConvertDate($row['CREATE_DATE']);
						echo	'</p>';
						echo	'<p class="text-des TcolorBlack">';
						echo	$detail;
						echo	'</p>';
						echo	'<div class="box-btn cf">';
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$categoryID.'&SID='.$row['SUB_CAT_ID'].'&CONID='.$row['CONTENT_ID'].'" class="btn red">อ่านเพิ่มเติม</a>';
						echo	'<div class="box-btn-social cf">';
						echo  	'<a href="'.$fb_link.'" onclick="shareFB(\''.$title.'\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
						echo  	'<a href="'.$fullpath.'" onclick="shareTW(\''.$row_row1['CONTENT_ID'].'\',\''.$title.'\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
						echo	'</div>';
						echo	'</div>';
						echo	'</div>';
						echo 	'</div>';

						if($index == 3){
								echo '<hr class="line-gray"/>';
								$index = 0;
							}
							$index++;
						}

					?>

					</div>
				</div>

			</div>
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2>ข่าวประชาสัมพันธ์ของทุกระบบ </h2>
					<div class="box-btn">
						<a href="news-month.php" class="btn gold">ดูทั้งหมด</a>
					</div>
				</div>
				<div class="box-news-main">
					<div class="box-tumb-main cf">

						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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
						<hr class="line-gray"/>
						<div class="box-tumb cf">
							<a href="">
								<div class="box-pic">
									<img src="http://placehold.it/274x205">
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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
									<div class="box-tag-cate">
										ชื่อระบบ
									</div>
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



<?php include('inc/inc-footer.php'); ?>
<?php include('inc/inc-social-network.php'); ?>

</body>
</html>
<? CloseDB(); ?>
