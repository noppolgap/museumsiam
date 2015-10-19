<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/organizetion.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu2,.menu-left li.menu2").addClass("active");
		
		$('.box-group').on('click', function(e){ 
			$(".box-group").next().slideUp();
			$(".box-group").removeClass("active");
			e.stopPropagation();
			if ($(this).hasClass("opened")) {
				$(".box-group").next().slideUp();
				$(".box-group").removeClass("opened");
				$(this).next().slideUp();
				$(this).removeClass("active");
				$(this).removeClass("opened");
			}else{
				$(".box-group").removeClass("opened");
				$(this).next().slideDown();
				$(this).addClass("active");
				$(this).addClass("opened");
			}
		});
	});
</script>
	
</head>

<body id="organizetion">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>รู้จักเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">โครงสร้างของเราs</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-about.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>โครงสร้างองค์กร
					<span>สถาบันพิพิธภัณฑ์การเรียนรู้แห่งชาติ</span>
				</h1>
			</div>
			<div class="box-ceo">
				<p class="position-text">รอง ผอ.สบร. และ ผอ.สพร.</p>
				<p class="name-text">นายราเมศ พรหมเย็น</p>
			</div>
			<div class="box-acco-main">
				
			<div class="group-row cf">
				<div class="box-group">
					ชื่อฝ่าย
				</div>
				<div class="content-hide">
					<div class="box-group-detail">
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
					</div>
				</div>	
			</div>
				
			<div class="group-row cf">
				<div class="box-group">
					ชื่อฝ่าย
				</div>
				<div class="content-hide">
					<div class="box-group-detail">
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						
						<div class="department">ชื่อแผนก</div>
						<ul class="list-role">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
						<ul class="list-position">
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
							<li>ชื่อตำแหน่ง</li>
						</ul>
					</div>
				</div>	
			</div>
				
				
				
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
