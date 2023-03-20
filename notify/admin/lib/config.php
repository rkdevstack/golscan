<?php
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','golscan_golscan');
define('DB_USER','golscan_golscan');
define('DB_PASS','3Jf#33enS1~s');
$db = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
return($db);

?>

