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
		$(".menutop li.menu8,.menu-left li.menu2,.menu-left li.menu2 .submenu1").addClass("active");
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
				<li><?=$contactUsCap?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>E-APPLICATION&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active"><?=$positionCap?></li>
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
					<img src="images/th/contact/title2.png" alt="ตำแหน่งงาน"/>
				</h1>
			</div>
			<div class="box-carrer-main">

				<?php 

					if ($_SESSION['LANG'] == 'TH') {
						$LANG_SQL = "CONTENT_DESC_LOC AS CONTENT_DESC";
					} else if ($_SESSION['LANG'] == 'EN') {
						$LANG_SQL = "CONTENT_DESC_ENG AS CONTENT_DESC";
					}

			        $sql= " SELECT ".$LANG_SQL.", CONTENT_ID , PRICE_RATE_LOC
							FROM trn_content_detail  
							WHERE CONTENT_STATUS_FLAG = 0 AND CAT_ID = $position_sub_cat " ;  

				    $sql .= "order by ORDER_DATA desc";

				   	$query = mysql_query($sql,$conn);  

				   	while($row = mysql_fetch_array($query)) {

 				?>

				<div class="box-row">
					<div class="box-top cf">
						<h3><? echo $row['CONTENT_DESC'] ?></h3>
						<div class="number"><span><? echo $row['PRICE_RATE_LOC'] ?></span> <?=$positionUnitCap?></div>
					</div>
					<div class="box-bottom">
						<div class="box-btn cf">
							<a href="contact-eapp-detail.php?CONID=<?=$row['CONTENT_ID'] ?>" class="btn red"><?=$detailCap?></a>
							<a href="contact-eapp-register.php?CONID=<?=$row['CONTENT_ID']?>" class="btn red"><?=$applyJobCap?></a>
						</div>						
					</div>
				</div>

				<? } ?>
				
				<div class="box-pagination-main cf">
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
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
