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

		<link rel="stylesheet" type="text/css" href="css/template.css" />
		<link rel="stylesheet" type="text/css" href="css/mdn.css" />

		<script>
			$(document).ready(function() {
				$(".menutop li.menu6,.menu-left li.menu3").addClass("active");
				if ($('.menu-left li.menu3').hasClass("active")) {
					$('.menu-left li.menu3').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="km">

		<?php
		include ('inc/inc-top-bar.php');
		include ('inc/inc-menu.php');
		if (!isset($_GET['MID']))
			$MID = $museum_data_network_module_id;
		else
			$MID = $_GET['MID'];

		if (!isset($_GET['CID'])) {
			$CID = $regionCategory;
		} else {
			$CID = $_GET['CID'];
		}
		?>

		<div class="part-nav-main"  id="firstbox">
			<div class="container">
				<div class="box-nav">
					<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn.php">ระบบเครือข่ายพิพิธภัณฑ์</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							หมวดหมู่
						</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<div class="part-main">
			<div class="container cf">
				<div class="box-left main-content">
					<?php
					include ('inc/inc-left-content-mdn.php');
					?>
				</div>

				<div class="box-right main-content">
					<?
					/*
					$categorySql = "SELECT
					CONTENT_CAT_ID,
					CONTENT_CAT_DESC_LOC,
					CONTENT_CAT_DESC_ENG,
					IS_LAST_NODE
					FROM
					trn_content_category
					WHERE
					REF_MODULE_ID = ".$MID.
					" AND flag = 0
					ORDER BY
					ORDER_DATA DESC";
					*/
					if ($_SESSION['LANG'] == 'TH')
						$selectedColumn = "SUB_CONTENT_CAT_DESC_LOC as SUB_CONTENT_CAT ";
					else 
						$selectedColumn = "SUB_CONTENT_CAT_DESC_ENG as SUB_CONTENT_CAT ";
					$subCatSql = "SELECT
					SUB_CONTENT_CAT_ID,".$selectedColumn.
					" FROM
					trn_content_sub_category
					WHERE
					CONTENT_CAT_ID = ". $CID.
					" AND flag = 0
					ORDER BY
					ORDER_DATA DESC";

					$querySubCat = mysql_query($subCatSql, $conn) or die($subCatSql);
					while ($row = mysql_fetch_array($querySubCat)) {
					?>
					<div class="box-category-main news">
						<div class="box-title cf ">
							<h2><?=$row['SUB_CONTENT_CAT'] ?></h2>
							<div class="box-btn">
								<a href="mdn-category2.php?MID=<?=$MID?>&CID=<?=$CID?>&SCID=<?=$row['SUB_CONTENT_CAT_ID']?>" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

<?

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
	$sql .= " IS_GIS_MUSEUM = 'N' ";
	$sql .= " and ACTIVE_FLAG = 1 ";
	
if ($CID == $regionCategory) {
	
	if ($row['SUB_CONTENT_CAT_ID'] == $bkkSubCatID) {
		// Bkk where with Province
		$whereSql = " and muse.PROVINCE_ID = '" . $bkkProvinceID . "' ";

	} else {
		
		$whereSql = " and muse.PROVINCE_ID in ( SELECT
													PROVINCE_ID
												FROM
													mapping_region_museum_network_sub_cat map
												LEFT JOIN mas_province p ON p.REGION_ID = map.REGION_ID
												WHERE
													map.cat_id = " . $CID . " AND map.SUB_CAT_ID = " . $row['SUB_CONTENT_CAT_ID'] . " ) ";
	}

	

} else {
	// join with trn_mapping_museum_category
	$whereSql = " and muse.MUSEUM_DETAIL_ID in ( SELECT
													MUSEUM_DETAIL_ID
												FROM
													trn_mapping_museum_category  map
												LEFT JOIN mas_province p ON p.REGION_ID = map.REGION_ID
												WHERE
													map.CONTENT_CAT_ID = " . $CID . " AND map.CONTENT_SUB_CAT_ID	 = " . $row['SUB_CONTENT_CAT_ID'] . " ) ";
}
$sql .= $whereSql;
//$sql .= " order by ";
$rsMDN = mysql_query($sql) or die(mysql_error());
$idx = 1;

while ($rowMDN = mysql_fetch_array($rsMDN)) {
	$isMid = "";
	if ($idx == 4)
		echo '<hr class="line-gray"/>';
	if ($idx == 2 || $idx == 5)
		$isMid = " mid ";
	echo '<div class="box-tumb cf' . $isMid . '">';

	echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
	echo '<div class="box-pic">';
	echo '<img src="' . callMDNThumbListFrontEnd($rowMDN['MUSEUM_DETAIL_ID'], true) . '">';
	echo '</div> </a>';
	echo '<div class="box-text">';
	echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
	echo '<p class="text-title TcolorRed">';
	echo $rowMDN['MUSEUM_NAME'];
	echo '</p> </a>';
	echo '<p class="text-date TcolorGray">';
	echo $rowMDN['LAST_DATE'];
	echo '</p>';
	echo '<p class="text-des TcolorBlack">';
	echo $rowMDN['MUSEUM_DESCRIPT'];
	echo '</p>';
	echo '<div class="box-btn cf">';
	echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '" class="btn red">อ่านเพิ่มเติม</a>';
	echo '<div class="box-btn-social cf">';
	echo '<a href="#" class="btn-socila fb"></a>';
	echo '<a href="#" class="btn-socila tw"></a>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	$idx++;
}
			?>					
								
								
								<!-- <div class="box-tumb cf mid">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">
									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
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
									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
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

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
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

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
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

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
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
								</div> -->

							</div>
						</div>
					</div>
					<?} ?>
					<!--
					<div class="box-category-main news">
					<div class="box-title cf ">
					<h2>ภาคใต้</h2>
					<div class="box-btn">
					<a href="mdn-category2.php" class="btn gold">ดูทั้งหมด</a>
					</div>
					</div>
					<div class="box-news-main">
					<div class="box-tumb-main cf ">

					<div class="box-tumb cf">
					<a href="">
					<div class="box-pic">
					<img src="http://placehold.it/274x205">
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					<div class="box-category-main news">
					<div class="box-title cf ">
					<h2>ภาคตะวันออกเฉียงเหนือ</h2>
					<div class="box-btn">
					<a href="mdn-category2.php" class="btn gold">ดูทั้งหมด</a>
					</div>
					</div>
					<div class="box-news-main">
					<div class="box-tumb-main cf ">

					<div class="box-tumb cf">
					<a href="">
					<div class="box-pic">
					<img src="http://placehold.it/274x205">
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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

					</div> </a>
					<div class="box-text">
					<a href="">
					<p class="text-title TcolorRed">
					Levitated Mass 340 Ton Giant Stone
					</p> </a>
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
					-->
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
		?>
	</body>
</html>
