<?php

//$_SESSION['CURRENT_URL'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

if ($refering_url != _FULL_SITE_PATH_ . '/login.php') {
	$_SESSION['last_url'] = $refering_url;
}

if (!isset($_SESSION['LANG']))
	$_SESSION['LANG'] = 'TH';
//TH , EN

if ($_SESSION['LANG'] == 'TH')
	require ("inc-th-lang.php");
else if ($_SESSION['LANG'] == 'EN')
	require ("inc-en-lang.php");

require ("inc-cat-id-conf.php");
?>
<div class="part-top-bar">
	<div class="box-top">
		<div class="container cf">
			<div class="box-left">
				<div class="box-lang cf">
					<a>TH</a>
					<img src="images/en/icon-en.png" alt="icon-en" width="21" height="12" />
					<a>EN</a>
				</div>
			</div>
			<div class="box-right cf">
				<div class="box-btn-shopping">
					<a href="">e-SHOPPING</a>
				</div>
				<div class="box-btn-social cf">
					<a href="#" class="btn-socila fb"></a>
					<a href="#" class="btn-socila tw"></a>
					<a href="#" class="btn-socila yt"></a>
					<a href="#" class="btn-socila ig"></a>
				</div>
				<div class="box-search">
					<input type="text" placeholder="ค้นหาทั้งหมด">
				</div>
				<div class="box-member cf">

					<?
					if (isset($_SESSION['user_name']))
						echo $_SESSION['user_name'] . ' <a href="logout.php">ออกจากระบบ</a>';
					else
						echo '<a href="login.php">'.$loginCaption.'</a>';
					?>
					<div class="box-pic">
						<img src="images/icon-humen.png" alt="icon-humen" width="23" height="23" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

