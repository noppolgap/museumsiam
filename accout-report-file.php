<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
require("inc/inc-cat-id-conf.php");

$strExcelFileName	= time().".xls";

header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma: no-cache");

$myclass= 'xl'.time();
$type =  intval($_GET['type']);
$stardate = date("Y-m-d", strtotime(trim($_GET['date1'])));
$enddate = date("Y-m-d", strtotime(trim($_GET['date2'])));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=strExcelFileName?></title>
</head>
<body>
<?php
if($type == 1){ ?>
  <strong>สมาชิก</strong>
  <br/>
  <br/>
  <div x:publishsource="Excel">
  <table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
      <tr>
        <th width="50" class="<?=$myclass?>"><strong>วันที่ลงทะเบียน</strong></th>
        <th width="80" class="<?=$myclass?>"><strong>จำนวน</strong></th>
      </tr>
<?php
      $sql = "SELECT DATE(CREATE_DATE), COUNT(CREATE_DATE) from sys_app_user WHERE DATE(CREATE_DATE)  >= '".$stardate."' AND DATE(CREATE_DATE)  <= '".$enddate."' group by DATE(CREATE_DATE)";
      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
?>
      <tr>
        <td class="<?=$myclass?>"><?=$row[0]?></td>
        <td class="<?=$myclass?>"><?=$row[1]?></td>
  	 </tr>
<? } ?>
    </table>
  </div>
<? }else if($type == 2){ ?>
  <strong>สมาชิกพิพิธพัณฑ์</strong>
  <br/>
  <br/>
  <div x:publishsource="Excel">
  <table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
      <tr>
        <th width="50" class="<?=$myclass?>"><strong>วันที่ลงทะเบียน</strong></th>
        <th width="80" class="<?=$myclass?>"><strong>จำนวน</strong></th>
      </tr>
<?php
      $sql = "SELECT DATE(CREATE_DATE), COUNT(CREATE_DATE) from sys_app_user WHERE DATE(CREATE_DATE)  >= '".$stardate."' AND DATE(CREATE_DATE)  <= '".$enddate."' group by DATE(CREATE_DATE)";
      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
?>
      <tr>
        <td class="<?=$myclass?>"><?=$row[0]?></td>
        <td class="<?=$myclass?>"><?=$row[1]?></td>
     </tr>
<? } ?>
    </table>
  </div>
<? }else if(($type == 7) OR ($type == 8)){
    if($type == 7){
      $id = $ebooking_cat_id;
      $title_page = 'e-Booking';
    }else if($type == 8){
      $id = $education_cat_id;
      $title_page = 'e-Shopping';
    }
?>
  <strong><?=$title_page?></strong>
  <br/>
  <br/>
  <div x:publishsource="Excel">
  <table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
      <tr>
        <th width="50" class="<?=$myclass?>"><strong>หัวข้อ</strong></th>
        <th width="100" class="<?=$myclass?>"><strong>รายการ</strong></th>
        <th width="80" class="<?=$myclass?>"><strong>วันที่สร้าง</strong></th>
      </tr>
<?php
      $cat_row = "";
      $cat_Name = "";
      $cat_Show = "";
      $sql = "SELECT CONTENT_CAT_ID , CONTENT_CAT_DESC_LOC FROM trn_content_category WHERE REF_MODULE_ID = ".$id." AND FLAG != 2";
      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
        $cat_row[] = 'CAT_ID = '.$row['CONTENT_CAT_ID'];
        $cat_Name[$row['CONTENT_CAT_ID']] = $row['CONTENT_CAT_DESC_LOC'];
        $cat_Show[$row['CONTENT_CAT_ID']] = true;
      }

      $sql = "SELECT PRODUCT_DESC_LOC , DATE(CREATE_DATE) , CAT_ID from trn_product WHERE (".implode(" OR ", $cat_row).") AND Flag != 2 AND DATE(CREATE_DATE)  >= '".$stardate."' AND DATE(CREATE_DATE)  <= '".$enddate."' ORDER BY CAT_ID ASC ";

      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
        if($cat_Show[$row['CAT_ID']]){
          $cat_Show[$row['CAT_ID']] = false;
          echo '<tr>
            <td class="'.$myclass.'"><strong>'.$cat_Name[$row['CAT_ID']].'</strong></td>
            <td class="'.$myclass.'"></td>
            <td class="'.$myclass.'"></td>
         </tr>';
        }
?>
      <tr>
        <td class="<?=$myclass?>"></td>
        <td class="<?=$myclass?>"><?=$row[0]?></td>
        <td class="<?=$myclass?>"><?=$row[1]?></td>
     </tr>
<? } ?>
    </table>
  </div>
<? }else{
  if($type == 3){
    $id = $km_module_id;
    $title_page = 'การจัดการความรู้';
  }else if($type == 4){
    $id = $digial_module_id;
    $title_page = 'คลังข้อมูลอิเล็คทรอนิกส์';
  }else if($type == 5){
    $id = $museum_data_network_module_id;
    $title_page = 'ระบบเครือข่ายพิพิธภัณฑ์';
  }
?>
  <strong><?=$title_page?></strong>
  <br/>
  <br/>
  <div x:publishsource="Excel">
  <table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
      <tr>
        <th width="50" class="<?=$myclass?>"><strong>หัวข้อ</strong></th>
        <th width="100" class="<?=$myclass?>"><strong>รายการ</strong></th>
        <th width="80" class="<?=$myclass?>"><strong>วันที่สร้าง</strong></th>
        <th width="80" class="<?=$myclass?>"><strong>ผู้เยี้ยมชม</strong></th>
      </tr>
<?php
      $cat_row = "";
      $cat_Name = "";
      $cat_Show = "";
      $sql = "SELECT CONTENT_CAT_ID , CONTENT_CAT_DESC_LOC FROM trn_content_category WHERE REF_MODULE_ID = ".$id." AND FLAG != 2";
      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
        $cat_row[] = 'CAT_ID = '.$row['CONTENT_CAT_ID'];
        $cat_Name[$row['CONTENT_CAT_ID']] = $row['CONTENT_CAT_DESC_LOC'];
        $cat_Show[$row['CONTENT_CAT_ID']] = true;
      }

     echo $sql = "SELECT CONTENT_DESC_LOC , DATE(CREATE_DATE) , CONTENT_VIEW_COUNT , CAT_ID from trn_content_detail WHERE (".implode(" OR ", $cat_row).") AND APPROVE_FLAG != 2 AND DATE(CREATE_DATE)  >= '".$stardate."' AND DATE(CREATE_DATE)  <= '".$enddate."' ORDER BY CAT_ID ASC ";

      $query = mysql_query($sql,$conn);
      while($row = mysql_fetch_array($query)) {
        if($cat_Show[$row['CAT_ID']]){
          $cat_Show[$row['CAT_ID']] = false;
          echo '<tr>
            <td class="'.$myclass.'"><strong>'.$cat_Name[$row['CAT_ID']].'</strong></td>
            <td class="'.$myclass.'"></td>
            <td class="'.$myclass.'"></td>
            <td class="'.$myclass.'"></td>
         </tr>';
        }
?>
      <tr>
        <td class="<?=$myclass?>"></td>
        <td class="<?=$myclass?>"><?=$row[0]?></td>
        <td class="<?=$myclass?>"><?=$row[1]?></td>
        <td class="<?=$myclass?>"><?=$row[2]?></td>
     </tr>
<? } ?>
    </table>
  </div>
<? } ?>

</body>
</html>
<?
CloseDB();
?>