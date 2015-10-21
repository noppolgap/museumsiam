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

$sql = "SELECT * FROM trn_qa WHERE FlAG != 2 AND REF_QA_ID = 0 ";
if (isset($_GET['search'])) {
	if (isset($_POST['str_search']))
		$_SESSION['FAQ_SEARCH'] = $_POST['str_search'];

	$sql .= "AND CONTENT like '%" . $_SESSION['FAQ_SEARCH'] . "%' ";
	$currentParam = '&search';
} else {
	unset($_SESSION['FAQ_SEARCH']);
}

$sql .= " ORDER BY ORDER_DATA DESC ";
$sql .= " Limit 10 offset  " . (10 * ($currentPage - 1));

$query = mysql_query($sql, $conn);

$num_rows = mysql_num_rows($query);
			 ?>
		<div class="mod-body">
			<div class="buttonActionBox">
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'add.php'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('order.php');">
			</div>
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">FAQ</div>
					<div class="floatR searchBox">
						<form name="search" action="?search" method="post">
							<input type="search" name="str_search" value="<?=$_SESSION['FAQ_SEARCH'] ?>" />
							<input type="image" name="search_submit" src="../images/small-n-flat/search.svg" alt="Submit Form" class="p-Relative" />
						</form>
					</div>
					<div class="clear"></div>						
				</div>
				<div class="mod-body-inner-action">
					<div class="floatL checkAllBox"><label><input type="checkbox" name="checkall" value="0"> เลือกทั้งหมด</label></div>
					<div class="floatR orderBox">
						 
					</div>
					<div class="clear"></div>	
				</div>
				<div class="mod-body-main-content">

		   
					<!-- start loop -->
					<?php while($row = mysql_fetch_array($query)) { ?>
					<div class="Main_Content" data-id="<?=$row['QA_ID'] ?>">
						<div class="floatL checkboxContent"><input type="checkbox" name="check" value="<?=$row['QA_ID'] ?>"></div>
						
						<div class="floatL nameContent">
							<div><? echo '<a href="answer.php?qa_id='.$row['QA_ID'].' ">'.$row['CONTENT'].'</a>' ?></div>
							<div>วันที่สร้าง <? echo ConvertDate($row['CREATE_DATE']); ?> | วันที่ปรับปรุง <? echo ConvertDate($row['LAST_UPDATE_DATE']); ?></div>
						</div>	
						<div class="floatL stausContent">
						
						<? if($row['FLAG'] == 0){ ?>
							<span class="staus1"></span> <a href="action.php?enable&qa_id=<?=$row['QA_ID'] ?>&flag=<?=$row['FLAG'] ?>">
							Enable
						</a> <?}  else { ?> <span class="staus2"></span> 
						<a href="action.php?enable&qa_id=<?=$row['QA_ID'] ?>&flag=<?=$row['FLAG'] ?>"> Disable </a> <? } ?></div>
						<div class="floatL EditContent">
							<a href="edit.php?qa_id=<?=$row['QA_ID'] ?>" class="EditContentBtn">Edit</a>
							<a href="#" class="DeleteContentBtn" data-id="<?=$row['QA_ID'] ?>">Delete</a>
						</div>
						<div class="clear"></div>	
						
				</div>
					<?php } ?>		
					<!-- end loop -->
				</div>
				
				<div class="pagination_box">

					<div class="floatL">
						
						<?php

						$countContentSql = "SELECT count(1) as ROW_COUNT FROM trn_qa WHERE FlAG != 2 AND REF_QA_ID = 0 ";
						if (isset($_GET['search'])) {
							$countContentSql .= "AND CONTENT like '%" . $_SESSION['FAQ_SEARCH'] . "%' ";

						}
						$countContentSql .= " ORDER BY ORDER_DATA DESC ";

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
				<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button" onclick="window.location.href = 'add.php'">
				<input type="button" value="ลบ" class="buttonAction alizarin-flat-button" onclick="deleteCheck();" data-pageDelete="action.php?delete">
				<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button" onclick="orderPage('order.php');">
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
