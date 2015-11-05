<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>
</head>

<body>
<div class="mytextarea"><h1>xxxx</h1></div>
<script type="text/javascript" src="assets/plugin/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: "div.mytextarea",
    inline: true,
    toolbar: "undo redo",
    menubar: false
});
</script>
<style type="text/css">
.mytextarea{
	width: 1000px;
	height: 150px;
}
</style>
</body>
</html>
