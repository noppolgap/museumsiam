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
<script>
	$(document).ready(function() {
		$(".menu-left li.menu2").addClass("active");

		$('.btnSubmit').click(function(e) {
			$("#frmMain").submit();

			e.preventDefault();
			e.stopPropagation();
		});
	});
</script>
	
</head>

<body id="account">
	
<?php
include ('inc/inc-top-bar.php');
 ?>
<?php
include ('inc/inc-menu.php');
require ('inc/inc-require-userlogin.php');
 ?>	
<?php
//$sqlUser = "select * from sys_app_user where USER_ID = '".$_SESSION['user_name'] ."'";
$selectedColumn = "";
if ($_SESSION['LANG'] == 'TH')
	$selectedColumn = "district.DISTRICT_DESC_LOC as DISTRICT_DESC ,subDistrict.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC ,province.PROVINCE_DESC_LOC as PROVINCE_DESC , t.TITLE_DESC_LOC as TITLE_DESC  ";
else
	$selectedColumn = "district.DISTRICT_DESC_ENG as DISTRICT_DESC ,subDistrict.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC ,province.PROVINCE_DESC_ENG as PROVINCE_DESC , t.TITLE_DESC_ENG as TITLE_DESC  ";

$sqlUser = "SELECT
						u.*, " . $selectedColumn;
$sqlUser .= "	FROM
						sys_app_user u
					left JOIN mas_district district ON district.DISTRICT_ID = u.DISTRICT_ID
					left JOIN mas_sub_district subDistrict ON subDistrict.SUB_DISTRICT_ID = u.SUB_DISTRICT_ID
					left JOIN mas_province province ON province.PROVINCE_ID = u.PROVINCE_ID
					LEFT JOIN mas_title_name t on t.TITLE_ID = u.TITLE 
					LEFT JOIN mas_sex s on s.SEX_ID = u.SEX
					WHERE
						u.USER_ID = '" . $_SESSION['user_name'] . "'
					AND ACTIVE_FLAG = '1' ";

//echo $sqlUser ;
$rs = mysql_query($sqlUser) or die(mysql_error());
$row = mysql_fetch_array($rs);
		?>
		
		<form id = "frmMain" action="account-edit-action.php?edit" method="post"  enctype="multipart/form-data">
<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><?=$account_setting?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$edit?></li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/th/title-accout.png" alt="ACCOUNT SETTINGS"/>
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
				<h1><?=$edit?></h1>
			</div>
			<div class="box-left">
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$Title?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text radio">
							<?php
							$radio1Checked = '';
							$radio2Checked = '';
							$radio3Checked = '';
							if ($row['TITLE'] == 1)
								$radio1Checked = ' checked ';
							else if ($row['TITLE'] == 2)
								$radio2Checked = ' checked ';
							else if ($row['TITLE'] == 3)
								$radio3Checked = ' checked ';
							?>
							<div><input type="radio" name="title-name" value="1" <?=$radio1Checked ?>>นาย</div>
							<div><input type="radio" name="title-name" value="2" <?=$radio2Checked ?>>นาง</div>
							<div><input type="radio" name="title-name" value="3" <?=$radio3Checked ?>>นางสาว</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$nameCap?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name="name" value="<?=$row['NAME'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$sureName?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name="surname" value="<?=$row['LAST_NAME'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$gender?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text radio">
							<?php
							$maleSelected = '';
							$femaleSelected = '';
							if ($row['SEX'] == 'M')
								$maleSelected = ' checked ';
							else if ($row['SEX'] == 'F')
								$femaleSelected = ' checked ';
							?>
							<div><input type="radio" name="sex" value="M" <?=$maleSelected ?>>ชาย</div>
							<div><input type="radio" name="sex" value="F" <?=$femaleSelected ?>>หญิง</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$birthDate?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name = "birthday" value="<?=displaydateformatlong($row['BIRTHDAY']) ?>" class="DatePicker" ></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$tel?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name = "tel" value="<?=$row['TELEPHONE'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$mobile?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name  = "mobile" value="<?=$row['MOBILE_PHONE'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$fax?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name = "fax" value="<?=$row['FAX'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$idCard?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text" name = "citizen" value="<?=$row['CITIZEN_ID'] ?>"></div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">

					</div>
					<div class="box-right">
						<div class="box-input-text cf">
							<div class="box-btn fl">
								<a class="btn black checkEmail"><?=$checked?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$address?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><textarea name="address"><?=$row['ADDRESS1'] ?></textarea></div>
						</div>
					</div>
				</div>
				
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$province?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item province_box box-select">
									 <span title="- เลือกจังหวัด -"><?=$row['PROVINCE_DESC'] ?></span>
									<select class="p-Absolute" id='cmbProvince' name = 'cmbProvince'>
										 
									<?php
									$sql = "SELECT province_id  , province_desc_loc , province_desc_eng FROM mas_province ";
									$query = mysql_query($sql, $conn);
									while ($rowProvince = mysql_fetch_array($query)) {
										if ($row["PROVINCE_ID"] == $rowProvince["province_id"])
											echo "<option value='" . $rowProvince["province_id"] . "' selected>" . $rowProvince["province_desc_loc"] . "</option>";
										else
											echo "<option value='" . $rowProvince["province_id"] . "'>" . $rowProvince["province_desc_loc"] . "</option>";

									}
 ?>	
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$district?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item district_box box-select">
									<span title="- เลือกเขต -"><?=$row['DISTRICT_DESC'] ?></span>

									<select class="p-Absolute" id='cmbDistrict' name = 'cmbDistrict'>
										
									<?php
									$sql = "SELECT district_id , province_id , district_desc_loc , district_desc_eng FROM mas_district where province_id = '".$row["PROVINCE_ID"]."'";
									$query = mysql_query($sql, $conn);
									while ($rowDistrict = mysql_fetch_array($query)) {
										if ($row["DISTRICT_ID"] == $rowDistrict["district_id"])
											echo "<option value='" . $rowDistrict["district_id"] . "' data-ref='" . $rowDistrict["province_id"] . "' selected>" . $rowDistrict["district_desc_loc"] . "</option>";
										else
											echo "<option value='" . $rowDistrict["district_id"] . "' data-ref='" . $rowDistrict["province_id"] . "'>" . $rowDistrict["district_desc_loc"] . "</option>";
									}
 ?>	
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$sub_district?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div>
								<div class="SearchMenu-item sub_district_box box-select">
									<span title="- เลือกแขวง -"><?=$row['SUB_DISTRICT_DESC'] ?></span>
									<select class="p-Absolute" id='cmbSubDistrict' name = 'cmbSubDistrict'>>
	
									<?php
									$sql = "SELECT sub_district_id , district_id , sub_district_desc_loc , sub_district_desc_eng FROM mas_sub_district where district_id = '".$row["DISTRICT_ID"]."'";
									$query = mysql_query($sql, $conn);
									while ($rowSubDis = mysql_fetch_array($query)) {
										if ($row["SUB_DISTRICT_ID"] == $rowSubDis["sub_district_id"])
											echo "<option value='" . $rowSubDis["sub_district_id"] . "' data-ref='" . $rowSubDis["district_id"] . "' selected>" . $rowSubDis["sub_district_desc_loc"] . "</option>";
										else
											echo "<option value='" . $rowSubDis["sub_district_id"] . "' data-ref='" . $rowSubDis["district_id"] . "'>" . $rowSubDis["sub_district_desc_loc"] . "</option>";

									}
 ?>	
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$postcode?></p>
					</div>
					<div class="box-right">
						<div class="box-input-text">
							<div><input type="text"  name = "postcode" value="<?=$row['POST_CODE'] ?>"></div>
						</div>
					</div>
				</div>
			</div>
			<?php
						if((isset($_SESSION['FB'])) AND ($avatarPath == '')){
							$avatarPath = 'http://graph.facebook.com/'.$_SESSION['FB'].'/picture?type=normal';
						}else{
							$avatarPath = nvl( $row['IMAGE_PATH'] , 'images/account/user.jpg');
						}
					?>
						
			<div class="box-right">
				<div class="box-user">
					<div class="box-pic">
						<img id="imgAvatar" src="<?=$avatarPath?>"/>
					</div>
					<div class="box-detail cf">
						<div class="box-name">
							<h2><?=$row['TITLE_DESC'] . " " . $row['NAME'] . " " . $row['LAST_NAME'] ?></h2>
						</div>
						<p>LOG IN <?=$last?></p>
						<div class="row cf">
							<?php
							$logSql = "select max(LOGIN_DATE) as LOGIN_DATE from log_user_login where USER_ID = '" . $_SESSION['user_name'] . "'";
							$rsLog = mysql_query($logSql) or die(mysql_error());
							$rowLog = mysql_fetch_array($rsLog);
							?>
							<div class="box-left">
								<?=$date?>
							</div>
							<div class="box-right">
								<?=displaydateformatlong($rowLog['LOGIN_DATE'] )?>
							</div>
						</div>
						<div class="row cf">
							<div class="box-left">
								<?=$time?>
							</div>
							<div class="box-right">
								<?=displayTime($rowLog['LOGIN_DATE']) ?>
							</div>
						</div>
					</div>
					<div class="box-btn cf">
						<div class="row cf">
<!-- 							<div class="box-left"> -->
								<a onclick="$('#browseAvarta').click();" href="#" class="ac fl"><?=$edit_profile_pic?></a>
								<input type='file' name ="browseAvarta" id ="browseAvarta" style="display:none" accept="image/*" />
<!-- 							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="box-btn-main cf">
				<div class="box-btn">
					 <a class="btn black" href="account-edit.php"><?=$cancel?></a>
					<a class="btn black btnSubmit" ><?=$submit?></a>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>


</form>
<?php
include ('inc/inc-footer.php');
 ?>	
<script src="js/account-edit.js"></script>
</body>
</html>
