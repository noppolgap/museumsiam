<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<?
	require ('../inc_meta.php');
 ?>		
</head>

<body>
<?
	require ('../inc_header.php');
 ?>		
<div class="main-container">
	<div class="main-body marginC">
		<?
		require ('../inc_side.php');
 ?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'addVirsualExhib.php?p=<?=$_GET['p'] ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="actionVirsualExhib.php?delete&p=<?=$_GET['p'] ?>">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('orderVirsualExhib.php?p=<?=$_GET['p'] ?>');">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">

					<?php
					$sql1 = "SELECT * FROM  trn_content_category WHERE Flag <> 2 AND  REF_MODULE_ID = 5 AND CONTENT_CAT_ID ='" . $_GET['p'] . "' ";
					$query1 = mysql_query($sql1, $conn);
					 ?>

					<?php while($row1 = mysql_fetch_array($query1)) { ?>
						<div class="floatL titleBox"><?=$row1['CONTENT_CAT_DESC_LOC'] ?></div>
				    
					<div class="floatR searchBox">
						<form name="search" action="?search&p=<?=$row1['CONTENT_CAT_ID'] ?>" method="post">
							<input type="search" name="str_search" value="" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>

					<?} ?>
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

			$sql = "SELECT * FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <> 2 AND CAT_ID = $id ";
			if (isset($_GET['search'])) {
				$sql .= "AND CONTENT_DESC_LOC like '%" . $_POST['str_search'] . "%' ";
			}
			$sql .= "ORDER BY ORDER_DATA DESC ";

			$query = mysql_query($sql, $conn);

			$num_rows = mysql_num_rows($query);
			 ?>
					<!-- start loop -->
					<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content" data-id="<?=$row['CONTENT_ID'] ?>">
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['CONTENT_ID'] ?>"></div>
						<div class="floatL thumbContent">
							<a href="view.php" class="dBlock" <?=callThumbList($row['CONTENT_ID'], $id, false) ?>></a>
						</div>
						<div class="floatL nameContent">
							<div><? echo '<a href="detailVirsualExhib.php?p='.$row['CONTENT_ID'].' ">'.$row['CONTENT_DESC_LOC'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>	
						<div class="floatL stausContent">
						
						<? if($row['CONTENT_STATUS_FLAG'] == 0){ ?>
							<span class="staus1"></span> <a href="actionVirsualExhib.php?enable&p=<?=$row['CONTENT_ID'] ?>&g=<?=$row['CONTENT_STATUS_FLAG'] ?>&a=<?=$row['CAT_ID'] ?>">
							Enable
						</a> <?}  else { ?> <span class="staus2"></span> 
						<a href="actionVirsualExhib.php?enable&p=<?=$row['CONTENT_ID'] ?>&g=<?=$row['CONTENT_STATUS_FLAG'] ?>&a=<?=$row['CAT_ID'] ?>"> Disable </a> <? } ?></div>
						<div class="floatL EditContent">
							<a href="editVirsualExhib.php?p=<?=$row['CONTENT_ID'] ?>" class="EditContentBtn">Edit</a>
							<a href="#" class="DeleteContentBtn" data-id="<?=$row['CONTENT_ID'] ?>" class="DeleteContentBtn">Delete</a>
						</div>
						<div class="clear"></div>	
				</div>
					<?php } ?>		
					<!-- end loop -->
				</div>
				<div class="pagination_box">

					<div class="floatL">
 					  จำนวนทั้งหมด <? 	echo $num_rows; ?>  รายการ </div>
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
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<?
	require ('../inc_footer.php');
 ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>			
<? logs_access('admin', 'hello'); ?>	
</body>
</html>
