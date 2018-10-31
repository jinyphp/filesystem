<?php

// echo realpath(DIRECTORY_SEPARATOR);
include "filesystem.php";
$d = \Jiny\Filesystem\File::init();
$d->rmdir_all("aaa");