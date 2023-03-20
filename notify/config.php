<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With"); 

define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','golscan_datax');
define('DB_USER','golscan_dataxxa');
define('DB_PASS','Wt^3YDo?#YBR');
$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8', DB_USER, DB_PASS,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
return($db);

?>