<?php
$file = $_GET['p'];

$quoted = sprintf('"%s"', addcslashes(basename($file), '"\\'));
$size   = filesize($file);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $quoted);
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . $size);

readfile($file);
?>