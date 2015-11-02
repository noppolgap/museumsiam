<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");


$id = intval($_GET['web_id']);
if($id == 0){
	header('Location: km.php');
}else{

	if(!isset($_SESSION["VISIT_COUNT"])){
		$_SESSION["VISIT_COUNT"] = array();
	}
	if (!in_array($id ,$_SESSION["VISIT_COUNT"])){
		mysql_query("UPDATE trn_webboard SET VISIT_COUNT = VISIT_COUNT+1 WHERE WEBBOARD_ID =".$id, $conn);
		$_SESSION["VISIT_COUNT"][] = $id;
  	}

    $badword = null;
    $goodword = null;
    $sql_weo = "SELECT trn_weo_word , trn_weo_replace FROM trn_weo";
    $query_weo=mysql_query($sql_weo);
    while($Row_weo=mysql_fetch_row($query_weo)){
    	$badword[] = $Row_weo[0];
    	$goodword[] = $Row_weo[1];
    }
}

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/km.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6").addClass("active");
	});
</script>

</head>

<body id="km">

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="km.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="km.php"><?=getModuleDescription($km_module_id);?></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">เว็บบอร์ด</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-km.php'); ?>
		</div>
		<div class="box-right main-content">

			<?
				$sq_qa = " SELECT WEBBOARD_ID, CONTENT, USER_CREATE, LAST_UPDATE_DATE , DETAIL FROM trn_webboard
						   WHERE  WEBBOARD_ID = ".$id." AND FLAG <>2 ORDER BY ORDER_DATA DESC ";

				$query_qa = mysql_query($sq_qa, $conn);

				$num_rows = mysql_num_rows($query_qa);

				$num = 1;

			?>

			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>เว็บบอร์ด</h1>
				<div class="box-btn">
					<a href="km-webboard.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>

			<?php
			$row = mysql_fetch_array($query_qa);
			$content = trim(str_replace("\\","",$row['CONTENT']));
			$content = str_replace($badword,$goodword, $content);
			$detail = trim(str_replace("\\","",$row['DETAIL']));
			$detail = str_replace($badword,$goodword, $detail);

			?>

			<div  class="box-topic-main">

				<div class="box-top">
					<div class="box-topic-title">
						<?=$content?>
					</div>
				</div>
				<div class="box-bottom">
					<div class="box-topic-detail">
						<?=$detail?>
					</div>
					<hr/>
					<div class="box-footer-topic cf">
						<div class="box-left">
							<p>ตั้งโดย : <? echo $row['USER_CREATE'] ?></p>
						</div>
						<div class="box-right">
							<p><? echo ConvertDate($row['LAST_UPDATE_DATE']) ?></p>
						</div>
					</div>
				</div>

			</div>

			<?php

			////ส่วนคำตอบ
			    $sq_ans = "  SELECT CONTENT, USER_CREATE, LAST_UPDATE_DATE , ORDER_DATA FROM trn_webboard
							WHERE REF_WEBBOARD_ID = ".$id." AND FLAG <> 2 ORDER BY ORDER_DATA ASC ";

				$query_ans = mysql_query($sq_ans, $conn);

			?>

			<div  class="box-replay-main">

				<?
				while($row_ans = mysql_fetch_array($query_ans)) {
					$detail = trim(str_replace("\\","",$row_ans['CONTENT']));
					$detail = str_replace($badword,$goodword, $detail);
				?>

				<div class="box-top">
					<p>
						ความคิดเห็น <?=$row_ans['ORDER_DATA']?> :
					</p>
				</div>
				<div class="box-bottom">
					<div class="box-replay-detail"><? echo $detail ?></div>
					<div class="box-footer-replay cf">
						<div class="box-left">
							<p>ตอบโดย : <? echo $row_ans['USER_CREATE'] ?></p>
						</div>
					</div>
					<hr/>
				</div>

				<? } ?>

			</div>

<?php /*
			<div class="box-pagination-main cf Noborder pageTopic">
				<ul class="pagination">
					<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">...</a></li>
					<li><a href="" class="btn-arrow-right"></a></li>
				</ul>
			</div>
*/

$sql = "SELECT USER_ID , CITIZEN_ID FROM sys_app_user WHERE ID = ".intval($_SESSION['UID']);
$query = mysql_query($sql, $conn);
if(mysql_num_rows($query) > 0){
	$row = mysql_fetch_array($query);

	if($row['CITIZEN_ID'] == ''){
		$action_btn = '<input type="button" value="ตอบกระทู้" class="btn red" onclick="editAccout();">';
	}else{
		$action_btn = '<input name="my_username" value="'.$row['USER_ID'].'" type="hidden"><input type="submit" value="ตอบกระทู้" class="btn red">';
	}
?>
		<form action="webboard_action.php?answer&web_id=<?=$id?> " method="post" name="formcms" id="replyTopic">
			<div class="box-form-reply">
				<div class="text-title">
					ตอบกระทู้
				</div>
				<textarea name="content" class="mytextarea" id="input_content"></textarea>
				<div class="condition">
					<p>
					<span>ข้อตกลง</span>
						ขอสงวนสิทธิ์ในการตรวจสอบข้อความก่อนแสดงบนหน้าเว็บและใช้ดุลพินิจที่จะลบกระทู้ใดๆ ที่มีข้อความที่ไม่เหมาะสม ไม่สุภาพหรือพาดพิงถึงลุคคลใดๆ ในการเสื่อมเสีย
					</p>
				</div>
				<div class="box-btn cf"><?=$action_btn?></div>
			</div>

		</form>
<?php } ?>
			<div class="box-pagination-main cf">
				<div class="box-btn topic">
					<a href="km-webboard.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>

<script type="text/javascript" src="assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/webboard.js"></script>
<script type="text/javascript">
 	str = [
			"ไม่สามารถดำเนินการได้ เพราะ",
			"\n - กรุณาระบุเนื้อหา"
		];
	card = 'ยังไม่สามารถใช้ความสามารถนี้ได้ ต้องลงทะเบียนบัตรประชาชนก่อน';
</script>
</body>
</html>
