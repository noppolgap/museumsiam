<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");

$CONID = intval($_GET['CONID']);

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
		$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu1").addClass("active");
			if ($('.menu-left li.menu2').hasClass("active")){
				$('.menu-left li.menu2').children(".submenu-left").css("display","block");
			}
	});
</script>
	
</head>

<body id="detail">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><?=$contactUsCap?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="contact-eapp.php"><?=$positionCap?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$position_nameCap?></li>
				
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
				<h1>
					<img src="images/th/contact/title5.png" alt="รายละเอียดตำแหน่งงาน"/>
				</h1>
			</div>
			<hr class="line-gray"/>

			<?php 

					if ($_SESSION['LANG'] == 'TH') {
						$LANG_SQL = "CONTENT_DESC_LOC AS CONTENT_DESC";
					} else if ($_SESSION['LANG'] == 'EN') {
						$LANG_SQL = "CONTENT_DESC_ENG AS CONTENT_DESC";
					}

			        $sql= " SELECT ".$LANG_SQL.", CONTENT_ID , PRICE_RATE_LOC, CREATE_DATE, CONTENT_DETAIL_LOC
							FROM trn_content_detail  
							WHERE CONTENT_STATUS_FLAG = 0 AND CAT_ID = $position_sub_cat AND CONTENT_ID = $CONID " ;  

				    $sql .= "order by ORDER_DATA desc";

				   	$query = mysql_query($sql,$conn);  

				   	while($row = mysql_fetch_array($query)) {

 			?>

			
			<div class="box-carrer-main">
				<div class="box-row">
					<div class="box-top cf">
						<h3><? echo $row['CONTENT_DESC'] ?></h3>
						<div class="number"><span><? echo $row['PRICE_RATE_LOC'] ?></span> อัตรา</div>
					</div>
					<div class="box-bottom cf">
						<div class="box-footer-content cf">
							<div class="box-date-modified">
								<?=$lastEditCap?> :  <? echo ConvertDate($row['CREATE_DATE']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box-detail-main">
				<? echo $row['CONTENT_DETAIL_LOC'] ?>
				
				<div class="box-btn cf">
					<a href="contact-eapp-register.php" class="btn red">Apply job</a>
				</div>

			</div>

			<? } ?>
			<div class="box-pagination-main cf">
				<div class="box-btn">
					<a href="contact-eapp.php" class="btn black"><?=$backCap?></a>
				</div>
			</div>					
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
