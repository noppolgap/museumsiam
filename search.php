<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");

	if ($_SESSION['LANG'] == 'TH'){
		$search_row = 'CONTENT_DESC_LOC AS CONTENT_LOC , BRIEF_LOC AS CONTENT_BRIEF';
	}else if ($_SESSION['LANG'] == 'EN'){
		$search_row = 'CONTENT_DESC_ENG AS CONTENT_LOC , BRIEF_ENG AS CONTENT_BRIEF';
	}

$sql_row1 = " SELECT CONTENT_ID , trn_content_detail.CREATE_DATE AS  CONTENT_DATE, CAT_ID , ".$search_row." 
			, REF_MODULE_ID, SUB_CAT_ID FROM trn_content_detail 
			LEFT JOIN trn_content_category ON trn_content_detail.CAT_ID = trn_content_category.CONTENT_CAT_ID 
			WHERE APPROVE_FLAG = 'Y'";

if((isset($_POST['txt_search_form'])) AND ($_POST['txt_search_form'] != '')){
	$txt = mysql_real_escape_string(trim($_POST['txt_search_form']));

	if ($_SESSION['LANG'] == 'TH'){
		$sql_row1 .= " AND (CONTENT_DESC_LOC LIKE '%".$txt."%'";
		$sql_row1 .= " OR BRIEF_LOC LIKE '%".$txt."%'";
		$sql_row1 .= " OR CONTENT_DETAIL_LOC LIKE '%".$txt."%')";
	}else if ($_SESSION['LANG'] == 'EN'){
		$sql_row1 .= " AND (CONTENT_DESC_ENG LIKE '%".$txt."%'";
		$sql_row1 .= " OR BRIEF_ENG LIKE '%".$txt."%'";
		$sql_row1 .= " OR CONTENT_DETAIL_ENG LIKE '%".$txt."%')";
	}

	$string_show = '"'.$txt.'"';
}

	$sql_row1 .= " AND ((EVENT_START_DATE='0000-00-00 00:00:00' AND EVENT_END_DATE='0000-00-00 00:00:00')
			OR (EVENT_START_DATE='0000-00-00 00:00:00' AND TO_DAYS(EVENT_END_DATE)>=TO_DAYS(NOW()) )
			OR (TO_DAYS(EVENT_START_DATE)<=TO_DAYS(NOW()) AND EVENT_END_DATE='0000-00-00 00:00:00' )
			OR (TO_DAYS(EVENT_START_DATE)<=TO_DAYS(NOW()) AND  TO_DAYS(EVENT_END_DATE)>=TO_DAYS(NOW())  ))
		ORDER BY trn_content_detail.ORDER_DATA DESC";
	$query_row1 = mysql_query($sql_row1, $conn);
	$num_row1 = @mysql_num_rows($query_row1);


?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />

<script>
	$(document).ready(function(){
// 		$(".menutop li.menu5,.menu-left li.menu6").addClass("active");
	});
</script>

<style>
	.box-title-system{
		margin-bottom: 20px;
	}
	.box-news-main {
		padding: 0;
	}
	.box-category-main{
		margin-bottom: 20px;
	}
</style>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$searchResultCap?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
<!-- 		<div class="box-right main-content"> -->
			<hr class="line-red"/>
			<div class="box-title-system news cf">
				<h1><?=$searchResultCap?> <span><?=$string_show?></span></h1>
			</div>
			
			<div class="box-category-main news BWhite">
				<div class="box-news-main">
					<div class="box-tumb-main cf">
						<div class="box-result-list-main">
							
					    <?

					     while ($row_row1 = mysql_fetch_array($query_row1)) { 

						    $title = htmlspecialchars(trim($row_row1['CONTENT_LOC']));
							$detail = strip_tags(trim($row_row1['CONTENT_BRIEF']));

							$MID = $row_row1['REF_MODULE_ID'];
							$CID = $row_row1['CAT_ID'];
							$CONID = $row_row1['CONTENT_ID'];
							$SID = $row_row1['SUB_CAT_ID'];

							switch($row_row1['REF_MODULE_ID']){
								case 2	: $path = 'km-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID ; break;
								case 3	: $path = 'da-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID; break;
								case 4	: $path = 'mdn-event-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID; break;
								case 5	: $path = 've-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID; break;
								case 7	: $path = 'km-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID; break;
								case 12	: $path = 'event-detail.php?MID='.$MID.'&CID='.$CID.'&CONID='.$CONID.'$SID='.$SID; break;
							}

						?>

							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="<?=$path?>">
											<div class="text-title">
												<?=$title?>
											</div>
										</a>
										<div class="text-des">
											   <?=$detail?>
										</div>
									</div>
								</div>
								<div class="box-btn cf">

								 <a href="<?=$path?>" class="btn red"><?=$txt_more?></a>
								</div>
							</div>

						<? 
						}?>



						</div>
					</div>
					<div class="box-pagination-main cf Noborder">
						<ul class="pagination">
							<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">...</a></li>
							<li><a href="" class="btn-arrow-right"></a></li>
						</ul>
					</div>
				</div>
				
			</div>

			<?php

				if ($_SESSION['LANG'] == 'TH') {
					$LANG_SQL = " d.CONTENT_DESC_LOC AS CONTENT_DESC , d.BRIEF_LOC AS BRIEF_LOC";
				} else if ($_SESSION['LANG'] == 'EN') {
					$LANG_SQL = " d.CONTENT_DESC_ENG AS CONTENT_DESC , d.BRIEF_ENG AS BRIEF_LOC";
				}

			    $sql = " SELECT ".$LANG_SQL.", p.IMG_PATH from trn_content_detail d
						 LEFT JOIN (
													SELECT CONTENT_ID, IMG_PATH, ORDER_ID, CAT_ID
													FROM (
														SELECT * 
														FROM trn_content_picture
														ORDER BY ORDER_ID ASC
													) AS my_table_tmp
													GROUP BY CONTENT_ID, CAT_ID
												) as p on  d.CONTENT_ID = p.CONTENT_ID
												AND d.CAT_ID = p.CAT_ID
						WHERE d.CAT_ID = $procurement_cat_id  and d.CONTENT_STATUS_FLAG = 0 ";

				if ($_SESSION['LANG'] == 'TH'){
					$sql .= " AND (CONTENT_DESC_LOC LIKE '%".$txt."%'";
					$sql .= " OR BRIEF_LOC LIKE '%".$txt."%'";
					$sql .= " OR CONTENT_DETAIL_LOC LIKE '%".$txt."%')";
				}else if ($_SESSION['LANG'] == 'EN'){
					$sql .= " AND (CONTENT_DESC_ENG LIKE '%".$txt."%'";
					$sql .= " OR BRIEF_ENG LIKE '%".$txt."%'";
					$sql .= " OR CONTENT_DETAIL_ENG LIKE '%".$txt."%')";
				}

			    $sql .=	$search_sql."ORDER BY d.ORDER_DATA DESC LIMIT 0 , 30";

				$query = mysql_query($sql, $conn);

				$num = mysql_num_rows($query);

			?>
			
			<div class="box-category-main news BWhite">
				<div class="box-news-main">
					<div class="box-tumb-main cf">
						<div class="box-result-list-main">
							
							<? while($row = mysql_fetch_array($query)) {
						   		$IMG_PATH = str_replace("../../","",$row['IMG_PATH']);
						   	?>

							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												<? echo $row['CONTENT_DESC'] ?>
											</div>
										</a>
										<div class="text-des">
												<? echo $row['BRIEF_LOC'] ?>
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="<?=$IMG_PATH?>" target="_blank" class="btn red"><?=$downloadCap?></a>
								</div>
							</div>

							<? } ?>
						</div>
					</div>
					<div class="box-pagination-main cf Noborder">
						<ul class="pagination">
							<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">...</a></li>
							<li><a href="" class="btn-arrow-right"></a></li>
						</ul>
					</div>
				</div>
				
			</div>
			
<!-- 		</div> -->
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
