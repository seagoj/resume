<?php
$json = file_get_contents('redis.json');
$array = json_decode($json);

//die(var_dump($array));

require_once('../lib/Predis/autoloader.php');
Predis\Autoloader::register();

$redis = new Predis\Client();

foreach($array AS $site=>$data) {
    foreach($data AS $section=>$info) {
        foreach($info AS $key=>$value) {
            $hashID = "$site.$section";            
            $redis->hset($hashID,$key,$value);
        }
    }
}

/*
foreach(array('portfolio.page','portfolio.contact','portfolio.section1','portfolio.section2') AS $item) {
    print "<div>$item</div>";
    var_dump($redis->hgetall($item));
}*/
