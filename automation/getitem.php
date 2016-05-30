<?php
if (file_exists(__DIR__."/../config/db.php")){
	$arr = include __DIR__."/../config/db.php";
	$key=$argv[1];
	if ($key=="dbname"){
		$dsn=$arr["dsn"];
		$values=explode(";", $dsn);
		$dbval=array_pop($values);
		$_dbname=explode("=", $dbval);
		$dbname=array_pop($_dbname);
		echo $dbname;
		exit;
	}
	echo (isset($arr[$key])?$arr[$key]:"");
}
else 
	exit(-1);