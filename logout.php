<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
unset($_SESSION['user_name']);
unset($_SESSION['UID']);
unset($_SESSION['FB']);
unset($_SESSION['IMAGE_PATH']);


//if(!isset($_SESSION['FB'])){
	$last_url = $_SESSION['last_url'];

	unset($_SESSION['last_url']);
	if ($last_url != '') {
		header("Location:$last_url");
	} else {
		// Redirect the user to the common menu
		header("Location:" . _FULL_SITE_PATH_);
	}
/*
}else{
?>
<html><head>
<script type="text/javascript" src="js/fb-login.js"></script>
<script type="text/javascript">
var appId = '<?=_FACEBOOK_ID_?>';
</script>
</head>
<body onload="FBLogout();"></body>
</html>
<?php
}*/
?>