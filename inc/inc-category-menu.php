<?php
$MID = $_GET['MID'];

$sqlStr = " select sysModule.MODULE_ID ,  
sysModule.MODULE_NAME_LOC , 
sysModule.MODULE_NAME_ENG , 
sysModule.IS_LAST_NODE ,
banner.DESKTOP_ICON_PATH , 
banner.DESKTOP_BANNER_NAME  , 
banner.BANNER_LINK from sys_app_module sysModule INNER JOIN trn_banner_pic_setting banner 
on banner.APP_MODULE_ID = sysModule.MODULE_ID
where sysModule.MODULE_ID =  " . $MID;

$query = mysql_query($sqlStr, $conn);
?>
<?php while($row = mysql_fetch_array($query)) {
?>
<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="category.php?MID=<?=$row['MODULE_ID']?>"><img src="images/th/<?=$row['DESKTOP_BANNER_NAME']?>" /></a>
	</div>
</div>

<div class="part-left-search">
	<div class="box-search">
		<input type="text" placeholder="ค้นหา">
	</div>
</div>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1">
				<a href="category.php?MID=<?=$row['MODULE_ID']?>">หน้าหลัก</a>
			</li>
			
			
			<?php 
			$sqlCategory = "SELECT
								CONTENT_CAT_ID,
								CONTENT_CAT_DESC_LOC,
								CONTENT_CAT_DESC_ENG,
								IS_LAST_NODE
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = ".$row['MODULE_ID'] ;
			$sqlCategory.=" AND flag <> 2
							ORDER BY
								ORDER_DATA ASC "; 	
								
							 
				//firstLoop is Category
				$categoryRS = mysql_query($sqlCategory) or die(mysql_error());
					$mainMenuCount = 2; //start with 2

					while ($categoryRow = mysql_fetch_array($categoryRS)) {
						
						$isSubCat = '';
						if (nvl($categoryRow['IS_LAST_NODE'],'Y') == 'N')
						{
							$isSubCat = ' sub';
						}
						
						$activeClass = '';
						if ($CID == $categoryRow['CONTENT_CAT_ID'])
							$activeClass= ' active';
						
						echo '<li class="menu'.$mainMenuCount.$isSubCat.$activeClass.'">';
							
						if (nvl($categoryRow['IS_LAST_NODE'],'Y') == 'Y')
						{
							echo' <a href="all-content.php?MID='.$row['MODULE_ID'].'&CID='.$categoryRow['CONTENT_CAT_ID'].'">'.$categoryRow['CONTENT_CAT_DESC_LOC'].'</a> ';
						}
						else 
							{
								//has subCat render list
								echo' <a href="subcategory.php?MID='.$row['MODULE_ID'].'&CID='.$categoryRow['CONTENT_CAT_ID'].'">'.$categoryRow['CONTENT_CAT_DESC_LOC'].'</a> ';
								
								
								$sqlSubCategory = "SELECT
														SUB_CONTENT_CAT_ID,
														SUB_CONTENT_CAT_DESC_LOC,
														SUB_CONTENT_CAT_DESC_ENG,
														REF_SUB_CONTENT_CAT_ID,
														IS_LAST_NODE
													FROM
														trn_content_sub_category
													WHERE
														CONTENT_CAT_ID = ".$categoryRow['CONTENT_CAT_ID'];
								$sqlSubCategory .= " AND flag <> 2
													ORDER BY
														ORDER_DATA ASC";
														
							/*	
								<ul class="submenu-left">
					<li class="submenu1">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul> */
							}
						
				
				
			echo '</li>';
			$mainMenuCount++;
					}
			?> 
		<!--	<li class="menu2 sub">
				<a href="da-category.php">โบราณวัตถุ</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li>
			<li class="menu3 sub">
				<a href="da-category.php">คลังภาพเก่า</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li>
			<li class="menu4 sub">
				<a href="da-category.php">จดหมายเหตุ</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="da-category.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li>
			<li class="menu5 sub">
				<a href="da-category-red.php">มัลติมีเดีย</a>
				<ul class="submenu-left">
					<li class="submenu1">
						<a href="da-category-red.php">หมวดหมู่ย่อย</a>
					</li>
					<li class="submenu2">
						<a href="da-category-red.php">หมวดหมู่ย่อย</a>
					</li>
				</ul>
			</li>
			<li class="menu6">
				<a href="da-all.php">บทความ</a>
			</li>
			<li class="menu7">
				<a href="da-all.php">MUSE MAG</a>
			</li> -->
		</ul>
	</div>
</div>
<?php } ?>