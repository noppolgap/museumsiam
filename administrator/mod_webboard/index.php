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
 <?php
$currentPage = 1;
if (isset($_GET['PG']))
	$currentPage = intval($_GET['PG']);

if (isset($_GET['PC']))
	$currentPage = intval($_POST['pagination']);

if ($currentPage < 1)
	$currentPage = 1;

$sql = "SELECT * FROM trn_webboard WHERE FlAG != 2 AND REF_WEBBOARD_ID = 0 ";
if (isset($_GET['search'])) {
	if (isset($_POST['str_search']))
		$_SESSION['WB_SEARCH'] = $_POST['str_search'];

	$sql .= "AND CONTENT like '%" . $_SESSION['WB_SEARCH'] . "%' ";
	$currentParam = '&search';
} else {
	unset($_SESSION['WB_SEARCH']);
}

if (isset($_POST['orderby'])) {
	$_SESSION['WB_ORDER'] = $_POST['orderby'];
} else {
	$_SESSION['WB_ORDER'] = ' ORDER_DATA ';
}

$sql .= " ORDER BY " . $_SESSION['WB_ORDER'] . " DESC ";
$sql .= " Limit 10 offset  " . (10 * ($currentPage - 1));

//echo $sql;
$query = mysql_query($sql, $conn);
//echo $sql;
$num_rows = mysql_num_rows($query);
			 ?>
		<div class="mod-body">
			<div class="buttonActionBox">

				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="action.php?delete">

			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">ชื่อเมนู</div>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="<?=$_SESSION['WB_SEARCH'] ?>" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
					<div class="floatR orderBox">
						<form id = "frmOrder" method="POST" action="?">
						<select onchange="this.form.submit();" name="orderby" class="p-Relative">

							<?
							$item1Selected = '';
							$item2Selected = '';
							$item3Selected = '';
							$item4Selected = '';
							if ($_SESSION['WB_ORDER'] == 'ORDER_DATA')
								$item1Selected = ' selected="selected" ';
							else if ($_SESSION['WB_ORDER'] == 'CONTENT')
								$item2Selected = ' selected="selected" ';
							else if ($_SESSION['WB_ORDER'] == 'CREATE_DATE')
								$item3Selected = ' selected="selected" ';
							else if ($_SESSION['WB_ORDER'] == 'LAST_UPDATE_DATE')
								$item4Selected = ' selected="selected" ';
							?>

					        <option <?=$item1Selected ?> value="ORDER_DATA">การจัดเรียงของระบบ</option>
					        <option <?=$item2Selected ?> value="CONTENT">ชื่อ</option>
					        <option <?=$item3Selected ?> value="CREATE_DATE">วันที่สร้าง</option>
					        <option <?=$item4Selected ?> value="LAST_UPDATE_DATE">วันที่แก้ไขข้อมูลล่าสุด</option>>
					    </select>
					    </form>
					</div>
					<div class="clear"></div>
				</div>
				<div class="mod-body-main-content">


					<!-- start loop -->
					<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content" data-id="<?=$row['WEBBOARD_ID'] ?>">
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['WEBBOARD_ID'] ?>"></div>
						<div class="floatL thumbContent">
							<a href="view.php" class="dBlock"></a>
						</div>
						<div class="floatL nameContent">
							<div><? echo '<a href="reply.php?web_id='.$row['WEBBOARD_ID'].' ">'.$row['CONTENT'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>
						<div class="floatL stausContent">

						<? if($row['FLAG'] == 0){ ?>
							<span class="staus1"></span> <a href="action.php?enable&web_id=<?=$row['WEBBOARD_ID'] ?>&flag=<?=$row['FLAG'] ?>">
							Enable
						</a> <?}  else { ?> <span class="staus2"></span>
						<a href="action.php?enable&web_id=<?=$row['WEBBOARD_ID'] ?>&flag=<?=$row['FLAG'] ?>"> Disable </a> <? } ?></div>
						<div class="floatL EditContent">

							<a href="#" class="DeleteContentBtn" data-id="<?=$row['WEBBOARD_ID'] ?>">Delete</a>
						</div>
						<div class="clear"></div>
				</div>
					<?php } ?>
					<!-- end loop -->
				</div>
				<div class="pagination_box">
					<div class="floatL">
						<?php

						$countContentSql = "SELECT count(1) as ROW_COUNT FROM trn_webboard WHERE FLAG <> 2 AND REF_WEBBOARD_ID = 0 ";
						if (isset($_GET['search'])) {
							$countContentSql .= "AND CONTENT like '%" . $_SESSION['WB_SEARCH'] . "%' ";

						}
						$countContentSql .= " ORDER BY " . $_SESSION['WB_ORDER'] . " DESC ";

						$queryCount = mysql_query($countContentSql, $conn);

						$dataCount = mysql_fetch_assoc($queryCount);

						$contentCount = $dataCount['ROW_COUNT'];

						$maxPage = ceil($contentCount / 10);

						if ($maxPage == 0)
							$pagingStyle = 'style = "display:none"';
						?>
 					  จำนวนทั้งหมด <span class='RowCount'><? 	echo $contentCount; ?></span>  รายการ </div>
 					  <form id = "frmPagination" action='?PC' method="post" >
					<div class="floatR pagination_action" <?=$pagingStyle ?>>

	<?php

	//echo $currentPage ;
	//echo $countContentSql;
	//echo $contentCount;
	//echo $maxPage;
	//echo $currentParam;
	$extraClass = '';
	if ($currentPage == 1) {
		$extraClass = ' style="display:none;"';
	}

	echo '<a href="?PG=1' . $currentParam . '" ' . $extraClass . '><img src="../images/skip-previous.svg" alt="first" /></a> ';
	echo '<a href="?PG=' . ($currentPage - 1) . $currentParam . '" ' . $extraClass . '><img src="../images/fast-rewind.svg" alt="previous" /></a>';
	if ($maxPage == 1)
		$hideCombo = ' style = "display:none;" ';
	echo '<select name="pagination" class="p-Relative" onchange="this.form.submit();" ' . $hideCombo . '>';
	for ($idx = 1; $idx <= $maxPage; $idx++) {
		if ($idx == $currentPage)
			echo '<option value="' . $idx . '" selected>' . $idx . '</option>';
		else
			echo '<option value="' . $idx . '">' . $idx . '</option>';
	}
	echo '</select>';

	$extraClassAtEnd = '';
	if (($currentPage + 1) >= $maxPage) {
		$extraClassAtEnd = ' style="display:none;"';
	}

	echo '<a href="?PG=' . ($currentPage + 1) . $currentParam . '" ' . $extraClassAtEnd . '><img src="../images/fast-forward.svg" alt="next" /></a>';
	echo '<a href="?PG=' . $maxPage . $currentParam . '" ' . $extraClassAtEnd . '><img src="../images/skip-next.svg" alt="last" /></a>';
							?>







					</div>
					</form>
					<div class="floatR" <?=$pagingStyle ?>>หน้า <?=$currentPage ?> จาก <?=$maxPage ?></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="buttonActionBox">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="action.php?delete">

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
