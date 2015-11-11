<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");
?>
<!doctype html>
<html>
<head>
<?
require ('inc_meta.php');
 ?>

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
<link rel="stylesheet" type="text/css" href="css/add-museum.css" />
<link rel="stylesheet" type="text/css" href="css/styleForUploadPhoto.css" />

<script type="text/javascript" src="js/add-museum-detail.js"></script>
<script type="text/javascript" src="assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="assets/plugin//upload/jquery.fileupload.js"></script>

<link rel="stylesheet" type="text/css" href="assets/plugin/colorbox/colorbox.css" media="all" >
<script type="text/javascript" src="assets/plugin/colorbox/jquery.colorbox-min.js"></script>

<script type="text/javascript" src="js/scriptForUploadPhoto.js"></script>
<script>
	 
</script>

	<style>
		ul.catItems {
			text-align: center;
			list-style-type: none;
			color: #d9c3c3;
		}
		ul.catItems li {
			float: left;
		}
		ul.catItems li:nth-child(3n+4) {
			clear: left;
			float: left;
		}
	</style>
</head>

<body style="padding-top: 0px;width:800px;"  >
<?
 
 
if ($_SESSION['LANG'] == 'TH') {
	$picFolder = 'th';
	$selectedColumn = "province.PROVINCE_DESC_LOC as PROVINCE_DESC , district.DISTRICT_DESC_LOC as DISTRICT_DESC ,subDis.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC ";
	$provinceColumn = " PROVINCE_DESC_LOC as PROVINCE_DESC ";
	$districtColumn = " DISTRICT_DESC_LOC as DISTRICT_DESC ";
	$subDistrictColumn = " SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC ";
} else {
	$picFolder = 'en';
	$selectedColumn = "province.PROVINCE_DESC_ENG as PROVINCE_DESC , district.DISTRICT_DESC_ENG as DISTRICT_DESC ,subDis.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC ";
	$provinceColumn = " PROVINCE_DESC_ENG as PROVINCE_DESC ";
	$districtColumn = " DISTRICT_DESC_ENG as DISTRICT_DESC ";
	$subDistrictColumn = " SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC ";
}
$MID = -1; 
$methodType = "ADD" ; 
if (isset($_GET['MID']))
{
	$MID = $_GET['MID'];
	$methodType = "EDIT" ; 
}
 
 
?>
 

 

<div class="part-account-main">
	<form name="myform" id="myform" method="post" action="add-museum-action.php?add" enctype="multipart/form-data">
	<div class="container cf" style="width:800px;">
	 
		<div class="box-account-right cf" style="width:100%">
			<div class="box-title">
				<h1>เพิ่มพิพิธภัณฑ์</h1>
			</div>
			<input type="hidden" name = "museumId" value="" />
		 
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อพิพิธภัณฑ์*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtNameLoc" value=""></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อพิพิธภัณฑ์*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name="txtNameEng" value=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-title">
				<h2>ที่อยู่และเบอร์ติดต่อ</h2>
			</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ที่อยู่* (ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="addressLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ที่อยู่* (ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="addressEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ตำบล/แขวง*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div>
									<div class="SearchMenu-item sub_district_box box-select">
										<span title="- เลือกตำบล -">- เลือกตำบล -</span>
										<select class="p-Absolute" name="subDistrict">
											 
										<?php
											$sql = "SELECT SUB_DISTRICT_ID , ".$subDistrictColumn." FROM mas_sub_district ";
											$query = mysql_query($sql,$conn);
											while($rowSubDis = mysql_fetch_array($query)){
												$selectedOption = "";
												 
										?>

										<option value="<?=$rowSubDis['SUB_DISTRICT_ID'] ?>" <?=$selectedOption ?>><?=$rowSubDis['SUB_DISTRICT_DESC'] ?></option>

										<? } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>อำเภอ/เขต*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div>
									<div class="SearchMenu-item district_box box-select">
										<span title="- เลือกอำเภอ-">- เลือกอำเภอ-</span>
										<select class="p-Absolute" name="district">
											 
										<?php
											$sql = "SELECT DISTRICT_ID  , ".$districtColumn." FROM mas_district  ORDER BY DISTRICT_ID Asc";
											$query = mysql_query($sql,$conn);
											while($rowDistrict = mysql_fetch_array($query)){
													$selectedOption = "" ;
													 
										?>
											<option value="<?=$rowDistrict['DISTRICT_ID'] ?>" <?=$selectedOption ?> ><?=$rowDistrict['DISTRICT_DESC'] ?></option>
										<? } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>จังหวัด*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div>
									<div class="SearchMenu-item province_box box-select">
										<span title="- เลือกจังหวัด -">- เลือกจังหวัด -</span>
										<select class="p-Absolute" name="province">
										 
										<?php
											$sql = "SELECT PROVINCE_ID , ".$provinceColumn." FROM mas_province ORDER BY PROVINCE_DESC_LOC";
											$query = mysql_query($sql,$conn);
											while($rowProvince = mysql_fetch_array($query)){
												$selectedOption = "" ;
											 
										?>
											<option value="<?=$rowProvince['PROVINCE_ID'] ?>" <?=$selectedOption ?> ><?=$rowProvince['PROVINCE_DESC'] ?></option>
										<? } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>รหัสไปรษณีย์*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtPostCode" value=""></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>โทรศัพท์*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name="txtPhone" value=""></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>โทรศัพท์มือถือ*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtMobile" value=""></div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>โทรสาร*</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtFax" value=""></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>เว็บไซต์</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtWebSite" value="" ></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Email</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtEmail" value="" ></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Map(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" onclick="$('#browseMapLoc').click();">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img id="imgMapLoc"  src=""></div>
									<a class="btn-delete deleteMap" data-id="MapLoc" ></a>
									<input type='file' name ="browseMapLoc" id ="browseMapLoc" style="display:none" accept="image/*" />
									<input type="hidden" id = "hidMapLoc" name = "hidMapLoc"  value=""/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>Map(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" onclick="$('#browseMapEng').click();">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img id="imgMapEng" src=""></div>
									<a class="btn-delete deleteMap" data-id="MapEng"></a>
									<input type='file' name ="browseMapEng" id ="browseMapEng" style="display:none" accept="image/*" />
									<input type="hidden" id = "hidMapEng"  name = "hidMapEng" value="" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Google Map <br>(latitude,<br>longitude)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" placeholder="Latitude" name="txtLat" value=""></div>
							</div>
							<div class="box-input-text mT">
								<div><input type="text" placeholder="Longitude" name = "txtLon" value=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>วันและเวลาทำการ*</p>
						</div>
						<?php
						$openningSql = "select * from  trn_museum_openning where MUSEUM_ID = '-2' order by OPENNING_DAY asc";
						$openningQuery = mysql_query($openningSql, $conn);
						$monSelected = "";
						$tueSelected = "";
						$wedSelected = "";
						$thuSelected = "";
						$friSelected = "";
						$satSelected = "";
						$sunSelected = "";
						$startDate = "08:00";
						$endDate = "20:00";

						unset($dayOpen);
						unset($timeOpen);
						unset($timeClose);

						while ($rowOpenning = mysql_fetch_array($openningQuery)) {

							if ($rowOpenning['IS_CUSTOM_OPENNING'] == 'N') {
								$startDate = $rowOpenning['OPENNING_START_HOUR'];
								$endDate = $rowOpenning['OPENNING_END_HOUR'];
								switch ($rowOpenning['OPENNING_DAY']) {
									case 1 :
										$monSelected = " checked ";
										break;
									case 2 :
										$tueSelected = " checked ";
										break;
									case 3 :
										$wedSelected = " checked ";
										break;
									case 4 :
										$thuSelected = " checked ";
										break;
									case 5 :
										$friSelected = " checked ";
										break;
									case 6 :
										$satSelected = " checked ";
										break;
									case 7 :
										$sunSelected = " checked ";
										break;
								}
							} else {
								$dayOpen[$rowOpenning['OPENNING_DAY']] = " checked ";
								$timeOpen[$rowOpenning['OPENNING_DAY']] = $rowOpenning['OPENNING_START_HOUR'];
								$timeClose[$rowOpenning['OPENNING_DAY']] = $rowOpenning['OPENNING_END_HOUR'];
							}
						}
						?>
						<div class="box-right">
							<div class="box-input-text checkbox">

								<div>
									<input type="checkbox" name = "auto_open[]" value="1" <?=$monSelected ?>><span>จ</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="2" <?=$tueSelected ?>><span>อ</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="3" <?=$wedSelected ?>><span>พ</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="4" <?=$thuSelected ?>><span>พฤ</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="5" <?=$friSelected ?>><span>ศ</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="6" <?=$satSelected ?>><span>ส</span>
								</div>
								<div>
									<input type="checkbox" name = "auto_open[]" value="7" <?=$sunSelected ?>><span>อา</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">

						</div>
						<div class="box-right">
							<div class="box-input-text time">
								<p>เวลาทำการ <span class="amount-time" id="amount-time-all"><?=$startDate ?> - <?=$endDate ?></span></p>
								<div class="workingtime" data-box="all">
									<input type="hidden" name="startdate" class="startdate" value="<?=$startDate ?>" />
									<input type="hidden" name="enddate" class="enddate" value="<?=$endDate ?>" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black toogleworkingtimeBlock">กำหนดเอง</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<?
				$arrayDay = array("", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์", "วันอาทิตย์");
				$arrayShortDay = array("", "mon", "tue", "wed", "thu", "fri", "sat", "sun");
				for ($idx = 1; $idx <= 7; $idx++) {

					echo '<div class="box-max fixDateBox">';
					if (isset($dayOpen[$idx]))
						echo '<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="' . $idx . '" checked></div>';
					else
						echo '<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="' . $idx . '"></div>';
					echo '<div class="fixDateBoxDate">' . $arrayDay[$idx] . ' เวลาทำการ</div>';

					$timeStart = "08:00";
					$timeEnd = "20:00";
					if (isset($timeOpen[$idx]))
						$timeStart = $timeOpen[$idx];
					if (isset($timeClose[$idx]))
						$timeEnd = $timeClose[$idx];

					echo '<div class="fixDateBoxTime" id="amount-time-' . $arrayShortDay[$idx] . '">' . $timeStart . ' - ' . $timeEnd . '</div>';
					echo '<div class="fixDateBoxWorking workingtime" data-box="' . $arrayShortDay[$idx] . '">';

					echo '<input type="hidden" name="startdate' . $idx . '" class="startdate" value="' . $timeStart . '" />';
					echo '<input type="hidden" name="enddate' . $idx . '" class="enddate" value="' . $timeEnd . '" /> ';
					echo '</div> ';
					echo '<div class="clear"></div>';
					echo '</div>';

				}
				?>
				</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>อัตราค่าเข้าชม*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtRateLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>อัตราค่าเข้าชม*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtRateEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเดินทาง <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTransportLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเดินทาง <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTransportEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-title">
				<h2>พิพิธภัณฑ์</h2>
			</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ประวัติความเป็นมา <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtStoryLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ประวัติความเป็นมา <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtStoryEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseStoryPic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<!--
									ความเป็นมา Type = 1
									กายภาพ  =2
									ภูมิทัศน์โดยรอบ = 3
									ห้องจัดแสดง =4
									วัตถุจัดแสดง =5
									วัตถุสำคัญ =6
									การจัดเก็บ = 7
									การเผยแพร่ ประชาสัมพันธ์ = 8
									แหล่งเรียนรู้ใกล้เคียง = 9
									-->
								<? echo frontend_mdn_upload_image_edit('HIS', '1', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtPhysicalLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtPhysicalEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowsePhysicalPic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('PHY', '2', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภูมิทัศน์โดยรอบ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtLandscapeLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภูมิทัศน์โดยรอบ<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtLandscapeEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseLandScapePic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('LAND', '3', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภาพถ่ายห้องจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtExhibitionLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภาพถ่ายห้องจัดแสดง<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtExhibitionEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseExhibitionPic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('EXH', '4', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtArchiveLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtArchiveEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseArchivePic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('ARC', '5', -2); ?>
						</div>
					</div>
				</div>
			</div>
		
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>ที่มีความสำคัญ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTopArchiveLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>ที่มีความสำคัญ<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTopArchiveEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseTopArchivePic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('TOP_ARC', '6', -2); ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การจัดเก็บ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtStorageLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การจัดเก็บ <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtStorageEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseStoragePic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('STORAGE', '7', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ชมกลุ่มเป้าหมาย<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTargetLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ชมกลุ่มเป้าหมาย<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtTargetEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเผยแพร่และ<br>ประชาสัมพันธ์ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtPublicInforLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>การเผยแพร่และ<br>ประชาสัมพันธ์  <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtPublicInforEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowsePublicInfoPic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('PUBLIC_INFO', '8', -2); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ดูแลและหน่วยงานที่<br>รับผิดชอบในปัจจุบัน*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtResponsibleLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ผู้ดูแลและหน่วยงานที่<br>รับผิดชอบในปัจจุบัน*<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtResponsibleEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>แหล่งเรียนรู้อื่นๆ <br>ในเขตพื้นที่ใกล้เคียง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtNearbyLoc"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>แหล่งเรียนรู้อื่นๆ <br>ในเขตพื้นที่ใกล้เคียง<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="txtNearbyEng"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">

						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black" id="btnBrowseNearbyPic">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<? echo frontend_mdn_upload_image_edit('NEARBY', '9', -2); ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Loop Museum Category-->
			<?
			if($_SESSION['LANG'] == 'TH'){
				$catSelectedColumn = " CONTENT_CAT_DESC_LOC as CAT_DESC , ";
				$subCatSelectedColumn = " SUB_CONTENT_CAT_DESC_LOC as SUB_CAT_DESC " ;
			}
			else{
				$catSelectedColumn = " CONTENT_CAT_DESC_ENG as CAT_DESC , ";
				$subCatSelectedColumn = " SUB_CONTENT_CAT_DESC_ENG as SUB_CAT_DESC " ;
				}
			 


			//var_dump($currentCatSubCatArr);
			$catMuseumSql = "SELECT
								CONTENT_CAT_ID, " . $catSelectedColumn .
								" IS_LAST_NODE
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = ".$museum_data_network_module_id.
							" AND flag = 0
							 AND CONTENT_CAT_ID <> ".$regionCategory.
							" AND IS_LAST_NODE = 'N' order by ORDER_DATA desc ";
						$rsCat = mysql_query($catMuseumSql) or die(mysql_error());
						while ($rowCat = mysql_fetch_array($rsCat)) {
			?>
			<div class="box-line cf"><hr></div>

			<div class="row-main cf">
				<div class="box-left box-left-full">
					<div class="box-row cf">
						<div class="box-left">
							<p><?=$rowCat['CAT_DESC'] ?></p>
						</div>
						<div class="box-right box-right-full">
							<?
							$subCatMuseumSql = "SELECT
													SUB_CONTENT_CAT_ID, " . $subCatSelectedColumn . " FROM
													trn_content_sub_category
												WHERE
													CONTENT_CAT_ID = " . $rowCat['CONTENT_CAT_ID'] . " AND flag = 0
												ORDER BY
													ORDER_DATA DESC";

							$rsSubCat = mysql_query($subCatMuseumSql) or die(mysql_error());
							 ?>
							<div class="box-input-text checkbox">
								<div>
									<ul class="catItems">
										<?while ($rowSubCat = mysql_fetch_array($rsSubCat)) {	?>
										<li>
									 <label>
									 	<?
										$isChecked = "";
										 
										?>
											 <input type="checkbox" name= "catMuseum[]" value="<?=$rowCat['CONTENT_CAT_ID'] . '|' . $rowSubCat['SUB_CONTENT_CAT_ID'] ?>" <?=$isChecked ?>>
									<?=$rowSubCat['SUB_CAT_DESC'] ?></label></li>
				<?} ?>

													</ul>
													</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			<?} ?>

			<!-- End Loop-->
			<div class="box-line cf"><hr></div>

			<div class="box-title">
				<h2>Social Network</h2>
			</div>

			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Facebook</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name= "txtFacebookURL" value=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Twitter</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name= "txtTwitterURL" value=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Youtube</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name= "txtYoutubeURL" value = ""></div>

							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="box-btn-main cf">
				<div class="box-btn">
					<a class="btn black btnReset">ยกเลิก</a>
					<a class="btn black btnSubmit">ตกลง</a>
				</div>
			</div>
		</div>
	</div>
</form>
</div>



<div class="box-freespace"></div>



<?php
include ('inc/inc-footer.php');
 ?>


</body>
</html>
