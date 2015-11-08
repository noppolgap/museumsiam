<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

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
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu2").addClass("active");
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
				<li><a href="index.php"><?=$newsAndEventCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-month.php"><?=$allEventAndNewsAllSystemCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$allEventAndNewsAllSystemCap?> <?=$weeklyCap?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php
				$menu_newsevent = 2;
			    include('inc/inc-left-content-newsevent.php');
			    include('inc/inc-left-content-calendar.php');
			?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1><?=$weeklyCap?></h1>
			</div>
		<?php

			list($start_date, $end_date) = x_week_range(date('Y-m-d'));

			if ($_SESSION['LANG'] == 'TH'){
				$LANG_SQL = 'CONTENT_CAT_DESC_LOC AS CONTENT_CAT_LOC';
			}else if ($_SESSION['LANG'] == 'EN'){
				$LANG_SQL = 'CONTENT_CAT_DESC_ENG AS CONTENT_CAT_LOC';
			}
			$sql =  "SELECT CONTENT_CAT_ID , ";
			$sql .=  $LANG_SQL;
			$sql .=  " FROM trn_content_category WHERE REF_MODULE_ID = ".$new_and_event." ORDER BY ORDER_DATA DESC";
			$query_CAT = mysql_query($sql, $conn);
			while($row_CAT = mysql_fetch_array($query_CAT)) {
			?>
			<div class="box-category-main news">
				<div class="box-title cf">
					<h2><?=$row_CAT['CONTENT_CAT_LOC']?></h2>
					<div class="box-btn">
						<?  $link_page = "";
							$catId = $row_CAT['CONTENT_CAT_ID'];

							if($row_CAT['CONTENT_CAT_ID'] == $all_event_cat_id ){ $link_page = "event-week.php?CID=$catId";}
							else{ $link_page = "news-week.php?CID=$catId";}
						 ?>


						<a href="<? echo $link_page ?>" class="btn gold">ดูทั้งหมด</a>
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
								$LANG_SQL = 'content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
							}else if ($_SESSION['LANG'] == 'EN'){
								$LANG_SQL = 'content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
							}

						    $sql =  " SELECT ";
						    $sql .= $LANG_SQL;
							$sql .= " 			content.SUB_CAT_ID,
												content.CONTENT_ID,
												content.EVENT_START_DATE,
												content.EVENT_END_DATE,
												content.CREATE_DATE ,
												content.LAST_UPDATE_DATE
											FROM
												trn_content_detail AS content
											WHERE
											    content.APPROVE_FLAG = 'Y'
											AND content.CONTENT_STATUS_FLAG  = 0
											AND content.CAT_ID = ".$row_CAT['CONTENT_CAT_ID'];
							$sql .= " AND (EVENT_START_DATE <= '".$end_date."' AND EVENT_END_DATE >= '".$start_date."')";

								
							
							$sql .= $search_sql." ORDER BY content.ORDER_DATA desc LIMIT 0,30 ";

					$query = mysql_query($sql, $conn)or die($sql);

					while($row = mysql_fetch_array($query)) {

					    $IMG_PATH = str_replace("../../","",$row['IMG_PATH']);

					$gap = "";
					if($index == 2){
						$gap = "mid";
					}

					$date = ConvertBoxDate($row['EVENT_START_DATE']);


						/*social*/
						$path = 'event-detail.php?MID='.$MID.'%26CID='.$row_CAT['CONTENT_CAT_ID'].'%26SID='.$row['SUB_CAT_ID'].'%26CONID='.$row['CONTENT_ID'].'%26date=week';
						$fullpath = _FULL_SITE_PATH_.'/'.$path;
						$redirect_uri = _FULL_SITE_PATH_.'/callback.php?p='.$row['CONTENT_ID'];
						$fb_link = 'https://www.facebook.com/dialog/share?app_id='._FACEBOOK_ID_.'&display=popup&href='.$fullpath.'&redirect_uri='.$redirect_uri;
						$path = str_replace("%26","&amp;",$path);

						$title = htmlspecialchars(trim($row['CONTENT_LOC']));
						$detail = strip_tags(trim($row['CONTENT_BRIEF']));
						/*social*/

						echo	'<div class="box-tumb '.$gap.' ">';
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$row_CAT['CONTENT_CAT_ID'].'&SID='.$row['SUB_CAT_ID'].'&CONID='.$row['CONTENT_ID'].'&date=week">';
					    echo	'<div class="box-pic">';
						echo	'<img src="' . callThumbListFrontEnd($row['CONTENT_ID'], $row_CAT['CONTENT_CAT_ID'], true) . '">';
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
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$row_CAT['CONTENT_CAT_ID'].'&SID='.$row['SUB_CAT_ID'].'&CONID='.$row['CONTENT_ID'].'&date=week">';
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
						echo	'<a href="event-detail.php?MID='.$MID.'&CID='.$row_CAT['CONTENT_CAT_ID'].'&SID='.$row['SUB_CAT_ID'].'&CONID='.$row['CONTENT_ID'].'&date=week" class="btn red">'.$txt_more.'</a>';
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

<?  }  ?>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>
<?php include('inc/inc-social-network.php'); ?>

</body>
</html>
<? CloseDB(); ?>
