<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/other-system.css" />

<script>
	$(document).ready(function(){
		$("li.menu6").addClass("active");				
	});
</script>
	
</head>

<body>
	
<?php include('inc/inc-top-bar.php'); ?>	
	
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบอื่นๆ ที่เกี่ยวข้อง</li>
			</ol>
		</div>
	</div>
</div>
<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/th/title-othersystem.png" alt="Other System"/>
			</p>	
		</div>
	</div>
</div>

<div class="box-other-system">
	<div class="container">
		
		
		
		
		<?php
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
										ORDER BY
										ORDER_DATA DESC";
					$query = mysql_query($sqlStr, $conn);
					$countIcon = 0;
					$needGenCloseDiv = FALSE;
					while ($row = mysql_fetch_array($query)) {
						
						if ($countIcon % 5 == 0)
						{
							echo '<div class="system-row cf">';
							$needGenCloseDiv = TRUE;
						}
						
						echo '<div class="box-other">';
						echo '<a href="' . $row['LINK_URL'] . '?MID=' . $row['MODULE_ID'] . '">';
						echo '<div class="box-pic">';
			
						echo '<img src="'.callIconThumbListFrontend('BIG', $row['MODULE_ID'], NULL, false).'">';
						echo '</div>';
						echo '<div class="text-name">';
						echo $row['MODULE_DESC'];
						echo '</div>';
						echo '</a>';
						echo '</div>';
						$countIcon ++;
						if($countIcon % 5 ==0)
						{
							echo "</div>";
							$needGenCloseDiv = FALSE;
						}
					}
					if ($needGenCloseDiv)
						echo "</div>";
					?>
		
		
		<!-- <div class="system-row cf">
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
		</div>
		<div class="system-row cf">
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
			<div class="box-other">
				<a href="">
					<div class="box-pic">
						<img src="http://placehold.it/209x218">
					</div>
					<div class="text-name">
						NAME SYSTEM
					</div>
				</a>
			</div>
		</div> -->
	</div>
</div>

<div class="box-freespace"></div>


<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
