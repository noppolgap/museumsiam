<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
 
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "ORDER_DATA = ".$value[1];
					
		$sql="UPDATE trn_content_detail  SET  ".implode(",",$update)." WHERE CONTENT_ID =".$value[0];
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
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('content_order.php');">
	</div> 
	<ul id="sortable">
		<?php
		$MID = $_GET['MID'];
		$CID = $_GET['cid'];
		$LV = $_GET['LV'];
		$SCID = $_GET['SCID'];
		
			    $sql = " SELECT a.* ,cd.* FROM (
							SELECT cc.CONTENT_CAT_ID
								,cc.CONTENT_CAT_DESC_LOC
								,cc.CONTENT_CAT_DESC_ENG
								,cc.IS_LAST_NODE
								,sb.SUB_CONTENT_CAT_ID
								,sb.SUB_CONTENT_CAT_DESC_LOC
								,sb.SUB_CONTENT_CAT_DESC_ENG
							FROM trn_content_category cc
							LEFT OUTER JOIN trn_content_sub_category sb ON sb.CONTENT_CAT_ID = cc.CONTENT_CAT_ID
							WHERE cc.REF_MODULE_ID = $MID 
								AND cc.flag <> 2 
								AND cc.CONTENT_CAT_ID  = $CID ";
								if (isset($SCID) && nvl($SCID, '0') != '0') {
				$sql .= "	AND sb.SUB_CONTENT_CAT_ID = $SCID ";
			}
				$sql .="    ORDER BY cc.ORDER_DATA DESC 
								,sb.order_data DESC
							) a
						LEFT JOIN trn_content_detail cd ON a.CONTENT_CAT_ID = cd.CAT_ID 
						where cd.CONTENT_STATUS_FLAG <>  2  ORDER BY cd.ORDER_DATA desc ";

			     $query = mysql_query($sql,$conn);
			     while($row = mysql_fetch_array($query)) {
			     	
			 
		?>

		<li class="ui-state-default" data-order="<?=$row['ORDER_DATA'] ?>" data-id="<?=$row['CONTENT_ID'] ?>"><?=$row['CONTENT_DESC_LOC'] ?></li>
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