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


function onValidate() 
      {
        var ret = true ; 
        $('#emailError').hide();
        $('#nameError').hide();
        $('#lastNameError').hide();
        $('#citizenError').hide();
        $('#addressError').hide();
        $('#provinceError').hide() ; 
        $('#districtError').hide();
        $('#subDistrictError').hide();
        $('#postCodeError').hide();
        $('#telephoneError').hide();
		$('#passwordError').hide ();
        if ($('#txtEmail').val() == '')
        {
            $('#emailError').show();
            ret = false;
        }
		if($('#txtPwd').val() == '' )
		{
			$('#passwordError').show();
			ret = false ; 
		}
        if ($('#txtName').val() == '')
        {
          $('#nameError').show();
          ret = false;
        }
        if ($('#txtLastName').val() == '')
        {
          $('#lastNameError').show();
          ret = false;
        }
        if ($('#txtCitizenID').val() == '')
        {
          $('#citizenError').show();
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

        if (ret)
        {
           document.getElementById("frmcms").submit();
           //$("#formcms").submit();
          //document.formcms.onsubmit();
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

    <div class="main-container">
      <div class="main-body marginC">
        <? require('../inc_side.php'); ?>
		
        <div class="mod-body">
          <div class="mod-body-inner">
            <div class="mod-body-inner-header">
              <div class="floatL titleBox">เพิ่มรายการ</div>
            </div>
            <div class="mod-body-main-content">
              <!--<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>-->
              <div class="formCms">
                <form action="?" method="post" name="formcms" id = "frmcms" >
                  <div >
                    <div class="floatL form_name">Email</div>
                    <div class="floatL form_input">
                      <input id = "txtEmail" type="text" name="txtEmail"  value="" class="w90p"  />
                      <span class="error" >* <span id = "emailError" style="display:none">กรุณาระบุE-mail </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				  <div >
                    <div class="floatL form_name">Password</div>
                    <div class="floatL form_input">
                      <input id = "txtPwd" type="password" name="txtPwd"  value="" class="w90p"  />
                      <span class="error" >* <span id = "passwordError" style="display:none">กรุณาระบุ Password </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
                  <div>
                    <div class="floatL form_name">ชื่อ</div>
                    <div class="floatL form_input">
                      <input  id = "txtName" type="text" name="txtName" value="" class="w90p" />
                      <span class="error" >* <span id = "nameError" style="display:none">กรุณาระบุชื่อ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">นามสกุล</div>
                    <div class="floatL form_input">
                      <input  id = "txtLastName" type="text" name="txtLastName" value="" class="w90p" />
                      <span class="error" >* <span id = "lastNameError" style="display:none">กรุณาระบุนามสกุล </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">เลขที่บัตรประชาชน</div>
                    <div class="floatL form_input">
                      <input  id = "txtCitizenID" type="text" name="txtCitizenID" value="" class="w90p" />
                      <span class="error" >* <span id = "citizenError" style="display:none">กรุณาระบุเลขที่บัตรประชาชน </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div  class="bigForm">
                    <div class="floatL form_name">ที่อยู่</div>
                    <div class="floatL form_input">
                      <textarea id= "txtAddress" name="txtAddress" class="w90p mytextarea2"></textarea>
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
					$sql = "SELECT sub_district_id , district_id , sub_district_desc_loc , sub_district_desc_eng FROM mas_sub_district ";
					$rs = mysql_query($sql) or die(mysql_error());
					echo  "<select id='cmbSubDistrict' name = 'cmbSubDistrict'>";
					echo "<option value='-1'>กรุณาเลือกตำบล</option>";
				while($row = mysql_fetch_array($rs)){
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
                      <input  id = "txtPostCode" type="text" name="txtPostCode" value="" class="w90p" />
                      <span class="error" >* <span id = "postCodeError" style="display:none">กรุณาระบุรหัสไปรษณีย์ </span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div>
                    <div class="floatL form_name">โทรศัพท์</div>
                    <div class="floatL form_input">
                      <input  id = "txtTelephone" type="text" name="txtTelephone" value="" class="w90p" />
                     <span class="error" >* <span id = "telephoneError" style="display:none">กรุณาระบุเบอร์โทรศัพท์</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				   <div>
                    <div class="floatL form_name">โทรศัพท์เคลื่อนที่</div>
                    <div class="floatL form_input">
                      <input  id = "txtMobilePhone" type="text" name="txtMobilePhone" value="" class="w90p" />
                     <span class="error" >* <span id = "modilePhoneError" style="display:none">กรุณาระบุเบอร์โทรศัพท์เคลื่อนที่</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>
				  
				   <div>
                    <div class="floatL form_name">โทรสาร</div>
                    <div class="floatL form_input">
                      <input  id = "txtFax" type="text" name="txtFax" value="" class="w90p" />
                     <span class="error" >* <span id = "faxError" style="display:none">กรุณาระบุเบอร์โทรสาร</span> </span>
                    </div>
                    <div class="clear"></div>
                  </div>

                  <div class="btn_action">
                    <input type="button" name="save" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="onValidate()" >
                      <input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
                        <input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
							</div>
              <input type="hidden" name="action" value="submit" />
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
 
 
    $txtEmail = $_POST['txtEmail'];
    $txtName  = $_POST['txtName'];
    $txtLastName = $_POST['txtLastName'];
    $txtCitizenID = $_POST['txtCitizenID'];
    $txtAddress = $_POST['txtAddress'];
    $province = $_POST['cmbProvince'];
    $district = $_POST['cmbDistrict'];
    $subDistrict = $_POST['cmbSubDistrict'];
    $txtPostCode = $_POST['txtPostCode'];
    $txtTelephone = $_POST['txtTelephone'];
	
	$txtPwd  = $_POST['txtPwd'] ; 
	$txtMobilePhone = $_POST['txtMobilePhone'] ; 
	$txtFax = $_POST['txtFax'] ; 
	

    $strSQL = "INSERT INTO sys_app_user ";
    $strSQL .="(USER_ID,NAME,LAST_NAME,ADDRESS1,DISTRICT_ID,SUB_DISTRICT_ID,PROVINCE_ID";
    $strSQL .=",POST_CODE,TELEPHONE,EMAIL,CITIZEN_ID,USER_CREATE,CREATE_DATE,LAST_FUNCTION , PWD , MOBILE_PHONE , FAX) ";
    $strSQL .="VALUES ";
    $strSQL .="('".$txtEmail."','".$txtName."','".$txtLastName."','".$txtAddress."','".$district."','".$subDistrict."','".$province."' ";
    $strSQL .=",'".$txtPostCode."','".$txtTelephone."','".$txtEmail."','".$txtCitizenID."','Test' , now() , 'A' , '".createPasswordHash($strPlainText)."'  , '".$txtMobilePhone."' , '".$txtFax."') ";
    $objQuery = mysql_query($strSQL);
    if($objQuery)
    {
     // header("Location:"._FULL_SITE_PATH_."/administrator/mod_user/index.php");
      echo "<script type='text/javascript'>window.location.href = '"._FULL_SITE_PATH_."/administrator/mod_user/index.php';</script>";
      
    }
    else
    {
      echo "Error Save [".$strSQL."]";
    }

}

?>
  </body>
</html>
