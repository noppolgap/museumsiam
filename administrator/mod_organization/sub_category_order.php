<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "ORDER_DATA = ".$value[1];
					
		echo $sql="UPDATE trn_content_sub_category  SET  ".implode(",",$update)." WHERE SUB_CONTENT_CAT_ID =".$value[0];
		mysql_query($sql,$conn);	    
	}	
}else{
?>
<!doctype html>
<html>
<head>
<?
require ('../inc_meta.php');
 ?>		
</head>
<body>
<div class="orderContent">
	<div>
		<h1>จัดเรียง</h1>
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('sub_category_order.php');">
	</div> 
	<ul id="sortable">
		<?php

		$MID = $_GET['MID'];
		$CID = $_GET['cid'];
		$LV = $_GET['LV'];
		$SCID = $_GET['SCID'];
		
			 $sql = "SELECT * FROM  trn_content_sub_category WHERE Flag <> 2 and CONTENT_CAT_ID  = '" . $CID . "' ";
			
			if (isset($SCID) && nvl($SCID, '0') != '0') {
				$sql .= " AND REF_SUB_CONTENT_CAT_ID = " . $SCID;
			} else {
				$sql .= " AND REF_SUB_CONTENT_CAT_ID = 0 ";
			}
			$sql .= " ORDER BY ORDER_DATA DESC ";

			     $query = mysql_query($sql,$conn);
			     while($row = mysql_fetch_array($query)) {
			 
		?>

		<li class="ui-state-default" data-order="<?=$row['ORDER_DATA'] ?>" data-id="<?=$row['SUB_CONTENT_CAT_ID'] ?>"><?=$row['SUB_CONTENT_CAT_DESC_LOC'] ?></li>
	<? } ?>  
	</ul>
</div>	
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />	
<script type="text/javascript" src="../master/script.js"></script>	
<script>
	var listOrder = new Array();
	var countList = $('#sortable li').length;
</script>
</body>
</html>
<?php
}
CloseDB();
?>	