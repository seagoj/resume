<?php
$folder = realpath('../lib');

if(!$file = realpath($folder.'/'.$_GET['file'])) {
	die("$file: 404");
}
if(!is_file($file)) {
	die("$file: 404");
}
if(substr($file,0,strlen($folder))!==$folder) {
	die("$file: 401");
}

$mimeTypes = array(
	'css'=>'text/css',
	'js'=>'application/x-javascript',
	'php'=>'application/x-php',
	'less'=>'text/css',
	'jpg'=>'image/jpeg',
	'jpeg'=>'image/jpeg',
	'png'=>'image/png'
);

header(sprintf("Content-type: %s;",$mimeTypes[strtolower(substr($filename,strrpos($filename,'.')+1))]));
readfile($file);
exit;