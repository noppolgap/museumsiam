<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");


if (isset($_GET['add'])) {

    $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_webboard WHERE FLAG <>2 AND REF_WEBBOARD_ID= 0 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CONTENT'] = "'" . $_POST['content'] . "'";
	$insert['DETAIL'] = "'" . $max . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO  trn_webboard (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);

	header('Location: km-webboard.php');

}

if (isset($_GET['answer'])) {



    $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_webboard WHERE FLAG <>2 AND REF_WEBBOARD_ID=".$_GET['web_id']." ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CONTENT'] = "'" . $_POST['answer'] . "'";
	$insert['REF_WEBBOARD_ID'] = "'" . $_GET['web_id'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO  trn_webboard (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);

	header('Location: km-webboard-topic.php?web_id='.$_GET['web_id'].' ');

}


?>