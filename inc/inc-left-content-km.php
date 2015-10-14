<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="km.php"><img src="images/th/title-km.png"/></a>
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
			
			
			<?php 
			$currentPageName = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
			if ($currentPageName == "km.php")
				echo '<li class="menu1 active"><a href="km.php">หน้าหลัก</a></li>';
			else 
				echo '<li class="menu1" ><a href="km.php">หน้าหลัก</a></li>';
			
			if ($currentPageName == "km-webboard.php")
			echo '<li class="menu2 active"><a href="km-webboard.php" >เว็บบอร์ด</a></li>';
			else 
				echo '<li class="menu2"><a href="km-webboard.php" >เว็บบอร์ด</a></li>';
			
			
		
			
			//echo basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
			//echo $_SERVER['QUERY_STRING'];
			
			$sqlCategory = "SELECT
								CONTENT_CAT_ID,
								CONTENT_CAT_DESC_LOC,
								CONTENT_CAT_DESC_ENG,
								IS_LAST_NODE , 
								LINK_URL
							FROM
								trn_content_category
							WHERE
								REF_MODULE_ID = ". $km_module_id;
			$sqlCategory.=" AND flag = 0 
							ORDER BY
								ORDER_DATA desc "; 	
								
							 
				//firstLoop is Category
				$categoryRS = mysql_query($sqlCategory) or die(mysql_error());
					$mainMenuCount = 3;  

					while ($categoryRow = mysql_fetch_array($categoryRS)) {
						
						$isSubCat = '';
						if (nvl($categoryRow['IS_LAST_NODE'],'Y') == 'N')
						{
							$isSubCat = ' sub';
						}
						
						$activeClass = '';
						if (($CID == $categoryRow['CONTENT_CAT_ID'] || $currentPageName == $categoryRow['LINK_URL'] )&& !isset($_GET['SCID'] ))
							$activeClass= ' active';
						
						echo '<li class="menu'.$mainMenuCount.$isSubCat.$activeClass.'">';
							
						if (nvl($categoryRow['IS_LAST_NODE'],'Y') == 'Y')
						{
							echo' <a href="'.$categoryRow['LINK_URL'].'?MID='.$km_module_id.'">'.$categoryRow['CONTENT_CAT_DESC_LOC'].'</a> ';
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
														ORDER_DATA desc";
														
		
							}
						
				
				
			echo '</li>';
			$mainMenuCount++;
					}
			?> 
			
			<!-- <li class="menu3"><a href="km-event.php">กิจกรรม</a></li>
			<li class="menu4"><a href="km-exhibition.php">นิทรรศการ</a></li>
			<li class="menu5"><a href="km-reseach.php">การค้นคว้าและอ้างอิง</a></li>
			<li class="menu6"><a href="km-education.php">ระบบการศึกษา</a></li>
			<li class="menu7"><a href="km-seminar.php">สัมมนาและอบรม</a></li>
			<li class="menu8"><a href="km-media.php">สื่อการเรียนรู้</a></li> -->
		</ul>
	</div>
</div>
