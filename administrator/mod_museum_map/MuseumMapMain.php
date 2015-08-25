
	
					<div class="mod-body-main-content">
						<!-- start loop -->
						<?php 
					//active_flag 0 = disable , 1 = Enable ,  2 = Delete 
						$sql = "SELECT * FROM trn_museum_detail where ACTIVE_FLAG <> 2 ";
						if(isset($_POST['search'])){
							$sql .= " AND (MUSEUM_NAME_LOC like '%".$_POST['str_search']."%' or MUSEUM_NAME_ENG like '%".$_POST['str_search']."%' ";
						$sql .= " order by MUSEUM_DETAIL_ID asc ";
		
			    }
					$rs = mysql_query($sql) or die(mysql_error());
					
					$i = 0 ; 
					while($row = mysql_fetch_array($rs)){
					
						echo "<div class='Main_Content'>";
						echo "<div class='floatL checkboxContent'><input type='checkbox' name='check' value='".$row["MUSEUM_DETAIL_ID"]."'></div>";
						echo "<div class='floatL thumbContent'>";
						echo "<a href='viewMuseumMap.php?MID=".$row["MUSEUM_DETAIL_ID"]."' class='dBlock' style='background-image: url('http://cache.my.kapook.com/imgkapook_2014/31_35_1438829370.jpg')';></a>";
						echo "</div>";
						echo "<div class='floatL nameContent'>";
						echo "<div><a href='viewMuseumMap.php?MID=".$row["MUSEUM_DETAIL_ID"]."'>".$row["MUSEUM_NAME_LOC"]."</a></div>";


						echo "<div>วันที่สร้าง ".$row["CREATE_DATE"]." | วันที่ปรับปรุง ".$row["LAST_UPDATE_DATE"]." </div>";
						echo "</div>	";
						
						
						echo "<div class='floatL EditContent'>";
						
						echo "<a href='editMuseumMap.php?MID=".$row["MUSEUM_DETAIL_ID"]."' class='EditContentBtn'>Edit</a>";
						echo "<a href='delMuseumMap.php?MID=".$row["MUSEUM_DETAIL_ID"]."' class='DeleteContentBtn' >Delete</a>";
						echo "</div>";
						echo " <div class='clear'></div>	";
						echo " </div>";
$i++;
				}mysql_free_result($rs);


						?>
						 
						<!-- end loop -->
					</div>
					<div class="pagination_box">
						<div class="floatL">จำนวนทั้งหมด <?=$i?> รายการ</div>
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
				
				