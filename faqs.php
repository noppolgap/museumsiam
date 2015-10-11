<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/faqs.css" />

<script>
	$(document).ready(function(){
		$("li.menu7").addClass("active");	
		
		$('.box-q').on('click', function(e){ 
			$(".box-q").next().slideUp();
			$(".box-q").removeClass("active");
			e.stopPropagation();
			if ($(this).hasClass("opened")) {
				$(".box-q").next().slideUp();
				$(".box-q").removeClass("opened");
				$(this).next().slideUp();
				$(this).removeClass("active");
				$(this).removeClass("opened");
			}else{
				$(".box-q").removeClass("opened");
				$(this).next().slideDown();
				$(this).addClass("active");
				$(this).addClass("opened");
			}
		});

			
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>	
	
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ถาม-ตอบ</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p style="text-transform: capitalize;">
				FAQs<br>
				<span>ถาม-ตอบ</span>
			</p>	
		</div>
	</div>
</div>

<?php

			    $sq_qa = " SELECT QA_ID, CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_qa
						  WHERE REF_QA_ID = 0
						  AND FLAG  <> 2 ORDER BY ORDER_DATA ";

				$query_qa = mysql_query($sq_qa, $conn);

				$num_rows = mysql_num_rows($query_qa);

				
?>

<div class="part-faq-main">
	<div class="container">
		<div class="box-faq-main">

			<?php while($row = mysql_fetch_array($query_qa)) {
					////ส่วนคำตอบ
			       $sq_ans = " SELECT QA_ID ,CONTENT, USER_CREATE, LAST_UPDATE_DATE FROM trn_qa
								WHERE REF_QA_ID = ".$row['QA_ID']." AND FLAG <> 2 ";

					$query_ans = mysql_query($sq_ans, $conn);

					$num_rows = mysql_num_rows($query_ans);
			?>

			<div class="faq-row cf">
				<div class="box-q">
					<span class="tri-q"></span>
					<? echo $row['CONTENT'] ?>
				</div>

				<? while($row_ans = mysql_fetch_array($query_ans)) {?>

					<div class="content-hide">
						<div class="box-a">
							<span class="tri-a"></span>
							<? echo $row_ans['CONTENT'] ?>
						</div>
					</div>
			    <? }  ?>	
			</div>

		 <? }  ?>
			
		</div>
	</div>
</div>


<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
