<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>
</head>

<body>
<ul id="sortable" class="sortableFile">
<?php
	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".intval($_GET['cID'])." AND CAT_ID = ".intval($_GET['cat'])." AND DIV_NAME = '".$_GET['page']."' ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {

		if($row['IMG_TYPE'] == 3){
			$style = 'style="background-size: 100% 100%; background-image: url(&quot;http://img.youtube.com/vi/'.$row['IMG_PATH'].'/maxresdefault.jpg&quot;);"';
		}else{
			$style = 'style="background-image:url('.returnUploadFileExtensions($row['IMG_PATH']).')"';
		}

		echo '<li class="ui-state-default" data-id="'.$row['PIC_ID'] .'">';
		echo '<span class="OrderFileThumb" '.$style .'>';
		echo '</span>';
		echo '<span class="OrderFileText">';
		echo $row['IMG_NAME'];
		echo '</span>';
		echo '</li>';
	}
?>
</ul>
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>
<script>
<?php if(isset($_GET['pop'])){ ?>
	var pop = true;
<?php }else{ ?>
	var pop = false;
<?php }
	echo "\tvar box = '".$_GET['page']."';\n";
?>
</script>
</body>
</html>