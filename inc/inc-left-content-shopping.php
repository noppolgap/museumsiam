<?
require ("inc/inc-cat-id-conf.php");
?>

<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="online-system.php?MID=<?=$online_system_module_id ?>"><img src="images/th/title-online-system.png" alt="title-online-system" width="" height="" /></a>
	</div>
</div>

<?
$CID_S = "";

$CID = $_GET['cid'];

if ($CID != "") {
	$CID_S = "&cid=$CID";
}
?>

<!--<form name="search" action="?search<?=$CID_S?>" method="post">-->
<form name="search_form" method="post" action="system-search.php?MID=<?=$online_system_module_id ?>">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="txt_search_form" value="<?=$_POST['txt_search_form'] ?>"  placeholder="<?=$searchCap ?>">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1"><a href="online-system.php?MID=<?=$online_system_module_id ?>"><?=$mainPageCap ?></a>
			<li class="menu2"><a href="e-booking.php">e-BOOKING + ONLINE TICKET</a></li>
		<?
		$currentPageName = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		$expend = FALSE;
		$exTraMenuClass = "" ; 
		$displayStyle = "" ; 
		if (strpos($currentPageName,'shopping') !== false) {
    $exTraMenuClass = " active" ;
			$displayStyle = "style='display:block'";
}
		?>
			<li class="menu3 sub<?=$exTraMenuClass?>" ><a href="e-shopping.php?MID=<?=$online_system_module_id ?>">e-SHOPPING</a>
				
				<ul class="submenu-left" <?=$displayStyle?>>

			<?php

			$sql = "select CONTENT_CAT_ID,CONTENT_CAT_DESC_LOC from trn_content_category where REF_MODULE_ID= $online_system_module_id 
			     					AND FLAG = 0 ORDER BY ORDER_DATA desc  ";

			$query = mysql_query($sql, $conn);

			$idx = 1;
			while ($row = mysql_fetch_array($query)) {
				$activeClass = "";
				if ($_GET['cid'] == $row['CONTENT_CAT_ID'])
					$activeClass = " active";
				echo '<li class="submenu' . $idx++ . $activeClass . '"><a href="e-shopping-category.php?cid=' . $row['CONTENT_CAT_ID'] . '">' . $row['CONTENT_CAT_DESC_LOC'] . '</a></li>';

			}
			?>
				</ul>
			</li>
		</ul>
	</div>
</div>
