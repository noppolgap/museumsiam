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
		<?
		$MID = $_GET['MID'];
		?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'content_add.php?MID=<?=$MID ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="content_action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('content_order.php?MID=<?=$MID ?>');">
				<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เนื้อหา</div>
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

			/* $sql= "SELECT * FROM  trn_digital_ach WHERE Flag <> 2 AND SUB_DIGITAL_ID = $id ";
			 if(isset($_GET['search'])){
			 $sql .= "AND DIGITAL_DESC_LOC like '%".$_POST['str_search']."%' ";
			 }
			 $sql .= "ORDER BY ORDER_DATA DESC";
			 */

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
								AND cc.flag <> 2 ";
			if (isset($_GET['search'])) {
				$sql .= " AND ( CONTENT_DESC_LOC like '%" . $_POST['str_search'] . "%' or CONTENT_DESC_ENG like '%" . $_POST['str_search'] . "%' )";
			}
			$sql .= "			ORDER BY cc.ORDER_DATA DESC
								,sb.order_data DESC
							) a
						LEFT JOIN trn_content_detail cd ON a.CONTENT_CAT_ID = cd.CAT_ID
						where cd.CONTENT_STATUS_FLAG <>  2 ORDER BY cd.ORDER_DATA desc ";

			$query = mysql_query($sql, $conn);

			$num_rows = 0;
			//mysql_num_rows($query);
			 ?>
					<!-- start loop -->
				<?php while($row = mysql_fetch_array($query)) { ?>
					<?php if( nvl( $row['CONTENT_ID'] , "" )  != "" ){ ?>
					<div class="Main_Content" data-id="<?=$row['CONTENT_ID'] ?>" >
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['CONTENT_ID'] ?>"></div>


						<div class="floatL thumbContent">
							<a href="content_detail.php?conid=<?=$row['CONTENT_ID'] ?>&MID=<?=$MID ?>" class="dBlock" <?=callThumbList($row['CONTENT_ID'], $row['CONTENT_CAT_ID'], false) ?> ></a>
						</div>
						<div class="floatL nameContent">
							<div><? echo '<a href="content_detail.php?conid='.$row['CONTENT_ID'].'&MID='.$MID.'">'. $row['CONTENT_DESC_LOC'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>
						<div class="floatL stausContent">

						<? if($row['CONTENT_STATUS_FLAG'] == 0){ ?>
							<span class="staus1"></span> <a href="content_action.php?enable&conid=<?=$row['CONTENT_ID'] ?>&vis=<?=$row['CONTENT_STATUS_FLAG'] ?>&MID=<?=$MID ?>">
							Enable
						</a> <?}  else { ?> <span class="staus2"></span>
						<a href="content_action.php?enable&conid=<?=$row['CONTENT_ID'] ?>&vis=<?=$row['CONTENT_STATUS_FLAG'] ?>&MID=<?=$MID ?>"> Disable </a> <? } ?></div>
						<div class="floatL EditContent">
							<a href="content_edit.php?conid=<?=$row['CONTENT_ID'] ?>&MID=<?=$MID ?>" class="EditContentBtn">Edit</a>
							<a href="#" data-id="<?=$row['CONTENT_ID'] ?>" class="DeleteContentBtn">Delete</a>
						</div>
						<div class="clear"></div>
				</div>
					<?php $num_rows++;
					} //end if
 ?>
							<?php } ?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">จำนวนทั้งหมด <span class='RowCount'><? echo $num_rows; ?></span>  รายการ</div>
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
			<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'content_add.php?MID=<?=$MID ?>'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="content_action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('content_order.php?MID=<?=$MID ?>');">
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

</body>
</html>
