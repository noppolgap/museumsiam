<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "ORDER_DATA = ".$value[1];
					
		$sql="UPDATE trn_digital_ach  SET  ".implode(",",$update)." WHERE DIGITAL_ID =".$value[0];
		mysql_query($sql,$conn);	    
	}	
}else{
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>
<body>
<div class="orderContent">
	<div>
		<h1>จัดเรียง</h1>
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('sub_digital_order');">
	</div> 
	<ul id="sortable">
		<?php

			     $sql= "SELECT * FROM trn_digital_ach  WHERE Flag <> 2 AND SUB_DIGITAL_ID = '".$_GET['p']."' ORDER BY ORDER_DATA DESC";

			     $query = mysql_query($sql,$conn);
			     while($row = mysql_fetch_array($query)) {
			 
		?>

		<li class="ui-state-default" data-order="<?=$row['ORDER_DATA']?>" data-id="<?=$row['DIGITAL_ID']?>"><?=$row['DIGITAL_DESC_LOC']?></li>
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