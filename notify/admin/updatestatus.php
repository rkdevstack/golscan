<?php ob_start(); error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
require "lib/config.php";

extract($_GET); extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');



if(isset($_POST) && $_POST['Submit']=="UpdateUser") {
    
	$db->query("UPDATE `users` SET `status`='$status' WHERE `guid`='$guid'");
	
}


if(isset($_POST) && $_POST['Submit']=="Updatetxn") {
    
	$db->query("UPDATE `transactions` SET `status`='$status' WHERE `guid`='$guid'");
	

}
?>