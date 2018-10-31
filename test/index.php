<?php

include "./src/filesystem.php";
$d = \Jiny\Filesystem\File::init();
var_dump($d->read_lines("README.md"));

$fp = fopen("README.md", "r");
if (is_resource($fp)) {
    while (($buffer=fgets($fp,4096))!== false) {

    }
}
fclose($fp);

sleep(1);
echo $d->isUpadate("README.md");

//$contents = $d->path_real(".");
//var_dump($contents);

// $p = $d->path_add("/aaa/bbb/ccc/","../../d/e/f/");
// var_dump($p);