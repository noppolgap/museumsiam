<div class="part-calendar">
	<div class="box-calendar">
		<div class="box-top">
			<div  class="box-top-date">
				<p class="date"><?=date('d')?></p>
				<hr class="line"/>
				<p class="month-year">
<?php
if ($_SESSION['LANG'] == 'TH') {
	echo returnThaiShortMonth(date('m'));
	echo ' ';
	echo date('Y')+543;
} else if ($_SESSION['LANG'] == 'EN') {
	echo date('M Y');
}
?>
				</p>
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
	$dateTime = date('Y-m-d');

	if ($_SESSION['LANG'] == 'TH'){
		$LANG_SQL = 'cat.CONTENT_CAT_DESC_LOC AS CONTENT_CAT_LOC , content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
	}else if ($_SESSION['LANG'] == 'EN'){
		$LANG_SQL = 'cat.CONTENT_CAT_DESC_ENG AS CONTENT_CAT_LOC , content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
	}

	$sql =  " SELECT ";
	$sql .= $LANG_SQL;
	$sql .= " 	cat.CONTENT_CAT_ID,
				content.SUB_CAT_ID,
				content.CONTENT_ID,
				content.EVENT_START_DATE,
				content.EVENT_END_DATE,
				content.CREATE_DATE ,
				content.LAST_UPDATE_DATE ,
				IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
			FROM
				trn_content_category cat
			INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
			WHERE
				cat.REF_MODULE_ID = $new_and_event
				AND cat.flag = 0
				AND content.APPROVE_FLAG = 'Y'
				AND content.CONTENT_STATUS_FLAG  = 0
				AND (DATE(EVENT_START_DATE)  <= '".$dateTime."' AND DATE(EVENT_END_DATE) >= '".$dateTime."')
			ORDER BY
				content.ORDER_DATA desc
			LIMIT 0,30 ";
	echo $sql;



?>
<div class="part-conming-event">
	<div class="box-part-conming-event">
		<div class="box-list-event">
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
			<div class="box-list cf">
				<div class="box-date-tumb">
					<p class="date">99</p>
					<p class="month">พ.ย.</p>
				</div>
				<div class="box-text">
					<a href="">
						<p class="text-title TcolorRed">
							Levitated Mass 340 Ton Giant Stone
						</p>
					</a>
					<p class="text-date TcolorGray">
						28 พ.ย. 2559
					</p>
				</div>
			</div>
		</div>
		<div class="box-btn">
			<a  class="btn black">กิจกรรมวันนี้</a>
		</div>
	</div>
</div>
<?php
if ($_SESSION['LANG'] == 'TH') {
	echo '<script src="assets/plugin/jqueryui_datepicker_thai.js"></script>';
}
?>
<script>

    var dates = ['10/22/2015', '10/23/2015', '10/13/2015']; //
            //tips are optional but good to have
    var tips  = ['some description','some other description','some other description'];

  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy',
        beforeShowDay: highlightDays
    });
    function highlightDays(date) {
        for (var i = 0; i < dates.length; i++) {
            if (new Date(dates[i]).toString() == date.toString()) {
                return [true, 'highlight', tips[i]];
            }
        }
        return [true, ''];
     }
});
</script>