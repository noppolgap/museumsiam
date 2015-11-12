<?php
	$NOW_day = date('d');
	$NOW_month  = '';
	$NOW_year  = '';
if ($_SESSION['LANG'] == 'TH') {
	$NOW_month = returnThaiShortMonth(date('m'));
	$NOW_year = $NOW_month;
	$NOW_year .= ' ';
	$NOW_year .= date('Y')+543;
} else if ($_SESSION['LANG'] == 'EN') {
	$NOW_month .= date('M');
	$NOW_year .= date('M Y');}
?>

<div class="part-calendar booking_calendar">
	<div class="box-calendar">
		<div class="box-top">
			<div  class="box-top-date">
				<p class="date"><?=$NOW_day?></p>
				<hr class="line"/>
				<p class="month-year"><?=$NOW_year?></p>
			</div>
			<? /*
			<a class="btn-arrow pev"></a>
			<a class="btn-arrow next"></a>
			*/ ?>
		</div>
		<div class="box-bottom" id="datepicker"></div>
	</div>
</div>

<?php
if ($_SESSION['LANG'] == 'TH') {
	echo '<script src="assets/plugin/jqueryui_datepicker_thai.js"></script>';
}
?>
<script src="js/event-calendar.js"></script>