<?php
$arr = include __DIR__."/../config/db.php";
$key=$argv[1];
echo (isset($arr[$key])?$arr[$key]:"");
