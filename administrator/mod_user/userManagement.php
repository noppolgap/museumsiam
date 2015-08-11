				<?php
				require("../../assets/configs/config.inc.php");
				require("../../assets/configs/connectdb.inc.php");
				require("../../assets/configs/function.inc.php");
				?>
				<!doctype html>
				<html>
				<head>
				<? require('../inc_meta.php'); ?>		
				<script type="text/javascript" src="../../assets/plugin/jquery.min.js"></script>
				<script type="text/javascript">
					$(document).ready(function (){
			 			$('#cmbProvince').val('-1');
			 			
			 		defaultDistrict();
			 		defaultSubDistrict();

			 			


			 			$('#cmbProvince').bind('change' , function (){
			 				defaultDistrict();
			 				$('#cmbDistrict [data-ref="'+ $('#cmbProvince').val()  +'"]').show();
								
								defaultSubDistrict();
			 			});

			 			$('#cmbDistrict').bind('change' , function (){
			 				defaultSubDistrict();
			 				$('#cmbSubDistrict [data-ref="'+ $('#cmbDistrict').val()  +'"]').show();
								
			 			});

					});

					function defaultSubDistrict ()
					{
						$('#cmbSubDistrict').val('-1');
			 			$('#cmbSubDistrict option').hide();
			 			$('#cmbSubDistrict [value="-1"]').show();
					}
					function defaultDistrict ()
					{
						$('#cmbDistrict').val('-1');
						$('#cmbDistrict option').hide();
			 			$('#cmbDistrict [value="-1"]').show();
					}
				</script>
				</head>

				<body>
				<? require('../inc_header.php'); ?>		
				<div class="main-container">
					<div class="main-body marginC">
						<? require('../inc_side.php'); ?>
						<div class="mod-body"></div>
						<div class="clear"></div>	

						<table>
							<tr>
				<td>
					Username
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtUserName" />
				</td>
								</tr>

										<tr>
				<td>
					Lastname
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtLastname" />
				</td>
								</tr>

						<tr>
				<td>
					Citizen ID
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtCitizen ID" />
				</td>
								</tr>

						<tr>
				<td>
					Address
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtAddress1" />
				</td>
								</tr>

										<tr>
				<td>
					Address 2
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtAddress2" />
				</td>
								</tr>


						<tr>
				<td>
					Province
				</td>
				<td>:
				</td>
				<td>
				</td>
								</tr>
						<tr>
				<td>
					District
				</td>
				<td>:
				</td>
				<td>
					<?php
					connectdb();
					$sql = "SELECT district_id , province_id , district_desc_loc , district_desc_eng FROM mas_district ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbDistrict' name = 'district'>";
					echo "<option value='-1'>กรุณาเลือกอำเภอ</option>";
				while($row = mysql_fetch_array($rs)){
				echo "<option value='".$row["district_id"]."' data-ref='".$row["province_id"]."'>".$row["district_desc_loc"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
					
					?>
				</td>
								</tr>

						<tr>
				<td>
					Sub District
				</td>
				<td>:
				</td>
				<td>
					<?php
					$sql = "SELECT sub_district_id , district_id , sub_district_desc_loc , sub_district_desc_eng FROM mas_sub_district ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbSubDistrict' name = 'subDistrict'>";
					echo "<option value='-1'>กรุณาเลือกตำบล</option>";
				while($row = mysql_fetch_array($rs)){
				echo "<option value='".$row["sub_district_id"]."' data-ref='".$row["district_id"]."'>".$row["sub_district_desc_loc"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
				?>
				</td>
								</tr>


						<tr>
				<td>
					Post Code
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtPostCode" />
				</td>
								</tr>
						<tr>
				<td>
					Telephone
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtTelephone" />
				</td>
								</tr>
						<tr>
				<td>
					Email
				</td>
				<td>:
				</td>
				<td>
					<input type = "text" id = "txtEmail" />
				</td>
								</tr>

						</table>
					</div>
				</div>	
				<? require('../inc_footer.php'); ?>		
				<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
				<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
				<link rel="stylesheet" type="text/css" href="mod_cms.css" media="all" />
				<script type="text/javascript" src="../master/script.js"></script>		
				<script type="text/javascript" src="mod_cms.js"></script>	
				<? logs_access('admin','hello'); ?>	
				</body>
				</html>
