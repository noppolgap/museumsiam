<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body>
<? require('../inc_header.php'); ?>		
<div class="main-container">
	<div class="main-body marginC">
		<? require('../inc_side.php'); ?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">รายละเอียดรายการ</div>					
				</div>
				<div class="mod-body-main-content">
				<?php
					$id = intval($_GET['qa_id']);
				    $sql = "SELECT * FROM  trn_qa WHERE FLAG <> 2 AND QA_ID ='".$id."' ";
				   
				    $query = mysql_query($sql,$conn);
					$row = mysql_fetch_array($query);
				 ?>	
					
					<div class="formCms">
						<form action="?" method="post" name="formcms">
								
							<div>
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input">
								<? echo $row['CONTENT']; ?> 								
								</div>
								<div class="clear"></div>
							</div>
								
							<div class="btn_action">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href= 'answer.php?qa_id=<?=$_GET['ref_id']?>'">
							</div>
						</form> 
	
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../master/script.js"></script>		
<? logs_access('admin','hello'); ?>	
</body>
</html>
