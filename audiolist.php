<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header("Content-type: application/javascript; charset=UTF-8");
echo '$(document).ready(function(){';

	$index = 1;
	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".intval($_GET['CONID'])." AND CAT_ID = ".intval($_GET['CID'])." AND DIV_NAME = '".$_GET['NAME']."' ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);

	while ($row = mysql_fetch_array($query)) {

	switch (getEXT($row['IMG_PATH'])) {
		case "wav":
					$type = 'wav'; break;
		case "oga":
		case "ogg":
					$type = 'oga'; break;
		default   : $type = 'm4a';  break;
	}
	$path = $row['IMG_PATH'];
		if($row['IMG_TYPE'] == 2){
			$path = str_replace("../../","",$path);
		}
	$path = $type.': "'.$path.'"';

	echo "\n\t";
?>
	var myCirclePlayer<?=$index++?> = new CirclePlayer("#jquery_jplayer_<?=$row['PIC_ID']?>",
	{
		<?=$path?>
	}, {
		cssSelectorAncestor: "#cp_container_<?=$row['PIC_ID']?>",
		swfPath: "assets/plugin/jplayer/jplayer/",
		wmode: "window",
		keyEnabled: false
	});
<?
	}
echo '});';
CloseDB();
?>