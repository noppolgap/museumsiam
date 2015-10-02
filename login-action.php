<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');
 
if (isset($_POST['UID']) && isset($_POST['PWD'])) {
	
	$getUserSql = "SELECT
						USER_ID,
						`NAME`,
						LAST_NAME,
						PWD
					FROM
						sys_app_user
					WHERE
						USER_ID = '".$_POST['UID']."'
					/*ACTIVE_FLAG <> 2*/";
	$query = mysql_query($getUserSql, $conn);
	$validatePass = FALSE;
	while($row = mysql_fetch_array($query)) {
		
		if ($row['PWD'] == createPasswordHash($_POST['PWD']))
		{
			$validatePass = TRUE;
			$_SESSION['user_name'] = $row['USER_ID'];
			
		}
	}
	if ($validatePass)
	echo "PASS";
	else 
		echo "False";
}
else 
	{
		echo "ELSE";
	
	}
	

CloseDB();

?>