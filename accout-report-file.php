<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

$strExcelFileName	= time().".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma: no-cache");

$myclass= 'xl'.time();
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
<strong>ตัวอย่างรายงาน</strong><br>
<br>

<div x:publishsource="Excel">
<table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
    <tr>
      <th width="50" class="<?=$myclass?>"><strong>Id</strong></th>
      <th width="80" class="<?=$myclass?>"><strong>จังหวัด</strong></th>
      <th width="80" class="<?=$myclass?>"><strong>โทรศัพท์</strong></th>
    </tr>
    <tr>
      <td class="<?=$myclass?>">00001</td>
      <td class="<?=$myclass?>">กรุงเทพฯ</td>
      <td class="<?=$myclass?>">0810000000</td>
	</tr>
    <tr>
      <td class="<?=$myclass?>">00002</td>
      <td class="<?=$myclass?>">กาญจนบุรี</td>
      <td class="<?=$myclass?>">0819999999</td>
	</tr>
  </table>
</div>

</body>
</html>
<?
CloseDB();
?>