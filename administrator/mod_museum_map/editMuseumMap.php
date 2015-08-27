<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
$indexPage = "/administrator/mod_museum_map/index.php";
?>
<!doctype html>
<html>
  <head>
    <? require('../inc_meta.php'); ?>	

    <script type="text/javascript" src="../../assets/plugin/jquery.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function (){

        

     // $('#cmbProvince').val('-1');

      //defaultDistrict();
      //defaultSubDistrict();




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

       


function onValidate() 
      {
        var ret = true ; 
       $('#nameLocError').hide();
        $('#nameEngError').hide();
         $('#displayNameError').hide();
		 $('#addressError').hide();
		 $('#provinceError').hide() ; 
        $('#districtError').hide();
        $('#subDistrictError').hide();
        $('#postCodeError').hide();
        $('#telephoneError').hide();
$('#emailError').hide();
$('#detailLocError').hide();
$('#detailEngError').hide();
$('#latError').hide();
$('#lonError').hide();

        if ($('#txtNameLoc').val() == '')
        {
            $('#nameLocError').show();
            ret = false;
        }
        if ($('#txtNameEng').val() == '')
        {
          $('#nameEngError').show();
          ret = false;
        }
         if($('#txtDisplayName').val() == '')
		 {
			 $('#displayNameError').show();
			 ret = false;
		 }
		 if($('#txtAddress').val () == '')
        {
          $('#addressError').show();
          ret= false;
        }
        if($('#cmbProvince').val() == '-1')
        {
          $('#provinceError').show() ; 
          ret = false ;
        }
        if ($('#cmbDistrict').val() == '-1')
        {
            $('#districtError').show();
            ret = false;
        }
        if ($('#cmbSubDistrict').val() == '-1')
        {
          $('#subDistrictError').show();
          ret = false ;
        }  
        if($('#txtPostCode').val() == '')
        {
          $('#postCodeError').show();
          ret = false ;
        }
        if ($('#txtTelephone').val() == '')
        {
          $('#telephoneError').show();
          ret = false;
        }

		if($('#txtEmail').val() == '')
		{
			$('#emailError').show();
			ret = false ;
		}
		if ($('#txtDetailLoc').val() == '')
		{
			$('#detailLocError').show();
			ret = false ;
		}
		if ($('#txtDetailEng').val() == '')
		{
			$('#detailEngError').show();
			ret =false;
		}
		
        if (ret)
        {
           document.getElementById("frmcms").submit();
        }
      }
      
    </script>

    <style  >
    .error , .error span
    {
      color : red;
    }
    </style>
  </head>

  <body>
    <? require('../inc_header.php'); ?>		
	
<?php
		$museumID = $_GET['MID'] ;

	$sql = "SELECT * FROM trn_museum_detail where MUSEUM_DETAIL_ID = '".$museumID."' ";
	$rs = mysql_query($sql) or die(mysql_error());
	$rowMuseum = mysql_fetch_array($rs);
?>
    <div class="main-container">
      <div class="main-body marginC">
        <? require('../inc_side.php'); ?>
		
        <div class="mod-body">
          <div class="mod-body-inner">
            <div class="mod-body-inner-header">
              <div class="floatL titleBox">แก้ไข</div>
            </div>
            <div class="mod-body-main-content">
              <!--<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>-->
              <div class="formCms">
                <form action="?" method="post" name="formcms" id = "frmcms" >
                   <div >
                  <div class="floatL form_name">ชื่อพิพิธภัณฑ์ภาษาไทย</div>
                    <div class="floatL form_input">
                      <input id = "txtNameLoc" type="text" name="txtNameLoc"   class="w90p"  value="<?php echo $rowMuseum['MUSEUM_NAME_LOC']?>" />
      <span class="error" >* <span id = "nameLocError" style="display:none">กรุณาระบุชื่อพิพิธภัณฑ์ภาษาไทย </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">ชื่อพิพิธภัณฑ์ภาษาอังกฤษ</div>
                    <div class="floatL form_input">
                      <input  id = "txtNameEng" type="text" name="txtNameEng" value="<?php echo $rowMuseum['MUSEUM_NAME_ENG']?>" class="w90p" />
                          <span class="error" >* <span id = "nameEngError" style="display:none">กรุณาระบุชื่อพิพิธภัณฑ์ภาษาอังกฤษ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>

				   <div>
                    <div class="floatL form_name">ชื่อพิพิธิภัฑณ์ที่ใช้แสดง</div>
                    <div class="floatL form_input">
                      <input  id = "txtDisplayName" type="text" name="txtDisplayName" value="<?php echo $rowMuseum['MUSEUM_DISPLAY_NAME']?>" class="w90p" />
                          <span class="error" >* <span id = "displayNameError" style="display:none">กรุณาระบุชื่อพิพิธภัณฑ์ที่ใช้แสดง</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  <div  class="bigForm">
                    <div class="floatL form_name">ที่อยู่</div>
                    <div class="floatL form_input">
                      <textarea id= "txtAddress" name="txtAddress" class="w90p mytextarea2"><?php echo $rowMuseum['ADDRESS1']?></textarea>
                      <span class="error" >* <span id = "addressError" style="display:none">กรุณาระบุที่อยู่ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  
				  
				  <div>
                    <div class="floatL form_name">จังหวัด</div>
                    <div class="floatL form_input">

                      <?php
					$sql = "SELECT province_id  , province_desc_loc , province_desc_eng FROM mas_province ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbProvince' name = 'cmbProvince'>";
					echo "<option value='-1'>กรุณาเลือกจังหวัด</option>";
				while($row = mysql_fetch_array($rs)){
					
					if ( $rowMuseum['PROVINCE_ID'] == $row["province_id"]  )
						echo "<option value='".$row["province_id"]."' selected>".$row["province_desc_loc"]."</option>";
					else 
				echo "<option value='".$row["province_id"]."'>".$row["province_desc_loc"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
				?>
        <span class="error" >* <span id = "provinceError" style="display:none">กรุณาระบุจังหวัด </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">อำเภอ</div>
                    <div class="floatL form_input">
                      <?php
					connectdb();
					$sql = "SELECT district_id , province_id , district_desc_loc , district_desc_eng FROM mas_district ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbDistrict' name = 'cmbDistrict'>";
					echo "<option value='-1'>กรุณาเลือกอำเภอ</option>";
				while($row = mysql_fetch_array($rs)){
					if ( $rowMuseum['DISTRICT_ID'] == $row["district_id"]  )
						echo "<option value='".$row["district_id"]."' data-ref='".$row["province_id"]."' selected >".$row["district_desc_loc"]."</option>";
					else 
				echo "<option value='".$row["district_id"]."' data-ref='".$row["province_id"]."'>".$row["district_desc_loc"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
					
					?>
         <span class="error" >* <span id = "districtError" style="display:none">กรุณาระบุอำเภอ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">ตำบล</div>
                    <div class="floatL form_input">
                      <?php
					//  echo $rowMuseum['SUB_DISTRICT_ID'];
					$sql = "SELECT sub_district_id , district_id , sub_district_desc_loc , sub_district_desc_eng FROM mas_sub_district ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbSubDistrict' name = 'cmbSubDistrict'>";
					echo "<option value='-1'>กรุณาเลือกตำบล</option>";
				while($row = mysql_fetch_array($rs)){
					if ( $rowMuseum["SUB_DISTRICT_ID"] == $row["sub_district_id"]  )
						echo "<option value='".$row["sub_district_id"]."' data-ref='".$row["district_id"]."' selected>".$row["sub_district_desc_loc"]."</option>";
					else 
						echo "<option value='".$row["sub_district_id"]."' data-ref='".$row["district_id"]."'>".$row["sub_district_desc_loc"]."</option>";
				}mysql_free_result($rs);
				echo "</select>";
				?>
       <span class="error" >* <span id = "subDistrictError" style="display:none">กรุณาระบุตำบล </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">รหัสไปรษณีย์</div>
                    <div class="floatL form_input">
                      <input  id = "txtPostCode" type="text" name="txtPostCode" value="<?php echo $rowMuseum['POST_CODE']?>" class="w90p" />
                      <span class="error" >* <span id = "postCodeError" style="display:none">กรุณาระบุรหัสไปรษณีย์ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">โทรศัพท์</div>
                    <div class="floatL form_input">
                      <input  id = "txtTelephone" type="text" name="txtTelephone" value="<?php echo $rowMuseum['TELEPHONE']?>" class="w90p" />
                     <span class="error" >* <span id = "telephoneError" style="display:none">กรุณาระบุเบอร์โทรศัพท์</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  <div>
                    <div class="floatL form_name">Email</div>
                    <div class="floatL form_input">
                      <input  id = "txtEmail" type="text" name="txtEmail" value="<?php echo $rowMuseum['EMAIL']?>" class="w90p" />
                     <span class="error" >* <span id = "emailError" style="display:none">กรุณาระบุ Email</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  <div  class="bigForm">
                    <div class="floatL form_name">คำอธิบายพิพิธภัณฑ์ภาษาไทย</div>
                    <div class="floatL form_input">
                      <textarea id= "txtDetailLoc" name="txtDetailLoc" class="w90p mytextarea2"><?php echo $rowMuseum['DESCRIPT_LOC']?></textarea>
                      <span class="error" >* <span id = "detailLocError" style="display:none">กรุณาระบุทคำอธิบายพิพิธภัณฑ์ภาษาไทย</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				    <div  class="bigForm">
                    <div class="floatL form_name">คำอธิบายพิพิธภัณฑ์ภาษาอังกฤษ</div>
                    <div class="floatL form_input">
                      <textarea id= "txtDetailEng" name="txtDetailEng" class="w90p mytextarea2"><?php echo $rowMuseum['DESCRIPT_ENG']?></textarea>
                      <span class="error" >* <span id = "detailEngError" style="display:none">กรุณาระบุทคำอธิบายพิพิธภัณฑ์ภาษาอังกฤษ</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  <div>
                    <div class="floatL form_name">พิกัดละติจูด</div>
                    <div class="floatL form_input">
                      <input  id = "txtLat" type="text" name="txtLat" value="<?php echo $rowMuseum['LAT']?>" class="w90p" />
                     <span class="error" >* <span id = "latError" style="display:none">กรุณาระบุพิกัดละติจูด</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  <div>
                    <div class="floatL form_name">พิกัดลองติจูด</div>
                    <div class="floatL form_input">
                      <input  id = "txtLon" type="text" name="txtLon" value="<?php echo $rowMuseum['LON']?>" class="w90p" />
                     <span class="error" >* <span id = "lonError" style="display:none">กรุณาระบุพิกัดลองติจูด</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
                  <div class="btn_action">
                    <input type="button" name="save" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="onValidate()" >
                      <input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
                        <input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
							</div>
              <input type="hidden" name="action" value="submit" />
			  <input type="hidden" name="MID" value="<?php echo $museumID?>"/>
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

<?php 
 
 
if(isset($_POST["action"]) && $_POST["action"] == "submit") {
 $mid = $_POST['MID'];
 $txtNameLoc = $_POST['txtNameLoc'];
    $txtNameEng  = $_POST['txtNameEng'];
    
	$txtDisplayName = $_POST['txtDisplayName'];
	$txtAddress = $_POST['txtAddress'];
	 $province = $_POST['cmbProvince'];
    $district = $_POST['cmbDistrict'];
    $subDistrict = $_POST['cmbSubDistrict'];
    $txtPostCode = $_POST['txtPostCode'];
    $txtTelephone = $_POST['txtTelephone'];
	 $txtEmail = $_POST['txtEmail'];
	 $txtLat = $_POST['txtLat'];
	 $txtLon = $_POST['txtLon'];
	 $txtDetailLoc = $_POST['txtDetailLoc'];
	 $txtDetailEng = $_POST['txtDetailEng'];

	 	
    $strSQL = "update trn_museum_detail ";
    $strSQL .="set MUSEUM_NAME_LOC = '".$txtNameLoc."'";
	$strSQL .= " ,MUSEUM_NAME_ENG = '". $txtNameEng ."'";
	$strSQL .= " , MUSEUM_DISPLAY_NAME = '".$txtDisplayName."'";
	$strSQL .= " , ADDRESS1 = '".$txtAddress."'";
	$strSQL .= " ,DISTRICT_ID = '".$district."'";
	$strSQL .= " , SUB_DISTRICT_ID = '".$subDistrict."'" ;
	$strSQL .= " , PROVINCE_ID = '".$province."'";
	$strSQL .= " , POST_CODE = '".$txtPostCode."'";
	$strSQL .= " ,TELEPHONE = '".$txtTelephone."'";
	$strSQL .= " , EMAIL = '".$txtEmail."'";
	$strSQL .= " , LAT  = '".$txtLat."'";
	$strSQL .= " , LON  = '".$txtLon."'";
	$strSQL .= " , DESCRIPT_LOC   = '".$txtDetailLoc."'";
	$strSQL .= " , DESCRIPT_ENG = '".$txtDetailEng."' ";
	$strSQL .= " ,LAST_UPDATE_DATE = now() ";
	$strSQL .= " ,LAST_UPDATE_USER = 'Test'";
	$strSQL .= " ,LAST_FUNCTION = 'U'";
	 $strSQL .= " where MUSEUM_DETAIL_ID = '".$mid."'";
    $objQuery  = mysql_query($strSQL);
	
	 
    if($objQuery)
    {
		 
      echo "<script type='text/javascript'>window.location.href = '"._FULL_SITE_PATH_.$indexPage."';</script>";
    }
    else
    {
			 
      echo "Error Save [".$strSQL."]";
    }

}

?>
  </body>
</html>
