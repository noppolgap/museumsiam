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
		<?
			$MID = $_GET['MID'] ; 
			
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มเนื้อหา</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">
						
						 

						<form action="content_action.php?add&MID=<?=$MID?>" method="post" name="formcms">
					
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								
								<div class="floatL form_input">
								
								<?
								$catSql = "select cc.CONTENT_CAT_ID , cc.CONTENT_CAT_DESC_LOC , cc.CONTENT_CAT_DESC_ENG 
											, cc.IS_LAST_NODE  from trn_content_category cc
											where cc.REF_MODULE_ID = $MID and cc.flag <> 2
											ORDER BY cc.ORDER_DATA  desc  " ;
								 $catQuery = mysql_query($catSql,$conn);
								
								echo  "<select id='cmbCategory' name = 'cmbCategory'>";
								echo "<option value='-1'>กรุณาเลือกหมวดหมู่</option>";
								while($rowCat = mysql_fetch_array($catQuery)){
									echo "<option value='".$rowCat["CONTENT_CAT_ID"]."' data-isLastNode ='".$rowCat["IS_LAST_NODE"]."' >".$rowCat["CONTENT_CAT_DESC_LOC"]."</option>";
								}mysql_free_result($catQuery);
								echo "</select>";
?>
<span class="error" >* <span id = "categoryError" style="display:none">กรุณาเลือกหมวดหมู่ </span> </span>
				</div>
								 
								
								<div class="clear"></div>
				
							</div>	
							
							<div id = "divSubCat" style="display:none">
								<div class="floatL form_name">หมวดหมู่ย่อย</div>
								<div class="floatL form_input" id="divSubCatCmbZone">
								
								</div>
								<span class="error" >* <span id = "subCategoryError" style="display:none">กรุณาเลือกหมวดหมู่ย่อย </span> </span>
								<div class="clear"></div>
							</div>
							
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" id ="txtDescLoc" value="" class="w90p" /></div>
								<span class="error" >* <span id = "nameThError" style="display:none">กรุณาระบุชื่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" id="txtDescEng" value="" class="w90p" /></div>
								<span class="error" >* <span id = "nameEnError" style="display:none">กรุณาระบุชื่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="txtBriefDescLoc" id = "txtBriefDescLoc" class="mytextarea2 w90p"></textarea></div>
								<span class="error" style="display:none">* <span id = "briefThError" style="display:none">กรุณาระบุรายละเอียดย่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="txtBriefDescEng" id="txtBriefDescEng" class="mytextarea2 w90p"></textarea></div>
								<span class="error"   style="display:none">* <span id = "briefEnError" style="display:none">กรุณาระบุรายละเอียดย่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด TH</div>
								<div class="floatL form_input"><textarea name="txtDetailLoc" id = "txtDetailLoc" value="" class="mytextarea w90p"></textarea></div>
								<span class="error" >* <span id = "detailThError" style="display:none">กรุณาระบุรายละเอียด TH</span> </span>
								<div class="clear"></div>
							</div>
							
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด EN</div>
								<div class="floatL form_input"><textarea name="txtDetailEng" id="txtDetailEng" value="" class="mytextarea w90p"></textarea></div>
								<span class="error" >* <span id = "detailEnError" style="display:none">กรุณาระบุรายละเอียด EN</span> </span>
								<div class="clear"></div>
							</div>
							
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo')?></div>
								<div class="clear"></div>
							</div>	
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button" onclick="return onValidate();">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'content_view.php?MID=<?=$MID?>' ">
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
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	


<script type="text/javascript">
$(document).ready (function (){
	//divSubCatCmbZone  , divSubCat
	
	$('#cmbCategory').bind('change'  , function (){
		
		if ($('#cmbCategory :selected').attr('data-isLastNode') == 'N')
		{
			$.post( 'content_action.php', { catID: $('#cmbCategory :selected').val() })
				.done(function( data ) {
					$('#divSubCat').show(); 
					$('#divSubCatCmbZone').html (data) ; 
					//console.log('done : ' + data) ; 
				});
		}
		else 
		{
			$('#divSubCat').hide(); 
			$('#divSubCatCmbZone').html ('') ; 
		}
	}) ;
	
	
	
  
});


function onValidate()
{
	var ret = true ; 
        $('#categoryError').hide();
        $('#subCategoryError').hide();
        $('#nameThError').hide();
        $('#nameEnError').hide();
        $('#briefThError').hide();
        $('#briefEnError').hide() ; 
        $('#detailThError').hide();
        $('#detailEnError').hide();
      
		
	if ($('#cmbCategory :selected').val() == '-1' )
	{
		ret = false;
		$('#categoryError').show();
	}
	
	if ( $('#cmbCategory :selected').attr('data-isLastNode') == 'N' )
	{
		if( $('#cmbSubCategory :selected').val() == '-1' )
		{
			ret = false ; 
			$('#subCategoryError').show();
		}
	}
	
	if($('#txtDescLoc').val () == '')
	{
		ret = false ; 
		$('#nameThError').show();
	}
	if($('#txtDescEng').val () == '')
	{
		ret = false ; 
		$('#nameEnError').show();
	}
	
	
	if( tinyMCE.get('txtDetailLoc').getContent() == '')
	{
		ret = false ; 
		$('#detailThError').show();
	}
	if( tinyMCE.get('txtDetailEng').getContent()   == '')
	{
		ret = false ; 
		$('#detailEnError').show();
	}
	if (ret)
        {
           document.getElementById("frmcms").submit();
        }
	else 
		return false ; 
			 
}
</script>
 <style  >
    .error , .error span
    {
      color : red;
    }
    </style>
</body>
</html>
