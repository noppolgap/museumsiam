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

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
<link rel="stylesheet" type="text/css" href="css/account-museum.css" />
<script>
	$(document).ready(function() {
		$(".menu-left li.menu5,.menu-left li.menu5 li.submenu1").addClass("active");
		if ($('.menu-left li.menu5').hasClass("active")) {
			$('.menu-left li.menu5').children(".submenu-left").css("display", "block");
		}
	}); 
</script>
	
</head>

<body id="account">
	
<?php
include ('inc/inc-top-bar.php');
 ?>
<?php
include ('inc/inc-menu.php');
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

$mdnSql = "SELECT
					tmd.*, " . $selectedColumn;
$mdnSql .= "	FROM
					mapping_museum_admin mma
				LEFT JOIN trn_museum_detail tmd ON tmd.MUSEUM_DETAIL_ID = mma.MUSEUM_DETAIL_ID
				LEFT JOIN mas_province province ON province.PROVINCE_ID = tmd.PROVINCE_ID
				LEFT JOIN mas_district district ON district.DISTRICT_ID = tmd.DISTRICT_ID
				LEFT JOIN mas_sub_district subDis ON subDis.SUB_DISTRICT_ID = tmd.SUB_DISTRICT_ID
				WHERE
					mma.ADMIN_USER_ID = '" . $_SESSION['user_name'] . "' ";
$mdnSql .= "	AND tmd.ACTIVE_FLAG = 1
				AND tmd.IS_GIS_MUSEUM = 'N' AND APPROVE_FLAG = 'Y'";

$rs = mysql_query($mdnSql) or die(mysql_error());
$row = mysql_fetch_array($rs);
?>
<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>จัดการพิพิธภัณฑ์&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">รายละเอียดพิพิธภัณฑ์</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/<?=$picFolder ?>/title-accout.png" alt="ACCOUNT SETTINGS"/>
			</p>	
		</div>
	</div>
</div>

<div class="part-account-main">
	<div class="container cf">
		<div class="box-account-left">
			<?php
			include ('inc/inc-account-menu.php');
 ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1>จัดการพิพิธภัณฑ์ - รายละเอียดพิพิธภัณฑ์</h1>
			</div>
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อพิพิธภัณฑ์*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" name = "txtNameLoc" value="<?=$row['MUSEUM_NAME_LOC'] ?>"></div>
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
								<div><input type="text" name="txtNameEng" value="<?=$row['MUSEUM_NAME_ENG'] ?>"></div>
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
								<div style="height: 120px;"><textarea name="addressLoc"><?=$row['ADDRESS1'] ?></textarea></div>
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
								<div style="height: 120px;"><textarea name="addressEng"><?=$row['ADDRESS2'] ?></textarea></div>
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
									<div class="SearchMenu-item province_box box-select">
										<span title="- เลือกจังหวัด -"><?=$row['SUB_DISTRICT_DESC'] ?></span>
										<select class="p-Absolute" name="subDistrict">
											<option value="0"><?=$row['SUB_DISTRICT_DESC'] ?></option>
										<?php
											$sql = "SELECT SUB_DISTRICT_ID , ".$subDistrictColumn." FROM mas_sub_district where DISTRICT_ID = '".$row["DISTRICT_ID"]."' ORDER BY SUB_DISTRICT_ID ";
											$query = mysql_query($sql,$conn);	
											while($rowSubDis = mysql_fetch_array($query)){
												$selectedOption = "";
												if($rowSubDis['SUB_DISTRICT_ID'] == $row['SUB_DISTRICT_ID'])
													$selectedOption = "selected";
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
									<div class="SearchMenu-item province_box box-select">
										<span title="- เลือกจังหวัด -"><?=$row['DISTRICT_DESC'] ?></span>
										<select class="p-Absolute" name="district">
											<option value="0"><?=$row['DISTRICT_DESC'] ?></option>
										<?php
											$sql = "SELECT DISTRICT_ID  , ".$districtColumn." FROM mas_district where province_id = '".$row['PROVINCE_ID']."' ORDER BY DISTRICT_ID Asc";
											$query = mysql_query($sql,$conn);	
											while($rowDistrict = mysql_fetch_array($query)){
													$selectedOption = "" ; 
													if($row['DISTRICT_ID'] == $rowDistrict['DISTRICT_ID'])
														$selectedOption = "selected";
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
										<span title="- เลือกจังหวัด -"><?=$row['PROVINCE_DESC'] ?></span>
										<select class="p-Absolute" name="province">
											<option value="0"><?=$row['PROVINCE_DESC'] ?></option>
										<?php
											$sql = "SELECT PROVINCE_ID , ".$provinceColumn." FROM mas_province ORDER BY PROVINCE_DESC_LOC";
											$query = mysql_query($sql,$conn);	
											while($rowProvince = mysql_fetch_array($query)){
												$selectedOption = "" ;
												if($rowProvince['PROVINCE_ID'] == $row['PROVINCE_ID'])
													$selectedOption = "selected" ; 
										?>		
											<option value="<?=$rowProvince['PROVINCE_ID'] ?>" <?=$selectedOption ?> ><?=$rowProvince['PROVINCE_DESC_LOC'] ?></option>									
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
								<div><input type="text" name = "txtPostCode" value="<?=$row['POST_CODE'] ?>"></div>
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
								<div><input type="text" name="txtPhone" value="<?=$row['TELEPHONE'] ?>"></div>
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
								<div><input type="text" name = "txtFax" value="<?=$row['FAX'] ?>"></div>
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
								<div><input type="text" name = "txtWebSite" value="<?=$row['WEBSITE_URL'] ?>" ></div>
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
									<a class="btn black">BROWSE</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf ">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
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
								<div><input type="text" placeholder="Latitude" name="txtLat" value="<?=$row['LAT'] ?>"></div>
							</div>
							<div class="box-input-text mT">
								<div><input type="text" placeholder="Longitude" name = "txtLon" value="<?=$row['LON'] ?>"></div>
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
						$openningSql = "select * from  trn_museum_openning where MUSEUM_ID = '" . $row['MUSEUM_DETAIL_ID'] . "' order by OPENNING_DAY asc";
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
				
					<!-- <div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="1"></div>
						<div class="fixDateBoxDate">วันจันทร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-mon">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="mon">
							<input type="hidden" name="startdate1" class="startdate" value="08:00" />
							<input type="hidden" name="enddate1" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="2"></div>
						<div class="fixDateBoxDate">วันอังคาร เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-tue">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="tue">
							<input type="hidden" name="startdate2" class="startdate" value="08:00" />
							<input type="hidden" name="enddate2" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="3"></div>
						<div class="fixDateBoxDate">วันพุธ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-wed">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="wed">
							<input type="hidden" name="startdate3" class="startdate" value="08:00" />
							<input type="hidden" name="enddate3" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="4"></div>
						<div class="fixDateBoxDate">วันพฤหัสบดี เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-thu">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="thu">
							<input type="hidden" name="startdate4" class="startdate" value="08:00" />
							<input type="hidden" name="enddate4" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="5"></div>
						<div class="fixDateBoxDate">วันศุกร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-fri">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="fri">
							<input type="hidden" name="startdate5" class="startdate" value="08:00" />
							<input type="hidden" name="enddate5" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="6"></div>
						<div class="fixDateBoxDate">วันเสาร์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sat">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sat">
							<input type="hidden" name="startdate6" class="startdate" value="08:00" />
							<input type="hidden" name="enddate6" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div>
					<div class="box-max fixDateBox">
						<div class="fixDateBoxInput"><input type="checkbox" name="date[]" value="7"></div>
						<div class="fixDateBoxDate">วันอาทิตย์ เวลาทำการ</div>
						<div class="fixDateBoxTime" id="amount-time-sun">08:00 - 20:00</div>
						<div class="fixDateBoxWorking workingtime" data-box="sun">
							<input type="hidden" name="startdate7" class="startdate" value="08:00" />
							<input type="hidden" name="enddate7" class="enddate" value="20:00" />
						</div> 
						<div class="clear"></div>
					</div> -->
				</div>
				
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>อัตราค่าเข้าชม*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ลักษณะทางกายภาพ<br>ของพิพิธภัณฑ์/<br>แหล่งเรียนรู้<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>ภูมิทัศน์โดยรอบ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภูมิทัศน์โดยรอบ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>ภาพถ่ายห้องจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ภาพถ่ายห้องจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>วัตถุจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>วัตถุจัดแสดง<br>ที่มีความสำคัญ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>วัตถุจัดแสดง<br>ที่มีความสำคัญ<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>การจัดเก็บ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>ผู้ชมกลุ่มเป้าหมาย<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
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
							<p>ผู้ดูแลและหน่วยงานที่<br>รับผิดชอบในปัจจุบัน*<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
								<div style="height: 120px;"><textarea name="address"></textarea></div>
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
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
								<div class="box-tumb">
									<div class="box-pic"><img src="http://placehold.it/274x205"></div>
									<a class="btn-delete"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
								<div><input type="text"></div>
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
								<div><input type="text"></div>
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
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			

			<div class="box-btn-main cf">
				<div class="box-btn">
					<a class="btn black">ยกเลิก</a>
					<a class="btn black">ตกลง</a>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php
include ('inc/inc-footer.php');
 ?>	
<script type="text/javascript">
	$(function() {
		$(".workingtime").slider({
			range : true,
			min : 0,
			max : 1440,
			step : 5,
			values : [480, 1080],
			slide : function(event, ui) {
				var hours1 = Math.floor(ui.values[0] / 60);
				var minutes1 = ui.values[0] - (hours1 * 60);

				if (hours1 < 10)
					hours1 = '0' + hours1;
				if (minutes1 < 10)
					minutes1 = '0' + minutes1;

				if (minutes1 == 0)
					minutes1 = '00';

				var hours2 = Math.floor(ui.values[1] / 60);
				var minutes2 = ui.values[1] - (hours2 * 60);

				if (hours2 < 10)
					hours2 = '0' + hours2;
				if (minutes2 < 10)
					minutes2 = '0' + minutes2;

				if (minutes2 == 0)
					minutes2 = '00';

				var id = $(this).attr("data-box");
				$('#amount-time-' + id).text(hours1 + ':' + minutes1 + ' - ' + hours2 + ':' + minutes2);
				$(this).find('.startdate').val(hours1 + ':' + minutes1);
				$(this).find('.enddate').val(hours2 + ':' + minutes2);
			}
		});

		$('.toogleworkingtimeBlock').on("click", function(e) {
			$('.fixDateBox').toggle('blind');
			e.preventDefault();
			e.stopPropagation();
		});

		$('input[name="date[]"]').bind('change', function() {
			$('input[name="auto_open[]"]').prop("checked", false);
		});

		$('input[name="auto_open[]"]').bind('change', function() {
			$('input[name="date[]"]').prop("checked", false);
		});

	}); 
</script>
</body>
</html>
