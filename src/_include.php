<?php
$fileDelimeter = '\\';
$URIDelimeter = '/';

$fileArray = explode($fileDelimeter,__FILE__);
$URIArray = explode($URIDelimeter,$_SERVER['REQUEST_URI']);

if($key = array_search($URIArray[1],$fileArray)) {
    $include = array();
    for($i=0;$i<=$key;$i++) {
        array_push($include,$fileArray[$i]);
    }
    set_include_path(implode($URIDelimeter,$include));
} else {
    die("include path not found");
}

require_once('/lib/autoload/src/autoload.php');