<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-report.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu6").addClass("active");
		$('.box-notice>.box-btn').on('click', function(e){
			$(".box-notice>.box-btn").next().slideUp();
			$(".box-notice>.box-btn").removeClass("active");
			e.stopPropagation();
			if ($(this).hasClass("opened")) {
				$(".box-notice>.box-btn").next().slideUp();
				$(".box-notice>.box-btn").removeClass("opened");
				$(this).next().slideUp();
				$(this).removeClass("active");
				$(this).removeClass("opened");
			}else{
				$(".box-notice>.box-btn").removeClass("opened");
				$(this).next().slideDown();
				$(this).addClass("active");
				$(this).addClass("opened");
			}
		});
		$( ".datepicker" ).datepicker({
			"dateFormat":"dd-mm-yy"
		});
	});
	function getReport(type,date1,date2){
		var start_date = $('#'+date1).val();
		var end_date = $('#'+date2).val();

		if(start_date == ''){
			alert('Please select start date');
		}else if(end_date == ''){
			alert('Please select end date');
		}else{
			var path = 'accout-report-file.php?type='+type+'&date1='+start_date+'&date2='+end_date;
			window.location.href = path;
		}
	}
</script>

</head>

<body id="account-report">

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">รายงานภาพรวมพิพิธภัณฑ์</li>
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
			<?php include('inc/inc-account-menu.php'); ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1>รายงานภาพรวมพิพิธภัณฑ์</h1>
			</div>

			<div class="box-news-main gray">
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">สมาชิก</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker1">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker2">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(1,'datepicker1','datepicker2');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">สมาชิกพิพิธพัณฑ์</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker3">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker4">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(2,'datepicker3','datepicker4');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">การจัดการความรู้</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker5">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker6">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(3,'datepicker5','datepicker6');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">คลังข้อมูลอิเล็คทรอนิกส์</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker7">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker8">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(4,'datepicker7','datepicker8');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ระบบเครือข่ายพิพิธภัณฑ์</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker9">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker10">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(5,'datepicker9','datepicker10');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">ระบบภูมิสารสนเทศบนเครือข่าย</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker11">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker12">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(6,'datepicker11','datepicker12');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">e-Booking</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker13">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker14">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(7,'datepicker13','datepicker14');return false;">ดาวน์โหลดรายงาน</a>
							</div>
						</div>
					</div>
				</div>
				<div class="box-notice">
					<div class="box-text">
						<p class="text-title">e-Shopping</p>
					</div>
					<div class="box-btn cf">
						<a class="btn red">แสดงรายงาน</a>
					</div>
					<div class="content-hide">
						<div class="box-content">
							<p>เลือกช่วงวันที่ต้องการ</p>
							<div class="box-input-row cf">
								<input type="text" class="datepicker" id="datepicker15">
								<span> ถึง</span>
								<input type="text" class="datepicker" id="datepicker16">
							</div>
							<div class="box-btn cf">
								<a class="btn red" href="#" onclick="getReport(8,'datepicker15','datepicker16');return false;">ดาวน์โหลดรายงาน</a>
							</div>
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
<? CloseDB(); ?>