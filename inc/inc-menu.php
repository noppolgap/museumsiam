<?
if ($_SESSION['LANG'] == 'TH')
	$picFolder = 'th';
else
	$picFolder = 'en';
?>
<div class="part-menu"  id="menu">
	<div class="container cf">
		<div class="box-menu cf">
			<div class="box-logo">
				<a href="index.php"><img src="images/<?=$picFolder?>/logo-header.svg" width="202"/></a>
			</div>
			<div class="menu">
				<ul class="menutop cf">
					<li class="menu1">
						<a href="index.php"><?=$homeCap?></a>
					</li>
					<li class="menu2 sub">
						<a href="about.php"><?=$aboutUsCap?></a>
						<ul class="submenu-top">
							<a href="about.php">
							<li class="sub1">
								<?=$storyCap?>
							</li></a>
							<a href="organization.php">
							<li class="sub2">
								<?=$orgCap?>
							</li></a>
						</ul>
					</li>
					<li class="menu3 sub">
						<a href="service-knowledge.php"><?=$serviceCap?></a>
						<ul class="submenu-top">
							<a href="service-knowledge.php">
							<li class="sub1">
								<?=$knowledgeCap?>
							</li></a>
							<a href="service-archive.php">
							<li class="sub2">
								<?=$digitalArcCap?>
							</li></a>
							<a href="service-restaurant.php">
							<li class="sub3">
								<?=$resturantCap?>
							</li></a>
							<a href="#">
							<li class="sub4">
								Muse Shop
							</li></a>
							<a href="service-spaceforrent.php">
							<li class="sub5">
								<?=$rentSpaceCap?>
							</li></a>
						</ul>
					</li>
					<li class="menu4">
						<a href=""><?=$privilegeCap?></a>
					</li>
					<li class="menu5 sub">
						<a href="news-event-museum.php"><?=$newsAndEventCap?></a>
						<ul class="submenu-top">
							<a href="news-event-museum.php">
							<li class="sub1">
								<?=$activityNewsMuseumCap?>
							</li></a>
							<a href="news-event.php">
							<li class="sub2">
								<?=$allEventAndNewsAllSystemCap?>
							</li></a>
						</ul>
					</li>
					<li class="menu6 sub">
						<a href="other-system.php"><?=$otherSystemCap?></a>
						<ul class="submenu-top">
							<?
							if ($_SESSION['LANG'] == 'TH')
								$selectedColumn = " MODULE_NAME_LOC as MODULE_DESC ,";
							else
								$selectedColumn = " MODULE_NAME_ENG as MODULE_DESC , ";

							$sqlStr = "SELECT
MODULE_ID, " . $selectedColumn;
							$sqlStr .= "LINK_URL,
IS_LAST_NODE
FROM
sys_app_module
WHERE
ACTIVE_FLAG <> 2
AND RENDER_ON_FRONT = 'Y'
AND IS_FOR_OTHER_LINK = 'N'
ORDER BY
ORDER_DATA DESC";
							$query = mysql_query($sqlStr, $conn);
							$classIdx = 1;
							while ($row = mysql_fetch_array($query)) {
								//if ($row['IS_LAST_NODE'] == 'Y') {
								echo '<a href="' . $row['LINK_URL'] . '?MID=' . $row['MODULE_ID'] . '"><li class="sub' . $classIdx++ . '">' . $row['MODULE_DESC'] . '</li></a>';
								// } else {
								// if ($_SESSION['LANG'] == 'TH')
								// $subModuleSelectedColumn = " SUB_MODULE_NAME_LOC as SUB_MODULE_DESC , ";
								// else
								// $subModuleSelectedColumn = " SUB_MODULE_NAME_ENG as SUB_MODULE_DESC , ";
								// $subCatSql = "SELECT
								// SUB_MODULE_ID, ".$subModuleSelectedColumn;
								// $subCatSql .="	LINK_URL
								// FROM
								// sys_app_sub_module
								// WHERE
								// MODULE_ID = " . $row['MODULE_ID'];
								// $subCatSql .= " AND ACTIVE_FLAG <> 2
								// AND RENDER_ON_FRONT = 'Y'";
								// $querySubCat = mysql_query($subCatSql, $conn);
								// //echo '<li class="sub' . $classIdx++ . '"><span>' .  $row['MODULE_NAME_LOC'] .'</span>';
								// echo "<ul>";
								// while ($row = mysql_fetch_array($querySubCat)) {
								// echo '<a href="' . $row['LINK_URL'].'"><li class="sub">' . $row['SUB_MODULE_DESC'] . '</li></a>';
								// }
								// echo "</ul> "; //</li>
								// }
							}
							?>
						</ul>
					</li>
					<li class="menu7 sub">
						<a href="faqs.php"><?=$qaCap?></a>
					</li>
					<li class="menu8 sub">
						<a href="contact.php"><?=$contactUsCap?></a>
						<ul class="submenu-top">
							<a href="contact.php">
							<li class="sub1">
								E-MAIL SUBMIT FORM ADDRESS & MAP
							</li></a>
							<a href="contact-eapp.php">
							<li class="sub2">
								E-APPLICATION
							</li></a>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
