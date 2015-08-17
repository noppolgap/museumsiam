<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "LAST_UPDATE_DATE = ".$value[1];
					
		echo $sql="UPDATE trn_category SET  ".implode(",",$update)." WHERE CAT_ID =".$value[0];
		//mysql_query($sql,$conn);	    
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
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('order.php');">
	</div> 
	<ul id="sortable">
	<? for($i=30;$i>0;$i--){ ?>
		<li class="ui-state-default" data-order="<?=$i?>" data-id="<?=$i?>">Item <?=$i?></li>
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