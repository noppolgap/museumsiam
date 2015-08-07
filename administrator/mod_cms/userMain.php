	<?php
				require("../../assets/configs/config.inc.php");
				require("../../assets/configs/connectdb.inc.php");
				require("../../assets/configs/function.inc.php");
				?>

	<div class="mod-body">
				<div class="buttonActionBox">
					<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button">
					<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
					<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
				</div>
				<div class="mod-body-inner">
					<div class="mod-body-inner-header">
						<div class="floatL titleBox">ชื่อเมนู</div>
						<div class="floatR searchBox">
							<form name="search" action="?" method="post">
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
						<!-- start loop -->
						<?php 

						$sql = "SELECT * FROM sys_app_user order by USER_ID asc ";
					$rs = mysql_query($sql) or die(mysql_error());
					while($row = mysql_fetch_array($rs)){
					
						echo "<div class='Main_Content'>";
						echo "<div class='floatL checkboxContent'><input type='checkbox' name='check' value='".$row["USER_ID"]."'></div>";
						echo "<div class='floatL thumbContent'>";
						echo "<a href='view.php' class='dBlock' style='background-image: url('http://cache.my.kapook.com/imgkapook_2014/31_35_1438829370.jpg')';></a>";
						echo "</div>";
						echo "<div class='floatL nameContent'>";
						echo "<div><a href='view.php'>".$row["NAME"]." ". $row["LAST_NAME"]."</a></div>";

						echo "<div>วันที่สร้าง 01/08/2015 | วันที่ปรับปรุง 06/08/2015 | เปิดอ่าน 100 ครั้ง</div>";
						echo "</div>	";
						echo "<div class='floatL stausContent'><span class='staus1'></span> Enable "."//<span class='staus2'></span> Disable</div>";
						echo "<div class='floatL EditContent'>";
						echo "<a href='#' class='EditContentBtn'>Edit</a>";
						echo "<a href='#' class='DeleteContentBtn'>Delete</a>";
						echo "</div>";
						echo " <div class='clear'></div>	";
						echo " </div>";

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
				</div>	
				<div class="buttonActionBox">
					<input type="button" value="สร้างใหม่" class="buttonAction emerald-flat-button">
					<input type="button" value="ลบ" class="buttonAction alizarin-flat-button">
					<input type="button" value="จัดเรียง" class="buttonAction peter-river-flat-button">
				</div>
			</div>
			<div class="clear"></div>