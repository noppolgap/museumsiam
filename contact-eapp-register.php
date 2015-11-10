<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/contact.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu3").addClass("active");
			if ($('.menu-left li.menu2').hasClass("active")){
				$('.menu-left li.menu2').children(".submenu-left").css("display","block");
			}
	});
</script>

</head>

<body id="register">

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><?=$contactUsCap?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$fillInfoCap?></li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-contact.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>E-APPLICATION
					<span><?=$term_and_condition?></span>
				</h1>
			</div>
			<hr class="line-gray"/>


			<?php 

					if ($_SESSION['LANG'] == 'TH') {
						$LANG_SQL = "CONTENT_DESC_LOC AS CONTENT_DESC";
					} else if ($_SESSION['LANG'] == 'EN') {
						$LANG_SQL = "CONTENT_DESC_ENG AS CONTENT_DESC";
					}

			        $sql= " SELECT ".$LANG_SQL."
							FROM trn_content_detail  
							WHERE CONTENT_STATUS_FLAG = 0 AND CAT_ID = $position_sub_cat AND CONTENT_ID = $CONID " ;  

				    $sql .= "order by ORDER_DATA desc";

				   	$query = mysql_query($sql,$conn);  

			?>

				<form action="e-application-action.php?add" method="post" name="formcms" id = "myform" enctype="multipart/form-data" >
					<div class="box-contact-from">
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Specify type of job onterested</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<? while($row = mysql_fetch_array($query)) {  ?>
										<div><input type="text" name="jobname" id="jobname" value="<?=$row['CONTENT_DESC']?>"></div>
									<? } ?>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con"><?=$nameCap?> <?=$sureName?></p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="name_th" id="name_th"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Name (English Language)</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="name_eng" id="name_eng"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con"><?=$gender?></p>
							</div>
							<div class="box-right">
								<div class="box-input-text radio">
									<div><input type="radio" name="sex" value="male" checked>ชาย</div>
									<div><input type="radio" name="sex" value="female">หญิง</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con"><?=$birthDate?></p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="birthdate" id="birthdate" class="DatePicker"></div>
								</div>
							</div>
						</div>

						<div class="box-row cf">
							<div class="box-left">
								<p>Nataionlity (สัญชาติ)</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="nationality"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เบอร์โทรศัพท์</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="telephone" id="telephone"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">อีเมล</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="email" id="email"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">เบอร์โทรศัพท์มือถือ</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="mobile" id="mobile"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Present Address</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><textarea name="address" id="address"></textarea></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Photograph</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red" onclick="$('#MyPhotograph').click(); return false;">browse</a>
											<input type="file" name="MyPhotograph" id="MyPhotograph" accept="image/*" style="display:none">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Resume</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red" onclick="$('#MyResume').click(); return false;">browse</a>
											<input type="file" name="MyResume" id="MyResume" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.txt" style="display:none">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p>Upload Your Application Form</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" class="btn red" onclick="$('#MyApplication').click(); return false;">browse</a>
											<input type="file" name="MyApplication" id="MyApplication" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.txt" style="display:none">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<p class="con">Salary Desired</p>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div><input type="text" name="salary" id="salary"></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<div class="box-input-text">
								</div>
							</div>
							<div class="box-right">
								<div class="box-input-text">
									<div class="g-recaptcha" data-sitekey="6Ld2VgwTAAAAAEmFQsLXE8zem5b7CCg3Jxbjds6p"></div>
									<div><span>*กรุณกดเพื่อยืนยันตัวตนว่าคุณไม่ใช่โปรแกรมอัตโนมัติ</span></div>
								</div>
							</div>
						</div>
						<div class="box-row cf">
							<div class="box-left">
								<div class="box-input-text">
									<div>
										<div class="box-btn submit">
											<a href="#" onclick="checkForm(); return false;" class="btnSubmit btn red">ตกลง</a>
											<a href="#myform" onclick="$('#myform')[0].reset();" class="btnReset btn red">ยกเลิก</a>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
							</div>
						</div>
					</div>

				</form>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>
<script type="text/javascript" src="//www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="js/contact_eapp.js"></script>

</body>
</html>
<? CloseDB(); ?>
