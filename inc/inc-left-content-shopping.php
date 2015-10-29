<div class="part-left-title-page">
	<div class="box-title-page">
		<a href=""><img src="images/th/title-online-system.png" alt="title-online-system" width="" height="" /></a>
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
			<li class="menu1"><a href="">หน้าหลัก</a>
			<li class="menu2"><a href="">e-BOOKING + ONLINE TICKET</a></li>
			<li class="menu3 sub"><a href="">e-SHOPPING</a>
				<ul class="submenu-left">

			<?php
			     $sql  = "select CONTENT_CAT_ID,CONTENT_CAT_DESC_LOC from trn_content_category where REF_MODULE_ID= $education_cat_id 
			     					AND FLAG = 0 ORDER BY ORDER_DATA desc  ";

			     $query = mysql_query($sql,$conn);


				 while($row = mysql_fetch_array($query)){

				 	echo '<li class="submenu1"><a href="e-shopping-category.php?cid='.$row['CONTENT_CAT_ID'].'">'.$row['CONTENT_CAT_DESC_LOC'].'</a></li>';

				 }
			?>
				</ul>
			</li>
		</ul>
	</div>
</div>
