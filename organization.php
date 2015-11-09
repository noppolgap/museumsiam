<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
	<head>
		<?
		require ('inc_meta.php');
		?>

		<link rel="stylesheet" type="text/css" href="css/template.css" />
		<link rel="stylesheet" type="text/css" href="css/organization.css" />

		<script>
			$(document).ready(function() {
				$(".menutop li.menu2,.menu-left li.menu2").addClass("active");

				$('.box-group').on('click', function(e) {
					$(".box-group").next().slideUp();
					$(".box-group").removeClass("active");
					e.stopPropagation();
					if ($(this).hasClass("opened")) {
						$(".box-group").next().slideUp();
						$(".box-group").removeClass("opened");
						$(this).next().slideUp();
						$(this).removeClass("active");
						$(this).removeClass("opened");
					} else {
						$(".box-group").removeClass("opened");
						$(this).next().slideDown();
						$(this).addClass("active");
						$(this).addClass("opened");
					}
				});
			});
		</script>

	</head>

	<body id="organization">

		<?php
		include ('inc/inc-top-bar.php');
		?>
		<?php
		include ('inc/inc-menu.php');
		?>

		<div class="part-nav-main"  id="firstbox">
			<div class="container">
				<div class="box-nav">
					<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							รู้จักเรา&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							โครงสร้างของเราs
						</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<div class="part-main">
			<div class="container cf">
				<div class="box-left main-content">
					<?php
					include ('inc/inc-left-content-about.php');
					?>
				</div>
				<div class="box-right main-content">
					<hr class="line-red"/>
					<div class="box-title-system cf news">
						<h1><img src="images/th/about/title6.png" alt="โครงสร้างองค์กร"/></h1>
					</div>
					

						<?php
						if ($_SESSION['LANG'] == 'TH') {
							$selectedColumn = "	org.NAME_LOC as EMP_NAME ,org.POSITION_DESC_LOC as POSITION_DESC , ";
						} else {
							$selectedColumn = "	org.NAME_ENG as EMP_NAME ,org.POSITION_DESC_ENG as POSITION_DESC , ";
						}

						$sqlCEO = " SELECT " . $selectedColumn;
						$sqlCEO .= " org.PHONE,
									org.EMAIL,
									org.IMG_PATH
									FROM
									mas_org org
									WHERE
									org.PARENT_ORG_ID = 0 AND org.ACTIVE_FLAG <> 2";
						$rs = mysql_query($sqlCEO) or die(mysql_error());
						while( $row = mysql_fetch_array($rs))
						{
						?>
<div class="box-ceo">
						<p class="position-text">
							<?=$row['POSITION_DESC'] ?>
						</p>
						<div class="name-text">
							<div class="box-pic">
								<img src="<?=callOrgPicture($row['IMG_PATH']) ?>" alt="user"/>
							</div>
							<p class="name">
								<?=$row['EMP_NAME'] ?>  
							</p>
							<div class="box-tel cf">
								<div class="box-left">
									เบอร์โทรศัพท์
								</div>
								<div class="box-right">
									<a href="tel:<?=$row['PHONE'] ?>"><?=$row['PHONE'] ?>  </a>
								</div>
							</div>
							<div class="box-email cf">
								<div class="box-left">
									อีเมล
								</div>
								<div class="box-right">
									<a href="mail:<?=$row['EMAIL'] ?>"><?=$row['EMAIL'] ?></a>
								</div>
							</div>
						</div>
						</div>
						<?} ?>
					
					
					
					<div class="box-acco-main">
						<!-- Loop Section -->
						<?php
							if ($_SESSION['LANG'] == 'TH') {
								$sectionColumn = " SECTION_DESC_LOC as SECTION_DESC ";
							} else {
								$sectionColumn = " SECTION_DESC_ENG as SECTION_DESC ";
							}
							$sqlSection = " SELECT SECTION_ID , " . $sectionColumn;
							$sqlSection .= " 	FROM
												mas_section
											WHERE
												ACTIVE_FLAG = 1
											ORDER BY
												ORDER_DATA DESC ";
							$rsSection = mysql_query($sqlSection) or die(mysql_error());
						while ($rowSection = mysql_fetch_array($rsSection))
						{
						
						?>
						<div class="group-row cf">
							<div class="box-group">
								<?=$rowSection['SECTION_DESC'] ?>
							</div>
							<div class="content-hide">
								<div class="box-group-detail">
									<?php

									if ($_SESSION['LANG'] == 'TH') {
										$peopleInSectionSelectedColumn = " org.NAME_LOC as EMP_NAME , org.POSITION_DESC_LOC as POSITION_DESC , section.SECTION_DESC_LOC as SECTION_DESC ";
									} else {
										$peopleInSectionSelectedColumn = " org.NAME_ENG as EMP_NAME , org.POSITION_DESC_ENG as POSITION_DESC , section.SECTION_DESC_ENG as SECTION_DESC ";
									}
									//Select only DEPARTMENT_ID = -1
									$sqlPeopleInSection = " SELECT
															org.ORG_ID,
															org.SECTION_ID,
															org.PHONE,
															org.EMAIL, ".$peopleInSectionSelectedColumn;
															
									$sqlPeopleInSection .= " FROM
															mas_org org
														LEFT JOIN mas_section section ON section.SECTION_ID = org.SECTION_ID
														WHERE
															org.SECTION_ID = ". $rowSection['SECTION_ID'];
									$sqlPeopleInSection .= " and org.DEPARTMENT_ID = -1 and section.ACTIVE_FLAG <> 2  AND org.ACTIVE_FLAG <> 2 ORDER BY
															org.ORDER_DATA DESC ";
									
									$rsPeopleSection = mysql_query($sqlPeopleInSection) or die(mysql_error());
									while ($rowPeopleSection = mysql_fetch_array($rsPeopleSection))
									{
	?>
									<ul class="list-position">
										<li class="cf">
											<div class="box-left">
												<div class="box-pic">
													<img src="<?=callOrgPicture($row['IMG_PATH']) ?>" alt="user"/>
												</div>
											</div>
											<div class="box-right">
												<div class="name-text">
													<p class="name-position">
														<?=$rowPeopleSection['POSITION_DESC'] ?>
													</p>
													<p class="name">
														<?=$rowPeopleSection['EMP_NAME'] ?>
													</p>
													<div class="box-tel cf">
														<div class="box-left">
															เบอร์โทรศัพท์
														</div>
														<div class="box-right">
															<a href="tel:<?=$rowPeopleSection['PHONE'] ?>"><?=$rowPeopleSection['PHONE'] ?></a>
														</div>
													</div>
													<div class="box-email cf">
														<div class="box-left">
															อีเมล
														</div>
														<div class="box-right">
															<a href="mail:<?=$rowPeopleSection['EMAIL'] ?>"><?=$rowPeopleSection['EMAIL'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
	<?} //end peopleSection ?>
									<?php 
									//Loop department under this section 
									if ($_SESSION['LANG'] == 'TH')
										$departmentSelectedColumn = " DEPARTMENT_DESC_LOC  as DEPARTMENT_DESC , DEPARTMENT_BREIFT_LOC as  DEPARTMENT_BREIFT ";
									else 
										$departmentSelectedColumn = " DEPARTMENT_DESC_ENG  as DEPARTMENT_DESC , DEPARTMENT_BREIFT_ENG as  DEPARTMENT_BREIFT ";
									$sqlDepartment = "SELECT
															DEPARTMENT_ID,".$departmentSelectedColumn ;
									$sqlDepartment .= "	FROM
															mas_department
														WHERE
															REF_SECTION_ID = ".$rowSection['SECTION_ID'];
									$sqlDepartment .="	AND ACTIVE_FLAG <> 2
														ORDER BY
															order_data DESC";
									$rsDepartment = mysql_query($sqlDepartment) or die(mysql_error());
									while ($rowDepartment = mysql_fetch_array($rsDepartment))		
									{				
									?>
									<div class="department">
										<?=$rowDepartment['DEPARTMENT_DESC'] ?>
									</div>
									<ul class="list-role">
										<div>
										<?= $rowDepartment['DEPARTMENT_BREIFT'] ?>
										</div>
									</ul>
										<!-- Loop People in department -->
									<ul class="list-position">	
										<?php
										if ($_SESSION['LANG'] == 'TH')
											$peopleDepartmentSelectedColumn = "mOrg.NAME_LOC as EMP_NAME, mOrg.POSITION_DESC_LOC as POSITION_DESC , ";
										else
											$peopleDepartmentSelectedColumn = "mOrg.NAME_ENG as EMP_NAME, mOrg.POSITION_DESC_ENG as POSITION_DESC ,";
										$peopleDepartment = " SELECT ".$peopleDepartmentSelectedColumn ;
										$peopleDepartment .= "	    mOrg.PHONE,
																	mOrg.EMAIL,
																	mOrg.IMG_PATH
																FROM
																	mas_org mOrg
																WHERE
																	mOrg.SECTION_ID = ".$rowSection['SECTION_ID'];
										$peopleDepartment .= "		AND mOrg.DEPARTMENT_ID = ".$rowDepartment['DEPARTMENT_ID'];
										$peopleDepartment .= "		AND mOrg.ACTIVE_FLAG <> 2 ";
										$peopleDepartment .= "	ORDER BY
																	ORDER_DATA DESC ";
										$rsPeopleDepartment = mysql_query($peopleDepartment) or die(mysql_error());
									//	echo $peopleDepartment; 
										while ($rowPeopleDepartment = mysql_fetch_array($rsPeopleDepartment))
										{		
	?>
									
										<li class="cf">
											<div class="box-left">
												<div class="box-pic">
													<img src="<?=callOrgPicture($row['IMG_PATH']) ?>" alt="user"/>
												</div>
											</div>
											<div class="box-right">
												<div class="name-text">
													<p class="name-position">
														<?=	$rowPeopleDepartment['POSITION_DESC'] ?>
													</p>
													<p class="name">
														<?=	$rowPeopleDepartment['EMP_NAME'] ?>
													</p>
													<div class="box-tel cf">
														<div class="box-left">
															เบอร์โทรศัพท์
														</div>
														<div class="box-right">
															<a href="tel:<?=	$rowPeopleDepartment['PHONE'] ?>"><?=	$rowPeopleDepartment['PHONE'] ?></a>
														</div>
													</div>
													<div class="box-email cf">
														<div class="box-left">
															อีเมล
														</div>
														<div class="box-right">
															<a href="mail:<?=	$rowPeopleDepartment['EMAIL'] ?>"><?=	$rowPeopleDepartment['EMAIL'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</li>
										 
									
									<?} ?>
									</ul>
										<!-- End Loop People in department -->
									<?} // end department ?>
								
								</div>
							</div>
						</div>
<?php } ?>
	<!-- End Loop Section -->
						

					</div>
				</div>
			</div>

			<div class="box-freespace"></div>

			<?php
			include ('inc/inc-footer.php');
			?>

	</body>
</html>
