<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_POST['update'])){
	foreach ($_POST['order_data'] as $key => $value) {
	    //echo "Key: $key; Value: $value<br />\n";
		
		$update="";
		$update[]= "ORDER_DATA = ".$value[1];
					
		echo $sql="UPDATE mas_org  SET  ".implode(",",$update)." WHERE ORG_ID =".$value[0];
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
		<input type="button" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="updateOreder('section_people_order.php');">
	</div> 
	<ul id="sortable">
		<?php
				 $secid = $_GET['secid'];
				 $did= $_GET['did'];
				 
			     $sql = "SELECT
					ORG_ID ,
					NAME_LOC,
					NAME_ENG,
					PHONE,
					EMAIL,
					IMG_PATH,
					POSITION_DESC_LOC,
					POSITION_DESC_ENG,
					CREATE_DATE,
					LAST_UPDATE_DATE
				FROM
					mas_org
				WHERE
					PARENT_ORG_ID <> 0
				AND ACTIVE_FLAG <> 2  
				AND SECTION_ID = ".$secid ;
				$sql.= " AND DEPARTMENT_ID = ".$did."  ORDER BY
					ORDER_DATA DESC ";

			     $query = mysql_query($sql,$conn);
			     while($row = mysql_fetch_array($query)) {
			 
		?>

		<li class="ui-state-default" data-order="<?=$row['ORDER_DATA'] ?>" data-id="<?=$row['ORG_ID'] ?>"><?=$row['NAME_LOC'] ?></li>
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