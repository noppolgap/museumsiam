<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

	if ($_SESSION['LANG'] == 'TH'){
		$search_row = 'CONTENT_DESC_LOC AS CONTENT_LOC , BRIEF_LOC AS CONTENT_BRIEF';
	}else if ($_SESSION['LANG'] == 'EN'){
		$search_row = 'CONTENT_DESC_ENG AS CONTENT_LOC , BRIEF_ENG AS CONTENT_BRIEF';
	}

$sql_row1 = "SELECT CONTENT_ID , trn_content_detail.CREATE_DATE AS  CONTENT_DATE, CAT_ID , ".$search_row." , REF_MODULE_ID FROM trn_content_detail LEFT JOIN trn_content_category ON trn_content_detail.CAT_ID = trn_content_category.CONTENT_CAT_ID WHERE APPROVE_FLAG = 'Y'";

if((isset($_POST['txt_search_form'])) AND ($_POST['txt_search_form'] != '')){
	$txt = mysql_real_escape_string(trim($_POST['txt_search_form']));

	if ($_SESSION['LANG'] == 'TH'){
		$sql_row1 .= " AND (CONTENT_DESC_LOC LIKE '%".$txt."%'";
		$sql_row1 .= " OR BRIEF_LOC LIKE '%".$txt."%'";
		$sql_row1 .= " OR CONTENT_DETAIL_LOC LIKE '%".$txt."%')";
	}else if ($_SESSION['LANG'] == 'EN'){
		$sql_row1 .= " AND (CONTENT_DESC_ENG LIKE '%".$txt."%'";
		$sql_row1 .= " OR BRIEF_ENG LIKE '%".$txt."%'";
		$sql_row1 .= " OR CONTENT_DETAIL_ENG LIKE '%".$txt."%')";
	}

	$string_show = '"'.$txt.'"';
}

	$sql_row1 .= " AND ((EVENT_START_DATE='0000-00-00 00:00:00' AND EVENT_END_DATE='0000-00-00 00:00:00')
			OR (EVENT_START_DATE='0000-00-00 00:00:00' AND TO_DAYS(EVENT_END_DATE)>=TO_DAYS(NOW()) )
			OR (TO_DAYS(EVENT_START_DATE)<=TO_DAYS(NOW()) AND EVENT_END_DATE='0000-00-00 00:00:00' )
			OR (TO_DAYS(EVENT_START_DATE)<=TO_DAYS(NOW()) AND  TO_DAYS(EVENT_END_DATE)>=TO_DAYS(NOW())  ))
		ORDER BY trn_content_detail.ORDER_DATA DESC";
	$query_row1 = mysql_query($sql_row1, $conn);
	$num_row1 = @mysql_num_rows($query_row1);

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu6").addClass("active");
	});
</script>

</head>

<body>

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ระบบการจัดการความรู้</li>
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
			<hr class="line-red"/>
			<div class="box-title-system news cf">
				<h1>ผลลัพธ์การค้นหา <span><?=$string_show?></span></h1>
			</div>
			<div class="box-category-main news BWhite">
				<div class="box-news-main">
					<div class="box-tumb-main cf" id="searchResultBlock">
<?php
	if($num_row1 > 0){
		$index  =   1;
		//$sql_row1 .= " LIMIT 0 , 30";
		$query_row1 = mysql_query($sql_row1, $conn);
		while ($row_row1 = mysql_fetch_array($query_row1)) {
			switch($row_row1['REF_MODULE_ID']){
				case 2	: $path = 'km-detail.php'; break;
				case 3	: $path = 'da-detail.php'; break;
			}

			$path .= '?MID='.$row_row1['REF_MODULE_ID'].'&amp;CID='.$row_row1['CAT_ID'].'&amp;CONID='.$row_row1['CONTENT_ID'];
			$fullpath = _FULL_SITE_PATH_.'/'.$path;
			$redirect_uri = _FULL_SITE_PATH_.'/callback.php?p='.$row_row1['CONTENT_ID'];
			$fb_link = 'https://www.facebook.com/dialog/share?app_id='._FACEBOOK_ID_.'&display=popup&href='.$fullpath.'&redirect_uri='.$redirect_uri;



?>
						<div class="box-tumb cf <?=($index == 2 ? 'mid':'')?>" data-ID="<?=$row_row1['CONTENT_ID']?>" data-cID="<?=$row_row1['CAT_ID']?>" data-share="<?=$fullpath?>">
							<a href="<?=$path?>">
								<span class="box-pic Search_image_thumb"></span>
							</a>
							<div class="box-text">
								<a href="<?=$path?>">
									<p class="text-title TcolorRed"><?=$row_row1['CONTENT_LOC']?></p>
								</a>
								<p class="text-date TcolorGray"><?=ConvertDate($row_row1['CONTENT_DATE'])?></p>
								<p class="text-des TcolorBlack"><?=$row_row1['CONTENT_BRIEF']?></p>
								<div class="box-btn cf">
									<a href="<?=$path?>" class="btn red"><?=$txt_more?></a>
									<div class="box-btn-social cf">
										<a href="<?=$fb_link?>" onclick="shareFB(<?=$row_row1['CONTENT_ID']?>,$(this).attr('href')); return false;" class="btn-socila fb"></a>
										<a href="<?=$fullpath?>" onclick="shareTW(<?=$row_row1['CONTENT_ID']?>,'<?=$row_row1['CONTENT_LOC']?>',$(this).attr('href')); return false;" class="btn-socila tw"></a>
									</div>
								</div>
							</div>
						</div>
<?php
			if($index == 3){
				echo '<hr class="line-gray"/>';
				$index = 0;
			}
			$index++;
		}
	}else{

	}
?>
					</div>
					<? /*
					<div class="box-pagination-main cf">
						<ul class="pagination">
							<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">...</a></li>
							<li><a href="" class="btn-arrow-right"></a></li>
						</ul>
					</div>
					*/ ?>
				</div>
			</div>

			<div class="box-category-main news BWhite">
				<div class="box-news-main">
					<div class="box-tumb-main cf">
						<div class="box-result-list-main">

							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">อ่านเพิ่มเติม</a>
								</div>
							</div>

						</div>
					</div>
					<div class="box-pagination-main cf Noborder">
						<ul class="pagination">
							<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">...</a></li>
							<li><a href="" class="btn-arrow-right"></a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="box-category-main news BWhite">
				<div class="box-news-main">
					<div class="box-tumb-main cf">
						<div class="box-result-list-main">

							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">ดาว์นโหลด</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">ดาว์นโหลด</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">ดาว์นโหลด</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">ดาว์นโหลด</a>
								</div>
							</div>
							<div class="result-list cf">
								<div class="box-left">
									<div class="box-text">
										<a href="">
											<div class="text-title">
												ต้องการขอข้อมูลและถ่ายรูปพิพิธภัณฑ์เพื่อประกอบปริญญานิพนธ์
											</div>
										</a>
										<div class="text-des">
											ดิฉันนางสาวภัสรี เดชศรี เป็นนักศึกษาจากสถาบันเทคโนโลยีพระจอมเกล้าฯ ลาดกระบัง คณะครุศาสตร์อุสาหกรรม สาขาสถาปัตยกรรมภายใน...
										</div>
									</div>
								</div>
								<div class="box-btn cf">
									<a href="" class="btn red">ดาว์นโหลด</a>
								</div>
							</div>

						</div>
					</div>
					<div class="box-pagination-main cf Noborder">
						<ul class="pagination">
							<li class="deactive"><a href="" class="btn-arrow-left"></a></li>
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">...</a></li>
							<li><a href="" class="btn-arrow-right"></a></li>
						</ul>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>
<?php include('inc/inc-social-network.php'); ?>
</body>
</html>
<? CloseDB(); ?>