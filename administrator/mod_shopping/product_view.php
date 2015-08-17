<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body>
<? require('../inc_header.php'); ?>		
<div class="main-container">
	<div class="main-body marginC">
		<? require('../inc_side.php'); ?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'product_add.php?g=<?=$_GET['p']?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<?php
						 $sql1= "SELECT * FROM  trn_category WHERE Flag <> 2 AND CAT_ID ='".$_GET['p']."' ";
				   	     $query1 = mysql_query($sql1,$conn);
					 ?>

					<?php while($row1 = mysql_fetch_array($query1)) { ?>
						<div class="floatL titleBox"><?=$row1['CAT_DESC_LOC']?></div>
					<?}?>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>						
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
					<div class="floatR orderBox">
						<select onchange="console.log('action');" name="orderby" class="p-Relative">
					        <option value="order">เลือกการจัดเรียงลำดับ</option>
					        <option selected="selected" value="order">การจัดเรียงของระบบ</option>
					        <option value="subject">ชื่อ</option>
					        <option value="credate">วันที่สร้าง</option>
					        <option value="status">สถานะข้อมูล</option>
					    </select>
					</div>
					<div class="clear"></div>	
				</div>
				<div class="mod-body-main-content">

		    <?php

				$id = $_GET['p'];
			    $sql= "SELECT * FROM  trn_product WHERE Flag <> 2 AND CAT_ID = $id ";
			    if(isset($_GET['search'])){
			      $sql .= "AND PRODUCT_DESC_LOC like '%".$_POST['str_search']."%' ";
			    }
			     $sql .= "ORDER BY ORDER_DATA ASC";

			     $query = mysql_query($sql,$conn);

			
			     $num_rows = mysql_num_rows($query);
			 	

			 ?>
					<!-- start loop -->
				<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content">
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['PRODUCT_ID']?>"></div>
						<div class="floatL thumbContent">
							<a href="product_detail.php?p=<?=$row['PRODUCT_ID']?>" class="dBlock" style="background-image: url('http://cache.my.kapook.com/imgkapook_2014/31_35_1438829370.jpg');"></a>
						</div>
						<div class="floatL nameContent">
							<div><? echo '<a href="product_detail.php?p='.$row['PRODUCT_ID'].'&a='.$row['CAT_ID'].'">'. $row['PRODUCT_DESC_LOC'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo  ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>	
						<div class="floatL stausContent">
						
						<? if($row['Flag'] == 0){ ?>
							<span class="staus1"></span> <a href="product_action.php?enable&p=<?=$row['PRODUCT_ID']?>&g=<?=$row['Flag']?>&a=<?=$row['CAT_ID']?>">
							Enable
						</a> <?}  else {?> <span class="staus2"></span> 
						<a href="product_action.php?enable&p=<?=$row['PRODUCT_ID']?>&g=<?=$row['Flag']?>&a=<?=$row['CAT_ID']?>"> Disable </a> <? } ?></div>
						<div class="floatL EditContent">
							<a href="product_edit.php?p=<?=$row['PRODUCT_ID']?>&g=<?=$row['CAT_ID']?>" class="EditContentBtn">Edit</a>
							<a href="product_action.php?delete&p=<?=$row['PRODUCT_ID']?>&a=<?=$row['CAT_ID']?>" class="DeleteContentBtn">Delete</a>
						</div>
						<div class="clear"></div>	
				</div>
							<?php } ?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">จำนวนทั้งหมด <? echo $num_rows; ?>  รายการ</div>
					<div class="floatR pagination_action">
						<a href="#"><img src="../images/skip-previous.svg" alt="first" /></a>
						<a href="#"><img src="../images/fast-rewind.svg" alt="previous" /></a>
						<select name="pagination" class="p-Relative">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>	
						<a href="#"><img src="../images/fast-forward.svg" alt="next" /></a>
						<a href="#"><img src="../images/skip-next.svg" alt="last" /></a>
					</div>
					<div class="floatR">หน้า 1 จาก 10</div>
					<div class="clear"></div>	
				</div>
			</div>	
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'add.php'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="mod_cms.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>		
<script type="text/javascript" src="mod_cms.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
