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

	if($_POST['content'] != ''){

		$insert['CONTENT'] = "'" . mysql_real_escape_string(trim($_POST['content'])) . "'";
		$insert['DETAIL'] = "'" . mysql_real_escape_string(trim($_POST['msg'])) . "'";
		$insert['ORDER_DATA'] = "'" . $max . "'";
		$insert['USER_CREATE'] = "'".$_POST['my_username']."'";
		$insert['CREATE_DATE'] = "NOW()";
		$insert['LAST_UPDATE_USER'] = "'".$_POST['my_username']."'";
		$insert['LAST_UPDATE_DATE'] = "NOW()";

		$sql = "INSERT INTO  trn_webboard (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

		mysql_query($sql, $conn) or die($sql);
	}

	header('Location: km-webboard.php');

}

if (isset($_GET['answer'])) {

	$id = intval($_GET['web_id']);

    $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_webboard WHERE FLAG <>2 AND REF_WEBBOARD_ID=".$id." ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	if($_POST['content'] != ''){
		$insert['CONTENT'] = "'" . mysql_real_escape_string(trim($_POST['content'])) . "'";
		$insert['REF_WEBBOARD_ID'] = "'" . $id . "'";
		$insert['ORDER_DATA'] = "'" . $max . "'";
		$insert['USER_CREATE'] = "'".$_POST['my_username']."'";
		$insert['CREATE_DATE'] = "NOW()";
		$insert['LAST_UPDATE_USER'] = "'".$_POST['my_username']."'";
		$insert['LAST_UPDATE_DATE'] = "NOW()";

		$sql = "INSERT INTO  trn_webboard (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

		mysql_query($sql, $conn) or die($sql);
	}

	header('Location: km-webboard-topic.php?web_id='.$id.' ');

}


?>