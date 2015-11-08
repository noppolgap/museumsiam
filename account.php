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
		$(".menu-left li.menu1").addClass("active");
	});
</script>

</head>

<body id="account">


<?php
	include ('inc/inc-top-bar.php');
 ?>
<?php
	include ('inc/inc-menu.php');
 ?>
<?php
require ('inc/inc-require-userlogin.php');
if ($_SESSION['LANG'] == 'TH') {
 $picFolder = 'th';
} else {
 $picFolder = 'en';
}
?>

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><?=$account_setting?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$profile ?></li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/<?=$picFolder?>/title-accout.png" alt="ACCOUNT SETTINGS"/>
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


		<?php
		//$sqlUser = "select * from sys_app_user where USER_ID = '".$_SESSION['user_name'] ."'";
		$selectedColumn = "";
		if ($_SESSION['LANG'] == 'TH')
			$selectedColumn = "district.DISTRICT_DESC_LOC as DISTRICT_DESC ,subDistrict.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC ,province.PROVINCE_DESC_LOC as PROVINCE_DESC , t.TITLE_DESC_LOC as TITLE_DESC , s.SEX_DESC_LOC as SEX_DESC ";
		else
			$selectedColumn = "district.DISTRICT_DESC_ENG as DISTRICT_DESC ,subDistrict.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC ,province.PROVINCE_DESC_ENG as PROVINCE_DESC , t.TITLE_DESC_ENG as TITLE_DESC , s.SEX_DESC_ENG as SEX_DESC ";

		$sqlUser = "SELECT
						u.*, " . $selectedColumn;
		$sqlUser .= "	FROM
						sys_app_user u
					INNER JOIN mas_district district ON district.DISTRICT_ID = u.DISTRICT_ID
					INNER JOIN mas_sub_district subDistrict ON subDistrict.SUB_DISTRICT_ID = u.SUB_DISTRICT_ID
					INNER JOIN mas_province province ON province.PROVINCE_ID = u.PROVINCE_ID
					LEFT JOIN mas_title_name t on t.TITLE_ID = u.TITLE
					LEFT JOIN mas_sex s on s.SEX_ID = u.SEX
					WHERE
						u.USER_ID = '" . $_SESSION['user_name'] . "'
					AND ACTIVE_FLAG = '1' ";

			//		echo $sqlUser ;
		$rs = mysql_query($sqlUser) or die(mysql_error());
		$row = mysql_fetch_array($rs);
		?>

		<div class="box-account-right cf">
			<div class="box-title">
				<h1><?=$profile?></h1>
			</div>
			<div class="box-left">
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$nameCap?> - <?=$sureName?></p>
					</div>
					<div class="box-right">

						<p><?=$row['TITLE_DESC']." ". $row['NAME'] . " " . $row['LAST_NAME'] ?></p>

					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$gender?></p>
					</div>
					<div class="box-right">

						<p><?=$row['SEX_DESC'] ?></p>

					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$birthDate?></p>
					</div>
					<div class="box-right">
						<p><?=displaydateformatlong($row['BIRTHDAY']) ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$tel?></p>
					</div>
					<div class="box-right">
						<p><?=$row['TELEPHONE'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$mobile?></p>
					</div>
					<div class="box-right">
						<p><?=$row['MOBILE_PHONE'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$fax?></p>
					</div>
					<div class="box-right">
						<p><?=$row['FAX'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$idCard?></p>
					</div>
					<div class="box-right">
						<p><?=$row['CITIZEN_ID'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$address?></p>
					</div>
					<div class="box-right">
						<p><?=$row['ADDRESS1'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$sub_district?></p>
					</div>
					<div class="box-right">
						<p><?=$row['SUB_DISTRICT_DESC'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$district?></p>
					</div>
					<div class="box-right">
						<p><?=$row['DISTRICT_DESC'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$province?></p>
					</div>
					<div class="box-right">
						<p><?=$row['PROVINCE_DESC'] ?></p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p><?=$postcode?></p>
					</div>
					<div class="box-right">
						<p><?=$row['POST_CODE'] ?></p>
					</div>
				</div>
			</div>
			<div class="box-right">
				<div class="box-user">
					<div class="box-pic">
					<?php
						if((isset($_SESSION['FB'])) AND ($avatarPath == '')){
							$avatarPath = 'http://graph.facebook.com/'.$_SESSION['FB'].'/picture?type=normal';
						}else{
							$avatarPath = nvl( $row['IMAGE_PATH'] , 'images/account/user.jpg');
						}
					?>
						<img src="<?=$avatarPath?>"/>
					</div>
					<div class="box-detail cf">
						<div class="box-name">
							<h2><?=$row['TITLE_DESC']." ".$row['NAME'] . " " . $row['LAST_NAME'] ?></h2>
						</div>
						<p>LOG IN <?=$last?></p>
						<div class="row cf">
							<?php
							if(!isset($_SESSION['FB'])){
								$USER_ID = $_SESSION['user_name'];
							}else{
								$USER_ID = $_SESSION['FB'];
							}

							$logSql = "select max(LOGIN_DATE) as LOGIN_DATE from log_user_login where USER_ID = '" . $USER_ID  . "'";
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
							<div class="box-left">
								<a href="account-edit.php" class="ed"><?=$edit?></a>
							</div>
							<div class="box-right">
								<a href="logout.php" class="lu"><?=$exit?></a>
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
include ('inc/inc-footer.php');
 ?>

</body>
</html>
