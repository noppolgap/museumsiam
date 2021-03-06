<?php
if (!isset($page_title)) {
	$page_title = _TITTLE_SITE_;
}
if (!isset($page_Keywords)) {
	$page_Keywords = _META_KEYWORDS_;
}
if (!isset($page_description)) {
	$page_description = _META_DESCRIPTION_;
}
?>
<meta charset="UTF-8">
<title><?=$page_title ?></title>
<meta content="<?=$page_Keywords ?>" name="description">
<meta content="<?=$page_description ?>" name="Keywords">
<meta name="robots" content="index,follow">
<link rel="apple-touch-icon" sizes="57x57" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=_FULL_SITE_PATH_ ?>/fav/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=_FULL_SITE_PATH_ ?>/fav/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=_FULL_SITE_PATH_ ?>/fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=_FULL_SITE_PATH_ ?>/fav/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=_FULL_SITE_PATH_ ?>/fav/favicon-16x16.png">
<link rel="manifest" href="<?=_FULL_SITE_PATH_ ?>/fav/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?=_FULL_SITE_PATH_ ?>/fav/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" type="text/css" href="../../assets/plugin/cssreset-min.css" media="all" />
<link rel="stylesheet" type="text/css" href="../../assets/plugin/jquery-ui/jquery-ui.min.css" media="all" />
<? /* <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script type="text/javascript">if (!window.jQuery) document.write(unescape('%3Cscript src="<?=_FULL_SITE_PATH_ ?>/assets/plugin/jquery.min.js"%3E%3C/script%3E'))</script>
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> 	
<script type="text/javascript">if (!window.jQuery.ui) document.write(unescape('%3Cscript src="<?=_FULL_SITE_PATH_ ?>/assets/plugin/jquery-ui/jquery-ui.min.js"%3E%3C/script%3E'))</script>
*/ ?>
<script type="text/javascript" src="../../assets/plugin/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/jquery-ui/jquery-ui.min.js"></script>