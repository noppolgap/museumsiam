<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "ORDER_DATA = ".$value[1];
					
	    $sql= " UPDATE trn_product  SET  ".implode(",",$update)." WHERE PRODUCT_ID =".$value[0];
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
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('product_order.php');">
	</div> 
	<ul id="sortable">
		<?php

			     $sql= "SELECT * FROM trn_product  WHERE Flag <> 2 AND CAT_ID = ".$_GET['cid']." ORDER BY ORDER_DATA DESC";

			     $query = mysql_query($sql,$conn);
			     while($row = mysql_fetch_array($query)) {
			 
		?>

		<li class="ui-state-default" data-order="<?=$row['ORDER_DATA'] ?>" data-id="<?=$row['PRODUCT_ID'] ?>"><?=$row['PRODUCT_DESC_LOC'] ?></li>
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