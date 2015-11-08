<?php

//$_SESSION['CURRENT_URL'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

if ($refering_url != _FULL_SITE_PATH_ . '/login.php' && $refering_url != _FULL_SITE_PATH_ . '/login-action.php') {
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
				<?php if ($_SESSION['LANG'] == 'TH'){ ?>
					<a href="#">TH</a>
					<img src="images/th/icon-th.png" alt="icon-th" width="21" height="12" />
					<a href="#" onclick="swapLANG('EN'); return false;">EN</a>
				<?php }else if ($_SESSION['LANG'] == 'EN'){ ?>
					<a href="#" onclick="swapLANG('TH'); return false;">TH</a>
					<img src="images/en/icon-en.png" alt="icon-en" width="21" height="12" />
					<a href="#">EN</a>
				<?php } ?>
				</div>
				<div class="box-sitemap cf">
					<a href="sitemap.php">SITEMAP</a>
				</div>
			</div>
			<div class="box-right cf">
				<div class="box-btn-shopping">
					<a href="e-shopping.php">e-SHOPPING</a>
				</div>
				<div class="box-btn-social cf">
					<a target="_blank" href="https://www.facebook.com/museumsiamfan" class="btn-socila fb"></a>
					<a target="_blank" href="https://twitter.com/museumsiam" class="btn-socila tw"></a>
					<a target="_blank" href="https://www.youtube.com/museumsiam" class="btn-socila yt"></a>
					<a target="_blank" href="https://instagram.com/museumsiam" class="btn-socila ig"></a>
				</div>
				<div class="box-search">
					<form name="search_form" method="post" action="system-search.php">
					<input type="search" name="txt_search_form" placeholder="<?=$txt_find?>">
					<input type="submit" name="save_search_form" >
					</form>
				</div>
				<div class="box-member cf">

					<?
					if (isset($_SESSION['user_name']))
						echo '<a href="account.php">'. $_SESSION['user_name'] . '</a> <a href="logout.php">ออกจากระบบ</a>';
					else
						echo '<a href="login.php">'.$loginCaption.'</a>';
					?>
					<div class="box-pic">
					<?
						if(isset($_SESSION['FB'])){
							echo '<img src="http://graph.facebook.com/'.$_SESSION['FB'].'/picture" alt="" />';
						}else if(isset($_SESSION['IMAGE_PATH'])){
							echo '<img src="'.$_SESSION['IMAGE_PATH'].'" />';
						}else{
							echo '<img src="images/icon-humen.png" alt="icon-humen" />';
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function swapLANG(lang){
$.post( "swap.php", { lang: lang })
  .done(function( data ) {
    window.location.reload();
  });
}
</script>
