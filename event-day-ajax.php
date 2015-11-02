<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
require ("inc/inc-cat-id-conf.php");

header("Content-type: application/javascript; charset=UTF-8");

if ($_SESSION['LANG'] == 'TH'){
	$LANG_SQL = 'CONTENT_DESC_LOC AS CONTENT_LOC ,';
}else if ($_SESSION['LANG'] == 'EN'){
	$LANG_SQL = 'CONTENT_DESC_ENG AS CONTENT_LOC ,';
}

$dates = array();
$tips = array();

$sql =  "SELECT CONTENT_CAT_ID FROM trn_content_category WHERE REF_MODULE_ID = ".$new_and_event." ORDER BY ORDER_DATA DESC";
$query_CAT = mysql_query($sql, $conn);
while($row_CAT = mysql_fetch_array($query_CAT)) {

	$sql  =  " SELECT ";
	$sql .= $LANG_SQL;
	$sql .= "	EVENT_START_DATE,
				EVENT_END_DATE
			FROM
				trn_content_detail
			WHERE
				APPROVE_FLAG = 'Y'
				AND CONTENT_STATUS_FLAG  = 0
				AND CAT_ID = ".$row_CAT['CONTENT_CAT_ID'];
	$query = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($query)) {
		$begin = new DateTime( $row['EVENT_START_DATE'] );
		$end = new DateTime( $row['EVENT_END_DATE'] );
		$end = $end->modify( '+1 day' );

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		foreach ( $period as $dt ){
		  $dates[] = "'".$dt->format( "m/d/Y" )."'";
		  $tips[] = "'".$row['CONTENT_LOC']."'";
		}
	}
}

echo "var dates = [".implode(",", $dates)."];";
echo "\n";
echo "var tips  = [".implode(",", $tips)."];";
CloseDB();
?>